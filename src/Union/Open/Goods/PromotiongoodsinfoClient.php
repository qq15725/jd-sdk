<?php

namespace Jd\Union\Open\Goods;

use Jd\BaseClient;

class PromotiongoodsinfoClient extends BaseClient
{
    /**
     * 根据skuid查询商品信息接口
     *
     * @param string $skuIds
     *
     * @link https://union.jd.com/openplatform/api/10422
     *
     * @return array
     */
    public function query(string $skuIds)
    {
        return $this->httpPost('jd.union.open.goods.promotiongoodsinfo.query', [
            'skuIds' => $skuIds
        ]);
    }
}