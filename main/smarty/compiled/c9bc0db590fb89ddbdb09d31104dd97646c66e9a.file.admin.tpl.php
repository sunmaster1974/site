<?php /* Smarty version Smarty-3.1.19, created on 2020-05-14 23:21:04
         compiled from "smarty/templates/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20748522425ebda830147b85-80701066%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9bc0db590fb89ddbdb09d31104dd97646c66e9a' => 
    array (
      0 => 'smarty/templates/admin.tpl',
      1 => 1589487659,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20748522425ebda830147b85-80701066',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_superadmin' => 0,
    'is_server' => 0,
    'errors_count' => 0,
    'is_admin' => 0,
    'page' => 0,
    'template_title' => 0,
    'template_id' => 0,
    'page_name' => 0,
    'page_id' => 0,
    'page_blocks' => 0,
    'page_block' => 0,
    'page_forms' => 0,
    'page_form_id' => 0,
    'page_form_title' => 0,
    'visitors_online' => 0,
    'orders_new_count' => 0,
    'type' => 0,
    'url' => 0,
    'user_login' => 0,
    'user_name' => 0,
    'user_email' => 0,
    'show_error' => 0,
    'users' => 0,
    'schemes' => 0,
    'scheme' => 0,
    'active_scheme_title' => 0,
    'logs' => 0,
    'view_id' => 0,
    'paginator' => 0,
    'sites' => 0,
    'date_update' => 0,
    'files_updated' => 0,
    'template' => 0,
    'templates' => 0,
    'layouts' => 0,
    'layout' => 0,
    'styles' => 0,
    'style' => 0,
    'site' => 0,
    'site_page' => 0,
    'pages' => 0,
    'variables' => 0,
    'variable' => 0,
    'doctypes' => 0,
    'scripts' => 0,
    'is_prototypes' => 0,
    'block_title' => 0,
    'is_global_save' => 0,
    'blocks' => 0,
    'strings' => 0,
    'block_code' => 0,
    'page_scrollable' => 0,
    'meta_title' => 0,
    'meta_description' => 0,
    'meta_keywords' => 0,
    'layouts_server' => 0,
    'layout_server' => 0,
    'block_file' => 0,
    'form' => 0,
    'forms' => 0,
    'catalogs' => 0,
    'images' => 0,
    'line1' => 0,
    'link_backwards' => 0,
    'link_center' => 0,
    'link_forwards' => 0,
    'line2' => 0,
    'date_first' => 0,
    'date_last' => 0,
    'max_days' => 0,
    'max_months' => 0,
    'show_yandex' => 0,
    'count_yandex' => 0,
    'count_total_yandex' => 0,
    'show_google' => 0,
    'count_google' => 0,
    'count_total_google' => 0,
    'show_bots' => 0,
    'count_bots' => 0,
    'count_total_bots' => 0,
    'referrers' => 0,
    'visitors' => 0,
    'enable_visitors_db' => 0,
    'enable_visitors_hint' => 0,
    'enable_visitors_title' => 0,
    'visitors_per_page_title' => 0,
    'visitors_per_page_hint' => 0,
    'visitors_per_page' => 0,
    'minutes_visitor_title' => 0,
    'minutes_visitor_online' => 0,
    'minutes_visitor_hint' => 0,
    'orders' => 0,
    'number' => 0,
    'errors' => 0,
    'settings' => 0,
    'message' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ebda83092ef34_10905811',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ebda83092ef34_10905811')) {function content_5ebda83092ef34_10905811($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include 'smarty/plugins/modifier.capitalize.php';
?><div id="top_panel">
	<ul id="user_list">
		<li>
			<div class="menu_item_non_hover caption"><b><span id="landkit">LandKit</span></b><div id="user_arrow"></div></div>
			<ul>
				<li class="hover"><a class="caption" href="index.php?page=account">Мой&nbsp;кабинет</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<li class="hover"><a class="caption" href="index.php?page=colors">Цветовые&nbsp;схемы</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value&&$_smarty_tpl->tpl_vars['is_server']->value) {?><li class="hover"><a class="caption" href="index.php?page=updates">Обновление</a></li>
				<li><div class="line_horiz">&nbsp;</div></li><?php }?>
				<li class="hover"><a class="caption" href="index.php?page=journal">Журнал<?php if ($_smarty_tpl->tpl_vars['errors_count']->value) {?>&nbsp;<sup><?php echo $_smarty_tpl->tpl_vars['errors_count']->value;?>
</sup><?php }?></a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<li class="hover">
					<form action="index.php" method="post" name="logout_form">
						<input type="hidden" name="logout_submit" value="1" />
						<a href="index.php?page=exit" class="caption" onclick="document.logout_form.submit(); return false;">Выход</a>
					</form>
				</li>
			</ul>
		</li>
		<li><div class="line_vert" style="margin-left: 20px;">&nbsp;</div></li>
		<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?><li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='templates') {?> active<?php }?>" href="index.php?page=templates">Шаблоны</a>
			<ul>
				<li style="padding: 5px; white-space: nowrap;">					
					Выбран шаблон:<br /><?php if ($_smarty_tpl->tpl_vars['template_title']->value) {?><a class="driver" href="index.php?page=templates&amp;type=<?php echo $_smarty_tpl->tpl_vars['template_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['template_title']->value;?>
</a><?php } else { ?><i>нет</i><?php }?>
				</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li><?php }?>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='pages') {?> active<?php }?>" href="index.php?page=pages">Страницы</a>
			<ul>
				<li style="padding: 5px; white-space: nowrap;">					
					Выбрана страница:<br /><?php if ($_smarty_tpl->tpl_vars['page_name']->value) {?><a class="driver" href="index.php?page=pages&amp;type=<?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page_name']->value;?>
</a><?php } else { ?><i>нет</i><?php }?>
				</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='blocks') {?> active<?php }?>" href="index.php?page=blocks">Блоки</a>
		<?php if ($_smarty_tpl->tpl_vars['page_blocks']->value) {?>
			<ul>
			<?php  $_smarty_tpl->tpl_vars['page_block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page_block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page_blocks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['page_block']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['page_block']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['page_block']->key => $_smarty_tpl->tpl_vars['page_block']->value) {
$_smarty_tpl->tpl_vars['page_block']->_loop = true;
 $_smarty_tpl->tpl_vars['page_block']->iteration++;
 $_smarty_tpl->tpl_vars['page_block']->last = $_smarty_tpl->tpl_vars['page_block']->iteration === $_smarty_tpl->tpl_vars['page_block']->total;
?>
				<li class="hover" style="white-space: nowrap;"><a class="caption" <?php if ($_smarty_tpl->tpl_vars['page_block']->value['status']=="0") {?>style="color: grey;"<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['page_block']->value['menu_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['page_block']->value['menu_title'];?>
</a></li>
				<?php if ($_smarty_tpl->tpl_vars['page_block']->last) {?><?php } else { ?><li><div class="line_horiz">&nbsp;</div></li><?php }?>
			<?php } ?>
			</ul>
		<?php }?>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='images') {?> active<?php }?>" href="index.php?page=images">Графика</a></li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='forms') {?> active<?php }?>" href="index.php?page=forms">Формы</a>
		<?php if ($_smarty_tpl->tpl_vars['page_forms']->value) {?>
			<ul>
			<?php  $_smarty_tpl->tpl_vars['page_form_title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page_form_title']->_loop = false;
 $_smarty_tpl->tpl_vars['page_form_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page_forms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['page_form_title']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['page_form_title']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['page_form_title']->key => $_smarty_tpl->tpl_vars['page_form_title']->value) {
$_smarty_tpl->tpl_vars['page_form_title']->_loop = true;
 $_smarty_tpl->tpl_vars['page_form_id']->value = $_smarty_tpl->tpl_vars['page_form_title']->key;
 $_smarty_tpl->tpl_vars['page_form_title']->iteration++;
 $_smarty_tpl->tpl_vars['page_form_title']->last = $_smarty_tpl->tpl_vars['page_form_title']->iteration === $_smarty_tpl->tpl_vars['page_form_title']->total;
?>
				<li class="hover" style="white-space: nowrap;"><a class="caption" href="index.php?page=forms&amp;type=<?php echo $_smarty_tpl->tpl_vars['page_form_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page_form_title']->value;?>
</a></li>
				<?php if ($_smarty_tpl->tpl_vars['page_form_title']->last) {?><?php } else { ?><li><div class="line_horiz">&nbsp;</div></li><?php }?>
			<?php } ?>
			</ul>
		<?php }?>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='visitors') {?> active<?php }?>" href="index.php?page=visitors">Посетители<?php if ($_smarty_tpl->tpl_vars['visitors_online']->value) {?>&nbsp;<sup><?php echo $_smarty_tpl->tpl_vars['visitors_online']->value;?>
</sup><?php }?></a>
			<ul>
				<li style="padding: 5px;">На сайте:<br /><?php echo $_smarty_tpl->tpl_vars['visitors_online']->value;?>
 посетителя(ей)</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='orders') {?> active<?php }?>" href="index.php?page=orders">Заявки<?php if ($_smarty_tpl->tpl_vars['orders_new_count']->value) {?> <sup><?php echo $_smarty_tpl->tpl_vars['orders_new_count']->value;?>
</sup><?php }?></a>
			<ul>
				<li style="padding: 5px;">Новых:<br /><?php echo $_smarty_tpl->tpl_vars['orders_new_count']->value;?>
 заявок</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item<?php if ($_smarty_tpl->tpl_vars['page']->value=='settings') {?> active<?php }?>" href="index.php?page=settings">Настройки</a>
			<ul>
				<li class="hover"><a class="caption" href="index.php?page=settings&amp;type=main">Основные</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<li class="hover"><a class="caption" href="index.php?page=settings&amp;type=counters">Счётчики</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<li class="hover"><a class="caption" href="index.php?page=settings&amp;type=scripts">Скрипты</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<li class="hover"><a class="caption" href="index.php?page=settings&amp;type=defaults">Предустановки</a></li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item" id="link_view" href="javascript:void(0);" target="_blank" onclick="return openSite('<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
');">Просмотр</a></li>
		<li><div class="line_vert">&nbsp;</div></li>
	</ul>
</div> <!-- #top_panel -->
<div id="center_panel">
<?php if ($_smarty_tpl->tpl_vars['page']->value=="account") {?>
<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" name="account_form">
	<div class="content" id="account">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Мой кабинет</div>
		<div class="tabs">
			<a class="caption tab_first<?php if ($_smarty_tpl->tpl_vars['type']->value=='data') {?> active_tab<?php }?>" href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=data">Данные</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='pass') {?> active_tab<?php }?>" href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=pass">Смена&nbsp;пароля</a><?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='list') {?> active_tab<?php }?>" href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=list">Пользователи</a><?php }?>
		</div>
		<table class="main_table">
		<?php if ($_smarty_tpl->tpl_vars['type']->value=="data") {?>
			<tr>
				<th>Логин</th>
				<th>Имя</th>
				<th>Электронная почта</th>
			</tr>
			<tr>
				<td><input type="text" class="input_text tooltip" name="user_login" value="<?php echo $_smarty_tpl->tpl_vars['user_login']->value;?>
" title="Логин может состоять из латинских букв, цифр, тире и знака  подчёркивания" /></td>
				<td><input type="text" class="input_text tooltip" name="user_name" value="<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
" title="Имя может состоять из латинских или русских букв, цифр, тире и знака подчёркивания" /></td>
				<td><input type="text" class="input_text tooltip" name="user_email" value="<?php echo $_smarty_tpl->tpl_vars['user_email']->value;?>
" title="Электронная почта должна быть введена" /></td>          
			</tr>
			<tr>
				<td colspan="3"><input type="checkbox" id="show_error" name="show_error"<?php if ($_smarty_tpl->tpl_vars['show_error']->value) {?>checked="checked"<?php }?> /><label for="show_error">Показывать только сообщения об ошибке</label></td>
			</tr>
			<tr>
				<th colspan="3" class="border_top"><input type="submit" name="save_account" class="button_submit" value="Сохранить" /></th>
			</tr>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['type']->value=="pass") {?>
			<tr>
				<th>Старый пароль</th>
				<th>Новый пароль</th>
				<th>Новый пароль ещё раз</th>
			</tr>
			<tr>
				<td><input type="password" class="input_text" name="user_pass" value="" /></td>
				<td><input type="password" class="input_text tooltip" name="user_new_pass1" value="" title="Пароль может состоять из латинских букв, цифр, тире и знака подчёркивания и иметь длину не менее 6 символов" /></td>
				<td><input type="password" class="input_text" name="user_new_pass2" value="" /></td>          
			</tr>
			<tr>
				<td colspan="3"><input type="checkbox" id="send_data" name="send_data" value="on" /><label for="send_data">Отправить новый пароль на электронную почту</label></td>
			</tr>
			<tr>
				<th colspan="3" class="border_top"><input type="submit" name="save_account" class="button_submit" value="Сохранить" /></th>
			</tr>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['type']->value=="list") {?>
			<tr>
				<th width="32%">Логин</th>
				<th width="32%">Имя</th>
				<th width="32%">Электронная почта</th>
				<th width="4%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['users']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['users']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['users']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['login'];?>
</td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['users']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
</td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['users']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['email'];?>
</td>
				<td style="text-align: center;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','<?php echo $_smarty_tpl->tpl_vars['users']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Удалить запись о пользователе"> X </a></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="4" class="no_rows">Пользователей нет</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="4" class="border_top"><input type="button" name="create_user" class="button_submit" onclick="createUser();" value="Добавить" /></th>
			</tr>
		<?php }?>
		</table>
	</div> <!-- #account -->
</form>
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="colors") {?>
	<div class="content" id="colors">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Цветовые схемы</div>
		<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" name="colors_form">
		<table class="main_table">
			<tr>
				<th colspan="4">
					Выберите цветовую схему:&nbsp;&nbsp;
					<select name="name" class="input_text" style="width: 200px;" onchange="window.location='index.php?page=colors&amp;type='+this.value;">
				<?php if ($_smarty_tpl->tpl_vars['schemes']->value) {?>
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['schemes']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']==$_smarty_tpl->tpl_vars['scheme']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</option>
					<?php endfor; endif; ?>
				<?php }?>
					</select>
				</th>
			</tr>
			<tr>
				<td width="23%">Основной цвет надписей и заголовков, рамок панелей</td>
				<td width="27%" style="line-height: 52px;"><input type="text" id="main-color" name="main-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['main-color'];?>
" /></td>
				<td width="23%">Цвет фона верхней панели, фона заголовков таблиц</td>
				<td width="27%" style="line-height: 52px;"><input type="text" id="back-color" name="back-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['back-color'];?>
" /></td>
			</tr>
			<tr>
				<td>Цвет текста</td>
				<td style="line-height: 52px;"><input type="text" id="text-color" name="text-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['text-color'];?>
" /></td>
				<td>Цвет ссылок</td>
				<td style="line-height: 52px;"><input type="text" id="link-color" name="link-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['link-color'];?>
" /></td>
			</tr>
			<tr>
				<td>Цвет шрифта предупреждающих сообщений</td>
				<td style="line-height: 52px;"><input type="text" id="info-color" name="info-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['info-color'];?>
" /></td>
				<td>Цвет шрифта сообщений об ошибках, символов-кнопок</td>
				<td style="line-height: 52px;"><input type="text" id="error-color" name="error-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['error-color'];?>
" /></td>
			</tr>
			<tr>
				<td>Цвет шрифта сообщений об успешном выполнении операции, символов-кнопок</td>
				<td style="line-height: 52px;"><input type="text" id="success-color" name="success-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['success-color'];?>
" /></td>
				<td>Цвет надписей на кнопках и во всплывающих окне и подсказках</td>
				<td style="line-height: 52px;"><input type="text" id="bright-color" name="bright-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['bright-color'];?>
" /></td>
			</tr>
			<tr>
				<td>Цвет фона выделенных пунктов меню, фона активной вкладки, подсветки строки таблицы</td>
				<td style="line-height: 52px;"><input type="text" id="back-acive-color" name="back-acive-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['back-acive-color'];?>
" /></td>
				<td>Цвет рамок элементов, основа фона кнопок и всплывающих подсказок</td>
				<td style="line-height: 52px;"><input type="text" id="border-input-color" name="border-input-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['border-input-color'];?>
" /></td>
			</tr>
			<tr>
				<td>Цвет рамок изображений, тени надписей и тени панелей</td>
				<td style="line-height: 52px;"><input type="text" id="shadow-color" name="shadow-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['shadow-color'];?>
" /></td>
				<td>Цвет заднего фона страницы, фона элементов ввода</td>
				<td style="line-height: 52px;"><input type="text" id="back-input-color" name="back-input-color" class="input_text iColorPicker" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['back-input-color'];?>
" /></td>
			</tr>
			<tr>
				<th colspan="4" class="border_top">
					<input type="submit" name="save_scheme" class="button_submit" value="Сохранить" />
				</th>
			</tr>
			<tr>
				<th colspan="4" class="border_top">
					<input type="button" class="button_submit long_button tooltip" value="Добавить схему" onclick="createScheme();" title="Создать новую цветовую схему на основе выбранной цветовой схемы" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button_submit long_button tooltip" value="Удалить схему" onclick="deleteScheme();" title="Удалить одну или несколько цветовых схем, кроме схемы, установленной в конструкторе" />
				</th>
			</tr>
			<tr>
				<td colspan="4" class="border_top">
					Установлена цветовая схема: «<?php echo $_smarty_tpl->tpl_vars['active_scheme_title']->value;?>
»
				</td>
			</tr>
			<tr>
				<th colspan="4" class="border_top">
					<input type="hidden" name="scheme_id" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['id'];?>
" />
					<input type="hidden" name="scheme_title" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['title'];?>
" />
					<input type="submit" name="apply_scheme" class="button_submit" value="Установить выбранную схему" />
				</th>
			</tr>
		</table>
		</form>
	</div> <!-- #colors -->
<script type="text/javascript">
$(document).ready(function() {
	$('.iColorPicker').jPicker({window: {position: {x: 'center', y: '45px'}, updateInputColor: false}});
});
</script>
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="journal") {?>
	<div class="content" id="journal">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Журнал ошибок</div>
		<table class="main_table">
		<?php if ($_smarty_tpl->tpl_vars['type']->value=="logs") {?>
			<tr>
				<th width="5%">№</th>
				<th width="10%">Дата</th>
				<th width="45%">Сообщение</th>
				<th width="40%">Данные</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['logs']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['logs']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr<?php if ($_smarty_tpl->tpl_vars['view_id']->value==$_smarty_tpl->tpl_vars['logs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']) {?> style="font-weight: bold;"<?php }?>>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['logs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
</td>
				<td style="padding: 20px 5px;"><?php echo $_smarty_tpl->tpl_vars['logs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['date_time'];?>
</td>
				<td style="text-align: left; word-break: break-all;"><?php echo $_smarty_tpl->tpl_vars['logs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['text'];?>
</td>
				<td style="text-align: left; word-break: break-all;"><?php echo $_smarty_tpl->tpl_vars['logs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['data'];?>
</td>
			</tr>
			<?php endfor; endif; ?>
			<?php if ($_smarty_tpl->tpl_vars['paginator']->value) {?>
			<tr>
				<th colspan="4" class="border_top"><?php echo $_smarty_tpl->tpl_vars['paginator']->value;?>
</th>
			</tr>
			<?php }?>
		<?php } else { ?>
			<tr>
				<td colspan="4" class="no_rows">Записей нет</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="4" class="border_top"><input type="button" name="clear_logs" class="button_submit" onclick="confirmDialog('clear_logs');" value="Очистить" /></th>
			</tr>
		<?php }?>
		</table>	
	</div> <!-- #journal -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="updates") {?>
	<div class="content" id="updates">
	<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value&&$_smarty_tpl->tpl_vars['is_server']->value) {?>
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Обновление конструктора на клиентских сайтах</div>
		<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" method="post" name="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_form">
		<table class="main_table">
			<tr>
				<th width="5%">№</th>
				<th width="10%">Дата установки</th>
				<th width="25%">Описание сайта</th>	
				<th width="30%">Адрес сайта</th>
				<th width="25%">Заметки</th>
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['sites']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['sites']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
</td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['date'];?>
</td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['site_title'];?>
</td>	
				<td style="text-align: center;">
					<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['site_name'];?>

					<br />
					<a class="driver link_go" href="<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['site_name'];?>
" onclick="this.target='_blank'">Сайт</a>
					<a class="driver link_go" href="<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['site_name'];?>
main/index.php" onclick="this.target='_blank'">Конструктор</a></td>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['notes'];?>
</td>	
				<td style="text-align: center;"><input type="checkbox" name="is-update-<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" id="is-update-<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['is_update']==1) {?> checked="checked" value="1"<?php } else { ?> value="0"<?php }?> onclick="if (this.checked) this.value='1'; else this.value='0';" /><label class="without_text tooltip" title="Включить/выключить<br />обновление для сайта" for="is-update-<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="6" class="no_rows">Сайтов нет</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="6" class="border_top"><input type="submit" name="save_updates" class="button_submit" value="Сохранить" /></th>
			</tr>
			<tr>
				<th colspan="6" class="border_top">Выполнение SQL-запроса к базам данных сайтов</th>
			</tr>
			<tr>
				<td colspan="6">
					<span style="display: block; margin-top: 5px;">Введите текст SQL-запроса:</span>
					<textarea name="sql_query" rows="10" cols="50" class="input_text code" style="width: 700px; height: 100px; margin-top: 20px; margin-bottom: 20px;"></textarea></td>
			</tr>
			<tr>
				<th colspan="6" class="border_top"><input type="submit" name="send_queries" class="button_submit" value="Отправить" /></th>
			</tr>
			<tr>
				<th colspan="6" class="border_top">Отправка исходных файлов конструктора на сайты</th>
			</tr>
			<tr>
				<td colspan="6">Введите дату изменения файлов:&nbsp;&nbsp;<input type="text" class="input_text tooltip" style="width: 80px;" name="date_update" value="<?php echo $_smarty_tpl->tpl_vars['date_update']->value;?>
" onfocus="this.select(); lcs(this);" onclick="event.cancelBubble=true; this.select(); lcs(this);" title="Исходные файлы конструктора с датой изменения, старше указанной, будут отправлены на выбранные клиентские сайты" /><br /><br />
				
				<table class="install_table_inner files_updated_table">
				<tr>
					<th colspan="4">Файлы для обновления (<?php echo count($_smarty_tpl->tpl_vars['files_updated']->value);?>
):</th>
				</tr>
			<?php if ($_smarty_tpl->tpl_vars['files_updated']->value) {?>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['j'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['files_updated']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total']);
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['files_updated']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['show'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['files_updated']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['dir'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['files_updated']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['name'];?>
</td>
					<td style="width: 70px;"><input type="checkbox" name="is-send-<?php echo $_smarty_tpl->tpl_vars['files_updated']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
" id="is-send-<?php echo $_smarty_tpl->tpl_vars['files_updated']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
" checked="checked" value="1" onclick="if (this.checked) this.value='1'; else this.value='0';" /><label class="without_text" for="is-send-<?php echo $_smarty_tpl->tpl_vars['files_updated']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
">&nbsp;</label></td>
				</tr>
				<?php endfor; endif; ?>
			<?php } else { ?>
				<tr>
					<td colspan="4" class="no_rows">Файлов нет</td>
				</tr>
			<?php }?>
				</table>
				<br />
				<input type="checkbox" name="update_files_to_sites" id="update_files_to_sites" /><label class="tooltip" title="Если галочка снята, то по кнопке «Обновить» будет обновлён только список файлов в данном окне (без отправки файлов на клиентские сайты)" for="update_files_to_sites">Отправить указанные файлы на выбранные сайты</label>
				<br /><br />
				</td>
			</tr>
			<tr>
				<th colspan="6" class="border_top"><input type="submit" name="update_files" class="button_submit" value="Обновить" /></th>
			</tr>
		</table>
		</form>
	<?php } else { ?>
		<br /><br />
		<div class="no_rows">Нет прав для просмотра данной страницы</div>
	<?php }?>
	</div> <!-- #updates -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="templates") {?>
	<div class="content" id="templates">
<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Список шаблонов</div>
		<div class="tabs">
			<a class="caption first_tab<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?> active_tab<?php }?>" href="index.php?page=templates&amp;type=all">Все шаблоны</a><?php if ($_smarty_tpl->tpl_vars['type']->value!='all') {?><a class="caption active_tab" href="index.php?page=templates&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['template']->value['caption'];?>
</a><?php }?><?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?><a class="caption" href="index.php?page=templates&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=create_template">Новый шаблон</a><?php }?>
		</div>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>
		<table class="main_table">
			<tr>
				<th width="5%">&nbsp;</th>
				<th width="15%">Название</th>
				<th width="15%">Каталог</th>
				<th width="40%">Описание</th>
				<th width="20%">Изображение</th>				
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['templates']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['templates']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
				<td style="padding: 10px 0px;"><input type="radio" id="radio-<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==1) {?> checked="checked"<?php }?> onclick="window.location='index.php?page=templates&amp;type=all&amp;action=choose&amp;id=<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
';" /><label class="tooltip" title="Выбрать шаблон" for="radio-<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
				<td><a class="driver" href="index.php?page=templates&amp;type=<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a></td>
				<td><?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['catalog'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['description'];?>
</td>
				<td><?php if ($_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['image']) {?><a class="fancybox" rel="group" href="/templates/<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['catalog'];?>
/<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['image'];?>
"><img class="template_big" src="/templates/<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['catalog'];?>
/<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['image'];?>
" alt="Изображение" /></a><?php }?></td>				
				<td style="padding: 10px 0px;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','<?php echo $_smarty_tpl->tpl_vars['templates']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Удалить шаблон">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="6" class="no_rows">Шаблонов нет</td>
			</tr>
		<?php }?>
		</table>
	<?php } else { ?>
	<script type="text/javascript" src="scripts/ZeroClipboard.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var client = new ZeroClipboard($(".copy_images"));
		});
	</script>
		<table class="main_table">
			<tr>
				<th width="25%">Название</th>
				<th width="25%">Каталог</th>
				<th width="35%">Описание</th>
				<th width="10%">Изображение</th>				
				<th width="5%">&nbsp;</th>
			</tr>
			<tr>
				<td><input type="text" class="input_text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['template']->value['title'];?>
" /></td>
				<td><input type="text" class="input_text" name="catalog" value="<?php echo $_smarty_tpl->tpl_vars['template']->value['catalog'];?>
" /></td>
				<td><textarea class="input_text" name="description"><?php echo $_smarty_tpl->tpl_vars['template']->value['description'];?>
</textarea></td>
				<td><?php if ($_smarty_tpl->tpl_vars['template']->value['image']) {?><a class="fancybox" rel="group" href="/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value['catalog'];?>
/<?php echo $_smarty_tpl->tpl_vars['template']->value['image'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['template']->value['title'];?>
"><img src="/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value['catalog'];?>
/<?php echo $_smarty_tpl->tpl_vars['template']->value['image'];?>
" alt="Изображение" class="template" /></a><?php } else { ?>&nbsp;<?php }?></td>				
				<td style="padding: 10px 0px;"><form class="upload_form" action="index.php?page=templates&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=load_image" method="post" enctype="multipart/form-data"><div class="icon_plus">&nbsp;+&nbsp;</div><input type="file" name="uploadfile" class="upload_file tooltip" onchange="sitesMan.onImageUpload(event,this);return false;" accept="image/*" title="Загрузить изображение" /></form></td>
			</tr>			
			<tr>
				<th colspan="5" class="border_top">CSS медиа-запросы</th>
			</tr>
		<?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
			<tr>
				<td><input type="text" class="input_text layout tooltip" name="layout-title-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['layout']->value['title'];?>
" title="Название css медиа-запроса<br />для отображения в css табах" /></td>
				<td colspan="2"><textarea class="input_text tooltip" name="layout-text-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
" title="Заголовок css медиа-запроса в виде комментария и команды @media<br />без фигурных скобок"><?php echo $_smarty_tpl->tpl_vars['layout']->value['text'];?>
</textarea></td>				
				<td><table class="table_arrows"><tr><td><input type="text" class="input_text short_input tooltip" name="layout-sort-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['layout']->value['sort'];?>
" title="Порядок следования css медиа-запроса<br />в конечном файле стилей сайта" /></td><td style="padding-top: 25px;"><a class="icon_arrows" href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=move_up&amp;id=<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
">&nbsp;ˆ&nbsp;</a><br /><a class="icon_arrows" href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=move_down&amp;id=<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
">&nbsp;ˇ&nbsp;</a></td></tr></table></td>
				<td><a class="icon_delete tooltip" href="javascript:confirmDialog('delete_layout','<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
');" title="Удалить css медиа-запрос">&nbsp;X&nbsp;</a></td>
			</tr>
		<?php } ?>
			<tr>
				<th colspan="5" class="border_top"><input type="button" name="add_layout" class="button_submit button_long" value="Добавить css медиа-запрос" onclick="addLayout();" /></th>
			</tr>
			<tr>
				<td colspan="5" class="border_top" style="height: 21px;">&nbsp;</td>
			</tr>
			<tr>
				<th colspan="5" class="border_top">CSS правила</th>
			</tr>
			<tr>
				<td colspan="5" style="text-align: left;">
					<a onclick="$('#styles_block').slideToggle('quick');" href="javascript://"><span class="caption styles_title tooltip" title="Показать/скрыть<br />группу css-переменных">CSS-переменные</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:createStyles();"><span class="caption styles_title tooltip" title="Настроить параметры текста, заголовков и ссылок">Настройки текста</span></a>
					<div id="styles_block" style="display: none;">
						<table class="small_table styles_table"<?php if (!$_smarty_tpl->tpl_vars['styles']->value) {?> style="width: 100%;"<?php }?>>
						<?php if ($_smarty_tpl->tpl_vars['styles']->value) {?>
						<?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['style']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['styles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['style']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value) {
$_smarty_tpl->tpl_vars['style']->_loop = true;
 $_smarty_tpl->tpl_vars['style']->iteration++;
?>
							<?php if (($_smarty_tpl->tpl_vars['style']->iteration==1)||(!(($_smarty_tpl->tpl_vars['style']->iteration-1) % 3))) {?>
							<tr>
							<?php }?>
								<td><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="$<?php echo $_smarty_tpl->tpl_vars['style']->value['name'];?>
" /><span class="copy_name">$<?php echo $_smarty_tpl->tpl_vars['style']->value['name'];?>
</span></td>
								<td>= <input type="text" class="input_text" name="style-<?php echo $_smarty_tpl->tpl_vars['style']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['style']->value['value'];?>
" /></td><td>&nbsp;&nbsp;</td>
							<?php if (!($_smarty_tpl->tpl_vars['style']->iteration % 3)) {?>
							</tr>
							<?php }?>
						<?php } ?>
						<?php } else { ?>
							<tr><td class="no_rows" style="text-align: center;">CSS-переменных нет</td></tr>
						<?php }?>
						</table>
						<div class="styles_actions">
							<a href="javascript:addStyle();" class="tooltip" title="Добавить css-переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить css-переменную" /></a>
							<a href="javascript:saveStyles();" class="tooltip" title="Сохранить значения css-переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения css-переменных" /></a>
							<a href="javascript:deleteStyle();" class="tooltip" title="Удалить css-переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить css-переменную" /></a>						
						</div>
					</div>
					<ul id="css_nav"><?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?><li><a class="caption" href="#css-tab-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['layout']->value['caption'];?>
</a></li><?php } ?></ul>
					<div id="css_tabs">
					<?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
						<p id="css-tab-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
"><textarea class="input_text code" name="css-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['layout']->value['template_csstext'];?>
</textarea></p>
					<?php } ?>
					</div>
				</td>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value&&$_smarty_tpl->tpl_vars['is_server']->value) {?>
			<tr>
				<td colspan="5" class="border_top">
					<input type="checkbox" id="install_to_client" name="install_to_client" onclick="$('#install_block').slideToggle('quick'); if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="install_to_client">Установить конструктор с этим шаблоном на сайт</label>
					<div id="install_block" style="display: none; text-align: center;">
						<div class="install_template_block">Перед установкой конструктора:<br />
1. на хостинге нового сайта внесите IP адрес сервера 79.174.64.19: MySQL Management => имя_базы => Access Hosts<br />
2. на ftp-сервере нового сайта задайте полные права доступа 777 папке, в которую будет установлен конструктор
						</div>
						<div class="install_template_block">Для установки на сайт все поля должны быть заполнены</div>
<script type="text/javascript">
	function getIP(site) {
		if (site != '') {
			site = site.replace(/http\:\/\//, '');
			$.getJSON('getip.php?site='+site, function(data){
				$("#site_ip").val(data.ip);
			});
		}
	}
</script>
						Выберите сайт для установки:&nbsp;&nbsp;
						<select name="site_name" class="input_text" style="width: 200px;" onchange="window.location='index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;site_id=' + this.value;">
							<option value="0">Новый сайт</option>
					<?php if ($_smarty_tpl->tpl_vars['sites']->value) {?>
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['sites']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']==$_smarty_tpl->tpl_vars['site']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['sites']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['site_name'];?>
</option>
						<?php endfor; endif; ?>
					<?php }?>
						</select>
						<br /><br /><br />
						<input type="hidden" name="site_id" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['id'];?>
" />
						Описание сайта:&nbsp;&nbsp;&nbsp;<input type="text" class="input_text tooltip" name="site_title" style="width: 300px; margin-bottom: 5px;" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_title'];?>
" title="Краткое описание сайта для таблицы сайтов для обновления" /><br />
						URL адрес сайта: <input type="text" class="input_text tooltip" name="site_name" style="width: 300px; margin-bottom: 5px;" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>
" title="Полный URL-адрес сайта, например, http://www.mysite.ru/" onblur="getIP(this.value);" /><br />
						IP&nbsp;&nbsp;адрес&nbsp;&nbsp;сайта:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="input_text tooltip" name="site_ip" id="site_ip" style="width: 300px;" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_ip'];?>
" title="IP адрес сайта можно узнать на ru.siteipaddr.com" />
						<br /><br />
						<table class="install_table_outer">
							<tr>
								<td>
									<table class="install_table_inner">
										<tr>
											<th colspan="2">Доступ к ftp-серверу:</th>
										</tr>
										<tr>
											<td>URL адрес:</td>
											<td><input type="text" class="input_text tooltip" name="ftp_server" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['ftp_server'];?>
" title="URL-адрес для входа на ftp-сервер сайта, например, webvertex.ru" /></td>
										</tr>
										<tr>
											<td>каталог:</td>
											<td><input type="text" class="input_text tooltip" name="ftp_folder" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['ftp_folder'];?>
" title="Полный путь, начиная от корня,<br />к каталогу для установки конструктора, например, domains/webvertex.ru/public_html/lp"/></td>
										</tr>
										<tr>
											<td>логин:</td>
											<td><input type="text" class="input_text" name="ftp_user" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['ftp_user'];?>
" /></td>
										</tr>
										<tr>
											<td>пароль:</td>
											<td><input type="text" class="input_text" name="ftp_pass" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['ftp_pass'];?>
" /></td>
										</tr>
									</table>
								</td>
								<td>
									<table class="install_table_inner">
										<tr>
											<th colspan="2">Доступ к базе данных:</th>
										</tr>
										<tr>
											<td>хост:</td>
											<td><input type="text" class="input_text" name="db_host" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['db_host'];?>
" /></td>
										</tr>
										<tr>
											<td>название:</td>
											<td><input type="text" class="input_text" name="db_name" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['db_name'];?>
" /></td>
										</tr>
										<tr>
											<td>логин:</td>
											<td><input type="text" class="input_text" name="db_user" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['db_user'];?>
" /></td>
										</tr>
										<tr>
											<td>пароль:</td>
											<td><input type="text" class="input_text" name="db_pass" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['db_pass'];?>
" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<div class="install_template_block"><input type="checkbox" name="forbidden_full_rights" id="forbidden_full_rights"<?php if ($_smarty_tpl->tpl_vars['site']->value['forbidden_full_rights']==1) {?> checked="checked"<?php }?> /><label for="forbidden_full_rights">На хостинге установлено ограничение на запуск скриптов с правами 777</label></div>
						<input type="button" name="install_template" class="button_submit" value="Установить" onclick="submitForm('install_template','<?php echo $_smarty_tpl->tpl_vars['template']->value['id'];?>
');" />
					</div>
				</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="5" class="border_top">
					<input type="hidden" name="form_action" id="form_action" />
					<input type="button" name="save_template" class="button_submit button_long" value="Сохранить и обновить сайт" onclick="submitForm('save_template','<?php echo $_smarty_tpl->tpl_vars['template']->value['id'];?>
');" />
				</th>
			</tr>
		</table>
	<?php }?>
<?php } else { ?>
		<br /><br />
		<div class="no_rows">Нет прав для просмотра данной страницы</div>
<?php }?>
	</div> <!-- #templates -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="pages") {?>
	<div class="content" id="pages">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Страницы шаблона «<?php echo $_smarty_tpl->tpl_vars['template_title']->value;?>
»</div>
		<div class="tabs">
			<a class="caption first_tab<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?> active_tab<?php }?>" href="index.php?page=pages&amp;type=all">Все страницы</a><?php if ($_smarty_tpl->tpl_vars['type']->value!='all') {?><a class="caption active_tab" href="index.php?page=pages&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['site_page']->value['caption'];?>
</a><?php }?><a class="caption" href="javascript:createPage();">Новая страница</a>
		</div>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>
		<table class="main_table">
			<tr>
				<th width="5%">&nbsp;</th>
				<th width="25%">Название</th>
				<th width="25%">Имя файла (или полный путь)</th>
				<th width="30%">Заголовок</th>
				<th width="5%">Вкл.</th>
				<th width="5%">SEO</th>
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['pages']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['pages']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
				<td style="padding: 10px 0px;"><input type="radio" id="radio-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==1) {?> checked="checked"<?php }?> onclick="window.location='index.php?page=pages&amp;type=all&amp;action=choose&amp;id=<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
';" /><label class="tooltip" title="Выбрать страницу" for="radio-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
				<td><a class="driver" href="index.php?page=pages&amp;type=<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
</a></td>
				<td><?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</td>
				<td><input type="checkbox" id="checkbox-visible-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['visible']==1) {?> checked="checked"<?php }?> onclick="window.location='index.php?page=pages&amp;type=all&amp;action=change_visibility&amp;id=<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
';" /><label class="without_text tooltip" title="Изменить видимость страницы" for="checkbox-visible-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
				<td><input type="checkbox" id="checkbox-scrollable-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['scrollable']==1) {?> checked="checked"<?php }?> onclick="window.location='index.php?page=pages&amp;type=all&amp;action=change_scrollability&amp;id=<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
';" /><label class="without_text tooltip" title="Изменить способ создания страницы" for="checkbox-scrollable-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
				<td style="padding: 10px 0px;"><a class="icon_edit tooltip" href="javascript:doublePage(<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
);" title="Дублировать страницу">&nbsp;D&nbsp;</a><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Удалить страницу">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="7" class="no_rows">Страниц нет</td>
			</tr>
		<?php }?>
		</table>
	<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
	<script type="text/javascript" src="scripts/ZeroClipboard.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var client = new ZeroClipboard($(".copy_images"));
		});
	</script>
	<?php }?>
		<table class="main_table">
			<tr>
				<th>Настройки страницы</th>
			</tr>
			<tr>
				<td style="padding-bottom: 15px;">
					<table width="100%">
						<tr>
							<td style="width: 50%; border-top: none; padding: 10px 0 0 0; vertical-align: top;"><span class="caption">Название:</span>&nbsp;&nbsp;<input type="text" style="width: 80%;" class="input_text tooltip" name="name" title="Название страницы может состоять из латинских и русских букв, цифр, тире, точки, запятой и скобок" value="<?php echo $_smarty_tpl->tpl_vars['site_page']->value['name'];?>
" /></td>
							<td style="width: 50%; border-top: none; padding: 10px 0 0 0; vertical-align: top;"><span class="caption">Имя файла:</span>&nbsp;&nbsp;<input type="text" style="width: 80%;" class="input_text tooltip" name="file" title="Если файлы страниц должны находиться в разных папках, введите полный внутренний путь с названием и расширением файла .php, иначе  только название файла (без расширения)" value="<?php echo $_smarty_tpl->tpl_vars['site_page']->value['file'];?>
" /></td>
						</tr>
					</table>
					<div style="text-align: center; margin-bottom: 20px;">
						<input type="checkbox" name="delete_inactive" id="delete_inactive" <?php if ($_smarty_tpl->tpl_vars['site_page']->value['delete_inactive']==1) {?>checked="checked"<?php }?> /><label for="delete_inactive">Удалять файл страницы, если страница отключена</label>
					</div>
					<div id="favicon_info"><?php if ($_smarty_tpl->tpl_vars['site_page']->value['favicon']) {?>Установлена иконка: <img src="<?php echo $_smarty_tpl->tpl_vars['site_page']->value['favicon'];?>
" alt="" /><?php } else { ?>Иконка отсутствует<?php }?></div>
					<form action="index.php?page=pages&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" name="upload_form" method="post" class="upload_form button_submit" enctype="multipart/form-data">
					<?php if ($_smarty_tpl->tpl_vars['site_page']->value['favicon']) {?>
						<div>Заменить</div>
					<?php } else { ?>
						<div>Загрузить</div>
					<?php }?>
						<input type="file" name="uploadfile" class="upload_file" onchange="sitesMan.onFaviconUpload(event,this);return false;" accept="image/x-icon" />
					</form>
				<?php if ($_smarty_tpl->tpl_vars['site_page']->value['favicon']) {?>
					<input type="button" name="favicon_delete" class="button_submit" value="Удалить" onclick="confirmDialog('delete_favicon');" />
				<?php }?>
				</td>
			</tr>
			<tr>
				<th class="border_top">SEO-параметры страницы</th>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td style="border-top: none; padding: 0 0 0 10px;" colspan="2">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Заголовок:&nbsp;&nbsp;<input type="text" class="input_text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['site_page']->value['title'];?>
" style="width: 90%;" /></div></td>
						</tr>
						<tr>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Описание</div>
								<textarea class="input_text" name="meta_description" style="height: 100px;"><?php echo $_smarty_tpl->tpl_vars['site_page']->value['meta_description'];?>
</textarea></td>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Ключевые слова</div>
								<textarea class="input_text" name="meta_keywords" style="height: 100px;"><?php echo $_smarty_tpl->tpl_vars['site_page']->value['meta_keywords'];?>
</textarea></td>
						</tr>
					</table>
				</td>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
			<tr>
				<th class="border_top">Переменные страницы</th>
			</tr>
			<tr>
				<td>
					<div id="variables_block">
						<table class="small_table styles_table" style="width: 100%; display: block; margin-bottom: 20px;">
					<?php if ($_smarty_tpl->tpl_vars['variables']->value) {?>
						<?php  $_smarty_tpl->tpl_vars['variable'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['variable']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variables']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['variable']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['variable']->key => $_smarty_tpl->tpl_vars['variable']->value) {
$_smarty_tpl->tpl_vars['variable']->_loop = true;
 $_smarty_tpl->tpl_vars['variable']->iteration++;
?>
							<?php if (($_smarty_tpl->tpl_vars['variable']->iteration==1)||(!(($_smarty_tpl->tpl_vars['variable']->iteration-1) % 2))) {?>
							<tr>
							<?php }?>
								<td style="width: 50%; text-align: left; padding-right: 10px;"><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="$<?php echo $_smarty_tpl->tpl_vars['variable']->value['name'];?>
" /><span class="copy_name">$<?php echo $_smarty_tpl->tpl_vars['variable']->value['name'];?>
</span><br />
								<textarea class="input_text" style="margin-top: 5px; width: 480px !important;" name="variable-<?php echo $_smarty_tpl->tpl_vars['variable']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['variable']->value['value'];?>
</textarea></td>
							<?php if (!($_smarty_tpl->tpl_vars['variable']->iteration % 2)) {?>
							</tr>
							<?php }?>
						<?php } ?>
					<?php } else { ?>
							<tr><td class="no_rows" style="text-align: center;">Переменных нет</td></tr>
					<?php }?>
						</table>
						<div class="styles_actions">
							<a href="javascript:addVariable();" class="tooltip" title="Добавить переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить переменную" /></a>
							<a href="javascript:saveVariables();" class="tooltip" title="Сохранить значения переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения переменных" /></a>
							<a href="javascript:deleteVariable();" class="tooltip" title="Удалить переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить переменную" /></a>						
						</div>
					</div>
				</td>
			</tr>
		<?php }?>
			<tr>
				<th class="border_top">Содержимое страницы</th>
			</tr>
			<tr>
				<td style="text-align: left;">
					<div class="caption tooltip link_title" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=defaults" class="setting_link">Тип документа</a></div>
					<select name="doctype" class="input_text">				
				<?php if ($_smarty_tpl->tpl_vars['doctypes']->value) {?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['doctypes']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['doctypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']];?>
"<?php if ($_smarty_tpl->tpl_vars['site_page']->value['doctype']==$_smarty_tpl->tpl_vars['doctypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['doctypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']];?>
</option>
				<?php endfor; endif; ?><?php }?>
					</select><br /><br />
			<?php if ($_smarty_tpl->tpl_vars['scripts']->value) {?>
					<div class="caption tooltip link_title" style="margin-bottom: 5px;" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=scripts" class="setting_link">Включение скриптов</a></div>
					<div id="div_scripts">
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['scripts']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
						<span style="white-space: nowrap;"><input type="checkbox" id="script-<?php echo $_smarty_tpl->tpl_vars['scripts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="script-<?php echo $_smarty_tpl->tpl_vars['scripts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" onclick="if (this.checked) this.value='1'; else this.value='0';" <?php if ($_smarty_tpl->tpl_vars['scripts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==1) {?>checked="checked" value="1"<?php } else { ?>value="0"<?php }?> /><label class="label_scripts tooltip" title="<?php echo $_smarty_tpl->tpl_vars['scripts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['description'];?>
" for="script-<?php echo $_smarty_tpl->tpl_vars['scripts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['scripts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name']);?>
</label></span>
				<?php endfor; endif; ?>
					</div>
			<?php }?>
					<br />
					<div class="caption link_title tooltip" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=defaults" class="setting_link">Код секции head</a></div>
					<textarea class="input_text code redactor" name="head"><?php echo $_smarty_tpl->tpl_vars['site_page']->value['head'];?>
</textarea>
					<br /><br />
					<div class="caption link_title tooltip" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=defaults" class="setting_link">Код секции body</a></div>
					<textarea class="input_text code redactor" name="body"><?php echo $_smarty_tpl->tpl_vars['site_page']->value['body'];?>
</textarea>
				</td>
			</tr>
			<tr>
				<th class="border_top">
					<input type="hidden" name="form_action" value="save_page" />
					<input type="button" name="save_page" class="button_submit button_long" value="Сохранить и обновить сайт" onclick="submitForm('save_page', <?php echo $_smarty_tpl->tpl_vars['site_page']->value['id'];?>
);" />
				</th>
			</tr>
			<tr>
				<th class="border_top">
					<input type="button" name="select_form" class="button_submit long_button tooltip" value="Добавить форму" onclick="promptSelectDialog('select_form','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" title="Выбор формы из имеющихся<br />и вставка её html-кода и css-правил в секции body и head страницы.<br />После добавления формы страница сохраняется." />
				</th>
			</tr>
			
		</table>
	<?php }?>
	</div> <!-- #pages -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="blocks") {?>
	<div class="content" id="blocks">
		<input type="hidden" name="form_action" id="form_action" />
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());"><?php if ($_smarty_tpl->tpl_vars['is_prototypes']->value=="no") {?>Блоки шаблона «<?php echo $_smarty_tpl->tpl_vars['template_title']->value;?>
» страницы «<?php echo $_smarty_tpl->tpl_vars['page_name']->value;?>
»<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?>Блоки-прототипы<?php } else { ?>&nbsp;<?php }?><?php }?></div>
		<div class="tabs">
			<a class="caption first_tab<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?> active_tab<?php }?>" href="index.php?page=blocks&amp;type=all">Все блоки</a><?php if ($_smarty_tpl->tpl_vars['type']->value!='all'&&$_smarty_tpl->tpl_vars['type']->value!='prototypes') {?><a class="caption active_tab" href="index.php?page=blocks&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['block_title']->value;?>
</a><?php }?><?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='prototypes') {?> active_tab<?php }?>" href="index.php?page=blocks&amp;type=prototypes">Прототипы</a><?php }?><a class="caption" href="index.php?page=blocks&amp;action=create_block"<?php if (!$_smarty_tpl->tpl_vars['is_admin']->value) {?> style="visibility: hidden;"<?php }?> onclick="submitForm('create_block','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');return false;">Новый блок</a>
		</div>
<?php if ($_smarty_tpl->tpl_vars['type']->value=="all"||$_smarty_tpl->tpl_vars['type']->value=="prototypes") {?>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="prototypes") {?>
<script type="text/javascript">
	var isServer = 'server_no';
	function setChecked(isChecked) {
		if (isChecked) {
			isServer = 'server_yes';
			$("input.server_checkboxes").prop("checked", true);
		} else {
			isServer = 'server_no';
			$("input.server_checkboxes").prop("checked", false);
		}
	}
</script>
		<table class="main_table">
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value) {?>
				<th width="5%"><input type="checkbox" id="server-all" name="server-all" onclick="setChecked(this.checked);" /><label class="without_text tooltip" for="server-all" title="Поставить все галочки для сохранения на сервере">&nbsp;</label></th>
				<th width="30%">Название</th>
				<th width="15%">Файл</th>
				<th width="45%">Описание</th>
			<?php } else { ?>
				<th width="30%">Название</th>
				<th width="15%">Файл</th>
				<th width="50%">Описание</th>
			<?php }?>
				<th width="5%">&nbsp;</th>
			</tr>
<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?>
	<?php if ($_smarty_tpl->tpl_vars['blocks']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['blocks']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value) {?>
				<td>
					<input class="server_checkboxes" type="checkbox" id="server-<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="server-<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" onclick="if (this.checked) isServer='server_yes'; else isServer='server_no';" /><label class="without_text tooltip" for="server-<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" title="Дублировать действие над блоком-прототипом на сервере">&nbsp;</label>
				</td>
			<?php }?>
				<td><a class="driver" href="index.php?page=blocks&amp;type=<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a></td>
				<td><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
</td>
				<td><textarea class="input_text" name="desc-<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['description'];?>
</textarea></td>
				<td style="padding: 10px 0px;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
', isServer);" title="Удалить блок-прототип">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
				<th colspan="<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value) {?>5<?php } else { ?>4<?php }?>" class="border_top">
					<input type="button" name="save_descs" class="button_submit" value="Сохранить" onclick="submitForm('save_descs','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" /></th>
			</tr>
	<?php } else { ?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value) {?>5<?php } else { ?>4<?php }?>" class="no_rows">Блоков-прототипов нет</td>
			</tr>
	<?php }?>
<?php } else { ?>
			<tr>
				<td colspan="4" class="no_rows">Блоки недоступны для просмотра</td>
			</tr>
<?php }?>
		</table>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>
		<table class="main_table">
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
				<th width="25%">Страница</th>
				<th width="25%">Название</th>
				<th width="25%">Файл</th>
			<?php } else { ?>
				<th width="35%">Страница</th>
				<th width="40%">Название</th>
			<?php }?>
				<th width="10%">Порядок</th>
				<th width="10%">Видимость</th>
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['blocks']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['blocks']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>		
			<tr>
				<td><a class="driver" href="index.php?page=pages&amp;type=<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['page_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['page_name'];?>
</a></td>
				<td><a class="driver" href="index.php?page=blocks&amp;type=<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a></td>
				<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?><td><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
</td><?php }?>
				<td style="padding: 0px 10px;"><table class="table_arrows"><tr><td><input type="text" class="input_text short_input" id="sort-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>" name="sort-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['sort'];?>
" /></td><td style="padding-top: 25px;"><a class="icon_arrows" href="javascript:change_sort('sort-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>','-');">&nbsp;ˆ&nbsp;</a><br /><a class="icon_arrows" href="javascript:change_sort('sort-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>','+');">&nbsp;ˇ&nbsp;</a></td></tr></table></td>
				<td><input type="checkbox" id="status-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>" name="status-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>" <?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==1) {?>checked="checked"<?php }?>/><label class="without_text" for="status-<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php }?>">&nbsp;</label></td>
				<td style="padding: 10px 0px;"><a class="icon_edit tooltip" <?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?>href="index.php?page=blocks&amp;type=all&amp;action=double_mirror&amp;id=<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
"<?php } else { ?>href="javascript:submitForm('double_block','<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
');"<?php }?> title="Дублировать блок">&nbsp;D&nbsp;</a><a class="icon_delete tooltip" href="javascript:confirmDialog('delete',<?php if ($_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror']==1) {?>'<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mirror_id'];?>
','mirror'<?php } else { ?>'<?php echo $_smarty_tpl->tpl_vars['blocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
'<?php }?>);" title="Удалить блок">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php endfor; endif; ?>		
			<tr>
				<th colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>6<?php } else { ?>5<?php }?>" class="border_top">
					<input type="button" name="save_sorts" class="button_submit" value="Сохранить и обновить сайт" onclick="submitForm('save_sorts','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" /></th>
			</tr>
		<?php } else { ?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>6<?php } else { ?>5<?php }?>" class="no_rows">Блоков нет</td>
			</tr>
		<?php }?>
		</table>
	<?php }?>
<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
	<script type="text/javascript" src="scripts/ZeroClipboard.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var client = new ZeroClipboard($(".copy_images"));
		});
	</script>
	<?php }?>
		<table class="main_table">
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
				<th width="25%">Название</th>
				<th width="20%">Переменная</th>
			<?php } else { ?>
				<th width="45%">Название</th>
			<?php }?>
				<th width="50%">Содержимое</th>
				<th width="5%"></th>
			</tr>
<?php if ($_smarty_tpl->tpl_vars['block_title']->value!='') {?>
<?php if ($_smarty_tpl->tpl_vars['is_prototypes']->value=="no"||($_smarty_tpl->tpl_vars['is_prototypes']->value=="yes"&&$_smarty_tpl->tpl_vars['is_superadmin']->value)) {?>
		<?php if ($_smarty_tpl->tpl_vars['strings']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['strings']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
				<td><input type="text" class="input_text" name="title-<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
" /></td>
				<td><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="&#123;$string-<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
&#125;" />&#123;<span class="copy_name">$string-<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
</span>&#125;</td>
			<?php } else { ?>
				<td><?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</td>
			<?php }?>
				<td><textarea class="input_text<?php if ($_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['is_image']) {?> short_width<?php }?>" name="content-<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['content'];?>
</textarea><?php if ($_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['is_image']) {?><table class="table_image"><tr><td><a class="fancybox" rel="group" href="<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['content'];?>
"><img class="image_strings" src="<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['content'];?>
" alt="Фото" /></a></td></tr></table><?php }?></td>
				<td style="padding: 0;"><form action="index.php?page=blocks&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=load_image&amp;id=<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" method="post" class="upload_form" enctype="multipart/form-data"><img class="get_picture" src="styles/load_picture01.png" /><input type="file" name="uploadfile" class="upload_file tooltip" onchange="sitesMan.onImageUpload(event,this);return false;" accept="image/*" title="Загрузить изображение со своего компьютера" /></form>
				<a class="tooltip" href="javascript:promptSelectDialog('select_image','<?php echo $_smarty_tpl->tpl_vars['strings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Выбрать изображение из списка имеющихся файлов"><img class="get_picture" src="styles/open_picture01.png" /></a></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>4<?php } else { ?>3<?php }?>" class="no_rows">Текстовых фрагментов нет</td>
			</tr>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>
			<tr>
				<th colspan="4" class="border_top">
					<input type="button" name="add_string" class="button_submit" value="Добавить строковую константу" onclick="submitForm('add_string','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" /></th>
			</tr>
			<tr>
				<th colspan="4" class="border_top">HTML-код блока</th>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left;">
					<a onclick="$('#variables_block').slideToggle('quick');" href="javascript:void(0);"><span class="caption styles_title tooltip" title="Показать/скрыть блок переменных страницы">Переменные страницы</span></a>
					<div id="variables_block" style="display: none;">
						<table class="small_table styles_table" style="width: 100%;">
					<?php if ($_smarty_tpl->tpl_vars['variables']->value) {?>
						<?php  $_smarty_tpl->tpl_vars['variable'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['variable']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variables']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['variable']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['variable']->key => $_smarty_tpl->tpl_vars['variable']->value) {
$_smarty_tpl->tpl_vars['variable']->_loop = true;
 $_smarty_tpl->tpl_vars['variable']->iteration++;
?>
							<?php if (($_smarty_tpl->tpl_vars['variable']->iteration==1)||(!(($_smarty_tpl->tpl_vars['variable']->iteration-1) % 2))) {?>
							<tr>
							<?php }?>
								<td style="width: 50%; text-align: left; padding-right: 10px;">
									<img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="$<?php echo $_smarty_tpl->tpl_vars['variable']->value['name'];?>
" />
									<span class="copy_name">$<?php echo $_smarty_tpl->tpl_vars['variable']->value['name'];?>
</span>
									<br />
									<textarea class="input_text" style="margin-top: 5px; width: 480px !important;" name="variable-<?php echo $_smarty_tpl->tpl_vars['variable']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['variable']->value['value'];?>
</textarea></td>
							<?php if (!($_smarty_tpl->tpl_vars['variable']->iteration % 2)) {?>
							</tr>
							<?php }?>
						<?php } ?>
					<?php } else { ?>
							<tr><td class="no_rows" style="text-align: center;">Переменных нет</td></tr>
					<?php }?>
						</table>
						<div class="styles_actions" style="margin: 10px 0;">
							<a href="javascript:addVariable();" class="tooltip" title="Добавить переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить переменную" /></a>
							<a href="javascript:saveVariables();" class="tooltip" title="Сохранить значения переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения переменных" /></a>
							<a href="javascript:deleteVariable();" class="tooltip" title="Удалить переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить переменную" /></a>						
						</div>
					</div>
					<textarea class="input_text code redactor" name="block_code"><?php echo $_smarty_tpl->tpl_vars['block_code']->value;?>
</textarea></td>
			</tr>
			<tr>
				<th colspan="4" class="border_top">CSS-правила блока</th>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left;">
					<a onclick="$('#styles_block').slideToggle('quick');" href="javascript:void(0);"><span class="caption styles_title tooltip" title="Показать/скрыть блок css-переменных">CSS-переменные</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:createStyles();"><span class="caption styles_title tooltip" title="Настроить параметры текста, заголовков и ссылок">Настройки текста</span></a>
					<div id="styles_block" style="display: none;">
						<table class="small_table styles_table"<?php if (!$_smarty_tpl->tpl_vars['styles']->value) {?> style="width: 100%;"<?php }?>>
						<?php if ($_smarty_tpl->tpl_vars['styles']->value) {?>
						<?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['style']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['styles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['style']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value) {
$_smarty_tpl->tpl_vars['style']->_loop = true;
 $_smarty_tpl->tpl_vars['style']->iteration++;
?>
							<?php if (($_smarty_tpl->tpl_vars['style']->iteration==1)||(!(($_smarty_tpl->tpl_vars['style']->iteration-1) % 3))) {?>
							<tr>
							<?php }?>
								<td><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="$<?php echo $_smarty_tpl->tpl_vars['style']->value['name'];?>
" /><span class="copy_name">$<?php echo $_smarty_tpl->tpl_vars['style']->value['name'];?>
</span></td><td>= <input type="text" class="input_text" name="style-<?php echo $_smarty_tpl->tpl_vars['style']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['style']->value['value'];?>
" />&nbsp;</td><td>&nbsp;&nbsp;</td>
							<?php if (!($_smarty_tpl->tpl_vars['style']->iteration % 3)) {?>
							</tr>
							<?php }?>
						<?php } ?>
						<?php } else { ?>
							<tr><td class="no_rows" style="text-align: center;">CSS-переменных нет</td></tr>
						<?php }?>
						</table>
					<?php if ($_smarty_tpl->tpl_vars['is_prototypes']->value=="no") {?>
						<div class="styles_actions">
							<a href="javascript:addStyle();" class="tooltip" title="Добавить css-переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить css-переменную" /></a>
							<a href="javascript:saveStyles();" class="tooltip" title="Сохранить значения css-переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения css-переменных" /></a>
							<a href="javascript:deleteStyle();" class="tooltip" title="Удалить css-переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить css-переменную" /></a>
						</div>
					<?php }?>
					</div>
					<ul id="css_nav"><?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?><li><a class="caption tooltip" href="#css-tab-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['layout']->value['hint'];?>
"><?php echo $_smarty_tpl->tpl_vars['layout']->value['caption'];?>
</a></li><?php } ?></ul>
					<div id="css_tabs">
					<?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
						<p id="css-tab-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
"><textarea class="input_text code" name="css_code-<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['layout']->value['block_csstext'];?>
</textarea></p>
					<?php } ?>
					</div>
				</td>
			</tr>
			<?php if ($_smarty_tpl->tpl_vars['page_scrollable']->value) {?>
			<tr>
				<th colspan="4" class="border_top">
					SEO-параметры блока</th>
			</tr>
			<tr>
				<td colspan="4">
					<table width="100%">
						<tr>
							<td style="border-top: none; padding: 0 0 0 10px;" colspan="2">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Заголовок:&nbsp;&nbsp;<input type="text" class="input_text" name="meta_title" value="<?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
" style="width: 90%;" /></div></td>
						</tr>
						<tr>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Описание</div>
								<textarea class="input_text" name="meta_description" style="height: 100px;"><?php echo $_smarty_tpl->tpl_vars['meta_description']->value;?>
</textarea></td>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Ключевые слова</div>
								<textarea class="input_text" name="meta_keywords" style="height: 100px;"><?php echo $_smarty_tpl->tpl_vars['meta_keywords']->value;?>
</textarea></td>
						</tr>
					</table>
				</td>
			</tr>
			<?php }?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value&&$_smarty_tpl->tpl_vars['is_prototypes']->value=="yes") {?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>4<?php } else { ?>3<?php }?>" class="border_top">
					<input type="checkbox" id="save_to_server" name="save_to_server" onclick="$('#server_block').slideToggle('quick'); if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="save_to_server">Сохранить данные блока-прототипа на сервере</label>
					<div id="server_block" style="display: none; padding-top: 10px; text-align: center;">
<script type="text/javascript">
	$(document).ready(function() {
		var col, el;
		$("input.server_radio").click(function() {
		   el = $(this);
		   col = el.data("col");
		   $("input[data-col=" + col + "]").prop("checked", false);
		   el.prop("checked", true);
		});
	});
</script>
					Укажите для каждого css медиа-запроса на клиентском сайте, в какой css медиа-запрос на сервере его сохранить:<br /><br />
					<table class="server_table">
					<?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['layout']->value['title'];?>
</td>
							<td>
							<input type="radio" class="server_radio" id="layout_server_<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
_none" name="layout_client_<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
" value="layout_server_none" checked="checked" /><label for="layout_server_<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
_none" style="margin-bottom: 5px;">Нет</label><br />
							<?php  $_smarty_tpl->tpl_vars['layout_server'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout_server']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts_server']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['layout_server']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['layout_server']->key => $_smarty_tpl->tpl_vars['layout_server']->value) {
$_smarty_tpl->tpl_vars['layout_server']->_loop = true;
 $_smarty_tpl->tpl_vars['layout_server']->iteration++;
?>
							<input type="radio" class="server_radio" id="layout_server_<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['layout_server']->value['id'];?>
" name="layout_client_<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
" value="layout_server_<?php echo $_smarty_tpl->tpl_vars['layout_server']->value['id'];?>
" data-col="<?php echo $_smarty_tpl->tpl_vars['layout_server']->iteration;?>
" /><label for="layout_server_<?php echo $_smarty_tpl->tpl_vars['layout']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['layout_server']->value['id'];?>
" style="margin-bottom: 5px;"><?php echo $_smarty_tpl->tpl_vars['layout_server']->value['title'];?>
</label><br /><?php } ?></td>
						</tr>
					<?php } ?>
					</table>
					</div>
				</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>4<?php } else { ?>3<?php }?>" class="border_top">
					<input type="button" name="save_block" class="button_submit" value="Сохранить<?php if ($_smarty_tpl->tpl_vars['is_prototypes']->value=='no') {?> и обновить сайт<?php }?>" onclick="submitForm('save_block','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" /></th>
			</tr>
			<tr>
				<th colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>4<?php } else { ?>3<?php }?>" class="border_top">
					<input type="button" class="button_submit long_button tooltip" value="Переименовать блок" title="Переименование названия блока<br />и/или имени его файла.<br />Если нужно переименовать только одно из названий, второе впишите прежним" onclick="submitForm('rename_block','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['block_file']->value;?>
');" /><?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="parse_block" class="button_submit long_button tooltip" value="Разобрать блок" onclick="submitForm('parse_block','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" title="Выбор из кода блока текстовых строк и путей к изображениям. Текстовое содержимое любого элемента, имеющего класс string, будет заменено созданной для него строковой константой" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="select_form" class="button_submit long_button tooltip" value="Добавить форму" onclick="promptSelectDialog('select_form','<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');" title="Выбор формы из имеющихся<br />и вставка её html-кода и css-правил в блок.<br />После добавления формы блок сохраняется." /><?php }?></th>
			</tr>
<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['is_prototypes']->value=="yes"&&!$_smarty_tpl->tpl_vars['is_superadmin']->value) {?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>4<?php } else { ?>3<?php }?>" class="no_rows">Блок недоступен для просмотра</td>
			</tr>
	<?php }?>
<?php }?>
<?php } else { ?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>4<?php } else { ?>3<?php }?>" class="no_rows">Блок не найден</td>
			</tr>
<?php }?>
		</table>
<?php }?>
	</div> <!-- #blocks -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="forms") {?>
<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" name="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_form">
	<div class="content" id="forms">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Формы обратной связи</div>
		<div class="tabs">
			<a class="caption first_tab<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?> active_tab<?php }?>" href="index.php?page=forms&amp;type=all">Все формы</a><?php if ($_smarty_tpl->tpl_vars['type']->value!='all') {?><a class="caption active_tab" href="index.php?page=forms&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['form']->value['caption'];?>
</a><?php }?><a class="caption" href="index.php?page=forms&amp;type=new" onclick="createForm();return false;"<?php if (!$_smarty_tpl->tpl_vars['is_admin']->value) {?> style="visibility: hidden;"<?php }?>>Новая форма</a>
		</div>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?>
		<table class="main_table">
			<tr>
				<th width="5%">№</th>				
				<th width="50%">Название</th>				
				<th width="20%">Модальность</th>
				<th width="20%">Видимость</th>
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['forms']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['forms']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
</td>
				<td><a class="driver" href="index.php?page=forms&amp;type=<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a></td>
				<td><input type="checkbox" id="checkbox-modal-<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['modal']==1) {?> checked="checked"<?php }?> onclick="window.location='index.php?page=forms&amp;type=all&amp;action=change_modal&amp;id=<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
';" /><label class="without_text" for="checkbox-modal-<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
				<td><input type="checkbox" id="checkbox-visible-<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==1) {?> checked="checked"<?php }?> onclick="window.location='index.php?page=forms&amp;type=all&amp;action=change_status&amp;id=<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
';" /><label class="without_text" for="checkbox-visible-<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;</label></td>
				<td style="padding: 10px 0px;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','<?php echo $_smarty_tpl->tpl_vars['forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Удалить форму">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="5" class="no_rows">Форм нет</td>
			</tr>
		<?php }?>
		</table>
	<?php } else { ?>
		<table class="main_table">
			<tr>
				<th width="30%">Название формы</th>
				<th width="70%">Ссылка для открытия формы</th>
			</tr>
			<tr>
				<td><input type="text" class="input_text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
" /></td>
				<td><input type="text" class="input_text" name="link"  value="<?php echo $_smarty_tpl->tpl_vars['form']->value['link'];?>
" /></td>
			</tr>
			<tr>
				<th colspan="2" class="border_top">HTML-код формы</th>
			</tr>
			<tr>
				<td colspan="2"><textarea class="input_text code redactor" name="html"><?php echo $_smarty_tpl->tpl_vars['form']->value['html'];?>
</textarea></td>
			</tr>
			<tr>
				<th colspan="2" class="border_top">CSS-правила формы</th>
			</tr>
			<tr>
				<td colspan="2"><textarea class="input_text code" name="css"><?php echo $_smarty_tpl->tpl_vars['form']->value['css'];?>
</textarea></td>
			</tr>
			<tr>
				<th colspan="2" class="border_top"><input type="submit" name="save_form" class="button_submit" value="Сохранить" /></th>
			</tr>
		</table>
	<?php }?>
	</div> <!-- #forms -->
</form>
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="images") {?>
	<div class="content" id="images">
	<?php if ($_smarty_tpl->tpl_vars['type']->value!="all") {?>
		<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" name="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_form">
	<?php }?>
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Графика шаблона «<?php echo $_smarty_tpl->tpl_vars['template_title']->value;?>
»</div>
		<div class="tabs">
			<a class="caption width109 tab_first<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?> active_tab<?php }?>" href="index.php?page=images&amp;type=all">Все файлы</a><a class="caption width109<?php if ($_smarty_tpl->tpl_vars['type']->value=="files") {?> active_tab<?php }?>" href="index.php?page=images&amp;type=files">files</a><a class="caption width109<?php if ($_smarty_tpl->tpl_vars['type']->value=="images") {?> active_tab<?php }?>" href="index.php?page=images&amp;type=images">images</a><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['catalogs']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?><?php if ($_smarty_tpl->tpl_vars['catalogs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name']!='images') {?><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->tpl_vars['catalogs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name']) {?> active_tab<?php }?>" href="index.php?page=images&amp;type=<?php echo $_smarty_tpl->tpl_vars['catalogs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['catalogs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a><?php }?><?php endfor; endif; ?><a class="caption width109"  href="index.php?page=images&amp;action=create_folder" onclick="promptFolderDialog('create_folder');return false;">Новая папка</a>
		</div>
		<table class="main_table"<?php if ($_smarty_tpl->tpl_vars['type']->value!="all") {?> id="first_table"<?php }?>>
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>
				<th width="15%">Папка</th>
				<th width="20%">Название</th>
			<?php } else { ?>
				<th width="35%">Название</th>
			<?php }?>
				<th width="50%">Изображение</th>
				<th width="10%">Дата изменения</th>
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['images']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['images']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>
				<td><a class="driver" href="index.php?page=images&amp;type=<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['folder'];?>
"><?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['folder'];?>
</a></td>
				<td><?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
</td>
			<?php } else { ?>
				<td><input type="text" class="input_text tooltip" name="image-<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
" title="Для сохранения переименованного названия нажмите кнопку «Сохранить»" /></td>
			<?php }?>
				<td><a class="fancybox" rel="group" href="<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
"><img <?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>class="small" <?php }?>src="<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
" alt="Изображение" /></a></td>
				<td><?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['time'];?>
</td>
				<td style="padding: 10px 3px;"><?php if ($_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['folder']!="files") {?><a class="icon_edit tooltip" style="font-size: 18px;" href="javascript:promptFileDialog('move_file','<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
','<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['folder'];?>
');" title="Переместить файл<br />в другую папку">&nbsp;&#8658;&nbsp;</a><?php }?><a class="icon_delete tooltip" href="javascript:confirmFileDialog('delete_file','<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
','<?php echo $_smarty_tpl->tpl_vars['images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['folder'];?>
');" title="Удалить файл">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?>5<?php } else { ?>4<?php }?>" class="no_rows">Файлов нет</td>
			</tr>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['type']->value!="all") {?>
			<tr>
				<th colspan="<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?>5<?php } else { ?>4<?php }?>" class="border_top"><input type="submit" name="save_names" class="button_submit" value="Сохранить" /></th>
			</tr>
		</table>
		</form>
		<table class="main_table" id="second_table">
			<tr>
				<th><form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" class="upload_form button_submit" enctype="multipart/form-data"><div id="icon_load_photo">Загрузить файл</div><input type="file" name="uploadfile" class="upload_file long_button" onchange="sitesMan.<?php if ($_smarty_tpl->tpl_vars['type']->value=='files') {?>onFileUpload<?php } else { ?>onImageUpload<?php }?>(event, this); return false;" accept="<?php if ($_smarty_tpl->tpl_vars['type']->value!='files') {?>image/<?php }?>*" /></form></th>
			</tr>
			<?php if ($_smarty_tpl->tpl_vars['type']->value!="images"&&$_smarty_tpl->tpl_vars['type']->value!="files") {?>
			<tr>
				<th class="border_top"><input type="button" class="button_submit long_button" value="Переименовать папку" onclick="promptFolderDialog('rename_folder');" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button_submit long_button" value="Удалить папку" onclick="confirmDialog('delete_folder');" /></th>
			</tr>
			<?php }?>
		</table>
		<?php } else { ?>
		</table>
		<?php }?>
	</div> <!-- #images -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="visitors") {?>
<form action="index.php?page=visitors&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" id="visitors_form" name="visitors_form">
	<div class="content" id="visitors">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Посетители сайта</div>
		<div class="tabs">
			<a class="caption tab_first<?php if ($_smarty_tpl->tpl_vars['type']->value=='stat') {?> active_tab<?php }?>" href="index.php?page=visitors&amp;type=stat">Статистика</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='refer') {?> active_tab<?php }?>" href="index.php?page=visitors&amp;type=refer">Реферреры</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='list') {?> active_tab<?php }?>" href="index.php?page=visitors&amp;type=list">Список</a>
		</div>
		<div id="online_count">Посетителей на сайте: <?php echo $_smarty_tpl->tpl_vars['visitors_online']->value;?>
</div>
		<table class="main_table">
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="stat") {?>
			<tr>
				<th>Статистика посещений по дням</th>
			</tr>
			<tr>
				<td style="text-align: center;">
				<?php if ($_smarty_tpl->tpl_vars['line1']->value) {?><div id="chart1"></div>
					<div id="customTooltipDays">&nbsp;</div>
					<br /><?php echo $_smarty_tpl->tpl_vars['link_backwards']->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['link_center']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['link_forwards']->value;?>
<br />
				<?php } else { ?>
					<span style="font-style: italic;">Посещений нет</span>
				<?php }?>
					
<script type="text/javascript">
$(document).ready(function(){
	var line1 = [<?php echo $_smarty_tpl->tpl_vars['line1']->value;?>
];
	var line2 = [<?php echo $_smarty_tpl->tpl_vars['line2']->value;?>
];
	var plot1 = $.jqplot('chart1', [line1], {
		animate: false,
		axes: {
			xaxis: {
				min: '<?php echo $_smarty_tpl->tpl_vars['date_first']->value;?>
',
				max: '<?php echo $_smarty_tpl->tpl_vars['date_last']->value;?>
',
				renderer: $.jqplot.DateAxisRenderer,
				tickOptions: {formatString: '%d.%m'},
				tickInterval: '2 day',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			},
			yaxis: {
				min: 0,
				max: <?php echo $_smarty_tpl->tpl_vars['max_days']->value;?>
,
				tickOptions: {formatString:'%d'},
				label: 'Сеансы',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series: [{
			fill: true,
			rendererOptions: {smooth: true}
		}],
		seriesColors: ['#4B73BA'],
		seriesDefaults: {
			showMarker: false,
			pointLabels: { show: true }
		},
		highlighter: {
			show: true,
			showTooltip: false
		},
		cursor: {
			show: false
		},
		grid: {
			drawGridLines: true,
			gridLineColor: '#FFE4C4',
			background: '#FFFFFF',
			borderColor: '#FFE4C4',
			borderWidth: 1.0,
			shadow: true,
			shadowAngle: 55,
			shadowOffset: 3,
			shadowWidth: 2,
			shadowDepth: 2,
			shadowAlpha: 0.08,
			renderer: $.jqplot.CanvasGridRenderer,
			rendererOptions: {}
		}
	});
	
	var plot2 = $.jqplot('chart2', [line2], {
		animate: false,
		axes: {
			xaxis: {
				renderer: $.jqplot.DateAxisRenderer,
				tickOptions: {formatString: '%m.%Y'},
				tickInterval: '2 month',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			},
			yaxis: {
				min: 0,
				max: <?php echo $_smarty_tpl->tpl_vars['max_months']->value;?>
,
				tickOptions: {formatString:'%d'},
				label: 'Сеансы',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series: [{
			fill: true,
			rendererOptions: {smooth: true}
		}],
		seriesColors: ['#4B73BA'],
		seriesDefaults: {
			showMarker: false,
			pointLabels: { show: true }
		},
		highlighter: {
			show: true,
			showTooltip: false
		},
		cursor: {
			show: false
		},
		grid: {
			drawGridLines: true,
			gridLineColor: '#FFE4C4',
			background: '#FFFFFF',
			borderColor: '#FFE4C4',
			borderWidth: 1.0,
			shadow: true,
			shadowAngle: 55,
			shadowOffset: 3,
			shadowWidth: 2,
			shadowDepth: 2,
			shadowAlpha: 0.08,
			renderer: $.jqplot.CanvasGridRenderer,
			rendererOptions: {}
		}
	});
  
    $('#chart1').bind('jqplotHighlighterHighlight', 
        function (ev, seriesIndex, pointIndex, data, plot) {
			var dt = new Date(parseInt(data[0]));
			var optDate = {year: "numeric", month: "2-digit", day: "2-digit"};
			var content = "Дата: " + dt.toLocaleDateString("ru-RU", optDate) + "<br>Сеансов: " + data[1];
            var elem = $('#customTooltipDays');
            elem.html(content);
            var h = elem.outerHeight();
            var w = elem.outerWidth();
            var left = ev.pageX - 60;
            var top = ev.pageY + 12;
            elem.stop(true, true).css({left:left, top:top}).fadeIn(200);
        }
    );
    
    $('#chart1').bind('jqplotHighlighterUnhighlight', 
        function (ev) {
            $('#customTooltipDays').fadeOut(300);
        }
    );
	
	$('#chart2').bind('jqplotHighlighterHighlight', 
        function (ev, seriesIndex, pointIndex, data, plot) {
			var dt = new Date(parseInt(data[0]));
			var year  = dt.toLocaleDateString("ru-RU", {year: "numeric"});
			var monthNumber = dt.toLocaleDateString("ru-RU", {month: "numeric"});
			var monthText = "";
			switch (monthNumber) {
				case "1":  monthText = "январь"; break;
				case "2":  monthText = "февраль"; break;
				case "3":  monthText = "март"; break;
				case "4":  monthText = "апрель"; break;
				case "5":  monthText = "май"; break;
				case "6":  monthText = "июнь"; break;
				case "7":  monthText = "июль"; break;
				case "8":  monthText = "август"; break;
				case "9":  monthText = "сентябрь"; break;
				case "10": monthText = "октябрь"; break;
				case "11": monthText = "ноябрь"; break;
				case "12": monthText = "декабрь"; break;
			}
			var content = "Месяц: " + monthText + " " + year + "<br>Сеансов: " + data[1];
            var elem = $('#customTooltipMonths');
            elem.html(content);
            var h = elem.outerHeight();
            var w = elem.outerWidth();
            var left = ev.pageX - 60;
            var top = ev.pageY + 12;
            elem.stop(true, true).css({left:left, top:top}).fadeIn(200);
        }
    );
    
    $('#chart2').bind('jqplotHighlighterUnhighlight', 
        function (ev) {
            $('#customTooltipMonths').fadeOut(300);
        }
    );
});
</script>
				</td>
			</tr>
			<tr>
				<th class="border_top">Статистика посещений по месяцам</th>
			</tr>
			<tr>
				<td style="text-align: center;">
				<?php if ($_smarty_tpl->tpl_vars['line2']->value) {?>
					<div id="chart2"></div>
					<div id="customTooltipMonths">&nbsp;</div>
				<?php } else { ?>
					<span style="font-style: italic;">Посещений нет</span>
				<?php }?>
				</td>
			</tr>
			<tr>
				<th class="border_top">&nbsp;</th>
			</tr>
			<tr>
				<td class="border_top">
					<input type="checkbox" id="show_yandex" name="show_yandex"<?php if ($_smarty_tpl->tpl_vars['show_yandex']->value) {?> checked="checked"<?php }?> onclick="var value='no'; if (this.checked) value='yes'; window.location='index.php?page=visitors&amp;type=stat&amp;action=show_yandex&amp;value='+value;" /><label for="show_yandex" style="margin-top: 10px;">Отображать посещения робота Яндекса (<?php echo $_smarty_tpl->tpl_vars['count_yandex']->value;?>
 посещений за <?php echo $_smarty_tpl->tpl_vars['link_center']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['count_total_yandex']->value;?>
 всего)</label><br />
					<input type="checkbox" id="show_google" name="show_google"<?php if ($_smarty_tpl->tpl_vars['show_google']->value) {?> checked="checked"<?php }?> onclick="var value='no'; if (this.checked) value='yes'; window.location='index.php?page=visitors&amp;type=stat&amp;action=show_google&amp;value='+value;" /><label for="show_google" style="margin-top: 10px;">Отображать посещения робота Гугла (<?php echo $_smarty_tpl->tpl_vars['count_google']->value;?>
 посещений за <?php echo $_smarty_tpl->tpl_vars['link_center']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['count_total_google']->value;?>
 всего)</label>
					<input type="checkbox" id="show_bots" name="show_bots"<?php if ($_smarty_tpl->tpl_vars['show_bots']->value) {?> checked="checked"<?php }?> onclick="var value='no'; if (this.checked) value='yes'; window.location='index.php?page=visitors&amp;type=stat&amp;action=show_bots&amp;value='+value;" /><label for="show_bots" style="margin-top: 10px;">Отображать посещения остальных роботов (<?php echo $_smarty_tpl->tpl_vars['count_bots']->value;?>
 посещений за <?php echo $_smarty_tpl->tpl_vars['link_center']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['count_total_bots']->value;?>
 всего)</label></td>
			</tr>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="refer") {?>
			<tr>
				<th width="25%">&nbsp;</th>
				<th width="25%">Название сайта-реферрера</th>
				<th width="25%">Количество переходов с него</th>
				<th width="25%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['referrers']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['paginator']->value) {?>
			<tr>
				<th colspan="4" class="border_top"><?php echo $_smarty_tpl->tpl_vars['paginator']->value;?>
</th>
			</tr>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['j'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['referrers']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total']);
?>
			<tr>
				<td>&nbsp;</td>
				<td><?php echo $_smarty_tpl->tpl_vars['referrers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['url'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['referrers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['count'];?>
</td>
				<td>&nbsp;</td>
			</tr>
			<?php endfor; endif; ?>
			<?php if ($_smarty_tpl->tpl_vars['paginator']->value) {?>
			<tr>
				<th colspan="4" class="border_top"><?php echo $_smarty_tpl->tpl_vars['paginator']->value;?>
</th>
			</tr>
			<?php }?>
		<?php } else { ?>
			<tr>
				<td colspan="4" class="no_rows">Сайтов-реферреров нет</td>
			</tr>
		<?php }?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['type']->value=="list") {?>
			<tr>
				<th width="5%">Дата</th>
				<th width="15%">Город</th>
				<th width="15%">Примечание</th>
				<th width="15%">Запрос</th>
				<th width="25%">Ссылающаяся страница</th>
				<th width="25%">Идентификатор браузера</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['visitors']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['paginator']->value) {?>
			<tr>
				<th colspan="6" class="border_top"><?php echo $_smarty_tpl->tpl_vars['paginator']->value;?>
</th>
			</tr>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['visitors']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr<?php if ($_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['online']) {?> style="font-weight: bold;"<?php }?>>
				<td class="break_word"><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['date'];?>
</td>
				<td class="break_word"><a class="driver tooltip" title="<?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['ip_address'];?>
" href="http://speed-tester.info/ip_location.php?ip=<?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['ip_address'];?>
" onclick="this.target='_blank';"><?php if (strpos($_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['city'],"<")===false) {?><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['city'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['ip_address'];?>
<?php }?></a></td>
				<td class="break_word"><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['note'];?>
</td>
				<td class="break_all" style="font-size: 12px;"><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['request'];?>
</td>
				<td class="break_all" style="font-size: 12px;"><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['referrer'];?>
</td>
				<td class="break_all" style="font-size: 12px;"><?php echo $_smarty_tpl->tpl_vars['visitors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['user_agent'];?>
</td>
			</tr>
			<?php endfor; endif; ?>
			<?php if ($_smarty_tpl->tpl_vars['paginator']->value) {?>
			<tr>
				<th colspan="6" class="border_top"><?php echo $_smarty_tpl->tpl_vars['paginator']->value;?>
</th>
			</tr>
			<?php }?>
		<?php } else { ?>
			<tr>
				<td colspan="6" class="no_rows">Посетителей нет</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="6" class="border_top"><input type="button" name="clear_list" class="button_submit" onclick="confirmDialog('clear_list');" value="Очистить список" /></th>
			</tr>
			<tr>
				<td colspan="6">
					<input type="checkbox" id="enable_visitors_db" name="enable_visitors_db"<?php if ($_smarty_tpl->tpl_vars['enable_visitors_db']->value) {?> checked="checked"<?php }?> /><label class="tooltip" for="enable_visitors_db" title="<?php echo $_smarty_tpl->tpl_vars['enable_visitors_hint']->value;?>
" style="margin: 5px 0;"><?php echo $_smarty_tpl->tpl_vars['enable_visitors_title']->value;?>
</label><br />
					<?php echo $_smarty_tpl->tpl_vars['visitors_per_page_title']->value;?>
 <select name="visitors_per_page" class="input_text tooltip" title="<?php echo $_smarty_tpl->tpl_vars['visitors_per_page_hint']->value;?>
" style="width: 70px;">
						<option<?php if ($_smarty_tpl->tpl_vars['visitors_per_page']->value==20) {?> selected="selected"<?php }?> value="20">20</option>
						<option<?php if ($_smarty_tpl->tpl_vars['visitors_per_page']->value==50) {?> selected="selected"<?php }?> value="50">50</option>
						<option<?php if ($_smarty_tpl->tpl_vars['visitors_per_page']->value==100) {?> selected="selected"<?php }?> value="100">100</option>
						<option<?php if ($_smarty_tpl->tpl_vars['visitors_per_page']->value==200) {?> selected="selected"<?php }?> value="200">200</option>
						<option<?php if ($_smarty_tpl->tpl_vars['visitors_per_page']->value==500) {?> selected="selected"<?php }?> value="500">500</option>
					</select><br />
					<?php echo $_smarty_tpl->tpl_vars['minutes_visitor_title']->value;?>
 <input type="text" class="input_text short_input tooltip" id="minutes_visitor_online" name="minutes_visitor_online" value="<?php echo $_smarty_tpl->tpl_vars['minutes_visitor_online']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['minutes_visitor_hint']->value;?>
" style="margin-bottom: 5px;" />
					</td>
			</tr>
			<tr>
				<th colspan="6" class="border_top"><input type="submit" name="submit_save_settings" class="button_submit" value="Сохранить настройки" /></th>
			</tr>
	<?php }?>
		</table>
	</div> <!-- #visitors -->
</form>
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="orders") {?>
	<div class="content" id="orders">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Список заявок</div>
		<div class="tabs">
			<a class="caption tab_first<?php if ($_smarty_tpl->tpl_vars['type']->value=='new') {?> active_tab<?php }?>" href="index.php?page=orders&amp;type=new">Новые</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='old') {?> active_tab<?php }?>" href="index.php?page=orders&amp;type=old">Архив</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='all') {?> active_tab<?php }?>" href="index.php?page=orders&amp;type=all">Все заявки</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='errors') {?> active_tab<?php }?>" href="index.php?page=orders&amp;type=errors">Журнал</a>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['type']->value!="errors") {?><div id="orders_count">Всего заявок: <?php echo count($_smarty_tpl->tpl_vars['orders']->value);?>
</div><?php }?>
		<table class="main_table">
	<?php if ($_smarty_tpl->tpl_vars['type']->value!="errors") {?>
			<tr>
				<th width="10%">Дата</th>
				<th width="15%">Форма</th>
				<th width="15%">Откуда</th>
				<th width="15%">Куда</th>
				<th width="15%">Телефон</th>
				<th width="25%">Дата, время</th>
				<!--th width="10%">Файл</th-->
				<th width="5%">&nbsp;</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
			<?php $_smarty_tpl->tpl_vars["number"] = new Smarty_variable(1, null, 0);?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['orders']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr style="font-weight: <?php if ($_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==0) {?>bold<?php } else { ?>normal<?php }?>;">          
				<td><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['date'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['form'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['email'];?>
</td>
				<td style="padding: 10px 0 !important;"><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['phone'];?>
</td>
				<td><?php if ($_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['is_message_long']) {?>
					<?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['message_short'];?>
 <a class="fancybox driver" href="#inline<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
">Далее</a>
					<div id="inline<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" style="display: none; width: 400px; text-align: center;">
						<p><b>Сообщение</b></p>
						<p><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['message'];?>
</p>
					</div>
				  <?php } else { ?>
					<?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['message'];?>

				  <?php }?></td>
				<!--td><a class="fancybox driver" href="/files/<?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
"><?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
</a></td-->
				<td style="padding: 10px 0px;"><?php if ($_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['status']==0) {?><a class="icon_edit tooltip" style="font-size: 18px;" href="javascript:confirmDialog('move','<?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Переместить заявку в «Архив»">&nbsp;&#8658;&nbsp;</a><?php }?><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','<?php echo $_smarty_tpl->tpl_vars['orders']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Удалить заявку из таблицы">&nbsp;X&nbsp;</a></td>
			</tr>
			<?php $_smarty_tpl->tpl_vars["number"] = new Smarty_variable($_smarty_tpl->tpl_vars['number']->value+1, null, 0);?>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td colspan="7" class="no_rows">Заявок нет</td>
			</tr>
		<?php }?>
	<?php } else { ?>
			<tr>
				<th width="5%">№</th>
				<th width="10%">Дата</th>
				<th width="40%">Сообщение</th>
				<th width="45%">Данные</th>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['errors']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['j'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['errors']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total']);
?>
			<tr>
				<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
</td>
				<td style="padding: 20px 5px;"><?php echo $_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['date_time'];?>
</td>
				<td style="text-align: left;"><?php echo $_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['text'];?>
</td>
				<td style="text-align: left;"><?php echo $_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['data'];?>
</td>
			</tr>
			<?php endfor; endif; ?>
			<?php if ($_smarty_tpl->tpl_vars['paginator']->value) {?>
			<tr>
				<th colspan="4" class="border_top"><?php echo $_smarty_tpl->tpl_vars['paginator']->value;?>
</th>
			</tr>
			<?php }?>
		<?php } else { ?>
			<tr>
				<td colspan="4" class="no_rows">Записей нет</td>
			</tr>
		<?php }?>
			<tr>
				<th colspan="4" class="border_top"><input type="button" name="clear_errors" class="button_submit" onclick="confirmDialog('clear_errors');" value="Очистить" /></th>
			</tr>
	<?php }?>
		</table>	
	</div> <!-- #orders -->
<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['page']->value=="settings") {?>
<form action="index.php?page=settings&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post" name="settings_form">
	<div class="content" id="settings">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Настройки сайта</div>
		<div class="tabs">
			<a class="caption tab_first<?php if ($_smarty_tpl->tpl_vars['type']->value=='main') {?> active_tab<?php }?>" href="index.php?page=settings&amp;type=main">Основные</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='counters') {?> active_tab<?php }?>" href="index.php?page=settings&amp;type=counters">Счётчики</a><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='scripts') {?> active_tab<?php }?>" href="index.php?page=settings&amp;type=scripts">Скрипты</a><?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?><a class="caption<?php if ($_smarty_tpl->tpl_vars['type']->value=='defaults') {?> active_tab<?php }?>" href="index.php?page=settings&amp;type=defaults">Предустановки</a><?php }?>
		</div>
<script type="text/javascript">
	function setChecked(isChecked) {
		if (isChecked) {
			$("input.server_checkboxes").prop("checked", true);
		} else {
			$("input.server_checkboxes").prop("checked", false);
		}
	}
</script>
		<table class="main_table">
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value&&$_smarty_tpl->tpl_vars['type']->value=="defaults") {?>
				<th width="5%"><input type="checkbox" id="server-all" name="server-all" onclick="setChecked(this.checked);" /><label class="without_text tooltip" for="server-all" title="Поставить все галочки для сохранения на сервере">&nbsp;</label></th>
				<th width="30%">Название</th>
				<th width="65%">Значение</th>
			<?php } else { ?>
				<th width="30%">Название</th>
				<th width="70%">Значение</th>
			<?php }?>
			</tr>
		<?php if ($_smarty_tpl->tpl_vars['settings']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['settings']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
			<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value&&$_smarty_tpl->tpl_vars['type']->value=="defaults") {?>
				<td>
					<input class="server_checkboxes" type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
_server" name="<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
_server" /><label class="without_text tooltip" for="<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
_server" title="Сохранить предустановку на сервере">&nbsp;</label>
				</td>
			<?php }?>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
&nbsp;<img src="styles/help.gif" alt="Описание" height="16" class="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['description'];?>
" />
				</td>
				<td style="text-align: left;">
					<textarea class="input_text" name="<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['value'];?>
</textarea>
				</td>
			</tr>
			<?php endfor; endif; ?>
			<tr>
				<th colspan="<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value&&$_smarty_tpl->tpl_vars['type']->value=='defaults') {?>3<?php } else { ?>2<?php }?>" class="border_top">
					<input type="submit" name="save_settings" class="button_submit" value="Сохранить<?php if ($_smarty_tpl->tpl_vars['type']->value!='defaults') {?> и обновить сайт<?php }?>" />
				</th>
			</tr>
		<?php } else { ?>
			<tr>
				<td colspan="<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value&&$_smarty_tpl->tpl_vars['type']->value=='defaults') {?>3<?php } else { ?>2<?php }?>" class="no_rows">Настроек нет</td>
			</tr>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['type']->value=="scripts") {?>
			<tr>
				<th colspan="2" class="border_top">
					<input type="button" class="button_submit long_button" value="Добавить скрипт" onclick="createScript();" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button_submit long_button" value="Удалить скрипт" onclick="deleteScript();" />
				</th>
			</tr>
		<?php }?>
		</table>
	</div> <!-- #settings -->
</form>
<?php }?> 

<?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
	<div class="caption border message content" id="message_text"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
	<div class="caption border" id="message"><div class="message_inner"><?php echo $_smarty_tpl->tpl_vars['info']->value;?>
</div></div>
<?php }?>
</div> <!-- #center_panel -->

<?php if ($_smarty_tpl->tpl_vars['page']->value=="pages"||$_smarty_tpl->tpl_vars['page']->value=="blocks"||$_smarty_tpl->tpl_vars['page']->value=="forms") {?>
	
	<script type="text/javascript">
	 $(function(){
		textareas = document.querySelectorAll(".redactor");
		taCount = textareas.length;
		editors = new Array(taCount);
		for (var i = 0; i < taCount; i++) {
			editors[i] = CodeMirror.fromTextArea(textareas[i], {
				lineNumbers: true,
				lineWrapping: true,
				matchBrackets: true,
				autoCloseTags: true,
				matchTags: {bothTags: true},
				mode: "text/html",
				indentUnit: 4,
				indentWithTabs: true,
				enterMode: "keep",
				tabMode: "shift",
				theme: "eclipse",
				extraKeys: {
					"F11": function(cm) {
					  cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
					  if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					},
					"Ctrl-Space": "autocomplete",
					"Ctrl-J": "toMatchingTag",
					"Alt-F": "findPersistent"
				},
				value: "<html>\n  " + document.documentElement.innerHTML + "\n<\/html>",
				highlightSelectionMatches: {showToken: /\w/}
			});
		}
	});
	</script>
<?php }?><?php }} ?>
