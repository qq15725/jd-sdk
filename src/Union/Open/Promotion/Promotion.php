<?php

namespace Jd\Union\Open\Promotion;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Promotion\Common\Common $common
 */
class Promotion extends BaseClient
{
    /**
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["union.open.promotion.{$property}"])) {
            return $this->app["union.open.promotion.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union.Open.Promotion service named "%s".', $property));
    }
}