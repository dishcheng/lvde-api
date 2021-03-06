# 旅得对接文档

# laravel或lumen可使用本依赖进行对接


## lumen

### 安装依赖
> composer require dishcheng/lvde-api

移动`vendor/dishcheng/lvde-api/config/lvde_api.php`到`config`目录下

该配置文件中`LVDE_API_MODE`参数用于标示对接环境，

| 值  | 含义  |
| :------: | :-------: |
|  DEV |  测试服  |
|  PROD |  正式服  |


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


//通知我方订单已支付
$res=$service->order_pay(['xxxxx'=>'sssss']);

//订单详情
$res=$service->order_detail($orderId);

//取消订单（未支付情况下）
$res=$service->order_cancel(['order_id'=>$orderId]);
//确认收货
$res=$service->confirm_receivedGoods(['order_id'=>$orderId]);
//申请退款（已支付情况下）
$res=$service->order_refund(['order_id'=>$orderId,'refund_reason'=>'退款原因']);
```