<?php

namespace Jd\Union\Open\Category\Goods;

use Jd\BaseClient;

class Goods extends BaseClient
{
    /**
     * 商品类目查询接口
     *
     * 根据商品的父类目id查询子类目id信息，通常用获取各级类目对应关系，以便将推广商品归类。业务参数parentId、grade都输入0可查询所有一级类目ID，之后再用其作为parentId查询其子类目。
     *
     * @param int $parentId 父类目id(一级父类目为0)
     * @param int $grade 类目级别(类目级别 0，1，2 代表一、二、三级类目)
     *
     * @link https://union.jd.com/openplatform/api/10434
     *
     * @return array
     */
    public function get(int $parentId, int $grade)
    {
        return $this->httpPost('jd.union.open.category.goods.get', [
            'req' => [
                'parentId' => $parentId,
                'grade' => $grade,
            ]
        ]);
    }
}