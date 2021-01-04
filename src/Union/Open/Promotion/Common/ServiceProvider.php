<?php

namespace Jd\Union\Open\Promotion\Common;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [];

    public function register(Container $app)
    {
        $app['union.open.promotion.common'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Common($app);
        };
    }
}