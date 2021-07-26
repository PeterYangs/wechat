<?php


namespace Pay\method\js;


use Config\Config;
use GuzzleHttp\Client;
use Pay\config\PayConfig;
use Pay\contracts\PayInterface;
use Pay\contracts\UnifiedOrder;
use Pay\notify\Notify;
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
     * @var array
     */
    protected $unifiedorderResult;

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
     * @return Js
     * @throws \Exception
     */
    function unifiedorder(UnifiedOrder $unifiedOrder): PayInterface
    {

        if (!($unifiedOrder instanceof JsUnifiedOrder)) {

            throw new \Exception("支付方式错误！");
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


        $this->unifiedorderResult = $arr;

        return $this;

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

    function getUnifiedorderResult(): array
    {
        // TODO: Implement getUnifiedorderResult() method.

        if (!$this->unifiedorderResult) {

            return [];
        }

        return $this->unifiedorderResult;
    }

    /**
     * Create by Peter Yang
     * 2021-07-24 14:50:24
     * @return array
     * @throws \Exception
     */
    public function getPayParameter(): array
    {
        // TODO: Implement getPayParameter() method.

        if (!$this->unifiedorderResult) {

            throw new \Exception("请先调用统一下单！");
        }

        $data = [
            'appId' => $this->config->getAppId(),
            'timeStamp' => time(),
            'nonceStr' => Tool::nonceStr(),
            'package' => 'prepay_id=' . $this->unifiedorderResult['prepay_id'],
            'signType' => 'MD5',

        ];

        $paySign = Tool::signatureForPay($data, $this->payConfig->getPayKey());


        $data['paySign'] = $paySign;

        return $data;


    }

    /**
     * Create by Peter Yang
     * 2021-07-24 16:02:00
     * @param string $data
     * @return Notify
     * @throws \Exception
     */
    public function check(string $data = ""): Notify
    {
        // TODO: Implement check() method.

        if (!$data) {

            $data = file_get_contents('php://input');
        }


        $data = Tool::xmlToArray($data);

        $sign = $data['sign'];

        if (!$sign) {


            throw new \Exception("签名为空");

        }

        unset($data['sign']);

        $s = Tool::signatureForPay($data, $this->payConfig->getPayKey());

        if (strtolower($s) === strtolower($sign)) {


            return new Notify($data['mch_id'], $data['nonce_str'], $data['trade_type'], $data['total_fee'],$data['attach'] ,$data);

        }


        throw new \Exception("验证失败！");


    }
}