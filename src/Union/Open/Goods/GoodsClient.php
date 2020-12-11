<?php

namespace Jd\Union\Open\Goods;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Goods\JingfenClient $jingfen
 * @property \Jd\Union\Open\Goods\PromotiongoodsinfoClient $promotiongoodsinfo
 */
class GoodsClient extends BaseClient
{
    /**
     * @return array
     */
    public function query()
    {
        return $this->httpPost('jd.union.open.goods.query');
    }

    /**
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["union.open.goods.{$property}"])) {
            return $this->app["union.open.goods.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union.Open.Goods service named "%s".', $property));
    }
}