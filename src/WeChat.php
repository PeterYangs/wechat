<?php

namespace WeChat;


use Config\Config;
use GuzzleHttp\Client;
use Web\auth\Auth;


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
     * Create by Peter Yang
     * 2021-07-22 15:23:52
     * @return Auth
     */
    public function WebAuth()
    {

        return new Auth($this->config);
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


}