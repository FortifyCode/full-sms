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

    public function make($alias = null) {
        if ($alias == null) {
            $alias = $this->defaul_provider;
        }
        return new $this->alias_providers[$alias];
    }
}