<?php
/**
 * Upgrade API: File_Upload_Upgrader class
 *
 * @package WordPress
 * @subpackage Upgrader
 * @since 4.6.0
 */

/**
 * Core class used for handling file uploads.
 *
 * This class handles the upload process and passes it as if it's a local file
 * to the Upgrade/Installer functions.
 *
 * @since 2.8.0
 * @since 4.6.0 Moved to its own file from wp-admin/includes/class-wp-upgrader.php.
 */
#[AllowDynamicProperties]
class File_Upload_Upgrader
{
    /**
     * The full path to the file package.
     *
     * @since 2.8.0
     * @var string $package
     */
    public $package;

    /**
     * The name of the file.
     *
     * @since 2.8.0
     * @var string $filename
     */
    public $filename;

    /**
     * The ID of the attachment post for this file.
     *
     * @since 3.3.0
     * @var int $id
     */
    public $id = 0;

    /**
     * Construct the upgrader for a form.
     *
     * @since 2.8.0
     *
     * @param string $form      The name of the form the file was uploaded from.
     * @param string $urlholder The name of the `GET` parameter that holds the filename.
     */
    public function __construct($form, $urlholder)
    {
        if (empty($_FILES[$form]["name"]) && empty($_GET[$urlholder])) {
            wp_die(__("Please select a file"));
        }

        // Handle a newly uploaded file. Else, assume it's already been uploaded.
        if (!empty($_FILES)) {
            $overrides = [
                "test_form" => false,
                "test_type" => false,
            ];
            $file = wp_handle_upload($_FILES[$form], $overrides);

            if (isset($file["error"])) {
                wp_die($file["error"]);
            }

            if ("pluginzip" === $form || "themezip" === $form) {
                if (!wp_zip_file_is_valid($file["file"])) {
                    wp_delete_file($file["file"]);

                    if ("pluginzip" === $form) {
                        $plugins_page = sprintf(
                            '<a href="%s">%s</a>',
                            self_admin_url("plugin-install.php"),
                            __("Return to the Plugin Installer")
                        );
                        wp_die(
                            __("Incompatible Archive.") .
                                "<br />" .
                                $plugins_page
                        );
                    }

                    if ("themezip" === $form) {
                        $themes_page = sprintf(
                            '<a href="%s" target="_parent">%s</a>',
                            self_admin_url("theme-install.php"),
                            __("Return to the Theme Installer")
                        );
                        wp_die(
                            __("Incompatible Archive.") .
                                "<br />" .
                                $themes_page
                        );
                    }
                }
            }

            $this->filename = $_FILES[$form]["name"];
            $this->package = $file["file"];

            // Construct the attachment array.
            $attachment = [
                "post_title" => $this->filename,
                "post_content" => $file["url"],
                "post_mime_type" => $file["type"],
                "guid" => $file["url"],
                "context" => "upgrader",
                "post_status" => "private",
            ];

            // Save the data.
            $this->id = wp_insert_attachment($attachment, $file["file"]);

            // Schedule a cleanup for 2 hours from now in case of failed installation.
            wp_schedule_single_event(
                time() + 2 * HOUR_IN_SECONDS,
                "upgrader_scheduled_cleanup",
                [$this->id]
            );
        } elseif (is_numeric($_GET[$urlholder])) {
            // Numeric Package = previously uploaded file, see above.
            $this->id = (int) $_GET[$urlholder];
            $attachment = get_post($this->id);
            if (empty($attachment)) {
                wp_die(__("Please select a file"));
            }

            $this->filename = $attachment->post_title;
            $this->package = get_attached_file($attachment->ID);
        } else {
            // Else, It's set to something, Back compat for plugins using the old (pre-3.3) File_Uploader handler.
            $uploads = wp_upload_dir();
            if (!($uploads && false === $uploads["error"])) {
                wp_die($uploads["error"]);
            }

            $this->filename = sanitize_file_name($_GET[$urlholder]);
            $this->package = $uploads["basedir"] . "/" . $this->filename;

            if (
                !str_starts_with(
                    realpath($this->package),
                    realpath($uploads["basedir"])
                )
            ) {
                wp_die(__("Please select a file"));
            }
        }
    }

    /**
     * Deletes the attachment/uploaded file.
     *
     * @since 3.2.2
     *
     * @return bool Whether the cleanup was successful.
     */
    public function cleanup()
    {
        if ($this->id) {
            wp_delete_attachment($this->id);
        } elseif (file_exists($this->package)) {
            return @unlink($this->package);
        }

        return true;
    }
}
