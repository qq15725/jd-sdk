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

### PHP 

```php
$jd = new \Jd\Application('app_key', 'secret_key');

// 例如 jd.union.open.goods.jingfen.query 其他接口同理
$jd->union->open->goods->jingfen->query();
```

### Laravel

1. 注册 ServiceProvider:
    ```php
    \Jd\ServiceProvider::class
    ```
    
2. 发布配置：
    ```shell
    php artisan vendor:publish --provider="\Jd\ServiceProvider" --force
    ```
    
3. 配置.env
    ```dotenv
    Jd_APPKEY=app_key
    Jd_APPSECRET=secret_key
    ```
    
4. 使用
    ```php
    // 例如 jd.union.open.goods.jingfen.query 其他接口同理
    \Jd\Facades\Jd::union()->open->goods->jingfen->query();
    ```
    
### Lumen

1. 注册 ServiceProvider:
   
    `bootstrap/app.php` 下添加

    ```php
    $app->register(\Jd\ServiceProvider::class);
    ``` 
2. 手动复制配置文件

3. 配置.env
    ```dotenv
    Jd_APPKEY=app_key
    Jd_APPSECRET=secret_key
    ```

4. 使用
    ```php
    // 例如 jd.union.open.goods.jingfen.query 其他接口同理
    \Jd\Facades\Jd::union()->open->goods->jingfen->query();
    ```

## API

### [京东联盟API](https://union.jd.com/openplatform/api)

- [x] 京粉精选商品查询接口 jd.union.open.goods.jingfen.query
- [x] 订单查询接口 jd.union.open.order.query
- [x] 关键词商品查询接口【申请】jd.union.open.goods.query
- [x] 网站/APP获取推广链接接口 jd.union.open.promotion.common.get
- [x] 根据skuid查询商品信息接口 jd.union.open.goods.promotiongoodsinfo.query
- [ ] 优惠券领取情况查询接口【申请】 jd.union.open.coupon.query
- [ ] 社交媒体获取推广链接接口【申请】jd.union.open.promotion.bysubunionid.get
- [ ] 工具商获取推广链接接口【申请】 jd.union.open.promotion.byunionid.get
- [ ] 查询推广位【申请】 jd.union.open.position.query
- [ ] 创建推广位【申请】 jd.union.open.position.create
- [ ] 获取PID【申请】 jd.union.open.user.pid.get
- [ ] 秒杀商品查询接口【申请】【即将下线】 jd.union.open.goods.seckill.query
- [x] 商品类目查询接口 jd.union.open.category.goods.get
- [x] 商品详情查询接口 jd.union.open.goods.bigfield.query
- [ ] 奖励订单查询接口【申请】 jd.union.open.order.bonus.query
- [ ] 通过小程序获取推广链接【申请】 jd.union.open.promotion.applet.get
- [ ] 礼金停止 jd.union.open.coupon.gift.stop
- [ ] 礼金创建 jd.union.open.coupon.gift.get
- [ ] 礼金效果数据 jd.union.open.statistics.giftcoupon.query
- [x] 活动查询接口 jd.union.open.activity.query
- [x] 订单行查询接口 jd.union.open.order.row.query
- [x] 猜你喜欢商品推荐 jd.union.open.goods.material.query
- [ ] 佣金规则混合接口【申请】 jd.union.open.rule.commission.mix
- [ ] 京享红包效果数据 jd.union.open.statistics.redpacket.query
- [ ] 工具商订单行查询接口【申请】 jd.union.open.order.agent.query
- [ ] 京东注册用户判定接口【申请】 jd.union.open.user.register.validate
- [ ] 工具商京享红包效果数据查询接口【申请】 jd.union.open.statistics.redpacket.agent.query

## 其他 SDK

 - [淘宝(淘宝联盟) SDK](https://github.com/qq15725/taobao-sdk)
 - [拼多多(多多客) SDK](https://github.com/qq15725/pdd-sdk)