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
        'mch_id'          => '149101',              // QQ钱包分配的商户号
        'sub_mch_id'      => '1490101',              // Qpay商户号
        'notify_url'      => 'https://openapi.98imo.com/qqpay/notify',
        'key'             => 'a50e7350b254e62a',                // Qpay支付签名秘钥
        //'cert_client'     => CRET_PATH.'./qpay/apiclient_cert.pem',
        //'cert_key'        => CRET_PATH.'./qpay/apiclient_key.pem',
        'log' => [ // optional
            'file' => RUNTIME_PATH .'./pay/qpay.log',
            'level' => 'debug'
        ],
        //'mode' => 'dev', // optional, dev/hk;当为 `hk` 时，为香港 gateway。
    ],
];