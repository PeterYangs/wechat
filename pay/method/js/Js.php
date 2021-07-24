<?php


namespace Pay\method\js;


use Config\Config;
use GuzzleHttp\Client;
use mysql_xdevapi\Exception;
use Pay\config\PayConfig;
use Pay\contracts\PayInterface;
use Pay\contracts\UnifiedOrder;
use Tool\Tool;


/**
 * 公众号和小程序支付
 * Class Js
 * @package Pay\method\js
 */
class Js implements PayInterface
{


    /**
     * @var Config
     */
    protected $config;


    /**
     * @var PayConfig
     */
    protected $payConfig;


    /**
     * @var Client
     */
    protected $http;


    /**
     * @var
     */
    protected $prepayId;


    /**
     * Js constructor.
     */
    public function __construct()
    {

        $this->http = new Client();
    }


    /**
     * Create by Peter Yang
     * 2021-07-24 14:26:31
     * @param JsUnifiedOrder $unifiedOrder
     * @return mixed
     * @throws \Exception
     */
    function unifiedorder(UnifiedOrder $unifiedOrder)
    {

        if (!($unifiedOrder instanceof JsUnifiedOrder)){

            throw new Exception("支付方式错误！");
        }


        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";


        $data = [
            'appid' => $this->config->getAppId(),
            'mch_id' => $this->payConfig->getMchId(),
            'nonce_str' => Tool::nonceStr(),
            'body' => $unifiedOrder->getBody(), //商品描述
            'out_trade_no' => $unifiedOrder->getOutTradeNo(),
            'total_fee' => $unifiedOrder->getTotalFee(),
            'spbill_create_ip' => $unifiedOrder->getIp(),
            'notify_url' => $unifiedOrder->getNotifyUrl(),
            'trade_type' => 'JSAPI',
            'openid' => $unifiedOrder->getOpenid(),
        ];

        if ($unifiedOrder->getAttach()) {

            $data['attach'] = $unifiedOrder->getAttach();
        }

        $signature = Tool::signatureForPay($data, $this->payConfig->getPayKey());

        $data['sign'] = $signature;

        //转xml格式
        $data = Tool::arrayToXml($data);

        $re = Tool::requestForPay($data, $url);


        $arr = Tool::xmlToArray($re);

        if ($arr['return_code'] !== "SUCCESS" || $arr['result_code'] !== "SUCCESS") {

            throw new \Exception(json_encode($arr));

        }


        return $arr;

    }

    public function SetConfig(Config $config): void
    {
        // TODO: Implement SetConfig() method.

        $this->config = $config;
    }

    public function SetPayConfig(PayConfig $payConfig): void
    {
        // TODO: Implement SetPayConfig() method.

        $this->payConfig = $payConfig;
    }

}