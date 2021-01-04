<?php

namespace Jd\Union\Open\Goods\Material;

use Jd\BaseClient;

class Material extends BaseClient
{
    /**
     * 猜你喜欢商品推荐
     *
     * 输入频道id、userid即可获取个性化推荐的商品信息，目前联盟推荐的精选频道包含猜你喜欢、实时热销、大额券、9.9包邮等各种实时数据，适用于toc搭建频道页，千人千面商品推荐模块场景。建议使用clickURL转链长链接，千人千面推荐效果会更好。注意：请勿传入排序参数，以免影响推荐效果。
     *
     * @param int $page 页码
     * @param int $perPage 每页数量，最大10
     * @param int $eliteId 频道ID：1.猜你喜欢、2.实时热销、3.大额券、4.9.9包邮
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/11248
     *
     * @return array
     */
    public function query(int $page = 1, int $perPage = 20, int $eliteId = 1, array $query = [])
    {
        $query += [
            'eliteId' => $eliteId,
            'pageIndex' => $page,
            'pageSize' => $perPage,
        ];

        return $this->httpPost('jd.union.open.goods.material.query', [
            'goodsReq' => $query
        ]);
    }
}