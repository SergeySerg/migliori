<?php /*%%SmartyHeaderCode:93015a6652c02a34c4-53717491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '995d173f0b34b49e0ed5c91fa4e0e08cb6bcf756' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\themes\\Migliori\\modules\\blockcms\\blockcms.tpl',
      1 => 1516645737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93015a6652c02a34c4-53717491',
  'variables' => 
  array (
    'block' => 0,
    'cms_titles' => 0,
    'cms_key' => 0,
    'cms_title' => 0,
    'cms_page' => 0,
    'link' => 0,
    'show_price_drop' => 0,
    'PS_CATALOG_MODE' => 0,
    'show_new_products' => 0,
    'show_best_sales' => 0,
    'display_stores_footer' => 0,
    'show_contact' => 0,
    'contact_url' => 0,
    'cmslinks' => 0,
    'cmslink' => 0,
    'show_sitemap' => 0,
    'footer_text' => 0,
    'display_poweredby' => 0,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5a6652c03d0163_66585807',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a6652c03d0163_66585807')) {function content_5a6652c03d0163_66585807($_smarty_tpl) {?>
	<!-- Block CMS module footer -->
	<section class="footer-block col-xs-12 col-sm-2" id="block_various_links_footer">
		<h4>Информация</h4>
		<ul class="toggle-footer">
							<li class="item">
					<a href="http://migliori.loc/ru/prices-drop" title="Скидки">
						Скидки
					</a>
				</li>
									<li class="item">
				<a href="http://migliori.loc/ru/new-products" title="Новые товары">
					Новые товары
				</a>
			</li>
										<li class="item">
					<a href="http://migliori.loc/ru/best-sales" title="Лидеры продаж">
						Лидеры продаж
					</a>
				</li>
										<li class="item">
					<a href="http://migliori.loc/ru/stores" title="Наш магазин">
						Наш магазин
					</a>
				</li>
									<li class="item">
				<a href="http://migliori.loc/ru/contact-us" title="Связаться с нами">
					Связаться с нами
				</a>
			</li>
															<li class="item">
						<a href="http://migliori.loc/ru/content/3-terms-and-conditions-of-use" title="Порядок и условия использования">
							Порядок и условия использования
						</a>
					</li>
																<li class="item">
						<a href="http://migliori.loc/ru/content/4-about-us" title="О компании">
							О компании
						</a>
					</li>
													<li>
				<a href="http://migliori.loc/ru/sitemap" title="Карта сайта">
					Карта сайта
				</a>
			</li>
					</ul>
		
	</section>
		<section class="bottom-footer col-xs-12">
		<div>
			<?php echo smartyTranslate(array('s'=>'[1] %3$s %2$s - Ecommerce software by %1$s [/1]','mod'=>'blockcms','sprintf'=>array('PrestaShop™',date('Y'),'©'),'tags'=>array('<a class="_blank" href="http://www.prestashop.com">')),$_smarty_tpl);?>

		</div>
	</section>
		<!-- /Block CMS module footer -->
<?php }} ?>
