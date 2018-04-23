<?php

if (!defined('_PS_VERSION_'))
	exit;

class ecm_liqpay extends PaymentModule
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'ecm_liqpay';
		$this->tab = 'payments_gateways';
		$this->version = '0.4';
		$this->author = 'Elcommerce';
		$this->need_instance = 1;
		$this->bootstrap = true;
		$this->bootstrap = true;
		//Привязвать к валюте
		$this->currencies = true;
		$this->currencies_mode = 'checkbox';
		 $config = Configuration::getMultiple(array('liqpay_id', 'liqpay_pass'));
        if (isset($config['liqpay_pass']))
            $this->liqpay_merchant_pass = $config['liqpay_pass'];
        if (isset($config['liqpay_id']))
            $this->liqpay_merchant_id = $config['liqpay_id'];
		parent::__construct();

		$this->displayName = $this->l('Liqpay');
		$this->description = $this->l('Payments with liqpay');
		 if (!isset($this->liqpay_merchant_pass) OR !isset($this->liqpay_merchant_id))
            $this->warning = $this->l('Your liqpay account must be set correctly (specify a password and a unique id merchant');

	}

	public function install()
	{
		return (parent::install()
			&& $this->registerHook('payment')
			&&$this->_addOS()
		);
	}

	public function uninstall()
	{
		return (parent::uninstall()
			&& Configuration::deleteByName('liqpay_id')
			&& Configuration::deleteByName('liqpay_pass')
			&& Configuration::deleteByName('liqpay_postvalidate')
		);
	}

	public function getContent()
	{
		if (Tools::isSubmit('submitliqpay'))
		{
			$this->postValidation();
			if (!count(@$this->post_errors))
				$this->postProcess();
			else
				foreach ($this->post_errors as $err)
					$this->_html .= $this->displayError($err);
		}
		$this->_html .= $this->renderForm();
		$this->_displayabout();
		return $this->_html;
	}

		public function renderForm()
	{
		//$root_category = Category::getRootCategory();
		//$root_category = array('id_category' => $root_category->id, 'name' => $root_category->name);
			$this->fields_form[0]['form'] = array(
				'legend' => array(
				'title' => $this->l('Settings'),
				'icon' => 'icon-cog'

			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Public key'),
					'desc' => $this->l('Public key in Liqpay'),
					'name' => 'liqpay_id',
				),
				array(
					'type' => 'text',
					'label' => $this->l('Private key'),
					'desc' => $this->l('Private key in Liqpay'),
					'name' => 'liqpay_pass',
				),
				array(
					'type' => 'switch',
					'label' => $this->l('Order after payment'),
					'name' => 'liqpay_postvalidate',
					'desc' => $this->l('Create order after receive payment notification'),
					'values' => array(
						array(
							'id' => 'liqpay_postvalidate_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id' => 'liqpay_postvalidate_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type' => 'switch',
					'label' => $this->l('Order total with delivery cost'),
					'name' => 'liqpay_delivery',
					'desc' => $this->l('Send order total with delivery cost'),
					'values' => array(
						array(
							'id' => 'liqpay_delivery_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id' => 'liqpay_delivery_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
			),

			'submit' => array(
				'name' => 'submitliqpay',
				'title' => $this->l('Save')
			)
		);


		$helper = new HelperForm();
		$helper->module = $this;
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitliqpay';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.
			'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);
		return $helper->generateForm($this->fields_form);
	}

	public function getConfigFieldsValues()
	{
		$fields_values = array();
		$languages = Language::getLanguages(false);
		$fields_values['liqpay_id'] = Configuration::get('liqpay_id');
		$fields_values['liqpay_pass'] = Configuration::get('liqpay_pass');
		$fields_values['liqpay_postvalidate'] = Configuration::get('liqpay_postvalidate');
		$fields_values['liqpay_delivery'] = Configuration::get('liqpay_delivery');
		return $fields_values;
	}

	private function postValidation()
	{
		if (Tools::getValue('liqpay_id') && (!Validate::isString(Tools::getValue('liqpay_id'))))
			$this->post_errors[] = $this->l('Invalid').' '.$this->l('Public key');
		if (Tools::getValue('liqpay_pass') && (!Validate::isString(Tools::getValue('liqpay_pass'))))
			$this->post_errors[] = $this->l('Invalid').' '.$this->l('Private key');
	}

	private function postProcess()
	{
		Configuration::updateValue('liqpay_id', Tools::getValue('liqpay_id'));
		Configuration::updateValue('liqpay_pass', Tools::getValue('liqpay_pass'));
		Configuration::updateValue('liqpay_postvalidate', Tools::getValue('liqpay_postvalidate'));
		Configuration::updateValue('liqpay_delivery', Tools::getValue('liqpay_delivery'));
		$this->_html .= $this->displayConfirmation($this->l('Settings updated.'));
	}
	public function hookpayment($params)
	{
		if (!$this->active)
			return ;

		$this->smarty->assign(array(
			'id_cart' => $params['cart']->id,
			'this_path' => $this->_path,
			'this_path_ssl' => Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'
		));

		return $this->display(__FILE__, 'payment.tpl');

	}

	static public function validateAnsver($message)
	{
		Logger::addLog('liqpay: ' . $message);
		die($message);
	}

	private function _addOS()
	{
		return ($this->_addStatus('EC_OS_WAITPAYMENT', $this->l('Waiting payment'))

		);
	}
	private function _addStatus($setting_name, $name, $template=false)
	{
		if (Configuration::get($setting_name))
			return true;

		$status= new OrderState();
		$status->send_email = ($template?1:0);
		$status->invoice = 0;
		$status->logable = 0;
		$status->delivery = 0;
		$status->hidden = 0;
		$status->color = '#00c305';

		$lngs = Language::getLanguages();
		foreach ($lngs as $lng) {
			$status->name[$lng['id_lang']] =$name ;
			if($template)
				$status->template[$lng['id_lang']] =$template ;
		}
		if($status->add()){
			Configuration::updateValue($setting_name, $status->id);
			return true;
		}
		return false;
	}

	private
	function _displayabout()
	{

		$this->_html .= '
		<div class="panel">
		<div class="panel-heading">
			<i class="icon-envelope"></i> ' . $this->l('Информация') . '
		</div>
		<div id="dev_div">
		<span><b>' . $this->l('Версия') . ':</b> ' . $this->version . '</span><br>
		<span><b>' . $this->l('Разработчик') . ':</b> <a class="link" href="mailto:support@elcommerce.com.ua" target="_blank">Savvato</a>

		<span><b>' . $this->l('Описание') . ':</b> <a class="link" href="http://elcommerce.com.ua" target="_blank">http://elcommerce.com.ua</a><br><br>
		<p style="text-align:center"><a href="http://elcommerce.com.ua/"><img src="http://elcommerce.com.ua/img/m/logo.png" alt="Электронный учет коммерческой деятельности" /></a>

		</div>
		</div>

		';
	}

}
