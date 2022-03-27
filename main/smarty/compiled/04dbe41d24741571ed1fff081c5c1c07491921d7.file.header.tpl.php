<?php /* Smarty version Smarty-3.1.19, created on 2018-04-17 19:09:39
         compiled from "smarty/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:777527655ad60e33333c73-15173419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04dbe41d24741571ed1fff081c5c1c07491921d7' => 
    array (
      0 => 'smarty/templates/header.tpl',
      1 => 1495836927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '777527655ad60e33333c73-15173419',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_login' => 0,
    'page' => 0,
    'message' => 0,
    'is_admin' => 0,
    'is_superadmin' => 0,
    'type' => 0,
    'styles' => 0,
    'style' => 0,
    'variables' => 0,
    'variable' => 0,
    'layouts' => 0,
    'layout' => 0,
    'list_images' => 0,
    'list_forms' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ad60e336ab334_36774356',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad60e336ab334_36774356')) {function content_5ad60e336ab334_36774356($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>

	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	
	<meta name="author" content="Студия веб-дизайна «Веб-Вертекс» www.webvertex.ru" />
	<meta name="copyright" content="Студия веб-дизайна «Веб-Вертекс» www.webvertex.ru" />
	<meta name="description" content="Конструктор одностраничных сайтов Landing Page Constructor" />
	<meta name="keywords" content="landing page, constructor, конструктор одностраничных сайтов, конструктор одностраничников, конструктор лендингов" />
	
	<title>Конструктор одностраничных сайтов Landing Page Constructor</title>
	
	<link type="image/x-icon" href="styles/favicon.ico" rel="shortcut icon" />
	
<?php if ($_smarty_tpl->tpl_vars['is_login']->value=="true") {?>
	<link type="text/css" rel="stylesheet" href="styles/stylea.css?v=1.0.0" />
<?php } else { ?>
	<link type="text/css" rel="stylesheet" href="styles/stylel.css?v=1.0.0" />
<?php }?>

	<script type="text/javascript" src="scripts/jquery-2.1.4.min.js"></script>
	
<?php if ($_smarty_tpl->tpl_vars['is_login']->value=="true") {?>
	<link type="text/css" rel="stylesheet" href="scripts/jquery-ui-1.11.1/jquery-ui.css" media="all" />
	<script type="text/javascript" src="scripts/jquery-ui-1.11.1/jquery-ui.js"></script>
	
	<link type="text/css" rel="stylesheet" href="scripts/fancybox/jquery.fancybox.css" media="screen" />
	<script type="text/javascript" src="scripts/fancybox/jquery.fancybox.js"></script>
	
	<link type="text/css" href="scripts/tiptip/tiptip.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="scripts/tiptip/tiptip.js"></script>
	
	<script type="text/javascript" src="scripts/openSite.js"></script>
	
	<?php if ($_smarty_tpl->tpl_vars['page']->value=="templates"||$_smarty_tpl->tpl_vars['page']->value=="pages"||$_smarty_tpl->tpl_vars['page']->value=="blocks"||$_smarty_tpl->tpl_vars['page']->value=="images") {?><script type="text/javascript" src="scripts/image_upload.js"></script><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['page']->value=="templates"||$_smarty_tpl->tpl_vars['page']->value=="blocks") {?><script type="text/javascript" src="scripts/css_generator.js"></script><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['page']->value=="colors") {?><link rel="stylesheet" type="text/css" href="scripts/jPicker/jPicker-1.1.6.css" />
	<link rel="stylesheet" type="text/css" href="scripts/jPicker/jPicker.css" />
	<script type="text/javascript" src="scripts/jPicker/jPicker-1.1.6.js"></script><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['page']->value=="updates") {?><script type="text/javascript" src="scripts/calendar.js"></script><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['page']->value=="visitors") {?>
	<link type="text/css" rel="stylesheet" href="scripts/jqPlot/jquery.jqplot.min.css" />
	<script type="text/javascript" src="scripts/jqPlot/jquery.jqplot.min.js"></script>
	<script type="text/javascript" src="scripts/jqPlot/plugins/jqplot.highlighter.min.js"></script>
    <script type="text/javascript" src="scripts/jqPlot/plugins/jqplot.dateAxisRenderer.min.js"></script>
	<script type="text/javascript" src="scripts/jqPlot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script type="text/javascript" src="scripts/jqPlot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
	<script type="text/javascript" src="scripts/jqPlot/plugins/jqplot.pointLabels.min.js"></script><?php }?>
	
	<?php if ($_smarty_tpl->tpl_vars['message']->value!='') {?><style type="text/css">
		.fancybox-inner {
			height: auto !important;
		}
	</style><?php }?>
	
	<script type="text/javascript">
		function getHelp() {
			var text = "";
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="account") {?>text = "Поставленная галочка «Показывать только сообщения об ошибке» означает, что для данного пользователя будут скрываться сообщения об успешном выполнении операции и показываться только сообщения об ошибках.";
			<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>text = text + "<br /><br />Логины superadmin и admin нельзя изменить, и их нельзя присваивать при переименовании другого пользователя. Пользователи superadmin и admin видят вкладку «Пользователи» и могут добавлять пользователей конструктора лендингов. Этим пользователям не будет доступен html-код блоков для изменения, только текстовые константы для изменения текста на странице.";<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?>text = text + "<br /><br />Особенности пользователя superadmin: 1) видна вкладка «Блоки-прототипы»; 2) на серверном сайте landkit.ru на странице шаблона виден блок «Установка шаблона»; 3) на клиентских сайтах доступна возможность сохранять блоки-прототипы и предустановки конструктора на серверный сайт, чтобы в дальнейшем использовать для новых шаблонов.";<?php }?><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="colors") {?>text = "По щелчку мышью на цветном прямоугольнике появляется окно выбора цвета.<br /><br />При изменении вручную кода цвета в текстовом поле соответственно ему меняется цвет закрашенного прямоугольника.<br /><br />После сохранения изменений цветовой схемы, установленной в конструкторе, изменения сразу же отображаются в конструкторе.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="journal") {?>text = "В журнале ошибок автоматически отображаются все ошибки и предупреждения, возникающие в работе конструктора. Также в нём отображаются системные ошибки пакета шаблонов Smarty.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="updates") {?>text = "В таблице перечисленных клиентских сайтов можно менять настройку, закачивать ли обновления на данный сайт. После установки или снятия галочек для сохранения изменений настроек сайтов нужно нажать кнопку «Сохранить».<br /><br />В окне указания даты нужно ввести дату обновления. Затем после нажатия кнопки «Обновить», если поставлена галочка «Закачать данные файлы на выбранные клиентские сайты», все исходные файлы конструктора с датой, старше указанной, будут закачаны на выбранные сайты. Если не поставлена эта галочка, будет обновлён только список файлов с датой изменения, старше указанной в поле.<br /><br />После закачивания указанных файлов на каждом сайте очищается папка скомпилированных шаблонов, чтобы отобразились новые изменения.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="templates") {?>text = "В списке шаблонов может быть несколько шаблонов, но разделы «Страницы», «Блоки» и «Графика» отображают составляющие выбранного шаблона. Чтобы выбрать шаблон, щёлкните по радио-переключателю слева от названия шаблона. По кнопке «Просмотр» также создаётся сайт на основе выбранного шаблона.<br /><br />На странице шаблона можно добавлять CSS медиа-запросы для разных разрешений экрана. Эти CSS медиа-запросы затем появятся у каждого блока.<br /><br />Также на странице шаблона можно задать CSS-переменные, а затем их вставлять в CSS-код для блоков. При генерации сайта CSS-переменные заменятся своими значениями.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="pages") {?>text = "Страница, видимость которой отключается, удаляется с диска, если поставлена галочка «Удалять файл страницы, если страница отключена»<br /><br />Если у страницы поставлена галочка SEO, то у каждого блока появляются настройки тегов title, meta-description, meta-keywords и изменяется способ отображения страницы в броузере: блоки подгружаются по мере прокрутки страницы, а при открытии страницы с параметром какого-то блока в мета-тегах и теге title всей страницы отображаются значения этого блока.<br /><br />Код секции head страницы при генерации сайта вставляется в начало секции head, выше файла стилей блоков и файлов стилей подключённых на странице скриптов.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="blocks") {?>text = "В списке блоков отобраюжаются все блоки всех страниц шаблона. После изменения порядка или видимости блоков для сохранения изменений необходимо нажать кнопку «Сохранить».<br /><br />";
			<?php if ($_smarty_tpl->tpl_vars['is_admin']->value) {?>text = text + "На странице блока возможно создавать текстовые константы, содержащие текст в блоках, который можно изменять пользователям конструктора, не имеющих прав администратора. Они не будут видеть код html и css блоков, а будут иметь возможность только изменять текстовые константы блока.<br /><br />При создании нового блока-ссылки можно создать блок, не только ссылающийся на блок с другой страницы, но и ссылающийся на блок на этой же странице. Это может быть удобно, например, когда есть сложные разделительные элементы между блоками на странице. Можно тогда их вынести в отдельный блок и далее после каждого блока их вносить уже в виде блока-ссылки на исходный блок разделительных элементов. Тогда все изменения в исходном блоке всегда отразятся в его блоках-ссылках.";<?php }?><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="forms") {?>text = "При добавлении формы в блок автоматически создаётся уникальный идентификатор элемента div, содержащего форму. Менять его не надо, он состоит из id формы и счётчика добавлений формы.<br /><br />В форме также не надо менять атрибут «name» формы (user_contact) и всех полей (user_name, user_email, ...), иначе форма не будет работать - по этим именам происходят обращения к полям в скрипте, отправляющем данные формы.<br /><br />При создании формы рекомендуется всегда ставить галочку «Посылать в письме имя формы», так как это название добавляется в базе данных и отражается в разделе «Заявки». Оно помогает быстро понять, с какой формы пришла заявка, если заявка состоит, например, только их двух полей.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="images") {?>text = "Каждую фотографию для шаблона необязательно добавлять через кнопку «Загрузить файл», можно скопировать на ftp-сервер все нужные изображение в папку images шаблона - и они автоматически отобразятся в списке изображений.<br />Папку images нельзя переименовать или удалить. Все новые папки создаются в папке images.<br /><br />Также в этом разделе отображается содержимое папки files в корне сайта. В папку files можно закачивать файлы любых форматов, кроме исполняемых (exe, com, js, asp, bin). Папку files нельзя переименовать или удалить.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="orders") {?>text = "В списке заявок отображаются все сообщения, присланные посетителями через формы сайта.<br /><br />Во вкладке «Журнал» отображаются ошибки при отправке или сохранении в базе данных сообщений с сайта.<br /><br />Если сообщение по какой-то причине не было отослано на почту или сохранено в базе данных - его всё равно можно прочитать по ссылке в описании ошибки.";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="visitors") {?>text = "На вкладке «Статистика» отображаются графики суммарного количества посетителей сайта за месяц по дням и за год по месяцам. Галочки «Отображать посещения роботов» действуют на обе вкладки.<br /><br />В списке посетителей отображаются данные о посетителях сайта. Полужирным шрифтом выделены посетители, которые в данный момент находятся на сайте.<br /><br />Если у посетителя не обнаруживается никакая активность на сайте в течение определённого промежутка времени, он считается покинувшим сайт. Этот промежуток времени можно задать в нижней части вкладки «Список».";<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['page']->value=="settings") {?>text = "Скрипты верификации Yandex или Google подключаются на сайте только на главной странице, на второстепенных страницах не подключаются.<br /><br />При сохранении данных скрипта проверяется путь к файлам .js и .css. Если эти файлы будут не найдены, изменения не сохраняются.";
			<?php if ($_smarty_tpl->tpl_vars['is_superadmin']->value) {?>text = text + "<br /><br />Для пользователя superadmin перед каждой настройкой в подразделе «Предустановки» появляется галочка, позволяющая сохранить наиболее удачные настройки на сервер landkit.ru для дальнейшего использования в новых шаблонах.";<?php }?><?php }?>
			return text;
		}		
		function helpDialog(text) {
			$("#help_dialog p").html(text);
			$("#help_dialog").dialog({buttons: {
					"Закрыть": function() {
						$(this).dialog("close");
					}
				}
			});
		}		
		function submitForm(action, id, file) {
			$('#form_action').val(action);
			if ( (action == 'create_block') || (action == 'double_block') || (action == 'rename_block') || (action == 'add_string') ) {
				if (file != undefined) {
					file = file.replace(/\.tpl/g, '');
					$('#new_block_file').val(file);
				}
				<?php if (!$_smarty_tpl->tpl_vars['is_admin']->value) {?>
				$('#file_part').css('visibility', 'hidden');
				<?php }?>
				var dialog_id = '#prompt_form_block';
				if (action == 'create_block') {
					//$(dialog_id).attr("title", "Создание блока");
					eval("document.getElementById('prompt_form_block').setAttribute('title', 'Создание блока');");
					$('#prompt_caption').html('Введите название нового блока:');
					$('#select_part').css('display', 'block');
				}
				if (action == 'rename_block') {
					//$(dialog_id).attr("title", "Переименование блока");
					eval("document.getElementById('prompt_form_block').setAttribute('title', 'Переименование блока');");
					$('#prompt_caption').html('Введите новое название блока:');
				}
				if (action == 'double_block') {
					//$(dialog_id).attr("title", "Дублирование блока");
					eval("document.getElementById('prompt_form_block').setAttribute('title', 'Дублирование блока');");
					$('#prompt_caption').html('Введите название блока-дубликата:');
				}
				
				if (action == 'add_string') dialog_id = '#prompt_add_string';
				
				promptDialog(dialog_id, id);
			} else {
			// if ( (action == 'save_block') || (action == 'parse_block') || (action == 'save_sorts') || (action == 'save_descs') || (action == 'save_template') || (action == 'save_form')  || (action == 'save_page'))
				if ((action == "save_page") || (action == "save_block") || (action == "save_form")) {
					for (var i=0; i<taCount; i++) { textareas[i].value = editors[i].getValue(); }
				}
				
				if (action == "install_template") {
					if (!checkField('input[name="site_title"]', "Описание сайта") || 
						!checkField('input[name="site_name"]', "URL адрес сайта") ||  
						!checkField('input[name="site_ip"]', "IP адрес сайта") || 
						!checkField('input[name="ftp_server"]', "URL адрес FTP-сервера") || 
						!checkField('input[name="ftp_folder"]', "Каталог FTP-сервера") || 
						!checkField('input[name="ftp_user"]', "FTP-логин") || 
						!checkField('input[name="ftp_pass"]', "FTP-пароль") ||  
						!checkField('input[name="db_host"]', "Хост базы данных") || 
						!checkField('input[name="db_name"]', "Название базы данных") || 
						!checkField('input[name="db_user"]', "Логин базы данных") || 
						!checkField('input[name="db_pass"]', "Пароль базы данных")
					) return false;
				}
				
				$('.upload_form').remove();
				$('#<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
').wrap('<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type='+id+'" method="post" name="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_form" id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_form"><\/form>');
				$('#<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_form').submit();
			}
		}
		function promptDialog(dialog_id, block_id) {
			$(dialog_id+' input').attr('form', 'blocks_form');
			$(dialog_id+' textarea').attr('form', 'blocks_form');
			$(dialog_id+' select').attr('form', 'blocks_form');
			$(dialog_id).dialog({buttons: {
					"OK": function() {
						if (document.getElementById('block_type_prototype') != undefined) {
							if (document.getElementById('block_type_prototype').checked) {
								var value = $('#prototype_description').val().replace(/\s/g, "");
								if (value.length == 0) {
									alertDialog('Описание блока-прототипа не может быть пустым');
									return;
								}
							}
						}
						$('.upload_form').remove();
						$('#blocks').wrap('<form action="index.php?page=blocks&amp;type='+block_id+'" method="post" name="blocks_form" id="blocks_form"><\/form>');
						$("#blocks_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function createUser() {
			$("#prompt_form_account").dialog({buttons: {
					"Создать": function() {
						var value = $("#new_user_login").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Логин пользователя не может быть пустым");
							return;
						}
						value = $("#new_user_pass").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Пароль пользователя не может быть пустым");
							return;
						}
						value = $("#new_user_name").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Имя пользователя не может быть пустым");
							return;
						}
						value = $("#new_user_email").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Email пользователя не может быть пустым");
							return;
						}
						
						$("#create_user_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function createPage() {
			$("#prompt_form_page").dialog({buttons: {
					"Создать": function() {
						var value = $("#new_page_name").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Название страницы не может быть пустым");
							return;
						}
						value = $("#new_page_file").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Имя файла не может быть пустым");
							return;
						}
						$("#create_page_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function doublePage(id) {
			$("#prompt_page"+id+"_double").dialog({buttons: {
					"Создать": function() {
						var value = $("#double_page"+id+"_name").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Название страницы не может быть пустым");
							return;
						}
						value = $("#double_page"+id+"_file").val().replace(/\s/g, "");
						if (value.length == 0) {
							alertDialog("Имя файла не может быть пустым");
							return;
						}
						$("#double_page"+id+"_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function checkFormFields() {
			if (checkFormField("name", "Имя") && 
				checkFormField("email", "Email") && 
				checkFormField("phone", "Телефон") && 
				checkFormField("message", "Сообщение") && 
				checkFormField("file", "Файл") && 
				checkFormField("form", "Название формы") && 
				checkFormField("link", "Текст ссылки") && 
				checkFormField("conf", "Уверение в конфиденциальности")
			) return true;
			return false;
		}
		function checkFormField(name, title) {
			var value, checked;
			eval("value = document.create_form_form." + name + "_title.value; checked = document.create_form_form." + name + "_yes.checked;");
			if (checked) {
				if (value == undefined) {
					alertDialog('Поле "' + title + '" необходимо заполнить. Либо снимите галочку для его скрытия.');
					return false;
				} else {
					value = value.replace(/\s/g, "");
					if (value.length == 0) {
						alertDialog('Поле "' + title + '" необходимо заполнить. Либо снимите галочку для его скрытия.');
						return false;
					}
				}
			}
			return true;
		}
		function createForm() {
			$("#create_form_dialog").dialog({width: 700, buttons: {
					"Создать": function() {
						if (checkFormFields()) $("#create_form_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function createStyles() {
			$("#create_styles_dialog").dialog({width: 1080, buttons: {
					"ОК": function() {
						$("#jg_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function checkField(id, name) {
			var value = $(id).val();
			if (value == undefined) {
				alertDialog('Поле «' + name + '» обязательно для заполнения');
				return false;
			} else {
				value = value.replace(/\s/g, "");
				if (value.length == 0) {
					alertDialog('Поле «' + name + '» обязательно для заполнения');
					return false;
				}
			}
			return true;
		}
		function createScript() {
			$("#prompt_form_script").dialog({buttons: {
					"Создать": function() {
						if (checkField("#new_script_title", "Название скрипта") && 
						    checkField("#new_script_description", "Описание скрипта")
							) $("#create_script_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function deleteScript() {
			$("#confirm_form_script").dialog({buttons: {
					"Удалить": function() {
						$("#delete_script_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function createScheme() {
			$("#prompt_form_color").dialog({buttons: {
					"Создать": function() {
						var value = $("#new_scheme_title").val();
						if ( (value == undefined) || ( (value != undefined) && (value.replace(/\s/g, "").length == 0) ) ) {
							alertDialog('Название цветовой схемы обязательно для заполнения');
							return false;
						}
						$("#create_form_color").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function deleteScheme() {
			$("#confirm_form_color").dialog({buttons: {
					"Удалить": function() {
						$("#delete_form_color").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function alertDialog(text) {
			$("#alert_dialog p").html(text);
			$("#alert_dialog").dialog({buttons: {
					"Хорошо": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function confirmDialog(action, id, parameter) {
			if ((parameter != undefined) && (parameter == "mirror")) {
				$("#delete_file_checkbox").css("display", "none");
				$("#delete_css_checkbox").css("display", "none");
				$("#delete_mirrors_checkbox").css("display", "none");
				$("#delete_block_title").html("Действительно удалить блок-ссылку?");
			}
			if ((parameter != undefined) && ((parameter == "server_yes") || (parameter == "server_no"))) {
				$("#delete_file_checkbox").css("display", "block");
				$("#delete_css_checkbox").css("display", "block");
				$("#delete_mirrors_checkbox").css("display", "none");
				$("#delete_block_title").html("Действительно удалить блок-прототип?");
			}
			$("#confirm_<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_"+action).dialog({buttons: {
					"Да": function() {
						var paramId = "", paramFile = "", paramCss = "", paramMirrors = "", paramLast = "";
						
						if (id != undefined) 
							paramId = "&id="+id;						
						if (document.getElementById("delete_<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_file") != undefined) 
							if ($("#delete_<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_file").val() == "yes") 
								paramFile = "&file=yes";
						if (document.getElementById("delete_css") != undefined) 
							if ($("#delete_css").val() == "yes") 
								paramCss = "&css=yes";
						if (document.getElementById("delete_mirrors") != undefined) 
							if ($("#delete_mirrors").val() == "yes") 
								paramMirrors = "&mirrors=yes";
						if (parameter != undefined) {
							if (parameter == "mirror") 		paramLast = "&mirror=yes";
							if (parameter == "server_yes") 	paramLast = "&server=yes";
							if (parameter == "server_no") 	paramLast = "&server=no";
						}
						
						window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action="+action+paramId+paramFile+paramCss+paramMirrors+paramLast;
					},
					"Нет": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function confirmFileDialog(action, file, folder) {
			$("#confirm_images_delete").dialog({buttons: {
					"Да": function() {
						window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action="+action+"&file="+file+"&folder="+folder;
					},
					"Нет": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function addStyle() {
			$("#prompt_add_style").dialog({buttons: {
					"Создать": function() {
						var styles = new Array(<?php if (isset($_smarty_tpl->tpl_vars['styles']->value)) {?><?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['style']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['styles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['style']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value) {
$_smarty_tpl->tpl_vars['style']->_loop = true;
 $_smarty_tpl->tpl_vars['style']->iteration++;
?><?php if ($_smarty_tpl->tpl_vars['style']->iteration>1) {?>,<?php }?>"<?php echo mb_strtolower($_smarty_tpl->tpl_vars['style']->value['name'], 'UTF-8');?>
"<?php } ?><?php }?>);
						var new_style = $("#new_style_name").val();
						var re = /^[a-z0-9\_\-]+$/i;
						if (re.test(new_style)) {
							if (styles.indexOf(new_style.toLowerCase()) == -1)
								window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action=add_style&name="+new_style;
							else
								alertDialog('CSS-переменная с названием '+new_style+' уже существует');
						} else
							alertDialog('Название css-переменной может состоять из латинских букв, цифр, тире и знака подчёркивания');
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function deleteStyle() {
			$("#confirm_delete_style").dialog({buttons: {
					"Удалить": function() {
						$("#delete_style_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function saveStyles() {
			
				$('#styles_block').wrap('<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=save_styles" method="post" name="styles_form" id="styles_form"><\/form>');
				$('#styles_form').submit();
			
		}
		function addVariable() {
			$("#prompt_add_variable").dialog({buttons: {
					"Создать": function() {
						var variables = new Array(<?php if (isset($_smarty_tpl->tpl_vars['variables']->value)) {?><?php  $_smarty_tpl->tpl_vars['variable'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['variable']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variables']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['variable']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['variable']->key => $_smarty_tpl->tpl_vars['variable']->value) {
$_smarty_tpl->tpl_vars['variable']->_loop = true;
 $_smarty_tpl->tpl_vars['variable']->iteration++;
?><?php if ($_smarty_tpl->tpl_vars['variable']->iteration>1) {?>,<?php }?>"<?php echo mb_strtolower($_smarty_tpl->tpl_vars['variable']->value['name'], 'UTF-8');?>
"<?php } ?><?php }?>);
						var new_variable = $("#new_variable_name").val();
						var re = /^[a-z0-9\_\-]+$/i;
						if (re.test(new_variable)) {
							if (variables.indexOf(new_variable.toLowerCase()) == -1)
								window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action=add_variable&name="+new_variable;
							else
								alertDialog('Переменная с названием '+new_variable+' уже существует');
						} else
							alertDialog('Название переменной может состоять из латинских букв, цифр, тире и знака подчёркивания');
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function deleteVariable() {
			$("#confirm_delete_variable").dialog({buttons: {
					"Удалить": function() {
						$("#delete_variable_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function saveVariables() {
			
				$('#variables_block').wrap('<form action="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&amp;action=save_variables" method="post" name="variables_form" id="variables_form"><\/form>');
				$('#variables_form').submit();
			
		}
		function addLayout() {
			$("#prompt_add_layout").dialog({buttons: {
					"Создать": function() {
						var layouts = new Array(<?php if (isset($_smarty_tpl->tpl_vars['layouts']->value)) {?><?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['layout']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
 $_smarty_tpl->tpl_vars['layout']->iteration++;
?><?php if ($_smarty_tpl->tpl_vars['layout']->iteration>1) {?>,<?php }?>"<?php echo mb_strtolower($_smarty_tpl->tpl_vars['layout']->value['title'], 'UTF-8');?>
"<?php } ?><?php }?>);
						var new_layout = $("#new_layout_name").val();
						var re = /^[a-zа-яё0-9\_\-\s]+$/i;
						if (re.test(new_layout)) {
							if (layouts.indexOf(new_layout.toLowerCase()) == -1)
								window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action=add_layout&name="+new_layout;
							else
								alertDialog('CSS-медиа стиль с названием «'+new_layout+'» уже существует');
						} else
							alertDialog('Название css-медиа стиля может состоять из латинских и русских букв, цифр, тире и знака подчёркивания');
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}		
		function promptFileDialog(action, file, folder) {
			$("#prompt_images_move").dialog({buttons: {
					"ОК": function() {
						var name = $("#folder_to_move").val();
						window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action="+action+"&name="+name+"&file="+file+"&folder="+folder;
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function promptFolderDialog(action) {
			$("#prompt_"+action).dialog({buttons: {
					"ОК": function() {
						var name = $("#folder_name_"+action).val();
						window.location = "index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&action="+action+"&name="+name;
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function promptSelectDialog(action, id) {
			if (action == "select_image") {
				var dialogHeight = 650, dialogWidth = 400;
				$("#prompt_select_form").attr("title", "Выбор изображения");
				$("#list_title").html("Выберите, пожалуйста, изображение:");
				$("#list_content").html('<table id="table_images"><?php if (isset($_smarty_tpl->tpl_vars['list_images']->value)) {?><?php if ($_smarty_tpl->tpl_vars['list_images']->value) {?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
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
?><tr><td><a class="fancybox tooltip" rel="list" href="<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
" alt="Изображение" \/><\/a><input type="radio" id="image-<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="selected_image" value="<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['src'];?>
" \/><label for="image-<?php echo $_smarty_tpl->tpl_vars['list_images']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;<\/label><\/td><\/tr><?php endfor; endif; ?><?php } else { ?><tr><td class="no_rows">Изображений нет<\/td><\/tr><?php }?><?php }?><\/table><input type="hidden" name="selected_string" value="'+id+'" \/>');
			}
			if (action == "select_form") {
				var dialogHeight = 400, dialogWidth = 600;
				$("#prompt_select_form").attr("title", "Выбор формы");
				$("#list_title").html("Выберите, пожалуйста, форму:");
				$("#list_content").html('<table id="table_select_forms"><tr><th>&nbsp;<\/th><th>№<\/th><th>Название формы<\/th><th>Модальная<\/th><\/tr><?php if (isset($_smarty_tpl->tpl_vars['list_forms']->value)) {?><?php if ($_smarty_tpl->tpl_vars['list_forms']->value) {?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['list_forms']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
?><tr><td><input type="radio" id="form-<?php echo $_smarty_tpl->tpl_vars['list_forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" name="selected_form" value="<?php echo $_smarty_tpl->tpl_vars['list_forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" \/><label for="form-<?php echo $_smarty_tpl->tpl_vars['list_forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
">&nbsp;<\/label><\/td><td><?php echo $_smarty_tpl->tpl_vars['list_forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<\/td><td><?php echo $_smarty_tpl->tpl_vars['list_forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
<\/td><td><?php echo $_smarty_tpl->tpl_vars['list_forms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['modal'];?>
<\/td><\/tr><?php endfor; endif; ?><?php } else { ?><tr><td colspan="4" class="no_rows">Форм нет<\/td><\/tr><?php }?><?php }?><\/table>');
			}
			$("#prompt_select_form").dialog({width: dialogWidth, height: dialogHeight, buttons: {
					"Выбрать": function() {
						$("#<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
_select_form").submit();
					},
					"Отмена": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		function doHover(link, linkType) {
			eval("var linkColor = document.getElementById('a"+linkType+"Color').value; var linkBold = document.getElementById('a"+linkType+"Bold').value; var linkItalic = document.getElementById('a"+linkType+"Italic').value; var linkHighlight = document.getElementById('a"+linkType+"Highlight').value; var borderStyle = document.getElementById('a"+linkType+"BorderStyle').value; var borderColor = document.getElementById('a"+linkType+"BorderColor').value; var borderWidth = document.getElementById('a"+linkType+"BorderWidth').value;");
			
			link.style.color 	  		= linkColor;
			link.style.fontWeight 		= linkBold;
			link.style.fontStyle  		= linkItalic;
			link.style.backgroundColor  = linkHighlight;
			
			switch (borderStyle) {
				case "none":
					link.style.textDecoration = "none";
					link.style.borderBottom = "medium none #000";
					break;
				case "normal":
					link.style.textDecoration = "underline";
					link.style.borderBottom = "medium none #000";
					break;
				default:
					link.style.textDecoration = "none";
					link.style.borderBottom = borderWidth + " " + borderStyle + " " + borderColor;
			}
		}
		function change_sort(id, mode) {
			var sort = $("#"+id).val();
			sort = sort.replace(/\D/i, '');
			if (sort == '') sort = 0;
			var sort_new = 0;
			eval("sort_new = " + sort + mode + "1;");
			if (sort_new < 0) sort_new = 0;
			$("#"+id).val(sort_new);
		}
		
		$(document).ready(function() {
			document.onkeydown = function(e) {
				e = e || window.event;
				if (e.altKey && e.keyCode == 112) {
					helpDialog(getHelp());
				}
				return true;
			}
			
			$("span.success").prepend('<img src="styles/success.png" alt="Успех" class="pictogram" />&nbsp;&nbsp;');
			$("span.error").prepend('<img src="styles/error.png" alt="Ошибка" class="pictogram" />&nbsp;&nbsp;');
			$("span.info").prepend('<img src="styles/info.png" alt="Инфо" class="pictogram" />&nbsp;&nbsp;');
			
			if ($("#message").length > 0) {
				var width = $("#<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
").css("width");
				width = parseInt(width.replace(/px/i, '')) - 20;
				$(".message").css("width", ""+width);
				$.fancybox.open({
					type: "inline", 
					height: "auto", 
					autoCenter: false, 
					topRatio: 0.06, 
					leftRatio: 0, 
					href: "#message", 
					closeBtn: false, 
					closeClick: true, 
					beforeShow: function(){setTimeout(function(){$.fancybox.close();},2000);}
				});
			}
			
			$(".tooltip").tipTip({
					maxWidth: "320px"
				});
			
			$('.fancybox').fancybox({
				autoSize    : true,
				width       : "auto",
				height      : "auto",
				openEffect 	: "elastic",
				closeEffect : "elastic",
				openSpeed  	: 500,
				closeSpeed  : 500,
				nextEffect 	: "fade",
				prevEffect 	: "fade",
				nextSpeed 	: 400,
				prevSpeed 	: 400,
				closeClick 	: true
			});
			
			$('.fancybox-order').fancybox({
				autoSize    : false,
				width       : 640,
				height      : 480,
				afterShow   : function(){$(".fancybox-inner").css("border", "1px solid #4b73ba");},
				openEffect 	: "elastic",
				closeEffect : "elastic",
				openSpeed  	: 500,
				closeSpeed  : 500,
				closeClick 	: true
			});
			
			$("textarea").keydown(function(e) {
				if (e.keyCode === 9) {
					var start = this.selectionStart;
					var end = this.selectionEnd;
					var $this = $(this);
					var value = $this.val();
					$this.val(value.substring(0, start)	+ "\t" + value.substring(end));
					this.selectionStart = this.selectionEnd = start + 1;
					e.preventDefault();
				}
			});
			
			
			<?php if ($_smarty_tpl->tpl_vars['page']->value=="templates"||$_smarty_tpl->tpl_vars['page']->value=="blocks") {?>
			$('#example a').mouseout(function() {doHover(this, '')});
			$('#example a').mouseover(function() {doHover(this, 'H')});
			$('#css_tabs p:not(:first)').hide();  
			$('#css_nav li').click(function(event) {
				event.preventDefault();
				$('#css_tabs p').hide();
				$('#css_nav .current').removeClass("current");
				$(this).addClass('current');    
				var clicked = $(this).find('a:first').attr('href');
				$('#css_tabs ' + clicked).fadeIn(400);
			  }).eq(0).addClass('current');
			<?php }?>
			});
	</script>
	
	<?php if ($_smarty_tpl->tpl_vars['page']->value=="pages"||$_smarty_tpl->tpl_vars['page']->value=="blocks"||$_smarty_tpl->tpl_vars['page']->value=="forms") {?><link type="text/css" rel="stylesheet" href="scripts/codemirror/lib/codemirror.css" />
	<link type="text/css" rel="stylesheet" href="scripts/codemirror/theme/eclipse.css" />
	<link type="text/css" rel="stylesheet" href="scripts/codemirror/addon/display/fullscreen.css" />
	<link type="text/css" rel="stylesheet" href="scripts/codemirror/addon/hint/show-hint.css" />
	<link type="text/css" rel="stylesheet" href="scripts/codemirror/addon/search/matchesonscrollbar.css" />
	<link type="text/css" rel="stylesheet" href="scripts/codemirror/addon/dialog/dialog.css" />
	<style type="text/css">
		.CodeMirror-focused .cm-matchhighlight {
			background-color: Bisque;
		}
    </style>
    <script type="text/javascript" src="scripts/codemirror/lib/codemirror.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/edit/closetag.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/display/fullscreen.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/fold/xml-fold.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/hint/show-hint.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/hint/xml-hint.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/hint/html-hint.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/dialog/dialog.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/search/searchcursor.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/search/search.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/scroll/annotatescrollbar.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/search/matchesonscrollbar.js"></script>
	<script type="text/javascript" src="scripts/codemirror/addon/edit/matchtags.js"></script>
    <script type="text/javascript" src="scripts/codemirror/mode/xml/xml.js"></script>
    <script type="text/javascript" src="scripts/codemirror/mode/javascript/javascript.js"></script>
    <script type="text/javascript" src="scripts/codemirror/mode/css/css.js"></script>
	<script type="text/javascript" src="scripts/codemirror/mode/htmlmixed/htmlmixed.js"></script><?php }?>
<?php }?>
</head>
<body><?php }} ?>
