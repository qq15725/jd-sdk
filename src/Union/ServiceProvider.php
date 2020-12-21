<?php

namespace Jd\Union;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    protected $providers = [
        Open\ServiceProvider::class,
        Promotion\ServiceProvider::class,
    ];

    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['union'] = function ($app) {
            /** @var \Jd\Application $app */
            $app->registerProviders($this->providers);

            return new Union($app);
        };
    }
}