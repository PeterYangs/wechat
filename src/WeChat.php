<?php

namespace WeChat;


use App\App;
use Config\Config;
use GuzzleHttp\Client;
use Pay\config\PayConfig;
use Pay\Pay;
use Web\auth\Auth;
use Web\jsSdk\JsSdk;


class WeChat
{

    /**
     * @var Config
     */
    protected $config;


    /**
     * @var Client
     */
    protected $http;

    /**
     * WeChat constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->http = new Client();
    }


    /**
     * 网页授权相关
     * Create by Peter Yang
     * 2021-07-22 15:23:52
     * @return Auth
     */
    public function WebAuth()
    {

        return new Auth($this->config);
    }


    /**
     * jssdk相关
     * Create by Peter Yang
     * 2021-07-23 09:42:07
     * @return JsSdk
     */
    public function JsSdk()
    {


        return new JsSdk($this->config);
    }


    /**
     * Create by Peter Yang
     * 2021-07-22 17:51:03
     * @return mixed
     * @throws \Exception
     */
    public function getAccessToken()
    {

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->config->getAppId() . "&secret=" . $this->config->getAppSecret();

        $accessToken = $this->http->get($url)->getBody()->getContents();

        $accessToken = json_decode($accessToken, true);

        if ($accessToken['errcode'] ?? null) {

            throw new \Exception(json_encode($accessToken));

        }

        return $accessToken['access_token'];

    }


    public function pay(PayConfig $payConfig)
    {


        return new Pay($payConfig, $this->config);
    }


    public function app(){


        return new App($this->config);
    }


}