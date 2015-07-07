# Full SMS Service
SMS Service that enclose Nexmo, Twilio and WhatsApp messaging for Laravel

## Description
This project allows you to have a centralized and easy way to use SMS messaging services in Laravel 5 projects.

## Status
This first version will allow you to send and receive SMS using Nexmo and Twilio.    
Soon releases will use the rest of the API features and will include WhatsApp.

## Installation
```
composer require fortifycode/full-sms
```

## Setup
Modify the file `config/app` to include the provider in the list:
```
'providers' => [
// ...
    'FortifyCode\FullSms\FullSmsServiceProvider',
// ...
],
```

Then publish the configuration file to your local configuration directory:
```
php artisan vendor:publish
```

Now you should enter your API account information in the config file and choose which provider will be the default provider to use
```
return array(
    'default_provider' => 'twilio',
    'provider_aliases' => [
        'twilio' => 'FortifyCode\FullSms\Providers\TwilioSmsProvider',
        'nexmo' => 'FortifyCode\FullSms\Providers\NexmoSmsProvider',
    ],
    'twilio' => [
        'sid' => '',
        'token' => '',
        'default_number' => '',
    ],
    'nexmo' => [
        'api_key' => '',
        'api_secret' => '',
        'default_number' => '',
    ],
);
```

## Usage
Now you can use the factory to retrieve the corresponding provider:

```
use FortifyCode\FullSms\MessageSenderFactory;

class MyClass {

    public function do_something() {
        // This one gets the default sender according to the configuration
        $default_sender =  MessageSenderFactory::make();
        
        // Using a specific sender using the alias from the configuration
        $nexmo_sender =  MessageSenderFactory::make('nexmo');
    }

}
```

Using this way you could choose which provider to use based on the user's configuration or any other parameter.    
You can also change the aliases as you need or add more aliases.

# Author
Nestor Mata Cuthbert

# License
MIT