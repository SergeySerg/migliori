<?php
/**
* NOTICE OF LICENSE
*
*   This file is property of Petr Hucik. You may NOT redistribute the code in any way
*   See license.txt for the complete license agreement
*
* @author    Petr Hucik
* @website   https://www.getdatakick.com
* @copyright Petr Hucik <petr@getdatakick.com>
* @license   see license.txt
* @version   2.1.3
*/
namespace Datakick;

class NotFunction extends Func {
    public function __construct() {
      parent::__construct('not', 'boolean', array(
        'names' => array('a'),
        'types' => array('boolean')
      ), true);
    }

    public function evaluate($args, $argsTypes, Context $context) {
        return ! $args[0];
    }

    public function jsEvaluate() {
      return 'return !a';
    }

    public function getSqlExpression($args, $type, $argTypes, $query, Context $context) {
        return "(1 - {$args[0]})";
    }
}