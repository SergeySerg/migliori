<?php
/**
* NOTICE OF LICENSE
*
* This source file is subject to the Software License Agreement
* that is bundled with this package in the file LICENSE.txt.
* 
*  @author    Peter Sliacky
*  @copyright 2009-2015 Peter Sliacky
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0) 
*/
class Customer extends CustomerCore
{
    /*
    * module: onepagecheckout
    * date: 2018-01-22 23:06:43
    * version: 2.3.8
    */
    private static function isOpcModuleActive()
    {
        $opc_mod_script = _PS_MODULE_DIR_ . 'onepagecheckout/onepagecheckout.php';
        if (file_exists($opc_mod_script)) {
            require_once($opc_mod_script);
            $opc_mod = new OnePageCheckout();
            return $opc_mod->active;
        } else {
            return 0;
        }
    }
    static /*
    * module: onepagecheckout
    * date: 2018-01-22 23:06:43
    * version: 2.3.8
    */
    public function customerExists($email, $return_id = false, $ignoreGuest = true)
    {
        if (!self::isOpcModuleActive())
            return parent::customerExists($email, $return_id, $ignoreGuest);
        if (!Validate::isEmail($email))
            die (Tools::displayError());
        if (Tools::isSubmit('submitAccount')) {
            return false;
        } else {
            return parent::customerExists($email, $return_id, $ignoreGuest);
        }
    }
    static /*
    * module: onepagecheckout
    * date: 2018-01-22 23:06:43
    * version: 2.3.8
    */
    public function getLastTwoCustomerAddressIds($id_customer, $active = true)
    {
        if ($id_customer == 0)
            return 0;
        $query = '
                        SELECT `id_address`
                        FROM `' . _DB_PREFIX_ . 'address`
                        WHERE `id_customer` = ' . (int)($id_customer) . ' AND `deleted` = 0' . ($active ? ' AND `active` = 1' : '') .
            ' ORDER BY id_address DESC limit 2';
        $result = Db::getInstance()->ExecuteS($query);
        $ret    = array();
        foreach ($result AS $k => $address) {
            $ret[] = ($address["id_address"]);
        }
        return $ret;
    }
    static /*
    * module: onepagecheckout
    * date: 2018-01-22 23:06:43
    * version: 2.3.8
    */
    public function getFirstCustomerId($active = true)
    {
        $query = '
                        SELECT `id_customer`
                        FROM `' . _DB_PREFIX_ . 'customer`
                        WHERE `deleted` = 0' . ($active ? ' AND `active` = 1' : '') .
            ' ORDER BY id_customer ASC';
        $x = Db::getInstance()->getValue($query);
        return $x;
    }
    /*
    * module: onepagecheckout
    * date: 2018-01-22 23:06:43
    * version: 2.3.8
    */
    public static function customerHasAddress($id_customer, $id_address)
    {
        if (!self::isOpcModuleActive())
            return parent::customerHasAddress($id_customer, $id_address);
        if (!Tools::isSubmit('delete'))
            return true;
        else
            return parent::customerHasAddress($id_customer, $id_address);
    }
}
