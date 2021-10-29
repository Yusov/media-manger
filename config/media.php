<?php

return [
    'image' => [
        'proportional' => [
            'low' => [
                'width' => 600,
                'height' => 400,
            ],
            'mid' => [
                'width' => 1000,
                'height' => 667,
            ],
            'high' => [
                'width' => 1920,
                'height' => 1280,
            ],
            'thumb' => [
                'width' => 120,
                'height' => 120,
            ],
        ],
        'square' => [
            'low' => [
                'width' => 600,
                'height' => 600,
            ],
            'mid' => [
                'width' => 1000,
                'height' => 1000,
            ],
            'high' => [
                'width' => 1920,
                'height' => 1920,
            ],
            'thumb' => [
                'width' => 120,
                'height' => 120,
            ],
        ],

        /*
         |--------------------------------------------------------------------------
         | Allowed mime types for uploads
         |--------------------------------------------------------------------------
         */
        'allowed_types' => [
            'image' => [
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'svg' => 'image/svg+xml',
            ],
        ],
    ],
];