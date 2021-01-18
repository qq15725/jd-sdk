<?php

namespace Jd\Union\Open\Activity;

use Jd\BaseClient;

class Activity extends BaseClient
{
    /**
     * 活动查询接口
     *
     * 提供联盟官方活动查询，支持分别查询联盟PC端、京粉APP、大促营销日历的活动，可查询活动链接、图片、规则等素材。建议按日期依次查询当天及未来的活动。
     *
     * @param int $page 页码
     * @param int $perPage 每页数量，默认20，上限50
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/12667
     *
     * @return array
     */
    public function query(int $page = 1, int $perPage = 20, array $query = [])
    {
        $query += [
            'pageIndex' => $page,
            'pageSize' => $perPage,
        ];

        return $this->httpPost('jd.union.open.activity.query', [
            'activityReq' => $query,
        ]);
    }
}