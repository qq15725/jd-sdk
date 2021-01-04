<?php

namespace Jd\Union\Open\Goods\Jingfen;

use Jd\BaseClient;

class Jingfen extends BaseClient
{
    /**
     * 京粉精选商品查询接口
     *
     * 京东联盟精选优质商品，每日更新，可通过频道ID查询各个频道下的精选商品。用获取的优惠券链接调用转链接口时，需传入搜索接口link字段返回的原始优惠券链接，切勿对链接进行任何encode、decode操作，否则将导致转链二合一推广链接时校验失败。
     *
     * @param int $page 页码，默认1
     * @param int $perPage 每页数量，默认20，上限50，建议20
     * @param int $eliteId 频道ID:1-好券商品,2-精选卖场,10-9.9包邮,15-京东配送,22-实时热销榜,23-为你推荐,24-数码家电,25-超市,26-母婴玩具,27-家具日用,28-美妆穿搭,30-图书文具,31-今日必推,32-京东好物,33-京东秒杀,34-拼购商品,40-高收益榜,41-自营热卖榜,108-秒杀进行中,109-新品首发,110-自营,112-京东爆品,125-首购商品,129-高佣榜单,130-视频商品,153-历史最低价商品榜，210-极速版商品
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/10417
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

        return $this->httpPost('jd.union.open.goods.jingfen.query', [
            'goodsReq' => $query
        ]);
    }
}