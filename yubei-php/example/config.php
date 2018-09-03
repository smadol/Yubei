<?php

/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

// MCH ID
const MCH_ID = '100001';
//MCH KEY
const MCH_KEY = '984423e02a22f79457111e84a3dcd369';
//NOTIFY URL
const NOTIFY_URL    =   'https://sirhe.cn/notify.php';
//RETURN_URL
const RETURN_URL    =   'https://sirhe.cn/return.php';

\Yubei\Yubei::setMchId(MCH_ID);         // 设置 MCH ID
\Yubei\Yubei::setSecretKey(MCH_KEY);  // 设置 MCH KEY
\Yubei\Yubei::setNotifyUrl(NOTIFY_URL); // 设置 NOTIFY URL
\Yubei\Yubei::setReturnUrl(RETURN_URL); // 设置 RETURN URL
\Yubei\Yubei::setPrivateKeyPath(dirname(__FILE__) .'/cret/rsa_private_key.pem'); // 设置私钥
\Yubei\Yubei::setPublicKeyPath(dirname(__FILE__) .'/cret/rsa_public_key.pem'); // 设置公钥
\Yubei\Yubei::setYubeiPublicKeyPath(dirname(__FILE__) .'/cret/yubei_rsa_public_key.pem'); // 设置平台公钥
