<?php

namespace app\library\exception;

/**
 * token验证失败时抛出此异常 
 */
class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = 'Unauthorized access';
    public $errorCode = 10001;
}