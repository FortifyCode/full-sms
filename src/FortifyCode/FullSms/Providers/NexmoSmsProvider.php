<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 4:15 PM
 */

namespace FortifyCode\FullSms\Providers;

use Exception;
use FortifyCode\FullSms\Exceptions\RequestFailed;
use FortifyCode\FullSms\Models\PhoneNumber;
use Illuminate\Support\Facades\Config;
use Nexmo\Client;


class NexmoSmsProvider extends SmsProvider
{
    private $client;
    private $default_from_number;

    function __construct($config = [])
    {
        $key = isset($config['key']) ? $config['key'] : Config::get('full-sms.nexmo.api_key');
        $secret = isset($config['secret']) ? $config['secret'] : Config::get('full-sms.nexmo.api_secret');;
        $this->client = new Client(['apiKey' => $key, 'apiSecret' => $secret]);
        $this->default_from_number = isset($config['default_number']) ? $config['default_number'] : null;
    }

    public function sendSMS($to, $message, $from = null)
    {
        if (!$from) {
            $from = $this->default_from_number;
        }
        try {
            $service = $this->client->message;
            $response = $service->invoke(
                $from,
                $to,
                'text',
                $message,
                null
            );
            if ($response && $response['message-count'] > 0) {
                return $response['messages'][0]['message-id'];
            }
        } catch (Exception $e) {
            throw new RequestFailed('nexmo', 'Could not send number', 500, $e);
        }
        return false;
    }


    public function numbersAvailable($countryCode = "US", $areaCode = "", $regionCode = "")
    {

        try {
            $response = $this->client->number->search($countryCode);
        } catch (Exception $e) {
            throw new RequestFailed('nexmo', 'Could not retrieve search of numbers', 501, $e);
        }
        $numbers = [];
        $all = $response->all();
        if (isset($all['numbers'])) {
            $numbers = [];
            foreach ($all['numbers'] as $number) {
                $numbers[] = new PhoneNumber($number['msisdn'], $number['country'], 'nexmo');
            }
        }

        return $numbers;
    }

    public function buyNumber($phoneNumber, $countryCode)
    {

        $country = $countryCode;
        $msisdn = $phoneNumber;
        $result = null;
        try {
            $response = $this->client->number->buy($country, $msisdn);
        } catch (Exception $e) {
            throw new RequestFailed('nexmo', 'Could not buy the number', 502, $e);
        }
        if (200 == $response['error-code']) {
            $result = true;
        }

        return $result;

    }


}