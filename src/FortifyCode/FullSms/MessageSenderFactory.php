<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 3:45 PM
 */

namespace FortifyCode\FullSms;


use Illuminate\Support\Facades\Config;

class MessageSenderFactory {
    public static function make($alias = null, $config = []) {
        $defaul_provider = Config::get('full-sms.default_provider');
        $alias_providers = Config::get('full-sms.provider_aliases');
        if (!$alias) {
            $alias = $defaul_provider;
        }
        $reflection = new \ReflectionClass($alias_providers[$alias]);
        return new $reflection->newInstanceArgs(array($config));
    }
}