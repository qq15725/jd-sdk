<?php

namespace Jd\Union\Open;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Goods\Goods $goods
 * @property \Jd\Union\Open\Promotion\Promotion $promotion
 * @property \Jd\Union\Open\Order\Order $order
 * @property \Jd\Union\Open\Category\Category $category
 * @property \Jd\Union\Open\Activity\Activity $activity
 */
class Open extends BaseClient
{
    /**
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["union.open.{$property}"])) {
            return $this->app["union.open.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union.Open service named "%s".', $property));
    }
}