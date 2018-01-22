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
class Cart extends CartCore
{
    /*
    * module: onepagecheckout
    * date: 2018-01-22 23:06:43
    * version: 2.3.8
    */
    public function resetCartDiscountCache()
    {
        self::$_discounts     = NULL;
        self::$_discountsLite = NULL;
    }
}
