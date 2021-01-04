<?php

namespace Jd\Union;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Open $open
 */
class Union extends BaseClient
{
    /**
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["union.{$property}"])) {
            return $this->app["union.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union service named "%s".', $property));
    }
}