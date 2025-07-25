<?php
/**
 * Widget API: WP_Widget_Media_Image class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.8.0
 */

/**
 * Core class that implements an image widget.
 *
 * @since 4.8.0
 *
 * @see WP_Widget_Media
 * @see WP_Widget
 */
class WP_Widget_Media_Image extends WP_Widget_Media
{
    /**
     * Constructor.
     *
     * @since 4.8.0
     */
    public function __construct()
    {
        parent::__construct("media_image", __("Image"), [
            "description" => __("Displays an image."),
            "mime_type" => "image",
        ]);

        $this->l10n = array_merge($this->l10n, [
            "no_media_selected" => __("No image selected"),
            "add_media" => _x(
                "Add Image",
                "label for button in the image widget"
            ),
            "replace_media" => _x(
                "Replace Image",
                "label for button in the image widget; should preferably not be longer than ~13 characters long"
            ),
            "edit_media" => _x(
                "Edit Image",
                "label for button in the image widget; should preferably not be longer than ~13 characters long"
            ),
            "missing_attachment" => sprintf(
                /* translators: %s: URL to media library. */
                __(
                    'That image cannot be found. Check your <a href="%s">media library</a> and make sure it was not deleted.'
                ),
                esc_url(admin_url("upload.php"))
            ),
            /* translators: %d: Widget count. */
            "media_library_state_multi" => _n_noop(
                "Image Widget (%d)",
                "Image Widget (%d)"
            ),
            "media_library_state_single" => __("Image Widget"),
        ]);
    }

    /**
     * Get schema for properties of a widget instance (item).
     *
     * @since 4.8.0
     *
     * @see WP_REST_Controller::get_item_schema()
     * @see WP_REST_Controller::get_additional_fields()
     * @link https://core.trac.wordpress.org/ticket/35574
     *
     * @return array Schema for properties.
     */
    public function get_instance_schema()
    {
        return array_merge(
            [
                "size" => [
                    "type" => "string",
                    "enum" => array_merge(get_intermediate_image_sizes(), [
                        "full",
                        "custom",
                    ]),
                    "default" => "medium",
                    "description" => __("Size"),
                ],
                "width" => [
                    // Via 'customWidth', only when size=custom; otherwise via 'width'.
                    "type" => "integer",
                    "minimum" => 0,
                    "default" => 0,
                    "description" => __("Width"),
                ],
                "height" => [
                    // Via 'customHeight', only when size=custom; otherwise via 'height'.
                    "type" => "integer",
                    "minimum" => 0,
                    "default" => 0,
                    "description" => __("Height"),
                ],

                "caption" => [
                    "type" => "string",
                    "default" => "",
                    "sanitize_callback" => "wp_kses_post",
                    "description" => __("Caption"),
                    "should_preview_update" => false,
                ],
                "alt" => [
                    "type" => "string",
                    "default" => "",
                    "sanitize_callback" => "sanitize_text_field",
                    "description" => __("Alternative Text"),
                ],
                "link_type" => [
                    "type" => "string",
                    "enum" => ["none", "file", "post", "custom"],
                    "default" => "custom",
                    "media_prop" => "link",
                    "description" => __("Link To"),
                    "should_preview_update" => true,
                ],
                "link_url" => [
                    "type" => "string",
                    "default" => "",
                    "format" => "uri",
                    "media_prop" => "linkUrl",
                    "description" => __("URL"),
                    "should_preview_update" => true,
                ],
                "image_classes" => [
                    "type" => "string",
                    "default" => "",
                    "sanitize_callback" => [$this, "sanitize_token_list"],
                    "media_prop" => "extraClasses",
                    "description" => __("Image CSS Class"),
                    "should_preview_update" => false,
                ],
                "link_classes" => [
                    "type" => "string",
                    "default" => "",
                    "sanitize_callback" => [$this, "sanitize_token_list"],
                    "media_prop" => "linkClassName",
                    "should_preview_update" => false,
                    "description" => __("Link CSS Class"),
                ],
                "link_rel" => [
                    "type" => "string",
                    "default" => "",
                    "sanitize_callback" => [$this, "sanitize_token_list"],
                    "media_prop" => "linkRel",
                    "description" => __("Link Rel"),
                    "should_preview_update" => false,
                ],
                "link_target_blank" => [
                    "type" => "boolean",
                    "default" => false,
                    "media_prop" => "linkTargetBlank",
                    "description" => __("Open link in a new tab"),
                    "should_preview_update" => false,
                ],
                "image_title" => [
                    "type" => "string",
                    "default" => "",
                    "sanitize_callback" => "sanitize_text_field",
                    "media_prop" => "title",
                    "description" => __("Image Title Attribute"),
                    "should_preview_update" => false,
                ],

                /*
                 * There are two additional properties exposed by the PostImage modal
                 * that don't seem to be relevant, as they may only be derived read-only
                 * values:
                 * - originalUrl
                 * - aspectRatio
                 * - height (redundant when size is not custom)
                 * - width (redundant when size is not custom)
                 */
            ],
            parent::get_instance_schema()
        );
    }

    /**
     * Render the media on the frontend.
     *
     * @since 4.8.0
     *
     * @param array $instance Widget instance props.
     */
    public function render_media($instance)
    {
        $instance = array_merge(
            wp_list_pluck($this->get_instance_schema(), "default"),
            $instance
        );
        $instance = wp_parse_args($instance, [
            "size" => "thumbnail",
        ]);

        $attachment = null;

        if (
            $this->is_attachment_with_mime_type(
                $instance["attachment_id"],
                $this->widget_options["mime_type"]
            )
        ) {
            $attachment = get_post($instance["attachment_id"]);
        }

        if ($attachment) {
            $caption = "";
            if (!isset($instance["caption"])) {
                $caption = $attachment->post_excerpt;
            } elseif (trim($instance["caption"])) {
                $caption = $instance["caption"];
            }

            $image_attributes = [
                "class" => sprintf(
                    "image wp-image-%d %s",
                    $attachment->ID,
                    $instance["image_classes"]
                ),
                "style" => "max-width: 100%; height: auto;",
            ];
            if (!empty($instance["image_title"])) {
                $image_attributes["title"] = $instance["image_title"];
            }

            if ($instance["alt"]) {
                $image_attributes["alt"] = $instance["alt"];
            }

            $size = $instance["size"];

            if (
                "custom" === $size ||
                !in_array(
                    $size,
                    array_merge(get_intermediate_image_sizes(), ["full"]),
                    true
                )
            ) {
                $size = [$instance["width"], $instance["height"]];
                $width = $instance["width"];
            } else {
                $caption_size = _wp_get_image_size_from_meta(
                    $instance["size"],
                    wp_get_attachment_metadata($attachment->ID)
                );
                $width = empty($caption_size[0]) ? 0 : $caption_size[0];
            }

            $image_attributes["class"] .= sprintf(
                ' attachment-%1$s size-%1$s',
                is_array($size) ? implode("x", $size) : $size
            );

            $image = wp_get_attachment_image(
                $attachment->ID,
                $size,
                false,
                $image_attributes
            );
        } else {
            if (empty($instance["url"])) {
                return;
            }

            $instance["size"] = "custom";
            $caption = $instance["caption"];
            $width = $instance["width"];
            $classes = "image " . $instance["image_classes"];
            if (0 === $instance["width"]) {
                $instance["width"] = "";
            }
            if (0 === $instance["height"]) {
                $instance["height"] = "";
            }

            $attr = [
                "class" => $classes,
                "src" => $instance["url"],
                "alt" => $instance["alt"],
                "width" => $instance["width"],
                "height" => $instance["height"],
            ];

            $loading_optimization_attr = wp_get_loading_optimization_attributes(
                "img",
                $attr,
                "widget_media_image"
            );

            $attr = array_merge($attr, $loading_optimization_attr);

            $attr = array_map("esc_attr", $attr);
            $image = "<img";

            foreach ($attr as $name => $value) {
                $image .= " " . $name . '="' . $value . '"';
            }

            $image .= " />";
        } // End if().

        $url = "";
        if ("file" === $instance["link_type"]) {
            $url = $attachment
                ? wp_get_attachment_url($attachment->ID)
                : $instance["url"];
        } elseif ($attachment && "post" === $instance["link_type"]) {
            $url = get_attachment_link($attachment->ID);
        } elseif (
            "custom" === $instance["link_type"] &&
            !empty($instance["link_url"])
        ) {
            $url = $instance["link_url"];
        }

        if ($url) {
            $link = sprintf('<a href="%s"', esc_url($url));
            if (!empty($instance["link_classes"])) {
                $link .= sprintf(
                    ' class="%s"',
                    esc_attr($instance["link_classes"])
                );
            }
            if (!empty($instance["link_rel"])) {
                $link .= sprintf(' rel="%s"', esc_attr($instance["link_rel"]));
            }
            if (!empty($instance["link_target_blank"])) {
                $link .= ' target="_blank"';
            }
            $link .= ">";
            $link .= $image;
            $link .= "</a>";
            $image = $link;
        }

        if ($caption) {
            $image = img_caption_shortcode(
                [
                    "width" => $width,
                    "caption" => $caption,
                ],
                $image
            );
        }

        echo $image;
    }

    /**
     * Loads the required media files for the media manager and scripts for media widgets.
     *
     * @since 4.8.0
     */
    public function enqueue_admin_scripts()
    {
        parent::enqueue_admin_scripts();

        $handle = "media-image-widget";
        wp_enqueue_script($handle);

        $exported_schema = [];
        foreach ($this->get_instance_schema() as $field => $field_schema) {
            $exported_schema[$field] = wp_array_slice_assoc($field_schema, [
                "type",
                "default",
                "enum",
                "minimum",
                "format",
                "media_prop",
                "should_preview_update",
            ]);
        }
        wp_add_inline_script(
            $handle,
            sprintf(
                "wp.mediaWidgets.modelConstructors[ %s ].prototype.schema = %s;",
                wp_json_encode($this->id_base),
                wp_json_encode($exported_schema)
            )
        );

        wp_add_inline_script(
            $handle,
            sprintf(
                '
					wp.mediaWidgets.controlConstructors[ %1$s ].prototype.mime_type = %2$s;
					wp.mediaWidgets.controlConstructors[ %1$s ].prototype.l10n = _.extend( {}, wp.mediaWidgets.controlConstructors[ %1$s ].prototype.l10n, %3$s );
				',
                wp_json_encode($this->id_base),
                wp_json_encode($this->widget_options["mime_type"]),
                wp_json_encode($this->l10n)
            )
        );
    }

    /**
     * Render form template scripts.
     *
     * @since 4.8.0
     */
    public function render_control_template_scripts()
    {
        parent::render_control_template_scripts(); ?>
		<script type="text/html" id="tmpl-wp-media-widget-image-fields">
			<# var elementIdPrefix = 'el' + String( Math.random() ) + '_'; #>
			<# if ( data.url ) { #>
			<p class="media-widget-image-link">
				<label for="{{ elementIdPrefix }}linkUrl"><?php esc_html_e(
        "Link to:"
    ); ?></label>
				<input id="{{ elementIdPrefix }}linkUrl" type="text" class="widefat link" value="{{ data.link_url }}" placeholder="https://" pattern="((\w+:)?\/\/\w.*|\w+:(?!\/\/$)|\/|\?|#).*">
			</p>
			<# } #>
		</script>
		<script type="text/html" id="tmpl-wp-media-widget-image-preview">
			<# if ( data.error && 'missing_attachment' === data.error ) { #>
				<?php wp_admin_notice($this->l10n["missing_attachment"], [
        "type" => "error",
        "additional_classes" => ["notice-alt", "notice-missing-attachment"],
    ]); ?>
			<# } else if ( data.error ) { #>
				<?php wp_admin_notice(__("Unable to preview media due to an unknown error."), [
        "type" => "error",
        "additional_classes" => ["notice-alt"],
    ]); ?>
			<# } else if ( data.url ) { #>
				<img class="attachment-thumb" src="{{ data.url }}" draggable="false" alt="{{ data.alt }}"
					<# if ( ! data.alt && data.currentFilename ) { #>
						aria-label="
						<?php echo esc_attr(
          sprintf(
              /* translators: %s: The image file name. */
              __(
                  "The current image has no alternative text. The file name is: %s"
              ),
              "{{ data.currentFilename }}"
          )
      ); ?>
						"
					<# } #>
				/>
			<# } #>
		</script>
		<?php
    }
}
