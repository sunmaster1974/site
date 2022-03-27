<?php /* Smarty version Smarty-3.1.19, created on 2018-04-17 19:09:42
         compiled from "smarty/templates/forms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16649078515ad60e3688be17-82352428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a9afdcf9f458692a7b9cc261e44b8af68169f0c' => 
    array (
      0 => 'smarty/templates/forms.tpl',
      1 => 1495663425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16649078515ad60e3688be17-82352428',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'type' => 0,
    'scheme' => 0,
    'schemes' => 0,
    'pages' => 0,
    'variables' => 0,
    'is_superadmin' => 0,
    'is_global_save' => 0,
    'prototypes' => 0,
    'realblocks' => 0,
    'catalogs' => 0,
    'settings' => 0,
    'styles' => 0,
    'list_images' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ad60e36bb4989_22328455',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad60e36bb4989_22328455')) {function content_5ad60e36bb4989_22328455($_smarty_tpl) {?>	<div id="alert_dialog" title="Предупреждение" style="display: none;">
		<p>&nbsp;</p>
	</div> <!-- #alert_dialog -->
	
	<div id="help_dialog" title="Справка" style="display: none;">
		<p>&nbsp;</p>
	</div> <!-- #help_dialog -->
	
<?php if ($_smarty_tpl->tpl_vars['page']->value=="account") {?>	
	<div id="prompt_form_account" title="Создание пользователя" style="display: none;">
		<form id="create_user_form" name="create_user_form" action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post">
			<p>Введите логин:<br />
			<input type="text" class="input_text tooltip margin_top8" id="new_user_login" name="new_user_login" title="Логин может состоять из латинских букв, цифр, тире и знака подчёркивания" /></p>
			<p>Введите пароль:<br />
			<input type="text" class="input_text tooltip margin_top8" id="new_user_pass" name="new_user_pass" title="Пароль может состоять из латинских букв, цифр, тире и знака подчёркивания и иметь длину не менее 6 символов" /></p>
			<p>Введите имя:<br />
			<input type="text" class="input_text tooltip margin_top8" id="new_user_name" name="new_user_name" title="Имя может состоять из латинских и русских букв, цифр, тире и знака подчёркивания" /></p>
			<p>Введите email:<br />
			<input type="text" class="input_text tooltip margin_top8" id="new_user_email" name="new_user_email" title="Email для отсылки пользователю его данных для доступа" /></p>
		</form>
	</div> <!-- #prompt_form_account -->
	
	<div id="confirm_account_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить запись о пользователе?</p>
	</div> <!-- #confirm_account_delete -->	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="colors") {?>
	<div id="prompt_form_color" title="Добавление цветовой схемы" style="display: none;">
		<form id="create_form_color" name="create_form_color" action="index.php?page=colors&amp;action=create" method="post">
			<p>Введите название цветовой схемы:<br />
			<input type="hidden" name="base_scheme_id" id="base_scheme_id" value="<?php echo $_smarty_tpl->tpl_vars['scheme']->value['id'];?>
" />
			<input type="text" name="new_scheme_title" id="new_scheme_title" class="input_text margin_top8" /></p>
		</form>
	</div> <!-- #prompt_form_color -->
	
	<div id="confirm_form_color" title="Удаление цветовой схемы" style="display: none;">
		<form id="delete_form_color" name="delete_form_color" action="index.php?page=colors&amp;action=delete" method="post">
			<p>Выберите цветовую(ые) схему(ы) для удаления:</p>
			<table>
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
				<tr>
					<td><input type="checkbox" id="scheme-<?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="scheme-<?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" onclick="if (this.checked) this.value='<?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
'; else this.value='';" value="" /><label for="scheme-<?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['schemes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</label></td>
				</tr>
				<?php endfor; endif; ?>
			<?php } else { ?>
				<tr>
					<td class="no_rows">Цветовых схем нет</td>
				</tr>
			<?php }?>
			</table>
		</form>
	</div> <!-- #confirm_form_color -->
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="journal") {?>
	<div id="confirm_journal_clear_logs" title="Подтверждение" style="display: none;">
		<p>Действительно очистить журнал ошибок?</p>
	</div> <!-- #confirm_journal_clear_logs -->
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="templates") {?>
<?php if ($_smarty_tpl->tpl_vars['type']->value=="all") {?>
	<div id="confirm_templates_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить шаблон со всеми файлами?</p>
	</div> <!-- #confirm_templates_delete -->
	
<?php } else { ?>
	<div id="prompt_add_layout" title="Добавление css медиа-запроса" style="display: none;">
		<p>Введите название нового css медиа-запроса:<br />
		<input type="text" class="input_text tooltip margin_top8" name="new_layout_name" id="new_layout_name" title="Имя css медиа-запроса для отображения в названии вкладки" /></p>
	</div> <!-- #prompt_add_layout -->
	
	<div id="confirm_templates_delete_layout" title="Подтверждение" style="display: none;">
		<p>Действительно удалить css медиа-запрос?</p>
	</div> <!-- #confirm_templates_delete_layout -->
	
<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="pages") {?>
	<div id="prompt_form_page" title="Создание страницы" style="display: none;">
		<form id="create_page_form" name="create_page_form" action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post">
			<p>Введите название страницы:<br />
			<input type="text" class="input_text tooltip margin_top8" name="new_page_name" id="new_page_name" title="Короткое название страницы для отображения в списке страниц" /></p>
			<p>Введите имя файла страницы:<br />
			<input type="text" class="input_text tooltip margin_top8" name="new_page_file" id="new_page_file" title="Имя файла страницы латинскими буквами без расширения .html или .php" /></p>
		</form>
	</div> <!-- #prompt_form_page -->

<?php if (isset($_smarty_tpl->tpl_vars['pages']->value)) {?>
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
	<div id="prompt_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_double" title="Дублирование страницы" style="display: none;">
		<form id="double_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_form" name="double_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_form" action="index.php?page=pages&amp;type=all&amp;action=double_page&amp;id=<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" method="post">
			<p>Введите название страницы:<br />
			<input type="text" class="input_text tooltip margin_top8" id="double_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_name" name="double_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_name" title="Короткое название страницы для отображения в списке страниц" /></p>
			<p>Введите имя файла страницы:<br />
			<input type="text" class="input_text tooltip margin_top8" id="double_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_file" name="double_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_file" title="Имя файла страницы латинскими буквами без расширения .html или .php" /></p>
			<p>Выберите нужные блоки:</p>
			<table class="page_double">
			<?php if ($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks']) {?>
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['j'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks']) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
					<td><input type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_name'];?>
" checked="checked" /><label for="<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_title'];?>
</label></td>
					<td><input type="radio" id="copy-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_id'];?>
" name="type-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_id'];?>
" checked="checked" value="copy" /><label for="copy-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['form_id'];?>
">копия</label><?php if ($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['mirror']==0) {?>&nbsp;&nbsp;<input type="radio" id="link-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
" name="type-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
" value="link" /><label for="link-<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['blocks'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['id'];?>
">ссылка</label><?php }?></td>
				</tr>
				<?php endfor; endif; ?>
			<?php } else { ?>
				<tr>
					<td class="no_rows" colspan="2">Блоков нет</td>
				</tr>
			<?php }?>
			</table>
		</form>
	</div> <!-- #prompt_page<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
_double -->
	
<?php endfor; endif; ?>
<?php }?>

	<div id="confirm_pages_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить страницу со всеми блоками?</p>
	</div> <!-- #confirm_pages_delete -->
	
	<div id="confirm_pages_delete_favicon" title="Подтверждение" style="display: none;">
		<p>Действительно удалить иконку?</p>
	</div> <!-- #confirm_pages_delete_favicon -->
	
<?php }?>
<?php if (($_smarty_tpl->tpl_vars['page']->value=="pages"||$_smarty_tpl->tpl_vars['page']->value=="blocks")&&($_smarty_tpl->tpl_vars['type']->value!="all")&&($_smarty_tpl->tpl_vars['type']->value!="prototypes")) {?>
	<div id="prompt_select_form" title="Выбор формы" style="display: none;">
		<form id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_select_form" name="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_select_form" action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post">
			<p id="list_title">&nbsp;</p>
			<p id="list_content">&nbsp;</p>
		</form>
	</div> <!-- #prompt_select_form -->
	
	<div id="prompt_add_variable" title="Добавление переменной" style="display: none;">
		<p>Введите название новой переменной:<br />
		<input type="text" class="input_text tooltip margin_top8" name="new_variable_name" id="new_variable_name" title="Уникальное название переменной латинскими буквами без знака $ в начале" /></p>
	</div> <!-- #prompt_add_variable -->
	
	<div id="confirm_delete_variable" title="Удаление переменной" style="display: none;">
	<form id="delete_variable_form" name="delete_variable_form" action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=delete_variable" method="post">	
		<p>Выберите переменную(ые) для удаления:</p>
		<table>
		<?php if ($_smarty_tpl->tpl_vars['variables']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['variables']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
				<td><input type="checkbox" id="variable-<?php echo $_smarty_tpl->tpl_vars['variables']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="variable-<?php echo $_smarty_tpl->tpl_vars['variables']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" onclick="if (this.checked) this.value='<?php echo $_smarty_tpl->tpl_vars['variables']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
'; else this.value='';" value="" /><label for="variable-<?php echo $_smarty_tpl->tpl_vars['variables']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">$<?php echo $_smarty_tpl->tpl_vars['variables']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
</label></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td class="no_rows">Переменных нет</td>
			</tr>
		<?php }?>
		</table>
	</form>
	</div> <!-- #confirm_delete_variable -->
	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="blocks") {?>
	<div id="prompt_add_string" title="Добавление константы" style="display: none;">
		<p>Введите название новой строковой константы:<br />
		<input type="text" class="input_text tooltip margin_top8" name="new_string_title" title="Название строковой константы русскими буквами для отображения в окне редактирования блока" /></p>
	</div> <!-- #prompt_add_string -->	

	<div id="prompt_form_block" title="" style="display: none;">
		<div id="select_part" style="display: none;">
			<p>
				<input type="radio" name="block_type" id="block_type_empty" value="block_empty" checked="checked" onchange="if (this.checked) {$('#prototype_desc').css('display','none'); $('#prototype_select').css('display','none'); $('#realblock_select').css('display','none'); $('#names_part').css('display','block');}" /><label for="block_type_empty">Пустой блок</label><br />
				<input type="radio" name="block_type" id="block_type_mirror" value="block_mirror" onchange="if (this.checked) {$('#prototype_desc').css('display','none'); $('#prototype_select').css('display','none'); $('#realblock_select').css('display','block'); $('#names_part').css('display','none');}" /><label for="block_type_mirror">Блок-ссылка</label><br />
				<input type="radio" name="block_type" id="block_type_full" value="block_base" onchange="if (this.checked) {$('#prototype_desc').css('display','none'); $('#prototype_select').css('display','block'); $('#realblock_select').css('display','none'); $('#names_part').css('display','block');}" /><label for="block_type_full">Блок на основе протототипа</label>
				<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?>
				<br /><input type="radio" name="block_type" id="block_type_prototype" value="block_prototype" onchange="if (this.checked) {$('#prototype_desc').css('display','block'); $('#prototype_select').css('display','none'); $('#realblock_select').css('display','none'); $('#names_part').css('display','block');}" /><label for="block_type_prototype">Блок-прототип</label>
				<?php }?>
			</p>
			<p id="prototype_desc" style="display: none;">
				<?php if ($_smarty_tpl->tpl_vars['is_global_save']->value) {?>
				<input type="checkbox" id="create_on_server" name="create_on_server" onclick="if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="create_on_server">Создать блок-прототип также на сервере</label><br /><br />
				<?php }?>
				Введите описание блока-прототипа:<br />
				<textarea class="input_text margin_top8 tooltip" name="prototype_description" id="prototype_description" title="Описание блока-прототипа не может быть пустым"></textarea>
			</p>
			<p id="prototype_select" style="display: none;">
				<select name="prototype_file" id="prototype_file" class="input_text margin_top8" onchange="$('#new_block_title').val($('#prototype_file :selected').text()); $('#new_block_file').val($('#prototype_file :selected').val());" style="height: 25px;"><option value="" selected="selected" disabled="disabled">Выберите прототип:</option><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['prototypes']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
?><option value="<?php echo $_smarty_tpl->tpl_vars['prototypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
"><?php echo $_smarty_tpl->tpl_vars['prototypes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</option><?php endfor; endif; ?></select>
			</p>
			<p id="realblock_select" style="display: none;">
				<select name="realblock_id" id="realblock_id" class="input_text margin_top8" style="height: 25px;"><option value="" selected="selected" disabled="disabled">Выберите блок:</option><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['realblocks']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
?><option value="<?php echo $_smarty_tpl->tpl_vars['realblocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['realblocks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</option><?php endfor; endif; ?></select>
			</p>
		</div>
		<div id="names_part">
			<p>
				<span id="prompt_caption">Введите название блока:</span><br />
				<input type="text" class="input_text tooltip margin_top8" name="new_block_title" id="new_block_title" value="" title="Название блока русскими буквами для отображения в списке блоков" /></p>
			<p id="file_part">Введите имя файла блока:<br />
				<input type="text" class="input_text tooltip margin_top8" name="new_block_file" id="new_block_file" value="" title="Имя файла блока латинскими буквами<br />без расширения .tpl" /></p>
		</div>
	</div> <!-- #prompt_form_block -->
	
	<div id="confirm_blocks_delete" title="Подтверждение" style="display: none;">
		<p id="delete_block_title">Действительно удалить блок?</p>
		<p id="delete_mirrors_checkbox"><input type="checkbox" id="delete_mirrors" onclick="if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="delete_mirrors">Удалить блоки-ссылки на этот блок</label></p>
		<p id="delete_file_checkbox"><input type="checkbox" id="delete_blocks_file" onclick="if (this.checked) this.value='yes'; else this.value='no';" checked="checked" value="yes" /><label for="delete_blocks_file">Удалить файл блока с диска</label></p>
		<p id="delete_css_checkbox"><input type="checkbox" id="delete_css" onclick="if (this.checked) this.value='yes'; else this.value='no';" checked="checked" value="yes" /><label for="delete_css">Удалить css-правила блока из файлов стилей</label></p>
	</div> <!-- #confirm_blocks_delete -->

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="images") {?>
	<div id="prompt_rename_folder" title="Переименование папки" style="display: none;">
		<p>Введите новое название папки:<br />
		<input type="text" class="input_text tooltip margin_top8" id="folder_name_rename_folder" title="Название папки может состоять из латинских букв, цифр, тире и знака подчёркивания" /></p>
	</div> <!-- #prompt_rename_folder -->
	
	<div id="prompt_create_folder" title="Создание папки" style="display: none;">
		<p>Введите название новой папки:<br />
		<input type="text" class="input_text tooltip margin_top8" id="folder_name_create_folder" title="Название папки может состоять из латинских букв, цифр, тире и знака подчёркивания" /></p>
	</div> <!-- #prompt_create_folder -->
	
	<div id="prompt_images_move" title="Выбор папки" style="display: none;">
		<p>Выберите папку для перемещения:<br />
			<select id="folder_to_move" class="input_text margin_top8">
			<?php if ($_smarty_tpl->tpl_vars['catalogs']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
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
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['catalogs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['catalogs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
</option>
			<?php endfor; endif; ?>
			<?php } else { ?>
			<option value="no_folders" disabled="disabled" selected="selected">Папок нет</option>
			<?php }?>
			</select>
		</p>
	</div> <!-- prompt_images_move -->
	
	<div id="confirm_images_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить файл?</p>
	</div> <!-- #confirm_images_delete -->
	
	<div id="confirm_images_delete_folder" title="Подтверждение" style="display: none;">
		<p>Действительно удалить папку?</p>
	</div> <!-- #confirm_images_delete_folder -->
	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="visitors") {?>
	<div id="confirm_visitors_clear_list" title="Подтверждение" style="display: none;">
		<p>Действительно очистить список посетителей?</p>
	</div> <!-- #confirm_visitors_clear_list -->
	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="orders") {?>
	<div id="confirm_orders_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить заявку?</p>
		<p><input type="checkbox" id="delete_orders_file" onclick="if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="delete_orders_file">Удалить файл-вложение заявки</label></p>
	</div> <!-- #confirm_orders_delete -->
	
	<div id="confirm_orders_move" title="Подтверждение" style="display: none;">
		<p>Действительно переместить заявку в «Архив»?</p>
	</div> <!-- #confirm_orders_move -->
	
	<div id="confirm_orders_clear_errors" title="Подтверждение" style="display: none;">
		<p>Действительно очистить журнал?</p>
	</div> <!-- #confirm_orders_clear_errors -->
	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="settings"&&$_smarty_tpl->tpl_vars['type']->value=="favicon") {?>
	<div id="confirm_settings_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить иконку?</p>
	</div> <!-- #confirm_settings_delete -->
	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="settings"&&$_smarty_tpl->tpl_vars['type']->value=="scripts") {?>
	<div id="prompt_form_script" title="Добавление скрипта" style="display: none;">
	<form id="create_script_form" name="create_script_form" action="index.php?page=settings&amp;type=scripts&amp;action=create" method="post">
		<p>Введите название скрипта:<br />
		<input type="text" class="input_text tooltip margin_top8" name="new_script_title" id="new_script_title" title="Название скрипта может состоять из латинских букв, цифр, тире и знака подчёркивания" /></p>
		<p>Введите описание скрипта:<br />
		<textarea class="input_text tooltip margin_top8" name="new_script_description" id="new_script_description" title="Описание скрипта обязательно для заполнения"></textarea></p>
	</form>
	</div> <!-- #prompt_form_script -->
	
	<div id="confirm_form_script" title="Удаление скрипта" style="display: none;">
	<form id="delete_script_form" name="delete_script_form" action="index.php?page=settings&amp;type=scripts&amp;action=delete" method="post">
		<p>Выберите скрипт(ы) для удаления:</p>
		<table>
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
				<td><input type="checkbox" id="script-<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="script-<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" onclick="if (this.checked) this.value='<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
'; else this.value='';" value="" /><label for="script-<?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</label></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td class="no_rows">Скриптов нет</td>
			</tr>
		<?php }?>
		</table>
	</form>
	</div> <!-- #confirm_form_script -->
	
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['page']->value=="forms") {?>
	<div id="confirm_forms_delete" title="Подтверждение" style="display: none;">
		<p>Действительно удалить форму?</p>
	</div> <!-- #confirm_forms_delete -->
	
	<div id="create_form_dialog" title="Конструктор форм обратной связи" style="display: none;">
	<br />
	<form id="create_form_form" name="create_form_form" action="index.php?page=forms&amp;type=new" method="post">
		<input type="checkbox" id="form_yes" name="form_yes" onclick="if (this.checked) $('#form_settings').css('display','block'); else $('#form_settings').css('display','none');" /><label class="tooltip" title="Поставьте галочку, если необходимо вывести название формы в заголовке формы, в заголовке модального окна или в письме администратору" for="form_yes">Название формы</label>: <input type="text" name="form_title" class="input_text" value="Заявка на звонок" />
		<br />
		<div id="form_settings">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Класс названия формы: <input type="text" id="form_class" name="form_class" class="input_text" value="form_title" />
			<br /><br />
			<table class="table_forms">
				<tr>
					<th>Укажите, где выводить название формы</th>
				</tr>
				<tr>
					<td>
						<input type="checkbox" class="checkbox_group" id="site_yes" name="site_yes" checked="checked" /><label for="site_yes">В заголовке формы на сайте</label><br />
						<input type="checkbox" class="checkbox_group" id="window_yes" name="window_yes" checked="checked" /><label for="window_yes">В заголовке всплывающей формы</label><br />
						<input type="checkbox" class="checkbox_group" id="letter_yes" name="letter_yes" checked="checked" /><label for="letter_yes">Отправлять в письме название формы</label><br /></td>
				</tr>
			</table>
		</div>
		<br />
		<input type="checkbox" id="bootstrap_yes" name="bootstrap_yes" onclick="if (this.checked) $('#bootstrap_settings').css('display','block'); else $('#bootstrap_settings').css('display','none'); change_classes();" /><label class="tooltip" title="Поставьте галочку, если необходимо сделать поля формы с помощью фреймворка Twitter Bootstrap" for="bootstrap_yes">Twitter Bootstrap форма</label>
		<br />
		<div id="bootstrap_settings">
		
		</div>
<script type="text/javascript">
	function change_class(name) {
		if ($("#bootstrap_yes").prop("checked")) {
			if (name == "#download")
				$(name + "_input_class").val("");
			else
				$(name + "_input_class").val("form-control");
			
			if ($(name + "_show").prop("checked")) 
				$(name + "_label_class").val("");
			else
				$(name + "_label_class").val("sr-only");
		} else {
			if ((name == "#name") || (name == "#email") || (name == "#phone") || (name == "#message"))
				$(name + "_input_class").val("form_text");
			if (name == "#download")
				$(name + "_input_class").val("form_checkbox");
			if (name == "#file")
				$(name + "_input_class").val("form_file");
			
			$(name + "_label_class").val("form_label");
		}		
	}
	function change_classes() {
		change_class("#name");
		change_class("#email");
		change_class("#phone");
		change_class("#message");
		change_class("#download");
		change_class("#file");
		
		if ($("#bootstrap_yes").prop("checked")) {
			$("#form_class").val("h3");
			$("#send_class").val("btn btn-primary btn-block");
			$("#link_class").val("btn btn-primary");
			$("#conf_class").val("text-success text-center");
			$("#button_class").val("btn btn-default");
		} else {
			$("#form_class").val("form_title");
			$("#send_class").val("form_submit");
			$("#link_class").val("form_link");
			$("#conf_class").val("form_conf");
			$("#button_class").val("form_button");
		}
	}
</script>
		<br />
		<input type="checkbox" id="link_yes" name="link_yes" onclick="if (this.checked) $('#link_settings').css('display','block'); else $('#link_settings').css('display','none');" /><label class="tooltip" title="Если галочка «Bootstrap форма» не поставлена, подключите к странице скрипт Fancybox для открытия модального окна" for="link_yes">Модальная форма (открытие с помощью Bootstrap или Fancybox)</label>
		<br />
		<div id="link_settings">
			<br />
			<table class="table_forms">
				<tr>
					<th>Заполните параметры ссылки</th>
				</tr>
				<tr>
					<td>
						Текст ссылки:&nbsp;&nbsp;<input type="text" id="link_title" name="link_title" class="input_text" value="Заказать звонок" /><br />
						Класс ссылки:&nbsp;&nbsp;<input type="text" id="link_class" name="link_class" class="input_text" value="form_link" /><br /></td>
				</tr>
			</table>
		</div>
		<br />
		<input type="checkbox" id="conf_yes" name="conf_yes" onclick="if (this.checked) $('#conf_settings').css('display','block'); else $('#conf_settings').css('display','none');" /><label class="tooltip" title="Поставьте галочку, если необходимо вывести уверение в конфиденциальности переданных данных" for="conf_yes">Конфиденциальность данных</label>
		<br />
		<div id="conf_settings">
			<br />
			<table class="table_forms">
				<tr>
					<th>Введите уверение в конфиденциальности переданных данных</th>
				</tr>
				<tr>
					<td>
						Текст надписи:&nbsp;&nbsp;<input type="text" id="conf_title" name="conf_title" class="input_text" style="width: 530px;" value="Ваши данные не будут переданы третьим лицам." /><br />
						Класс надписи:&nbsp;&nbsp;<input type="text" id="conf_class" name="conf_class" class="input_text" value="form_conf" /><br /></td>
				</tr>
			</table>
		</div>
		<br />
		
		<table class="table_forms">
			<tr>
				<th colspan="7">Выберите поля для формы</th>
			</tr>
			<tr class="table_title">
				<td>Поле</td>
				<td class="tooltip" title="Поле присутствует в форме">Есть</td>
				<td class="tooltip" title="Поле обязательно для заполнения">Треб.</td>
				<td class="tooltip" title="Если галочка поставлена, то название поля отображается рядом, если нет - внутри поля (placeholder)">Подп.</td>
				<td class="tooltip" title="Название поля или значение placeholder'а для поля input">Название поля</td>
				<td class="tooltip" title="Название селектора класса<br />для поля input">Класс поля</td>
				<td class="tooltip" title="Название селектора класса<br />для поля label">Класс&nbsp;названия</td>
			</tr>
			<tr>
				<td>Имя</td>
				<td class="center"><input type="checkbox" id="name_yes" name="name_yes" checked="checked" /><label for="name_yes"></label></td>
				<td class="center"><input type="checkbox" id="name_required" name="name_required" checked="checked" /><label for="name_required"></label></td>
				<td class="center"><input type="checkbox" id="name_show" name="name_show" checked="checked" onclick="change_class('#name');" /><label for="name_show"></label></td>
				<td><input type="text" name="name_title" class="input_text" value="Имя" /></td>
				<td><input type="text" id="name_input_class" name="name_input_class" class="input_text class" value="form_text" /></td>
				<td><input type="text" id="name_label_class" name="name_label_class" class="input_text class" value="form_label" /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td class="center"><input type="checkbox" id="email_yes" name="email_yes" checked="checked" /><label for="email_yes"></label></td>
				<td class="center"><input type="checkbox" id="email_required" name="email_required" checked="checked" /><label for="email_required"></label></td>
				<td class="center"><input type="checkbox" id="email_show" name="email_show" checked="checked" onclick="change_class('#email');" /><label for="email_show"></label></td>
				<td><input type="text" name="email_title" class="input_text" value="Email" /></td>
				<td><input type="text" id="email_input_class" name="email_input_class" class="input_text class" value="form_text" /></td>
				<td><input type="text" id="email_label_class" name="email_label_class" class="input_text class" value="form_label" /></td>
			</tr>
			<tr>
				<td>Телефон</td>
				<td class="center"><input type="checkbox" id="phone_yes" name="phone_yes" /><label for="phone_yes"></label></td>
				<td class="center"><input type="checkbox" id="phone_required" name="phone_required" /><label for="phone_required"></label></td>
				<td class="center"><input type="checkbox" id="phone_show" name="phone_show" checked="checked" onclick="change_class('#phone');" /><label for="phone_show"></label></td>
				<td><input type="text" name="phone_title" class="input_text" value="Телефон" /></td>
				<td><input type="text" id="phone_input_class" name="phone_input_class" class="input_text class" value="form_text" /></td>	
				<td><input type="text" id="phone_label_class" name="phone_label_class" class="input_text class" value="form_label" /></td>	
			</tr>			
			<tr>
				<td>Сообщение</td>
				<td class="center"><input type="checkbox" id="message_yes" name="message_yes" /><label for="message_yes"></label></td>
				<td class="center"><input type="checkbox" id="message_required" name="message_required" /><label for="message_required"></label></td>
				<td class="center"><input type="checkbox" id="message_show" name="message_show" checked="checked" onclick="change_class('#message');" /><label for="message_show"></label></td>
				<td><input type="text" name="message_title" class="input_text" value="Сообщение" /></td>
				<td><input type="text" id="message_input_class" name="message_input_class" class="input_text class" value="form_text" /></td>
				<td><input type="text" id="message_label_class" name="message_label_class" class="input_text class" value="form_label" /></td>
			</tr>
			<tr>
				<td>Скачать</td>
				<td class="center"><input type="checkbox" id="download_yes" name="download_yes" onclick="if (this.checked) 
				$('#download_settings').css('display','block'); else $('#download_settings').css('display','none');" /><label for="download_yes" class="tooltip" title="Для поля «Скачать файл» необходимо наличие в форме поля «Email»"></label></td>
				<td class="center"><input type="checkbox" id="download_required" name="download_required" checked="checked" /><label for="download_required"></label></td>
				<td class="center"><input type="checkbox" id="download_show" name="download_show" checked="checked" /><label for="download_show"></label></td>
				<td><input type="text" name="download_title" class="input_text" value="Как бы Вы хотели получить файл?" /></td>
				<td><input type="text" id="download_input_class" name="download_input_class" class="input_text class" value="form_checkbox" /></td>
				<td><input type="text" id="download_label_class" name="download_label_class" class="input_text class" value="form_label" /></td>
			</tr>
			<tr>
				<td>Файл</td>
				<td class="center"><input type="checkbox" id="file_yes" name="file_yes" onclick="if (this.checked) 
				$('#file_settings').css('display','block'); else $('#file_settings').css('display','none');" /><label for="file_yes"></label></td>
				<td class="center"><input type="checkbox" id="file_required" name="file_required" /><label for="file_required"></label></td>
				<td class="center"><input type="checkbox" id="file_show" name="file_show" checked="checked" onclick="change_class('#file');" /><label for="file_show"></label></td>
				<td><input type="text" name="file_title" class="input_text" value="Загрузите файл" /></td>
				<td><input type="text" id="file_input_class" name="file_input_class" class="input_text class" value="form_file" /></td>
				<td><input type="text" id="file_label_class" name="file_label_class" class="input_text class" value="form_label" /></td>
			</tr>
		</table>
		<br />
		<div id="download_settings">
			<table class="table_forms">
				<tr>
					<th>Заполните настройки для скачиваемого файла</th>
				</tr>
				<tr>
					<td>
						<span style="display: inline-block; width: 320px;">Имя файла для загрузки (в папке files):</span> <input type="text" name="download_file" class="input_text tooltip" value="price.xls" style="display: inline-block; width: 320px;" title="Название файла должно состоять из латинских букв, цифр и разрешённых для имени файла символов, но без пробелов. Для создания формы файл должен существовать." /><br />
						<span style="display: inline-block; width: 320px;">Текст варианта для отправки файла по почте:</span> <input type="text" name="download_mail" class="input_text" value="получить файл на почту" style="display: inline-block; width: 320px;" /><br />
						<span style="display: inline-block; width: 320px;">Текст варианта для загрузки файла по ссылке:</span> <input type="text" name="download_link" class="input_text" value="скачать файл по ссылке" style="display: inline-block; width: 320px;" /><br /></td>
				</tr>
			</table>
			<br />
		</div>
		<div id="file_settings">
			<table class="table_forms">
				<tr>
					<th>Заполните настройки для загружаемых файлов</th>
				</tr>
				<tr>
					<td>
						<span style="display: inline-block; width: 305px;">Типы загружаемых файлов (через запятую):</span> <input type="text" name="file_type" class="input_text tooltip" value="jpg, png, gif, bmp" title="Если можно загружать любые файлы - оставьте поле пустым" /><br />
						<span style="display: inline-block; width: 305px;">Максимальный размер файла (в мегабайтах):</span> <input type="text" name="file_size" class="input_text tooltip" value="5" title="При превышении размера файла этого значения выводится предупреждение" /><br />
						<span style="display: inline-block; width: 305px;">Классы кнопок «Загрузить» и «Очистить»:</span> <input type="text" id="button_class" name="button_class" class="input_text" value="form_button" /><br /></td>
				</tr>
			</table>
			<br />
		</div>
		<table class="table_forms">
			<tr>
				<th>Укажите скрытые поля для отправки в письме</th>
			</tr>
			<tr>
				<td>
					<input type="checkbox" class="checkbox_group" id="time_yes" name="time_yes" checked="checked" /><label for="time_yes">Время отправления</label><br />
					<input type="checkbox" class="checkbox_group" id="agent_yes" name="agent_yes" checked="checked" /><label for="agent_yes">Браузер отправителя</label><br />
					<input type="checkbox" class="checkbox_group" id="ip_yes" name="ip_yes" checked="checked" /><label for="ip_yes">IP-адрес отправителя</label><br />
					<input type="checkbox" class="checkbox_group" id="referrer_yes" name="referrer_yes" checked="checked" /><label for="referrer_yes">Cайт, откуда пришёл отправитель</label></td>
			</tr>
		</table>
		<br />
		<table class="table_forms">
			<tr>
				<th>Заполните параметры кнопки, отправляющей данные формы</th>
			</tr>
			<tr>
				<td style="border-bottom: none;">					
					<span style="display: inline-block; width: 135px;">Название кнопки:</span> <input type="text" name="send_title" class="input_text" value="Послать заявку" /><br />					
					<span style="display: inline-block; width: 135px;">Класс кнопки:</span> <input type="text" id="send_class" name="send_class" class="input_text" value="form_submit" /><br />					
					<span style="display: inline-block; width: 135px;">Обработчик onclick:</span> <input type="text" name="send_onclick" class="input_text tooltip" style="width: 500px;" title="Введите сам код обработчика без обрамляющих кавычек. Используемые кавычки внутри кода обработчика должны быть одинарными." /></td>
			</tr>
		</table>
	</form>
	</div> <!-- #create_form_dialog -->
	
<?php }?>
<?php if (($_smarty_tpl->tpl_vars['page']->value=="templates"&&$_smarty_tpl->tpl_vars['type']->value!="all")||($_smarty_tpl->tpl_vars['page']->value=="blocks"&&$_smarty_tpl->tpl_vars['type']->value!="all"&&$_smarty_tpl->tpl_vars['type']->value!="active"&&$_smarty_tpl->tpl_vars['type']->value!="inactive"&&$_smarty_tpl->tpl_vars['type']->value!="prototypes")) {?>
	<div id="prompt_add_style" title="Добавление переменной" style="display: none;">
		<p>Введите название новой css-переменной:<br />
		<input type="text" class="input_text tooltip margin_top8" name="new_style_name" id="new_style_name" title="Уникальное название css-переменной латинскими буквами без знака $ в начале" /></p>
	</div> <!-- #prompt_add_style -->
	
	<div id="confirm_delete_style" title="Удаление переменной" style="display: none;">
	<form id="delete_style_form" name="delete_style_form" action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=delete_style" method="post">	
		<p>Выберите css-переменную(ые) для удаления:</p>
		<table>
		<?php if ($_smarty_tpl->tpl_vars['styles']->value) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['styles']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
				<td><input type="checkbox" id="style-<?php echo $_smarty_tpl->tpl_vars['styles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="style-<?php echo $_smarty_tpl->tpl_vars['styles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" onclick="if (this.checked) this.value='<?php echo $_smarty_tpl->tpl_vars['styles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
'; else this.value='';" value="" /><label for="style-<?php echo $_smarty_tpl->tpl_vars['styles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">$<?php echo $_smarty_tpl->tpl_vars['styles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'];?>
</label></td>
			</tr>
			<?php endfor; endif; ?>
		<?php } else { ?>
			<tr>
				<td class="no_rows">CSS-переменных нет</td>
			</tr>
		<?php }?>
		</table>
	</form>
	</div> <!-- #confirm_delete_style -->
	
	<div id="create_styles_dialog" title="Настройки текста, заголовков и ссылок" style="display: none;">
	<form name="jg_form" id="jg_form" action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" method="post">
		<input type="hidden" name="form_action" value="add_text_styles" />
		
		<input type="hidden" name="aColor" id="aColor" value="#0000FF" />
		<input type="hidden" name="aBold" id="aBold" value="normal" />
		<input type="hidden" name="aItalic" id="aItalic" value="normal" />
		<input type="hidden" name="aBorderStyle" id="aBorderStyle" value="normal" />
		<input type="hidden" name="aBorderColor" id="aBorderColor" value="#0000FF" />
		<input type="hidden" name="aBorderWidth" id="aBorderWidth" value="1px" />
		<input type="hidden" name="aHighlight" id="aHighlight" value="transparent" />

		<input type="hidden" name="aHColor" id="aHColor" value="#FF0000" />
		<input type="hidden" name="aHBold" id="aHBold" value="normal" />
		<input type="hidden" name="aHItalic" id="aHItalic" value="normal" />
		<input type="hidden" name="aHBorderStyle" id="aHBorderStyle" value="normal" />
		<input type="hidden" name="aHBorderColor" id="aHBorderColor" value="#FF0000" />
		<input type="hidden" name="aHBorderWidth" id="aHBorderWidth" value="1px" />
		<input type="hidden" name="aHHighlight" id="aHHighlight" value="transparent" />

		<table id="styles_table">
		<tr>
			<td width="50%">
				<fieldset class="fieldset_first"><legend>Основной цвет</legend>
				<table>
					<tr>						
						<td>
							#<input type="text" class="input_text value tooltip" name="rvb" size="6" maxlength="6" value="F1F1F1" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_rvb.style.backgroundColor='#'+this.value;" title="Доминирующий цвет в оформлении страницы" />&nbsp;
							<input type="text" name="a_rvb" class="input_text tooltip" style="background-color: #F1F1F1;" onDblClick="jg_popicker(document.jg_form.rvb.value,'rvb')" title="Двойной щелчок по полю вызывает окно выбора цвета" />
							[<a class="m tooltip" href="javascript:generate(document.jg_form.rvb.value,'+1','+1','+1','rvb');document.jg_form.rvb.onchange();" title="Сделать на тон светлее">&lt;</a> 
							<a class="p tooltip" href="javascript:generate(document.jg_form.rvb.value,'-1','-1','-1','rvb');document.jg_form.rvb.onchange();" title="Сделать на тон темнее">&gt;</a>]
							[<a class="r" href="javascript:rgbch('rvb','r+')">+</a> 
							<a class="r" href="javascript:rgbch('rvb','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('rvb','g+')">+</a> 
							<a class="g" href="javascript:rgbch('rvb','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('rvb','b+')">+</a> 
							<a class="b" href="javascript:rgbch('rvb','b-')">–</a>]
						</td>
					</tr>
					<tr>
						<td>
							<input type="button" class="button_submit tooltip" value="Применить" onclick="var s1; if (document.jg_form.s1.checked) s1=1; else s1=0; generateall(document.jg_form.rvb.value,s1,0);" title="Генерировать оформление страницы на основе выбранного выше цвета" />&nbsp;
							<input type="checkbox" id="s1" name="s1" value="1" /><label for="s1">Обратить цвета</label><span style="font-size: 150%;">|</span> 
							<input type="button" class="button_submit tooltip" value="Случайный" onclick="var s2; if (document.jg_form.s2.checked) s2=1; else s2=0; generateall(document.jg_form.rvb.value,s2,1);" title="Генерировать оформление страницы на основе цвета, выбранного случайно" />&nbsp;
							<input type="checkbox" id="s2" name="s2" value="1" /><label for="s2">Обратить цвета</label>
						</td>
					</tr>
				</table>
				</fieldset>
				
				<fieldset><legend>Заголовок</legend>
				<table>
					<tr>
						<td class="row_title">Цвет:</td>
						<td>#<input type="text" class="input_text value" name="color_titres" size="6" maxlength="6" value="483D8B" onchange="this.value=this.value.toUpperCase();document.jg_form.a_color_titres.style.backgroundColor='#'+this.value;apcl('titles','color','#'+this.value);" />&nbsp;
						<input type="text" class="input_text" id="a_color_titres" style="background-color: #483D8B;" ondblclick="jg_popicker(document.jg_form.color_titres.value,'color_titres')" />
						[<a class="m" href="javascript:generate(document.jg_form.color_titres.value,'+1','+1','+1','color_titres');">&lt;</a> 
						<a class="p" href="javascript:generate(document.jg_form.color_titres.value,'-1','-1','-1','color_titres');">&gt;</a>]
						[<a class="r" href="javascript:rgbch('color_titres','r+')">+</a> 
						<a class="r" href="javascript:rgbch('color_titres','r-')">–</a>]
						[<a class="g" href="javascript:rgbch('color_titres','g+')">+</a> 
						<a class="g" href="javascript:rgbch('color_titres','g-')">–</a>]
						[<a class="b" href="javascript:rgbch('color_titres','b+')">+</a> 
						<a class="b" href="javascript:rgbch('color_titres','b-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Шрифт:</td>
						<td>
							<select name="title_font_family" class="input_text" onchange="apcl('titles','fontFamily',this.value);" onkeydown="apcl('titles','fontFamily',this.value);">
								<option value='"Arial Black","Helvetica CY","Nimbus Sans L",sans-serif'>"Arial Black","Helvetica CY","Nimbus Sans L",sans-serif</option>
								<option value='Arial,"Helvetica CY","Nimbus Sans L",sans-serif'>Arial,"Helvetica CY","Nimbus Sans L",sans-serif</option>
								<option value='"Comic Sans MS","Monaco CY",cursive'>"Comic Sans MS","Monaco CY",cursive</option>
								<option value='"Courier New","Nimbus Mono L",monospace'>"Courier New","Nimbus Mono L",monospace</option>
								<option value='Georgia,"Century Schoolbook L",serif'>Georgia,"Century Schoolbook L",serif</option>
								<option value='Impact,"Charcoal CY",sans-serif'>Impact,"Charcoal CY",sans-serif</option>
								<option value='"Lucida Console",Monaco,monospace'>"Lucida Console",Monaco,monospace</option>
								<option value='"Lucida Sans Unicode","Lucida Grande",sans-serif'>"Lucida Sans Unicode","Lucida Grande",sans-serif</option>
								<option value='"Palatino Linotype","Book Antiqua",Palatino,serif'>"Palatino Linotype","Book Antiqua",Palatino,serif</option>
								<option value='Tahoma,"Geneva CY",sans-serif'>Tahoma,"Geneva CY",sans-serif</option>
								<option value='"Times New Roman","Times CY","Nimbus Roman No9 L",serif'>"Times New Roman","Times CY","Nimbus Roman No9 L",serif</option>
								<option value='"Trebuchet MS","Helvetica CY",sans-serif'>"Trebuchet MS","Helvetica CY",sans-serif</option>
								<option value='Verdana,"Geneva CY","DejaVu Sans",sans-serif' selected="selected">Verdana,"Geneva CY","DejaVu Sans",sans-serif</option>
							</select>&nbsp;&nbsp;
							<input type="text" class="input_text value" name="title_font_size" size="4" maxlength="4" onchange="apcl('titles','fontSize',this.value);" value="16px" />
							[<a class="p" href="javascript:fontch('title_font_size','+')">+</a> 
							<a class="p" href="javascript:fontch('title_font_size','-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Стиль:</td>
						<td>
							<input type="checkbox" id="bold_titres" name="bold_titres" onclick="apclch('titles',this.checked,'fontWeight','bold','normal')" value="bold" checked="checked" /><label for="bold_titres">Полужирный</label>&nbsp;&nbsp;
							<input type="checkbox" id="italic_titres" name="italic_titres" onclick="apclch('titles',this.checked,'fontStyle','italic','normal')" value="italic" /><label for="italic_titres">Курсивный</label>&nbsp;&nbsp;
							<input type="checkbox" id="underline_titres" name="underline_titres" onclick="apclch('titles',this.checked,'textDecoration','underline','none')" value="underline" /><label for="underline_titres">Подчёркнутый</label>
						</td>
					</tr>
					<tr>
						<td class="row_title">Выравнив.:</td>
						<td>
							<input type="radio" name="align_titres" id="align_titres_left" onclick="apcl('titles','textAlign',this.value);" value="left" /><label for="align_titres_left">По левому краю</label>&nbsp;
							<input type="radio" name="align_titres" id="align_titres_center" onclick="apcl('titles','textAlign',this.value);" value="center" checked="checked" /><label for="align_titres_center">По центру</label>&nbsp;
							<input type="radio" name="align_titres" id="align_titres_right" onclick="apcl('titles','textAlign',this.value);" value="right" /><label for="align_titres_right">По правому краю</label>
						</td>
					</tr>
					<tr>
						<td rowspan="3" class="row_title">Настройки<br />тени:</td>
						<td>
							Цвет: #<input type="text" class="input_text value" name="title_shadow" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_title_shadow.style.backgroundColor='#'+this.value; shadch('title');" size="6" maxlength="6" value="C0C0C0" />&nbsp;
							<input type="text" name="a_title_shadow" class="input_text" style="background-color: #C0C0C0;" ondblclick="jg_popicker(document.jg_form.title_shadow.value,'title_shadow')" />
							[<a class="m" href="javascript:generate(document.jg_form.title_shadow.value,'+1','+1','+1','title_shadow');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.title_shadow.value,'-1','-1','-1','title_shadow');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('title_shadow','r+')">+</a> 
							<a class="r" href="javascript:rgbch('title_shadow','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('title_shadow','g+')">+</a> 
							<a class="g" href="javascript:rgbch('title_shadow','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('title_shadow','b+')">+</a> 
							<a class="b" href="javascript:rgbch('title_shadow','b-')">–</a>]&nbsp;&nbsp;
							<input type="checkbox" id="title_shadow_no" name="title_shadow_no" onclick="shadch('title');" checked="checked" /><label for="title_shadow_no">Нет</label>
						</td>
					</tr>
					<tr>
						<td>
							Смещение по оси Х: <input type="text" class="input_text value tooltip" name="title_shadow_shiftx" onchange="shadch('title');" value="2px" size="6" maxlength="6" title="Может иметь положительное или отрицательное значение" /> 
							[<a class="p" href="javascript:sizech('title_shadow_shiftx','+',false)">+</a> 
							<a class="p" href="javascript:sizech('title_shadow_shiftx','-',false)">–</a>]&nbsp;&nbsp;
							по оси Y: <input type="text" class="input_text value tooltip" name="title_shadow_shifty" onchange="shadch('title');" value="2px" size="6" maxlength="6" title="Может иметь положительное или отрицательное значение" /> 
							[<a class="p" href="javascript:sizech('title_shadow_shifty','+',false)">+</a> 
							<a class="p" href="javascript:sizech('title_shadow_shifty','-',false)">–</a>]
						</td>
					</tr>
					<tr>
						<td>
							Размытие тени: <input type="text" class="input_text value" name="title_shadow_blur" onchange="shadch('title');" value="0px" size="6" maxlength="6"  /> 
							[<a class="p" href="javascript:sizech('title_shadow_blur','+')">+</a> 
							<a class="p" href="javascript:sizech('title_shadow_blur','-')">–</a>]
						</td>
					</tr>
					<tr>
						<td rowspan="2" class="row_title">Внутренние<br />отступы:</td>
						<td>
							Верхний: <input type="text" name="paddingTop_titres" class="input_text value" size="5" maxlength="5" onchange="apcl('titles','paddingTop',this.value);" value="15px" />
							[<a class="p" href="javascript:sizech('paddingTop_titres','+')">+</a> 
							<a class="p" href="javascript:sizech('paddingTop_titres','-')">–</a>]&nbsp;&nbsp;
							Нижний: <input type="text" name="paddingBottom_titres" class="input_text value" size="5" maxlength="5" onchange="apcl('titles','paddingBottom',this.value);" value="15px" />
							[<a class="p" href="javascript:sizech('paddingBottom_titres','+')">+</a> 
							<a class="p" href="javascript:sizech('paddingBottom_titres','-')">–</a>]
						</td>
					</tr>
					<tr>
						<td>
							Левый: <input type="text" name="paddingLeft_titres" class="input_text value" size="5" maxlength="5" onchange="apcl('titles','paddingLeft',this.value);" value="15px" />
							[<a class="p" href="javascript:sizech('paddingLeft_titres','+')">+</a> 
							<a class="p" href="javascript:sizech('paddingLeft_titres','-')">–</a>]&nbsp;&nbsp;
							Правый: <input type="text" name="paddingRight_titres" class="input_text value" size="5" maxlength="5" onchange="apcl('titles','paddingRight',this.value);" value="15px" />
							[<a class="p" href="javascript:sizech('paddingRight_titres','+')">+</a> 
							<a class="p" href="javascript:sizech('paddingRight_titres','-')">–</a>]
						</td>
					</tr>
				</table>
				</fieldset>
					
				<fieldset class="fieldset_last"><legend>Ссылка обычная</legend>
				<table>
					<tr>
						<td class="row_title">Цвет:</td>
						<td>#<input type="text" class="input_text value" name="color_link" size="6" maxlength="6" value="0000FF" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_color_link.style.backgroundColor='#'+this.value; apv('aColor','#'+this.value); apcl('links','color','#'+this.value);" />&nbsp;
						<input type="text" class="input_text" id="a_color_link" style="background-color: #0000FF;" ondblclick="jg_popicker(document.jg_form.color_link.value,'color_link')" />
						[<a class="m" href="javascript:generate(document.jg_form.color_link.value,'+1','+1','+1','color_link');">&lt;</a> 
						<a class="p" href="javascript:generate(document.jg_form.color_link.value,'-1','-1','-1','color_link');">&gt;</a>]
						[<a class="r" href="javascript:rgbch('color_link','r+')">+</a> 
						<a class="r" href="javascript:rgbch('color_link','r-')">–</a>]
						[<a class="g" href="javascript:rgbch('color_link','g+')">+</a> 
						<a class="g" href="javascript:rgbch('color_link','g-')">–</a>]
						[<a class="b" href="javascript:rgbch('color_link','b+')">+</a> 
						<a class="b" href="javascript:rgbch('color_link','b-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Стиль:</td>
						<td>
							<input type="checkbox" id="bold_link" name="bold_link" onclick="apvch('aBold',this.checked,'bold','normal'); apclch('links',this.checked,'fontWeight','bold','normal');" value="bold" /><label for="bold_link">Полужирный</label>&nbsp;&nbsp;
							<input type="checkbox" id="italic_link" name="italic_link" onclick="apvch('aItalic',this.checked,'italic','normal'); apclch('links',this.checked,'fontStyle','italic','normal');" value="italic" /><label for="italic_link">Курсивный</label>
						</td>
					</tr>
					<tr>
						<td class="row_title">Линия:</td>
						<td>
							<input type="radio" name="under_link" id="under_link_normal" onclick="apvch('aBorderStyle',this.checked,this.value,''); apclu('links');" value="normal" checked="checked" /><label for="under_link_normal">Обычная</label>&nbsp;
							<input type="radio" name="under_link" id="under_link_solid" onclick="apvch('aBorderStyle',this.checked,this.value,''); apclu('links');" value="solid" /><label for="under_link_solid">Сплошная</label>&nbsp;
							<input type="radio" name="under_link" id="under_link_dashed" onclick="apvch('aBorderStyle',this.checked,this.value,''); apclu('links');" value="dashed" /><label for="under_link_dashed">Пунктир</label>&nbsp;
							<input type="radio" name="under_link" id="under_link_dotted" onclick="apvch('aBorderStyle',this.checked,this.value,''); apclu('links');" value="dotted" /><label for="under_link_dotted">Точки</label>&nbsp;
							<input type="radio" name="under_link" id="under_link_none" onclick="apvch('aBorderStyle',this.checked,this.value,''); apclu('links');" value="none" /><label for="under_link_none">Нет</label>
						</td>
					</tr>
					<tr>
						<td class="row_title">Цвет линии:</td>
						<td>
							#<input type="text" class="input_text value" name="color_underlink" size="6" maxlength="6" value="0000FF" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_color_underlink.style.backgroundColor='#'+this.value; apv('aBorderColor','#'+this.value); apcl('links','borderBottomColor','#'+this.value);" />&nbsp;						
							<input type="text" class="input_text" id="a_color_underlink" style="background-color: #0000FF;" ondblclick="jg_popicker(document.jg_form.color_underlink.value,'color_underlink')" />
							[<a class="m" href="javascript:generate(document.jg_form.color_underlink.value,'+1','+1','+1','color_underlink');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.color_underlink.value,'-1','-1','-1','color_underlink');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('color_underlink','r+')">+</a> 
							<a class="r" href="javascript:rgbch('color_underlink','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('color_underlink','g+')">+</a> 
							<a class="g" href="javascript:rgbch('color_underlink','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('color_underlink','b+')">+</a> 
							<a class="b" href="javascript:rgbch('color_underlink','b-')">–</a>]&nbsp;&nbsp;
							<input type="text" class="input_text value tooltip" name="width_underlink" onchange="apv('aBorderWidth',this.value); apcl('links','borderBottomWidth',this.value);" value="1px" size="6" maxlength="6" title="Толщина подчёркивающей линии" /> 
							[<a class="p" href="javascript:sizech('width_underlink','+')">+</a> 
							<a class="p" href="javascript:sizech('width_underlink','-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Подсветка:</td>
						<td>
							#<input type="text" class="input_text value" name="bgcolor_link" size="6" maxlength="6" value="FFFF00" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_bgcolor_link.style.backgroundColor='#'+this.value; apv('aHighlight','#'+this.value); apcl('links','backgroundColor','#'+this.value);" />&nbsp;
							<input type="text" class="input_text" id="a_bgcolor_link" style="background-color: #FFFF00;" ondblclick="jg_popicker(document.jg_form.bgcolor_link.value,'bgcolor_link')" />
							[<a class="m" href="javascript:generate(document.jg_form.bgcolor_link.value,'+1','+1','+1','bgcolor_link');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.bgcolor_link.value,'-1','-1','-1','bgcolor_link');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('bgcolor_link','r+')">+</a> 
							<a class="r" href="javascript:rgbch('bgcolor_link','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('bgcolor_link','g+')">+</a> 
							<a class="g" href="javascript:rgbch('bgcolor_link','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('bgcolor_link','b+')">+</a> 
							<a class="b" href="javascript:rgbch('bgcolor_link','b-')">–</a>]&nbsp;&nbsp;
							<input type="checkbox" id="bgcolor_link_no" name="bgcolor_link_no" onclick="if (this.checked) { apv('aHighlight','transparent'); apcl('links','backgroundColor','transparent');  } else { apv('aHighlight','#'+document.jg_form.bgcolor_link.value); apcl('links','backgroundColor','#'+document.jg_form.bgcolor_link.value); }" checked="checked" /><label for="bgcolor_link_no">Нет</label>
						</td>
					</tr>
				</table>
				</fieldset>
			</td>
			<td width="50%">
				<fieldset class="fieldset_first"><legend>Страница</legend>
				<table>
					<tr>
						<td rowspan="2" class="row_title">Фоновый<br />цвет:</td>
						<td>
							#<input type="text" class="input_text value" name="color_dominante" size="6" maxlength="6" value="F8F8FF" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_color_dominante.style.backgroundColor='#'+this.value; apid('example','backgroundColor','#'+this.value);" />&nbsp;
							<input type="text" id="a_color_dominante" class="input_text" style="background-color: #F8F8FF;" ondblclick="jg_popicker(document.jg_form.color_dominante.value,'color_dominante')" />
							[<a class="m" href="javascript:generate(document.jg_form.color_dominante.value,'+1','+1','+1','color_dominante');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.color_dominante.value,'-1','-1','-1','color_dominante');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('color_dominante','r+')">+</a> 
							<a class="r" href="javascript:rgbch('color_dominante','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('color_dominante','g+')">+</a> 
							<a class="g" href="javascript:rgbch('color_dominante','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('color_dominante','b+')">+</a> 
							<a class="b" href="javascript:rgbch('color_dominante','b-')">–</a>]&nbsp;&nbsp;
							<input type="checkbox" id="no_color_dominante" name="no_color_dominante" onclick="if (this.checked) document.jg_form.o_color_dominante.value='0'; else document.jg_form.o_color_dominante.value='1'; apidch('example',this.checked,'backgroundColor','transparent','#'+document.jg_form.color_dominante.value)" value="transparent" /><label for="no_color_dominante">Нет</label>
						</td>
					</tr>
					<tr>						
						<td>
							Прозрачность: <input type="text" class="input_text value" name="o_color_dominante" value="1" size="3" maxlength="3" />
							[<a class="p" href="javascript:opasch('color_dominante','+','example')">+</a> 
							<a class="p" href="javascript:opasch('color_dominante','-','example')">–</a>]
						</td>
					</tr>
					<tr>
						<td rowspan="2" class="row_title">Фоновый<br />рисунок:</td>
						<td>
							<select name="back_image" class="input_text" onchange="backch('example',this.value,document.jg_form.back_repeat.value);">
							<option value="no" selected="selected">Рисунок отсутствует</option>
							<?php if ($_smarty_tpl->tpl_vars['list_images']->value) {?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['list_images']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
							<option value="<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
" class="option_image" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
);"><?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['file'];?>
</option>
							<?php endfor; endif; ?><?php }?>
							</select>&nbsp;&nbsp;
							<input type="checkbox" id="back_fixed" name="back_fixed" onclick="apidch('example',this.checked,'backgroundAttachment','fixed','scroll')" value="fixed" /><label for="back_fixed">Фиксировать</label>
						</td>
					</tr>
					<tr>
						<td>
							Повторять:&nbsp;
							<input type="radio" name="back_repeat" id="back_repeat_no" onclick="apid('example','backgroundRepeat',this.value);" value="no-repeat" checked="checked" /><label for="back_repeat_no">Нет</label>&nbsp;
							<input type="radio" name="back_repeat" id="back_repeat_xy" onclick="apid('example','backgroundRepeat',this.value);" value="repeat" /><label for="back_repeat_xy">По осям X и Y</label>&nbsp;
							<input type="radio" name="back_repeat" id="back_repeat_x" onclick="apid('example','backgroundRepeat',this.value);" value="repeat-x" /><label for="back_repeat_x">По оси X</label>&nbsp;
							<input type="radio" name="back_repeat" id="back_repeat_y" onclick="apid('example','backgroundRepeat',this.value);" value="repeat-y" /><label for="back_repeat_y">По оси Y</label>
						</td>
					</tr>
				</table>
				</fieldset>
				
				<fieldset style="padding-bottom: 13px;"><legend>Текст</legend>
				<table>
					<tr>
						<td class="row_title">Цвет:</td>
						<td>#<input type="text" class="input_text value" name="color_txt" size="6" maxlength="6" value="696969" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_color_txt.style.backgroundColor='#'+this.value; apid('example','color','#'+this.value);" />&nbsp;
						<input type="text" class="input_text" id="a_color_txt" style="background-color: #696969;" ondblclick="jg_popicker(document.jg_form.color_txt.value,'color_txt');" />
						[<a class="m" href="javascript:generate(document.jg_form.color_txt.value,'+1','+1','+1','color_txt');">&lt;</a> 
						<a class="p" href="javascript:generate(document.jg_form.color_txt.value,'-1','-1','-1','color_txt');">&gt;</a>]
						[<a class="r" href="javascript:rgbch('color_txt','r+')">+</a> 
						<a class="r" href="javascript:rgbch('color_txt','r-')">–</a>]
						[<a class="g" href="javascript:rgbch('color_txt','g+')">+</a> 
						<a class="g" href="javascript:rgbch('color_txt','g-')">–</a>]
						[<a class="b" href="javascript:rgbch('color_txt','b+')">+</a> 
						<a class="b" href="javascript:rgbch('color_txt','b-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Шрифт:</td>
						<td>
							<select name="text_font_family" class="input_text" onchange="apid('example','fontFamily',this.value);" onkeydown="apid('example','fontFamily',this.value);">
								<option value='"Arial Black","Helvetica CY","Nimbus Sans L",sans-serif'>"Arial Black","Helvetica CY","Nimbus Sans L",sans-serif</option>
								<option value='Arial,"Helvetica CY","Nimbus Sans L",sans-serif'>Arial,"Helvetica CY","Nimbus Sans L",sans-serif</option>
								<option value='"Comic Sans MS","Monaco CY",cursive'>"Comic Sans MS","Monaco CY",cursive</option>
								<option value='"Courier New","Nimbus Mono L",monospace'>"Courier New","Nimbus Mono L",monospace</option>
								<option value='Georgia,"Century Schoolbook L",serif'>Georgia,"Century Schoolbook L",serif</option>
								<option value='Impact,"Charcoal CY",sans-serif'>Impact,"Charcoal CY",sans-serif</option>
								<option value='"Lucida Console",Monaco,monospace'>"Lucida Console",Monaco,monospace</option>
								<option value='"Lucida Sans Unicode","Lucida Grande",sans-serif'>"Lucida Sans Unicode","Lucida Grande",sans-serif</option>
								<option value='"Palatino Linotype","Book Antiqua",Palatino,serif'>"Palatino Linotype","Book Antiqua",Palatino,serif</option>
								<option value='Tahoma,"Geneva CY",sans-serif'>Tahoma,"Geneva CY",sans-serif</option>
								<option value='"Times New Roman","Times CY","Nimbus Roman No9 L",serif'>"Times New Roman","Times CY","Nimbus Roman No9 L",serif</option>
								<option value='"Trebuchet MS","Helvetica CY",sans-serif'>"Trebuchet MS","Helvetica CY",sans-serif</option>
								<option value='Verdana,"Geneva CY","DejaVu Sans",sans-serif' selected="selected">Verdana,"Geneva CY","DejaVu Sans",sans-serif</option>
							</select>&nbsp;&nbsp;
							<input type="text" class="input_text value" name="text_font_size" size="4" maxlength="4" onchange="apid('example','fontSize',this.value);" value="14px" />
							[<a class="p" href="javascript:fontch('text_font_size','+')">+</a> 
							<a class="p" href="javascript:fontch('text_font_size','-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Стиль:</td>
						<td>
							<input type="checkbox" id="bold_text" name="bold_text" onclick="apidch('example',this.checked,'fontWeight','bold','normal')" value="bold" /><label for="bold_text">Полужирный</label>&nbsp;&nbsp;
							<input type="checkbox" id="italic_text" name="italic_text" onclick="apidch('example',this.checked,'fontStyle','italic','normal')" value="italic" /><label for="italic_text">Курсивный</label>&nbsp;&nbsp;
							<input type="checkbox" id="underline_text" name="underline_text" onclick="apidch('example',this.checked,'textDecoration','underline','none')" value="underline" /><label for="underline_text">Подчёркнутый</label>
						</td>
					</tr>
					<tr>
						<td class="row_title">Выравнив.:</td>
						<td>
							<input type="radio" name="align_text" id="align_text_left" onclick="apid('example','textAlign',this.value);" value="left" checked="checked" /><label for="align_text_left">По левому</label>&nbsp;
							<input type="radio" name="align_text" id="align_text_center" onclick="apid('example','textAlign',this.value);" value="center" /><label for="align_text_center">По центру</label>&nbsp;
							<input type="radio" name="align_text" id="align_text_right" onclick="apid('example','textAlign',this.value);" value="right" /><label for="align_text_right">По правому</label>&nbsp;
							<input type="radio" name="align_text" id="align_text_justify" onclick="apid('example','textAlign',this.value);" value="justify" /><label for="align_text_justify">По ширине</label>
						</td>
					</tr>					
					<tr>
						<td rowspan="3" class="row_title">Настройки<br />тени:</td>
						<td>
							Цвет: #<input type="text" class="input_text value" name="text_shadow" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_text_shadow.style.backgroundColor='#'+this.value; shadch('text');" size="6" maxlength="6" value="C0C0C0" />&nbsp;
							<input type="text" name="a_text_shadow" class="input_text" style="background-color: #C0C0C0;" ondblclick="jg_popicker(document.jg_form.text_shadow.value,'text_shadow')" />
							[<a class="m" href="javascript:generate(document.jg_form.text_shadow.value,'+1','+1','+1','text_shadow');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.text_shadow.value,'-1','-1','-1','text_shadow');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('text_shadow','r+')">+</a> 
							<a class="r" href="javascript:rgbch('text_shadow','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('text_shadow','g+')">+</a> 
							<a class="g" href="javascript:rgbch('text_shadow','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('text_shadow','b+')">+</a> 
							<a class="b" href="javascript:rgbch('text_shadow','b-')">–</a>]&nbsp;&nbsp;
							<input type="checkbox" id="text_shadow_no" name="text_shadow_no" onclick="shadch('text');" checked="checked" /><label for="text_shadow_no">Нет</label>
						</td>
					</tr>
					<tr>
						<td>
							Смещение по оси Х: <input type="text" class="input_text value tooltip" name="text_shadow_shiftx" onchange="shadch('text');" value="2px" size="6" maxlength="6" title="Может иметь положительное или отрицательное значение" /> 
							[<a class="p" href="javascript:sizech('text_shadow_shiftx','+',false)">+</a> 
							<a class="p" href="javascript:sizech('text_shadow_shiftx','-',false)">–</a>]&nbsp;&nbsp;
							по оси Y: <input type="text" class="input_text value tooltip" name="text_shadow_shifty" onchange="shadch('text');" value="2px" size="6" maxlength="6" title="Может иметь положительное или отрицательное значение" /> 
							[<a class="p" href="javascript:sizech('text_shadow_shifty','+',false)">+</a> 
							<a class="p" href="javascript:sizech('text_shadow_shifty','-',false)">–</a>]
						</td>
					</tr>
					<tr>
						<td>
							Размытие тени: <input type="text" class="input_text value" name="text_shadow_blur" onchange="shadch('text');" value="0px" size="6" maxlength="6" /> 
							[<a class="p" href="javascript:sizech('text_shadow_blur','+')">+</a> 
							<a class="p" href="javascript:sizech('text_shadow_blur','-')">–</a>]
						</td>
					</tr>
				</table>
				</fieldset>
				
				<fieldset class="fieldset_last"><legend>Ссылка при наведении мыши</legend>
				<table>
					<tr>
						<td class="row_title">Цвет:</td>
						<td>
							#<input type="text" class="input_text value" name="color_hoverlink" size="6" maxlength="6" value="FF0000" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_color_hoverlink.style.backgroundColor='#'+this.value; apv('aHColor','#'+this.value)" />&nbsp;
							<input type="text" class="input_text" id="a_color_hoverlink" style="background-color: #FF0000;" ondblclick="jg_popicker(document.jg_form.color_hoverlink.value,'color_hoverlink')" />
							[<a class="m" href="javascript:generate(document.jg_form.color_hoverlink.value,'+1','+1','+1','color_hoverlink');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.color_hoverlink.value,'-1','-1','-1','color_hoverlink');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('color_hoverlink','r+')">+</a> 
							<a class="r" href="javascript:rgbch('color_hoverlink','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('color_hoverlink','g+')">+</a> 
							<a class="g" href="javascript:rgbch('color_hoverlink','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('color_hoverlink','b+')">+</a>
							<a class="b" href="javascript:rgbch('color_hoverlink','b-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Стиль:</td>
						<td>
							<input type="checkbox" id="bold_hoverlink" name="bold_hoverlink" onclick="apvch('aHBold',this.checked,'bold','normal')" value="bold" /><label for="bold_hoverlink">Полужирный</label>&nbsp;&nbsp;
							<input type="checkbox" id="italic_hoverlink" name="italic_hoverlink" onclick="apvch('aHItalic',this.checked,'italic','normal')" value="italic" /><label for="italic_hoverlink">Курсивный</label>
						</td>
					</tr>
					<tr>
						<td class="row_title">Линия:</td>
						<td>
							<input type="radio" name="under_hoverlink" id="under_hoverlink_normal" onclick="apvch('aHBorderStyle',this.checked,this.value,'');" value="normal" checked="checked" /><label for="under_hoverlink_normal">Обычная</label>&nbsp;
							<input type="radio" name="under_hoverlink" id="under_hoverlink_solid" onclick="apvch('aHBorderStyle',this.checked,this.value,'');" value="solid" /><label for="under_hoverlink_solid">Сплошная</label>&nbsp;
							<input type="radio" name="under_hoverlink" id="under_hoverlink_dashed" onclick="apvch('aHBorderStyle',this.checked,this.value,'');" value="dashed" /><label for="under_hoverlink_dashed">Пунктир</label>&nbsp;
							<input type="radio" name="under_hoverlink" id="under_hoverlink_dotted" onclick="apvch('aHBorderStyle',this.checked,this.value,'');" value="dotted" /><label for="under_hoverlink_dotted">Точки</label>&nbsp;
							<input type="radio" name="under_hoverlink" id="under_hoverlink_none" onclick="apvch('aHBorderStyle',this.checked,this.value,'');" value="none" /><label for="under_hoverlink_none">Нет</label>
							
						</td>
					</tr>
					<tr>
						<td class="row_title">Цвет линии:</td>
						<td>
							#<input type="text" class="input_text value" name="color_underhoverlink" size="6" maxlength="6" value="FF0000" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_color_underhoverlink.style.backgroundColor='#'+this.value; apv('aHBorderColor','#'+this.value);" />&nbsp;
							<input type="text" class="input_text" id="a_color_underhoverlink" style="background-color: #FF0000;" ondblclick="jg_popicker(document.jg_form.color_underhoverlink.value,'color_underhoverlink');" />
							[<a class="m" href="javascript:generate(document.jg_form.color_underhoverlink.value,'+1','+1','+1','color_underhoverlink');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.color_underhoverlink.value,'-1','-1','-1','color_underhoverlink');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('color_underhoverlink','r+')">+</a> 
							<a class="r" href="javascript:rgbch('color_underhoverlink','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('color_underhoverlink','g+')">+</a> 
							<a class="g" href="javascript:rgbch('color_underhoverlink','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('color_underhoverlink','b+')">+</a> 
							<a class="b" href="javascript:rgbch('color_underhoverlink','b-')">–</a>]&nbsp;&nbsp;
							<input type="text" class="input_text value tooltip" name="width_underhoverlink" onchange="apv('aHBorderWidth',this.value);" value="1px" size="6" maxlength="6" title="Толщина подчёркивающей линии" /> 
							[<a class="p" href="javascript:sizech('width_underhoverlink','+')">+</a> 
							<a class="p" href="javascript:sizech('width_underhoverlink','-')">–</a>]
						</td>
					</tr>
					<tr>
						<td class="row_title">Подсветка:</td>
						<td>
							#<input type="text" class="input_text value" name="bgcolor_hoverlink" size="6" maxlength="6" value="00FF00" onchange="this.value=this.value.toUpperCase(); document.jg_form.a_bgcolor_hoverlink.style.backgroundColor='#'+this.value; apv('aHHighlight','#'+this.value)" />&nbsp;
							<input type="text" class="input_text" id="a_bgcolor_hoverlink" style="background-color: #00FF00;" ondblclick="jg_popicker(document.jg_form.bgcolor_hoverlink.value,'bgcolor_hoverlink')" />
							[<a class="m" href="javascript:generate(document.jg_form.bgcolor_hoverlink.value,'+1','+1','+1','bgcolor_hoverlink');">&lt;</a> 
							<a class="p" href="javascript:generate(document.jg_form.bgcolor_hoverlink.value,'-1','-1','-1','bgcolor_hoverlink');">&gt;</a>]
							[<a class="r" href="javascript:rgbch('bgcolor_hoverlink','r+')">+</a> 
							<a class="r" href="javascript:rgbch('bgcolor_hoverlink','r-')">–</a>]
							[<a class="g" href="javascript:rgbch('bgcolor_hoverlink','g+')">+</a> 
							<a class="g" href="javascript:rgbch('bgcolor_hoverlink','g-')">–</a>]
							[<a class="b" href="javascript:rgbch('bgcolor_hoverlink','b+')">+</a> 
							<a class="b" href="javascript:rgbch('bgcolor_hoverlink','b-')">–</a>]&nbsp;&nbsp;
							<input type="checkbox" id="bgcolor_hoverlink_no" name="bgcolor_hoverlink_no" onclick="if (this.checked) apv('aHHighlight','transparent'); else  apv('aHHighlight','#'+document.jg_form.bgcolor_hoverlink.value);" checked="checked" /><label for="bgcolor_hoverlink_no">Нет</label>
						</td>
					</tr>
				</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2" id="td_example">
				<div id="example">
					<div class="titles">Отказ от собственности</div>
					Однажды ученик спросил Благословенного: «Как понять исполнение заповеди отказа от собственности? Один ученик покинул все вещи, но Учитель продолжал упрекать его в собственности. Другой оставался в окружении вещей, но не заслужил упрёка».
					«Чувство собственности измеряется не вещами, но мыслями. Можно иметь вещи и не быть собственником».
					<a class="links" href="#">Будда</a> постоянно советовал иметь возможно меньше вещей, чтобы не отдавать им слишком много времени.
					
					<div class="titles">Семь слуг</div>
					Вот мы пошлём семь слуг на базар принести виноград. Что видим? Первый утерял деньги. Второй променял их на хмельное вино. Третий утаил их. Четвёртый не распознал зелёный виноград. Пятый, пробуя зрелость, раздавил всю ветку. Шестой отобрал умело, но толкнул и рассыпал по неосторожности. Седьмой принёс спелую ветвь и нашёл листья, чтобы украсить ветку.
					Так <a class="links" href="#">семеро</a> прошли одною дорогой и в одно время.
				</div>
			</td>
		</tr>
		</table>
	</form>
	</div> <!-- #create_styles_dialog -->
<?php }?><?php }} ?>
