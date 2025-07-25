<?php
/**
 * Error Protection API: WP_Recovery_Mode_Key_Service class
 *
 * @package WordPress
 * @since 5.2.0
 */

/**
 * Core class used to generate and validate keys used to enter Recovery Mode.
 *
 * @since 5.2.0
 */
#[AllowDynamicProperties]
final class WP_Recovery_Mode_Key_Service
{
    /**
     * The option name used to store the keys.
     *
     * @since 5.2.0
     * @var string
     */
    private $option_name = "recovery_keys";

    /**
     * Creates a recovery mode token.
     *
     * @since 5.2.0
     *
     * @return string A random string to identify its associated key in storage.
     */
    public function generate_recovery_mode_token()
    {
        return wp_generate_password(22, false);
    }

    /**
     * Creates a recovery mode key.
     *
     * @since 5.2.0
     * @since 6.8.0 The stored key is now hashed using wp_fast_hash() instead of phpass.
     *
     * @param string $token A token generated by {@see generate_recovery_mode_token()}.
     * @return string Recovery mode key.
     */
    public function generate_and_store_recovery_mode_key($token)
    {
        $key = wp_generate_password(22, false);

        $records = $this->get_keys();

        $records[$token] = [
            "hashed_key" => wp_fast_hash($key),
            "created_at" => time(),
        ];

        $this->update_keys($records);

        /**
         * Fires when a recovery mode key is generated.
         *
         * @since 5.2.0
         *
         * @param string $token The recovery data token.
         * @param string $key   The recovery mode key.
         */
        do_action("generate_recovery_mode_key", $token, $key);

        return $key;
    }

    /**
     * Verifies if the recovery mode key is correct.
     *
     * Recovery mode keys can only be used once; the key will be consumed in the process.
     *
     * @since 5.2.0
     *
     * @param string $token The token used when generating the given key.
     * @param string $key   The plain text key.
     * @param int    $ttl   Time in seconds for the key to be valid for.
     * @return true|WP_Error True on success, error object on failure.
     */
    public function validate_recovery_mode_key($token, $key, $ttl)
    {
        $records = $this->get_keys();

        if (!isset($records[$token])) {
            return new WP_Error(
                "token_not_found",
                __("Recovery Mode not initialized.")
            );
        }

        $record = $records[$token];

        $this->remove_key($token);

        if (
            !is_array($record) ||
            !isset($record["hashed_key"], $record["created_at"])
        ) {
            return new WP_Error(
                "invalid_recovery_key_format",
                __("Invalid recovery key format.")
            );
        }

        if (!wp_verify_fast_hash($key, $record["hashed_key"])) {
            return new WP_Error("hash_mismatch", __("Invalid recovery key."));
        }

        if (time() > $record["created_at"] + $ttl) {
            return new WP_Error("key_expired", __("Recovery key expired."));
        }

        return true;
    }

    /**
     * Removes expired recovery mode keys.
     *
     * @since 5.2.0
     *
     * @param int $ttl Time in seconds for the keys to be valid for.
     */
    public function clean_expired_keys($ttl)
    {
        $records = $this->get_keys();

        foreach ($records as $key => $record) {
            if (
                !isset($record["created_at"]) ||
                time() > $record["created_at"] + $ttl
            ) {
                unset($records[$key]);
            }
        }

        $this->update_keys($records);
    }

    /**
     * Removes a used recovery key.
     *
     * @since 5.2.0
     *
     * @param string $token The token used when generating a recovery mode key.
     */
    private function remove_key($token)
    {
        $records = $this->get_keys();

        if (!isset($records[$token])) {
            return;
        }

        unset($records[$token]);

        $this->update_keys($records);
    }

    /**
     * Gets the recovery key records.
     *
     * @since 5.2.0
     * @since 6.8.0 Each key is now hashed using wp_fast_hash() instead of phpass.
     *              Existing keys may still be hashed using phpass.
     *
     * @return array {
     *     Associative array of token => data pairs, where the data is an associative
     *     array of information about the key.
     *
     *     @type array ...$0 {
     *         Information about the key.
     *
     *         @type string $hashed_key The hashed value of the key.
     *         @type int    $created_at The timestamp when the key was created.
     *     }
     * }
     */
    private function get_keys()
    {
        return (array) get_option($this->option_name, []);
    }

    /**
     * Updates the recovery key records.
     *
     * @since 5.2.0
     * @since 6.8.0 Each key should now be hashed using wp_fast_hash() instead of phpass.
     *
     * @param array $keys {
     *     Associative array of token => data pairs, where the data is an associative
     *     array of information about the key.
     *
     *     @type array ...$0 {
     *         Information about the key.
     *
     *         @type string $hashed_key The hashed value of the key.
     *         @type int    $created_at The timestamp when the key was created.
     *     }
     * }
     * @return bool True on success, false on failure.
     */
    private function update_keys(array $keys)
    {
        return update_option($this->option_name, $keys, false);
    }
}
