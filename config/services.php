<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
		'app_name' => 'Detik Now Report',
		'client_id' => '905660125822-bsir5chabq3hjlg5h3mmt17d39if6kma.apps.googleusercontent.com', 
		'client_secret' => 'pNDTD5Au_EWs-wB0cP5oBXud',
		'api_key' => 'AIzaSyAWLYzRQkVUOT-qFO2OKAmnbDhrUWgPWxo',
		'redirect' => 'http://nowreport.detik.com/auth/google/callback'
    ],

];
