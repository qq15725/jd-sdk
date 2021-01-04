<?php

namespace Jd;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置
        $this->publishes([
            dirname(__DIR__) . '/config/jd.php' => function_exists('config_path')
                ? config_path('jd.php')
                : base_path('config/jd.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (method_exists($this->app, 'configure')) {
            $this->app->configure('jd');
        }

        $this->mergeConfigFrom(dirname(__DIR__) . '/config/jd.php', 'jd');

        $this->app->singleton(Application::class, function ($app) {
            return new Application(
                null,
                null,
                $app->make('config')->get('jd', [])
            );
        });
    }
}
