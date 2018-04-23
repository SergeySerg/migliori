<?php
// Buyme 1.3.0 2013 by Nazar Tokar
// dedushka.org * nazartokar.com * a@dedushka.org
include(dirname(__FILE__) . '/../../../config/config.inc.php');
include(dirname(__FILE__) . '/lib.php');
define('_ID_AS_REF_', true);
global $cookie,$id_order;
function echoResult($result, $class, $time, $message)
{
    // выводим данные json
    echo '{
    "result": "'.$result.'",
    "cls": "'.$class.'",
    "time": "'.$time.'",
    "message": "'.$message.'" }';
    exit();
}
function uc($s)
{
    $s = urlencode($s);
    return $s;
}

function gF($s)
{
    // no shit
    $s = substr((htmlspecialchars($_GET[$s])), 0, 500);
    if (strlen($s) > 1) return $s;
}


$l["sent"] = "Заказ уже был отправлен";
$l["err"] = "Пожалуйста, заполните все поля";
$l["ok"] = "Спасибо, заказ №".@$id_order." принят. Ждите звонка";
$l["title"] = "Новый заказ";


// далее можно не трогать

$time     = time(); // время отправки
$interval = $time - gF("time");
if ($interval < 1) {
    // если прошло менее (сек)
    echoResult('err', 'b1c-err', '', $l["sent"]);
} else {

    $options = $_GET["os"];

    if (count($options) > 1) {
        // data to send
        $ids_data       = $_GET["hs"];
        $name           = $options[0];
        $lastname       = '.';
        $phone          = $options[1];
        $email          = trim($options[2]);
        $adress         = $options[3];
        $delivery_metod = $options[4];
        switch ($delivery_metod) {
            case 'Самовывоз':
            $id_carrier = Configuration::get('_ECM_BUYMY_1_');
            break;
            case 'Курьером':
            $id_carrier = Configuration::get('_ECM_BUYMY_2_');
            break;
            case 'Доставка транспортной компанией':
            $id_carrier = Configuration::get('_ECM_BUYMY_3_');
            break;
        }
        $customer = lib::addcustomer($name,$phone,$email,$adress);
        $id_adress= lib::get_address($customer,$adress,$phone);
        foreach ($ids_data as $id) {
            $data = explode("_",$id);
            if ($data[0] == 'idProduct')
            $id_product = $data[1];
            elseif ($data[0] == 'idCombination')
            $id_product_attribute = $data[1];
            elseif ($data[0] == 'quantity')
            $qty = $data[1];

        }
        if (!@$id_product_attribute)$id_product_attribute = 0;
        $id_order             = lib::createorder($customer->id, $id_adress,$id_carrier,$qty,$id_product,$id_product_attribute);
        if ($customer->customerExists($email)) {

            $cookie->id_customer = intval($customer->id);
            $cookie->customer_lastname = $customer->lastname;
            $cookie->customer_firstname = $customer->firstname;
            $cookie->logged = 1;
            $cookie->passwd = $customer->passwd;
            $cookie->email = $customer->email;
            $cookie->is_guest = 0;

        }
        $l["ok"] = "Спасибо, заказ № ".@$id_order." принят. Ждите звонка";
        echoResult("ok", "b1c-ok", $time, $l["ok"]);
    } else {
        echoResult("err", "b1c-err", "", $l["err"]);
    }

}
?>
