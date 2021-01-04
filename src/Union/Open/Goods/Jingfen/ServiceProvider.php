<?php

namespace Jd\Union\Open\Goods\Jingfen;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [];

    public function register(Container $app)
    {
        $app['union.open.goods.jingfen'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Jingfen($app);
        };
    }
}