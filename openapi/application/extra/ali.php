<?php
/**
 * Created by 小羊.
 * Author: 勇敢的小笨羊
 * 微博: http://weibo.com/xuzuxing
 * Date: 2018/3/4
 * Time: 15:56
 */

return [

    //支付宝支付
  'alipay'  => [

      //应用ID,您的APPID。
      'app_id' => "201504",
      //商户私钥, 请把生成的私钥文件中字符串拷贝在此
      'private_key'    =>'MIIEoyl36tRxSQUtt8pUp85Z9v6/fqI1bt7dq4NPdero14dXgzL3XZt18QPAVntosqEjyI0QgiZZg3oXnh4fEgDwln+NFs8T/Ni/BDHMwzpuRpnNdglr6167kRj1frxjLWGUAgo3gmKQgZiVOmeFGNWEJ3vlB6nhfIrQOi2p+nPbPLOQKyUiJeGKh1aR3qGtFrUUpIYasizx3Kg/xdxMISzMSVOqDIxeVCB9FWSJXr9Ws6uErmpBI7lXmaAs3144Ie5rqRbKslMriJ3ovdaLlmTlXDxjbTR/AGsKu3XQIDAQABAoIBABX2a6FAmBqlQ/kQ37Gji/BxC3AxvUq/bMdNDEr4Sj0sgfSkOGtfTTU1a29xa+zNvSbP+EcBd+CImGqESafqClE1S3rEH9ASK3G9lwMCOdgCRTCMTLgSoT/uNsLjCfXlRgUWVEJj0u+sTP3SgxIeJkuxGdpy8rmNIqLa2mvB0mDYxiytOVyMO+J8amaTbz/MllRxa+iAxIbd/M12rrV3vvEYUgitvK4uXER62MZMyIvOW6Cf+CLfOq3Tsp+M1Jve4ox/xJOrg1815e9//+7hHcujjCo5XiG+u1rVyH+Tr/Qs6Rdk+CVgBiZ/YqWMSdFUBkUIYCKazzeVkzCkx0eJYIECgYEA3bIM0H7kCwfAHiWm5EGXEW8qoSTqc8bZMG5S6D2BuMTTVixRcfDTJlt2daKfxLRsU1ijrG6EVKaLblrBOFVJb1WYrgxgKkoUHIUqNwGMnTTe3dj8w2uA5/IUYcqmzwO5Rb49mc/1ATzzMqn2kUck5Vts9i8DpJUe0PLYJ7VkT5ECgYEAwavDC5NkPrE/QOYmvy1Aqj5vhKIr5W6IEGSGDMIfZ2e7o08URfRkc5jprZozcOl3MuseCE1I6ysIyDlvHtbV0eAl128xUWI5HXIC8zGrYJQ95Fsl2Xd6yymEC6CUKgnae2WyyOls3QM56XAmZbh1W+QN8Hsb5X0yLTii8LDsXQ0CgYB6AzVERqHxZCmbLfPFKkgfY0Rd/fg/EhCUtBNTGA7eBw2dHrUQdY9wS+RNZ9xwoTABSwaBry2LfUG90ZsICwBokv59w/flLnIVJEEQlvyxxNhn1rV+RBtlDHmlPKhDxPPh64rxrV9VeBsNJje6yyIGTSQR9dwWZ6/XJeBLMmzr0QKBgQC0uXeVAcF1zyjbgul9VNkXBJREDKExw+cshOGiXjO35tDuIAknDlv+kx7cZRzDrNkSptyrmpMFAG99iDrtaES3SJeHZbd73lC17YJbNmpaAXuP8I5tVFU96EvUHdClOfSrWcdwPILd6vjLoV/zZCH/0dxAIGFz0VRVZpiGSlMGsQKBgET9vKqOSvI88W8/Ve3YGOoXQ5qjrm5JqbL/J8f4GiOoDrBfaYij2Yg2WZlaPWi5t1KXh8IsN/Yn6NenY8CiI5hQZi/0CQM5ICEZmCnX3U1QdpffGzAbd/tb4ldmA3ez3cYNPzIP3q1bUQ3ybwO2eD8N978mHXBokoO0AHh01thZ',
      //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
      'ali_public_key' => 'MIIBIjAN314YN1DY/7RFPqxeeYNIFaMiGg2T9Hk+KfVm2eQ3QqY82/s0SaeebN/xjbkTsAc6yKGPCJxbe2vyE5coQ8iCj4pVvlFX6+SO+lEFvB56r8H+dQlDixPGgEGz+PZkUny7SZjFBZm5amH6XEl40ac9iWuuaW2C28FMoHX6XjJgu95aZMeVa5ZCrqmQIDAQAB',
      //异步通知地址
      'notify_url' => "https://openapi.98imo.com/alipay/notify",
      //同步跳转
      'return_url' => "https://openapi.98imo.com/alipay/redirect",
      'log' => [ // optional
          'file' => RUNTIME_PATH .'./pay/alipay.log',
          'level' => 'debug'
      ],
      //'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
  ]
];