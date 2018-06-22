<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\logic\gateway;

use app\library\exception\ForbiddenException;
use app\library\exception\SignatureException;
use app\logic\Encryption;
use think\Request;

/**
 * 检验网关签名
 */
class CheckSign extends ApiCheck
{
    /**
     * 签名校验
     *
     * @author 勇敢的小笨羊
     * @param Request $request
     * @throws ForbiddenException
     * @throws SignatureException
     */
    public function doCheck(Request $request)
    {
        $header = [];
        $header = !is_null($request->header())?$request->header():$header;
        $_cur_uri = $_cur_uri_query_string = stristr($header['resturl'],'/pay/');
        $_query_string = $_query_string_index = strpos($_cur_uri_query_string,'?');
        if (!empty($_query_string_index)){
            $_cur_uri = substr($_cur_uri_query_string,0,$_query_string_index);//uri
            $_query_string = substr($_cur_uri_query_string,$_query_string_index+1);//query string
        }
        $_to_verify_data = utf8_encode($_cur_uri)
            ."\n".utf8_encode($_query_string)
            ."\n".utf8_encode($header['noncestr'])
            ."\n".utf8_encode($header['timestamp'])
            ."\n".utf8_encode($header['authentication'])
            ."\n".utf8_encode(json_encode($request->post()));
        if(empty($header['signature'])){
            throw new SignatureException(['msg'=>'Invalid Request.[Request header[signature] Failure.]']);
        }
        //验签
        $verify_result = Encryption::to_verify_data($_to_verify_data, $header['signature']);
        if(empty($verify_result) || intval($verify_result)!=1){
            throw new ForbiddenException(['msg'=>'Invalid Request.[Request Data And Sign Verify Failure.]']);
        }
        return;
    }
}
