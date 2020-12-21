<?php

namespace Jd\Union\Promotion;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Promotion\CommonClient $common
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
        if (isset($this->app["union.promotion.{$property}"])) {
            return $this->app["union.promotion.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union.Promotion service named "%s".', $property));
    }
}