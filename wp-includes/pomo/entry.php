<?php
/**
 * Contains Translation_Entry class
 *
 * @version $Id: entry.php 1157 2015-11-20 04:30:11Z dd32 $
 * @package pomo
 * @subpackage entry
 */

if (!class_exists("Translation_Entry", false)):
    /**
     * Translation_Entry class encapsulates a translatable string.
     *
     * @since 2.8.0
     */
    class Translation_Entry
    {
        /**
         * Whether the entry contains a string and its plural form, default is false.
         *
         * @var bool
         */
        public $is_plural = false;

        public $context = null;
        public $singular = null;
        public $plural = null;
        public $translations = [];
        public $translator_comments = "";
        public $extracted_comments = "";
        public $references = [];
        public $flags = [];

        /**
         * @param array $args {
         *     Arguments array, supports the following keys:
         *
         *     @type string $singular            The string to translate, if omitted an
         *                                       empty entry will be created.
         *     @type string $plural              The plural form of the string, setting
         *                                       this will set `$is_plural` to true.
         *     @type array  $translations        Translations of the string and possibly
         *                                       its plural forms.
         *     @type string $context             A string differentiating two equal strings
         *                                       used in different contexts.
         *     @type string $translator_comments Comments left by translators.
         *     @type string $extracted_comments  Comments left by developers.
         *     @type array  $references          Places in the code this string is used, in
         *                                       relative_to_root_path/file.php:linenum form.
         *     @type array  $flags               Flags like php-format.
         * }
         */
        public function __construct($args = [])
        {
            // If no singular -- empty object.
            if (!isset($args["singular"])) {
                return;
            }
            // Get member variable values from args hash.
            foreach ($args as $varname => $value) {
                $this->$varname = $value;
            }
            if (isset($args["plural"]) && $args["plural"]) {
                $this->is_plural = true;
            }
            if (!is_array($this->translations)) {
                $this->translations = [];
            }
            if (!is_array($this->references)) {
                $this->references = [];
            }
            if (!is_array($this->flags)) {
                $this->flags = [];
            }
        }

        /**
         * PHP4 constructor.
         *
         * @since 2.8.0
         * @deprecated 5.4.0 Use __construct() instead.
         *
         * @see Translation_Entry::__construct()
         */
        public function Translation_Entry($args = [])
        {
            _deprecated_constructor(self::class, "5.4.0", static::class);
            self::__construct($args);
        }

        /**
         * Generates a unique key for this entry.
         *
         * @since 2.8.0
         *
         * @return string|false The key or false if the entry is null.
         */
        public function key()
        {
            if (null === $this->singular) {
                return false;
            }

            // Prepend context and EOT, like in MO files.
            $key = !$this->context
                ? $this->singular
                : $this->context . "\4" . $this->singular;
            // Standardize on \n line endings.
            $key = str_replace(["\r\n", "\r"], "\n", $key);

            return $key;
        }

        /**
         * Merges another translation entry with the current one.
         *
         * @since 2.8.0
         *
         * @param Translation_Entry $other Other translation entry.
         */
        public function merge_with(&$other)
        {
            $this->flags = array_unique(
                array_merge($this->flags, $other->flags)
            );
            $this->references = array_unique(
                array_merge($this->references, $other->references)
            );
            if ($this->extracted_comments !== $other->extracted_comments) {
                $this->extracted_comments .= $other->extracted_comments;
            }
        }
    }
endif;
