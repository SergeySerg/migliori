<?php
/*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision: 14011 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class BlockCartAccessories extends Module
{
	public function __construct()
	{
		$this->name = 'blockcartaccessories';
		$this->tab = 'front_office_features';
		$this->version = '2.1';
		$this->author = 'ckarone';
		$this->need_instance = 0;
		$this->bootstrap = true;
		
		parent::__construct();
		$this->displayName = $this->l('Cartaccessories');
		$this->description = $this->l('Display accessories on the basket page and customize the home page based on the customers navigation');
		$this->confirmUninstall = $this->l('Do you realy want to uninstal blockcartaccessories?');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}
		
	public function install()
	{
		return parent::install()
            && $this->registerHook('displayHeader')
            && $this->registerHook('displayHome')
            && $this->registerHook('displayShoppingCart')
            && Configuration::updateValue('BCACC_ACCPRLIM', '7')
            && Configuration::updateValue('BCACC_ACCLIM', '200')
            && Configuration::updateValue('BCACC_PRD_LINK', '1')
            && Configuration::updateValue('BCACC_HOMFEAT', '1')
            && Configuration::updateValue('BCACC_HOMFEAT_W', '1')
            && Configuration::updateValue('BCACC_PRORDER', '1')
            && Configuration::updateValue('BCACC_PVIEWED', '1')
            && Configuration::updateValue('BCACC_HOM', '1')
            && Configuration::updateValue('BCACC_HOM_VIE', '1')
            && Configuration::updateValue('BCACC_HOM_SAM', '1')
            && Configuration::updateValue('BCACC_HOM_ACC', '1')
            && Configuration::updateValue('BCACC_HOM_JS', '1')
            && Configuration::updateValue('BCACC_HOM_BV', '1')
            && Configuration::updateValue('BCACC_HOM_BQ', '1')
            && Configuration::updateValue('BCACC_SLID1', '4')
            && Configuration::updateValue('BCACC_SLID2', '4')
            && Configuration::updateValue('BCACC_SLID3', '3')
            && Configuration::updateValue('BCACC_SLID4', '2')
            && Configuration::updateValue('BCACC_SLID5', '1')
            && Configuration::updateValue('BCACC_SLID6', '1')
            && Configuration::updateValue('BCACC_SLID7', '1')
            && Configuration::updateValue('BCACC_SLID8', '1')
            && Configuration::updateValue('BCACC_SLID9', '1')
            && Configuration::updateValue('BCACC_SLID10', '1')
            && Configuration::updateValue('BCACC_SLID11', '1')
            && Configuration::updateValue('BCACC_SLID12', '1')
            && Configuration::updateValue('BCACC_SLID13', '1')
            && Configuration::updateValue('BCACC_SLID14', '1');
	}
	public function uninstall()
	{
		return parent::uninstall()
			&& Configuration::deleteByName('BCACC_ACCPRLIM')
			&& Configuration::deleteByName('BCACC_ACCLIM')
			&& Configuration::deleteByName('BCACC_PRD_LINK')
			&& Configuration::deleteByName('BCACC_HOMFEAT')
			&& Configuration::deleteByName('BCACC_HOMFEAT_W')
			&& Configuration::deleteByName('BCACC_PRORDER')
			&& Configuration::deleteByName('BCACC_PVIEWED')
			&& Configuration::deleteByName('BCACC_HOM')
			&& Configuration::deleteByName('BCACC_HOM_VIE')
			&& Configuration::deleteByName('BCACC_HOM_SAM')
			&& Configuration::deleteByName('BCACC_HOM_ACC')
            && Configuration::deleteByName('BCACC_HOM_JS')
            && Configuration::deleteByName('BCACC_HOM_BV')
            && Configuration::deleteByName('BCACC_HOM_BQ')
            && Configuration::deleteByName('BCACC_SLID1')
            && Configuration::deleteByName('BCACC_SLID2')
            && Configuration::deleteByName('BCACC_SLID3')
            && Configuration::deleteByName('BCACC_SLID4')
            && Configuration::deleteByName('BCACC_SLID5')
            && Configuration::deleteByName('BCACC_SLID6')
            && Configuration::deleteByName('BCACC_SLID7')
            && Configuration::deleteByName('BCACC_SLID8')
            && Configuration::deleteByName('BCACC_SLID9')
            && Configuration::deleteByName('BCACC_SLID10')
            && Configuration::deleteByName('BCACC_SLID11')
            && Configuration::deleteByName('BCACC_SLID12')
            && Configuration::deleteByName('BCACC_SLID13')
            && Configuration::deleteByName('BCACC_SLID14');
	}
	public function getContent()
	{
		global $cookie;	
		$this->postProcess();	
        $this->postProcessSlider();
        $theform = $this->_displayForm();
        return $theform .= $this->_displayFormSlider();
	}
    /*
     * Update configuration values
     */
	public function postProcess()
	{
		$this->_html = '';
		if (Tools::isSubmit('submitBlockCartAcc'))
		{
			$bcaccprlim = Tools::getValue('bcaccprlim');
			$bcacclink = Tools::getValue('bcacclink');
			$bcacchf = Tools::getValue('bcacchf');
			$bcacchfw = Tools::getValue('bcacchfw');
			$bcacporder = Tools::getValue('bcacporder');
			$bcacpviewed = Tools::getValue('bcacpviewed');
			$bcach = Tools::getValue('bcach');
			$bcachsam = Tools::getValue('bcachsam');
			$bcachacc = Tools::getValue('bcachacc');
			$bcachjs = Tools::getValue('bcachjs');
            $bcachbv = Tools::getValue('bcachbv');
            $bcachbq = Tools::getValue('bcachbq');
			  //detection des erreurs
			  if (!$bcaccprlim OR $bcaccprlim <= 0 OR !Validate::isInt($bcaccprlim))
			  	$this->_html = $this->displayError($this->l('Invalid max qty product'));
			  else{
				Configuration::updateValue('BCACC_ACCPRLIM', (int)($bcaccprlim));
				Configuration::updateValue('BCACC_PRD_LINK', (int)($bcacclink));
				Configuration::updateValue('BCACC_HOMFEAT', (int)($bcacchf));
				Configuration::updateValue('BCACC_HOMFEAT_W', (int)($bcacchfw));
				Configuration::updateValue('BCACC_PRORDER', (int)($bcacporder));
				Configuration::updateValue('BCACC_PVIEWED', (int)($bcacpviewed));
				Configuration::updateValue('BCACC_HOM', (int)($bcach));
				Configuration::updateValue('BCACC_HOM_SAM', (int)($bcachsam));
				Configuration::updateValue('BCACC_HOM_ACC', (int)($bcachacc));
				Configuration::updateValue('BCACC_HOM_JS', (int)($bcachjs));
                Configuration::updateValue('BCACC_HOM_BV', (int)($bcachbv));
                Configuration::updateValue('BCACC_HOM_BQ', (int)($bcachbq));
			 $this->_html = $this->displayConfirmation($this->l('Settings updated successfully'));
			  }
		}
		return $this->_html;
	}
    /*
     * Update slider configuration values
     */
    public function postProcessSlider()
    {
        $this->_html = '';
        if (Tools::isSubmit('submitBlockCartAccSlider')) 
        {
            $bcaccmaxacc = Tools::getValue('bcaccmaxacc');
            if (!$bcaccmaxacc OR $bcaccmaxacc <= 0 OR !Validate::isInt($bcaccmaxacc))
                $this->_html = $this->displayError($this->l('Invalid number of characters for products description'));

            Configuration::updateValue('BCACC_SLID1', (int)(Tools::getValue('items_wide2')));
            Configuration::updateValue('BCACC_SLID2', (int)(Tools::getValue('items_desktop2')));
            Configuration::updateValue('BCACC_SLID3', (int)(Tools::getValue('items_desktop_small2')));
            Configuration::updateValue('BCACC_SLID4', (int)(Tools::getValue('items_tablet2')));
            Configuration::updateValue('BCACC_SLID5', (int)(Tools::getValue('items_mobile2')));
            Configuration::updateValue('BCACC_SLID6', (Tools::getValue('tzc_autoplay2')));
            Configuration::updateValue('BCACC_SLID7', (Tools::getValue('tzc_nav2')));
            Configuration::updateValue('BCACC_SLID8', (Tools::getValue('tzc_nav_text2')));
            Configuration::updateValue('BCACC_SLID9', (Tools::getValue('tzc_but_show2')));
            Configuration::updateValue('BCACC_SLID10', (int)(Tools::getValue('tzc_more_show2')));
            Configuration::updateValue('BCACC_SLID11', (int)(Tools::getValue('tzc_qty_show2')));
            Configuration::updateValue('BCACC_SLID12', (int)( Tools::getValue('tzc_new_show2'))); 
            Configuration::updateValue('BCACC_SLID13', (int)( Tools::getValue('tzc_hover_show2'))); 
            Configuration::updateValue('BCACC_SLID14', (int)( Tools::getValue('bcachnbr')));
            Configuration::updateValue('BCACC_ACCLIM', (int)($bcaccmaxacc));
 
            $this->_html = $this->displayConfirmation($this->l('Settings updated successfully'));
        }
    }
	/*
     * Configuration page form builder
     */
    private function _displayForm()
    	{
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'label' => $this->l('Max accessories by product'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'bcaccprlim',
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display on home page'),
                        'name' => 'bcach',
                        'is_bool' => true,
                        'desc' => $this->l('Display the module on home page?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),                  
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show customers also bought'),
                        'name' => 'bcacporder',
                        'is_bool' => true,
                        'desc' => $this->l('Hidden on home page!'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show viewed products'),
                        'name' => 'bcacpviewed',
                        'is_bool' => true,
                        'desc' => $this->l('Show the latests visited products?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show in the same category'),
                        'name' => 'bcachsam',
                        'is_bool' => true,
                        'desc' => $this->l('Show similar products to the latest visited?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show cart accessories'),
                        'name' => 'bcachacc',
                        'is_bool' => true,
                        'desc' => $this->l('Show cart products accessories?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show last viewved accessories'),
                        'name' => 'bcachjs',
                        'is_bool' => true,
                        'desc' => $this->l('Show last viewved product accessories?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),     
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Accessories behaviour'),
                        'name' => 'bcachbv',
                        'is_bool' => true,
                        'desc' => $this->l('Show both accessories sliders or only 1 at a time?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('New products'),
                        'name' => 'bcacchf',
                        'is_bool' => true,
                        'desc' => $this->l('Hidden in cart!'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),                    
                    array(
                        'type' => 'select',
                        'label' => $this->l('Show recommended to you'),
                        'name' => 'bcacchfw',
                        'is_bool' => true,
                        'desc' => $this->l('Home Featured, Specials or none? Hidden in cart!'),
                         'options' => array(
                            'query' => $options = array(
                                        array(
                                          'id_option' => 2,      
                                          'name' => $this->l('Nothing'),   
                                        ),
                                        array(
                                          'id_option' => 1,      
                                          'name' => $this->l('Specials'),   
                                        ),
                                        array(
                                          'id_option' => 0,
                                          'name' => $this->l('Featured'),
                                        ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name' 
                           ),
                    ), 
                    array(
                        'label' => $this->l('Price range'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'bcachbq',
                        'desc' => $this->l('Limit price range for similar product'),
                    ),                                                        

                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'button pull-right'
                )
            )
        );
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitBlockCartAcc';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
                . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        $out = $helper->generateForm(array($fields_form));
		$this->_html .= $this->_displayHook();
		$this->_html .= $out;
		return $this->_html;
	}

    /*
     * Configuration page form builder
     */
    private function _displayFormSlider()
        {
        $fields_form_slider = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Slider settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'label' => $this->l('Number of items in the carousel for wide screens'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'items_wide2',
                        'desc' => $this->l('Set the number of items to show in a view port on wide screens'),
                    ),
                    array(
                        'label' => $this->l('Number of items in the carousel for desktop screens'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'items_desktop2',
                        'desc' => $this->l('Set the number of items to show in a view port on regular screens'),
                    ),
                    array(
                        'label' => $this->l('Number of items in the carousel for desktop small screens'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'items_desktop_small2',
                        'desc' => $this->l('Set the number of items to show in a view port on wide tablets'),
                    ),                    
                    array(
                        'label' => $this->l('Number of items in the carousel for tablets'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'items_tablet2',
                        'desc' => $this->l('Set the number of items to show in a view port on regular tablets'),
                    ),                                                  
                    array(
                        'label' => $this->l('Number of items in the carousel for mobile'),
                        'type'  => 'text',
                        'size' => 3,
                        'class' => 'fixed-width-xs',
                        'name'  => 'items_mobile2',
                        'desc' => $this->l('Set the number of items to show in a view port on mobile devices'),
                    ),                  
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Sliders Autoplay'),
                        'name' => 'tzc_autoplay2',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show navigation Buttons'),
                        'name' => 'tzc_nav2',
                        'is_bool' => true,
                        'desc' => $this->l('Show the navigation Next & Prev buttons?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),  
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show "Add to cart"'),
                        'name' => 'tzc_but_show2',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),                    
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show "More"'),
                        'name' => 'tzc_more_show2',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Buttons hover effect'),
                        'name' => 'tzc_hover_show2',
                        'is_bool' => true,
                        'desc' => $this->l('Show the buttons on hover?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show availability'),
                        'name' => 'tzc_qty_show2',
                        'is_bool' => true,
                        'desc' => $this->l('Show products availability?'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),                                                                 
                    array(
                        'type' => 'switch',
                        'label' => $this->l('New label'),
                        'name' => 'tzc_new_show2',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Products description'),
                        'name' => 'bcachnbr',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'label' => $this->l('Products description length'),
                        'type'  => 'text',
                        'class' => 'fixed-width-xs',
                        'name'  => 'bcaccmaxacc',
                        'desc' => $this->l('Number of characters'),
                    ),                    
                ), 
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'button pull-right'
                )
            )
        );
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form_slider = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitBlockCartAccSlider';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
                . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValuesSlider(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );
        return $out = $helper->generateForm(array($fields_form_slider));
    }
    // 
    //Values de la config
    //    
	protected function getConfigFieldsValues()
	{	
			return array(
			'bcaccprlim' => Tools::getValue('bcaccprlim', Configuration::get('BCACC_ACCPRLIM')),
			'bcacclink' => Tools::getValue('bcacclink', Configuration::get('BCACC_PRD_LINK')),
			'bcacchf' => Tools::getValue('bcacchf', Configuration::get('BCACC_HOMFEAT')),
			'bcacchfw' => Tools::getValue('bcacchfw', Configuration::get('BCACC_HOMFEAT_W')),
			'bcacporder' => Tools::getValue('bcacporder', Configuration::get('BCACC_PRORDER')),
			'bcacpviewed' => Tools::getValue('bcacpviewed', Configuration::get('BCACC_PVIEWED')),
			'bcach' => Tools::getValue('bcach', Configuration::get('BCACC_HOM')),
			'bcachsam' => Tools::getValue('bcachsam', Configuration::get('BCACC_HOM_SAM')),
			'bcachacc' => Tools::getValue('bcachacc', Configuration::get('BCACC_HOM_ACC')),
            'bcachjs' => Tools::getValue('bcachjs', Configuration::get('BCACC_HOM_JS')),
            'bcachbv' => Tools::getValue('bcachbv', Configuration::get('BCACC_HOM_BV')),
            'bcachbq' => Tools::getValue('bcachbq', Configuration::get('BCACC_HOM_BQ'))
			);
	}
    // 
    //Values du slider
    //
    protected function getConfigFieldsValuesSlider()
    {   
            return array(
            'items_wide2'=> Tools::getValue('items_wide2', Configuration::get('BCACC_SLID1')),
            'items_desktop2'=> Tools::getValue('items_desktop2', Configuration::get('BCACC_SLID2')),
            'items_desktop_small2'=> Tools::getValue('items_desktop_small2', Configuration::get('BCACC_SLID3')),
            'items_tablet2'=> Tools::getValue('items_tablet2', Configuration::get('BCACC_SLID4')),
            'items_mobile2'=> Tools::getValue('items_mobile2', Configuration::get('BCACC_SLID5')),
            'tzc_autoplay2'=> Tools::getValue('tzc_autoplay2', Configuration::get('BCACC_SLID6')),
            'tzc_nav2'=> Tools::getValue('tzc_nav2', Configuration::get('BCACC_SLID7')),
            'items_nav_text2'=> Tools::getValue('items_set2', Configuration::get('BCACC_SLID8')),
            'tzc_but_show2'=> Tools::getValue('tzc_but_show2', Configuration::get('BCACC_SLID9')),
            'tzc_more_show2'=> Tools::getValue('tzc_more_show2', Configuration::get('BCACC_SLID10')),
            'tzc_new_show2'=> Tools::getValue('tzc_new_show2', Configuration::get('BCACC_SLID11')),
            'tzc_qty_show2'=> Tools::getValue('tzc_qty_show2', Configuration::get('BCACC_SLID12')),
            'tzc_hover_show2'=> Tools::getValue('tzc_hover_show2', Configuration::get('BCACC_SLID13')),
            'bcachnbr' => Tools::getValue('bcachnbr', Configuration::get('BCACC_SLID14')),
            'bcaccmaxacc' => Tools::getValue('bcaccmaxacc', Configuration::get('BCACC_ACCLIM')),
            );
    }    
	// 
	//Hook de la home
	//
	public function hookHome($params)
	{
    		//Active ou pas le module sur la home
    		if((Configuration::get('BCACC_HOM') ==0) && (!isset($this->context->controller->php_self) || $this->context->controller->php_self == 'index') )
                return;
            else
            {
    				$this->smarty->assign(array(
    					'linkprd' => Configuration::get('BCACC_PRD_LINK'),
    					'maxprod' => Configuration::get('BCACC_ACCPRLIM'),
    					'showviewed' => Configuration::get('BCACC_HOM_VIE'),
    					'productsViewedObj'=> $this->getViewved($params),
    					'accimg' => 'medium_default'));
                //on affiche les produits similaires    
                if(Configuration::get('BCACC_HOM_SAM') == 1)
    				$this->smarty->assign('sameprod',$this->getSameProd($params));

                //on affiche les accessoires du panier
                if(Configuration::get('BCACC_HOM_ACC') == 1)
    				$this->smarty->assign('homeacc',$this->getProductCart($params));

                //On affiche les accessoires du dernier produit vu
                if(Configuration::get('BCACC_HOM_JS') == 1)
                {
                    //on affiche les accessoires du dernier vu si il n'y a pas d'accessoires panier ou les 2 types d'accessoires
                    if( (Configuration::get('BCACC_HOM_BV') == 1) || ( (Configuration::get('BCACC_HOM_BV') == 0) && ($this->getProductCart($params) == false) ) )
                        $this->smarty->assign('homeaccv',$this->getLastProdViewAcc($params));
                }
                //on affiche les produits aussi acheter par les clients
                if((Configuration::get('BCACC_PRORDER') == 1) && (!isset($this->context->controller->php_self) || $this->context->controller->php_self == 'order')) {
                    $products = $params['cart']->getProducts(true);
                    if(count($products))
                    $this->smarty->assign('productodr',$this->getProductOrdered($products));
                }

            //on affiche pas les nouveautés et promotions dans le panier
            if(!isset($this->context->controller->php_self) || $this->context->controller->php_self != 'order')
            {    
                //On affiche les Homefeatured ou les specials
                    if(Configuration::get('BCACC_HOMFEAT_W') != 2){
                        $others = array(); 
                        $category = new Category(1, $this->context->language->id);
                        $nb = (int)(Configuration::get('BCACC_ACCPRLIM'));
                            ////On vous recommande promo / phare
                            if(Configuration::get('BCACC_HOMFEAT_W') == 0)
                                $others = $category->getProducts((int)($this->context->language->id), 1, ($nb ? $nb : 5));
                            else
                                $others = Product::getPricesDrop((int)($this->context->language->id), 0, ($nb ? $nb : 5), false, 'date_add'); 
                        $this->smarty->assign('others', $others);       
                    } 
                //On affiche les nouveaux produits
                if(Configuration::get('BCACC_HOMFEAT') == 1)
                    $this->smarty->assign('news', Product::getNewProducts((int) $this->context->language->id, 0, (int)Configuration::get('NEW_PRODUCTS_NBR')));
            }
            $this->smarty->assign(array(
                'items_wide2' => Configuration::get('BCACC_SLID1'),
                'items_desktop2' => Configuration::get('BCACC_SLID2'),
                'items_desktop_small2' => Configuration::get('BCACC_SLID3'),
                'items_tablet2' => Configuration::get('BCACC_SLID4'),
                'items_mobile2' => Configuration::get('BCACC_SLID5'),
                'tzc_autoplay2' => Configuration::get('BCACC_SLID6'),
                'tzc_nav2' => Configuration::get('BCACC_SLID7'),
                'tzc_nav_text2' => Configuration::get('BCACC_SLID8'),
                'tzc_but_show2' => Configuration::get('BCACC_SLID9'),
                'tzc_more_show2' => Configuration::get('BCACC_SLID10'),
                'tzc_qty_show2' => Configuration::get('BCACC_SLID11'),
                'tzc_new_show2' => Configuration::get('BCACC_SLID12'),
                'tzc_hover_show2' => Configuration::get('BCACC_SLID13'),
                'bcachnbr' => Configuration::get('BCACC_SLID14'),
                'bcaccmaxacc' => Configuration::get('BCACC_ACCLIM')
            ));
    					return $this->display(__FILE__,'views/blockcartaccessories.tpl');
    		}   
	}
    //////////////////////////////////////////////////////////////////  
	//Hook du panier
    //////////////////////////////////////////////////////////////////  
	public function hookshoppingCartExtra($params)
	{
        return $this->hookHome($params);
	}
    //////////////////////////////////////////////////////////////////  
	//Hook du header
    //////////////////////////////////////////////////////////////////  
	public function hookHeader($params)
	{
        $this->context->controller->addCSS(($this->_path).'assets/owl.carousel.css');
        $this->context->controller->addCSS(($this->_path).'assets/owl.theme.css');
        $this->context->controller->addCSS(($this->_path).'assets/owl.transitions.css');
        $this->context->controller->addCSS(($this->_path).'assets/style.css');
        $this->context->controller->addJS(($this->_path).'assets/owl.carousel.min.js');
        $this->context->controller->addJS(($this->_path).'assets/script.js');

            // si on est sur une page produit
            $id_product = (int)(Tools::getValue('id_product'));
            if($id_product > 0)
            {    
                        //On transforme le cookie en tableau en limitant le nombre de produits défini dans l'admin
                        $productsViewed= (isset($this->context->cookie->viewed) AND !empty($this->context->cookie->viewed)) ? array_slice(array_reverse(explode(',', $this->context->cookie->viewed)), 0, Configuration::get('BCACC_ACCPRLIM')) : array();
                        $productsViewedclean =0;    
                        //Si l'id du produit est déjà dans le cookie on l'enlève pour ensuite le remettre en première position
                        if (in_array($id_product, $productsViewed))
                        {
                                    if(($key = array_search($id_product, $productsViewed)) !== false) {
                                        unset($productsViewed[$key]);
                                    }
                                    $productsViewedclean = implode(',',$productsViewed);
                                    $params['cookie']->viewed =  $productsViewedclean;
                        }                    
                        //On ajoute l'id du produit 
                        if (!in_array($id_product, $productsViewed))
                        {
                            $product = new Product((int)$id_product);
                            if ($product->checkAccess((int)$this->context->customer->id))
                            {
                                if (isset($params['cookie']->viewed) && !empty($params['cookie']->viewed))
                                    $params['cookie']->viewed .= ','.(int)$id_product;
                                else
                                    $params['cookie']->viewed = (int)$id_product;
                            }
                        }
            }
	}
	public function getProductCart($params)
	{
		//produit du panier	
		$products = $params['cart']->getProducts(true);
		$accessories = array();
		$add = array();
					foreach ($products AS $produc){
						//On recherche les accessoires de tous les produits du panier
						$add = $this->getCartAccessories(intval($this->context->language->id), true, $produc['id_product']);
						if((empty($accessories)) && ($add !== false))
				  			$accessories = $add;
				  		elseif((!empty($accessories)) && ($add !== false))
							$accessories= array_merge($accessories, $add);
					}
		return $accessories;
	}
	/////////////////////////////////////////
  	//Rechercher les accessoires des produits 
	/////////////////////////////////////////
	public function getCartAccessories($id_lang, $active = true, $id_product)
	{
		global $cookie;				
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT p.*, product_shop.*, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, t.`rate`, m.`name` as manufacturer_name
		FROM `'._DB_PREFIX_.'accessory` 
		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = `id_product_2`
		'.Shop::addSqlAssociation('product', 'p').'
		LEFT JOIN `'._DB_PREFIX_.'product_attribute_shop` product_attribute_shop
					ON (p.`id_product` = product_attribute_shop.`id_product` AND product_attribute_shop.`default_on` = 1 AND product_attribute_shop.id_shop='.(int)$this->context->shop->id.')
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (
					p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').'
				)
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (
					product_shop.`id_category_default` = cl.`id_category`
					AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').'
				)
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (p.`id_manufacturer`= m.`id_manufacturer`)
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group` AND tr.`id_country` = '.$this->context->country->id.' AND tr.`id_state` = 0)
		LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		WHERE `id_product_1` = '.(int)($id_product).'
		'.($active ? 'AND p.`active` = 1' : '').'
		LIMIT 0,'.(Configuration::get('BCACC_ACCPRLIM') ? Configuration::get('BCACC_ACCPRLIM')-1 : 5));	
			if (!$result)
			return false;
		return $this->getProductsProperties($id_lang, $result);
 	}
	//////////////////////////
	//Les détails des produits
	//////////////////////////
	public static function getProductsProperties($id_lang, $query_result)
	{
		$resultsArray = array();
		if (is_array($query_result))
			foreach ($query_result AS $row)
				if ($row2 = Product::getProductProperties($id_lang, $row))
					$resultsArray[] = $row2;
		return $resultsArray;
	}
  	private function _displayHook()
	{
		$output  ='<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<fieldset>
		<p>'.$this->l('If you like and use the module, Buy me a beer!').'</p>
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="5K4EKEZCH86DC">
		<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
		<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
		</fieldset>
		</form>';			
		return $output;			
	}
	///////////////////////////////////////////////////////
	//Rechercher les produits aussi acheter par les clients
	///////////////////////////////////////////////////////
	  	public function getProductOrdered($products)
		{
            $q_orders = 'SELECT o.id_order
            FROM '._DB_PREFIX_.'orders o
            LEFT JOIN '._DB_PREFIX_.'order_detail od ON (od.id_order = o.id_order)
            WHERE o.valid = 1 AND (';
            $nb_products = count($products);
            $i = 1;
            $products_id = array();
            foreach ($products as $product)
            {
                $q_orders .= 'od.product_id = '.(int)$product['id_product'];
                if ($i < $nb_products)
                    $q_orders .= ' OR ';
                ++$i;
                $products_id[] = (int)$product['id_product'];
            }
            $q_orders .= ')';
            $orders = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($q_orders);

            if (count($orders))
            {
                $list = '';
                foreach ($orders as $order)
                    $list .= (int)$order['id_order'].',';
                $list = rtrim($list, ',');

                $list_product_ids = join(',', $products_id);

                if (Group::isFeatureActive())
                {
                    $sql_groups_join = '
                    LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = product_shop.id_category_default
                        AND cp.id_product = product_shop.id_product)
                    LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cp.`id_category` = cg.`id_category`)';
                    $groups = FrontController::getCurrentCustomerGroups();
                    $sql_groups_where = 'AND cg.`id_group` '.(count($groups) ? 'IN ('.implode(',', $groups).')' : '='.(int)Group::getCurrent()->id);
                }

                $order_products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                    SELECT DISTINCT od.product_id, pl.name, pl.description_short, pl.link_rewrite, i.id_image, product_shop.show_price, product_shop.available_for_order,
                        cl.link_rewrite category, p.ean13, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity
                    FROM '._DB_PREFIX_.'order_detail od
                    LEFT JOIN '._DB_PREFIX_.'product p ON (p.id_product = od.product_id)
                    '.Shop::addSqlAssociation('product', 'p').
                    (Combination::isFeatureActive() ? 'LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                    ON (p.`id_product` = pa.`id_product`)
                    '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
                    '.Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop) :  Product::sqlStock('p', 'product', false,
                        $this->context->shop)).'
                    LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = od.product_id'.Shop::addSqlRestrictionOnLang('pl').')
                    LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = product_shop.id_category_default'
                        .Shop::addSqlRestrictionOnLang('cl').')
                    LEFT JOIN '._DB_PREFIX_.'image i ON (i.id_product = od.product_id)
                    '.(Group::isFeatureActive() ? $sql_groups_join : '').'
                    WHERE od.id_order IN ('.$list.')
                    AND pl.id_lang = '.(int)$this->context->language->id.'
                    AND cl.id_lang = '.(int)$this->context->language->id.'
                    AND od.product_id NOT IN ('.$list_product_ids.')
                    AND i.cover = 1
                    AND product_shop.active = 1
                    '.(Group::isFeatureActive() ? $sql_groups_where : '').'
                    ORDER BY RAND()
                    LIMIT '.(int)Configuration::get('BCACC_ACCPRLIM').'
                '
                );

                $tax_calc = Product::getTaxCalculationMethod();
                $final_products_list = array();

                foreach ($order_products as &$order_product)
                {
                    $order_product['id_product'] = (int)$order_product['product_id'];
                    $order_product['image'] = $this->context->link->getImageLink($order_product['link_rewrite'],
                        (int)$order_product['product_id'].'-'.(int)$order_product['id_image'], ImageType::getFormatedName('home'));
                    $order_product['link'] = $this->context->link->getProductLink((int)$order_product['product_id'], $order_product['link_rewrite'],
                        $order_product['category'], $order_product['ean13']);
                    if ($tax_calc == 0 || $tax_calc == 2)
                        $order_product['price'] = Product::getPriceStatic((int)$order_product['product_id'], true, null);
                    elseif ($tax_calc == 1)
                        $order_product['price'] = Product::getPriceStatic((int)$order_product['product_id'], false, null);
                    $order_product['allow_oosp'] = Product::isAvailableWhenOutOfStock((int)$order_product['out_of_stock']);

                    if (!isset($final_products_list[$order_product['product_id'].'-'.$order_product['id_image']]))
                        $final_products_list[$order_product['product_id'].'-'.$order_product['id_image']] = $order_product;
                }          
                return $final_products_list;
            }else 
            return;
		}
	//////////////////////////////////////
	//Les produits déjà vu par les clients
	//////////////////////////////////////
		function getViewved($params)
		{
		if(Configuration::get('BCACC_PVIEWED') ==1) {
			
			$productsViewed= (isset($this->context->cookie->viewed) AND !empty($this->context->cookie->viewed)) ? array_slice(array_reverse(explode(',', $this->context->cookie->viewed)), 0, Configuration::get('BCACC_ACCPRLIM')) : array();
			if (sizeof($productsViewed))
			{
				$defaultCover = Language::getIsoById((int)($this->context->language->id)).'-default';
				$productIds = implode(',', $productsViewed);
				$productsImages = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
				SELECT MAX(image_shop.id_image) id_image, p.id_product, p.customizable, p.minimal_quantity, pa.id_product_attribute, il.legend, product_shop.active, ss.out_of_stock, ss.quantity, product_shop.available_for_order, product_shop.show_price, pl.name, pl.description_short, pl.link_rewrite, cl.link_rewrite AS category_rewrite
                FROM '._DB_PREFIX_.'product p
               '.Shop::addSqlAssociation('product', 'p').
                    (Combination::isFeatureActive() ? 'LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                    ON (p.`id_product` = pa.`id_product`)
                    '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
                    '.Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop) :  Product::sqlStock('p', 'product', false,
                        $this->context->shop)).'
                LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = p.id_product'.Shop::addSqlRestrictionOnLang('pl').')
                LEFT JOIN '._DB_PREFIX_.'image i ON (i.id_product = p.id_product)'.
                Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
                LEFT JOIN '._DB_PREFIX_.'image_lang il ON (il.id_image = image_shop.id_image AND il.id_lang = '.(int)($this->context->language->id).')
                LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = product_shop.id_category_default'.Shop::addSqlRestrictionOnLang('cl').')
                LEFT JOIN '._DB_PREFIX_.'stock_available ss ON (p.id_product = ss.id_product)
                WHERE p.id_product IN ('.$productIds.')
                AND pl.id_lang = '.(int)($this->context->language->id).'
                AND cl.id_lang = '.(int)($this->context->language->id).'
                GROUP BY product_shop.id_product'
				);
	
				$productsImagesArray = array();
				foreach ($productsImages AS $pi)
					$productsImagesArray[$pi['id_product']] = $pi;
	
				$productsViewedObj = array();
				foreach ($productsViewed AS $productViewed)
				{
					$obj = (object)'Product';
					if (!isset($productsImagesArray[$productViewed]) || (!$obj->active = $productsImagesArray[$productViewed]['active']))
						continue;
					else
					{
						$obj->id = (int)($productsImagesArray[$productViewed]['id_product']);
						$obj->id_image = (int)($productsImagesArray[$productViewed]['id_image']);
						$obj->legend = $productsImagesArray[$productViewed]['legend'];
						$obj->name = $productsImagesArray[$productViewed]['name'];
						$obj->price = Product::getPriceStatic($obj->id, true, NULL, 2);
						$obj->description_short = $productsImagesArray[$productViewed]['description_short'];
						$obj->link_rewrite = $productsImagesArray[$productViewed]['link_rewrite'];
                        $obj->category_rewrite = $productsImagesArray[$productViewed]['category_rewrite'];
                        $obj->available_for_order = $productsImagesArray[$productViewed]['available_for_order'];
                        $obj->show_price = $productsImagesArray[$productViewed]['show_price'];
                        $obj->allow_oosp = Product::isAvailableWhenOutOfStock($productsImagesArray[$productViewed]['out_of_stock']);
                        $obj->quantity = $productsImagesArray[$productViewed]['quantity'];
                        $obj->id_product_attribute = $productsImagesArray[$productViewed]['id_product_attribute'];
                        $obj->minimal_quantity = $productsImagesArray[$productViewed]['minimal_quantity'];
                        $obj->customizable = $productsImagesArray[$productViewed]['customizable'];

						if (!isset($obj->cover) || !$productsImagesArray[$productViewed]['id_image'])
						{
							$obj->cover = $defaultCover;
							$obj->legend = '';
						}
						$productsViewedObj[] = $obj;
					}
				}	
				if (!sizeof($productsViewedObj))
					return;
			return $productsViewedObj;
            }
		}
	}
	//
	//Rechercher les produits de la même catégorie que le dernier vu par les clients
	//
	public function getSameProd($params)
	{
		$productsViewed = (isset($this->context->cookie->viewed) && !empty($this->context->cookie->viewed)) ? array_slice(array_reverse(explode(',', $this->context->cookie->viewed)), 0, Configuration::get('BCACC_ACCPRLIM')) : array();
		//Dernier produit visité
		if(count($productsViewed) ==0)
            return;
        else{
            $idprod= $productsViewed[0];
    		$product = new Product((int)($idprod));
    		if (isset($product->id_category_default) AND $product->id_category_default > 1)
    					$category = new Category((int)($product->id_category_default));
    		else return;			
    		//Si pas de catégorie ou catégorie 1 stop
    		if (($product->id_category_default <> '') OR ($product->id_category_default == 1))
    			if (!Validate::isLoadedObject($category) OR !$category->active) 
    				return;
    		//les produits de la même catégorie
    		$categoryProducts = $category->getProducts(($this->context->language->id), 1, Configuration::get('BCACC_ACCPRLIM')); 
    		
    		//Retire le produit courant
    		if (is_array($categoryProducts) AND count($categoryProducts))
    		{
    			foreach ($categoryProducts AS $key => $categoryProduct)
    				if ($categoryProduct['id_product'] == $idprod)
    				{
    					unset($categoryProducts[$key]);
    					break;
    				}
    			$taxes = Product::getTaxCalculationMethod();
    			if (Configuration::get('PRODUCTSCATEGORY_DISPLAY_PRICE'))
    				foreach ($categoryProducts AS $key => $categoryProduct)
    					if ($categoryProduct['id_product'] != $idprod)
    					{
    						if ($taxes == 0 OR $taxes == 2)
    							$categoryProducts[$key]['displayed_price'] = Product::getPriceStatic((int)$categoryProduct['id_product'], true, NULL, 2);
    						elseif ($taxes == 1)
    							$categoryProducts[$key]['displayed_price'] = Product::getPriceStatic((int)$categoryProduct['id_product'], false, NULL, 2);
    					}
    		return $categoryProducts;
    		}
        }
	}
	//
	//Rechercher les produits de la même cat que le dernier vu par les clients
	//
	public function getLastProdViewAcc($params)
	{	
        if (Configuration::get('BCACC_HOM_JS') == 1) 
        {
            $productsViewed = (isset($this->context->cookie->viewed) && !empty($this->context->cookie->viewed)) ? array_reverse(explode(',', $this->context->cookie->viewed)) : array();
            //Dernier produit visité
            if(count($productsViewed) == 0)
                return;
            else
            {
                $acces = $this->getCartAccessories((int)($this->context->language->id), true, $productsViewed[0]);
                if(!empty($acces))
                 return $acces;
                else
                 return;
            }
        }else
            return;
	}
}