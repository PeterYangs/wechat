<?php

namespace Tool;

class Tool
{


    /**
     * 生成随机字符串
     * Create by Peter
     * @param int $length
     * @return string
     * @throws \Exception
     */
    public static function nonceStr(int $length = 16)
    {

        $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

        $nonceStr = "";

        for ($i = 0; $i < $length; $i++) {


            $nonceStr .= $str[random_int(0, strlen($str) - 1)];

        }


        return $nonceStr;

    }


}