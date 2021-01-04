<?php

namespace Jd\Union\Open\Goods\Bigfield;

use Jd\BaseClient;

class Bigfield extends BaseClient
{
    /**
     * 商品详情查询接口
     *
     * 商品详情查询接口,大字段信息
     *
     * @param array $skuIds skuId集合，最多支持批量入参10个sku
     * @param array $fields 查询域集合，不填写则查询全部，目目前支持：categoryInfo（类目信息）,imageInfo（图片信息）,baseBigFieldInfo（基础大字段信息）,bookBigFieldInfo（图书大字段信息）,videoBigFieldInfo（影音大字段信息）,detailImages（商详图）
     *
     * @link https://union.jd.com/openplatform/api/11248
     *
     * @return array
     */
    public function query(array $skuIds, ?array $fields = null)
    {
        return $this->httpPost('jd.union.open.goods.bigfield.query', [
            'goodsReq' => [
                'skuIds' => $skuIds,
                'fields' => $fields,
            ]
        ]);
    }
}