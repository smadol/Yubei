<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/3
 * Time: 23:06
 */
return [
    'wechat' => [
        'app_id'          => 'wx1c32cda245563ee1',      // 微信公众号 APPID
        'miniapp_id'      => 'wx1c32cda245563ee1',      // 小程序 APPID
        'mch_id'          => '1493758822',              // 微信商户号
        'notify_url'      => 'https://openapi.98imo.com/wxpay/notify',
        'key'             => '06c56a89949d617def52f371c357b6db',  // 微信支付签名秘钥
        //'cert_client'     => CRET_PATH.'./wxpay/apiclient_cert.pem',
        //'cert_key'        => CRET_PATH.'./wxpay/apiclient_key.pem',
        'log' => [ // optional
            'file' => RUNTIME_PATH .'./pay/wechat.log',
            'level' => 'debug'
        ],
        //'mode' => 'dev', // optional, dev/hk;当为 `hk` 时，为香港 gateway。
    ],
];