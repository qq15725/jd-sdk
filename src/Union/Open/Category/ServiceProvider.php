<?php

namespace Jd\Union\Open\Category;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [
        Goods\ServiceProvider::class,
    ];

    public function register(Container $app)
    {
        $app['union.open.category'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Category($app);
        };
    }
}