<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Request;

/**
 * 通用化API接口数据输出
 *
 * @param $code
 * @param $message
 * @param array $data
 * @param int $httpCode
 * @return \think\response\Json
 */
function result( $code, $message = '', $data=[], $httpCode=200) {
    $data = [
        'code'  => $code,
        'msg'   => $message,
        'data'  => $data
    ];
    return json($data, $httpCode);
}

/**
 * Md5 盐加密
 * md5加密后base64编码返回
 * @param $str
 * @return string
 */
function xmd5($str){
    return base64_encode(md5($str . md5(config('app.md5key'))));
}


/**
 * 获取随机字符
 * @param string $length
 * @param $format
 * @return null|string
 */
function getRandChar($length = '4',$format = '')
{
    switch($format){
        case 'ALL':
            $strPol='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $strPol='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $strPol='0123456789';
            break;
        default :
            $strPol='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    $str = null;
    //$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    for ($i = 0;
         $i < $length;
         $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}

/**
 * excel表格导出
 * @param string $fileName 文件名称
 * @param array $headArr 表头名称
 * @param array $data 要导出的数据
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 * @throws PHPExcel_Writer_Exception
 */
function excelExport($fileName = '', $headArr = [], $data = []) {

    $fileName .= "_" . date("Y_m_d", Request::instance()->time()) . ".xlsx";

    $objPHPExcel = new \PHPExcel();

    $objPHPExcel->getProperties();

    $key = ord("A"); // 设置表头

    foreach ($headArr as $v) {

        $colum = chr($key);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);

        $key += 1;

    }

    $column = 2;

    $objActSheet = $objPHPExcel->getActiveSheet();

    foreach ($data as $key => $rows) { // 行写入

        $span = ord("A");

        foreach ($rows as $keyName => $value) { // 列写入

            $objActSheet->setCellValue(chr($span) . $column, $value);

            $span++;

        }

        $column++;

    }

    $fileName = iconv("utf-8", "gb2312", $fileName); // 重命名表

    $objPHPExcel->setActiveSheetIndex(0); // 设置活动单指数到第一个表,所以Excel打开这是第一个表

    header('Content-Type: application/vnd.ms-excel');

    header("Content-Disposition: attachment;filename='$fileName'");

    header('Cache-Control: max-age=0');

    $objWriter =  \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    $objWriter->save('php://output'); // 文件通过浏览器下载

    exit();

}
