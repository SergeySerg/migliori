<?php
/**
 * Roja45RecommendProducts
 *
 * @category  Roja45RecommendProducts
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

/**
 * Roja45RecommendProducts
 *
 * @category  Class
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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Roja45RecommendProducts extends Module
{
    const TOPIC = 'UNSET';
    private $_html = '';
    private $_postErrors = array();

    public function __construct()
    {
        $this->name = 'roja45recommendproducts';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'Roja45';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Roja45: Recommend Products');
        $this->description = $this->l('Select individual products, or a product category, to be displayed when adding an item to the cart, and when displaying cart summary.');

        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        if (!parent::install() ||
            !Configuration::updateGlobalValue('ROJA45_RECOMMEND_ITEMS', 3) ||
            !Configuration::updateGlobalValue('ROJA45_RECOMMEND_SELECTION', 'CAT') ||
            !Configuration::updateGlobalValue('ROJA45_RECOMMEND_SELECTED_PRDS', '') ||
            !Configuration::updateGlobalValue('ROJA45_RECOMMEND_SELECTED_CATS', '') ||
            !Configuration::updateGlobalValue('ROJA45_RECOMMEND_RANDOM', '0') ||
            !$this->registerHook('displayShoppingCartFooter') ||
            !$this->registerHook('displayRightColumnProduct') ||
            !$this->registerHook('displayRoja45ResponsiveCart') ||
            !$this->registerHook('actionAdminControllerSetMedia') ||
            !$this->registerHook('displayRoja45ModuleManager') ||
            !$this->registerHook('displayHeader')) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        // TODO - Need to delete all slide files.
        return
            $this->uninstallDB() &&
            Configuration::deleteByName('ROJA45_RECOMMEND_ITEMS') &&
            Configuration::deleteByName('ROJA45_RECOMMEND_SELECTION') &&
            Configuration::deleteByName('ROJA45_RECOMMEND_SELECTED_PRDS') &&
            Configuration::deleteByName('ROJA45_RECOMMEND_SELECTED_CATS') &&
            Configuration::deleteByName('ROJA45_RECOMMEND_RANDOM') &&
            parent::uninstall();
    }

    public function uninstallDB()
    {
        return Db::getInstance()->delete('hook', 'name="displayRoja45ResponsiveCart"');
    }

    public function hookActionAdminControllerSetMedia($params)
    {
        // add necessary javascript to products back office
        if (
            //($this->context->controller->controller_name == 'AdminProducts' && Tools::getValue('id_product')) ||
            ($this->context->controller->controller_name == 'AdminModules' && Tools::getValue('configure') == $this->name)
        ) {
            $this->context->controller->addJqueryPlugin('typewatch');
            $this->context->controller->addJS($this->_path.'views/js/jquery/plugin/jquery.form.min.js');
            $this->context->controller->addJqueryPlugin('growl');
            $this->context->controller->addJS($this->_path.'views/js/roja45recommendproducts_admin.js');
        }
    }

    public function getContent()
    {
        if (Tools::isSubmit('submitRecommendProducts')) {
            $errors = [];
            $selection_method = (Tools::getValue('selection_method'));
            Configuration::updateValue('ROJA45_RECOMMEND_SELECTION', $selection_method);

            $number_of_products = (Tools::getValue('number_of_products'));
            if (!$number_of_products or $number_of_products <= 0 or !Validate::isInt($number_of_products)) {
                $errors[] = $this->l('Invalid number of products');
            } else {
                Configuration::updateValue('ROJA45_RECOMMEND_ITEMS', (int) ($number_of_products));
            }

            $display_random = (int) (Tools::getValue('display_random'));
            Configuration::updateValue('ROJA45_RECOMMEND_RANDOM', $display_random);

            $selected_categories = Tools::getValue('selected_categories');
            if ($selected_categories) {
                $categories = '';
                foreach ($selected_categories as $category) {
                    $categories .= $category.',';
                }
                $categories = Tools::substr($categories, 0, Tools::strlen($categories) - 1);
                Configuration::updateValue('ROJA45_RECOMMEND_SELECTED_CATS', $categories);
            }

            $selected_products = Tools::getValue('selected_products');
            if ($selected_products) {
                $products = '';
                foreach ($selected_products as $product) {
                    $products .= $product.',';
                }
                $products = Tools::substr($products, 0, Tools::strlen($products) - 1);
                Configuration::updateValue('ROJA45_RECOMMEND_SELECTED_PRDS', $products);
            }

            if (isset($errors) and sizeof($errors)) {
                $this->html .= $this->displayError(implode('<br />', $errors));
            } else {
                $this->html .= $this->displayConfirmation($this->l('Settings updated'));
            }

        }

        $this->smarty->assign(array(
                'topic' => Roja45RecommendProducts::TOPIC,
        ));
        $this->_html .= $this->display(__FILE__, 'hookRoja45HeaderFree.tpl');
        $this->_html .= $this->renderForm();

        return $this->_html;
    }

    public function renderForm()
    {
        $languages = $this->context->controller->getLanguages();

        $selected_categories = explode(',', Configuration::get('ROJA45_RECOMMEND_SELECTED_CATS'));

        $selected_products = explode(',', Configuration::get('ROJA45_RECOMMEND_SELECTED_PRDS'));

        $helper = new HelperTreeCategories('categories-tree', $this->l('Filter by category'));

        $category = Tools::getValue('category', Category::getRootCategory()->id);
        $helper->setInputName('selected_categories');
        $helper->setSelectedCategories($selected_categories);
        $helper->setUseCheckBox(true);
        $helper->setUseSearch(true);
        $helper->setRootCategory($category);

        $products = [];
        foreach ($selected_products as $product) {
            $productObj = new Product((int) $product, false, (int) $this->context->language->id);
            $products[] = [
                'id_product' => $product,
                'name' => $productObj->name,
            ];
        }

        $this->context->smarty->assign(
            array(
                'form_id' => 'roja45_recommend_products',
                'form_action' => $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&module_name='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'selected_cat_ids' => Configuration::get('ROJA45_RECOMMEND_SELECTED_CATS'),
                'selected_products' => $products,
                'form_submit_action' => 'submitRecommendProducts',
                'number_of_products' => Configuration::get('ROJA45_RECOMMEND_ITEMS'),
                'selection_method' => Configuration::get('ROJA45_RECOMMEND_SELECTION'),
                'display_random' => Configuration::get('ROJA45_RECOMMEND_RANDOM'),
                'languages' => $languages,
                'id_lang' => $this->context->language->id,
                'category_tree_html' => $helper->render(),
            )
        );

        $output = $this->display(__FILE__, 'displayForm.tpl');

        return $output;
    }

    public function hookDisplayRoja45ModuleManager($params)
    {
        $return = $this->name;

        return $return;
    }

    public function hookDisplayRoja45ResponsiveCart($params)
    {
        return $this->hookDisplayShoppingCartFooter($params);
    }

    public function hookDisplayHeader($params)
    {
        return $this->hookHeader($params);
    }

    public function hookHeader($params)
    {
        return $this->context->controller->addCSS($this->_path.'views/css/roja45recommendproducts.css');
    }

    public function hookDisplayFooterProduct($params)
    {
        return $this->hookDisplayShoppingCartFooter($params);
    }

    public function hookDisplayShoppingCartFooter($params)
    {
        $this->smarty->assign(array(
            'products' => $this->getRecommendedProducts($params),
            'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
            'displayPrice' => Product::getTaxCalculationMethod((int) $this->context->cookie->id_customer),
            'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
        ));

        return $this->display(__FILE__, 'hookShoppingCartFooter.tpl');
    }

    public function hookDisplayLeftColumnProduct($params)
    {
        return $this->hookDisplayRightColumnProduct($params);
    }

    private function getRecommendedProducts($params)
    {
        // TODO - Get type, cat or prd
        $selection_method = Configuration::get('ROJA45_RECOMMEND_SELECTION');
        // TODO - Get number to display
        $products_to_display = (int) Configuration::get('ROJA45_RECOMMEND_ITEMS');
        // TODO - Get whether to display randomly
        $display_random = (bool) Configuration::get('ROJA45_RECOMMEND_RANDOM');
        // TODO - get products
        $products = [];
        if ($selection_method == 'CAT') {
            $selected_categories = explode(',', Configuration::get('ROJA45_RECOMMEND_SELECTED_CATS'));
            foreach ($selected_categories as $cat) {
                $category = new Category($cat, (int) $this->context->language->id);
                $prdResult = $category->getProducts(
                    (int) Context::getContext()->language->id,
                    1,
                    ($products_to_display ? $products_to_display : 10),
                    null,
                    null,
                    false,
                    $display_random,
                    ($products_to_display ? $products_to_display : 10)
                );
                $products = array_merge($products, $prdResult);
            }
        } elseif ($selection_method == 'PRD') {
            $selected_products = explode(',', Configuration::get('ROJA45_RECOMMEND_SELECTED_PRDS'));
            foreach ($selected_products as $prd) {
                if (count($products) < $products_to_display) {
                    $prd_details = $this->getProductDetails((int) $this->context->language->id, $prd, true, true, false, 10, 10);
                    $products = array_merge($products, $prd_details);
                }
            }
        }

        return $products;
    }
    public function hookDisplayRightColumnProduct($params)
    {
        $this->smarty->assign(array(
            'products' => $this->getRecommendedProducts($params),
            'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
            'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
            'thumbSize' => Image::getSize(ImageType::getFormatedName('cart')),
            'id_lang' => (int) $this->context->language->id
        ));

        return $this->display(__FILE__, 'hookProductColumn.tpl');
    }

    public function hookDisplayProductButtons($params)
    {
        return $this->hookDisplayRightColumnProduct($params);
    }

    private function getProductDetails($id_lang, $id_product, $active = true, $front = true, $random = false, $random_number_products = null, $limit = null, $order_by = null, $order_way = null)
    {
        if (empty($order_by)) {
            $order_by = 'position';
        } else {
            /* Fix for all modules which are now using lowercase values for 'orderBy' parameter */
            $order_by = Tools::strtolower($order_by);
        }
        $order_by_prefix='';
        $sql = '
			SELECT
				p.*, product_shop.*,
				stock.out_of_stock,
				IFNULL(stock.quantity, 0) as quantity,
				MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
				product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity,
				pl.`description`,
				pl.`description_short`,
				pl.`available_now`,
				pl.`available_later`,
				pl.`link_rewrite`,
				pl.`meta_description`,
				pl.`meta_keywords`,
				pl.`meta_title`,
				pl.`name`,
				MAX(image_shop.`id_image`) id_image,
				il.`legend`,
				m.`name` AS manufacturer_name,
				cl.`name` AS category_default,
				product_shop.price AS orderprice'.
            ' FROM `'._DB_PREFIX_.'product` p
			'.Shop::addSqlAssociation('product', 'p').'
			LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product`)
			'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
			'.Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop).'
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (product_shop.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.(int) $id_lang.Shop::addSqlRestrictionOnLang('cl').')
			LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int) $id_lang.Shop::addSqlRestrictionOnLang('pl').')
			LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
            Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
			LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (image_shop.`id_image` = il.`id_image` AND il.`id_lang` = '.(int) $id_lang.')LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
			WHERE product_shop.`id_shop` = '.(int) $this->context->shop->id.' AND p.`id_product` = '.(int) $id_product
            .($active ? ' AND product_shop.`active` = 1' : '')
            .($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
            .' GROUP BY product_shop.id_product';

        if ($random === true) {
            $sql .= ' ORDER BY RAND() LIMIT '.(int) $random_number_products;
        } else {
            $sql .= ' ORDER BY '.(!empty($order_by_prefix) ? $order_by_prefix.'.' : '').'`'.bqSQL($order_by).'` '.pSQL($order_way).'
			LIMIT '.(int) $limit;
        }

        error_log($sql);
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        return Product::getProductsProperties($id_lang, $result);
    }
}
