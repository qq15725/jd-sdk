<?php

namespace Jd\Union\Open\Order;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [
        Row\ServiceProvider::class,
    ];

    public function register(Container $app)
    {
        $app['union.open.order'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Order($app);
        };
    }
}