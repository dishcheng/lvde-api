<?php

namespace DishCheng\LvDeApi\Services;

use DishCheng\LvDeApi\Constant\LvDeConstant;
use DishCheng\LvDeApi\Exceptions\LvDeApiException;
use Illuminate\Support\Facades\Log;

/**
 * 服务端请求服务端
 * Class ClientRequestService
 * @package App\Http\Service
 */
class ClientRequestService
{
    const TimeOutSecond=10;

    public $requestConfig;

    /**
     * @param $uri
     * @param array $data
     * @return mixed
     * @throws LvDeApiException
     */
    public function lvDe_post_request($uri, $data=[])
    {
        $res=$this->post_request($uri, $data);
        $resData=$this->handle_lvDe_result($res);
        return $resData;
    }

    /**
     * @param $uri
     * @param array $data
     * @return mixed
     * @throws LvDeApiException
     */
    public function lvDe_get_request($uri, $data=[])
    {
        $res=$this->get_request($uri, $data);
        $resData=$this->handle_lvDe_result($res);
        return $resData;
    }


    /**
     * @param \Psr\Http\Message\ResponseInterface $res
     * @return mixed
     * @throws LvDeApiException
     */
    public function handle_lvDe_result(\Psr\Http\Message\ResponseInterface $res)
    {
        $content=$res->getBody()->getContents();
        $arr=json_decode($content, true);
        if ($arr['status_code']<200||$arr['status_code']>299) {
            throw new LvDeApiException($arr['message'], $arr['status_code']);
        }
        return $arr;
    }


    public function client()
    {
        return new \GuzzleHttp\Client([
            'base_uri'=>$this->requestConfig->getBaseUri(),
            'connect_timeout'=>self::TimeOutSecond,
            'verify'=>false,
            'headers'=>[
                'version'=>$this->requestConfig->getVersion(),
                'appId'=>$this->requestConfig->getAppId(),
                'appSecret'=>$this->requestConfig->getAppSecret(),
            ],
        ]);
    }


    /**
     * @param $uri
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get_request($uri, $data=[])
    {
        $client=self::client();
        return $client->get($uri,
            [
                'query'=>$data,
            ]);
    }


    /**
     * @param $uri
     * @param array $data
     * @param string $type
     * @return \Psr\Http\Message\ResponseInterface
     * @throws LvDeApiException
     */
    public function post_request($uri, $data=[], $type='json')
    {
        $client=self::client();
        switch ($type) {
            case 'json':
                $res=$client->post($uri,
                    [
                        'json'=>$data,
                    ]);
                break;
            case 'form_params':
                $res=$client->post($uri,
                    [
                        'form_params'=>$data,
                    ]);
                break;
            case 'raw':
                $res=$client->post($uri,
                    [
                        'body'=>$data,
                    ]);
                break;
            default:
                throw new LvDeApiException('post请求类型错误['.$type.']');
        }
        return $res;
    }
}
