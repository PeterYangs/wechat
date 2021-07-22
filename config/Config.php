<?php

namespace Config;


class Config
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
     * 授权跳转地址
     * @var string
     */
    protected $redirectUri;

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
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Config constructor.
     * @param string $appId
     * @param string $appSecret
     * @param string $redirectUri
     */
    public function __construct($appId, $appSecret, $redirectUri)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->redirectUri = $redirectUri;
    }

}