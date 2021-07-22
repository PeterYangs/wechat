<?php

namespace WeChat;


use WebAuth\Auth;

class WeChat
{

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $appSecret;

    /**
     * WeChat constructor.
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }


    /**
     * Create by Peter Yang
     * 2021-07-22 15:23:52
     * @param string $redirectUri
     * @return Auth
     */
    public function WebAuth($redirectUri)
    {

        return new Auth($this->appId, $this->appSecret, $redirectUri);
    }


}