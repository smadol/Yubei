<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/3
 * Time: 23:06
 */
return [
    'qpay' => [
        'appid'           => '',              // 腾讯开放平台或QQ互联平台审核通过的应用APPID
        'mch_id'          => '1499660101',              // QQ钱包分配的商户号
        'sub_mch_id'      => '1499660101',              // Qpay商户号
        'notify_url'      => 'https://api.pay.98imo.com/qqpay/notify',
        'key'             => 'a50e731409bada470b8f2d50b254e62a',                // Qpay支付签名秘钥
        'cert_client'     => './cert/apiclient_cert.pem',
        'cert_key'        => './cert/apiclient_key.pem',
        'log' => [ // optional
            'file' => './logs/qqpay.log',
            'level' => 'debug'
        ],
        //'mode' => 'dev', // optional, dev/hk;当为 `hk` 时，为香港 gateway。
    ],
];