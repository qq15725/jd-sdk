<?php

namespace Jd\Union\Open\Goods;

use Jd\BaseClient;

class JingfenClient extends BaseClient
{
    /**
     * 京粉精选商品查询接口
     *
     * @param int $eliteId 频道ID:1-好券商品,2-精选卖场,10-9.9包邮,15-京东配送,22-实时热销榜,23-为你推荐,24-数码家电,25-超市,26-母婴玩具,27-家具日用,28-美妆穿搭,30-图书文具,31-今日必推,32-京东好物,33-京东秒杀,34-拼购商品,40-高收益榜,41-自营热卖榜,108-秒杀进行中,109-新品首发,110-自营,112-京东爆品,125-首购商品,129-高佣榜单,130-视频商品,153-历史最低价商品榜，210-极速版商品
     * @param int $page
     * @param int $perPage
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/10417
     *
     * @return array
     */
    public function query(int $eliteId, int $page = 1, int $perPage = 20, array $query = [])
    {
        $query += [
            'eliteId' => $eliteId,
            'pageIndex' => $page,
            'pageSize' => $perPage,
        ];

        return $this->httpPost('jd.union.open.goods.jingfen.query', [
            'goodsReq' => $query
        ]);
    }
}