<?php

namespace Jd;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Jd\Union\Union $union
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Union\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'version' => '1.0',
        'format' => 'json',
        'sign_method' => 'md5',
        'http' => [
            'timeout' => 20.0,
            'base_uri' => 'https://router.jd.com/api',
        ],
    ];

    public function __construct(
        string $appkey = null,
        string $appsecret = null,
        array $config = [],
        array $prepends = []
    )
    {
        parent::__construct(
            array_merge([
                'appkey' => $appkey,
                'appsecret' => $appsecret,
            ], $config),
            $prepends
        );
    }
}