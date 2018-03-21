<?php /* Smarty version Smarty-3.1.19, created on 2018-03-21 16:58:07
         compiled from "E:\Webserver\domains\migliori.loc\themes\Migliori\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:259975ab272ff22d167-52835917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48704613a65f3e2404b56021c8a4000c4a02c47d' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\themes\\Migliori\\index.tpl',
      1 => 1521633259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259975ab272ff22d167-52835917',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HOOK_HOME' => 0,
    'HOOK_HOME_TAB_CONTENT' => 0,
    'HOOK_HOME_TAB' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ab272ff258744_56253417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ab272ff258744_56253417')) {function content_5ab272ff258744_56253417($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) {?>
	<div class="clearfix"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>
</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
        <ul id="home-page-tabs" class="nav nav-tabs clearfix">
			<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

		</ul>
	<?php }?>
	<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
<?php }?>
<?php }} ?>
