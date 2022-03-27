<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "all";
	
	// Создать страницу
	if (isset($_POST["new_page_name"]))
	{
		$file = trim($_POST["new_page_file"]);
		$name = trim($_POST["new_page_name"]);
		
		$id = create_page($template_id, $file, $name, 0);
		if ($id != 0) $_GET["type"] = $id;
	}
	
	// Страница списка страниц
	if ($_GET["type"] == "all")
	{
		if (isset($_GET["action"]))
		{
			if (isset($_GET["id"]) && ($_GET["id"] != ""))
			{
				$id = $_GET["id"];
				
				$sql = "SELECT * FROM `pages` WHERE `id`=$id";
				if ( ($query_page = mysql_query($sql)) && ($page = mysql_fetch_array($query_page)) )
				{
					// Выбрать страницу
					if ($_GET["action"] == "choose")
					{
						if ($page["status"] != 1)
						{
							$sql = "UPDATE `pages` SET `status`=0 WHERE `template_id`=$template_id";
							if (mysql_query($sql) && (mysql_affected_rows() > 0))
							{
								$sql = "UPDATE `pages` SET `status`=1 WHERE `id`=$id";
								if (mysql_query($sql) && (mysql_affected_rows() == 1))
								{
									$message .= "<span class=\"success\">Страница «{$page["name"]}» успешно выбрана</span>";
									
									$is_blocks_list_changed = true;
									
									$page_id   = $page["id"];
									$page_name = $page["name"];
									
									$_SESSION["page_id"]   = $page["id"];
									$_SESSION["page_name"] = $page["name"];
								}
								else
									$message .= "<span class=\"error\">Страница «{$page["name"]}» не выбрана из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Статусы остальных страниц не изменены из-за ".get_error(1)."</span>";
						}
					}
					
					// Изменить видимость страницы
					if ($_GET["action"] == "change_visibility")
					{
						$visible = ($page["visible"]) ? "0" : "1";
						$action  = ($page["visible"]) ? "отключена" : "включена";
						
						$sql = "UPDATE `pages` SET `visible`=$visible WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Страница «{$page["name"]}» успешно $action</span>";
						else
							$message .= "<span class=\"error\">Страница «{$page["name"]}» не $action из-за ".get_error(1)."</span>";
					}
					
					// Изменить способ создания страницы
					if ($_GET["action"] == "change_scrollability")
					{
						$scrollable = ($page["scrollable"]) ? "0" : "1";
						
						$sql = "UPDATE `pages` SET `scrollable`=$scrollable WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Способ создания страницы «{$page["name"]}» успешно изменён</span>";
						else
							$message .= "<span class=\"error\">Способ создания страницы «{$page["name"]}» не изменён из-за ".get_error(1)."</span>";
					}
					
					// Дублировать страницу
					if ($_GET["action"] == "double_page")
					{
						$file = trim($_POST["double_page{$id}_file"]);
						$name = trim($_POST["double_page{$id}_name"]);
						
						$new_page_id = create_page($template_id, $file, $name, 0);
						if ($new_page_id != 0)
						{
							$_GET["type"] = $new_page_id;
							
							// Дублирование реальных блоков
							$sql = "SELECT * FROM `blocks` WHERE `page_id`=$id ORDER BY `sort`,`id`";
							if ($query_blocks = mysql_query($sql))
							{
								while ($block = mysql_fetch_array($query_blocks))
								{
									if (isset($_POST["block-{$block["id"]}"]))
									{
										if ($_POST["type-{$block["id"]}"] == "copy")
											double_block($new_page_id, $block["id"], $block["title"], "", false, false);
										
										if ($_POST["type-{$block["id"]}"] == "link")
											create_mirror($new_page_id, $block["id"], false);
									}
								}
							}
							else
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков дублируемой страницы «{$page["name"]}»</span>";
							
							// Дублирование блоков-ссылок
							$sql = "SELECT * FROM `mirrors` WHERE `page_id`=$id ORDER BY `sort`,`id`";
							if ($query_blocks = mysql_query($sql))
							{
								while ($block = mysql_fetch_array($query_blocks))
								{
									if (isset($_POST["mirror-{$block["id"]}"]))
										double_mirror($new_page_id, $block["id"], false);
								}
							}
							else
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков-ссылок дублируемой страницы «{$page["name"]}»</span>";
							
							// Дублирование переменных страницы
							$sql = "SELECT `name`, `value` FROM `variables` WHERE `page_id`=$id";
							if ($query_variables = mysql_query($sql))
							{
								while ($variable = mysql_fetch_array($query_variables))
								{
									$sql = "INSERT INTO `variables` (`page_id`, `name`, `value`) VALUES ($new_page_id, '{$variable["name"]}', '".addslashes($variable["value"])."')";
									if ( (mysql_query($sql) === false) || (mysql_affected_rows() == 0) )
										$message .= "<span class=\"error\">Переменная {$variable["name"]} не добавлена к новой странице из-за ".get_error(1)."</span>";
								}
							}
							else
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка переменных дублируемой страницы «{$page["name"]}»</span>";
						}
					}
					
					// Удалить страницу
					if ($_GET["action"] == "delete")
					{
						if ($page["status"] != 1)
						{
							$sql = "DELETE FROM `pages` WHERE `id`=$id";
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
							{
								$message .= "<span class=\"success\">Страница «{$page["name"]}» успешно удалена</span>";
								
								// Удаление файла
								if (strpos($page["file"], "/") === false)
									$file_path = $index_path . $page["file"] . ".php"; // Файлы страниц в одной папке
								else
									$file_path = $page["file"]; // Файлы страниц в разных папках
								
								if (file_exists($file_path))
								{
									if (unlink($file_path))
										$message .= "<span class=\"success\">Файл страницы $file_path успешно удалён</span>";
									else
										$message .= "<span class=\"error\">Файл страницы $file_path не удалён из-за ".get_error(1)."</span>";
								}
								
								// Удаление реальных блоков
								$sql = "SELECT `id` FROM `blocks` WHERE `page_id`=$id";
								if ($query_blocks = mysql_query($sql))
								{
									while ($block = mysql_fetch_array($query_blocks))
										delete_block($block["id"], false, true, true, true, false, false);
								}
								else
									$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков страницы «{$page["name"]}»</span>";
								
								// Удаление блоков-ссылок
								delete_mirrors($id, 0, 0, $page["name"], "");
								
								// Удаление подключений скриптов
								mysql_query("DELETE FROM `scripts` WHERE `page_id`=$id");
								
								// Удаление переменных страницы
								mysql_query("DELETE FROM `variables` WHERE `page_id`=$id");
							}
							else
								$message .= "<span class=\"error\">Страница «{$page["name"]}» не удалена из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Активную страницу нельзя удалять</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе страницы с id=$id</span>";
			}
			else
				$message .= "<span class=\"error\">Отсутствует идентификатор страницы для выполнения действия</span>";
		}
	}
	
	// Страница редактирования страницы
	if ($_GET["type"] != "all")
	{
		$id = $_GET["type"];
		
		$sql = "SELECT * FROM `pages` WHERE `id`=$id";
		$query_page = mysql_query($sql);
		if ($query_page && ($page = mysql_fetch_array($query_page)))
		{
			// Загрузить иконку
			if (isset($_FILES["uploadfile"]))
			{
				if ($_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK)
				{
					$parts = pathinfo($_FILES["uploadfile"]["name"]);
					$parts["filename"] = translit_name($parts["filename"]);
					$name = $parts["filename"] . "." . $parts["extension"];
				 
					$i = 0;
					while (file_exists($template_path.$name))
					{
						$i++;
						$name = $parts["filename"]."-".$i.".".$parts["extension"];
					}
					
					if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $template_path.$name))
					{
						$sql = "UPDATE `pages` SET `favicon`='$name' WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Файл иконки успешно загружен</span>";
						else
							$message .= "<span class=\"error\">Файл иконки успешно загружен, но не записан в базу данных из-за ".get_error(1)."</span>";
					}
					else
						$message .= "<span class=\"error\">Файл иконки не сохранён из-за ".get_error(1)." перемещения</span>";
				}
				else
					$message .= "<span class=\"error\">Файл иконки не загружен из-за ".get_error(1)." загрузки</span>";
			}
			
			// Удалить иконку
			if (isset($_GET["action"]) && ($_GET["action"] == "delete_favicon"))
			{
				if ($page["favicon"] != "")
				{
					$sql = "UPDATE `pages` SET `favicon`='' WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
					{
						if (file_exists($template_path.$page["favicon"]))
						{
							if (unlink($template_path.$page["favicon"]))
								$message .= "<span class=\"success\">Иконка успешно удалена</span>";
							else
								$message .= "<span class=\"info\">Иконка успешно удалена из базы данных, но файл иконки не удалён из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"info\">Иконка успешно удалена из базы данных, но файл иконки не был найден</span>";
					}
					else
						$message .= "<span class=\"error\">Иконка не удалена из базы данных из-за ".get_error(1)."</span>";
				}
			}
			
			// Добавление формы
			if (isset($_POST["selected_form"]))
			{
				$form_id = $_POST["selected_form"];
				
				$sql = "SELECT * FROM `forms` WHERE `id`=$form_id";
				$query_form = mysql_query($sql);
				if ($query_form && ($form = mysql_fetch_array($query_form)))
				{
					$message .= "<span class=\"success\">Код формы успешно получен</span>";
					
					$form_code = trim($form["html"]);
					$form_css  = trim($form["css"]);
					$form_link = trim($form["link"]);
					
					if ($form_link != "")
						$form_code = $form_link . "\n" . $form_code;
					$form_code = "\n\n" . preg_replace("#^(.*?)$#ims", "\t$1", $form_code) . "\n";
					
					// Увеличиваем счётчик
					$counter = intval($form["counter"]) + 1;
					$sql = "UPDATE `forms` SET `counter`='$counter' WHERE `id`=$form_id";
					if (!mysql_query($sql) || (mysql_affected_rows() == 0))
						$message .= "<span class=\"error\">Счётчик добавлений формы не изменён из-за ".get_error(1)."</span>";
					
					// Сохраняем секцию head и body страницы
					$number = $form_id . "-" . $counter;
					$form_code = str_replace("div_contact", "div_contact$number", $form_code);
					$sql = "UPDATE `pages` SET `body`='".addslashes($page["body"] . "\n\n" . $form_code)."' WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$message .= "<span class=\"success\">Код секции body успешно изменён</span>";
					else
						$error .= "<span class=\"error\">Код секции body не изменён из-за ".get_error(1)."</span>";
					
					if ($form_css != "")
					{
						$form_css  = str_replace("div_contact", "div_contact$number", $form_css);
					
						$form_css  = preg_replace("#^(\s*)\#(.*?)$#ims", "$1#div_contact$number #$2", $form_css);
						$form_css  = preg_replace("#^(\s*)\.(.*?)$#ims", "$1#div_contact$number .$2", $form_css);
						
						$form_css = "<style type=\"text/css\">\n".preg_replace("#^(.*?)$#ims", "\t$1", $form_css)."\n</style>";
						
						$sql = "UPDATE `pages` SET `head`='".addslashes($page["head"] . "\n\n" . $form_css)."' WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Код секции head успешно изменён</span>";
						else
							$error .= "<span class=\"error\">Код секции head не изменён из-за ".get_error(1)."</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$form_id</span>";
			}
			
			// Добавить переменную
			if (isset($_GET["action"]) && ($_GET["action"] == "add_variable"))
			{
				add_variable($id);
			}
			
			// Удалить переменную
			if (isset($_GET["action"]) && ($_GET["action"] == "delete_variable"))
			{
				delete_variable($id);
			}
			
			// Сохранить значения переменных
			if (isset($_GET["action"]) && ($_GET["action"] == "save_variables"))
			{
				save_variables();
			}
			
			// Сохранить страницу
			if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_page"))
			{
				$name  = trim($_POST["name"]);
				$file  = trim($_POST["file"]);
				$delete_inactive = (isset($_POST["delete_inactive"])) ? 1 : 0;
				$title = trim($_POST["title"]);
				$descr = trim($_POST["meta_description"]);
				$words = trim($_POST["meta_keywords"]);
				$doctype = trim(htmlspecialchars_decode($_POST["doctype"]));
				$head  = rtrim(htmlspecialchars_decode($_POST["head"]));
				$body  = rtrim(htmlspecialchars_decode($_POST["body"]));
				
				$error = "";
				
				// Сохранение названия
				if ($name != "")
				{
					if ($name != $page["name"])
					{
						if (preg_match("#^[a-zа-яё0-9\-\(\)\,\.\s]+$#imsu", $name) == 1)
						{
							$sql = "SELECT COUNT(`name`) FROM `pages` WHERE `name`='$name' AND `template_id`=$template_id";
							if ( ($query_count = mysql_query($sql)) && ($row_count = mysql_fetch_row($query_count)) )
							{
								if (intval($row_count[0]) == 0)
								{
									$sql = "UPDATE `pages` SET `name`='$name' WHERE `id`=$id";
									if (mysql_query($sql) && (mysql_affected_rows() == 1))
									{
										$message .= "<span class=\"success\">Название страницы успешно изменено</span>";
										
										$page["name"] = $name;
										
										if ($page["status"] == 1)
										{
											$page_name = $name;
											$_SESSION["page_name"] = $name;
										}
									}
									else
										$error .= "<span class=\"error\">Название страницы не изменено из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Страница с названием «{$name}» уже существует</span>";
							}
							else
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе существования нового названия</span>";
						}
						else
							$message .= "<span class=\"error\">Название страницы может состоять из латинских и русских букв, цифр, тире, точки, запятой и скобок</span>";
					}
				}
				else
					$error .= "<span class=\"error\">Название страницы не может быть пустым</span>";
				
				// Сохранение имени файла
				if ($file != "")
				{
					if ($file != $page["file"])
					{
						if (preg_match("#^[a-z0-9\_\-\/\.]+$#ims", $file) == 1)
						{
							$sql = "SELECT COUNT(`id`) FROM `pages` WHERE `template_id`=$template_id AND `file`='$file'";
							if ( ($query_pages = mysql_query($sql)) && ($row_page = mysql_fetch_row($query_pages)) )
							{
								if (intval($row_page[0]) == 0)
								{
									$sql = "UPDATE `pages` SET `file`='$file' WHERE `id`=$id";
									if (mysql_query($sql) && (mysql_affected_rows() == 1))
									{
										$message .= "<span class=\"success\">Имя файла страницы успешно изменено</span>";
										
										// Удалить прошлый файл страницы, если он существует
										if (strpos($page["file"], "/") === false)
											$file_path = $index_path . $page["file"] . ".php"; // Файлы страниц в одной папке
										else
											$file_path = $page["file"]; // Файлы страниц в разных папках
										
										if (file_exists($file_path))
										{
											if (!unlink($file_path))
												$message .= "<span class=\"info\">Прошлый файл страницы $file_path не удалён из-за ".get_error(1)."</span>";
										}
									}
									else
										$error .= "<span class=\"error\">Имя файла не изменено из-за ".get_error(1)."</span>";
								}
								else
									$error .= "<span class=\"error\">Имя файла $file уже существует</span>";
							}
							else
								$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе на уникальность нового имени файла</span>";
						}
						else
							$error .= "<span class=\"error\">Имя файла может состоять из латинских букв, цифр, тире, знака подчёркивания и слеша</span>";
					}
				}
				else
					$error .= "<span class=\"error\">Имя файла не может быть пустым</span>";
				
				// Сохранения флажка по удалению файла страницы
				if ($delete_inactive != $page["delete_inactive"])
				{
					$sql = "UPDATE `pages` SET `delete_inactive`=$delete_inactive WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$message .= "<span class=\"success\">Настройка по удалению файла страницы успешно изменена</span>";
					else
						$error .= "<span class=\"error\">Настройка по удалению файла страницы не изменена из-за ".get_error(1)."</span>";
				}
				
				// Сохранение заголовка
				if ($title != "")
				{
					if ($title != $page["title"])
					{
						$sql = "UPDATE `pages` SET `title`='".addslashes($title)."' WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Заголовок страницы успешно изменён</span>";
						else
							$error .= "<span class=\"error\">Заголовок страницы не изменён из-за ".get_error(1)."</span>";
					}
				}
				else
					$error .= "<span class=\"error\">Заголовок страницы не может быть пустым</span>";
				
				// Сохранение описания
				if ($descr != $page["meta_description"])
				{
					$sql = "UPDATE `pages` SET `meta_description`='".addslashes($descr)."' WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$message .= "<span class=\"success\">Описание страницы успешно изменено</span>";
					else
						$error .= "<span class=\"error\">Описание страницы не изменено из-за ".get_error(1)."</span>";
				}
				
				// Сохранение ключевых слов
				if ($words != $page["meta_keywords"])
				{
					$sql = "UPDATE `pages` SET `meta_keywords`='".addslashes($words)."' WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$message .= "<span class=\"success\">Ключевые слова успешно изменены</span>";
					else
						$error .= "<span class=\"error\">Ключевые слова не изменены из-за ".get_error(1)."</span>";
				}
				
				// Сохранение типа документа
				if ($doctype != $page["doctype"])
				{
					$sql = "UPDATE `pages` SET `doctype`='".addslashes($doctype)."' WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$message .= "<span class=\"success\">Тип документа успешно изменён</span>";
					else								
						$error .= "<span class=\"error\">Тип документа не изменён из-за ".get_error(1)."</span>";
				}
				
				// Сохранение кода секции head
				if ($head != $page["head"])
				{
					$sql = "UPDATE `pages` SET `head`='".addslashes($head)."' WHERE `id`=$id";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$message .= "<span class=\"success\">Код секции head успешно изменён</span>";
					else
						$error .= "<span class=\"error\">Код секции head не изменён из-за ".get_error(1)."</span>";
				}
				
				// Сохранение кода секции body
				if ($body != $page["body"])
				{
					if (preg_match('#\<\!\-\- start_blocks \-\-\>.*?\<\!\-\- end_blocks \-\-\>#ims', $body) == 1)
					{
						$sql = "UPDATE `pages` SET `body`='".addslashes($body)."' WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Код секции body успешно изменён</span>";
						else
							$error .= "<span class=\"error\">Код секции body не изменён из-за ".get_error(1)."</span>";
					}
					else
					{
						trigger_error("Обязательные метки в коде секции body «start_blocks» и «end_blocks» отсутствуют", E_USER_ERROR);
						$error .= "<span class=\"error\">Код секции body не изменён,<br />так как обязательные метки start_blocks и end_blocks отсутствуют</span>";
					}
				}
				
				if ($error == "")
					$is_refresh_site = true;
				else
					$message .= $error;
			}
			
			// Создание списка скриптов - и если нажата кнопка "Сохранить" - сохранение
			$scripts = array();
			$sql = "SELECT * FROM `settings` WHERE `type`=4 AND value<>''";
			$query_scripts = mysql_query($sql);
			if ($query_scripts)
			{
				while ($script = mysql_fetch_array($query_scripts))
				{
					$script_id    = $script["id"];
					$script_title = $script["title"];
					
					$sql = "SELECT `status` FROM `scripts` WHERE `page_id`=$id AND `script_id`=$script_id";
					$query_status = mysql_query($sql);
					if ($query_status && ($value = mysql_fetch_array($query_status)))
					{
						// Сохранение статуса, если была нажата кнопка Сохранить
						if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_page"))
						{
							if (isset($_POST["script-$script_id"]) && ($_POST["script-$script_id"] == "1"))
							{
								$script_status = "1";
								$script_action = "включён";
							}
							else
							{
								$script_status = "0";
								$script_action = "выключен";
							}
							
							if ($script_status != $value["status"])
							{
								$sql = "UPDATE `scripts` SET `status`=$script_status WHERE `page_id`=$id AND `script_id`=$script_id";
								mysql_query($sql);
								if (mysql_affected_rows() == 1)
								{
									$value["status"] = $script_status;
									$message .= "<span class=\"success\">$script_title успешно $script_action</span>";
								}
								else
									$error .= "<span class=\"error\">$script_title не $script_action из-за ".get_error(1)."</span>";
							}
						}
						
						$script["status"] = $value["status"];
					}
					else
					{
						$script["status"] = "1";
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе статуса подключения скрипта с id=$script_id</span>";
					}
					
					$scripts[] = $script;
				}
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе настроек для подключения скриптов</span>";
			$smarty->assign("scripts", $scripts);
			
			// Создание списка типов документа
			$doctypes = array();
			$sql = "SELECT * FROM `settings` WHERE `name`='doctypes'";
			$query_setting = mysql_query($sql);
			if ($query_setting && ($setting = mysql_fetch_array($query_setting)))
			{
				$setting["value"] = htmlspecialchars($setting["value"]);
				$doctypes = explode("\n", $setting["value"]);
				for ($i = 0; $i < count($doctypes); $i++)
				{
					$doctypes[$i] = trim($doctypes[$i]);
					$doctypes[$i] = str_replace("\n", "", $doctypes[$i]);
				}
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «Типы HTML-документа»</span>";
			$smarty->assign("doctypes", $doctypes);
			
			// Создание списка форм
			$list_forms = array();
			$sql = "SELECT `id`, `title`, `modal` FROM `forms`";
			$query_forms = mysql_query($sql);
			if ($query_forms)
			{
				while ($form = mysql_fetch_array($query_forms))
				{
					if (intval($form["modal"]) == 0) $form["modal"] = "нет";
					if (intval($form["modal"]) == 1) $form["modal"] = "да";
					$list_forms[] = $form;
				}
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка форм</span>";
			$smarty->assign("list_forms", $list_forms);
			
			// Создание списка переменных страницы
			$variables = array();
			$sql = "SELECT * FROM `variables` WHERE `page_id`=$id";
			if ($query_variables = mysql_query($sql))
			{
				while ($variable = mysql_fetch_array($query_variables)) 
					$variables[] = $variable;
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка переменных страницы</span>";
			$smarty->assign("variables", $variables);
			
			$page = array();
			$sql = "SELECT * FROM `pages` WHERE `id`=$id";
			if ( ($query_page = mysql_query($sql)) && ($page = mysql_fetch_array($query_page)) )
			{
				$page["doctype"] = htmlspecialchars($page["doctype"]);
				$page["favicon"] = ($page["favicon"] != "") ? $template_catalog . "/" . $page["favicon"] : "";
				$page["head"] 	 = htmlspecialchars($page["head"]);
				$page["body"] 	 = htmlspecialchars($page["body"]);
				$page["caption"] = (mb_strlen($page["name"], "UTF-8") > 11) ? mb_substr($page["name"], 0, 10, "UTF-8")."..." : $page["name"];
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе страницы с id=$id</span>";
			$smarty->assign("site_page", $page);
		}
		else
		{
			$_GET["type"] = "all";
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе страницы с id=$id</span>";
		}
	} // if ($_GET["type"] != "all")
	
	if ($_GET["type"] == "all")
	{
		$pages = array();
		$sql = "SELECT * FROM `pages` WHERE `template_id`=$template_id ORDER BY `id`";
		$query_pages = mysql_query($sql);
		if ($query_pages)
		{
			while ($page = mysql_fetch_array($query_pages))
			{
				$page["caption"] = (mb_strlen($page["name"], "UTF-8") > 11) ? mb_substr($page["name"], 0, 10, "UTF-8")."..." : $page["name"];
				$page["blocks"]  = get_page_blocks($page["id"], $page["name"]); // Блоки страницы для формы "Дублирование страницы"
				
				if (strpos($page["file"], "/") === false)
					$page["file"] = $page["file"] . ".php";
				
				$pages[] = $page;
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка страниц для их отображения</span>";
		$smarty->assign("pages", $pages);
	}
?>