<?php
/**
 * REST API: WP_REST_Block_Patterns_Controller class
 *
 * @package    WordPress
 * @subpackage REST_API
 * @since      6.0.0
 */

/**
 * Core class used to access block patterns via the REST API.
 *
 * @since 6.0.0
 *
 * @see WP_REST_Controller
 */
class WP_REST_Block_Patterns_Controller extends WP_REST_Controller
{
    /**
     * Defines whether remote patterns should be loaded.
     *
     * @since 6.0.0
     * @var bool
     */
    private $remote_patterns_loaded;

    /**
     * An array that maps old categories names to new ones.
     *
     * @since 6.2.0
     * @var array
     */
    protected static $categories_migration = [
        "buttons" => "call-to-action",
        "columns" => "text",
        "query" => "posts",
    ];

    /**
     * Constructs the controller.
     *
     * @since 6.0.0
     */
    public function __construct()
    {
        $this->namespace = "wp/v2";
        $this->rest_base = "block-patterns/patterns";
    }

    /**
     * Registers the routes for the objects of the controller.
     *
     * @since 6.0.0
     */
    public function register_routes()
    {
        register_rest_route($this->namespace, "/" . $this->rest_base, [
            [
                "methods" => WP_REST_Server::READABLE,
                "callback" => [$this, "get_items"],
                "permission_callback" => [$this, "get_items_permissions_check"],
            ],
            "schema" => [$this, "get_public_item_schema"],
        ]);
    }

    /**
     * Checks whether a given request has permission to read block patterns.
     *
     * @since 6.0.0
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return true|WP_Error True if the request has read access, WP_Error object otherwise.
     */
    public function get_items_permissions_check($request)
    {
        if (current_user_can("edit_posts")) {
            return true;
        }

        foreach (
            get_post_types(["show_in_rest" => true], "objects")
            as $post_type
        ) {
            if (current_user_can($post_type->cap->edit_posts)) {
                return true;
            }
        }

        return new WP_Error(
            "rest_cannot_view",
            __(
                "Sorry, you are not allowed to view the registered block patterns."
            ),
            ["status" => rest_authorization_required_code()]
        );
    }

    /**
     * Retrieves all block patterns.
     *
     * @since 6.0.0
     * @since 6.2.0 Added migration for old core pattern categories to the new ones.
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_items($request)
    {
        if (!$this->remote_patterns_loaded) {
            // Load block patterns from w.org.
            _load_remote_block_patterns(); // Patterns with the `core` keyword.
            _load_remote_featured_patterns(); // Patterns in the `featured` category.
            _register_remote_theme_patterns(); // Patterns requested by current theme.

            $this->remote_patterns_loaded = true;
        }

        $response = [];
        $patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
        foreach ($patterns as $pattern) {
            $migrated_pattern = $this->migrate_pattern_categories($pattern);
            $prepared_pattern = $this->prepare_item_for_response(
                $migrated_pattern,
                $request
            );
            $response[] = $this->prepare_response_for_collection(
                $prepared_pattern
            );
        }
        return rest_ensure_response($response);
    }

    /**
     * Migrates old core pattern categories to the new categories.
     *
     * Core pattern categories are revamped. Migration is needed to ensure
     * backwards compatibility.
     *
     * @since 6.2.0
     *
     * @param array $pattern Raw pattern as registered, before applying any changes.
     * @return array Migrated pattern.
     */
    protected function migrate_pattern_categories($pattern)
    {
        // No categories to migrate.
        if (
            !isset($pattern["categories"]) ||
            !is_array($pattern["categories"])
        ) {
            return $pattern;
        }

        foreach ($pattern["categories"] as $index => $category) {
            // If the category exists as a key, then it needs migration.
            if (isset(static::$categories_migration[$category])) {
                $pattern["categories"][$index] =
                    static::$categories_migration[$category];
            }
        }

        return $pattern;
    }

    /**
     * Prepare a raw block pattern before it gets output in a REST API response.
     *
     * @since 6.0.0
     * @since 6.3.0 Added `source` property.
     *
     * @param array           $item    Raw pattern as registered, before any changes.
     * @param WP_REST_Request $request Request object.
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function prepare_item_for_response($item, $request)
    {
        // Resolve pattern blocks so they don't need to be resolved client-side
        // in the editor, improving performance.
        $blocks = parse_blocks($item["content"]);
        $blocks = resolve_pattern_blocks($blocks);
        $item["content"] = serialize_blocks($blocks);

        $fields = $this->get_fields_for_response($request);
        $keys = [
            "name" => "name",
            "title" => "title",
            "content" => "content",
            "description" => "description",
            "viewportWidth" => "viewport_width",
            "inserter" => "inserter",
            "categories" => "categories",
            "keywords" => "keywords",
            "blockTypes" => "block_types",
            "postTypes" => "post_types",
            "templateTypes" => "template_types",
            "source" => "source",
        ];
        $data = [];
        foreach ($keys as $item_key => $rest_key) {
            if (
                isset($item[$item_key]) &&
                rest_is_field_included($rest_key, $fields)
            ) {
                $data[$rest_key] = $item[$item_key];
            }
        }

        $context = !empty($request["context"]) ? $request["context"] : "view";
        $data = $this->add_additional_fields_to_object($data, $request);
        $data = $this->filter_response_by_context($data, $context);
        return rest_ensure_response($data);
    }

    /**
     * Retrieves the block pattern schema, conforming to JSON Schema.
     *
     * @since 6.0.0
     * @since 6.3.0 Added `source` property.
     *
     * @return array Item schema data.
     */
    public function get_item_schema()
    {
        if ($this->schema) {
            return $this->add_additional_fields_schema($this->schema);
        }

        $schema = [
            '$schema' => "http://json-schema.org/draft-04/schema#",
            "title" => "block-pattern",
            "type" => "object",
            "properties" => [
                "name" => [
                    "description" => __("The pattern name."),
                    "type" => "string",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "title" => [
                    "description" => __(
                        "The pattern title, in human readable format."
                    ),
                    "type" => "string",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "content" => [
                    "description" => __("The pattern content."),
                    "type" => "string",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "description" => [
                    "description" => __("The pattern detailed description."),
                    "type" => "string",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "viewport_width" => [
                    "description" => __(
                        "The pattern viewport width for inserter preview."
                    ),
                    "type" => "number",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "inserter" => [
                    "description" => __(
                        "Determines whether the pattern is visible in inserter."
                    ),
                    "type" => "boolean",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "categories" => [
                    "description" => __("The pattern category slugs."),
                    "type" => "array",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "keywords" => [
                    "description" => __("The pattern keywords."),
                    "type" => "array",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "block_types" => [
                    "description" => __(
                        "Block types that the pattern is intended to be used with."
                    ),
                    "type" => "array",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "post_types" => [
                    "description" => __(
                        "An array of post types that the pattern is restricted to be used with."
                    ),
                    "type" => "array",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "template_types" => [
                    "description" => __(
                        "An array of template types where the pattern fits."
                    ),
                    "type" => "array",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                ],
                "source" => [
                    "description" => __(
                        "Where the pattern comes from e.g. core"
                    ),
                    "type" => "string",
                    "readonly" => true,
                    "context" => ["view", "edit", "embed"],
                    "enum" => [
                        "core",
                        "plugin",
                        "theme",
                        "pattern-directory/core",
                        "pattern-directory/theme",
                        "pattern-directory/featured",
                    ],
                ],
            ],
        ];

        $this->schema = $schema;

        return $this->add_additional_fields_schema($this->schema);
    }
}
