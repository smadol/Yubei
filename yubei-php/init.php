<?php

if (!function_exists('curl_init')) {
    throw new Exception('Yubei needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Yubei needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
    throw new Exception('Yubei needs the Multibyte String PHP extension.');
}

// Yubei
require(dirname(__FILE__) . '/src/Yubei.php');
// Utils
require(dirname(__FILE__) . '/src/Util/Log.php');
require(dirname(__FILE__) . '/src/Util/YubeiObject.php');
require(dirname(__FILE__) . '/src/Util/HttpService.php');
require(dirname(__FILE__) . '/src/Util/Encryption.php');
// Errors
require(dirname(__FILE__) . '/src/Exception/Exception.php');
require(dirname(__FILE__) . '/src/Exception/InvalidParameterException.php');
require(dirname(__FILE__) . '/src/Exception/InvalidRequestException.php');
require(dirname(__FILE__) . '/src/Exception/InvalidResponseException.php');
require(dirname(__FILE__) . '/src/Exception/AuthorizationException.php');
// payment
require(dirname(__FILE__) . '/src/Charge.php');



