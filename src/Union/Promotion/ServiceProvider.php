<?php

namespace Jd\Union\Promotion;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['union.promotion'] = function ($app) {
            return new Promotion($app);
        };

        $app['union.promotion.common'] = function ($app) {
            return new CommonClient($app);
        };
    }
}