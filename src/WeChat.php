<?php

namespace WeChat;


use Config\Config;
use WebAuth\Auth;

class WeChat
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * WeChat constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    /**
     * Create by Peter Yang
     * 2021-07-22 15:23:52
     * @param string $redirectUri
     * @return Auth
     */
    public function WebAuth()
    {

        return new Auth($this->config);
    }


}