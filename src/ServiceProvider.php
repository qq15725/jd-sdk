<?php

namespace Jd;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Application::class, function ($app) {
            return new Application(
                null,
                null,
                $app->make('config')->get('jd', [])
            );
        });
    }
}
