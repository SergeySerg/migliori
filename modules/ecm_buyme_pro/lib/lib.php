<?php
class lib
{
    public static
    function createorder($id_customer, $id_adress,$id_carrier,$qty,$id_product,$id_product_attribute)
    {
        global $smarty, $cookie, $context;
        $currency = new Currency((int)Configuration::get('PS_CURRENCY_DEFAULT'));
        if (!$context) {
            $context = Context::getContext();
        }
        $context->currency = $currency;
        $id_employee = 1;
        $token       = Tools::getAdminToken('AdminOrders'.(int)(Tab::getIdFromClassName('AdminOrders')).$id_employee);
        $current_state = (int)Configuration::get('_ECM_BUYMY_STATE_');
        $payment_display       = 'Заказ в 1 клик';
        $module        = 'ecm_buyme';
        $customer      = New Customer($id_customer);
        $cart          = New Cart();
        $cart->id_address_delivery = $id_adress;
        $cart->id_address_invoice = $id_adress;
        $cart->id_currency = (int)Configuration::get('PS_CURRENCY_DEFAULT');
        $cart->id_lang = (int)Tools::getValue('id_lang');
        $cart->id_carrier = $id_carrier;
        $cart->id_customer = $id_customer;
        $cart->id_shop = (int)Configuration::get('PS_SHOP_DEFAULT');
        $cart->add();
        $id_cart = (int)$cart->id;
        $cart->updateQty($qty, $id_product, $id_product_attribute);
        $total = $cart->getOrderTotal(false, Cart::ONLY_PHYSICAL_PRODUCTS_WITHOUT_SHIPPING);
        $cart->update();
        $shipping = $cart->getPackageShippingCost($id_carrier);
        $paid     = $total + $shipping;
        $order    = New Order();
        $order->id_address_delivery = $id_adress;
        $order->id_address_invoice = $id_adress;
        $order->id_currency = (int)Configuration::get('PS_CURRENCY_DEFAULT');
        $order->id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $order->id_shop = (int)Configuration::get('PS_SHOP_DEFAULT');
        $order->id_customer = $id_customer;
        $order->id_cart = $id_cart;
        $order->id_carrier = $id_carrier;
        $order->payment = $payment_display;
        $order->module = $module;
        $order->recyclable = 0;
        $order->total_shipping = $order->total_shipping_tax_incl = $order->total_shipping_tax_excl = $shipping;
        $order->total_products = $total;
        $order->total_products_wt = $total;
        $order->total_paid = $order->total_paid_tax_incl = $order->total_paid_tax_excl = $paid;
        $order->current_state = $current_state;
        $order->total_paid_real = 0;
        $order->conversion_rate = ($currency ? $currency->conversion_rate : 1);
        $order->secure_key = $customer->secure_key;
        $order->add();
        $id_order = $order->id;
        $order->reference = $order->generateReference();
        if (defined('_ID_AS_REF_')) {
            if (_ID_AS_REF_) {
                $order->reference = $id_order;
            }
        }
        $OrderDetail = New OrderDetail();
        $OrderDetail->createList($order, $cart, $current_state, $cart->getProducts());
        $OrderCarrier= New OrderCarrier();
        $OrderCarrier->id_order = $id_order;
        $OrderCarrier->id_carrier = $id_carrier;
        $OrderCarrier->shipping_cost_tax_incl = $OrderCarrier->shipping_cost_tax_excl = $shipping;
        $OrderCarrier->add();
        $OrderHistory = New OrderHistory();
        $OrderHistory->id_order = (int)$id_order;
        $OrderHistory->id_employee = (int)$id_employee;
        $OrderHistory->changeIdOrderState(3, $id_order);
        $OrderHistory->addWithemail();
        $params['order'] = $order;
        $params['customer'] = $customer;
        $params['currency'] = $currency;
        $params['cart'] = $cart;
        $current_state = new OrderState($current_state);
        $params['orderStatus'] = $current_state;
        Module::HookExec('ActionValidateOrder', $params);
        $order->current_state = 3;
        $order->update();
        return $id_order;
    }
    public static
    function addcustomer($name,$phone,$email,$adress)
    {
        global $cookie;
        $customer       = new Customer();
        $isset_customer = $customer->getByEmail($email,null,false);
        if (!$isset_customer) {
            $customer->firstname = $name;
            $customer->lastname = ' ';
            $customer->email = $email;
            $customer->is_guest = Configuration::get('PS_GUEST_CHECKOUT_ENABLED')? 1 : 0;
            $pwd = Tools::passwdGen();
            $customer->passwd = md5(_COOKIE_KEY_.$pwd);
            $errors = $customer->validateControler();
            if (!sizeof($errors)) {
                $customer->active = 1;
                if (!$customer->add()) {
                    $errors[] = Tools::displayError('an error occurred while creating your account');
                }
                else {
                    Mail::Send(
                        $cookie->id_lang,
                        'account',
                        Mail::l('Welcome!'),
                        array(
                            '{firstname}'=> $customer->firstname,
                            '{lastname}' => $customer->lastname,
                            '{email}'    => $customer->email,
                            '{passwd}'   => $pwd),
                        $customer->email,
                        $customer->firstname.' '.$customer->lastname
                    );
                }
            }
            return $customer;
        }
        return $isset_customer;
    }

    public static
    function get_address($customer,$adress,$phone)
    {
        $sql        = "SELECT `id_address` FROM "._DB_PREFIX_."address
        WHERE
        `id_customer` = '".$customer->id."' AND
        `address1` = '".$adress."' AND
        `deleted` != '1'
        ";
        $id_address = Db::getInstance()->getValue($sql);
        if (!$id_address) {
            $address = new Address ();
            $address->id_customer = $customer->id;
            $address->id_state = 0;
            $address->alias = 'My Address';
            $address->id_country = Configuration::get('PS_COUNTRY_DEFAULT');
            $address->address1 = $adress;
            $address->city = 'dummyvalue';
            $address->firstname = $customer->firstname;
            $address->lastname = $customer->lastname;
            $address->phone_mobile = $phone;
            $address->phone = $phone;
            $address->add();
            $id_address = $address->id;
        }
        return $id_address;
    }

}
