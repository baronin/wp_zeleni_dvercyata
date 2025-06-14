<?php return [
    "interactivity/index.min.js" => [
        "dependencies" => [],
        "version" => "55aebb6e0a16726baffb",
        "type" => "module",
    ],
    "interactivity/debug.min.js" => [
        "dependencies" => [],
        "version" => "a5c279b9ad67f2a4e6e2",
        "type" => "module",
    ],
    "interactivity-router/index.min.js" => [
        "dependencies" => [
            "@wordpress/interactivity",
            ["id" => "@wordpress/a11y", "import" => "dynamic"],
        ],
        "version" => "dc4a227f142d2e68ef83",
        "type" => "module",
    ],
    "a11y/index.min.js" => [
        "dependencies" => [],
        "version" => "b7d06936b8bc23cff2ad",
        "type" => "module",
    ],
    "block-library/file/view.min.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "fdc2f6842e015af83140",
        "type" => "module",
    ],
    "block-library/form/view.min.js" => [
        "dependencies" => ["wp-polyfill"],
        "version" => "baaf25398238b4f2a821",
        "type" => "module",
    ],
    "block-library/image/view.min.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "e38a2f910342023b9d19",
        "type" => "module",
    ],
    "block-library/navigation/view.min.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "61572d447d60c0aa5240",
        "type" => "module",
    ],
    "block-library/query/view.min.js" => [
        "dependencies" => [
            "@wordpress/interactivity",
            ["id" => "@wordpress/interactivity-router", "import" => "dynamic"],
        ],
        "version" => "f55e93a1ad4806e91785",
        "type" => "module",
    ],
    "block-library/search/view.min.js" => [
        "dependencies" => ["@wordpress/interactivity"],
        "version" => "208bf143e4074549fa89",
        "type" => "module",
    ],
];
