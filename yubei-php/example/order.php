<?php

namespace Yubei\example;

// 初始化类库
use Yubei\Util\Log;

require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/config.php';

class Charge
{

    /**
     * @throws \Yubei\Exception\Exception
     * @throws \Yubei\exception\AuthorizationException
     * @throws \Yubei\exception\InvalidRequestException
     */
    public function charge(){
        $data = [
            "out_trade_no" => $_POST['out_trade_no'],
            "subject" => $_POST['subject'],
            "body" => $_POST['subject'],
            "amount" =>$_POST['amount'],
            "currency" =>'CNY',
            "channel" => strtoupper($_POST['channel']), //支付方式
            "extparam" => [
                "openid" => "ow_adnfkewnlalaNLNfBJfghyrkBL"
            ], //支付附加参数
        ];
        // 创建支付订单对象
        $order = \Yubei\Charge::create($data);
        Log::Init();
        Log::DEBUG($order);
        return $order;
    }
}

$chargeObj = new Charge();
$order = $chargeObj->charge();
//var_dump($order);die;
$qrcode = $order['charge']['credential']['order_qr'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网上支付 安全便捷 | 余呗</title>
    <link rel="shortcut icon" href="https://www.98imo.com/favicon.ico">
   <!-- Javascript-->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
</head>

</head>
<body style="background-color: #f7f9fa;">
<div style="margin: -15px; padding: 8vh 0 2vh;color: #a6aeb3; background-color: #f7f9fa; text-align: center; font-family:NotoSansHans-Regular,'Microsoft YaHei',Arial,sans-serif; -webkit-font-smoothing: antialiased;">
    <div style="width: 750px; max-width: 85%; margin: 0 auto; background-color: #fff; -webkit-box-shadow: 0 2px 16px 0 rgba(118,133,140,0.22);-moz-box-shadow: 0 2px 16px 0 rgba(118,133,140,0.22);box-shadow: 0 2px 16px 0 rgba(118,133,140,0.22);">
        <div style="padding: 20px 10%; text-align: center; font-size: 16px;line-height: 16px;">
            <a href="https://www.98imo.com" style="vertical-align: top;" target="_blank"> <img style="margin:32px auto; max-width: 95%; color: #0e2026;" src="https://www.98imo.com/assets/logo-black.png" /> </a>
        </div>
        <table width="600" style="background-color:#fff;margin:0 auto;" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <td>
                    <table width="600" style="background-color:#fff;margin:0 auto;" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td width="40">&nbsp;</td>
                            <td width="520" style="line-height:20px;">
                                <p style="text-align:center;margin:0;padding:0;">
                                    <span style="font-size:24px;line-height:32px;color:#35B34A;">扫码立即支付</span>
                                </p>
                                <p>标题：<?php echo $_POST['subject'] ;?></p>
                                <p>单号：<?php echo $_POST['out_trade_no'] ;?></p>
                                <p>金额：<?php echo $_POST['amount'] ;?></p>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="height:44px; width:200px">
                                <tbody>
                                <tr>
                                    <td style="padding: 30px; height:44px; line-height:44px;text-align:center; width:200px">
                                        <div class="qr-image" id="qrcode">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="padding-bottom: 40px;font-size: 14px;">
            <div style="padding-bottom: 40px;font-size: 14px;">
                <div style="width: 420px; max-width: 90%;margin: 10px auto;">
                    彻底告别繁琐的支付接入流程 一次接入所有主流支付渠道和分期渠道，99.99% 系统可用性，满足你丰富的交易场景需求,为你的用户提供完美支付体验。
                </div>
                <div>
                    <span style="color: #76858c;">服务咨询请联系：</span>
                    <a href="mailto:yubei@98imo.com" style="color:#35c8e6; text-decoration: none;" target="_blank"> yubei@98imo.com </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./js/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("qrcode", {
        text: "<?php echo $qrcode; ?>",
        width: 230,
        height: 230,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    // 订单详情
    $('#orderDetail .arrow').click(function (event) {
        if ($('#orderDetail').hasClass('detail-open')) {
            $('#orderDetail .detail-ct').slideUp(500, function () {
                $('#orderDetail').removeClass('detail-open');
            });
        } else {
            $('#orderDetail .detail-ct').slideDown(500, function () {
                $('#orderDetail').addClass('detail-open');
            });
        }
    });
    //支付超时
    setTimeout(function () {
        window.close();
    }, 300000);
</script>
</body>
</html>