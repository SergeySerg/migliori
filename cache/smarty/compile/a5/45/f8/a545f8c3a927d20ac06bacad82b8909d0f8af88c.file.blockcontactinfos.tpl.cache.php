<?php /* Smarty version Smarty-3.1.19, created on 2018-04-23 22:53:51
         compiled from "E:\Webserver\domains\migliori.loc\themes\Migliori\modules\blockcontactinfos\blockcontactinfos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73245ade39d00004a0-35743419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a545f8c3a927d20ac06bacad82b8909d0f8af88c' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\themes\\Migliori\\modules\\blockcontactinfos\\blockcontactinfos.tpl',
      1 => 1524340721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73245ade39d00004a0-35743419',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blockcontactinfos_company' => 0,
    'blockcontactinfos_address' => 0,
    'blockcontactinfos_phone' => 0,
    'blockcontactinfos_phone2' => 0,
    'blockcontactinfos_email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ade39d0090849_06679909',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ade39d0090849_06679909')) {function content_5ade39d0090849_06679909($_smarty_tpl) {?><?php if (!is_callable('smarty_function_mailto')) include 'E:\\Webserver\\domains\\migliori.loc\\tools\\smarty\\plugins\\function.mailto.php';
?>

<!-- MODULE Block contact infos -->
<section id="block_contact_infos" class="footer-block col-xs-12 col-sm-4">
	<div>
        <h4><?php echo smartyTranslate(array('s'=>'Store Information','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
</h4>
        <ul class="toggle-footer">
            <?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value!='') {?>
            	<li>
            		<i class="icon-map-marker"></i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value!='') {?>, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?>
            	</li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value!='') {?>
            	<li>
            		<i class="icon-phone"></i><?php echo smartyTranslate(array('s'=>'Call us now:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
 
            		<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
            	</li>
            <?php }?>
			<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_phone2']->value!='') {?>
				<li>
					<i class="icon-phone"></i><?php echo smartyTranslate(array('s'=>'Call us now:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>

					<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_phone2']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
				</li>
			<?php }?>
            <?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value!='') {?>
            	<li>
            		<i class="icon-envelope-alt"></i><?php echo smartyTranslate(array('s'=>'Email:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
 
            		<span><?php echo smarty_function_mailto(array('address'=>htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value, ENT_QUOTES, 'UTF-8', true),'encode'=>"hex"),$_smarty_tpl);?>
</span>
            	</li>
            <?php }?>
			<a href="#" class="callme_viewform"><?php echo smartyTranslate(array('s'=>'Request a callback','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
</a>
		</ul>
    </div>
</section>
<!-- /MODULE Block contact infos -->
<?php }} ?>
