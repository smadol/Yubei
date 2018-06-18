<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic;


class Encryption
{
    /**
     * 平台私钥数据签名
     * @param $data
     * @return string
     */
    public static function encrypt($data)
    {
        //读取私钥文件
        $priKey = file_get_contents(CRET_PATH . 'yubei_rsa_private_key.pem');
        //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
        $res = openssl_get_privatekey($priKey);
        //调用openssl内置签名方法，生成签名$sign
        openssl_sign($data, $sign, $res);
        //释放资源
        openssl_free_key($res);
        //base64编码
        $sign = base64_encode($sign);

        return $sign;
    }

    /**
     * 商户公钥验签数据
     * @param $data
     * @param $sign
     * @param $uid
     * @return bool
     */
    public static function to_verify_data($data, $sign, $uid = '100001')  {

        //读取公钥文件
        $pubKey = file_get_contents(CRET_PATH . $uid . DS .'rsa_public_key.pem');
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        //释放资源
        openssl_free_key($res);
        //返回资源是否成功
        return $result;

    }
}