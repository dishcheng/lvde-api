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
     * 告知我方已支付
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \DishCheng\LvdeApi\Exceptions\LvDeApiException
     */
    public function order_pay(array $data)
    {
        return $this->lvDe_post_request(LvDeUriConstant::Pay, $data);
    }
}
