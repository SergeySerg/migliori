<?php /* Smarty version Smarty-3.1.19, created on 2018-01-22 23:08:21
         compiled from "E:\Webserver\domains\migliori.loc\modules\onepagecheckout\views\templates\front\info-block-content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:242825a6652c5e689e7-00370230%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7532e60baddeaabfecb42836ea9b8c2438623c29' => 
    array (
      0 => 'E:\\Webserver\\domains\\migliori.loc\\modules\\onepagecheckout\\views\\templates\\front\\info-block-content.tpl',
      1 => 1516655170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242825a6652c5e689e7-00370230',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'modules_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5a6652c600dc54_56689776',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a6652c600dc54_56689776')) {function content_5a6652c600dc54_56689776($_smarty_tpl) {?>

<!-- Sample texts, inspired by matrice theme, please change to your needs -->
<h4><a id="toggle_link" href="#" onclick="toggle_info_block('[-]', '[+]'); return false;"
       title="Expand / Collapse Info block">[-]</a><?php echo smartyTranslate(array('s'=>'Info block','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</h4>
<div class="block_content">
    <img align="right" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['modules_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
onepagecheckout/views/img/info_block_success.png"/>
    <h5><?php echo smartyTranslate(array('s'=>'Secure payments','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</h5>

    <p><?php echo smartyTranslate(array('s'=>'we do not store any of your credit card details and have no access to your credit card information at any time','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</p>
    <img align="right" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['modules_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
onepagecheckout/views/img/info_block_success.png"/>
    <h5><?php echo smartyTranslate(array('s'=>'Quick delivery','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</h5>

    <p><?php echo smartyTranslate(array('s'=>'we deliver within 48h with Colissimo','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</p>
    <img align="right" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['modules_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
onepagecheckout/views/img/info_block_success.png"/>
    <h5><?php echo smartyTranslate(array('s'=>'Respect privacy','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</h5>

    <p><?php echo smartyTranslate(array('s'=>'we do not sell or rent your personal information to anyone','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</p>
    <img align="right" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['modules_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
onepagecheckout/views/img/info_block_phone.png"/>
    <h5><?php echo smartyTranslate(array('s'=>'Contact','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</h5>

    <p><?php echo smartyTranslate(array('s'=>'contact@myeshop.com','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</p>

    <p><?php echo smartyTranslate(array('s'=>'Phone: +33 12.34.56.78','mod'=>'onepagecheckout'),$_smarty_tpl);?>
</p>
    
</div>
<?php }} ?>
