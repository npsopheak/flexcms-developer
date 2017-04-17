<?php

namespace FlexCMS\BasicCMS;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class BasicCMSServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Set default schema length
        Schema::defaultStringLength(191);

        // Load route 
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Load migration 
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        // Merge Configuration 
        $this->mergeConfigFrom(
            __DIR__.'/config/flexcms.php', 'flexcms'
        );
        // Config publication
         $this->publishes([
            __DIR__.'/config/flexcms.php' => config_path('flexcms.php'),
        ]);

        // Load view 
        $this->loadViewsFrom(__DIR__.'/resources/views', 'flexcms');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
        // include __DIR__.'/routes.php';
        $this->app->make('FlexCMS\BasicCMS\Api\SiteController');
        
        // Bind facade
        \App::bind('authgateway', function()
        {
            return new \FlexCMS\BasicCMS\Classes\AuthGateway;
        });

        \App::bind('cms', function()
        {
            return new \FlexCMS\BasicCMS\Classes\CMS;
        });

        \App::bind('requestgateway', function()
        {
            return new \FlexCMS\BasicCMS\Classes\RequestGateway;
        });
    }
}   