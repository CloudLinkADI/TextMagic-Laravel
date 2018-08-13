<?php

namespace CloudLinkADI\TextMagic;
use Illuminate\Support\ServiceProvider;

class TextMagicServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('TextMagic', function ($app) {
            return new TextMagic(
                config('textmagic.username',''),
                config('textmagic.token','')
            );
        });

        $this->app->alias('TextMagic', TextMagic::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['TextMagic',TextMagic::class];
    }

    public function boot()
    {

        $this->publishes([
            __DIR__.'/config/textmagic.php' => config_path('/textmagic.php'),
        ],'config');

    }

}