# 旅得对接文档

# laravel或lumen可使用本依赖进行对接


## lumen

### 安装依赖
> composer require dishcheng/lvde-api

移动`vendor/dishcheng/lvde-api/config/lvde_api.php`到`config`目录下

修改文件
`bootstrap/app.php`
```php
$app->configure('lvde_api');
...
$app->register(\DishCheng\LvDeApi\LvdeApiProvider::class);
```


使用
```php
$service=\DishCheng\LvDeApi\Services\LvDeApiService::getInstance();
$service->requestConfig=new \DishCheng\LvDeApi\Services\RequestConfig(
 'xxxx', 'xxxxx'
 );
//获取在售产品列表
$res=$service->getProductListInfo();
//获取在售产品详情信息
$res=$service->getProductDetailInfo('xxxxxxx');
//下单
$res=$service->order(['xxx'=>'sssss']);
//通知我方订单已支付
$res=$service->order_pay(['xxxxx'=>'sssss']);
```