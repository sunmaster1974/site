<?php /* Smarty version Smarty-3.1.19, created on 2020-08-18 23:36:04
         compiled from "smarty/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18206475115f3c3bb45c3f40-97818141%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49348b2f844b53fb4fbb9d3ee544388114fd150f' => 
    array (
      0 => 'smarty/templates/index.tpl',
      1 => 1495663425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18206475115f3c3bb45c3f40-97818141',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_login' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5f3c3bb463e9c3_95114506',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f3c3bb463e9c3_95114506')) {function content_5f3c3bb463e9c3_95114506($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['is_login']->value=="true") {?><?php echo $_smarty_tpl->getSubTemplate ("admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("forms.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } else { ?><?php echo $_smarty_tpl->getSubTemplate ("login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
