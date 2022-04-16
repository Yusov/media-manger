<?php

return [
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

    /*
    |----------------------------------------------------------------------------
    | Global image parameters
    |----------------------------------------------------------------------------
    */
    'images' => [
        /*
        |--------------------------------------------------------------------------
        | Indicates that we should to save original files without resizing.
        |--------------------------------------------------------------------------
        */
        'save_original' => false,
        /*
        |--------------------------------------------------------------------------
        | Set the original image postfix like a (_mid, _original).
        |--------------------------------------------------------------------------
        */
        'original_dpi' => 'original'
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuration path for uploads for each entity,
    |--------------------------------------------------------------------------
    */
    //    'user' => [
    //        'avatar' => [
    //            'path' => '/users/{id}/avatars....',
    //            'clearable' => true, //Will be clear previous image automaticaly
    //            'main' => true, // Set is main image if multiple.
    //            'resolutions' => [
    //                'low' => [
    //                    'width' => 600,
    //                    'height' => 400,
    //                ],
    //                'mid' => [
    //                    'width' => 1000,
    //                    'height' => 667,
    //                ],
    //                'high' => [
    //                    'width' => 1920,
    //                    'height' => 1280,
    //                ],
    //                'thumb' => [
    //                    'width' => 120,
    //                    'height' => 120,
    //                ],
    //            ],
    //            'default_dpi' => 'original'
    //        ]
    //    ]
];
