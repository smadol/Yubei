<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\controller;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use think\Controller;
use think\Exception;
use think\Request;

class Test extends Controller
{
    // 下面为申请app获得的clientId和clientSecret，必填项，否则无法生成token
    public $clientId = 'AeQoPWrmDu_FqEn-v49hPkakimNj6Q5LlPIk6DqoNbwS10ZSoRaK42Dv9BC6UTVQ6mIpyz3zBs4XmIbu';
    public $clientSecret = 'EHLGtJUY_vpWbOBR2ZKM5ck3smCiD7LGYetb01k2kemFbLyxlz7n0hnh-2w_eONoq4DcnfyalzqUPU8d';
    public $apiContext = null;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        // After Step 1
        // ### ApiContext
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->clientId,
                $this->clientSecret
            )
        );
        $this->apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );
    }

    /**
     * 发起支付请求
     * @author 勇敢的小笨羊
     */
    public function pay(){
        // After Step 2
        // ### Payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");


        // ### Itemized information
        $item1 = new Item();
        $item1->setName('test pro 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("testpro1_01") // Similar to `item_number` in Classic API
            ->setPrice(20);
        $item2 = new Item();
        $item2->setName('test pro 2')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("testpro2_01") // Similar to `item_number` in Classic API
            ->setPrice(10);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        // 自定义用户收货地址，避免用户在paypal上账单的收货地址和销售方收货地址有出入
        // 这里定义了收货地址，用户在支付过程中就不能更改收货地址，否则，用户可以自己更改收货地址
        $address = new ShippingAddress();
        $address->setRecipientName('什么名字')
            ->setLine1('什么街什么路什么小区')
            ->setLine2('什么单元什么号')
            ->setCity('城市名')
            ->setState('浙江省')
            ->setPhone('12345678911')
            ->setPostalCode('12345')
            ->setCountryCode('CN');

        $itemList->setShippingAddress($address);


        // ### Additional payment details
        $details = new Details();
        $details->setShipping(5)
            ->setTax(10)
            ->setSubtotal(70);

        // ### Amount
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(85) //设置金额  这个金额一定要是上面的Shipping+Tax+Subtotal 之和
            ->setDetails($details);

        // ### Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl( "http://api.yubei.cn/test/exec.php?success=true") //支付成功跳转
                     ->setCancelUrl( "http://api.yubei.cn/test/cancel.php?success=false"); //取消支付返回

        // ### Payment
        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        try{
            $payment->create($this->apiContext); //or any similar calls
        }catch(PayPalConnectionException $e){
            halt($e->getData());
        }
        $approvalUrl = $payment->getApprovalLink();
        // 打印出用户授权地址，这里仅仅实现支付过程，流程没有进一步完善。
        header("Location: {$approvalUrl}");
    }

    public function exec(){
        // ### Approval Status
        // Determine if the user approved the payment or not
        if (isset($_GET['success']) && $_GET['success'] == 'true') {

            // Get the payment Object by passing paymentId
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $this->apiContext);

            // ### Payment Execute
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            // ### Optional Changes to Amount
            // If you wish to update the amount that you wish to charge the customer,
            // based on the shipping address or any other reason, you could
            // do that by passing the transaction object with just `amount` field in it.
            // Here is the example on how we changed the shipping to $1 more than before.
            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

            $details->setShipping(5)
                ->setTax(10)
                ->setSubtotal(70);

            $amount->setCurrency('USD');
            $amount->setTotal(85);
            $amount->setDetails($details);
            $transaction->setAmount($amount);

            // Add the above transaction object inside our Execution object.
            $execution->addTransaction($transaction);

            try {
                // Execute the payment
                $result = $payment->execute($execution, $this->apiContext);
                echo "支付成功";
            } catch (Exception $ex) {
                echo "支付失败";
                exit(1);
            }

            return $payment;
        } else {
            echo "PayPal返回回调地址参数错误";
        }
    }
}