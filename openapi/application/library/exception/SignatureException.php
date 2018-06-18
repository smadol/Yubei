<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\library\exception;


class SignatureException extends BaseException
{
    public $code = 403;
    public $errorCode = 10009;
    public $msg = "invalid parameters";
}