<?php
/**
 * Configuration parameters for SMS
 */
return array(
    'default_provider' => env('DEFAULT_SMS_PROVIDER', 'twilio'),
    'available_providers' => explode(',', env('AVAILABLE_SMS_PROVIDERS', 'twilio,nexmo')),
    'provider_aliases' => [
        'twilio' => 'FortifyCode\FullSms\Providers\TwilioSmsProvider',
        'nexmo' => 'FortifyCode\FullSms\Providers\NexmoSmsProvider',
    ],
    'twilio' => [
        'sid' => env('TWILIO_API_SID', ''),
        'token' => env('TWILIO_API_TOKEN', ''),
    ],
    'nexmo' => [
        'api_key' => env('NEXMO_API_KEY', ''),
        'api_secret' => env('NEXMO_API_SECRET', ''),
    ],
);