<?php

namespace Jd\Union\Open\Goods;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [
        Jingfen\ServiceProvider::class,
        Promotiongoodsinfo\ServiceProvider::class,
    ];

    public function register(Container $app)
    {
        $app['union.open.goods'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Goods($app);
        };
    }
}