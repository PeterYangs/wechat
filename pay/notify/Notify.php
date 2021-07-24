<?php


namespace Pay\notify;


class Notify
{

    /**
     * @var string 商户id
     */
    protected $mchId;


    /**
     * @var string
     */
    protected $nonceStr;


    /**
     * @var string
     */
    protected $tradeType;


    /**
     * @var integer
     */
    protected $totalFee;


    /**
     * @var string
     */
    protected $attach;

    /**
     * @var array
     */
    protected $all;

    /**
     * Notify constructor.
     * @param string $mchId
     * @param string $nonceStr
     * @param string $tradeType
     * @param int $totalFee
     * @param string $attach
     * @param array $all
     */
    public function __construct(
        string $mchId,
        string $nonceStr,
        string $tradeType,
        int $totalFee,
        string $attach,
        array $all
    ) {
        $this->mchId = $mchId;
        $this->nonceStr = $nonceStr;
        $this->tradeType = $tradeType;
        $this->totalFee = $totalFee;
        $this->attach = $attach;
        $this->all = $all;
    }

    /**
     * @return string
     */
    public function getAttach(): string
    {
        return $this->attach;
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
    public function getNonceStr(): string
    {
        return $this->nonceStr;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->all;
    }


    /**
     * @return string
     */
    public function getTradeType(): string
    {
        return $this->tradeType;
    }

    /**
     * @return int
     */
    public function getTotalFee(): int
    {
        return $this->totalFee;
    }



}