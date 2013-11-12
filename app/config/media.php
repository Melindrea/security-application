<?php
return [
    'sizes' => [
        'thumbnail' => [
            'width' => 200,
            'height' => 200,
            'exact' => 'both', // can also be width or height
        ],
        'medium' => [
            'width' => 400,
            'height' => 100,
        ],
        'large' => [
            'width' => 600,
            'height' => 100,
        ],
    ],
    'directories' => [
        'image' => 'assets/media/images',
        'file' => 'assets/media/files',
        'embed' => 'assets/media/embed-previews',
    ],
];
