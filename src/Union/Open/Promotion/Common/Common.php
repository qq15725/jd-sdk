<?php

namespace Jd\Union\Open\Promotion\Common;

use Jd\BaseClient;

class Common extends BaseClient
{
    /**
     * 网站/APP获取推广链接接口
     *
     * 网站/APP来获取的推广链接，功能同宙斯接口的自定义链接转换、 APP领取代码接口通过商品链接、活动链接获取普通推广链接，支持传入subunionid参数，可用于区分媒体自身的用户ID，该参数可在订单查询接口返回，需向cps-qxsq@jd.com申请权限。
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