<?php

namespace DishCheng\LvDeApi\Services;


use DishCheng\LvDeApi\Constant\LvDeUriConstant;
use DishCheng\LvDeApi\Traits\SinglePattern;


/**
 * Class LvDeApiService
 * @package DishCheng\ZwyApi\Services
 */
class LvDeApiService extends ClientRequestService
{
    use SinglePattern;

    //存放实例对象
    protected static $_instance=[];

    public $request_config=[];


    /**
     * 产品列表接口
     * @param array $searchData
     * @return string
     */
    public function getProductListInfo(array $searchData=[])
    {
        return $this->lvDe_get_request(LvDeUriConstant::ProductTaSell, $searchData);
    }


    /**
     * 产品详情接口
     * @param $productNo
     * @return string
     */
    public function getProductDetailInfo($productNo)
    {
        return $this->lvDe_get_request(LvDeUriConstant::ProductTaSell.'/'.$productNo);
    }

    /**
     * 下单
     * @param $orderData
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function order($orderData)
    {
        return $this->lvDe_post_request(LvDeUriConstant::Order, $orderData);
    }

    /**
     * 订单详情
     * @param $orderId
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function order_detail(string $orderId)
    {
        return $this->lvDe_get_request(LvDeUriConstant::Order.'/'.$orderId);
    }

    /**
     * 告知我方已支付
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function order_pay(array $data)
    {
        return $this->lvDe_post_request(LvDeUriConstant::Pay, $data);
    }

    /**
     * 取消订单(未支付情况下调用)
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function order_cancel(array $data)
    {
        return $this->lvDe_post_request(LvDeUriConstant::OrderCancel, $data);
    }


    /**
     * 确认收货
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function confirm_receivedGoods(array $data)
    {
        return $this->lvDe_post_request(LvDeUriConstant::OrderConfirmReceivedGoods, $data);
    }


    /**
     * 订单申请退款(已支付情况下调用)
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function order_refund(array $data)
    {
        return $this->lvDe_post_request(LvDeUriConstant::OrderRefund, $data);
    }
}
