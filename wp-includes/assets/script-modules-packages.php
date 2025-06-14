<?php return [
    "interactivity/index.js" => [
        "dependencies" => [],
        "version" => "48fc4752aca8f8795ca8",
        "type" => "module",
    ],
    "interactivity/debug.js" => [
        "dependencies" => [],
        "version" => "beb31ebdbe898d3dd230",
        "type" => "module",
    ],
    "interactivity-router/index.js" => [
        "dependencies" => [
            "@wordpress/interactivity",
            ["id" => "@wordpress/a11y", "import" => "dynamic"],
        ],
        "version" => "549bd2787122793df49c",
        "type" => "module",
    ],
    "a11y/index.js" => [
        "dependencies" => [],
        "version" => "2a5dd8e0f11b6868f8cf",
        "type" => "module",
    ],
    "block-library/file/view.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "e925ab60cccb6624004c",
        "type" => "module",
    ],
    "block-library/form/view.js" => [
        "dependencies" => ["wp-polyfill"],
        "version" => "025c7429344421ccb2ef",
        "type" => "module",
    ],
    "block-library/image/view.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "23364a7b9437dd6c3319",
        "type" => "module",
    ],
    "block-library/navigation/view.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "0735c27ca16ce2f60efd",
        "type" => "module",
    ],
    "block-library/query/view.js" => [
        "dependencies" => [
            "@wordpress/interactivity",
            ["id" => "@wordpress/interactivity-router", "import" => "dynamic"],
        ],
        "version" => "6ac3e743320307785d41",
        "type" => "module",
    ],
    "block-library/search/view.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "e7b1695e621770b7ebb8",
        "type" => "module",
    ],
];
