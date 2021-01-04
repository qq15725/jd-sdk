<?php

namespace Jd\Union\Open\Promotion;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [
        Common\ServiceProvider::class,
    ];

    public function register(Container $app)
    {
        $app['union.open.promotion'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Promotion($app);
        };
    }
}