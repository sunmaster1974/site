<?php /* Smarty version Smarty-3.1.19, created on 2020-08-18 23:36:04
         compiled from "smarty/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11437192265f3c3bb47c5047-59811216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88465363706bcb2d30d94b07ecdc2b615eb397bd' => 
    array (
      0 => 'smarty/templates/login.tpl',
      1 => 1495663425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11437192265f3c3bb47c5047-59811216',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_restore' => 0,
    'user_login' => 0,
    'user_email' => 0,
    'is_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5f3c3bb47dd914_66097074',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f3c3bb47dd914_66097074')) {function content_5f3c3bb47dd914_66097074($_smarty_tpl) {?>	<div id="top_caption" class="login_window text">
		Конструктор лендингов LandKit
	</div>
	
	<div class="login_window">
	<?php if ($_smarty_tpl->tpl_vars['is_restore']->value=="true") {?>
		<div class="text caption">Восстановление пароля</div>
		<div id="icon_main">&nbsp;</div>
		<div class="window">
			<form action="index.php" method="post" name="restore_form">
			<table>
				<tr><td width="25%"><span class="text">Логин:</span></td><td><input class="input_text" name="user_login" type="text" value="<?php echo $_smarty_tpl->tpl_vars['user_login']->value;?>
" /></td></tr>
				<!--tr><td><span class="text">Email:</span></td><td><input class="input_text" name="user_email" type="text" value="<?php echo $_smarty_tpl->tpl_vars['user_email']->value;?>
" /></td></tr-->
				<tr><td>&nbsp;</td><td><input class="button_submit" type="submit" name="restore_submit" value="Выслать пароль" /></td></tr>
			</table>
			</form>
		</div>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['is_restore']->value=="false") {?><div class="text caption">Вход</div>
		<div id="icon_main">&nbsp;</div>
		<div class="window">
			<form action="index.php" method="post" name="login_form">
			<table>
				<tr><td width="25%"><span class="text">Логин:</span></td><td><input class="input_text" name="user_login" type="text" value="<?php echo $_smarty_tpl->tpl_vars['user_login']->value;?>
" /></td></tr>
				<tr><td><span class="text">Пароль:</span></td><td><input class="input_text" name="user_pass" type="password" /></td></tr>
				<tr><td>&nbsp;</td><td><input type="submit" name="login_submit" class="button_submit" value="Войти" /></td></tr>
			</table>
			</form>
			<div id="link_restore">
				<form action="index.php" method="post" name="show_restore_form">
					<input type="hidden" name="user_login" value="<?php echo $_smarty_tpl->tpl_vars['user_login']->value;?>
" />
					<input type="hidden" name="user_email" value="<?php echo $_smarty_tpl->tpl_vars['user_email']->value;?>
" />
					<input type="hidden" name="show_restore_submit" />
					<a href="#" class="links" onclick="document.show_restore_form.submit(); return false;">Восстановить пароль</a>
				</form>
			</div>		
		</div>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['is_error']->value!='') {?>
		<br />
		<div id="icon_info">&nbsp;</div>
		<div class="window"><?php echo $_smarty_tpl->tpl_vars['is_error']->value;?>
</div>
	<?php }?><div id="bottom_caption">
			<a class="links" href="http://www.webvertex.ru">&#169;&nbsp;&nbsp;Студия веб-дизайна «WebVertex»</a>
		</div>
	</div><?php }} ?>
