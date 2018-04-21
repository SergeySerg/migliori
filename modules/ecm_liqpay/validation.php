<?php



include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/ecm_liqpay.php');
$liqpay      = new ecm_liqpay();

$merchant_pass = $liqpay->liqpay_merchant_pass;
$merchant_id = $liqpay->liqpay_merchant_id;
$response     = $_POST['data'];
$signature     = base64_encode(sha1($merchant_pass.$response.$merchant_pass, 1));
//p($_POST['signature']);
//p($signature);
//output = json_decode(base64_decode($response), true);
//	d($output);
if($_POST['signature'] == $signature){

	$output = json_decode(base64_decode($response), true);
//	d($output);
	$errors       = '';
	$postvalidate = Configuration::get('liqpay_postvalidate');

	if($output['status'] == 'success' || $output['status'] == 'sandbox'){
		//$id_currency_uah = new Currency(intval(Currency::getIdByIsoCode('UAH')));
		$rest_amount     = floatval($output['amount']);
		if($postvalidate == 1)
		{
			$id_cart_= explode("-",$output['order_id']);
			$cart    = new Cart((int)$id_cart_[0]);
			$currency_order = new Currency($cart->id_currency);
			if (Configuration::get('liqpay_delivery'))
				$amount= $rest_amount;
			else
				$amount= $rest_amount + $cart->getOrderTotal(true, Cart::ONLY_SHIPPING);
			$transaction_id = 'liqpay Transaction ID: '.$output['transaction_id'].' '.@$output['sender_phone'];
			$liqpay->validateOrder($id_cart_[0], _PS_OS_PAYMENT_, $amount, $liqpay->displayName, $transaction_id);
			$ordernumber=Order::getOrderByCartId($cart->id);
			$order = new Order((int)$ordernumber);
		}
		else
		{
			$ordernumber_= explode("-",$output['order_id']);
			$ordernumber = (int)$ordernumber_[0];
			$order = new Order((int)$ordernumber);
			//Проверка существования заказа
			if(!Validate::isLoadedObject($order))
			{
				ecm_liqpay::validateAnsver($liqpay->l('Order does not exist'));
			}
			$currency_order = new Currency($order->id_currency);
			$total_to_pay   = $order->total_products_wt - $order->total_discounts;
			$total_to_pay   = number_format($total_to_pay, 2, '.', '');
			//$amount         = Tools::convertPriceFull($rest_amount,$id_currency_uah,$currency_order);
			//Проверка суммы заказа
			if (Configuration::get('liqpay_delivery'))
				$amount= $rest_amount;
			else
				$amount= $rest_amount + $order->total_shipping;
			if($amount != $total_to_pay)
			{
				ecm_liqpay::validateAnsver($liqpay->l('Incorrect payment summ'));
			}
			//Меняем статус заказа
			$history = new OrderHistory();
			$history->id_order = $ordernumber;
			$history->changeIdOrderState(_PS_OS_PAYMENT_, $ordernumber);
			$history->addWithemail(true);

		}
		$customer = new Customer((int)$order->id_customer);
		if ($order->hasBeenPaid())
			Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key.'&id_cart='.$order->id_cart.
				'&id_module='.$liqpay->id.'&id_order='.$order->id);
	}
	elseif($output['status'] == 'failure'){
		$liqpay->validateOrder($id_cart, _PS_OS_ERROR_, 0, $liqpay->displayName, $errors.'<br />');
	}
}
else
{
	Tools::redirectLink(__PS_BASE_URI__.'order.php');
}
?>
