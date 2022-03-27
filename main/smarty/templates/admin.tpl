<div id="top_panel">
	<ul id="user_list">
		<li>
			<div class="menu_item_non_hover caption"><b><span id="landkit">LandKit</span></b><div id="user_arrow"></div></div>
			<ul>
				<li class="hover"><a class="caption" href="index.php?page=account">Мой&nbsp;кабинет</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				<li class="hover"><a class="caption" href="index.php?page=colors">Цветовые&nbsp;схемы</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>
				{if $is_superadmin && $is_server}<li class="hover"><a class="caption" href="index.php?page=updates">Обновление</a></li>
				<li><div class="line_horiz">&nbsp;</div></li>{/if}
				<li class="hover"><a class="caption" href="index.php?page=journal">Журнал{if $errors_count}&nbsp;<sup>{$errors_count}</sup>{/if}</a></li>
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
		{if $is_admin}<li><a class="menu_item{if $page eq 'templates'} active{/if}" href="index.php?page=templates">Шаблоны</a>
			<ul>
				<li style="padding: 5px; white-space: nowrap;">					
					Выбран шаблон:<br />{if $template_title}<a class="driver" href="index.php?page=templates&amp;type={$template_id}">{$template_title}</a>{else}<i>нет</i>{/if}
				</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>{/if}
		<li><a class="menu_item{if $page eq 'pages'} active{/if}" href="index.php?page=pages">Страницы</a>
			<ul>
				<li style="padding: 5px; white-space: nowrap;">					
					Выбрана страница:<br />{if $page_name}<a class="driver" href="index.php?page=pages&amp;type={$page_id}">{$page_name}</a>{else}<i>нет</i>{/if}
				</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item{if $page eq 'blocks'} active{/if}" href="index.php?page=blocks">Блоки</a>
		{if $page_blocks}
			<ul>
			{foreach $page_blocks as $page_block}
				<li class="hover" style="white-space: nowrap;"><a class="caption" {if $page_block.status eq "0"}style="color: grey;"{/if} href="{$page_block.menu_link}">{$page_block.menu_title}</a></li>
				{if $page_block@last}{else}<li><div class="line_horiz">&nbsp;</div></li>{/if}
			{/foreach}
			</ul>
		{/if}
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item{if $page eq 'images'} active{/if}" href="index.php?page=images">Графика</a></li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item{if $page eq 'forms'} active{/if}" href="index.php?page=forms">Формы</a>
		{if $page_forms}
			<ul>
			{foreach $page_forms as $page_form_id => $page_form_title}
				<li class="hover" style="white-space: nowrap;"><a class="caption" href="index.php?page=forms&amp;type={$page_form_id}">{$page_form_title}</a></li>
				{if $page_form_title@last}{else}<li><div class="line_horiz">&nbsp;</div></li>{/if}
			{/foreach}
			</ul>
		{/if}
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item{if $page eq 'visitors'} active{/if}" href="index.php?page=visitors">Посетители{if $visitors_online}&nbsp;<sup>{$visitors_online}</sup>{/if}</a>
			<ul>
				<li style="padding: 5px;">На сайте:<br />{$visitors_online} посетителя(ей)</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item{if $page eq 'orders'} active{/if}" href="index.php?page=orders">Заявки{if $orders_new_count} <sup>{$orders_new_count}</sup>{/if}</a>
			<ul>
				<li style="padding: 5px;">Новых:<br />{$orders_new_count} заявок</li>
			</ul>
		</li>
		<li><div class="line_vert">&nbsp;</div></li>
		<li><a class="menu_item{if $page eq 'settings'} active{/if}" href="index.php?page=settings">Настройки</a>
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
		<li><a class="menu_item" id="link_view" href="javascript:void(0);" target="_blank" onclick="return openSite('{$page}', '{$type}', '{$url}');">Просмотр</a></li>
		<li><div class="line_vert">&nbsp;</div></li>
	</ul>
</div> <!-- #top_panel -->
<div id="center_panel">
{if $page eq "account"}
<form action="index.php?page={$page}&amp;type={$type}" method="post" name="account_form">
	<div class="content" id="account">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Мой кабинет</div>
		<div class="tabs">
			<a class="caption tab_first{if $type eq 'data'} active_tab{/if}" href="index.php?page={$page}&amp;type=data">Данные</a><a class="caption{if $type eq 'pass'} active_tab{/if}" href="index.php?page={$page}&amp;type=pass">Смена&nbsp;пароля</a>{if $is_admin}<a class="caption{if $type eq 'list'} active_tab{/if}" href="index.php?page={$page}&amp;type=list">Пользователи</a>{/if}
		</div>
		<table class="main_table">
		{if $type eq "data"}
			<tr>
				<th>Логин</th>
				<th>Имя</th>
				<th>Электронная почта</th>
			</tr>
			<tr>
				<td><input type="text" class="input_text tooltip" name="user_login" value="{$user_login}" title="Логин может состоять из латинских букв, цифр, тире и знака  подчёркивания" /></td>
				<td><input type="text" class="input_text tooltip" name="user_name" value="{$user_name}" title="Имя может состоять из латинских или русских букв, цифр, тире и знака подчёркивания" /></td>
				<td><input type="text" class="input_text tooltip" name="user_email" value="{$user_email}" title="Электронная почта должна быть введена" /></td>          
			</tr>
			<tr>
				<td colspan="3"><input type="checkbox" id="show_error" name="show_error"{if $show_error}checked="checked"{/if} /><label for="show_error">Показывать только сообщения об ошибке</label></td>
			</tr>
			<tr>
				<th colspan="3" class="border_top"><input type="submit" name="save_account" class="button_submit" value="Сохранить" /></th>
			</tr>
		{/if}
		{if $type eq "pass"}
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
		{/if}
		{if $type eq "list"}
			<tr>
				<th width="32%">Логин</th>
				<th width="32%">Имя</th>
				<th width="32%">Электронная почта</th>
				<th width="4%">&nbsp;</th>
			</tr>
		{if $users}
			{section name=i loop=$users}
			<tr>
				<td style="text-align: center;">{$users[i].login}</td>
				<td style="text-align: center;">{$users[i].name}</td>
				<td style="text-align: center;">{$users[i].email}</td>
				<td style="text-align: center;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','{$users[i].id}');" title="Удалить запись о пользователе"> X </a></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="4" class="no_rows">Пользователей нет</td>
			</tr>
		{/if}
			<tr>
				<th colspan="4" class="border_top"><input type="button" name="create_user" class="button_submit" onclick="createUser();" value="Добавить" /></th>
			</tr>
		{/if}
		</table>
	</div> <!-- #account -->
</form>
{/if} {* if $page eq "account" *}
{if $page eq "colors"}
	<div class="content" id="colors">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Цветовые схемы</div>
		<form action="index.php?page={$page}&amp;type={$type}" method="post" name="colors_form">
		<table class="main_table">
			<tr>
				<th colspan="4">
					Выберите цветовую схему:&nbsp;&nbsp;
					<select name="name" class="input_text" style="width: 200px;" onchange="window.location='index.php?page=colors&amp;type='+this.value;">
				{if $schemes}
					{section name=i loop=$schemes}
					<option value="{$schemes[i].id}"{if $schemes[i].id eq $scheme.id} selected{/if}>{$schemes[i].title}</option>
					{/section}
				{/if}
					</select>
				</th>
			</tr>
			<tr>
				<td width="23%">Основной цвет надписей и заголовков, рамок панелей</td>
				<td width="27%" style="line-height: 52px;"><input type="text" id="main-color" name="main-color" class="input_text iColorPicker" value="{$scheme['main-color']}" /></td>
				<td width="23%">Цвет фона верхней панели, фона заголовков таблиц</td>
				<td width="27%" style="line-height: 52px;"><input type="text" id="back-color" name="back-color" class="input_text iColorPicker" value="{$scheme['back-color']}" /></td>
			</tr>
			<tr>
				<td>Цвет текста</td>
				<td style="line-height: 52px;"><input type="text" id="text-color" name="text-color" class="input_text iColorPicker" value="{$scheme['text-color']}" /></td>
				<td>Цвет ссылок</td>
				<td style="line-height: 52px;"><input type="text" id="link-color" name="link-color" class="input_text iColorPicker" value="{$scheme['link-color']}" /></td>
			</tr>
			<tr>
				<td>Цвет шрифта предупреждающих сообщений</td>
				<td style="line-height: 52px;"><input type="text" id="info-color" name="info-color" class="input_text iColorPicker" value="{$scheme['info-color']}" /></td>
				<td>Цвет шрифта сообщений об ошибках, символов-кнопок</td>
				<td style="line-height: 52px;"><input type="text" id="error-color" name="error-color" class="input_text iColorPicker" value="{$scheme['error-color']}" /></td>
			</tr>
			<tr>
				<td>Цвет шрифта сообщений об успешном выполнении операции, символов-кнопок</td>
				<td style="line-height: 52px;"><input type="text" id="success-color" name="success-color" class="input_text iColorPicker" value="{$scheme['success-color']}" /></td>
				<td>Цвет надписей на кнопках и во всплывающих окне и подсказках</td>
				<td style="line-height: 52px;"><input type="text" id="bright-color" name="bright-color" class="input_text iColorPicker" value="{$scheme['bright-color']}" /></td>
			</tr>
			<tr>
				<td>Цвет фона выделенных пунктов меню, фона активной вкладки, подсветки строки таблицы</td>
				<td style="line-height: 52px;"><input type="text" id="back-acive-color" name="back-acive-color" class="input_text iColorPicker" value="{$scheme['back-acive-color']}" /></td>
				<td>Цвет рамок элементов, основа фона кнопок и всплывающих подсказок</td>
				<td style="line-height: 52px;"><input type="text" id="border-input-color" name="border-input-color" class="input_text iColorPicker" value="{$scheme['border-input-color']}" /></td>
			</tr>
			<tr>
				<td>Цвет рамок изображений, тени надписей и тени панелей</td>
				<td style="line-height: 52px;"><input type="text" id="shadow-color" name="shadow-color" class="input_text iColorPicker" value="{$scheme['shadow-color']}" /></td>
				<td>Цвет заднего фона страницы, фона элементов ввода</td>
				<td style="line-height: 52px;"><input type="text" id="back-input-color" name="back-input-color" class="input_text iColorPicker" value="{$scheme['back-input-color']}" /></td>
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
					Установлена цветовая схема: «{$active_scheme_title}»
				</td>
			</tr>
			<tr>
				<th colspan="4" class="border_top">
					<input type="hidden" name="scheme_id" value="{$scheme.id}" />
					<input type="hidden" name="scheme_title" value="{$scheme.title}" />
					<input type="submit" name="apply_scheme" class="button_submit" value="Установить выбранную схему" />
				</th>
			</tr>
		</table>
		</form>
	</div> <!-- #colors -->
<script type="text/javascript">{literal}
$(document).ready(function() {
	$('.iColorPicker').jPicker({window: {position: {x: 'center', y: '45px'}, updateInputColor: false}});
});{/literal}
</script>
{/if} {* if $page eq "colors" *}
{if $page eq "journal"}
	<div class="content" id="journal">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Журнал ошибок</div>
		<table class="main_table">
		{if $type eq "logs"}
			<tr>
				<th width="5%">№</th>
				<th width="10%">Дата</th>
				<th width="45%">Сообщение</th>
				<th width="40%">Данные</th>
			</tr>
		{if $logs}
			{section name=i loop=$logs}
			<tr{if $view_id eq $logs[i].id} style="font-weight: bold;"{/if}>
				<td style="text-align: center;">{$logs[i].id}</td>
				<td style="padding: 20px 5px;">{$logs[i].date_time}</td>
				<td style="text-align: left; word-break: break-all;">{$logs[i].text}</td>
				<td style="text-align: left; word-break: break-all;">{$logs[i].data}</td>
			</tr>
			{/section}
			{if $paginator}
			<tr>
				<th colspan="4" class="border_top">{$paginator}</th>
			</tr>
			{/if}
		{else}
			<tr>
				<td colspan="4" class="no_rows">Записей нет</td>
			</tr>
		{/if}
			<tr>
				<th colspan="4" class="border_top"><input type="button" name="clear_logs" class="button_submit" onclick="confirmDialog('clear_logs');" value="Очистить" /></th>
			</tr>
		{/if}
		</table>	
	</div> <!-- #journal -->
{/if} {* if $page eq "journal" *}
{if $page eq "updates"}
	<div class="content" id="updates">
	{if $is_superadmin && $is_server}
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Обновление конструктора на клиентских сайтах</div>
		<form action="index.php?page={$page}" method="post" name="{$page}_form">
		<table class="main_table">
			<tr>
				<th width="5%">№</th>
				<th width="10%">Дата установки</th>
				<th width="25%">Описание сайта</th>	
				<th width="30%">Адрес сайта</th>
				<th width="25%">Заметки</th>
				<th width="5%">&nbsp;</th>
			</tr>
		{if $sites}
			{section name=i loop=$sites}
			<tr>
				<td style="text-align: center;">{$sites[i].id}</td>
				<td style="text-align: center;">{$sites[i].date}</td>
				<td style="text-align: center;">{$sites[i].site_title}</td>	
				<td style="text-align: center;">
					{$sites[i].site_name}
					<br />
					<a class="driver link_go" href="{$sites[i].site_name}" onclick="this.target='_blank'">Сайт</a>
					<a class="driver link_go" href="{$sites[i].site_name}main/index.php" onclick="this.target='_blank'">Конструктор</a></td>
				<td style="text-align: center;">{$sites[i].notes}</td>	
				<td style="text-align: center;"><input type="checkbox" name="is-update-{$sites[i].id}" id="is-update-{$sites[i].id}"{if $sites[i].is_update eq 1} checked="checked" value="1"{else} value="0"{/if} onclick="if (this.checked) this.value='1'; else this.value='0';" /><label class="without_text tooltip" title="Включить/выключить<br />обновление для сайта" for="is-update-{$sites[i].id}">&nbsp;</label></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="6" class="no_rows">Сайтов нет</td>
			</tr>
		{/if}
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
				<td colspan="6">Введите дату изменения файлов:&nbsp;&nbsp;<input type="text" class="input_text tooltip" style="width: 80px;" name="date_update" value="{$date_update}" onfocus="this.select(); lcs(this);" onclick="event.cancelBubble=true; this.select(); lcs(this);" title="Исходные файлы конструктора с датой изменения, старше указанной, будут отправлены на выбранные клиентские сайты" /><br /><br />
				
				<table class="install_table_inner files_updated_table">
				<tr>
					<th colspan="4">Файлы для обновления ({count($files_updated)}):</th>
				</tr>
			{if $files_updated}
				{section name=j loop=$files_updated}
				<tr>
					<td>{$files_updated[j].show}</td>
					<td>{$files_updated[j].dir}</td>
					<td>{$files_updated[j].name}</td>
					<td style="width: 70px;"><input type="checkbox" name="is-send-{$files_updated[j].id}" id="is-send-{$files_updated[j].id}" checked="checked" value="1" onclick="if (this.checked) this.value='1'; else this.value='0';" /><label class="without_text" for="is-send-{$files_updated[j].id}">&nbsp;</label></td>
				</tr>
				{/section}
			{else}
				<tr>
					<td colspan="4" class="no_rows">Файлов нет</td>
				</tr>
			{/if}
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
	{else}
		<br /><br />
		<div class="no_rows">Нет прав для просмотра данной страницы</div>
	{/if}
	</div> <!-- #updates -->
{/if} {* if $page eq "updates" *}
{if $page eq "templates"}
	<div class="content" id="templates">
{if $is_admin}
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Список шаблонов</div>
		<div class="tabs">
			<a class="caption first_tab{if $type eq 'all'} active_tab{/if}" href="index.php?page=templates&amp;type=all">Все шаблоны</a>{if $type ne 'all'}<a class="caption active_tab" href="index.php?page=templates&amp;type={$type}">{$template.caption}</a>{/if}{if $is_superadmin}<a class="caption" href="index.php?page=templates&amp;type={$type}&amp;action=create_template">Новый шаблон</a>{/if}
		</div>
	{if $type eq "all"}
		<table class="main_table">
			<tr>
				<th width="5%">&nbsp;</th>
				<th width="15%">Название</th>
				<th width="15%">Каталог</th>
				<th width="40%">Описание</th>
				<th width="20%">Изображение</th>				
				<th width="5%">&nbsp;</th>
			</tr>
		{if $templates}
			{section name=i loop=$templates}
			<tr>
				<td style="padding: 10px 0px;"><input type="radio" id="radio-{$templates[i].id}" {if $templates[i].status eq 1} checked="checked"{/if} onclick="window.location='index.php?page=templates&amp;type=all&amp;action=choose&amp;id={$templates[i].id}';" /><label class="tooltip" title="Выбрать шаблон" for="radio-{$templates[i].id}">&nbsp;</label></td>
				<td><a class="driver" href="index.php?page=templates&amp;type={$templates[i].id}">{$templates[i].title}</a></td>
				<td>{$templates[i].catalog}</td>
				<td>{$templates[i].description}</td>
				<td>{if $templates[i].image}<a class="fancybox" rel="group" href="/templates/{$templates[i].catalog}/{$templates[i].image}"><img class="template_big" src="/templates/{$templates[i].catalog}/{$templates[i].image}" alt="Изображение" /></a>{/if}</td>				
				<td style="padding: 10px 0px;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','{$templates[i].id}');" title="Удалить шаблон">&nbsp;X&nbsp;</a></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="6" class="no_rows">Шаблонов нет</td>
			</tr>
		{/if}
		</table>
	{else}
	<script type="text/javascript" src="scripts/ZeroClipboard.js"></script>
	<script type="text/javascript">{literal}
		$(document).ready(function() {
			var client = new ZeroClipboard($(".copy_images"));
		});
	</script>{/literal}
		<table class="main_table">
			<tr>
				<th width="25%">Название</th>
				<th width="25%">Каталог</th>
				<th width="35%">Описание</th>
				<th width="10%">Изображение</th>				
				<th width="5%">&nbsp;</th>
			</tr>
			<tr>
				<td><input type="text" class="input_text" name="title" value="{$template.title}" /></td>
				<td><input type="text" class="input_text" name="catalog" value="{$template.catalog}" /></td>
				<td><textarea class="input_text" name="description">{$template.description}</textarea></td>
				<td>{if $template.image}<a class="fancybox" rel="group" href="/templates/{$template.catalog}/{$template.image}" title="{$template.title}"><img src="/templates/{$template.catalog}/{$template.image}" alt="Изображение" class="template" /></a>{else}&nbsp;{/if}</td>				
				<td style="padding: 10px 0px;"><form class="upload_form" action="index.php?page=templates&amp;type={$type}&amp;action=load_image" method="post" enctype="multipart/form-data"><div class="icon_plus">&nbsp;+&nbsp;</div><input type="file" name="uploadfile" class="upload_file tooltip" onchange="sitesMan.onImageUpload(event,this);return false;" accept="image/*" title="Загрузить изображение" /></form></td>
			</tr>			
			<tr>
				<th colspan="5" class="border_top">CSS медиа-запросы</th>
			</tr>
		{foreach $layouts as $layout}
			<tr>
				<td><input type="text" class="input_text layout tooltip" name="layout-title-{$layout.id}" value="{$layout.title}" title="Название css медиа-запроса<br />для отображения в css табах" /></td>
				<td colspan="2"><textarea class="input_text tooltip" name="layout-text-{$layout.id}" title="Заголовок css медиа-запроса в виде комментария и команды @media<br />без фигурных скобок">{$layout.text}</textarea></td>				
				<td><table class="table_arrows"><tr><td><input type="text" class="input_text short_input tooltip" name="layout-sort-{$layout.id}" value="{$layout.sort}" title="Порядок следования css медиа-запроса<br />в конечном файле стилей сайта" /></td><td style="padding-top: 25px;"><a class="icon_arrows" href="index.php?page={$page}&amp;type={$type}&amp;action=move_up&amp;id={$layout.id}">&nbsp;ˆ&nbsp;</a><br /><a class="icon_arrows" href="index.php?page={$page}&amp;type={$type}&amp;action=move_down&amp;id={$layout.id}">&nbsp;ˇ&nbsp;</a></td></tr></table></td>
				<td><a class="icon_delete tooltip" href="javascript:confirmDialog('delete_layout','{$layout.id}');" title="Удалить css медиа-запрос">&nbsp;X&nbsp;</a></td>
			</tr>
		{/foreach}
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
						<table class="small_table styles_table"{if !$styles} style="width: 100%;"{/if}>
						{if $styles}
						{foreach $styles as $style}
							{if ($style@iteration eq 1) or (($style@iteration - 1) is div by 3)}
							<tr>
							{/if}
								<td><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="${$style.name}" /><span class="copy_name">${$style.name}</span></td>
								<td>= <input type="text" class="input_text" name="style-{$style.id}" value="{$style.value}" /></td><td>&nbsp;&nbsp;</td>
							{if $style@iteration is div by 3}
							</tr>
							{/if}
						{/foreach}
						{else}
							<tr><td class="no_rows" style="text-align: center;">CSS-переменных нет</td></tr>
						{/if}
						</table>
						<div class="styles_actions">
							<a href="javascript:addStyle();" class="tooltip" title="Добавить css-переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить css-переменную" /></a>
							<a href="javascript:saveStyles();" class="tooltip" title="Сохранить значения css-переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения css-переменных" /></a>
							<a href="javascript:deleteStyle();" class="tooltip" title="Удалить css-переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить css-переменную" /></a>						
						</div>
					</div>
					<ul id="css_nav">{foreach $layouts as $layout}<li><a class="caption" href="#css-tab-{$layout.id}">{$layout.caption}</a></li>{/foreach}</ul>
					<div id="css_tabs">
					{foreach $layouts as $layout}
						<p id="css-tab-{$layout.id}"><textarea class="input_text code" name="css-{$layout.id}">{$layout.template_csstext}</textarea></p>
					{/foreach}
					</div>
				</td>
			</tr>
		{if $is_superadmin && $is_server}
			<tr>
				<td colspan="5" class="border_top">
					<input type="checkbox" id="install_to_client" name="install_to_client" onclick="$('#install_block').slideToggle('quick'); if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="install_to_client">Установить конструктор с этим шаблоном на сайт</label>
					<div id="install_block" style="display: none; text-align: center;">
						<div class="install_template_block">Перед установкой конструктора:<br />
1. на хостинге нового сайта внесите IP адрес сервера 79.174.64.19: MySQL Management => имя_базы => Access Hosts<br />
2. на ftp-сервере нового сайта задайте полные права доступа 777 папке, в которую будет установлен конструктор
						</div>
						<div class="install_template_block">Для установки на сайт все поля должны быть заполнены</div>
<script type="text/javascript">{literal}
	function getIP(site) {
		if (site != '') {
			site = site.replace(/http\:\/\//, '');
			$.getJSON('getip.php?site='+site, function(data){
				$("#site_ip").val(data.ip);
			});
		}
	}
</script>{/literal}
						Выберите сайт для установки:&nbsp;&nbsp;
						<select name="site_name" class="input_text" style="width: 200px;" onchange="window.location='index.php?page={$page}&amp;type={$type}&amp;site_id=' + this.value;">
							<option value="0">Новый сайт</option>
					{if $sites}
						{section name=i loop=$sites}
							<option value="{$sites[i].id}"{if $sites[i].id eq $site.id} selected{/if}>{$sites[i].site_name}</option>
						{/section}
					{/if}
						</select>
						<br /><br /><br />
						<input type="hidden" name="site_id" value="{$site.id}" />
						Описание сайта:&nbsp;&nbsp;&nbsp;<input type="text" class="input_text tooltip" name="site_title" style="width: 300px; margin-bottom: 5px;" value="{$site.site_title}" title="Краткое описание сайта для таблицы сайтов для обновления" /><br />
						URL адрес сайта: <input type="text" class="input_text tooltip" name="site_name" style="width: 300px; margin-bottom: 5px;" value="{$site.site_name}" title="Полный URL-адрес сайта, например, http://www.mysite.ru/" onblur="getIP(this.value);" /><br />
						IP&nbsp;&nbsp;адрес&nbsp;&nbsp;сайта:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="input_text tooltip" name="site_ip" id="site_ip" style="width: 300px;" value="{$site.site_ip}" title="IP адрес сайта можно узнать на ru.siteipaddr.com" />
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
											<td><input type="text" class="input_text tooltip" name="ftp_server" value="{$site.ftp_server}" title="URL-адрес для входа на ftp-сервер сайта, например, webvertex.ru" /></td>
										</tr>
										<tr>
											<td>каталог:</td>
											<td><input type="text" class="input_text tooltip" name="ftp_folder" value="{$site.ftp_folder}" title="Полный путь, начиная от корня,<br />к каталогу для установки конструктора, например, domains/webvertex.ru/public_html/lp"/></td>
										</tr>
										<tr>
											<td>логин:</td>
											<td><input type="text" class="input_text" name="ftp_user" value="{$site.ftp_user}" /></td>
										</tr>
										<tr>
											<td>пароль:</td>
											<td><input type="text" class="input_text" name="ftp_pass" value="{$site.ftp_pass}" /></td>
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
											<td><input type="text" class="input_text" name="db_host" value="{$site.db_host}" /></td>
										</tr>
										<tr>
											<td>название:</td>
											<td><input type="text" class="input_text" name="db_name" value="{$site.db_name}" /></td>
										</tr>
										<tr>
											<td>логин:</td>
											<td><input type="text" class="input_text" name="db_user" value="{$site.db_user}" /></td>
										</tr>
										<tr>
											<td>пароль:</td>
											<td><input type="text" class="input_text" name="db_pass" value="{$site.db_pass}" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<div class="install_template_block"><input type="checkbox" name="forbidden_full_rights" id="forbidden_full_rights"{if $site.forbidden_full_rights eq 1} checked="checked"{/if} /><label for="forbidden_full_rights">На хостинге установлено ограничение на запуск скриптов с правами 777</label></div>
						<input type="button" name="install_template" class="button_submit" value="Установить" onclick="submitForm('install_template','{$template.id}');" />
					</div>
				</td>
			</tr>
		{/if}
			<tr>
				<th colspan="5" class="border_top">
					<input type="hidden" name="form_action" id="form_action" />
					<input type="button" name="save_template" class="button_submit button_long" value="Сохранить и обновить сайт" onclick="submitForm('save_template','{$template.id}');" />
				</th>
			</tr>
		</table>
	{/if}
{else}
		<br /><br />
		<div class="no_rows">Нет прав для просмотра данной страницы</div>
{/if}
	</div> <!-- #templates -->
{/if} {* if $page eq "templates" *}
{if $page eq "pages"}
	<div class="content" id="pages">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Страницы шаблона «{$template_title}»</div>
		<div class="tabs">
			<a class="caption first_tab{if $type eq 'all'} active_tab{/if}" href="index.php?page=pages&amp;type=all">Все страницы</a>{if $type ne 'all'}<a class="caption active_tab" href="index.php?page=pages&amp;type={$type}">{$site_page.caption}</a>{/if}<a class="caption" href="javascript:createPage();">Новая страница</a>
		</div>
	{if $type eq "all"}
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
		{if $pages}
			{section name=i loop=$pages}
			<tr>
				<td style="padding: 10px 0px;"><input type="radio" id="radio-{$pages[i].id}" {if $pages[i].status eq 1} checked="checked"{/if} onclick="window.location='index.php?page=pages&amp;type=all&amp;action=choose&amp;id={$pages[i].id}';" /><label class="tooltip" title="Выбрать страницу" for="radio-{$pages[i].id}">&nbsp;</label></td>
				<td><a class="driver" href="index.php?page=pages&amp;type={$pages[i].id}">{$pages[i].name}</a></td>
				<td>{$pages[i].file}</td>
				<td>{$pages[i].title}</td>
				<td><input type="checkbox" id="checkbox-visible-{$pages[i].id}" {if $pages[i].visible eq 1} checked="checked"{/if} onclick="window.location='index.php?page=pages&amp;type=all&amp;action=change_visibility&amp;id={$pages[i].id}';" /><label class="without_text tooltip" title="Изменить видимость страницы" for="checkbox-visible-{$pages[i].id}">&nbsp;</label></td>
				<td><input type="checkbox" id="checkbox-scrollable-{$pages[i].id}" {if $pages[i].scrollable eq 1} checked="checked"{/if} onclick="window.location='index.php?page=pages&amp;type=all&amp;action=change_scrollability&amp;id={$pages[i].id}';" /><label class="without_text tooltip" title="Изменить способ создания страницы" for="checkbox-scrollable-{$pages[i].id}">&nbsp;</label></td>
				<td style="padding: 10px 0px;"><a class="icon_edit tooltip" href="javascript:doublePage({$pages[i].id});" title="Дублировать страницу">&nbsp;D&nbsp;</a><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','{$pages[i].id}');" title="Удалить страницу">&nbsp;X&nbsp;</a></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="7" class="no_rows">Страниц нет</td>
			</tr>
		{/if}
		</table>
	{else}
	{if $is_admin}
	<script type="text/javascript" src="scripts/ZeroClipboard.js"></script>
	<script type="text/javascript">{literal}
		$(document).ready(function() {
			var client = new ZeroClipboard($(".copy_images"));
		});
	</script>{/literal}
	{/if}
		<table class="main_table">
			<tr>
				<th>Настройки страницы</th>
			</tr>
			<tr>
				<td style="padding-bottom: 15px;">
					<table width="100%">
						<tr>
							<td style="width: 50%; border-top: none; padding: 10px 0 0 0; vertical-align: top;"><span class="caption">Название:</span>&nbsp;&nbsp;<input type="text" style="width: 80%;" class="input_text tooltip" name="name" title="Название страницы может состоять из латинских и русских букв, цифр, тире, точки, запятой и скобок" value="{$site_page.name}" /></td>
							<td style="width: 50%; border-top: none; padding: 10px 0 0 0; vertical-align: top;"><span class="caption">Имя файла:</span>&nbsp;&nbsp;<input type="text" style="width: 80%;" class="input_text tooltip" name="file" title="Если файлы страниц должны находиться в разных папках, введите полный внутренний путь с названием и расширением файла .php, иначе  только название файла (без расширения)" value="{$site_page.file}" /></td>
						</tr>
					</table>
					<div style="text-align: center; margin-bottom: 20px;">
						<input type="checkbox" name="delete_inactive" id="delete_inactive" {if $site_page.delete_inactive eq 1}checked="checked"{/if} /><label for="delete_inactive">Удалять файл страницы, если страница отключена</label>
					</div>
					<div id="favicon_info">{if $site_page.favicon}Установлена иконка: <img src="{$site_page.favicon}" alt="" />{else}Иконка отсутствует{/if}</div>
					<form action="index.php?page=pages&amp;type={$type}" name="upload_form" method="post" class="upload_form button_submit" enctype="multipart/form-data">
					{if $site_page.favicon}
						<div>Заменить</div>
					{else}
						<div>Загрузить</div>
					{/if}
						<input type="file" name="uploadfile" class="upload_file" onchange="sitesMan.onFaviconUpload(event,this);return false;" accept="image/x-icon" />
					</form>
				{if $site_page.favicon}
					<input type="button" name="favicon_delete" class="button_submit" value="Удалить" onclick="confirmDialog('delete_favicon');" />
				{/if}
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
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Заголовок:&nbsp;&nbsp;<input type="text" class="input_text" name="title" value="{$site_page.title}" style="width: 90%;" /></div></td>
						</tr>
						<tr>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Описание</div>
								<textarea class="input_text" name="meta_description" style="height: 100px;">{$site_page.meta_description}</textarea></td>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Ключевые слова</div>
								<textarea class="input_text" name="meta_keywords" style="height: 100px;">{$site_page.meta_keywords}</textarea></td>
						</tr>
					</table>
				</td>
			</tr>
		{if $is_admin}
			<tr>
				<th class="border_top">Переменные страницы</th>
			</tr>
			<tr>
				<td>
					<div id="variables_block">
						<table class="small_table styles_table" style="width: 100%; display: block; margin-bottom: 20px;">
					{if $variables}
						{foreach $variables as $variable}
							{if ($variable@iteration eq 1) or (($variable@iteration - 1) is div by 2)}
							<tr>
							{/if}
								<td style="width: 50%; text-align: left; padding-right: 10px;"><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="${$variable.name}" /><span class="copy_name">${$variable.name}</span><br />
								<textarea class="input_text" style="margin-top: 5px; width: 480px !important;" name="variable-{$variable.id}">{$variable.value}</textarea></td>
							{if $variable@iteration is div by 2}
							</tr>
							{/if}
						{/foreach}
					{else}
							<tr><td class="no_rows" style="text-align: center;">Переменных нет</td></tr>
					{/if}
						</table>
						<div class="styles_actions">
							<a href="javascript:addVariable();" class="tooltip" title="Добавить переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить переменную" /></a>
							<a href="javascript:saveVariables();" class="tooltip" title="Сохранить значения переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения переменных" /></a>
							<a href="javascript:deleteVariable();" class="tooltip" title="Удалить переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить переменную" /></a>						
						</div>
					</div>
				</td>
			</tr>
		{/if}
			<tr>
				<th class="border_top">Содержимое страницы</th>
			</tr>
			<tr>
				<td style="text-align: left;">
					<div class="caption tooltip link_title" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=defaults" class="setting_link">Тип документа</a></div>
					<select name="doctype" class="input_text">				
				{if $doctypes}{section name=i loop=$doctypes}
					<option value="{$doctypes[i]}"{if $site_page.doctype eq $doctypes[i]} selected="selected"{/if}>{$doctypes[i]}</option>
				{/section}{/if}
					</select><br /><br />
			{if $scripts}
					<div class="caption tooltip link_title" style="margin-bottom: 5px;" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=scripts" class="setting_link">Включение скриптов</a></div>
					<div id="div_scripts">
				{section name=i loop=$scripts}
						<span style="white-space: nowrap;"><input type="checkbox" id="script-{$scripts[i].id}" name="script-{$scripts[i].id}" onclick="if (this.checked) this.value='1'; else this.value='0';" {if $scripts[i].status eq 1}checked="checked" value="1"{else}value="0"{/if} /><label class="label_scripts tooltip" title="{$scripts[i].description}" for="script-{$scripts[i].id}">{$scripts[i].name|capitalize}</label></span>
				{/section}
					</div>
			{/if}
					<br />
					<div class="caption link_title tooltip" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=defaults" class="setting_link">Код секции head</a></div>
					<textarea class="input_text code redactor" name="head">{$site_page.head}</textarea>
					<br /><br />
					<div class="caption link_title tooltip" title="Перейти к редактированию предустановки"><a href="index.php?page=settings&amp;type=defaults" class="setting_link">Код секции body</a></div>
					<textarea class="input_text code redactor" name="body">{$site_page.body}</textarea>
				</td>
			</tr>
			<tr>
				<th class="border_top">
					<input type="hidden" name="form_action" value="save_page" />
					<input type="button" name="save_page" class="button_submit button_long" value="Сохранить и обновить сайт" onclick="submitForm('save_page', {$site_page.id});" />
				</th>
			</tr>
			<tr>
				<th class="border_top">
					<input type="button" name="select_form" class="button_submit long_button tooltip" value="Добавить форму" onclick="promptSelectDialog('select_form','{$type}');" title="Выбор формы из имеющихся<br />и вставка её html-кода и css-правил в секции body и head страницы.<br />После добавления формы страница сохраняется." />
				</th>
			</tr>
			
		</table>
	{/if}
	</div> <!-- #pages -->
{/if} {* if $page eq "pages" *}
{if $page eq "blocks"}
	<div class="content" id="blocks">
		<input type="hidden" name="form_action" id="form_action" />
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">{if $is_prototypes eq "no"}Блоки шаблона «{$template_title}» страницы «{$page_name}»{else}{if $is_superadmin}Блоки-прототипы{else}&nbsp;{/if}{/if}</div>
		<div class="tabs">
			<a class="caption first_tab{if $type eq 'all'} active_tab{/if}" href="index.php?page=blocks&amp;type=all">Все блоки</a>{if $type ne 'all' and $type ne 'prototypes'}<a class="caption active_tab" href="index.php?page=blocks&amp;type={$type}">{$block_title}</a>{/if}{if $is_superadmin}<a class="caption{if $type eq 'prototypes'} active_tab{/if}" href="index.php?page=blocks&amp;type=prototypes">Прототипы</a>{/if}<a class="caption" href="index.php?page=blocks&amp;action=create_block"{if !$is_admin} style="visibility: hidden;"{/if} onclick="submitForm('create_block','{$type}');return false;">Новый блок</a>
		</div>
{if $type eq "all" or $type eq "prototypes"}
	{if $type eq "prototypes"}
<script type="text/javascript">{literal}
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
</script>{/literal}
		<table class="main_table">
			<tr>
			{if $is_global_save}
				<th width="5%"><input type="checkbox" id="server-all" name="server-all" onclick="setChecked(this.checked);" /><label class="without_text tooltip" for="server-all" title="Поставить все галочки для сохранения на сервере">&nbsp;</label></th>
				<th width="30%">Название</th>
				<th width="15%">Файл</th>
				<th width="45%">Описание</th>
			{else}
				<th width="30%">Название</th>
				<th width="15%">Файл</th>
				<th width="50%">Описание</th>
			{/if}
				<th width="5%">&nbsp;</th>
			</tr>
{if $is_superadmin}
	{if $blocks}
			{section name=i loop=$blocks}
			<tr>
			{if $is_global_save}
				<td>
					<input class="server_checkboxes" type="checkbox" id="server-{$blocks[i].id}" name="server-{$blocks[i].id}" onclick="if (this.checked) isServer='server_yes'; else isServer='server_no';" /><label class="without_text tooltip" for="server-{$blocks[i].id}" title="Дублировать действие над блоком-прототипом на сервере">&nbsp;</label>
				</td>
			{/if}
				<td><a class="driver" href="index.php?page=blocks&amp;type={$blocks[i].id}">{$blocks[i].title}</a></td>
				<td>{$blocks[i].file}</td>
				<td><textarea class="input_text" name="desc-{$blocks[i].id}">{$blocks[i].description}</textarea></td>
				<td style="padding: 10px 0px;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','{$blocks[i].id}', isServer);" title="Удалить блок-прототип">&nbsp;X&nbsp;</a></td>
			</tr>
			{/section}
			<tr>
				<th colspan="{if $is_global_save}5{else}4{/if}" class="border_top">
					<input type="button" name="save_descs" class="button_submit" value="Сохранить" onclick="submitForm('save_descs','{$type}');" /></th>
			</tr>
	{else}
			<tr>
				<td colspan="{if $is_global_save}5{else}4{/if}" class="no_rows">Блоков-прототипов нет</td>
			</tr>
	{/if}
{else}
			<tr>
				<td colspan="4" class="no_rows">Блоки недоступны для просмотра</td>
			</tr>
{/if}
		</table>
	{/if}
	{if $type eq "all"}
		<table class="main_table">
			<tr>
			{if $is_admin}
				<th width="25%">Страница</th>
				<th width="25%">Название</th>
				<th width="25%">Файл</th>
			{else}
				<th width="35%">Страница</th>
				<th width="40%">Название</th>
			{/if}
				<th width="10%">Порядок</th>
				<th width="10%">Видимость</th>
				<th width="5%">&nbsp;</th>
			</tr>
		{if $blocks}
			{section name=i loop=$blocks}		
			<tr>
				<td><a class="driver" href="index.php?page=pages&amp;type={$blocks[i].page_id}">{$blocks[i].page_name}</a></td>
				<td><a class="driver" href="index.php?page=blocks&amp;type={$blocks[i].id}">{$blocks[i].title}</a></td>
				{if $is_admin}<td>{$blocks[i].file}</td>{/if}
				<td style="padding: 0px 10px;"><table class="table_arrows"><tr><td><input type="text" class="input_text short_input" id="sort-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}" name="sort-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}" value="{$blocks[i].sort}" /></td><td style="padding-top: 25px;"><a class="icon_arrows" href="javascript:change_sort('sort-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}','-');">&nbsp;ˆ&nbsp;</a><br /><a class="icon_arrows" href="javascript:change_sort('sort-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}','+');">&nbsp;ˇ&nbsp;</a></td></tr></table></td>
				<td><input type="checkbox" id="status-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}" name="status-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}" {if $blocks[i].status eq 1}checked="checked"{/if}/><label class="without_text" for="status-{if $blocks[i].mirror eq 1}{$blocks[i].mirror_id}{else}{$blocks[i].id}{/if}">&nbsp;</label></td>
				<td style="padding: 10px 0px;"><a class="icon_edit tooltip" {if $blocks[i].mirror eq 1}href="index.php?page=blocks&amp;type=all&amp;action=double_mirror&amp;id={$blocks[i].mirror_id}"{else}href="javascript:submitForm('double_block','{$blocks[i].id}','{$blocks[i].file}');"{/if} title="Дублировать блок">&nbsp;D&nbsp;</a><a class="icon_delete tooltip" href="javascript:confirmDialog('delete',{if $blocks[i].mirror eq 1}'{$blocks[i].mirror_id}','mirror'{else}'{$blocks[i].id}'{/if});" title="Удалить блок">&nbsp;X&nbsp;</a></td>
			</tr>
			{/section}		
			<tr>
				<th colspan="{if $is_admin}6{else}5{/if}" class="border_top">
					<input type="button" name="save_sorts" class="button_submit" value="Сохранить и обновить сайт" onclick="submitForm('save_sorts','{$type}');" /></th>
			</tr>
		{else}
			<tr>
				<td colspan="{if $is_admin}6{else}5{/if}" class="no_rows">Блоков нет</td>
			</tr>
		{/if}
		</table>
	{/if}
{else}
	{if $is_admin}
	<script type="text/javascript" src="scripts/ZeroClipboard.js"></script>
	<script type="text/javascript">{literal}
		$(document).ready(function() {
			var client = new ZeroClipboard($(".copy_images"));
		});
	</script>{/literal}
	{/if}
		<table class="main_table">
			<tr>
			{if $is_admin}
				<th width="25%">Название</th>
				<th width="20%">Переменная</th>
			{else}
				<th width="45%">Название</th>
			{/if}
				<th width="50%">Содержимое</th>
				<th width="5%"></th>
			</tr>
{if $block_title ne ""}
{if $is_prototypes eq "no" or ($is_prototypes eq "yes" and $is_superadmin)}
		{if $strings}
			{section name=i loop=$strings}
			<tr>
			{if $is_admin}
				<td><input type="text" class="input_text" name="title-{$strings[i].id}" value="{$strings[i].title}" /></td>
				<td><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="&#123;$string-{$strings[i].id}&#125;" />&#123;<span class="copy_name">$string-{$strings[i].id}</span>&#125;</td>
			{else}
				<td>{$strings[i].title}</td>
			{/if}
				<td><textarea class="input_text{if $strings[i].is_image} short_width{/if}" name="content-{$strings[i].id}">{$strings[i].content}</textarea>{if $strings[i].is_image}<table class="table_image"><tr><td><a class="fancybox" rel="group" href="{$strings[i].content}"><img class="image_strings" src="{$strings[i].content}" alt="Фото" /></a></td></tr></table>{/if}</td>
				<td style="padding: 0;"><form action="index.php?page=blocks&amp;type={$type}&amp;action=load_image&amp;id={$strings[i].id}" method="post" class="upload_form" enctype="multipart/form-data"><img class="get_picture" src="styles/load_picture01.png" /><input type="file" name="uploadfile" class="upload_file tooltip" onchange="sitesMan.onImageUpload(event,this);return false;" accept="image/*" title="Загрузить изображение со своего компьютера" /></form>
				<a class="tooltip" href="javascript:promptSelectDialog('select_image','{$strings[i].id}');" title="Выбрать изображение из списка имеющихся файлов"><img class="get_picture" src="styles/open_picture01.png" /></a></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="{if $is_admin}4{else}3{/if}" class="no_rows">Текстовых фрагментов нет</td>
			</tr>
		{/if}
		{if $is_admin}
			<tr>
				<th colspan="4" class="border_top">
					<input type="button" name="add_string" class="button_submit" value="Добавить строковую константу" onclick="submitForm('add_string','{$type}');" /></th>
			</tr>
			<tr>
				<th colspan="4" class="border_top">HTML-код блока</th>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left;">
					<a onclick="$('#variables_block').slideToggle('quick');" href="javascript:void(0);"><span class="caption styles_title tooltip" title="Показать/скрыть блок переменных страницы">Переменные страницы</span></a>
					<div id="variables_block" style="display: none;">
						<table class="small_table styles_table" style="width: 100%;">
					{if $variables}
						{foreach $variables as $variable}
							{if ($variable@iteration eq 1) or (($variable@iteration - 1) is div by 2)}
							<tr>
							{/if}
								<td style="width: 50%; text-align: left; padding-right: 10px;">
									<img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="${$variable.name}" />
									<span class="copy_name">${$variable.name}</span>
									<br />
									<textarea class="input_text" style="margin-top: 5px; width: 480px !important;" name="variable-{$variable.id}">{$variable.value}</textarea></td>
							{if $variable@iteration is div by 2}
							</tr>
							{/if}
						{/foreach}
					{else}
							<tr><td class="no_rows" style="text-align: center;">Переменных нет</td></tr>
					{/if}
						</table>
						<div class="styles_actions" style="margin: 10px 0;">
							<a href="javascript:addVariable();" class="tooltip" title="Добавить переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить переменную" /></a>
							<a href="javascript:saveVariables();" class="tooltip" title="Сохранить значения переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения переменных" /></a>
							<a href="javascript:deleteVariable();" class="tooltip" title="Удалить переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить переменную" /></a>						
						</div>
					</div>
					<textarea class="input_text code redactor" name="block_code">{$block_code}</textarea></td>
			</tr>
			<tr>
				<th colspan="4" class="border_top">CSS-правила блока</th>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left;">
					<a onclick="$('#styles_block').slideToggle('quick');" href="javascript:void(0);"><span class="caption styles_title tooltip" title="Показать/скрыть блок css-переменных">CSS-переменные</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:createStyles();"><span class="caption styles_title tooltip" title="Настроить параметры текста, заголовков и ссылок">Настройки текста</span></a>
					<div id="styles_block" style="display: none;">
						<table class="small_table styles_table"{if !$styles} style="width: 100%;"{/if}>
						{if $styles}
						{foreach $styles as $style}
							{if ($style@iteration eq 1) or (($style@iteration - 1) is div by 3)}
							<tr>
							{/if}
								<td><img class="copy_images" src="styles/copy.png" alt="Копирование в буфер" data-clipboard-text="${$style.name}" /><span class="copy_name">${$style.name}</span></td><td>= <input type="text" class="input_text" name="style-{$style.id}" value="{$style.value}" />&nbsp;</td><td>&nbsp;&nbsp;</td>
							{if $style@iteration is div by 3}
							</tr>
							{/if}
						{/foreach}
						{else}
							<tr><td class="no_rows" style="text-align: center;">CSS-переменных нет</td></tr>
						{/if}
						</table>
					{if $is_prototypes eq "no"}
						<div class="styles_actions">
							<a href="javascript:addStyle();" class="tooltip" title="Добавить css-переменную"><img class="styles_buttons" src="styles/copy_add.png" alt="Добавить css-переменную" /></a>
							<a href="javascript:saveStyles();" class="tooltip" title="Сохранить значения css-переменных"><img class="styles_buttons" src="styles/copy_save.png" alt="Сохранить значения css-переменных" /></a>
							<a href="javascript:deleteStyle();" class="tooltip" title="Удалить css-переменную"><img class="styles_buttons" src="styles/copy_delete.png" alt="Удалить css-переменную" /></a>
						</div>
					{/if}
					</div>
					<ul id="css_nav">{foreach $layouts as $layout}<li><a class="caption tooltip" href="#css-tab-{$layout.id}" title="{$layout.hint}">{$layout.caption}</a></li>{/foreach}</ul>
					<div id="css_tabs">
					{foreach $layouts as $layout}
						<p id="css-tab-{$layout.id}"><textarea class="input_text code" name="css_code-{$layout.id}">{$layout.block_csstext}</textarea></p>
					{/foreach}
					</div>
				</td>
			</tr>
			{if $page_scrollable}
			<tr>
				<th colspan="4" class="border_top">
					SEO-параметры блока</th>
			</tr>
			<tr>
				<td colspan="4">
					<table width="100%">
						<tr>
							<td style="border-top: none; padding: 0 0 0 10px;" colspan="2">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Заголовок:&nbsp;&nbsp;<input type="text" class="input_text" name="meta_title" value="{$meta_title}" style="width: 90%;" /></div></td>
						</tr>
						<tr>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Описание</div>
								<textarea class="input_text" name="meta_description" style="height: 100px;">{$meta_description}</textarea></td>
							<td style="border-top: none; padding: 0 10px;">
								<div class="caption" style="text-align: left; margin-bottom: 5px;">Ключевые слова</div>
								<textarea class="input_text" name="meta_keywords" style="height: 100px;">{$meta_keywords}</textarea></td>
						</tr>
					</table>
				</td>
			</tr>
			{/if}
		{/if}
		{if $is_global_save && $is_prototypes eq "yes"}
			<tr>
				<td colspan="{if $is_admin}4{else}3{/if}" class="border_top">
					<input type="checkbox" id="save_to_server" name="save_to_server" onclick="$('#server_block').slideToggle('quick'); if (this.checked) this.value='yes'; else this.value='no';" value="no" /><label for="save_to_server">Сохранить данные блока-прототипа на сервере</label>
					<div id="server_block" style="display: none; padding-top: 10px; text-align: center;">
<script type="text/javascript">{literal}
	$(document).ready(function() {
		var col, el;
		$("input.server_radio").click(function() {
		   el = $(this);
		   col = el.data("col");
		   $("input[data-col=" + col + "]").prop("checked", false);
		   el.prop("checked", true);
		});
	});
</script>{/literal}
					Укажите для каждого css медиа-запроса на клиентском сайте, в какой css медиа-запрос на сервере его сохранить:<br /><br />
					<table class="server_table">
					{foreach $layouts as $layout}
						<tr>
							<td>{$layout.title}</td>
							<td>
							<input type="radio" class="server_radio" id="layout_server_{$layout.id}_none" name="layout_client_{$layout.id}" value="layout_server_none" checked="checked" /><label for="layout_server_{$layout.id}_none" style="margin-bottom: 5px;">Нет</label><br />
							{foreach $layouts_server as $layout_server}
							<input type="radio" class="server_radio" id="layout_server_{$layout.id}_{$layout_server.id}" name="layout_client_{$layout.id}" value="layout_server_{$layout_server.id}" data-col="{$layout_server@iteration}" /><label for="layout_server_{$layout.id}_{$layout_server.id}" style="margin-bottom: 5px;">{$layout_server.title}</label><br />{/foreach}</td>
						</tr>
					{/foreach}
					</table>
					</div>
				</td>
			</tr>
		{/if}
			<tr>
				<th colspan="{if $is_admin}4{else}3{/if}" class="border_top">
					<input type="button" name="save_block" class="button_submit" value="Сохранить{if $is_prototypes eq 'no'} и обновить сайт{/if}" onclick="submitForm('save_block','{$type}');" /></th>
			</tr>
			<tr>
				<th colspan="{if $is_admin}4{else}3{/if}" class="border_top">
					<input type="button" class="button_submit long_button tooltip" value="Переименовать блок" title="Переименование названия блока<br />и/или имени его файла.<br />Если нужно переименовать только одно из названий, второе впишите прежним" onclick="submitForm('rename_block','{$type}','{$block_file}');" />{if $is_admin}&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="parse_block" class="button_submit long_button tooltip" value="Разобрать блок" onclick="submitForm('parse_block','{$type}');" title="Выбор из кода блока текстовых строк и путей к изображениям. Текстовое содержимое любого элемента, имеющего класс string, будет заменено созданной для него строковой константой" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="select_form" class="button_submit long_button tooltip" value="Добавить форму" onclick="promptSelectDialog('select_form','{$type}');" title="Выбор формы из имеющихся<br />и вставка её html-кода и css-правил в блок.<br />После добавления формы блок сохраняется." />{/if}</th>
			</tr>
{else}
	{if $is_prototypes eq "yes" and !$is_superadmin}
			<tr>
				<td colspan="{if $is_admin}4{else}3{/if}" class="no_rows">Блок недоступен для просмотра</td>
			</tr>
	{/if}
{/if}
{else}
			<tr>
				<td colspan="{if $is_admin}4{else}3{/if}" class="no_rows">Блок не найден</td>
			</tr>
{/if}
		</table>
{/if}
	</div> <!-- #blocks -->
{/if} {* if $page eq "blocks" *}
{if $page eq "forms"}
<form action="index.php?page={$page}&amp;type={$type}" method="post" name="{$page}_form">
	<div class="content" id="forms">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Формы обратной связи</div>
		<div class="tabs">
			<a class="caption first_tab{if $type eq 'all'} active_tab{/if}" href="index.php?page=forms&amp;type=all">Все формы</a>{if $type ne 'all'}<a class="caption active_tab" href="index.php?page=forms&amp;type={$type}">{$form.caption}</a>{/if}<a class="caption" href="index.php?page=forms&amp;type=new" onclick="createForm();return false;"{if !$is_admin} style="visibility: hidden;"{/if}>Новая форма</a>
		</div>
	{if $type eq 'all'}
		<table class="main_table">
			<tr>
				<th width="5%">№</th>				
				<th width="50%">Название</th>				
				<th width="20%">Модальность</th>
				<th width="20%">Видимость</th>
				<th width="5%">&nbsp;</th>
			</tr>
		{if $forms}
			{section name=i loop=$forms}
			<tr>
				<td>{$forms[i].id}</td>
				<td><a class="driver" href="index.php?page=forms&amp;type={$forms[i].id}">{$forms[i].title}</a></td>
				<td><input type="checkbox" id="checkbox-modal-{$forms[i].id}" {if $forms[i].modal eq 1} checked="checked"{/if} onclick="window.location='index.php?page=forms&amp;type=all&amp;action=change_modal&amp;id={$forms[i].id}';" /><label class="without_text" for="checkbox-modal-{$forms[i].id}">&nbsp;</label></td>
				<td><input type="checkbox" id="checkbox-visible-{$forms[i].id}" {if $forms[i].status eq 1} checked="checked"{/if} onclick="window.location='index.php?page=forms&amp;type=all&amp;action=change_status&amp;id={$forms[i].id}';" /><label class="without_text" for="checkbox-visible-{$forms[i].id}">&nbsp;</label></td>
				<td style="padding: 10px 0px;"><a class="icon_delete tooltip" href="javascript:confirmDialog('delete','{$forms[i].id}');" title="Удалить форму">&nbsp;X&nbsp;</a></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="5" class="no_rows">Форм нет</td>
			</tr>
		{/if}
		</table>
	{else}
		<table class="main_table">
			<tr>
				<th width="30%">Название формы</th>
				<th width="70%">Ссылка для открытия формы</th>
			</tr>
			<tr>
				<td><input type="text" class="input_text" name="title" value="{$form.title}" /></td>
				<td><input type="text" class="input_text" name="link"  value="{$form.link}" /></td>
			</tr>
			<tr>
				<th colspan="2" class="border_top">HTML-код формы</th>
			</tr>
			<tr>
				<td colspan="2"><textarea class="input_text code redactor" name="html">{$form.html}</textarea></td>
			</tr>
			<tr>
				<th colspan="2" class="border_top">CSS-правила формы</th>
			</tr>
			<tr>
				<td colspan="2"><textarea class="input_text code" name="css">{$form.css}</textarea></td>
			</tr>
			<tr>
				<th colspan="2" class="border_top"><input type="submit" name="save_form" class="button_submit" value="Сохранить" /></th>
			</tr>
		</table>
	{/if}
	</div> <!-- #forms -->
</form>
{/if} {* if $page eq "forms" *}
{if $page eq "images"}
	<div class="content" id="images">
	{if $type ne "all"}
		<form action="index.php?page={$page}&amp;type={$type}" method="post" name="{$page}_form">
	{/if}
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Графика шаблона «{$template_title}»</div>
		<div class="tabs">
			<a class="caption width109 tab_first{if $type eq "all"} active_tab{/if}" href="index.php?page=images&amp;type=all">Все файлы</a><a class="caption width109{if $type eq "files"} active_tab{/if}" href="index.php?page=images&amp;type=files">files</a><a class="caption width109{if $type eq "images"} active_tab{/if}" href="index.php?page=images&amp;type=images">images</a>{section name=i loop=$catalogs}{if $catalogs[i].name ne 'images'}<a class="caption{if $type eq $catalogs[i].name} active_tab{/if}" href="index.php?page=images&amp;type={$catalogs[i].name}">{$catalogs[i].title}</a>{/if}{/section}<a class="caption width109"  href="index.php?page=images&amp;action=create_folder" onclick="promptFolderDialog('create_folder');return false;">Новая папка</a>
		</div>
		<table class="main_table"{if $type ne "all"} id="first_table"{/if}>
			<tr>
			{if $type eq "all"}
				<th width="15%">Папка</th>
				<th width="20%">Название</th>
			{else}
				<th width="35%">Название</th>
			{/if}
				<th width="50%">Изображение</th>
				<th width="10%">Дата изменения</th>
				<th width="5%">&nbsp;</th>
			</tr>
		{if $images}
			{section name=i loop=$images}
			<tr>
			{if $type eq "all"}
				<td><a class="driver" href="index.php?page=images&amp;type={$images[i].folder}">{$images[i].folder}</a></td>
				<td>{$images[i].file}</td>
			{else}
				<td><input type="text" class="input_text tooltip" name="image-{$images[i].id}" value="{$images[i].file}" title="Для сохранения переименованного названия нажмите кнопку «Сохранить»" /></td>
			{/if}
				<td><a class="fancybox" rel="group" href="{$images[i].url}" title="{$images[i].file}"><img {if $type eq "all"}class="small" {/if}src="{$images[i].src}" alt="Изображение" /></a></td>
				<td>{$images[i].time}</td>
				<td style="padding: 10px 3px;">{if $images[i].folder ne "files"}<a class="icon_edit tooltip" style="font-size: 18px;" href="javascript:promptFileDialog('move_file','{$images[i].file}','{$images[i].folder}');" title="Переместить файл<br />в другую папку">&nbsp;&#8658;&nbsp;</a>{/if}<a class="icon_delete tooltip" href="javascript:confirmFileDialog('delete_file','{$images[i].file}','{$images[i].folder}');" title="Удалить файл">&nbsp;X&nbsp;</a></td>
			</tr>
			{/section}
		{else}
			<tr>
				<td colspan="{if $type eq 'all'}5{else}4{/if}" class="no_rows">Файлов нет</td>
			</tr>
		{/if}
		{if $type ne "all"}
			<tr>
				<th colspan="{if $type eq 'all'}5{else}4{/if}" class="border_top"><input type="submit" name="save_names" class="button_submit" value="Сохранить" /></th>
			</tr>
		</table>
		</form>
		<table class="main_table" id="second_table">
			<tr>
				<th><form action="index.php?page={$page}&amp;type={$type}" method="post" class="upload_form button_submit" enctype="multipart/form-data"><div id="icon_load_photo">Загрузить файл</div><input type="file" name="uploadfile" class="upload_file long_button" onchange="sitesMan.{if $type eq 'files'}onFileUpload{else}onImageUpload{/if}(event, this); return false;" accept="{if $type ne 'files'}image/{/if}*" /></form></th>
			</tr>
			{if $type ne "images" && $type ne "files"}
			<tr>
				<th class="border_top"><input type="button" class="button_submit long_button" value="Переименовать папку" onclick="promptFolderDialog('rename_folder');" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button_submit long_button" value="Удалить папку" onclick="confirmDialog('delete_folder');" /></th>
			</tr>
			{/if}
		</table>
		{else}
		</table>
		{/if}
	</div> <!-- #images -->
{/if} {* if $page eq "images" *}
{if $page eq "visitors"}
<form action="index.php?page=visitors&amp;type={$type}" method="post" id="visitors_form" name="visitors_form">
	<div class="content" id="visitors">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Посетители сайта</div>
		<div class="tabs">
			<a class="caption tab_first{if $type eq 'stat'} active_tab{/if}" href="index.php?page=visitors&amp;type=stat">Статистика</a><a class="caption{if $type eq 'refer'} active_tab{/if}" href="index.php?page=visitors&amp;type=refer">Реферреры</a><a class="caption{if $type eq 'list'} active_tab{/if}" href="index.php?page=visitors&amp;type=list">Список</a>
		</div>
		<div id="online_count">Посетителей на сайте: {$visitors_online}</div>
		<table class="main_table">
	{if $type eq "stat"}
			<tr>
				<th>Статистика посещений по дням</th>
			</tr>
			<tr>
				<td style="text-align: center;">
				{if $line1}<div id="chart1"></div>
					<div id="customTooltipDays">&nbsp;</div>
					<br />{$link_backwards} {$link_center|capitalize} {$link_forwards}<br />
				{else}
					<span style="font-style: italic;">Посещений нет</span>
				{/if}
					
<script type="text/javascript">{literal}
$(document).ready(function(){{/literal}
	var line1 = [{$line1}];
	var line2 = [{$line2}];{literal}
	var plot1 = $.jqplot('chart1', [line1], {
		animate: false,
		axes: {
			xaxis: {{/literal}
				min: '{$date_first}',
				max: '{$date_last}',{literal}
				renderer: $.jqplot.DateAxisRenderer,
				tickOptions: {formatString: '%d.%m'},
				tickInterval: '2 day',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			},
			yaxis: {
				min: 0,
				max: {/literal}{$max_days}{literal},
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
				max: {/literal}{$max_months}{literal},
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
</script>{/literal}
				</td>
			</tr>
			<tr>
				<th class="border_top">Статистика посещений по месяцам</th>
			</tr>
			<tr>
				<td style="text-align: center;">
				{if $line2}
					<div id="chart2"></div>
					<div id="customTooltipMonths">&nbsp;</div>
				{else}
					<span style="font-style: italic;">Посещений нет</span>
				{/if}
				</td>
			</tr>
			<tr>
				<th class="border_top">&nbsp;</th>
			</tr>
			<tr>
				<td class="border_top">
					<input type="checkbox" id="show_yandex" name="show_yandex"{if $show_yandex} checked="checked"{/if} onclick="var value='no'; if (this.checked) value='yes'; window.location='index.php?page=visitors&amp;type=stat&amp;action=show_yandex&amp;value='+value;" /><label for="show_yandex" style="margin-top: 10px;">Отображать посещения робота Яндекса ({$count_yandex} посещений за {$link_center}, {$count_total_yandex} всего)</label><br />
					<input type="checkbox" id="show_google" name="show_google"{if $show_google} checked="checked"{/if} onclick="var value='no'; if (this.checked) value='yes'; window.location='index.php?page=visitors&amp;type=stat&amp;action=show_google&amp;value='+value;" /><label for="show_google" style="margin-top: 10px;">Отображать посещения робота Гугла ({$count_google} посещений за {$link_center}, {$count_total_google} всего)</label>
					<input type="checkbox" id="show_bots" name="show_bots"{if $show_bots} checked="checked"{/if} onclick="var value='no'; if (this.checked) value='yes'; window.location='index.php?page=visitors&amp;type=stat&amp;action=show_bots&amp;value='+value;" /><label for="show_bots" style="margin-top: 10px;">Отображать посещения остальных роботов ({$count_bots} посещений за {$link_center}, {$count_total_bots} всего)</label></td>
			</tr>
	{/if}
	{if $type eq "refer"}
			<tr>
				<th width="25%">&nbsp;</th>
				<th width="25%">Название сайта-реферрера</th>
				<th width="25%">Количество переходов с него</th>
				<th width="25%">&nbsp;</th>
			</tr>
		{if $referrers}
			{if $paginator}
			<tr>
				<th colspan="4" class="border_top">{$paginator}</th>
			</tr>
			{/if}
			{section name=j loop=$referrers}
			<tr>
				<td>&nbsp;</td>
				<td>{$referrers[j].url}</td>
				<td>{$referrers[j].count}</td>
				<td>&nbsp;</td>
			</tr>
			{/section}
			{if $paginator}
			<tr>
				<th colspan="4" class="border_top">{$paginator}</th>
			</tr>
			{/if}
		{else}
			<tr>
				<td colspan="4" class="no_rows">Сайтов-реферреров нет</td>
			</tr>
		{/if}
	{/if}
	{if $type eq "list"}
			<tr>
				<th width="5%">Дата</th>
				<th width="15%">Город</th>
				<th width="15%">Примечание</th>
				<th width="15%">Запрос</th>
				<th width="25%">Ссылающаяся страница</th>
				<th width="25%">Идентификатор браузера</th>
			</tr>
		{if $visitors}
			{if $paginator}
			<tr>
				<th colspan="6" class="border_top">{$paginator}</th>
			</tr>
			{/if}
			{section name=i loop=$visitors}
			<tr{if $visitors[i].online} style="font-weight: bold;"{/if}>
				<td class="break_word">{$visitors[i].date}</td>
				<td class="break_word"><a class="driver tooltip" title="{$visitors[i].ip_address}" href="http://speed-tester.info/ip_location.php?ip={$visitors[i].ip_address}" onclick="this.target='_blank';">{if $visitors[i].city|strpos:"<" === false}{$visitors[i].city}{else}{$visitors[i].ip_address}{/if}</a></td>
				<td class="break_word">{$visitors[i].note}</td>
				<td class="break_all" style="font-size: 12px;">{$visitors[i].request}</td>
				<td class="break_all" style="font-size: 12px;">{$visitors[i].referrer}</td>
				<td class="break_all" style="font-size: 12px;">{$visitors[i].user_agent}</td>
			</tr>
			{/section}
			{if $paginator}
			<tr>
				<th colspan="6" class="border_top">{$paginator}</th>
			</tr>
			{/if}
		{else}
			<tr>
				<td colspan="6" class="no_rows">Посетителей нет</td>
			</tr>
		{/if}
			<tr>
				<th colspan="6" class="border_top"><input type="button" name="clear_list" class="button_submit" onclick="confirmDialog('clear_list');" value="Очистить список" /></th>
			</tr>
			<tr>
				<td colspan="6">
					<input type="checkbox" id="enable_visitors_db" name="enable_visitors_db"{if $enable_visitors_db} checked="checked"{/if} /><label class="tooltip" for="enable_visitors_db" title="{$enable_visitors_hint}" style="margin: 5px 0;">{$enable_visitors_title}</label><br />
					{$visitors_per_page_title} <select name="visitors_per_page" class="input_text tooltip" title="{$visitors_per_page_hint}" style="width: 70px;">
						<option{if $visitors_per_page eq 20} selected="selected"{/if} value="20">20</option>
						<option{if $visitors_per_page eq 50} selected="selected"{/if} value="50">50</option>
						<option{if $visitors_per_page eq 100} selected="selected"{/if} value="100">100</option>
						<option{if $visitors_per_page eq 200} selected="selected"{/if} value="200">200</option>
						<option{if $visitors_per_page eq 500} selected="selected"{/if} value="500">500</option>
					</select><br />
					{$minutes_visitor_title} <input type="text" class="input_text short_input tooltip" id="minutes_visitor_online" name="minutes_visitor_online" value="{$minutes_visitor_online}" title="{$minutes_visitor_hint}" style="margin-bottom: 5px;" />
					</td>
			</tr>
			<tr>
				<th colspan="6" class="border_top"><input type="submit" name="submit_save_settings" class="button_submit" value="Сохранить настройки" /></th>
			</tr>
	{/if}
		</table>
	</div> <!-- #visitors -->
</form>
{/if} {* if $page eq "visitors" *}
{if $page eq "orders"}
	<div class="content" id="orders">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Список заявок</div>
		<div class="tabs">
			<a class="caption tab_first{if $type eq 'new'} active_tab{/if}" href="index.php?page=orders&amp;type=new">Новые</a><a class="caption{if $type eq 'old'} active_tab{/if}" href="index.php?page=orders&amp;type=old">Архив</a><a class="caption{if $type eq 'all'} active_tab{/if}" href="index.php?page=orders&amp;type=all">Все заявки</a><a class="caption{if $type eq 'errors'} active_tab{/if}" href="index.php?page=orders&amp;type=errors">Журнал</a>
		</div>
		{if $type ne "errors"}<div id="orders_count">Всего заявок: {count($orders)}</div>{/if}
		<table class="main_table">
	{if $type ne "errors"}
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
		{if $orders}
			{assign var="number" value=1}
			{section name=i loop=$orders}
			<tr style="font-weight: {if $orders[i].status eq 0}bold{else}normal{/if};">          
				<td>{$orders[i].date}</td>
				<td>{$orders[i].form}</td>
				<td>{$orders[i].name}</td>
				<td>{$orders[i].email}</td>
				<td style="padding: 10px 0 !important;">{$orders[i].phone}</td>
				<td>{if $orders[i].is_message_long}
					{$orders[i].message_short} <a class="fancybox driver" href="#inline{$number}">Далее</a>
					<div id="inline{$number}" style="display: none; width: 400px; text-align: center;">
						<p><b>Сообщение</b></p>
						<p>{$orders[i].message}</p>
					</div>
				  {else}
					{$orders[i].message}
				  {/if}</td>
				<!--td><a class="fancybox driver" href="/files/{$orders[i].file}">{$orders[i].file}</a></td-->
				<td style="padding: 10px 0px;">{if $orders[i].status eq 0}<a class="icon_edit tooltip" style="font-size: 18px;" href="javascript:confirmDialog('move','{$orders[i].id}');" title="Переместить заявку в «Архив»">&nbsp;&#8658;&nbsp;</a>{/if}<a class="icon_delete tooltip" href="javascript:confirmDialog('delete','{$orders[i].id}');" title="Удалить заявку из таблицы">&nbsp;X&nbsp;</a></td>
			</tr>
			{assign var="number" value=$number + 1}
			{/section}
		{else}
			<tr>
				<td colspan="7" class="no_rows">Заявок нет</td>
			</tr>
		{/if}
	{else}
			<tr>
				<th width="5%">№</th>
				<th width="10%">Дата</th>
				<th width="40%">Сообщение</th>
				<th width="45%">Данные</th>
			</tr>
		{if $errors}
			{section name=j loop=$errors}
			<tr>
				<td style="text-align: center;">{$errors[j].id}</td>
				<td style="padding: 20px 5px;">{$errors[j].date_time}</td>
				<td style="text-align: left;">{$errors[j].text}</td>
				<td style="text-align: left;">{$errors[j].data}</td>
			</tr>
			{/section}
			{if $paginator}
			<tr>
				<th colspan="4" class="border_top">{$paginator}</th>
			</tr>
			{/if}
		{else}
			<tr>
				<td colspan="4" class="no_rows">Записей нет</td>
			</tr>
		{/if}
			<tr>
				<th colspan="4" class="border_top"><input type="button" name="clear_errors" class="button_submit" onclick="confirmDialog('clear_errors');" value="Очистить" /></th>
			</tr>
	{/if}
		</table>	
	</div> <!-- #orders -->
{/if} {* if $page eq "orders" *}
{if $page eq "settings"}
<form action="index.php?page=settings&amp;type={$type}" method="post" name="settings_form">
	<div class="content" id="settings">
		<div class="caption border tooltip" title="Щёлкните по названию раздела для открытия справки" onclick="helpDialog(getHelp());">Настройки сайта</div>
		<div class="tabs">
			<a class="caption tab_first{if $type eq 'main'} active_tab{/if}" href="index.php?page=settings&amp;type=main">Основные</a><a class="caption{if $type eq 'counters'} active_tab{/if}" href="index.php?page=settings&amp;type=counters">Счётчики</a><a class="caption{if $type eq 'scripts'} active_tab{/if}" href="index.php?page=settings&amp;type=scripts">Скрипты</a>{if $is_admin}<a class="caption{if $type eq 'defaults'} active_tab{/if}" href="index.php?page=settings&amp;type=defaults">Предустановки</a>{/if}
		</div>
<script type="text/javascript">{literal}
	function setChecked(isChecked) {
		if (isChecked) {
			$("input.server_checkboxes").prop("checked", true);
		} else {
			$("input.server_checkboxes").prop("checked", false);
		}
	}
</script>{/literal}
		<table class="main_table">
			<tr>
			{if $is_global_save && $type eq "defaults"}
				<th width="5%"><input type="checkbox" id="server-all" name="server-all" onclick="setChecked(this.checked);" /><label class="without_text tooltip" for="server-all" title="Поставить все галочки для сохранения на сервере">&nbsp;</label></th>
				<th width="30%">Название</th>
				<th width="65%">Значение</th>
			{else}
				<th width="30%">Название</th>
				<th width="70%">Значение</th>
			{/if}
			</tr>
		{if $settings}
			{section name=i loop=$settings}
			<tr>
			{if $is_global_save && $type eq "defaults"}
				<td>
					<input class="server_checkboxes" type="checkbox" id="{$settings[i].name}_server" name="{$settings[i].name}_server" /><label class="without_text tooltip" for="{$settings[i].name}_server" title="Сохранить предустановку на сервере">&nbsp;</label>
				</td>
			{/if}
				<td>
					{$settings[i].title}&nbsp;<img src="styles/help.gif" alt="Описание" height="16" class="tooltip" title="{$settings[i].description}" />
				</td>
				<td style="text-align: left;">
					<textarea class="input_text" name="{$settings[i].name}">{$settings[i].value}</textarea>
				</td>
			</tr>
			{/section}
			<tr>
				<th colspan="{if $is_global_save && $type eq 'defaults'}3{else}2{/if}" class="border_top">
					<input type="submit" name="save_settings" class="button_submit" value="Сохранить{if $type ne 'defaults'} и обновить сайт{/if}" />
				</th>
			</tr>
		{else}
			<tr>
				<td colspan="{if $is_global_save && $type eq 'defaults'}3{else}2{/if}" class="no_rows">Настроек нет</td>
			</tr>
		{/if}
		{if $type eq "scripts"}
			<tr>
				<th colspan="2" class="border_top">
					<input type="button" class="button_submit long_button" value="Добавить скрипт" onclick="createScript();" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button_submit long_button" value="Удалить скрипт" onclick="deleteScript();" />
				</th>
			</tr>
		{/if}
		</table>
	</div> <!-- #settings -->
</form>
{/if} {* if $page eq "settings" *}

{if $message}
	<div class="caption border message content" id="message_text">{$message}</div>
	<div class="caption border" id="message"><div class="message_inner">{$info}</div></div>
{/if}
</div> <!-- #center_panel -->

{if $page eq "pages" or $page eq "blocks" or $page eq "forms"}
	
	<script type="text/javascript">{literal}
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
	});{/literal}
	</script>
{/if}