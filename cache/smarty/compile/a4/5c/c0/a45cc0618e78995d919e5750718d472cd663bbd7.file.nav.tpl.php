<<<<<<< HEAD
<?php /* Smarty version Smarty-3.1.19, created on 2018-05-04 00:22:48
=======
<?php /* Smarty version Smarty-3.1.19, created on 2018-05-03 23:14:04
>>>>>>> 63d8e5824e9e6bc1e8534ebb8ba25bc3c431f89e
         compiled from "E:\Webserver\domains\migliori.loc\themes\Migliori\modules\blockuserinfo\nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8915aeb6d8c6e1a26-40850785%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a45cc0618e78995d919e5750718d472cd663bbd7' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\themes\\Migliori\\modules\\blockuserinfo\\nav.tpl',
<<<<<<< HEAD
      1 => 1525382166,
=======
      1 => 1525377129,
>>>>>>> 63d8e5824e9e6bc1e8534ebb8ba25bc3c431f89e
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8915aeb6d8c6e1a26-40850785',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5aeb6d8c74ef00_49582174',
  'variables' => 
  array (
    'is_logged' => 0,
    'link' => 0,
    'cookie' => 0,
  ),
  'has_nocache_code' => false,
<<<<<<< HEAD
=======
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5aeb6d8c74ef00_49582174',
>>>>>>> 63d8e5824e9e6bc1e8534ebb8ba25bc3c431f89e
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5aeb6d8c74ef00_49582174')) {function content_5aeb6d8c74ef00_49582174($_smarty_tpl) {?><!-- Block user information module NAV  -->
<div class="header_user_info">
	<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
		<a class="logout" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockuserinfo'),$_smarty_tpl);?>

		</a>
	<?php } else { ?>
		<a class="login" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Sign in','mod'=>'blockuserinfo'),$_smarty_tpl);?>

		</a>
	<?php }?>
</div>
<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
	<div class="header_user_info mg_is_logged">
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow"><span><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
</span></a>
	</div>
<?php }?>
<!-- /Block usmodule NAV -->
<?php }} ?>
