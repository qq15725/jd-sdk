<?php

namespace Jd\Union\Open\Goods\Promotiongoodsinfo;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [];

    public function register(Container $app)
    {
        $app['union.open.goods.promotiongoodsinfo'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Promotiongoodsinfo($app);
        };
    }
}