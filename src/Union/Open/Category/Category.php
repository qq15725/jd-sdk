<?php

namespace Jd\Union\Open\Category;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Category\Goods\Goods $goods
 */
class Category extends BaseClient
{
    /**
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["union.open.category.{$property}"])) {
            return $this->app["union.open.category.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union.Open.Category service named "%s".', $property));
    }
}