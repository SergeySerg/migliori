<?php /* Smarty version Smarty-3.1.19, created on 2018-07-30 00:21:53
         compiled from "E:\Webserver\domains\migliori.loc\themes\Migliori\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:292065b5e2ff1226a22-61988390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1418e5730c94ea553fa4c29d47318ca8dbfd9571' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\themes\\Migliori\\footer.tpl',
      1 => 1532892264,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '292065b5e2ff1226a22-61988390',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b5e2ff1262964_80591715',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b5e2ff1262964_80591715')) {function content_5b5e2ff1262964_80591715($_smarty_tpl) {?>
<?php if (!isset($_smarty_tpl->tpl_vars['content_only']->value)||!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
					</div><!-- .row -->
				</div><!-- #columns -->
			</div><!-- .columns-container -->
			<?php if (isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value)) {?>
				<!-- Footer -->
				<div class="footer-container">
					<footer id="footer"  class="container">
						<div class="row"><?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
</div>
						<div class="row">						
							<div class="col-md-12">
								<div class="mg_partners">
									<span><?php echo smartyTranslate(array('s'=>'Partners'),$_smarty_tpl);?>
</span>
									<a href="https://pamami.pl/" target="_blank">
										<img src="/img/pamami.svg" alt="Producent czapek damskich i męskich PaMaMi">
									</a>
								</div>
							</div>
						</div>						
					</footer>
				</div><!-- #footer -->
			<?php }?>
		</div><!-- #page -->
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<<<<<<< HEAD
<!-- BEGIN JIVOSITE CODE  -->
<script type='text/javascript'>
	(function(){ var widget_id = 'ioBBkNpYVk';var d=document;var w=window;function l(){
		var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!--  END JIVOSITE CODE -->
</body>
<script type="text/javascript" src="/buyme/js/buyme.js"></script>
</html><?php }} ?>
