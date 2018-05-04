<?php /* Smarty version Smarty-3.1.19, created on 2018-05-03 23:54:44
         compiled from "E:\Webserver\domains\migliori.loc\admin2526queq9\themes\default\template\helpers\modules_list\modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114555aeb7714b02b60-69261041%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c207d51926f01a813a39dd291cfcc7aa13aeafc8' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\admin2526queq9\\themes\\default\\template\\helpers\\modules_list\\modal.tpl',
      1 => 1504515462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114555aeb7714b02b60-69261041',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5aeb7714b0a994_36422996',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5aeb7714b0a994_36422996')) {function content_5aeb7714b0a994_36422996($_smarty_tpl) {?><div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules and Services'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<?php }} ?>
