<?php
/**
 * roja45recommendproducts
 *
 * @category  roja45recommendproducts
 * @author    Roja45 <support@roja45.com>
 * @copyright 2016 Roja45
 * @license   license.txt
 * @link      http://www.roja45.com/
 *
 * 2016 ROJA45 - All rights reserved.
 *
 * DISCLAIMER
 * Changing this file will render any support provided by us null and void.
 */

require_once dirname(__FILE__).'../../../config/config.inc.php';
require_once dirname(__FILE__).'../../../init.php';

$context = Context::getContext();
switch (Tools::getValue('method')) {
    case 'searchForProducts':
        $products = Product::searchByName((int) $context->language->id, pSQL(Tools::getValue('search')));

        if ($products) {
            foreach ($products as &$product) {
                // Formatted price
                $productObj = new Product((int) $product['id_product'], false, (int) $context->language->id);
            }
            $to_return = array(
                'products' => $products,
                'found' => true,
            );
        } else {
            $to_return = array('found' => false);
        }

        die(Tools::jsonEncode($to_return));
        break;
    default:
        exit;
}
exit;
