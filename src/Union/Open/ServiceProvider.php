<?php

namespace Jd\Union\Open;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [
        Goods\ServiceProvider::class,
        Promotion\ServiceProvider::class,
        Order\ServiceProvider::class,
        Category\ServiceProvider::class,
        Activity\ServiceProvider::class,
    ];

    public function register(Container $app)
    {
        $app['union.open'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Open($app);
        };
    }
}