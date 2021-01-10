<?php

namespace Jd;

use SDK\Kernel\Support\Collection;

class Converter
{
    /**
     * 商品数据转换成统一的数据格式
     *
     * @param array $raw
     * @param null $apiType
     * @param bool $retainRaw
     *
     * @return array
     */
    public static function product(array $raw, $apiType = null, $retainRaw = true): array
    {
        if (!$raw) {
            return [];
        }

        if (isset($raw[0])) {
            foreach ($raw as &$itemRaw) {
                $itemRaw = self::product($itemRaw, $apiType, $retainRaw);
            }
            return $raw;
        }

        $data = new Collection($raw);

        switch ($apiType) {
            case 'jd.union.open.goods.material.query':
                $productId = $data->get('skuId');
                $shopId = $data->get('shopInfo.shopId');
                $data = [
                    'id' => $productId,
                    'shop_id' => $shopId,
                    'category_id' => $data->get('categoryInfo.cid3Name'),
                    'title' => $data->get('skuName'),
                    'short_title' => $data->get('skuName'),
                    'desc' => null,
                    'cover' => $data->get('imageInfo.whiteImage'),
                    'banners' => array_column((array)$data->get('imageInfo.imageList'), 'url'),
                    'sales_count' => (int)$data->get('inOrderCount30DaysSku'),
                    'rich_text_images' => null,
                    'url' => $data->get('promotionInfo.clickURL'),
                    'coupons' => array_map(function ($coupon) use ($data, $shopId, $productId) {
                        $coupon = new Collection($coupon);
                        return [
                            'id' => null,
                            'shop_id' => $shopId,
                            'product_id' => $productId,
                            'amount' => $coupon->get('discount'),
                            'rule_text' => $coupon->get('quota'),
                            'stock' => null,
                            'total' => null,
                            'started_at' => date('Y-m-d H:i:s', $coupon->get('getStartTime') / 1000),
                            'ended_at' => date('Y-m-d H:i:s', $coupon->get('getEndTime') / 1000),
                            'use_started_at' => date('Y-m-d H:i:s', $coupon->get('useStartTime') / 1000),
                            'use_ended_at' => date('Y-m-d H:i:s', $coupon->get('useEndTime') / 1000),
                            'url' => $coupon->get('link'),
                            'coupon_product' => [
                                'price' => $price = (float)$data->get('priceInfo.lowestCouponPrice'),
                                'original_price' => (float)$data->get('priceInfo.price'),
                                'commission_rate' => (float)$data->get('commissionInfo.commissionShare'),
                                'commission_amount' => (float)\bcmul(
                                    $price,
                                    \bcdiv($data->get('commissionInfo.commissionShare'), 100, 2),
                                    2
                                ),
                            ],
                        ];
                    }, (array)$data->get('couponInfo.couponList')),
                    'shop' => [
                        'id' => $shopId,
                        'logo' => null,
                        'name' => $data->get('shopInfo.shopName'),
                        'type' => null,
                    ]
                ];
                break;
            case 'jd.union.open.goods.promotiongoodsinfo.query':
            case 'jd.union.open.goods.bigfield.query':
            default:
                $shopId = $data->get('shopId');
                $productId = $data->get('skuId');
                $data = [
                    'id' => $productId,
                    'shop_id' => $shopId,
                    'category_id' => $data->get('cid'),
                    'title' => $data->get('goodsName'),
                    'short_title' => $data->get('goodsName'),
                    'desc' => '',
                    'cover' => $data->get('imgUrl'),
                    'banners' => (string)$data->get('detailImages')
                        ? explode(',', (string)$data->get('detailImages'))
                        : [],
                    'sales_count' => (int)$data->get('inOrderCount'),
                    'rich_text_images' => [],
                    'url' => $data->get('materialUrl'),
                    'coupons' => [
                        [
                            'id' => null,
                            'shop_id' => $shopId,
                            'product_id' => $productId,
                            'amount' => null,
                            'rule_text' => null,
                            'stock' => null,
                            'total' => null,
                            'started_at' => null,
                            'ended_at' => null,
                            'url' => null,
                            'coupon_product' => [
                                'price' => $price = (float)$data->get('unitPrice'),
                                'original_price' => (float)$data->get('unitPrice'),
                                'commission_rate' => (float)$data->get('commisionRatioWl'),
                                'commission_amount' => (float)\bcmul(
                                    $price,
                                    \bcdiv($data->get('commisionRatioWl'), 100, 2),
                                    2
                                ),
                            ],
                        ]
                    ],
                    'shop' => [
                        'id' => $shopId,
                        'logo' => null,
                        'name' => null,
                        'type' => null,
                    ]
                ];
                break;
        }

        if ($retainRaw) {
            $data['raw'] = $raw;
        }

        return $data;
    }

    public static function order($raw): array
    {
        return $raw;
    }
}