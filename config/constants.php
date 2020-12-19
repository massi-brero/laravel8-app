<?php
const ORIENTATION_LANDSCAPE = 0;
const ORIENTATION_PORTRAIT = 01;

return [
    'images' => [
        'formats' => [
            'hobby' =>
                [
                    ORIENTATION_LANDSCAPE => [
                        [
                            'base_size' => 1200,
                            'imgName' => '_landscape_big.jpg',
                        ],
                        [
                            'base_size' => 60,
                            'imgName' => '_landscape_thumb.jpg',
                        ]
                    ],
                    ORIENTATION_PORTRAIT => [
                        [
                            'base_size' => 900,
                            'imgName' => '_portrait_big.jpg',
                        ],
                        [
                            'base_size' => 60,
                            'imgName' => '_portrait_thumb.jpg',
                        ]
                    ]
                ],
            'user' =>
                [
                    ORIENTATION_LANDSCAPE => [
                        [
                            'base_size' => 1200,
                            'imgName' => '_landscape_big.jpg',
                        ],
                        [
                            'base_size' => 60,
                            'imgName' => '_landscape_thumb.jpg',
                        ]
                    ],
                    ORIENTATION_PORTRAIT => [
                        [
                            'base_size' => 300,
                            'imgName' => '_portrait_big.jpg',
                        ],
                        [
                            'base_size' => 60,
                            'imgName' => '_portrait_thumb.jpg',
                        ]
                    ]
                ]
        ]
    ]
];
