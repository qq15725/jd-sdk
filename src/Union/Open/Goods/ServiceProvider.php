<?php

namespace Jd\Union\Open\Goods;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['union.open.goods'] = function ($app) {
            return new GoodsClient($app);
        };

        $app['union.open.goods.promotiongoodsinfo'] = function ($app) {
            return new PromotiongoodsinfoClient($app);
        };

        $app['union.open.goods.jingfen'] = function ($app) {
            return new JingfenClient($app);
        };
    }
}