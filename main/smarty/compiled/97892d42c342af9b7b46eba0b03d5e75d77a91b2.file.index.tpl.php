<?php /* Smarty version Smarty-3.1.19, created on 2018-04-17 19:09:39
         compiled from "smarty/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8857936205ad60e332a3d84-09413340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97892d42c342af9b7b46eba0b03d5e75d77a91b2' => 
    array (
      0 => 'smarty/templates/index.tpl',
      1 => 1495663425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8857936205ad60e332a3d84-09413340',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_login' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ad60e3332b107_15382295',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad60e3332b107_15382295')) {function content_5ad60e3332b107_15382295($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['is_login']->value=="true") {?><?php echo $_smarty_tpl->getSubTemplate ("admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("forms.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } else { ?><?php echo $_smarty_tpl->getSubTemplate ("login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
