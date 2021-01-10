<?php

namespace Jd\Union\Open\Goods;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Goods\Jingfen\Jingfen $jingfen
 * @property \Jd\Union\Open\Goods\Promotiongoodsinfo\Promotiongoodsinfo $promotiongoodsinfo
 * @property \Jd\Union\Open\Goods\Bigfield\Bigfield $bigfield
 * @property \Jd\Union\Open\Goods\Material\Material $material
 */
class Goods extends BaseClient
{
    /**
     * 关键词商品查询接口【申请】
     *
     * 查询商品及优惠券信息，返回的结果可调用转链接口生成单品或二合一推广链接。支持按SKUID、关键词、优惠券基本属性、是否拼购、是否爆款等条件查询，建议不要同时传入SKUID和其他字段，以获得较多的结果。支持按价格、佣金比例、佣金、引单量等维度排序。用优惠券链接调用转链接口时，需传入搜索接口link字段返回的原始优惠券链接，切勿对链接进行任何encode、decode操作，否则将导致转链二合一推广链接时校验失败。
     *
     * @param int $page 页码
     * @param int $perPage 每页数量，最大10
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/10420
     *
     * @return array
     */
    public function query(int $page = 1, int $perPage = 20, $query = [])
    {
        $query += [
            'pageIndex' => $page,
            'pageSize' => $perPage,
        ];

        return $this->httpPost('jd.union.open.goods.query', [
            'goodsReqDTO' => $query
        ]);
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