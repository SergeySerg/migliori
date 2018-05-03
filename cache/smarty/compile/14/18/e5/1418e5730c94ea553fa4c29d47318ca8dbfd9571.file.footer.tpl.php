<?php /* Smarty version Smarty-3.1.19, created on 2018-05-04 00:10:37
         compiled from "E:\Webserver\domains\migliori.loc\themes\Migliori\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4975aeb6d8c8c8eb9-75098995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1418e5730c94ea553fa4c29d47318ca8dbfd9571' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\themes\\Migliori\\footer.tpl',
      1 => 1525381831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4975aeb6d8c8c8eb9-75098995',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5aeb6d8c9253f5_74127400',
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5aeb6d8c9253f5_74127400')) {function content_5aeb6d8c9253f5_74127400($_smarty_tpl) {?>
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
					</footer>
				</div><!-- #footer -->
			<?php }?>
		</div><!-- #page -->
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


	<!-- Start SiteHeart code -->
	<script>
	window.addEventListener('message', function(event) { 

    // IMPORTANT: Check the origin of the data! 
    if (~event.origin.indexOf('http://migliori.loc')) { 
        (function(){
			var widget_id = 895297;
			_shcp =[{widget_id : widget_id}];
			var lang =(navigator.language || navigator.systemLanguage
			|| navigator.userLanguage ||"en")
					.substr(0,2).toLowerCase();
			var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
			var hcc = document.createElement("script");
			hcc.type ="text/javascript";
			hcc.async =true;
			hcc.src =("https:"== document.location.protocol ?"https":"http")
					+"://"+ url;
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(hcc, s.nextSibling);
		})();
        console.log(event.data); 
    } else { 
        // The data hasn't been sent from your site! 
        // Be careful! Do not use it. 
        return; 
    } 
}); 
		
		
	</script>
	<!-- End SiteHeart code -->

	</body>
</html><?php }} ?>
