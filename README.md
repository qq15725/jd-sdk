<p>
  <a href="https://github.com/qq15725/taobao-sdk" target="_blank">
    <img alt="Php-Version" src="https://img.shields.io/packagist/php-v/wxm/jd-sdk.svg" />
  </a>
  <a href="https://github.com/qq15725/jd-sdk" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="https://github.com/qq15725/jd-sdk/graphs/commit-activity" target="_blank">
    <img alt="Maintenance" src="https://img.shields.io/badge/Maintained%3F-yes-green.svg" />
  </a>
  <a href="https://github.com/qq15725/jd-sdk/blob/master/LICENSE" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
</p>

京东 SDK 封装, 调用简单、语义化增强。支持 Laravel/Lumen。 

## 安装

```bash
composer require wxm/jd-sdk
```

## 使用

```php
<?php

use Jd\Application;

$jd = new Application('app_key', 'secret_key');

// 例如 jd.union.open.goods.jingfen.query 其他接口同理
$jd->union->open->goods->jingfen->query(521383533703);
```

## [京东联盟API](https://union.jd.com/openplatform/api)

- [x] jd.union.open.goods.query 关键词商品查询接口【申请】
- [x] jd.union.open.goods.jingfen.query 京粉精选商品查询接口
- [x] jd.union.open.goods.promotiongoodsinfo.query 根据skuid查询商品信息接口
- [x] jd.union.open.promotion.common.get 网站/APP获取推广链接接口