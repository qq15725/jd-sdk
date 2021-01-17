<?php

namespace Jd\Union\Open\Order;

use Jd\BaseClient;
use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * @property \Jd\Union\Open\Order\Row\Row $row
 */
class Order extends BaseClient
{
    /**
     * 订单查询接口
     *
     *
     * 查询推广订单及佣金信息，可查询最近90天内下单的订单，会随着订单状态变化同步更新数据。支持按下单时间、完成时间或更新时间查询。建议按更新时间每分钟调用一次，查询最近一分钟的订单更新数据。支持查询subunionid、推广位、PID参数，支持普通推客及工具商推客订单查询。
     *
     * @param int $page 页码，返回第几页结果
     * @param int $perPage 每页包含条数，上限为500
     * @param null|string $time 查询时间，建议使用分钟级查询，格式：yyyyMMddHH、yyyyMMddHHmm或yyyyMMddHHmmss，如201811031212 的查询范围从12:12:00--12:12:59
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/10419
     *
     * @return array
     */
    public function query(int $page = 1, int $perPage = 20, ?string $time = null, array $query = [])
    {
        $query += [
            'pageNo' => $page,
            'pageSize' => $perPage,
            'time' => $time ?: date('YmdHM'),
            'type' => 3, // 订单时间查询类型(1：下单时间，2：完成时间（购买用户确认收货时间），3：更新时间
        ];

        return $this->httpPost('jd.union.open.order.query', [
            'orderReq' => $query
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
        if (isset($this->app["union.open.order.{$property}"])) {
            return $this->app["union.open.order.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Jd.Union.Open.Order service named "%s".', $property));
    }
}