<?php
/**
 * Author: Single Dog
 * Github: https://github.com/SingleSheep
 * Date: 2018/2/9 - 17:23
 */

namespace app\library\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = 'Business do not exist.';
    public $errorCode = 60000;
}