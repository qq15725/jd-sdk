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
                    'cover' => $data->get('imageInfo.whiteImage', $data->get('imageInfo.imageList.0.url')),
                    'banners' => array_column((array)$data->get('imageInfo.imageList'), 'url'),
                    'sales_count' => (int)$data->get('inOrderCount30DaysSku'),
                    'rich_text_images' => null,
                    'url' => $data->get('promotionInfo.clickURL'),
                    'coupons' => array_map(function ($coupon) use ($data, $shopId, $productId) {
                        $coupon = new Collection($coupon);
                        return [
                            'id' => $coupon->get('link'),
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

    /**
     * 订单数据转换成统一的数据格式
     *
     * @param array $raw
     * @param bool $retainRaw
     *
     * @return array
     */
    public static function order(array $raw, $retainRaw = true): array
    {
        if (!$raw) {
            return [];
        }

        if (isset($raw[0])) {
            foreach ($raw as &$itemRaw) {
                $itemRaw = self::order($itemRaw, $retainRaw);
            }
            return $raw;
        }

        $data = new Collection($raw);

        $data = [
            'no' => $data->get('orderId'),
            'parent_no' => $data->get('parentId') == 0 ? $data->get('orderId') : $data->get('parentId'),
            'site_id' => $data->get('siteId') ?: null,
            'site_name' => null,
            'adzone_id' => $data->get('positionId'),
            'adzone_name' => null,
            'product_id' => $data->get('skuId'),
            'product_cover' => $data->get('goodsInfo.imageUrl'),
            'product_url' => null,
            'product_title' => $data->get('skuName'),
            'shop_name' => $data->get('goodsInfo.shopName'),
            'type' => ['g' => '自营', 'p' => 'POP'][$data->get('goodsInfo.owner')] ?? $data->get('goodsInfo.owner'),
            'terminal' => ['1' => 'PC', '2' => '无线'][$data->get('orderEmt')] ?? $data->get('orderEmt'),
            'amount' => (int)bcmul($data->get('price'), 100),
            'commission_rate' => (int)bcmul($data->get('commissionRate'), 100),
            'commission_amount' => $commissionAmount = (int)bcmul($data->get('actualFee'), 100),
            'precommission_amount' => (int)bcmul($data->get('estimateFee'), 100),
            'royalty_amount' => (int)bcmul(
                bcdiv($commissionAmount, $data->get('finalRate') / 100, 2),
                (100 - $data->get('finalRate')) / 100
            ),
            'status' => $data->get('validCode'),
            'extension' => [
                'plus' => $data->get('plus') == 1,
                'ext1' => $data->get('ext1'),
                'subUnionId' => $data->get('subUnionId'),
            ],
            'created_at' => $data->get('orderTime'),
            'paid_at' => $data->get('orderTime'),
            'received_at' => $data->get('finishTime') ?: null,
            'settlemented_at' => $data->get('payMonth')
                ? date('Y-m-d H:i:s', strtotime($data->get('payMonth')))
                : null,
            'refunded' => $data->get('skuReturnNum') > 0,
        ];


        if ($retainRaw) {
            $data['raw'] = $raw;
        }

        return $data;
    }
}