<?php return [
    "archives" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/archives",
        "title" => "Archives",
        "category" => "widgets",
        "description" => "Display a date archive of your posts.",
        "textdomain" => "default",
        "attributes" => [
            "displayAsDropdown" => [
                "type" => "boolean",
                "default" => false,
            ],
            "showLabel" => [
                "type" => "boolean",
                "default" => true,
            ],
            "showPostCounts" => [
                "type" => "boolean",
                "default" => false,
            ],
            "type" => [
                "type" => "string",
                "default" => "monthly",
            ],
        ],
        "supports" => [
            "align" => true,
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-archives-editor",
    ],
    "audio" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/audio",
        "title" => "Audio",
        "category" => "media",
        "description" => "Embed a simple audio player.",
        "keywords" => ["music", "sound", "podcast", "recording"],
        "textdomain" => "default",
        "attributes" => [
            "blob" => [
                "type" => "string",
                "role" => "local",
            ],
            "src" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "audio",
                "attribute" => "src",
                "role" => "content",
            ],
            "caption" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "figcaption",
                "role" => "content",
            ],
            "id" => [
                "type" => "number",
                "role" => "content",
            ],
            "autoplay" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "audio",
                "attribute" => "autoplay",
            ],
            "loop" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "audio",
                "attribute" => "loop",
            ],
            "preload" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "audio",
                "attribute" => "preload",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => true,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-audio-editor",
        "style" => "wp-block-audio",
    ],
    "avatar" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/avatar",
        "title" => "Avatar",
        "category" => "theme",
        "description" => "Add a user’s avatar.",
        "textdomain" => "default",
        "attributes" => [
            "userId" => [
                "type" => "number",
            ],
            "size" => [
                "type" => "number",
                "default" => 96,
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => false,
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
            ],
        ],
        "usesContext" => ["postType", "postId", "commentId"],
        "supports" => [
            "html" => false,
            "align" => true,
            "alignWide" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "__experimentalBorder" => [
                "__experimentalSkipSerialization" => true,
                "radius" => true,
                "width" => true,
                "color" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                ],
            ],
            "color" => [
                "text" => false,
                "background" => false,
                "__experimentalDuotone" => "img",
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "selectors" => [
            "border" => ".wp-block-avatar img",
        ],
        "editorStyle" => "wp-block-avatar-editor",
        "style" => "wp-block-avatar",
    ],
    "block" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/block",
        "title" => "Pattern",
        "category" => "reusable",
        "description" => "Reuse this design across your site.",
        "keywords" => ["reusable"],
        "textdomain" => "default",
        "attributes" => [
            "ref" => [
                "type" => "number",
            ],
            "content" => [
                "type" => "object",
                "default" => [],
            ],
        ],
        "providesContext" => [
            "pattern/overrides" => "content",
        ],
        "supports" => [
            "customClassName" => false,
            "html" => false,
            "inserter" => false,
            "renaming" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "button" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/button",
        "title" => "Button",
        "category" => "design",
        "parent" => ["core/buttons"],
        "description" =>
            "Prompt visitors to take action with a button-style link.",
        "keywords" => ["link"],
        "textdomain" => "default",
        "attributes" => [
            "tagName" => [
                "type" => "string",
                "enum" => ["a", "button"],
                "default" => "a",
            ],
            "type" => [
                "type" => "string",
                "default" => "button",
            ],
            "textAlign" => [
                "type" => "string",
            ],
            "url" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a",
                "attribute" => "href",
                "role" => "content",
            ],
            "title" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a,button",
                "attribute" => "title",
                "role" => "content",
            ],
            "text" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "a,button",
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a",
                "attribute" => "target",
                "role" => "content",
            ],
            "rel" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a",
                "attribute" => "rel",
                "role" => "content",
            ],
            "placeholder" => [
                "type" => "string",
            ],
            "backgroundColor" => [
                "type" => "string",
            ],
            "textColor" => [
                "type" => "string",
            ],
            "gradient" => [
                "type" => "string",
            ],
            "width" => [
                "type" => "number",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "splitting" => true,
            "align" => false,
            "alignWide" => false,
            "color" => [
                "__experimentalSkipSerialization" => true,
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "typography" => [
                "__experimentalSkipSerialization" => [
                    "fontSize",
                    "lineHeight",
                    "fontFamily",
                    "fontWeight",
                    "fontStyle",
                    "textTransform",
                    "textDecoration",
                    "letterSpacing",
                ],
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "reusable" => false,
            "shadow" => [
                "__experimentalSkipSerialization" => true,
            ],
            "spacing" => [
                "__experimentalSkipSerialization" => true,
                "padding" => ["horizontal", "vertical"],
                "__experimentalDefaultControls" => [
                    "padding" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalSkipSerialization" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "styles" => [
            [
                "name" => "fill",
                "label" => "Fill",
                "isDefault" => true,
            ],
            [
                "name" => "outline",
                "label" => "Outline",
            ],
        ],
        "editorStyle" => "wp-block-button-editor",
        "style" => "wp-block-button",
        "selectors" => [
            "root" => ".wp-block-button .wp-block-button__link",
            "typography" => [
                "writingMode" => ".wp-block-button",
            ],
        ],
    ],
    "buttons" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/buttons",
        "title" => "Buttons",
        "category" => "design",
        "allowedBlocks" => ["core/button"],
        "description" =>
            "Prompt visitors to take action with a group of button-style links.",
        "keywords" => ["link"],
        "textdomain" => "default",
        "supports" => [
            "anchor" => true,
            "align" => ["wide", "full"],
            "html" => false,
            "__experimentalExposeControlsToChildren" => true,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "spacing" => [
                "blockGap" => ["horizontal", "vertical"],
                "padding" => true,
                "margin" => ["top", "bottom"],
                "__experimentalDefaultControls" => [
                    "blockGap" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "default" => [
                    "type" => "flex",
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-buttons-editor",
        "style" => "wp-block-buttons",
    ],
    "calendar" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/calendar",
        "title" => "Calendar",
        "category" => "widgets",
        "description" => "A calendar of your site’s posts.",
        "keywords" => ["posts", "archive"],
        "textdomain" => "default",
        "attributes" => [
            "month" => [
                "type" => "integer",
            ],
            "year" => [
                "type" => "integer",
            ],
        ],
        "supports" => [
            "align" => true,
            "color" => [
                "link" => true,
                "__experimentalSkipSerialization" => ["text", "background"],
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
                "__experimentalSelector" => "table, th",
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-calendar",
    ],
    "categories" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/categories",
        "title" => "Terms List",
        "category" => "widgets",
        "description" => "Display a list of all terms of a given taxonomy.",
        "keywords" => ["categories"],
        "textdomain" => "default",
        "attributes" => [
            "taxonomy" => [
                "type" => "string",
                "default" => "category",
            ],
            "displayAsDropdown" => [
                "type" => "boolean",
                "default" => false,
            ],
            "showHierarchy" => [
                "type" => "boolean",
                "default" => false,
            ],
            "showPostCounts" => [
                "type" => "boolean",
                "default" => false,
            ],
            "showOnlyTopLevel" => [
                "type" => "boolean",
                "default" => false,
            ],
            "showEmpty" => [
                "type" => "boolean",
                "default" => false,
            ],
            "label" => [
                "type" => "string",
                "role" => "content",
            ],
            "showLabel" => [
                "type" => "boolean",
                "default" => true,
            ],
        ],
        "usesContext" => ["enhancedPagination"],
        "supports" => [
            "align" => true,
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "editorStyle" => "wp-block-categories-editor",
        "style" => "wp-block-categories",
    ],
    "code" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/code",
        "title" => "Code",
        "category" => "text",
        "description" =>
            "Display code snippets that respect your spacing and tabs.",
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "code",
                "__unstablePreserveWhiteSpace" => true,
            ],
        ],
        "supports" => [
            "align" => ["wide"],
            "anchor" => true,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "spacing" => [
                "margin" => ["top", "bottom"],
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "width" => true,
                    "color" => true,
                ],
            ],
            "color" => [
                "text" => true,
                "background" => true,
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-code",
    ],
    "column" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/column",
        "title" => "Column",
        "category" => "design",
        "parent" => ["core/columns"],
        "description" => "A single column within a columns block.",
        "textdomain" => "default",
        "attributes" => [
            "verticalAlignment" => [
                "type" => "string",
            ],
            "width" => [
                "type" => "string",
            ],
            "allowedBlocks" => [
                "type" => "array",
            ],
            "templateLock" => [
                "type" => ["string", "boolean"],
                "enum" => ["all", "insert", "contentOnly", false],
            ],
        ],
        "supports" => [
            "__experimentalOnEnter" => true,
            "anchor" => true,
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "heading" => true,
                "button" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "shadow" => true,
            "spacing" => [
                "blockGap" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "padding" => true,
                    "blockGap" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "layout" => true,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "columns" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/columns",
        "title" => "Columns",
        "category" => "design",
        "allowedBlocks" => ["core/column"],
        "description" =>
            "Display content in multiple columns, with blocks added to each column.",
        "textdomain" => "default",
        "attributes" => [
            "verticalAlignment" => [
                "type" => "string",
            ],
            "isStackedOnMobile" => [
                "type" => "boolean",
                "default" => true,
            ],
            "templateLock" => [
                "type" => ["string", "boolean"],
                "enum" => ["all", "insert", "contentOnly", false],
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "heading" => true,
                "button" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "blockGap" => [
                    "__experimentalDefault" => "2em",
                    "sides" => ["horizontal", "vertical"],
                ],
                "margin" => ["top", "bottom"],
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "padding" => true,
                    "blockGap" => true,
                ],
            ],
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "allowEditing" => false,
                "default" => [
                    "type" => "flex",
                    "flexWrap" => "nowrap",
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "shadow" => true,
        ],
        "editorStyle" => "wp-block-columns-editor",
        "style" => "wp-block-columns",
    ],
    "comment-author-name" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comment-author-name",
        "title" => "Comment Author Name",
        "category" => "theme",
        "ancestor" => ["core/comment-template"],
        "description" => "Displays the name of the author of the comment.",
        "textdomain" => "default",
        "attributes" => [
            "isLink" => [
                "type" => "boolean",
                "default" => true,
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
            ],
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["commentId"],
        "supports" => [
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-comment-author-name",
    ],
    "comment-content" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comment-content",
        "title" => "Comment Content",
        "category" => "theme",
        "ancestor" => ["core/comment-template"],
        "description" => "Displays the contents of a comment.",
        "textdomain" => "default",
        "usesContext" => ["commentId"],
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
            "spacing" => [
                "padding" => ["horizontal", "vertical"],
                "__experimentalDefaultControls" => [
                    "padding" => true,
                ],
            ],
            "html" => false,
        ],
        "style" => "wp-block-comment-content",
    ],
    "comment-date" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comment-date",
        "title" => "Comment Date",
        "category" => "theme",
        "ancestor" => ["core/comment-template"],
        "description" => "Displays the date on which the comment was posted.",
        "textdomain" => "default",
        "attributes" => [
            "format" => [
                "type" => "string",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => true,
            ],
        ],
        "usesContext" => ["commentId"],
        "supports" => [
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-comment-date",
    ],
    "comment-edit-link" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comment-edit-link",
        "title" => "Comment Edit Link",
        "category" => "theme",
        "ancestor" => ["core/comment-template"],
        "description" =>
            "Displays a link to edit the comment in the WordPress Dashboard. This link is only visible to users with the edit comment capability.",
        "textdomain" => "default",
        "usesContext" => ["commentId"],
        "attributes" => [
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
            ],
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "html" => false,
            "color" => [
                "link" => true,
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
        ],
        "style" => "wp-block-comment-edit-link",
    ],
    "comment-reply-link" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comment-reply-link",
        "title" => "Comment Reply Link",
        "category" => "theme",
        "ancestor" => ["core/comment-template"],
        "description" => "Displays a link to reply to a comment.",
        "textdomain" => "default",
        "usesContext" => ["commentId"],
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "color" => [
                "gradients" => true,
                "link" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "html" => false,
        ],
        "style" => "wp-block-comment-reply-link",
    ],
    "comment-template" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comment-template",
        "title" => "Comment Template",
        "category" => "design",
        "parent" => ["core/comments"],
        "description" =>
            "Contains the block elements used to display a comment, like the title, date, author, avatar and more.",
        "textdomain" => "default",
        "usesContext" => ["postId"],
        "supports" => [
            "align" => true,
            "html" => false,
            "reusable" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-comment-template",
    ],
    "comments" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comments",
        "title" => "Comments",
        "category" => "theme",
        "description" =>
            "An advanced block that allows displaying post comments using different visual configurations.",
        "textdomain" => "default",
        "attributes" => [
            "tagName" => [
                "type" => "string",
                "default" => "div",
            ],
            "legacy" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "gradients" => true,
                "heading" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "editorStyle" => "wp-block-comments-editor",
        "usesContext" => ["postId", "postType"],
    ],
    "comments-pagination" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comments-pagination",
        "title" => "Comments Pagination",
        "category" => "theme",
        "parent" => ["core/comments"],
        "allowedBlocks" => [
            "core/comments-pagination-previous",
            "core/comments-pagination-numbers",
            "core/comments-pagination-next",
        ],
        "description" =>
            "Displays a paginated navigation to next/previous set of comments, when applicable.",
        "textdomain" => "default",
        "attributes" => [
            "paginationArrow" => [
                "type" => "string",
                "default" => "none",
            ],
        ],
        "example" => [
            "attributes" => [
                "paginationArrow" => "none",
            ],
        ],
        "providesContext" => [
            "comments/paginationArrow" => "paginationArrow",
        ],
        "supports" => [
            "align" => true,
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "default" => [
                    "type" => "flex",
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-comments-pagination-editor",
        "style" => "wp-block-comments-pagination",
    ],
    "comments-pagination-next" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comments-pagination-next",
        "title" => "Comments Next Page",
        "category" => "theme",
        "parent" => ["core/comments-pagination"],
        "description" => 'Displays the next comment\'s page link.',
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["postId", "comments/paginationArrow"],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "comments-pagination-numbers" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comments-pagination-numbers",
        "title" => "Comments Page Numbers",
        "category" => "theme",
        "parent" => ["core/comments-pagination"],
        "description" =>
            "Displays a list of page numbers for comments pagination.",
        "textdomain" => "default",
        "usesContext" => ["postId"],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "comments-pagination-previous" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comments-pagination-previous",
        "title" => "Comments Previous Page",
        "category" => "theme",
        "parent" => ["core/comments-pagination"],
        "description" => 'Displays the previous comment\'s page link.',
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["postId", "comments/paginationArrow"],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "comments-title" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/comments-title",
        "title" => "Comments Title",
        "category" => "theme",
        "ancestor" => ["core/comments"],
        "description" => "Displays a title with the number of comments.",
        "textdomain" => "default",
        "usesContext" => ["postId", "postType"],
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "showPostTitle" => [
                "type" => "boolean",
                "default" => true,
            ],
            "showCommentsCount" => [
                "type" => "boolean",
                "default" => true,
            ],
            "level" => [
                "type" => "number",
                "default" => 2,
            ],
            "levelOptions" => [
                "type" => "array",
            ],
        ],
        "supports" => [
            "anchor" => false,
            "align" => true,
            "html" => false,
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "color" => [
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                    "__experimentalFontFamily" => true,
                    "__experimentalFontStyle" => true,
                    "__experimentalFontWeight" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "cover" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/cover",
        "title" => "Cover",
        "category" => "media",
        "description" => "Add an image or video with a text overlay.",
        "textdomain" => "default",
        "attributes" => [
            "url" => [
                "type" => "string",
            ],
            "useFeaturedImage" => [
                "type" => "boolean",
                "default" => false,
            ],
            "id" => [
                "type" => "number",
            ],
            "alt" => [
                "type" => "string",
                "default" => "",
            ],
            "hasParallax" => [
                "type" => "boolean",
                "default" => false,
            ],
            "isRepeated" => [
                "type" => "boolean",
                "default" => false,
            ],
            "dimRatio" => [
                "type" => "number",
                "default" => 100,
            ],
            "overlayColor" => [
                "type" => "string",
            ],
            "customOverlayColor" => [
                "type" => "string",
            ],
            "isUserOverlayColor" => [
                "type" => "boolean",
            ],
            "backgroundType" => [
                "type" => "string",
                "default" => "image",
            ],
            "focalPoint" => [
                "type" => "object",
            ],
            "minHeight" => [
                "type" => "number",
            ],
            "minHeightUnit" => [
                "type" => "string",
            ],
            "gradient" => [
                "type" => "string",
            ],
            "customGradient" => [
                "type" => "string",
            ],
            "contentPosition" => [
                "type" => "string",
            ],
            "isDark" => [
                "type" => "boolean",
                "default" => true,
            ],
            "allowedBlocks" => [
                "type" => "array",
            ],
            "templateLock" => [
                "type" => ["string", "boolean"],
                "enum" => ["all", "insert", "contentOnly", false],
            ],
            "tagName" => [
                "type" => "string",
                "default" => "div",
            ],
            "sizeSlug" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["postId", "postType"],
        "supports" => [
            "anchor" => true,
            "align" => true,
            "html" => false,
            "shadow" => true,
            "spacing" => [
                "padding" => true,
                "margin" => ["top", "bottom"],
                "blockGap" => true,
                "__experimentalDefaultControls" => [
                    "padding" => true,
                    "blockGap" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "color" => [
                "__experimentalDuotone" =>
                    "> .wp-block-cover__image-background, > .wp-block-cover__video-background",
                "heading" => true,
                "text" => true,
                "background" => false,
                "__experimentalSkipSerialization" => ["gradients"],
                "enableContrastChecker" => false,
            ],
            "dimensions" => [
                "aspectRatio" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "layout" => [
                "allowJustification" => false,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-cover-editor",
        "style" => "wp-block-cover",
    ],
    "details" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/details",
        "title" => "Details",
        "category" => "text",
        "description" => "Hide and show additional content.",
        "keywords" => ["accordion", "summary", "toggle", "disclosure"],
        "textdomain" => "default",
        "attributes" => [
            "showContent" => [
                "type" => "boolean",
                "default" => false,
            ],
            "summary" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "summary",
            ],
            "name" => [
                "type" => "string",
                "source" => "attribute",
                "attribute" => "name",
                "selector" => ".wp-block-details",
            ],
            "allowedBlocks" => [
                "type" => "array",
            ],
            "placeholder" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "__experimentalOnEnter" => true,
            "align" => ["wide", "full"],
            "anchor" => true,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "blockGap" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "layout" => [
                "allowEditing" => false,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-details-editor",
        "style" => "wp-block-details",
    ],
    "embed" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/embed",
        "title" => "Embed",
        "category" => "embed",
        "description" =>
            "Add a block that displays content pulled from other sites, like Twitter or YouTube.",
        "textdomain" => "default",
        "attributes" => [
            "url" => [
                "type" => "string",
                "role" => "content",
            ],
            "caption" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "figcaption",
                "role" => "content",
            ],
            "type" => [
                "type" => "string",
                "role" => "content",
            ],
            "providerNameSlug" => [
                "type" => "string",
                "role" => "content",
            ],
            "allowResponsive" => [
                "type" => "boolean",
                "default" => true,
            ],
            "responsive" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "previewable" => [
                "type" => "boolean",
                "default" => true,
                "role" => "content",
            ],
        ],
        "supports" => [
            "align" => true,
            "spacing" => [
                "margin" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-embed-editor",
        "style" => "wp-block-embed",
    ],
    "file" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/file",
        "title" => "File",
        "category" => "media",
        "description" => "Add a link to a downloadable file.",
        "keywords" => ["document", "pdf", "download"],
        "textdomain" => "default",
        "attributes" => [
            "id" => [
                "type" => "number",
            ],
            "blob" => [
                "type" => "string",
                "role" => "local",
            ],
            "href" => [
                "type" => "string",
                "role" => "content",
            ],
            "fileId" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a:not([download])",
                "attribute" => "id",
            ],
            "fileName" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "a:not([download])",
                "role" => "content",
            ],
            "textLinkHref" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a:not([download])",
                "attribute" => "href",
                "role" => "content",
            ],
            "textLinkTarget" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "a:not([download])",
                "attribute" => "target",
            ],
            "showDownloadButton" => [
                "type" => "boolean",
                "default" => true,
            ],
            "downloadButtonText" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "a[download]",
                "role" => "content",
            ],
            "displayPreview" => [
                "type" => "boolean",
            ],
            "previewHeight" => [
                "type" => "number",
                "default" => 600,
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => true,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "link" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
            "interactivity" => true,
        ],
        "editorStyle" => "wp-block-file-editor",
        "style" => "wp-block-file",
    ],
    "footnotes" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/footnotes",
        "title" => "Footnotes",
        "category" => "text",
        "description" => "Display footnotes added to the page.",
        "keywords" => ["references"],
        "textdomain" => "default",
        "usesContext" => ["postId", "postType"],
        "supports" => [
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => false,
                    "color" => false,
                    "width" => false,
                    "style" => false,
                ],
            ],
            "color" => [
                "background" => true,
                "link" => true,
                "text" => true,
                "__experimentalDefaultControls" => [
                    "link" => true,
                    "text" => true,
                ],
            ],
            "html" => false,
            "multiple" => false,
            "reusable" => false,
            "inserter" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-footnotes",
    ],
    "freeform" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/freeform",
        "title" => "Classic",
        "category" => "text",
        "description" => "Use the classic WordPress editor.",
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "string",
                "source" => "raw",
            ],
        ],
        "supports" => [
            "className" => false,
            "customClassName" => false,
            "reusable" => false,
        ],
        "editorStyle" => "wp-block-freeform-editor",
    ],
    "gallery" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/gallery",
        "title" => "Gallery",
        "category" => "media",
        "allowedBlocks" => ["core/image"],
        "description" => "Display multiple images in a rich gallery.",
        "keywords" => ["images", "photos"],
        "textdomain" => "default",
        "attributes" => [
            "images" => [
                "type" => "array",
                "default" => [],
                "source" => "query",
                "selector" => ".blocks-gallery-item",
                "query" => [
                    "url" => [
                        "type" => "string",
                        "source" => "attribute",
                        "selector" => "img",
                        "attribute" => "src",
                    ],
                    "fullUrl" => [
                        "type" => "string",
                        "source" => "attribute",
                        "selector" => "img",
                        "attribute" => "data-full-url",
                    ],
                    "link" => [
                        "type" => "string",
                        "source" => "attribute",
                        "selector" => "img",
                        "attribute" => "data-link",
                    ],
                    "alt" => [
                        "type" => "string",
                        "source" => "attribute",
                        "selector" => "img",
                        "attribute" => "alt",
                        "default" => "",
                    ],
                    "id" => [
                        "type" => "string",
                        "source" => "attribute",
                        "selector" => "img",
                        "attribute" => "data-id",
                    ],
                    "caption" => [
                        "type" => "rich-text",
                        "source" => "rich-text",
                        "selector" => ".blocks-gallery-item__caption",
                    ],
                ],
            ],
            "ids" => [
                "type" => "array",
                "items" => [
                    "type" => "number",
                ],
                "default" => [],
            ],
            "shortCodeTransforms" => [
                "type" => "array",
                "items" => [
                    "type" => "object",
                ],
                "default" => [],
            ],
            "columns" => [
                "type" => "number",
                "minimum" => 1,
                "maximum" => 8,
            ],
            "caption" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => ".blocks-gallery-caption",
            ],
            "imageCrop" => [
                "type" => "boolean",
                "default" => true,
            ],
            "randomOrder" => [
                "type" => "boolean",
                "default" => false,
            ],
            "fixedHeight" => [
                "type" => "boolean",
                "default" => true,
            ],
            "linkTarget" => [
                "type" => "string",
            ],
            "linkTo" => [
                "type" => "string",
            ],
            "sizeSlug" => [
                "type" => "string",
                "default" => "large",
            ],
            "allowResize" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "providesContext" => [
            "allowResize" => "allowResize",
            "imageCrop" => "imageCrop",
            "fixedHeight" => "fixedHeight",
        ],
        "supports" => [
            "anchor" => true,
            "align" => true,
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                ],
            ],
            "html" => false,
            "units" => ["px", "em", "rem", "vh", "vw"],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "blockGap" => ["horizontal", "vertical"],
                "__experimentalSkipSerialization" => ["blockGap"],
                "__experimentalDefaultControls" => [
                    "blockGap" => true,
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "color" => [
                "text" => false,
                "background" => true,
                "gradients" => true,
            ],
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "allowEditing" => false,
                "default" => [
                    "type" => "flex",
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-gallery-editor",
        "style" => "wp-block-gallery",
    ],
    "group" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/group",
        "title" => "Group",
        "category" => "design",
        "description" => "Gather blocks in a layout container.",
        "keywords" => ["container", "wrapper", "row", "section"],
        "textdomain" => "default",
        "attributes" => [
            "tagName" => [
                "type" => "string",
                "default" => "div",
            ],
            "templateLock" => [
                "type" => ["string", "boolean"],
                "enum" => ["all", "insert", "contentOnly", false],
            ],
            "allowedBlocks" => [
                "type" => "array",
            ],
        ],
        "supports" => [
            "__experimentalOnEnter" => true,
            "__experimentalOnMerge" => true,
            "__experimentalSettings" => true,
            "align" => ["wide", "full"],
            "anchor" => true,
            "ariaLabel" => true,
            "html" => false,
            "background" => [
                "backgroundImage" => true,
                "backgroundSize" => true,
                "__experimentalDefaultControls" => [
                    "backgroundImage" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "heading" => true,
                "button" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "shadow" => true,
            "spacing" => [
                "margin" => ["top", "bottom"],
                "padding" => true,
                "blockGap" => true,
                "__experimentalDefaultControls" => [
                    "padding" => true,
                    "blockGap" => true,
                ],
            ],
            "dimensions" => [
                "minHeight" => true,
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "position" => [
                "sticky" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "layout" => [
                "allowSizingOnChildren" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-group-editor",
        "style" => "wp-block-group",
    ],
    "heading" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/heading",
        "title" => "Heading",
        "category" => "text",
        "description" =>
            "Introduce new sections and organize content to help visitors (and search engines) understand the structure of your content.",
        "keywords" => ["title", "subtitle"],
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "content" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "h1,h2,h3,h4,h5,h6",
                "role" => "content",
            ],
            "level" => [
                "type" => "number",
                "default" => 2,
            ],
            "levelOptions" => [
                "type" => "array",
            ],
            "placeholder" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "anchor" => true,
            "className" => true,
            "splitting" => true,
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__unstablePasteTextInline" => true,
            "__experimentalSlashInserter" => true,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-heading-editor",
        "style" => "wp-block-heading",
    ],
    "home-link" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/home-link",
        "category" => "design",
        "parent" => ["core/navigation"],
        "title" => "Home Link",
        "description" =>
            "Create a link that always points to the homepage of the site. Usually not necessary if there is already a site title link present in the header.",
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
        ],
        "usesContext" => [
            "textColor",
            "customTextColor",
            "backgroundColor",
            "customBackgroundColor",
            "fontSize",
            "customFontSize",
            "style",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-home-link-editor",
        "style" => "wp-block-home-link",
    ],
    "html" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/html",
        "title" => "Custom HTML",
        "category" => "widgets",
        "description" => "Add custom HTML code and preview it as you edit.",
        "keywords" => ["embed"],
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "string",
                "source" => "raw",
            ],
        ],
        "supports" => [
            "customClassName" => false,
            "className" => false,
            "html" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-html-editor",
    ],
    "image" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/image",
        "title" => "Image",
        "category" => "media",
        "usesContext" => [
            "allowResize",
            "imageCrop",
            "fixedHeight",
            "postId",
            "postType",
            "queryId",
        ],
        "description" => "Insert an image to make a visual statement.",
        "keywords" => ["img", "photo", "picture"],
        "textdomain" => "default",
        "attributes" => [
            "blob" => [
                "type" => "string",
                "role" => "local",
            ],
            "url" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "img",
                "attribute" => "src",
                "role" => "content",
            ],
            "alt" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "img",
                "attribute" => "alt",
                "default" => "",
                "role" => "content",
            ],
            "caption" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "figcaption",
                "role" => "content",
            ],
            "lightbox" => [
                "type" => "object",
                "enabled" => [
                    "type" => "boolean",
                ],
            ],
            "title" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "img",
                "attribute" => "title",
                "role" => "content",
            ],
            "href" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure > a",
                "attribute" => "href",
                "role" => "content",
            ],
            "rel" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure > a",
                "attribute" => "rel",
            ],
            "linkClass" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure > a",
                "attribute" => "class",
            ],
            "id" => [
                "type" => "number",
                "role" => "content",
            ],
            "width" => [
                "type" => "string",
            ],
            "height" => [
                "type" => "string",
            ],
            "aspectRatio" => [
                "type" => "string",
            ],
            "scale" => [
                "type" => "string",
            ],
            "sizeSlug" => [
                "type" => "string",
            ],
            "linkDestination" => [
                "type" => "string",
            ],
            "linkTarget" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure > a",
                "attribute" => "target",
            ],
        ],
        "supports" => [
            "interactivity" => true,
            "align" => ["left", "center", "right", "wide", "full"],
            "anchor" => true,
            "color" => [
                "text" => false,
                "background" => false,
            ],
            "filter" => [
                "duotone" => true,
            ],
            "spacing" => [
                "margin" => true,
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "width" => true,
                "__experimentalSkipSerialization" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "width" => true,
                ],
            ],
            "shadow" => [
                "__experimentalSkipSerialization" => true,
            ],
        ],
        "selectors" => [
            "border" =>
                ".wp-block-image img, .wp-block-image .wp-block-image__crop-area, .wp-block-image .components-placeholder",
            "shadow" =>
                ".wp-block-image img, .wp-block-image .wp-block-image__crop-area, .wp-block-image .components-placeholder",
            "filter" => [
                "duotone" =>
                    ".wp-block-image img, .wp-block-image .components-placeholder",
            ],
        ],
        "styles" => [
            [
                "name" => "default",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "rounded",
                "label" => "Rounded",
            ],
        ],
        "editorStyle" => "wp-block-image-editor",
        "style" => "wp-block-image",
    ],
    "latest-comments" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/latest-comments",
        "title" => "Latest Comments",
        "category" => "widgets",
        "description" => "Display a list of your most recent comments.",
        "keywords" => ["recent comments"],
        "textdomain" => "default",
        "attributes" => [
            "commentsToShow" => [
                "type" => "number",
                "default" => 5,
                "minimum" => 1,
                "maximum" => 100,
            ],
            "displayAvatar" => [
                "type" => "boolean",
                "default" => true,
            ],
            "displayDate" => [
                "type" => "boolean",
                "default" => true,
            ],
            "displayExcerpt" => [
                "type" => "boolean",
                "default" => true,
            ],
        ],
        "supports" => [
            "align" => true,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-latest-comments-editor",
        "style" => "wp-block-latest-comments",
    ],
    "latest-posts" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/latest-posts",
        "title" => "Latest Posts",
        "category" => "widgets",
        "description" => "Display a list of your most recent posts.",
        "keywords" => ["recent posts"],
        "textdomain" => "default",
        "attributes" => [
            "categories" => [
                "type" => "array",
                "items" => [
                    "type" => "object",
                ],
            ],
            "selectedAuthor" => [
                "type" => "number",
            ],
            "postsToShow" => [
                "type" => "number",
                "default" => 5,
            ],
            "displayPostContent" => [
                "type" => "boolean",
                "default" => false,
            ],
            "displayPostContentRadio" => [
                "type" => "string",
                "default" => "excerpt",
            ],
            "excerptLength" => [
                "type" => "number",
                "default" => 55,
            ],
            "displayAuthor" => [
                "type" => "boolean",
                "default" => false,
            ],
            "displayPostDate" => [
                "type" => "boolean",
                "default" => false,
            ],
            "postLayout" => [
                "type" => "string",
                "default" => "list",
            ],
            "columns" => [
                "type" => "number",
                "default" => 3,
            ],
            "order" => [
                "type" => "string",
                "default" => "desc",
            ],
            "orderBy" => [
                "type" => "string",
                "default" => "date",
            ],
            "displayFeaturedImage" => [
                "type" => "boolean",
                "default" => false,
            ],
            "featuredImageAlign" => [
                "type" => "string",
                "enum" => ["left", "center", "right"],
            ],
            "featuredImageSizeSlug" => [
                "type" => "string",
                "default" => "thumbnail",
            ],
            "featuredImageSizeWidth" => [
                "type" => "number",
                "default" => null,
            ],
            "featuredImageSizeHeight" => [
                "type" => "number",
                "default" => null,
            ],
            "addLinkToFeaturedImage" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "supports" => [
            "align" => true,
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-latest-posts-editor",
        "style" => "wp-block-latest-posts",
    ],
    "legacy-widget" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/legacy-widget",
        "title" => "Legacy Widget",
        "category" => "widgets",
        "description" => "Display a legacy widget.",
        "textdomain" => "default",
        "attributes" => [
            "id" => [
                "type" => "string",
                "default" => null,
            ],
            "idBase" => [
                "type" => "string",
                "default" => null,
            ],
            "instance" => [
                "type" => "object",
                "default" => null,
            ],
        ],
        "supports" => [
            "html" => false,
            "customClassName" => false,
            "reusable" => false,
        ],
        "editorStyle" => "wp-block-legacy-widget-editor",
    ],
    "list" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/list",
        "title" => "List",
        "category" => "text",
        "allowedBlocks" => ["core/list-item"],
        "description" =>
            "An organized collection of items displayed in a specific order.",
        "keywords" => ["bullet list", "ordered list", "numbered list"],
        "textdomain" => "default",
        "attributes" => [
            "ordered" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "values" => [
                "type" => "string",
                "source" => "html",
                "selector" => "ol,ul",
                "multiline" => "li",
                "__unstableMultilineWrapperTags" => ["ol", "ul"],
                "default" => "",
                "role" => "content",
            ],
            "type" => [
                "type" => "string",
            ],
            "start" => [
                "type" => "number",
            ],
            "reversed" => [
                "type" => "boolean",
            ],
            "placeholder" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "html" => false,
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "__unstablePasteTextInline" => true,
            "__experimentalOnMerge" => true,
            "__experimentalSlashInserter" => true,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "selectors" => [
            "border" => ".wp-block-list:not(.wp-block-list .wp-block-list)",
        ],
        "editorStyle" => "wp-block-list-editor",
        "style" => "wp-block-list",
    ],
    "list-item" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/list-item",
        "title" => "List Item",
        "category" => "text",
        "parent" => ["core/list"],
        "allowedBlocks" => ["core/list"],
        "description" => "An individual item within a list.",
        "textdomain" => "default",
        "attributes" => [
            "placeholder" => [
                "type" => "string",
            ],
            "content" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "li",
                "role" => "content",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "className" => false,
            "splitting" => true,
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "background" => true,
                "__experimentalDefaultControls" => [
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "selectors" => [
            "root" => ".wp-block-list > li",
            "border" =>
                ".wp-block-list:not(.wp-block-list .wp-block-list) > li",
        ],
    ],
    "loginout" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/loginout",
        "title" => "Login/out",
        "category" => "theme",
        "description" => "Show login & logout links.",
        "keywords" => ["login", "logout", "form"],
        "textdomain" => "default",
        "attributes" => [
            "displayLoginAsForm" => [
                "type" => "boolean",
                "default" => false,
            ],
            "redirectToCurrent" => [
                "type" => "boolean",
                "default" => true,
            ],
        ],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "className" => true,
            "color" => [
                "background" => true,
                "text" => false,
                "gradients" => true,
                "link" => true,
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-loginout",
    ],
    "media-text" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/media-text",
        "title" => "Media & Text",
        "category" => "media",
        "description" =>
            "Set media and words side-by-side for a richer layout.",
        "keywords" => ["image", "video"],
        "textdomain" => "default",
        "attributes" => [
            "align" => [
                "type" => "string",
                "default" => "none",
            ],
            "mediaAlt" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure img",
                "attribute" => "alt",
                "default" => "",
                "role" => "content",
            ],
            "mediaPosition" => [
                "type" => "string",
                "default" => "left",
            ],
            "mediaId" => [
                "type" => "number",
                "role" => "content",
            ],
            "mediaUrl" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure video,figure img",
                "attribute" => "src",
                "role" => "content",
            ],
            "mediaLink" => [
                "type" => "string",
            ],
            "linkDestination" => [
                "type" => "string",
            ],
            "linkTarget" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure a",
                "attribute" => "target",
            ],
            "href" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure a",
                "attribute" => "href",
                "role" => "content",
            ],
            "rel" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure a",
                "attribute" => "rel",
            ],
            "linkClass" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "figure a",
                "attribute" => "class",
            ],
            "mediaType" => [
                "type" => "string",
                "role" => "content",
            ],
            "mediaWidth" => [
                "type" => "number",
                "default" => 50,
            ],
            "mediaSizeSlug" => [
                "type" => "string",
            ],
            "isStackedOnMobile" => [
                "type" => "boolean",
                "default" => true,
            ],
            "verticalAlignment" => [
                "type" => "string",
            ],
            "imageFill" => [
                "type" => "boolean",
            ],
            "focalPoint" => [
                "type" => "object",
            ],
            "allowedBlocks" => [
                "type" => "array",
            ],
            "useFeaturedImage" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "usesContext" => ["postId", "postType"],
        "supports" => [
            "anchor" => true,
            "align" => ["wide", "full"],
            "html" => false,
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "heading" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-media-text-editor",
        "style" => "wp-block-media-text",
    ],
    "missing" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/missing",
        "title" => "Unsupported",
        "category" => "text",
        "description" => "Your site doesn’t include support for this block.",
        "textdomain" => "default",
        "attributes" => [
            "originalName" => [
                "type" => "string",
            ],
            "originalUndelimitedContent" => [
                "type" => "string",
            ],
            "originalContent" => [
                "type" => "string",
                "source" => "raw",
            ],
        ],
        "supports" => [
            "className" => false,
            "customClassName" => false,
            "inserter" => false,
            "html" => false,
            "reusable" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "more" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/more",
        "title" => "More",
        "category" => "design",
        "description" =>
            "Content before this block will be shown in the excerpt on your archives page.",
        "keywords" => ["read more"],
        "textdomain" => "default",
        "attributes" => [
            "customText" => [
                "type" => "string",
                "default" => "",
            ],
            "noTeaser" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "supports" => [
            "customClassName" => false,
            "className" => false,
            "html" => false,
            "multiple" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-more-editor",
    ],
    "navigation" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/navigation",
        "title" => "Navigation",
        "category" => "theme",
        "allowedBlocks" => [
            "core/navigation-link",
            "core/search",
            "core/social-links",
            "core/page-list",
            "core/spacer",
            "core/home-link",
            "core/site-title",
            "core/site-logo",
            "core/navigation-submenu",
            "core/loginout",
            "core/buttons",
        ],
        "description" =>
            "A collection of blocks that allow visitors to get around your site.",
        "keywords" => ["menu", "navigation", "links"],
        "textdomain" => "default",
        "attributes" => [
            "ref" => [
                "type" => "number",
            ],
            "textColor" => [
                "type" => "string",
            ],
            "customTextColor" => [
                "type" => "string",
            ],
            "rgbTextColor" => [
                "type" => "string",
            ],
            "backgroundColor" => [
                "type" => "string",
            ],
            "customBackgroundColor" => [
                "type" => "string",
            ],
            "rgbBackgroundColor" => [
                "type" => "string",
            ],
            "showSubmenuIcon" => [
                "type" => "boolean",
                "default" => true,
            ],
            "openSubmenusOnClick" => [
                "type" => "boolean",
                "default" => false,
            ],
            "overlayMenu" => [
                "type" => "string",
                "default" => "mobile",
            ],
            "icon" => [
                "type" => "string",
                "default" => "handle",
            ],
            "hasIcon" => [
                "type" => "boolean",
                "default" => true,
            ],
            "__unstableLocation" => [
                "type" => "string",
            ],
            "overlayBackgroundColor" => [
                "type" => "string",
            ],
            "customOverlayBackgroundColor" => [
                "type" => "string",
            ],
            "overlayTextColor" => [
                "type" => "string",
            ],
            "customOverlayTextColor" => [
                "type" => "string",
            ],
            "maxNestingLevel" => [
                "type" => "number",
                "default" => 5,
            ],
            "templateLock" => [
                "type" => ["string", "boolean"],
                "enum" => ["all", "insert", "contentOnly", false],
            ],
        ],
        "providesContext" => [
            "textColor" => "textColor",
            "customTextColor" => "customTextColor",
            "backgroundColor" => "backgroundColor",
            "customBackgroundColor" => "customBackgroundColor",
            "overlayTextColor" => "overlayTextColor",
            "customOverlayTextColor" => "customOverlayTextColor",
            "overlayBackgroundColor" => "overlayBackgroundColor",
            "customOverlayBackgroundColor" => "customOverlayBackgroundColor",
            "fontSize" => "fontSize",
            "customFontSize" => "customFontSize",
            "showSubmenuIcon" => "showSubmenuIcon",
            "openSubmenusOnClick" => "openSubmenusOnClick",
            "style" => "style",
            "maxNestingLevel" => "maxNestingLevel",
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "ariaLabel" => true,
            "html" => false,
            "inserter" => true,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalTextTransform" => true,
                "__experimentalFontFamily" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalSkipSerialization" => ["textDecoration"],
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "spacing" => [
                "blockGap" => true,
                "units" => ["px", "em", "rem", "vh", "vw"],
                "__experimentalDefaultControls" => [
                    "blockGap" => true,
                ],
            ],
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "allowVerticalAlignment" => false,
                "allowSizingOnChildren" => true,
                "default" => [
                    "type" => "flex",
                ],
            ],
            "interactivity" => true,
            "renaming" => false,
        ],
        "editorStyle" => "wp-block-navigation-editor",
        "style" => "wp-block-navigation",
    ],
    "navigation-link" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/navigation-link",
        "title" => "Custom Link",
        "category" => "design",
        "parent" => ["core/navigation"],
        "allowedBlocks" => [
            "core/navigation-link",
            "core/navigation-submenu",
            "core/page-list",
        ],
        "description" =>
            "Add a page, link, or another item to your navigation.",
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
            "type" => [
                "type" => "string",
            ],
            "description" => [
                "type" => "string",
            ],
            "rel" => [
                "type" => "string",
            ],
            "id" => [
                "type" => "number",
            ],
            "opensInNewTab" => [
                "type" => "boolean",
                "default" => false,
            ],
            "url" => [
                "type" => "string",
            ],
            "title" => [
                "type" => "string",
            ],
            "kind" => [
                "type" => "string",
            ],
            "isTopLevelLink" => [
                "type" => "boolean",
            ],
        ],
        "usesContext" => [
            "textColor",
            "customTextColor",
            "backgroundColor",
            "customBackgroundColor",
            "overlayTextColor",
            "customOverlayTextColor",
            "overlayBackgroundColor",
            "customOverlayBackgroundColor",
            "fontSize",
            "customFontSize",
            "showSubmenuIcon",
            "maxNestingLevel",
            "style",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "__experimentalSlashInserter" => true,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "renaming" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-navigation-link-editor",
        "style" => "wp-block-navigation-link",
    ],
    "navigation-submenu" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/navigation-submenu",
        "title" => "Submenu",
        "category" => "design",
        "parent" => ["core/navigation"],
        "description" => "Add a submenu to your navigation.",
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
            "type" => [
                "type" => "string",
            ],
            "description" => [
                "type" => "string",
            ],
            "rel" => [
                "type" => "string",
            ],
            "id" => [
                "type" => "number",
            ],
            "opensInNewTab" => [
                "type" => "boolean",
                "default" => false,
            ],
            "url" => [
                "type" => "string",
            ],
            "title" => [
                "type" => "string",
            ],
            "kind" => [
                "type" => "string",
            ],
            "isTopLevelItem" => [
                "type" => "boolean",
            ],
        ],
        "usesContext" => [
            "textColor",
            "customTextColor",
            "backgroundColor",
            "customBackgroundColor",
            "overlayTextColor",
            "customOverlayTextColor",
            "overlayBackgroundColor",
            "customOverlayBackgroundColor",
            "fontSize",
            "customFontSize",
            "showSubmenuIcon",
            "maxNestingLevel",
            "openSubmenusOnClick",
            "style",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-navigation-submenu-editor",
        "style" => "wp-block-navigation-submenu",
    ],
    "nextpage" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/nextpage",
        "title" => "Page Break",
        "category" => "design",
        "description" => "Separate your content into a multi-page experience.",
        "keywords" => ["next page", "pagination"],
        "parent" => ["core/post-content"],
        "textdomain" => "default",
        "supports" => [
            "customClassName" => false,
            "className" => false,
            "html" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-nextpage-editor",
    ],
    "page-list" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/page-list",
        "title" => "Page List",
        "category" => "widgets",
        "allowedBlocks" => ["core/page-list-item"],
        "description" => "Display a list of all pages.",
        "keywords" => ["menu", "navigation"],
        "textdomain" => "default",
        "attributes" => [
            "parentPageID" => [
                "type" => "integer",
                "default" => 0,
            ],
            "isNested" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "usesContext" => [
            "textColor",
            "customTextColor",
            "backgroundColor",
            "customBackgroundColor",
            "overlayTextColor",
            "customOverlayTextColor",
            "overlayBackgroundColor",
            "customOverlayBackgroundColor",
            "fontSize",
            "customFontSize",
            "showSubmenuIcon",
            "style",
            "openSubmenusOnClick",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "color" => [
                "text" => true,
                "background" => true,
                "link" => true,
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "spacing" => [
                "padding" => true,
                "margin" => true,
                "__experimentalDefaultControls" => [
                    "padding" => false,
                    "margin" => false,
                ],
            ],
        ],
        "editorStyle" => "wp-block-page-list-editor",
        "style" => "wp-block-page-list",
    ],
    "page-list-item" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/page-list-item",
        "title" => "Page List Item",
        "category" => "widgets",
        "parent" => ["core/page-list"],
        "description" => "Displays a page inside a list of all pages.",
        "keywords" => ["page", "menu", "navigation"],
        "textdomain" => "default",
        "attributes" => [
            "id" => [
                "type" => "number",
            ],
            "label" => [
                "type" => "string",
            ],
            "title" => [
                "type" => "string",
            ],
            "link" => [
                "type" => "string",
            ],
            "hasChildren" => [
                "type" => "boolean",
            ],
        ],
        "usesContext" => [
            "textColor",
            "customTextColor",
            "backgroundColor",
            "customBackgroundColor",
            "overlayTextColor",
            "customOverlayTextColor",
            "overlayBackgroundColor",
            "customOverlayBackgroundColor",
            "fontSize",
            "customFontSize",
            "showSubmenuIcon",
            "style",
            "openSubmenusOnClick",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "lock" => false,
            "inserter" => false,
            "__experimentalToolbar" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-page-list-editor",
        "style" => "wp-block-page-list",
    ],
    "paragraph" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/paragraph",
        "title" => "Paragraph",
        "category" => "text",
        "description" =>
            "Start with the basic building block of all narrative.",
        "keywords" => ["text"],
        "textdomain" => "default",
        "attributes" => [
            "align" => [
                "type" => "string",
            ],
            "content" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "p",
                "role" => "content",
            ],
            "dropCap" => [
                "type" => "boolean",
                "default" => false,
            ],
            "placeholder" => [
                "type" => "string",
            ],
            "direction" => [
                "type" => "string",
                "enum" => ["ltr", "rtl"],
            ],
        ],
        "supports" => [
            "splitting" => true,
            "anchor" => true,
            "className" => false,
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalSelector" => "p",
            "__unstablePasteTextInline" => true,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-paragraph-editor",
        "style" => "wp-block-paragraph",
    ],
    "pattern" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/pattern",
        "title" => "Pattern Placeholder",
        "category" => "theme",
        "description" => "Show a block pattern.",
        "supports" => [
            "html" => false,
            "inserter" => false,
            "renaming" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "textdomain" => "default",
        "attributes" => [
            "slug" => [
                "type" => "string",
            ],
        ],
    ],
    "post-author" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-author",
        "title" => "Author",
        "category" => "theme",
        "description" =>
            "Display post author details such as name, avatar, and bio.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "avatarSize" => [
                "type" => "number",
                "default" => 48,
            ],
            "showAvatar" => [
                "type" => "boolean",
                "default" => true,
            ],
            "showBio" => [
                "type" => "boolean",
            ],
            "byline" => [
                "type" => "string",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
                "role" => "content",
            ],
        ],
        "usesContext" => ["postType", "postId", "queryId"],
        "supports" => [
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDuotone" => ".wp-block-post-author__avatar img",
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "editorStyle" => "wp-block-post-author-editor",
        "style" => "wp-block-post-author",
    ],
    "post-author-biography" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-author-biography",
        "title" => "Author Biography",
        "category" => "theme",
        "description" => "The author biography.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["postType", "postId"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-post-author-biography",
    ],
    "post-author-name" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-author-name",
        "title" => "Author Name",
        "category" => "theme",
        "description" => "The author name.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
                "role" => "content",
            ],
        ],
        "usesContext" => ["postType", "postId"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-post-author-name",
    ],
    "post-comments-form" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-comments-form",
        "title" => "Comments Form",
        "category" => "theme",
        "description" => 'Display a post\'s comments form.',
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["postId", "postType"],
        "supports" => [
            "html" => false,
            "color" => [
                "gradients" => true,
                "heading" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "editorStyle" => "wp-block-post-comments-form-editor",
        "style" => [
            "wp-block-post-comments-form",
            "wp-block-buttons",
            "wp-block-button",
        ],
        "example" => [
            "attributes" => [
                "textAlign" => "center",
            ],
        ],
    ],
    "post-content" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-content",
        "title" => "Content",
        "category" => "theme",
        "description" => "Displays the contents of a post or page.",
        "textdomain" => "default",
        "usesContext" => ["postId", "postType", "queryId"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "layout" => true,
            "background" => [
                "backgroundImage" => true,
                "backgroundSize" => true,
                "__experimentalDefaultControls" => [
                    "backgroundImage" => true,
                ],
            ],
            "dimensions" => [
                "minHeight" => true,
            ],
            "spacing" => [
                "blockGap" => true,
                "padding" => true,
                "margin" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "color" => [
                "gradients" => true,
                "heading" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => false,
                    "text" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-post-content",
        "editorStyle" => "wp-block-post-content-editor",
    ],
    "post-date" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-date",
        "title" => "Date",
        "category" => "theme",
        "description" =>
            "Display the publish date for an entry such as a post or page.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "format" => [
                "type" => "string",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "displayType" => [
                "type" => "string",
                "default" => "date",
            ],
        ],
        "usesContext" => ["postId", "postType", "queryId"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
    ],
    "post-excerpt" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-excerpt",
        "title" => "Excerpt",
        "category" => "theme",
        "description" => "Display the excerpt.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "moreText" => [
                "type" => "string",
            ],
            "showMoreOnNewLine" => [
                "type" => "boolean",
                "default" => true,
            ],
            "excerptLength" => [
                "type" => "number",
                "default" => 55,
            ],
        ],
        "usesContext" => ["postId", "postType", "queryId"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "editorStyle" => "wp-block-post-excerpt-editor",
        "style" => "wp-block-post-excerpt",
    ],
    "post-featured-image" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-featured-image",
        "title" => "Featured Image",
        "category" => "theme",
        "description" => 'Display a post\'s featured image.',
        "textdomain" => "default",
        "attributes" => [
            "isLink" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "aspectRatio" => [
                "type" => "string",
            ],
            "width" => [
                "type" => "string",
            ],
            "height" => [
                "type" => "string",
            ],
            "scale" => [
                "type" => "string",
                "default" => "cover",
            ],
            "sizeSlug" => [
                "type" => "string",
            ],
            "rel" => [
                "type" => "string",
                "attribute" => "rel",
                "default" => "",
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
                "role" => "content",
            ],
            "overlayColor" => [
                "type" => "string",
            ],
            "customOverlayColor" => [
                "type" => "string",
            ],
            "dimRatio" => [
                "type" => "number",
                "default" => 0,
            ],
            "gradient" => [
                "type" => "string",
            ],
            "customGradient" => [
                "type" => "string",
            ],
            "useFirstImageFromPost" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "usesContext" => ["postId", "postType", "queryId"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "align" => ["left", "right", "center", "wide", "full"],
            "color" => [
                "text" => false,
                "background" => false,
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "width" => true,
                "__experimentalSkipSerialization" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "width" => true,
                ],
            ],
            "filter" => [
                "duotone" => true,
            ],
            "shadow" => [
                "__experimentalSkipSerialization" => true,
            ],
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "selectors" => [
            "border" =>
                ".wp-block-post-featured-image img, .wp-block-post-featured-image .block-editor-media-placeholder, .wp-block-post-featured-image .wp-block-post-featured-image__overlay",
            "shadow" =>
                ".wp-block-post-featured-image img, .wp-block-post-featured-image .components-placeholder",
            "filter" => [
                "duotone" =>
                    ".wp-block-post-featured-image img, .wp-block-post-featured-image .wp-block-post-featured-image__placeholder, .wp-block-post-featured-image .components-placeholder__illustration, .wp-block-post-featured-image .components-placeholder::before",
            ],
        ],
        "editorStyle" => "wp-block-post-featured-image-editor",
        "style" => "wp-block-post-featured-image",
    ],
    "post-navigation-link" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-navigation-link",
        "title" => "Post Navigation Link",
        "category" => "theme",
        "description" =>
            "Displays the next or previous post link that is adjacent to the current post.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "type" => [
                "type" => "string",
                "default" => "next",
            ],
            "label" => [
                "type" => "string",
            ],
            "showTitle" => [
                "type" => "boolean",
                "default" => false,
            ],
            "linkLabel" => [
                "type" => "boolean",
                "default" => false,
            ],
            "arrow" => [
                "type" => "string",
                "default" => "none",
            ],
            "taxonomy" => [
                "type" => "string",
                "default" => "",
            ],
        ],
        "usesContext" => ["postType"],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "link" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-post-navigation-link",
    ],
    "post-template" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-template",
        "title" => "Post Template",
        "category" => "theme",
        "ancestor" => ["core/query"],
        "description" =>
            "Contains the block elements used to render a post, like the title, date, featured image, content or excerpt, and more.",
        "textdomain" => "default",
        "usesContext" => [
            "queryId",
            "query",
            "displayLayout",
            "templateSlug",
            "previewPostType",
            "enhancedPagination",
            "postType",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "align" => ["wide", "full"],
            "layout" => true,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "blockGap" => [
                    "__experimentalDefault" => "1.25em",
                ],
                "__experimentalDefaultControls" => [
                    "blockGap" => true,
                    "padding" => false,
                    "margin" => false,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
        ],
        "style" => "wp-block-post-template",
        "editorStyle" => "wp-block-post-template-editor",
    ],
    "post-terms" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-terms",
        "title" => "Post Terms",
        "category" => "theme",
        "description" => "Post terms.",
        "textdomain" => "default",
        "attributes" => [
            "term" => [
                "type" => "string",
            ],
            "textAlign" => [
                "type" => "string",
            ],
            "separator" => [
                "type" => "string",
                "default" => ", ",
            ],
            "prefix" => [
                "type" => "string",
                "default" => "",
            ],
            "suffix" => [
                "type" => "string",
                "default" => "",
            ],
        ],
        "usesContext" => ["postId", "postType"],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-post-terms",
    ],
    "post-title" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/post-title",
        "title" => "Title",
        "category" => "theme",
        "description" =>
            "Displays the title of a post, page, or any other content-type.",
        "textdomain" => "default",
        "usesContext" => ["postId", "postType", "queryId"],
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "level" => [
                "type" => "number",
                "default" => 2,
            ],
            "levelOptions" => [
                "type" => "array",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => false,
                "role" => "content",
            ],
            "rel" => [
                "type" => "string",
                "attribute" => "rel",
                "default" => "",
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
                "role" => "content",
            ],
        ],
        "example" => [
            "viewportWidth" => 350,
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-post-title",
    ],
    "preformatted" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/preformatted",
        "title" => "Preformatted",
        "category" => "text",
        "description" =>
            "Add text that respects your spacing and tabs, and also allows styling.",
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "pre",
                "__unstablePreserveWhiteSpace" => true,
                "role" => "content",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "color" => [
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "padding" => true,
                "margin" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-preformatted",
    ],
    "pullquote" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/pullquote",
        "title" => "Pullquote",
        "category" => "text",
        "description" =>
            "Give special visual emphasis to a quote from your text.",
        "textdomain" => "default",
        "attributes" => [
            "value" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "p",
                "role" => "content",
            ],
            "citation" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "cite",
                "role" => "content",
            ],
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => ["left", "right", "wide", "full"],
            "background" => [
                "backgroundImage" => true,
                "backgroundSize" => true,
                "__experimentalDefaultControls" => [
                    "backgroundImage" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "background" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "dimensions" => [
                "minHeight" => true,
                "__experimentalDefaultControls" => [
                    "minHeight" => false,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "__experimentalStyle" => [
                "typography" => [
                    "fontSize" => "1.5em",
                    "lineHeight" => "1.6",
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-pullquote-editor",
        "style" => "wp-block-pullquote",
    ],
    "query" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query",
        "title" => "Query Loop",
        "category" => "theme",
        "description" =>
            "An advanced block that allows displaying post types based on different query parameters and visual configurations.",
        "keywords" => ["posts", "list", "blog", "blogs", "custom post types"],
        "textdomain" => "default",
        "attributes" => [
            "queryId" => [
                "type" => "number",
            ],
            "query" => [
                "type" => "object",
                "default" => [
                    "perPage" => null,
                    "pages" => 0,
                    "offset" => 0,
                    "postType" => "post",
                    "order" => "desc",
                    "orderBy" => "date",
                    "author" => "",
                    "search" => "",
                    "exclude" => [],
                    "sticky" => "",
                    "inherit" => true,
                    "taxQuery" => null,
                    "parents" => [],
                    "format" => [],
                ],
            ],
            "tagName" => [
                "type" => "string",
                "default" => "div",
            ],
            "namespace" => [
                "type" => "string",
            ],
            "enhancedPagination" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "usesContext" => ["templateSlug"],
        "providesContext" => [
            "queryId" => "queryId",
            "query" => "query",
            "displayLayout" => "displayLayout",
            "enhancedPagination" => "enhancedPagination",
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "layout" => true,
            "interactivity" => true,
        ],
        "editorStyle" => "wp-block-query-editor",
    ],
    "query-no-results" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-no-results",
        "title" => "No Results",
        "category" => "theme",
        "description" =>
            "Contains the block elements used to render content when no query results are found.",
        "ancestor" => ["core/query"],
        "textdomain" => "default",
        "usesContext" => ["queryId", "query"],
        "supports" => [
            "align" => true,
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "query-pagination" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-pagination",
        "title" => "Pagination",
        "category" => "theme",
        "ancestor" => ["core/query"],
        "allowedBlocks" => [
            "core/query-pagination-previous",
            "core/query-pagination-numbers",
            "core/query-pagination-next",
        ],
        "description" =>
            "Displays a paginated navigation to next/previous set of posts, when applicable.",
        "textdomain" => "default",
        "attributes" => [
            "paginationArrow" => [
                "type" => "string",
                "default" => "none",
            ],
            "showLabel" => [
                "type" => "boolean",
                "default" => true,
            ],
        ],
        "usesContext" => ["queryId", "query"],
        "providesContext" => [
            "paginationArrow" => "paginationArrow",
            "showLabel" => "showLabel",
        ],
        "supports" => [
            "align" => true,
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "default" => [
                    "type" => "flex",
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-query-pagination-editor",
        "style" => "wp-block-query-pagination",
    ],
    "query-pagination-next" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-pagination-next",
        "title" => "Next Page",
        "category" => "theme",
        "parent" => ["core/query-pagination"],
        "description" => "Displays the next posts page link.",
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
        ],
        "usesContext" => [
            "queryId",
            "query",
            "paginationArrow",
            "showLabel",
            "enhancedPagination",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "query-pagination-numbers" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-pagination-numbers",
        "title" => "Page Numbers",
        "category" => "theme",
        "parent" => ["core/query-pagination"],
        "description" => "Displays a list of page numbers for pagination.",
        "textdomain" => "default",
        "attributes" => [
            "midSize" => [
                "type" => "number",
                "default" => 2,
            ],
        ],
        "usesContext" => ["queryId", "query", "enhancedPagination"],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-query-pagination-numbers-editor",
    ],
    "query-pagination-previous" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-pagination-previous",
        "title" => "Previous Page",
        "category" => "theme",
        "parent" => ["core/query-pagination"],
        "description" => "Displays the previous posts page link.",
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
            ],
        ],
        "usesContext" => [
            "queryId",
            "query",
            "paginationArrow",
            "showLabel",
            "enhancedPagination",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
    ],
    "query-title" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-title",
        "title" => "Query Title",
        "category" => "theme",
        "description" => "Display the query title.",
        "textdomain" => "default",
        "attributes" => [
            "type" => [
                "type" => "string",
            ],
            "textAlign" => [
                "type" => "string",
            ],
            "level" => [
                "type" => "number",
                "default" => 1,
            ],
            "levelOptions" => [
                "type" => "array",
            ],
            "showPrefix" => [
                "type" => "boolean",
                "default" => true,
            ],
            "showSearchTerm" => [
                "type" => "boolean",
                "default" => true,
            ],
        ],
        "example" => [
            "attributes" => [
                "type" => "search",
            ],
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "style" => "wp-block-query-title",
    ],
    "query-total" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/query-total",
        "title" => "Query Total",
        "category" => "theme",
        "ancestor" => ["core/query"],
        "description" => "Display the total number of results in a query.",
        "textdomain" => "default",
        "attributes" => [
            "displayType" => [
                "type" => "string",
                "default" => "total-results",
            ],
        ],
        "usesContext" => ["queryId", "query"],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "color" => [
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-query-total",
    ],
    "quote" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/quote",
        "title" => "Quote",
        "category" => "text",
        "description" =>
            'Give quoted text visual emphasis. "In quoting others, we cite ourselves." — Julio Cortázar',
        "keywords" => ["blockquote", "cite"],
        "textdomain" => "default",
        "attributes" => [
            "value" => [
                "type" => "string",
                "source" => "html",
                "selector" => "blockquote",
                "multiline" => "p",
                "default" => "",
                "role" => "content",
            ],
            "citation" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "cite",
                "role" => "content",
            ],
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => ["left", "right", "wide", "full"],
            "html" => false,
            "background" => [
                "backgroundImage" => true,
                "backgroundSize" => true,
                "__experimentalDefaultControls" => [
                    "backgroundImage" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "dimensions" => [
                "minHeight" => true,
                "__experimentalDefaultControls" => [
                    "minHeight" => false,
                ],
            ],
            "__experimentalOnEnter" => true,
            "__experimentalOnMerge" => true,
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "heading" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "layout" => [
                "allowEditing" => false,
            ],
            "spacing" => [
                "blockGap" => true,
                "padding" => true,
                "margin" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "styles" => [
            [
                "name" => "default",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "plain",
                "label" => "Plain",
            ],
        ],
        "editorStyle" => "wp-block-quote-editor",
        "style" => "wp-block-quote",
    ],
    "read-more" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/read-more",
        "title" => "Read More",
        "category" => "theme",
        "description" =>
            "Displays the link of a post, page, or any other content-type.",
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "string",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
            ],
        ],
        "usesContext" => ["postId"],
        "supports" => [
            "html" => false,
            "color" => [
                "gradients" => true,
                "text" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                    "textDecoration" => true,
                ],
            ],
            "spacing" => [
                "margin" => ["top", "bottom"],
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "padding" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "width" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-read-more",
    ],
    "rss" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/rss",
        "title" => "RSS",
        "category" => "widgets",
        "description" => "Display entries from any RSS or Atom feed.",
        "keywords" => ["atom", "feed"],
        "textdomain" => "default",
        "attributes" => [
            "columns" => [
                "type" => "number",
                "default" => 2,
            ],
            "blockLayout" => [
                "type" => "string",
                "default" => "list",
            ],
            "feedURL" => [
                "type" => "string",
                "default" => "",
            ],
            "itemsToShow" => [
                "type" => "number",
                "default" => 5,
            ],
            "displayExcerpt" => [
                "type" => "boolean",
                "default" => false,
            ],
            "displayAuthor" => [
                "type" => "boolean",
                "default" => false,
            ],
            "displayDate" => [
                "type" => "boolean",
                "default" => false,
            ],
            "excerptLength" => [
                "type" => "number",
                "default" => 55,
            ],
        ],
        "supports" => [
            "align" => true,
            "html" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "padding" => false,
                    "margin" => false,
                ],
            ],
            "color" => [
                "background" => true,
                "text" => true,
                "gradients" => true,
                "link" => true,
            ],
        ],
        "editorStyle" => "wp-block-rss-editor",
        "style" => "wp-block-rss",
    ],
    "search" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/search",
        "title" => "Search",
        "category" => "widgets",
        "description" => "Help visitors find your content.",
        "keywords" => ["find"],
        "textdomain" => "default",
        "attributes" => [
            "label" => [
                "type" => "string",
                "role" => "content",
            ],
            "showLabel" => [
                "type" => "boolean",
                "default" => true,
            ],
            "placeholder" => [
                "type" => "string",
                "default" => "",
                "role" => "content",
            ],
            "width" => [
                "type" => "number",
            ],
            "widthUnit" => [
                "type" => "string",
            ],
            "buttonText" => [
                "type" => "string",
                "role" => "content",
            ],
            "buttonPosition" => [
                "type" => "string",
                "default" => "button-outside",
            ],
            "buttonUseIcon" => [
                "type" => "boolean",
                "default" => false,
            ],
            "query" => [
                "type" => "object",
                "default" => [],
            ],
            "isSearchFieldHidden" => [
                "type" => "boolean",
                "default" => false,
            ],
        ],
        "supports" => [
            "align" => ["left", "center", "right"],
            "color" => [
                "gradients" => true,
                "__experimentalSkipSerialization" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "interactivity" => true,
            "typography" => [
                "__experimentalSkipSerialization" => true,
                "__experimentalSelector" =>
                    ".wp-block-search__label, .wp-block-search__input, .wp-block-search__button",
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "color" => true,
                "radius" => true,
                "width" => true,
                "__experimentalSkipSerialization" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "radius" => true,
                    "width" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
            ],
            "html" => false,
        ],
        "editorStyle" => "wp-block-search-editor",
        "style" => "wp-block-search",
    ],
    "separator" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/separator",
        "title" => "Separator",
        "category" => "design",
        "description" =>
            "Create a break between ideas or sections with a horizontal separator.",
        "keywords" => ["horizontal-line", "hr", "divider"],
        "textdomain" => "default",
        "attributes" => [
            "opacity" => [
                "type" => "string",
                "default" => "alpha-channel",
            ],
            "tagName" => [
                "type" => "string",
                "enum" => ["hr", "div"],
                "default" => "hr",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => ["center", "wide", "full"],
            "color" => [
                "enableContrastChecker" => false,
                "__experimentalSkipSerialization" => true,
                "gradients" => true,
                "background" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => true,
                ],
            ],
            "spacing" => [
                "margin" => ["top", "bottom"],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "styles" => [
            [
                "name" => "default",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "wide",
                "label" => "Wide Line",
            ],
            [
                "name" => "dots",
                "label" => "Dots",
            ],
        ],
        "editorStyle" => "wp-block-separator-editor",
        "style" => "wp-block-separator",
    ],
    "shortcode" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/shortcode",
        "title" => "Shortcode",
        "category" => "widgets",
        "description" =>
            "Insert additional custom elements with a WordPress shortcode.",
        "textdomain" => "default",
        "attributes" => [
            "text" => [
                "type" => "string",
                "source" => "raw",
            ],
        ],
        "supports" => [
            "className" => false,
            "customClassName" => false,
            "html" => false,
        ],
        "editorStyle" => "wp-block-shortcode-editor",
    ],
    "site-logo" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/site-logo",
        "title" => "Site Logo",
        "category" => "theme",
        "description" =>
            "Display an image to represent this site. Update this block and the changes apply everywhere.",
        "textdomain" => "default",
        "attributes" => [
            "width" => [
                "type" => "number",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => true,
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
                "role" => "content",
            ],
            "shouldSyncIcon" => [
                "type" => "boolean",
            ],
        ],
        "example" => [
            "viewportWidth" => 500,
            "attributes" => [
                "width" => 350,
                "className" =>
                    "block-editor-block-types-list__site-logo-example",
            ],
        ],
        "supports" => [
            "html" => false,
            "align" => true,
            "alignWide" => false,
            "color" => [
                "__experimentalDuotone" =>
                    "img, .components-placeholder__illustration, .components-placeholder::before",
                "text" => false,
                "background" => false,
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "styles" => [
            [
                "name" => "default",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "rounded",
                "label" => "Rounded",
            ],
        ],
        "editorStyle" => "wp-block-site-logo-editor",
        "style" => "wp-block-site-logo",
    ],
    "site-tagline" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/site-tagline",
        "title" => "Site Tagline",
        "category" => "theme",
        "description" =>
            "Describe in a few words what the site is about. The tagline can be used in search results or when sharing on social networks even if it’s not displayed in the theme design.",
        "keywords" => ["description"],
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
            "level" => [
                "type" => "number",
                "default" => 0,
            ],
            "levelOptions" => [
                "type" => "array",
                "default" => [0, 1, 2, 3, 4, 5, 6],
            ],
        ],
        "example" => [
            "viewportWidth" => 350,
            "attributes" => [
                "textAlign" => "center",
            ],
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
        ],
        "editorStyle" => "wp-block-site-tagline-editor",
        "style" => "wp-block-site-tagline",
    ],
    "site-title" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/site-title",
        "title" => "Site Title",
        "category" => "theme",
        "description" =>
            "Displays the name of this site. Update the block, and the changes apply everywhere it’s used. This will also appear in the browser title bar and in search results.",
        "textdomain" => "default",
        "attributes" => [
            "level" => [
                "type" => "number",
                "default" => 1,
            ],
            "levelOptions" => [
                "type" => "array",
                "default" => [0, 1, 2, 3, 4, 5, 6],
            ],
            "textAlign" => [
                "type" => "string",
            ],
            "isLink" => [
                "type" => "boolean",
                "default" => true,
                "role" => "content",
            ],
            "linkTarget" => [
                "type" => "string",
                "default" => "_self",
                "role" => "content",
            ],
        ],
        "example" => [
            "viewportWidth" => 500,
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                    "link" => true,
                ],
            ],
            "spacing" => [
                "padding" => true,
                "margin" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
            ],
        ],
        "editorStyle" => "wp-block-site-title-editor",
        "style" => "wp-block-site-title",
    ],
    "social-link" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/social-link",
        "title" => "Social Icon",
        "category" => "widgets",
        "parent" => ["core/social-links"],
        "description" => "Display an icon linking to a social profile or site.",
        "textdomain" => "default",
        "attributes" => [
            "url" => [
                "type" => "string",
                "role" => "content",
            ],
            "service" => [
                "type" => "string",
            ],
            "label" => [
                "type" => "string",
                "role" => "content",
            ],
            "rel" => [
                "type" => "string",
            ],
        ],
        "usesContext" => [
            "openInNewTab",
            "showLabels",
            "iconColor",
            "iconColorValue",
            "iconBackgroundColor",
            "iconBackgroundColorValue",
        ],
        "supports" => [
            "reusable" => false,
            "html" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-social-link-editor",
    ],
    "social-links" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/social-links",
        "title" => "Social Icons",
        "category" => "widgets",
        "allowedBlocks" => ["core/social-link"],
        "description" =>
            "Display icons linking to your social profiles or sites.",
        "keywords" => ["links"],
        "textdomain" => "default",
        "attributes" => [
            "iconColor" => [
                "type" => "string",
            ],
            "customIconColor" => [
                "type" => "string",
            ],
            "iconColorValue" => [
                "type" => "string",
            ],
            "iconBackgroundColor" => [
                "type" => "string",
            ],
            "customIconBackgroundColor" => [
                "type" => "string",
            ],
            "iconBackgroundColorValue" => [
                "type" => "string",
            ],
            "openInNewTab" => [
                "type" => "boolean",
                "default" => false,
            ],
            "showLabels" => [
                "type" => "boolean",
                "default" => false,
            ],
            "size" => [
                "type" => "string",
            ],
        ],
        "providesContext" => [
            "openInNewTab" => "openInNewTab",
            "showLabels" => "showLabels",
            "iconColor" => "iconColor",
            "iconColorValue" => "iconColorValue",
            "iconBackgroundColor" => "iconBackgroundColor",
            "iconBackgroundColorValue" => "iconBackgroundColorValue",
        ],
        "supports" => [
            "align" => ["left", "center", "right"],
            "anchor" => true,
            "__experimentalExposeControlsToChildren" => true,
            "layout" => [
                "allowSwitching" => false,
                "allowInheriting" => false,
                "allowVerticalAlignment" => false,
                "default" => [
                    "type" => "flex",
                ],
            ],
            "color" => [
                "enableContrastChecker" => false,
                "background" => true,
                "gradients" => true,
                "text" => false,
                "__experimentalDefaultControls" => [
                    "background" => false,
                ],
            ],
            "spacing" => [
                "blockGap" => ["horizontal", "vertical"],
                "margin" => true,
                "padding" => true,
                "units" => ["px", "em", "rem", "vh", "vw"],
                "__experimentalDefaultControls" => [
                    "blockGap" => true,
                    "margin" => true,
                    "padding" => false,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "styles" => [
            [
                "name" => "default",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "logos-only",
                "label" => "Logos Only",
            ],
            [
                "name" => "pill-shape",
                "label" => "Pill Shape",
            ],
        ],
        "editorStyle" => "wp-block-social-links-editor",
        "style" => "wp-block-social-links",
    ],
    "spacer" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/spacer",
        "title" => "Spacer",
        "category" => "design",
        "description" =>
            "Add white space between blocks and customize its height.",
        "textdomain" => "default",
        "attributes" => [
            "height" => [
                "type" => "string",
                "default" => "100px",
            ],
            "width" => [
                "type" => "string",
            ],
        ],
        "usesContext" => ["orientation"],
        "supports" => [
            "anchor" => true,
            "spacing" => [
                "margin" => ["top", "bottom"],
                "__experimentalDefaultControls" => [
                    "margin" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-spacer-editor",
        "style" => "wp-block-spacer",
    ],
    "table" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/table",
        "title" => "Table",
        "category" => "text",
        "description" =>
            "Create structured content in rows and columns to display information.",
        "textdomain" => "default",
        "attributes" => [
            "hasFixedLayout" => [
                "type" => "boolean",
                "default" => true,
            ],
            "caption" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "figcaption",
            ],
            "head" => [
                "type" => "array",
                "default" => [],
                "source" => "query",
                "selector" => "thead tr",
                "query" => [
                    "cells" => [
                        "type" => "array",
                        "default" => [],
                        "source" => "query",
                        "selector" => "td,th",
                        "query" => [
                            "content" => [
                                "type" => "rich-text",
                                "source" => "rich-text",
                            ],
                            "tag" => [
                                "type" => "string",
                                "default" => "td",
                                "source" => "tag",
                            ],
                            "scope" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "scope",
                            ],
                            "align" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "data-align",
                            ],
                            "colspan" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "colspan",
                            ],
                            "rowspan" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "rowspan",
                            ],
                        ],
                    ],
                ],
            ],
            "body" => [
                "type" => "array",
                "default" => [],
                "source" => "query",
                "selector" => "tbody tr",
                "query" => [
                    "cells" => [
                        "type" => "array",
                        "default" => [],
                        "source" => "query",
                        "selector" => "td,th",
                        "query" => [
                            "content" => [
                                "type" => "rich-text",
                                "source" => "rich-text",
                            ],
                            "tag" => [
                                "type" => "string",
                                "default" => "td",
                                "source" => "tag",
                            ],
                            "scope" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "scope",
                            ],
                            "align" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "data-align",
                            ],
                            "colspan" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "colspan",
                            ],
                            "rowspan" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "rowspan",
                            ],
                        ],
                    ],
                ],
            ],
            "foot" => [
                "type" => "array",
                "default" => [],
                "source" => "query",
                "selector" => "tfoot tr",
                "query" => [
                    "cells" => [
                        "type" => "array",
                        "default" => [],
                        "source" => "query",
                        "selector" => "td,th",
                        "query" => [
                            "content" => [
                                "type" => "rich-text",
                                "source" => "rich-text",
                            ],
                            "tag" => [
                                "type" => "string",
                                "default" => "td",
                                "source" => "tag",
                            ],
                            "scope" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "scope",
                            ],
                            "align" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "data-align",
                            ],
                            "colspan" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "colspan",
                            ],
                            "rowspan" => [
                                "type" => "string",
                                "source" => "attribute",
                                "attribute" => "rowspan",
                            ],
                        ],
                    ],
                ],
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => true,
            "color" => [
                "__experimentalSkipSerialization" => true,
                "gradients" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "__experimentalBorder" => [
                "__experimentalSkipSerialization" => true,
                "color" => true,
                "style" => true,
                "width" => true,
                "__experimentalDefaultControls" => [
                    "color" => true,
                    "style" => true,
                    "width" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "selectors" => [
            "root" => ".wp-block-table > table",
            "spacing" => ".wp-block-table",
        ],
        "styles" => [
            [
                "name" => "regular",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "stripes",
                "label" => "Stripes",
            ],
        ],
        "editorStyle" => "wp-block-table-editor",
        "style" => "wp-block-table",
    ],
    "tag-cloud" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/tag-cloud",
        "title" => "Tag Cloud",
        "category" => "widgets",
        "description" =>
            "A cloud of popular keywords, each sized by how often it appears.",
        "textdomain" => "default",
        "attributes" => [
            "numberOfTags" => [
                "type" => "number",
                "default" => 45,
                "minimum" => 1,
                "maximum" => 100,
            ],
            "taxonomy" => [
                "type" => "string",
                "default" => "post_tag",
            ],
            "showTagCounts" => [
                "type" => "boolean",
                "default" => false,
            ],
            "smallestFontSize" => [
                "type" => "string",
                "default" => "8pt",
            ],
            "largestFontSize" => [
                "type" => "string",
                "default" => "22pt",
            ],
        ],
        "styles" => [
            [
                "name" => "default",
                "label" => "Default",
                "isDefault" => true,
            ],
            [
                "name" => "outline",
                "label" => "Outline",
            ],
        ],
        "supports" => [
            "html" => false,
            "align" => true,
            "spacing" => [
                "margin" => true,
                "padding" => true,
            ],
            "typography" => [
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalLetterSpacing" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
        "editorStyle" => "wp-block-tag-cloud-editor",
    ],
    "template-part" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/template-part",
        "title" => "Template Part",
        "category" => "theme",
        "description" =>
            "Edit the different global regions of your site, like the header, footer, sidebar, or create your own.",
        "textdomain" => "default",
        "attributes" => [
            "slug" => [
                "type" => "string",
            ],
            "theme" => [
                "type" => "string",
            ],
            "tagName" => [
                "type" => "string",
            ],
            "area" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "align" => true,
            "html" => false,
            "reusable" => false,
            "renaming" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-template-part-editor",
    ],
    "term-description" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/term-description",
        "title" => "Term Description",
        "category" => "theme",
        "description" =>
            "Display the description of categories, tags and custom taxonomies when viewing an archive.",
        "textdomain" => "default",
        "attributes" => [
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "align" => ["wide", "full"],
            "html" => false,
            "color" => [
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "spacing" => [
                "padding" => true,
                "margin" => true,
            ],
            "typography" => [
                "fontSize" => true,
                "lineHeight" => true,
                "__experimentalFontFamily" => true,
                "__experimentalFontWeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "color" => true,
                "width" => true,
                "style" => true,
                "__experimentalDefaultControls" => [
                    "radius" => true,
                    "color" => true,
                    "width" => true,
                    "style" => true,
                ],
            ],
        ],
    ],
    "text-columns" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/text-columns",
        "title" => "Text Columns (deprecated)",
        "icon" => "columns",
        "category" => "design",
        "description" =>
            "This block is deprecated. Please use the Columns block instead.",
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "array",
                "source" => "query",
                "selector" => "p",
                "query" => [
                    "children" => [
                        "type" => "string",
                        "source" => "html",
                    ],
                ],
                "default" => [[], []],
            ],
            "columns" => [
                "type" => "number",
                "default" => 2,
            ],
            "width" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "inserter" => false,
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-text-columns-editor",
        "style" => "wp-block-text-columns",
    ],
    "verse" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/verse",
        "title" => "Verse",
        "category" => "text",
        "description" =>
            "Insert poetry. Use special spacing formats. Or quote song lyrics.",
        "keywords" => ["poetry", "poem"],
        "textdomain" => "default",
        "attributes" => [
            "content" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "pre",
                "__unstablePreserveWhiteSpace" => true,
                "role" => "content",
            ],
            "textAlign" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "anchor" => true,
            "background" => [
                "backgroundImage" => true,
                "backgroundSize" => true,
                "__experimentalDefaultControls" => [
                    "backgroundImage" => true,
                ],
            ],
            "color" => [
                "gradients" => true,
                "link" => true,
                "__experimentalDefaultControls" => [
                    "background" => true,
                    "text" => true,
                ],
            ],
            "dimensions" => [
                "minHeight" => true,
                "__experimentalDefaultControls" => [
                    "minHeight" => false,
                ],
            ],
            "typography" => [
                "fontSize" => true,
                "__experimentalFontFamily" => true,
                "lineHeight" => true,
                "__experimentalFontStyle" => true,
                "__experimentalFontWeight" => true,
                "__experimentalLetterSpacing" => true,
                "__experimentalTextTransform" => true,
                "__experimentalTextDecoration" => true,
                "__experimentalWritingMode" => true,
                "__experimentalDefaultControls" => [
                    "fontSize" => true,
                ],
            ],
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "__experimentalBorder" => [
                "radius" => true,
                "width" => true,
                "color" => true,
                "style" => true,
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "style" => "wp-block-verse",
        "editorStyle" => "wp-block-verse-editor",
    ],
    "video" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/video",
        "title" => "Video",
        "category" => "media",
        "description" =>
            "Embed a video from your media library or upload a new one.",
        "keywords" => ["movie"],
        "textdomain" => "default",
        "attributes" => [
            "autoplay" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "autoplay",
            ],
            "caption" => [
                "type" => "rich-text",
                "source" => "rich-text",
                "selector" => "figcaption",
                "role" => "content",
            ],
            "controls" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "controls",
                "default" => true,
            ],
            "id" => [
                "type" => "number",
                "role" => "content",
            ],
            "loop" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "loop",
            ],
            "muted" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "muted",
            ],
            "poster" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "poster",
            ],
            "preload" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "preload",
                "default" => "metadata",
            ],
            "blob" => [
                "type" => "string",
                "role" => "local",
            ],
            "src" => [
                "type" => "string",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "src",
                "role" => "content",
            ],
            "playsInline" => [
                "type" => "boolean",
                "source" => "attribute",
                "selector" => "video",
                "attribute" => "playsinline",
            ],
            "tracks" => [
                "role" => "content",
                "type" => "array",
                "items" => [
                    "type" => "object",
                ],
                "default" => [],
            ],
        ],
        "supports" => [
            "anchor" => true,
            "align" => true,
            "spacing" => [
                "margin" => true,
                "padding" => true,
                "__experimentalDefaultControls" => [
                    "margin" => false,
                    "padding" => false,
                ],
            ],
            "interactivity" => [
                "clientNavigation" => true,
            ],
        ],
        "editorStyle" => "wp-block-video-editor",
        "style" => "wp-block-video",
    ],
    "widget-group" => [
        '$schema' => "https://schemas.wp.org/trunk/block.json",
        "apiVersion" => 3,
        "name" => "core/widget-group",
        "title" => "Widget Group",
        "category" => "widgets",
        "attributes" => [
            "title" => [
                "type" => "string",
            ],
        ],
        "supports" => [
            "html" => false,
            "inserter" => true,
            "customClassName" => true,
            "reusable" => false,
        ],
        "editorStyle" => "wp-block-widget-group-editor",
        "style" => "wp-block-widget-group",
    ],
];
