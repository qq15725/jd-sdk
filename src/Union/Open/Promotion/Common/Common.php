<?php

namespace Jd\Union\Open\Promotion\Common;

use Jd\BaseClient;

class Common extends BaseClient
{
    /**
     * 网站/APP获取推广链接接口
     *
     * @param string $materialId 推广物料url，例如活动链接、商品链接等；不支持仅传入skuid
     * @param string $siteId 网站ID/APP ID，入口：京东联盟-推广管理-网站管理/APP管理-查看网站ID/APP ID（1、接口禁止使用导购媒体id入参；2、投放链接的网址或应用必须与传入的网站ID/AppID备案一致，否则订单会判“无效-来源与备案网址不符”）
     * @param array $query
     *
     * @link https://union.jd.com/openplatform/api/10421
     *
     * @return array
     */
    public function get(string $materialId, string $siteId, array $query = [])
    {
        $query += [
            'materialId' => $materialId,
            'siteId' => $siteId,
        ];

        return $this->httpPost('jd.union.open.promotion.common.get', [
            'promotionCodeReq' => $query
        ]);
    }
}