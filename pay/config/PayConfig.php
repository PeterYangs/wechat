<?php


namespace Pay\config;


class PayConfig
{

    /**
     * @var string
     */
    protected $mchId;
    /**
     * @var string
     */
    protected $payKey;

    /**
     * PayConfig constructor.
     * @param string $mchId
     * @param string $payKey
     */
    public function __construct(string $mchId, string $payKey)
    {
        $this->mchId = $mchId;
        $this->payKey = $payKey;
    }

    /**
     * @return string
     */
    public function getMchId(): string
    {
        return $this->mchId;
    }

    /**
     * @return string
     */
    public function getPayKey(): string
    {
        return $this->payKey;
    }


}