<?php
namespace app\library\exception;

/**
 * 404时抛出此异常
 */
class MissException extends BaseException
{
    public $code = 404;
    public $msg = 'Global: Your Required Resource Are Not Found';
    public $errorCode = 10001;
}