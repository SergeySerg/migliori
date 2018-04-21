<?php
class ecm_liqpayredirectModuleFrontController extends ModuleFrontController
{
    public $display_header = true;
    public $display_column_left = true;
    public $display_column_right = true;
    public $display_footer = true;
    public $ssl = true;

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();

        if($id_cart=Tools::getValue('id_cart'))
        {
            $myCart=new Cart($id_cart);
            if(!Validate::isLoadedObject($myCart))
                $myCart=$this->context->cart;
        }else
            $myCart=$this->context->cart;
        $currency = new Currency($myCart->id_currency);
        if (Configuration::get('liqpay_delivery'))
			//$amount= $amount_;
			$amount = $myCart->getOrderTotal(true, Cart::BOTH);
		else
			//$amount= $amount_-$delivery_cost;
			$amount = $myCart->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING);
        $amount = number_format($amount, 2, '.', '');
		$currency = $currency->iso_code == 'RUR' ? 'RUB' : $currency->iso_code;
        $id_cart = $myCart->id;
        $details = $this->module->l('Payment for cart № ').$id_cart;
        if ($postvalidate=Configuration::get('liqpay_postvalidate'))
            $order_number=$myCart->id;
        else
        {
            if(!($order_number=Order::getOrderByCartId($myCart->id)))
            {
                $this->module->validateOrder((int)$myCart->id, Configuration::get('EC_OS_WAITPAYMENT'), $amount, $this->module->displayName, NULL, array(), NULL, false, $myCart->secure_key);
                $order_number=$this->module->currentOrder;
                $details = $this->module->l('Payment for order № ').$order_number;
            }
        }
		$ssl_enable = Configuration::get('PS_SSL_ENABLED');
		$base = (($ssl_enable) ? 'https://' : 'http://');
		$server_url =  $base.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/ecm_liqpay/validation.php';
		$success_url =  $this->context->link->getModuleLink('ecm_liqpay', 'success', array('order_id' => $order_number), true);
		$type = 'buy';
		$version = '3';
		$language = Configuration::get('PS_LANG_DEFAULT') == 'ru' ? 'en' : 'ru';
		$data = base64_encode(
			        json_encode(
						    array('version'     => $version,
						    	  'public_key'  => Tools::getValue('liqpay_id', $this->module->liqpay_merchant_id),
						    	  'amount'      => $amount,
						    	  'currency'    => $currency,
						 		  'description' => $details,
						    	  'order_id'    => $order_number.'-'.uniqid(),
						    	  'type'        => $type,
						    	  'language'    => $language,
						    	  'server_url'  => $server_url,
						    	  'result_url'  => $success_url
						    	  )
			        			)
		        			);
		$signature = base64_encode(sha1( $this->module->liqpay_merchant_pass.$data.$this->module->liqpay_merchant_pass, 1));
		$this->context->smarty->assign(compact('data', 'signature'));
        $this->setTemplate('redirect.tpl');
	}
    }

