<?php

if (!defined('_CAN_LOAD_FILES_'))
exit;


class ecm_buyme_pro extends Module
{
    private $_html = '';
    private $buymeCarriers = array(1=> 'Самовывоз',2=> 'Курьером',3=> 'Доставка транспортной компанией');
    function __construct()
    {
        $this->name = 'ecm_buyme_pro';
        $this->tab = 'checkout';
        $this->author = 'Elcommerce';
        $this->version = 0.1;

        parent::__construct();

        $this->displayName = $this->l("Кнопка быстрого заказа");
        $this->description = $this->l("Оформление заказов с помощью скрипта Buyme.");
    }

    function install()
    {
        return (parent::install() && $this->registerHook('displayProductButtons') && $this->addState());
    }





    private
    function _settings()
    {
        $carriers = Carrier::getCarriers($this->context->language->id, true, false, false, null, Carrier::ALL_CARRIERS);
        $this->_html .= '
        <fieldset class="space">
        <legend><img src="../img/admin/cog.gif" alt="" class="middle" />Настройки</legend>
        <label>Соответствие перевозчиков</label>
        <div class="margin-form">
        ';
        foreach ($this->buymeCarriers as $buymeCarrierId => $buymeCarrierName) {
            $this->_html .= "<div class ='group' id='group-name-$buymeCarrierId' ><b>$buymeCarrierName</b></div>
            <select name='carrier-$buymeCarrierId'  class='$buymeCarrierId' id='group-id-$buymeCarrierId'>";
            foreach ($carriers as $carrier) {
                $id           = $carrier['id_carrier'];
                $name_carrier = $carrier['name'];
                $this->_html .= "<option id ='$buymeCarrierId-$id' value='$id'";
                if (Configuration::get('_ECM_BUYMY_'.$buymeCarrierId.'_') == $id)
                $this->_html .= "selected='selected'";
                $this->_html .= ">$name_carrier</option>";
            }
            $this->_html .= "</select>";
        }
        $this->_html .= "</div>";
        $this->_html .= '
        <label>Передавать артикул в форму заказа</label>
        <div class="margin-form">
        <input type="checkbox" name="reference" value="1" ' . (Tools::getValue('reference',Configuration::get('_REF_'))? 'checked="checked" ' : '' ) . ' />
        <p class="clear"> Выберите "да" для включения.</p>
        </div>
        <label>Не показывать кнопку, если товара нет в наличии</label>
        <div class="margin-form">
        <input type="checkbox" name="zero" value="1" ' . (Tools::getValue('zero',Configuration::get('_ZERO_'))? 'checked="checked" ' : '' ) . ' />
        <p class="clear"> Выберите "да" для включения режима.</p>
        </div>
        <center><input type="submit" name="submitSETTING" value="Обновить" class="button" /></center>
        </fieldset>
        ';
    }

    function hookdisplayProductButtons($params)
    {
        global $smarty;
        global $cookie;
        $zero    = Configuration::get('_ZERO_');
        $product = new Product($_GET['id_product'], false, intval($cookie->id_lang));
        $art = $this->l("Ref.: ");
        if (Validate::isLoadedObject($product))
        $smarty->assign('product_b1c', array($product->name,(Configuration::get('_REF_')?" ".$art.$product->reference:'')));
        if ($zero == 1)    $quantity             = StockAvailable::getQuantityAvailableByProduct($_GET['id_product'], $id_product_attribute = null, $id_shop = null);
        else $quantity = 5;

        if (Validate::isLoadedObject($product)) $smarty->assign('product_available', $quantity);
        return $this->display(__FILE__, 'buyme.tpl');
    }
    private
    function _displayabout()
    {

        $this->_html .= '
        <fieldset class="space">
        <legend><img src="../img/admin/email.gif" /> ' . $this->l('Информация') . '</legend>
        <div id="dev_div">
        <span><b>' . $this->l('Версия') . ':</b> ' . $this->version . '</span><br>
        <span><b>' . $this->l('Разработчик') . ':</b> <a class="link" href="mailto:A_Dovbenko@mail.ru" target="_blank">Savvato</a>

        <span><b>' . $this->l('Описание') . ':</b> <a class="link" href="http://elcommerce.com.ua" target="_blank">http://elcommerce.com.ua</a><br><br>
        <p style="text-align:center"><a href="http://elcommerce.com.ua/"><img src="http://elcommerce.com.ua/img/m/logo.png" alt="Электронный учет коммерческой деятельности" /></a>


        </div>
        </fieldset>
        ';
    }
    private function addState()
    {
        $sql = "SELECT `id_order_state` FROM "._DB_PREFIX_."order_state_lang
        WHERE
        `id_lang` = '".(int)Configuration::get('PS_LANG_DEFAULT')."' AND
        `name` = 'Buyme'
        ";
        $id_order_state = Db::getInstance()->getValue($sql);
        if (!$id_order_state) {
            $color          = sprintf( '#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255) );
            Db::getInstance()->Execute("
                INSERT INTO `" . _DB_PREFIX_ . "order_state` (`unremovable`,`color`)
                VALUES (0,'".$color."')
                ");
            $id_order_state = Db::getInstance()->Insert_ID();
            Db::getInstance()->Execute("
                INSERT INTO `" . _DB_PREFIX_ . "order_state_lang` (`id_order_state`,`id_lang`,`name`)
                VALUES (".$id_order_state.",".(int)Configuration::get('PS_LANG_DEFAULT').", '".pSQL('Buyme')."')
                ");
        }
        if ($id_order_state)
        Configuration::updateValue('_ECM_BUYMY_STATE_',$id_order_state);
        return true;
    }
    function getContent()
    {
        $this->_html = '';
        if (Tools::isSubmit('submitSETTING')) {

            foreach ($this->buymeCarriers as $buymeCarrierId => $buymeCarrierName) {
                $selected_carrier = Tools::getValue('carrier-'.$buymeCarrierId);
                Configuration::updateValue('_ECM_BUYMY_'.$buymeCarrierId.'_', $selected_carrier);
            }
            $ref = ((isset($_POST['reference'])) && ($_POST['reference'] == '1'))? 1 : 0;
            Configuration::updateValue('_REF_', $ref);
            $zero = ((isset($_POST['zero'])) && ($_POST['zero'] == '1'))? 1 : 0;
            Configuration::updateValue('_ZERO_', $zero);
            $this->_html .= '
            <div class="bootstrap">
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Настройки успешно обновлены
            </div>
            </div>
            ';
        }
        $this->_html .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">';
        $this->_settings();
        $this->_displayabout();
        $this->_html .= '</form>';

        return $this->_html;
    }
}
