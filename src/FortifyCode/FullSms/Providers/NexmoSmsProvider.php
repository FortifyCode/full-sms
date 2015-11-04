<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 4:15 PM
 */

namespace FortifyCode\FullSms\Providers;

use Illuminate\Support\Facades\Config;
use Nexmo\Client;


class NexmoSmsProvider extends SmsProvider {
    private $client;
    private $default_from_number;

    function __construct() {
        $api_key = Config::get('full-sms.nexmo.api_key');
        $api_secret = Config::get('full-sms.nexmo.api_secret');
        $this->client = new Client($api_key, $api_secret);
        $this->default_from_number = Config::get('full-sms.nexmo.default_number');
    }

    public function sendSMS($to, $message, $from = null) {
        if (!$from) {
            $from = $this->default_from_number;
        }
        $service = $this->client->message;
        $response = $service->invoke(
            $from,
            $to,
            'text',
            $message,
            null //'status_rep_req', // Receive delivery notification
        //'client_ref', // TODO: set client ID here or something similar
        //'net_code',
        //'vcard',
        //'vcal',
        //1,
        //'class',
        //'body',
        //'udh'
        );
        if ($response && $response['message-count'] > 0) {
            return $response['messages'][0]['message-id'];
        }
        return false;
    }


    public function numbersAvailable($countryCode = "US", $areaCode = "", $regionCode = ""){

        try {
            $response = $this->client->number->search($countryCode);
        } catch (Exception $e) {
            $response = "Error: " . $e->getMessage();
            return $response;
        }
        $all = $response->all();
        if (isset($all['numbers'])) {
            $numbers = [];
            foreach ($all['numbers'] as $number) {
                $numbers[] = $number["msisdn"];
                //printf("%d  \$%01.2f  %-10s  %-15s\n", $n['msisdn'], $n['cost'], $n['type'], join(',', $n['features']));
            }
        }

        return $numbers;
    }

    public function buyNumber($phoneNumber, $countryCode){

        $country = $countryCode;
        $msisdn = $phoneNumber; // Number found using $nexmo->number->search()
        $result = "";
        try {
            $response = $this->client->number->buy($country, $msisdn);
        } catch (Exception $e) {
            $result = "Error: " . $e->getMessage();
        }
        if (200 == $response['error-code']) {
            $result = true;
        }

        return $result;

    }



}