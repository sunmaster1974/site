<?php /* Smarty version Smarty-3.1.19, created on 2020-05-14 23:21:03
         compiled from "smarty/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4176014085ebda82ff1a339-86935412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '875c7e6b64e8222e79183ef4bce3bcbe425a1358' => 
    array (
      0 => 'smarty/templates/index.tpl',
      1 => 1495663425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4176014085ebda82ff1a339-86935412',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_login' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ebda830016b84_70480209',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebda830016b84_70480209')) {function content_5ebda830016b84_70480209($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['is_login']->value=="true") {?><?php echo $_smarty_tpl->getSubTemplate ("admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("forms.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } else { ?><?php echo $_smarty_tpl->getSubTemplate ("login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
