<?php

return [

    /**
     * --------------------------------------------------------------------------
     * Captcha validation
     * --------------------------------------------------------------------------
     *
     * These values are necessary to enable captcha validation used for example
     * in logging panel.
     *
     */

    'captcha' => [
        'enabled' => env('CAPTCHA_VALIDATION_ENABLED', false),
        'public_key' => env('CAPTCHA_PUBLIC_KEY', null),
        'private_key' => env('CAPTCHA_SECRET_KEY', null)
    ],

    /**
     * --------------------------------------------------------------------------
     * Redis storage
     * --------------------------------------------------------------------------
     *
     * These values are required to enable redis storage used for example to count
     * visits in application.
     *
     */

    'redis' => [
        'enabled' => env('REDIS_CONFIGURED', false),
        'host' => env('REDIS_HOST', null),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', null)
    ],

    /**
     * --------------------------------------------------------------------------
     * PWA Caching
     * --------------------------------------------------------------------------
     *
     * This value defines if PWA service worker should working in background.
     * That feature is responsible, among other things, for caching assets that
     * make application possible to visit without internet connection.
     *
     */

    'pwa_enabled' => env('PWA_SERVICE_WORKER_ENABLED', true),

];
