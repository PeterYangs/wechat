<?php


namespace Pay\method;


use Pay\contracts\PayInterface;
use Pay\contracts\UnifiedOrder;
use Pay\notify\Notify;

class Method
{

    /**
     * @var PayInterface
     */
    protected $method;

    /**
     * Method constructor.
     * @param PayInterface $method
     */
    public function __construct(PayInterface $method)
    {
        $this->method = $method;
    }


    /**
     * Create by Peter Yang
     * 2021-07-24 14:42:12
     * @param UnifiedOrder $unifiedOrder
     * @return PayInterface
     * @throws \Exception
     */
    public function unifiedorder(UnifiedOrder $unifiedOrder): PayInterface
    {


        if (!$this->method) {

            throw new \Exception('请选择支付方式');
        }


        return $this->method->unifiedorder($unifiedOrder);
    }


    public function check(string $data = ""): Notify
    {

        if (!$this->method) {

            throw new \Exception('请选择支付方式');
        }


        return $this->method->check($data);

    }


}