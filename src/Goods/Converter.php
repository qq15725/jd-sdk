<?php

namespace Jd\Goods;

use SDK\Kernel\Support\Collection;

class Converter
{
    public static function convert(array $raw): array
    {
        $data = new Collection($raw);

        $shopId = $data->get('shopId');
        $productId = $data->get('skuId');

        return [
            'product' => [
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
            ],
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
            'coupon' => [
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
                'raw' => $raw,
            ],
            'shop' => [
                'id' => $shopId,
                'logo' => null,
                'name' => null,
                'type' => null,
            ]
        ];
    }
}