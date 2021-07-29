<?php


namespace WeChat;


class SessionDao
{

    /**
     * @var string
     */
    protected $openid;


    /**
     * @var string
     */
    protected $sessionKey;
    /**
     * @var
     */
    protected $unionId;

    /**
     * SessionDao constructor.
     * @param string $openid
     * @param string $sessionKey
     * @param $unionId
     */
    public function __construct(string $openid, string $sessionKey, $unionId)
    {
        $this->openid = $openid;
        $this->sessionKey = $sessionKey;
        $this->unionId = $unionId;
    }

    /**
     * @return string
     */
    public function getOpenid(): string
    {
        return $this->openid;
    }

    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }

    /**
     * @return mixed
     */
    public function getUnionId()
    {
        return $this->unionId;
    }


}