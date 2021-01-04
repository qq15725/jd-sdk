<?php

namespace Jd\Union\Open\Goods\Promotiongoodsinfo;

use Jd\BaseClient;

class Promotiongoodsinfo extends BaseClient
{
    /**
     * 根据skuid查询商品信息接口
     *
     * 通过SKUID查询推广商品的名称、主图、类目、价格、物流、是否自营、30天引单数量等详细信息，支持批量获取。通常用于在媒体侧展示商品详情。
     *
     * @param string $skuIds 京东skuID串，逗号分割，最多100个，开发示例如param_json={'skuIds':'5225346,7275691'}（非常重要 请大家关注：如果输入的sk串中某个skuID的商品不在推广中[就是没有佣金]，返回结果中不会包含这个商品的信息）
     *
     * @link https://union.jd.com/openplatform/api/10422
     *
     * @return array
     */
    public function query($skuIds)
    {
        return $this->httpPost('jd.union.open.goods.promotiongoodsinfo.query', [
            'skuIds' => $skuIds
        ]);
    }
}