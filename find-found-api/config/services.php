<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'adsense' => [
            'enabled' => env('GOOGLE_ADSENSE_ENABLED', false),
            'client' => env('GOOGLE_ADSENSE_CLIENT', ''),
            'slots' => [
                'header' => env('GOOGLE_ADSENSE_SLOT_HEADER', ''),
                'sidebar' => env('GOOGLE_ADSENSE_SLOT_SIDEBAR', ''),
                'footer' => env('GOOGLE_ADSENSE_SLOT_FOOTER', ''),
                'in_article' => env('GOOGLE_ADSENSE_SLOT_IN_ARTICLE', ''),
            ],
        ],
    ],

];
