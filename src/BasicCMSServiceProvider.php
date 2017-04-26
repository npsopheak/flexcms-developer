<?php

namespace FlexCMS\BasicCMS;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\AliasLoader;

use FlexCMS\BasicCMS\Commands\AddPage;
use FlexCMS\BasicCMS\Commands\ClearPublic;
use FlexCMS\BasicCMS\Commands\AddScript;

class BasicCMSServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        require_once __DIR__ . '/../vendor/autoload.php';

        // Set default schema length
        Schema::defaultStringLength(191);

        $this->app->register(
            \Barryvdh\Cors\ServiceProvider::class
        );

        // $this->app->middleware([
        //     \App\Http\Middleware\EncryptCookies::class,
        //     \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        //     \Illuminate\Session\Middleware\StartSession::class,
        //     // \Illuminate\Session\Middleware\AuthenticateSession::class,
        //     \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        //     \App\Http\Middleware\VerifyCsrfToken::class,
        //     \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // ]);

        // Setup middleware
        $this->app['router']->aliasMiddleware('auth', \FlexCMS\BasicCMS\Middleware\Authenticate::class);
        $this->app['router']->aliasMiddleware('api.auth', \FlexCMS\BasicCMS\Middleware\ApiAuthenticate::class);
        $this->app['router']->aliasMiddleware('api.guest', \FlexCMS\BasicCMS\Middleware\ApiRedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware('app.auth', \FlexCMS\BasicCMS\Middleware\AuthorizedApp::class);
        $this->app['router']->aliasMiddleware('csrf', \FlexCMS\BasicCMS\Middleware\VerifyCsrfToken::class);
        $this->app['router']->aliasMiddleware('cors', \Barryvdh\Cors\HandleCors::class);

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

        // Merge Configuration 
        $this->mergeConfigFrom(
            __DIR__.'/config/flexmodules.php', 'flexmodules'
        );
        // Config publication
         $this->publishes([
            __DIR__.'/config/flexmodules.php' => config_path('flexmodules.php'),
        ]);

        // Load view 
        $this->loadViewsFrom(__DIR__.'/resources/views', 'flexcms');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor'),
        ], 'public');

        if ($this->app->runningInConsole()) {
            $this->commands([
                AddPage::class,
                ClearPublic::class,
                AddScript::class,
            ]);
        }

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

        AliasLoader::getInstance()->alias('AuthGateway', 'FlexCMS\BasicCMS\Facades\AuthGateway');
        
        // Bind facade
        \App::bind('authgateway', function()
        {
            return new \FlexCMS\BasicCMS\Classes\AuthGateway;
        });

        AliasLoader::getInstance()->alias('CMS', 'FlexCMS\BasicCMS\Facades\CMS');


        \App::bind('cms', function()
        {
            return new \FlexCMS\BasicCMS\Classes\CMS;
        });

        AliasLoader::getInstance()->alias('RequestGateway', 'FlexCMS\BasicCMS\Facades\RequestGateway');

        \App::bind('requestgateway', function()
        {
            return new \FlexCMS\BasicCMS\Classes\RequestGateway;
        });
    }
}   