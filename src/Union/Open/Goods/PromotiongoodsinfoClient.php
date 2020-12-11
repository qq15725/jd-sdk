<?php

namespace Jd\Union\Open\Goods;

use Jd\BaseClient;

class PromotiongoodsinfoClient extends BaseClient
{
    /**
     * @param string $skuIds
     *
     * @return array
     */
    public function query(string $skuIds)
    {
        return $this->httpPost('jd.union.open.goods.promotiongoodsinfo.query', [
            'skuIds' => $skuIds
        ]);
    }
}