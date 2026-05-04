<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DomPDF Configuration
    |--------------------------------------------------------------------------
    |
    | DomPDF rendering options for Laravel.
    |
    */

    'show_warnings' => false,   // Set to true to see HTML warnings/errors

    'orientation' => 'portrait',

    'defines' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),
        'allowed_protocols' => [
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []]
        ],
        'log_output_file' => storage_path('logs/dompdf.log'),
    ],

    /*

    /*
    |--------------------------------------------------------------------------
    | Available Paper Sizes
    |--------------------------------------------------------------------------
    |
    | This array contains all available paper sizes.
    |
    */

    'paper_sizes' => [
        'a4' => [210, 297],
        'a3' => [297, 420],
        'letter' => [215.9, 279.4],
    ],

    'default_paper_size' => 'a4',

    'default_font' => 'serif',

    /*
    |--------------------------------------------------------------------------
    | PDF Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [
        'dpi' => 96,
        'defaultMediaType' => 'print',
        'defaultPaperSize' => 'a4',
        'defaultPaperOrientation' => 'portrait',
        'isPhpEnabled' => true,
        'isJavascriptEnabled' => false,
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
    ],

];
