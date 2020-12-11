<?php

namespace Jd\Facades;

use Illuminate\Support\Facades\Facade;
use Jd\Application;

/**
 * @mixin Application
 */
class Jd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Application::class;
    }

    /**
     * @return Application
     */
    public static function getFacadeRoot()
    {
        return parent::getFacadeRoot();
    }
}
