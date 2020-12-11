<?php

namespace Jd\Goods;

use SDK\Kernel\Support\Collection;

class Converter
{
    public static function convert(array $raw): array
    {
        $data = new Collection($raw);

        $couponUrl = $data->get('coupon_share_url') ?: null;
        $couponId = $data->get('coupon_id') ?: null;
        $shopId = $data->get('seller_id');
        $productId = $data->get('num_iid');

        return [
            'product' => [
                'id' => $productId,
                'shop_id' => $shopId,
                'category_id' => $data->get('category_id'),
                'title' => $data->get('title'),
                'short_title' => $data->get('short_title'),
                'desc' => $data->get('desc'),
                'cover' => $data->get('pict_url'),
                'banners' => $data->get('small_images.string'),
                'sales_count' => (int)$data->get('volume'),
                'rich_text_images' => [],
                'url' => $data->get('item_url'),
            ],
            'coupon_product' => [
                'price' => $price = (float)\bcsub(
                    (float)$data->get('zk_final_price'),
                    (float)$data->get('coupon_amount'),
                    2
                ),
                'original_price' => (float)$data->get('zk_final_price'),
                'commission_rate' => (float)\bcdiv($data->get('commission_rate'), 100, 2),
                'commission_amount' => (float)\bcmul(
                    $price,
                    \bcdiv($data->get('commission_rate'), 10000, 4),
                    2
                ),
            ],
            'coupon' => [
                'id' => $couponId,
                'shop_id' => $shopId,
                'product_id' => $productId,
                'amount' => (float)$data->get('coupon_amount'),
                'rule_text' => $data->get('coupon_info'),
                'stock' => (int)$data->has('coupon_remain_count'),
                'total' => (int)$data->get('coupon_total_count'),
                'started_at' => $data->get('coupon_start_time'),
                'ended_at' => $data->get('coupon_end_time'),
                'url' => $couponUrl,
                'raw' => $raw,
            ],
            'shop' => [
                'id' => $shopId,
                'logo' => null,
                'name' => $data->get('shop_title'),
                'type' => 'tmall',
            ]
        ];
    }
}