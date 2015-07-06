<?php
/**
 * Author: Nestor Mata Cuthbert <nestor@profesional.co.cr>
 * Date: 7/6/15 12:36 PM
 */

namespace FortifyCode\FullSms;

use Illuminate\Support\ServiceProvider;

class FullSmsServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot() {
        // Publish config files
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('full-sms.php'),
        ]);

    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['messagesender'] = $this->app->share(function ($app) {
            return new MessageSenderFactory();
        });
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('MessageSenderFactory', 'FortifyCode\FullSms\Facades\MessageSender');
        });

        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php', 'full-sms'
        );
    }

    public function provides() {
        return array('messagesender');
    }
}