<?php

namespace DishCheng\LvDeApi\Services;


use DishCheng\LvDeApi\Constant\LvDeConstant;
use DishCheng\LvDeApi\Exceptions\LvDeApiException;

class RequestConfig
{
    protected $baseUri;
    protected $version;
    protected $appId;
    protected $appSecret;

    public function __construct($appId, $appSecret)
    {
        $this->appId=$appId;
        $this->appSecret=$appSecret;
        $this->version=LvDeConstant::Version;

        switch (config('lvde_api.mode')) {
            case "DEV":
                $this->baseUri=LvDeConstant::DevHost;
                break;
            case "LOCAL":
                $this->baseUri=LvDeConstant::LocalHost;
                break;
            case "PROD":
                $this->baseUri=LvDeConstant::ProdHost;
                break;
            default:
                throw new LvDeApiException('mode异常['.config('lvde_api.mode').']');
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId=$appId;
    }

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @param mixed $appSecret
     */
    public function setAppSecret($appSecret): void
    {
        $this->appSecret=$appSecret;
    }


}