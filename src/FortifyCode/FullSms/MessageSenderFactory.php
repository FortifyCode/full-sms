<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 3:45 PM
 */

namespace FortifyCode\FullSms;


use Illuminate\Support\Facades\Config;

class MessageSenderFactory {
    private $defaul_provider;
    private $alias_providers;

    function __construct() {
        $this->defaul_provider = Config::get('full-sms::full-sms.provider');
        $this->alias_providers = Config::get('full-sms::provider_aliases');
    }

    public static function make($alias = null) {
        $defaul_provider = Config::get('full-sms::full-sms.provider');
        $alias_providers = Config::get('full-sms::provider_aliases');
        if ($alias == null) {
            $alias = $defaul_provider;
        }
        return new $alias_providers[$alias];
    }
}