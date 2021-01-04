<?php

namespace Jd\Union\Open\Order\Row;

use Jd\BaseClient;

class Row extends BaseClient
{
    /**
     * 订单行查询接口
     *
     * 查询推广订单及佣金信息，可查询最近90天内下单的订单，会随着订单状态变化同步更新数据。支持按下单时间、完成时间或更新时间查询。建议按更新时间每分钟调用一次，查询最近一分钟的订单更新数据。支持查询subunionid、推广位、PID参数，支持普通推客及工具商推客订单查询。如需要通过SDK调用此接口，请接入JOS SDK：https://union.jd.com/helpcenter/13246-13312-108188
     *
     * @param int $page 页码
     * @param int $perPage 每页包含条数，上限为500
     * @param null|string $startTime 开始时间 格式yyyy-MM-dd HH:mm:ss，与endTime间隔不超过1小时
     * @param null|string $endTime 结束时间 格式yyyy-MM-dd HH:mm:ss，与startTime间隔不超过1小时
     * @param int $type 订单时间查询类型(1：下单时间，2：完成时间（购买用户确认收货时间），3：更新时间
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/12707
     *
     * @return array
     */
    public function query(
        int $page = 1,
        int $perPage = 20,
        ?string $startTime = null,
        ?string $endTime = null,
        int $type = 1,
        array $query = []
    )
    {
        $query += [
            'pageNo' => $page,
            'pageSize' => $perPage,
            'startTime' => $startTime ?: date('Y-m-d H:i:s', time() - 3600),
            'endTime' => $endTime ?: date('Y-m-d H:i:s'),
            'type' => $type,
        ];

        return $this->httpPost('jd.union.open.order.row.query', [
            'orderReq' => $query
        ]);
    }
}