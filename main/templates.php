<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "all";
	
	// Создание шаблона
	if (isset($_GET["action"]) && ($_GET["action"] == "create_template") && $is_superadmin)
	{
		// Подбираем автоматически название каталога
		$i = 1;
		$new_catalog = "template$i";
		while (file_exists($templates_path.$new_catalog))
		{
			$i++;
			$new_catalog = "template$i";
		}
		
		// Подбираем автоматически название шаблона
		$i = 1;
		$new_title = "Шаблон$i";
		$sql = "SELECT `id` FROM `templates` WHERE `title`='$new_title'";
		$num = mysql_num_rows(mysql_query($sql));
		while ($num > 0)
		{
			$i++;
			$new_title = "Шаблон$i";
			$sql = "SELECT `id` FROM `templates` WHERE `title`='$new_title'";
			$num = mysql_num_rows(mysql_query($sql));
		}
		
		$sql = "INSERT INTO `templates` (`title`, `catalog`, `description`) VALUES ('$new_title', '$new_catalog', 'Описание шаблона')";
		if (mysql_query($sql) && (mysql_affected_rows() == 1))
		{
			$message .= "<span class=\"success\">Шаблон «{$new_title}» успешно создан</span>";
			
			$id = mysql_insert_id();
			$_GET["type"] = $id;
			
			// Создаём каталоги
			$message .= create_dir("/templates/", "$new_catalog");
			$message .= create_dir("/templates/$new_catalog/", "blocks");
			$message .= create_dir("/templates/$new_catalog/", "images");
			$message .= create_dir("/templates/$new_catalog/", "styles");
			
			// Создаём основную страницу
			$new_page_id = create_page($id, "index", "Основная", 1);
			
			// Создаём один css медиа-запрос
			$new_layout_id = create_layout($id, "Основной", 1, $templates_path.$new_catalog."/styles/");
			
			// Создаём css-переменные
			$sql = "SELECT * FROM `styles` WHERE `template_id`=0";
			$query_styles = mysql_query($sql);
			if ($query_styles)
			{
				$count_insert = 0;
				while ($style = mysql_fetch_array($query_styles))
				{
					$sql = "INSERT INTO `styles` (`template_id`, `name`, `value`) VALUES ($id, '{$style["name"]}', '".addslashes($style["value"])."')";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
						$count_insert++;
					else
						$message .= "<span class=\"error\">Css-переменная {$style["name"]} не добавлена из-за ".get_error(1)."</span>";
				}
				if (($count_insert > 0) && ($count_insert == mysql_num_rows($query_styles)))
					$message .= "<span class=\"success\">Css-переменные успешно добавлены</span>";
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе css-переменных для нового шаблона</span>";
		}
		else
			$message .= "<span class=\"error\">Шаблон «{$new_title}» не создан из-за ".get_error(1)."</span>";
	} // Создание шаблона
	
	if ( (isset($_GET["action"]) && ( ($_GET["action"] == "choose") || ($_GET["action"] == "delete"))) || ($_GET["type"] != "all") )
	{
		$id = "-1";
		
		if ($_GET["type"] == "all")
		{
			if (isset($_GET["id"]) && ($_GET["id"] != ""))
				$id = $_GET["id"];
			else
				$message .= "<span class=\"error\">Отсутствует идентификатор шаблона для выполнения действия</span>";
		}
		
		if ($_GET["type"] != "all")
		{
			if (isset($_GET["type"]) && ($_GET["type"] != ""))
				$id = $_GET["type"];
			else
				$message .= "<span class=\"error\">Отсутствует идентификатор шаблона для его редактирования</span>";
		}
		
		$sql = "SELECT * FROM `templates` WHERE `id`=$id";
		$query_template = mysql_query($sql);
		if ($query_template && ($template = mysql_fetch_array($query_template)))
		{
			// Действия на странице списка шаблонов
			if ($_GET["type"] == "all")
			{
				// Выбрать шаблон
				if (isset($_GET["action"]) && ($_GET["action"] == "choose"))
				{
					if ($template["status"] != 1)
					{
						$sql = "UPDATE `templates` SET `status`=0";
						if (mysql_query($sql) && (mysql_affected_rows() > 0))
						{
							$sql = "UPDATE `templates` SET `status`=1 WHERE `id`=$id";
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
							{
								$message .= "<span class=\"success\">Шаблон «{$template["title"]}» успешно выбран</span>";
								
								$template_id 	  = intval($template["id"]);
								$template_title   = $template["title"];
								$template_catalog = "/templates/".$template["catalog"];
								
								$_SESSION["template_id"] =      $template_id;
								$_SESSION["template_title"] =   $template_title;
								$_SESSION["template_catalog"] = $template_catalog;
								
								set_template_paths($template_catalog);
								
								$sql = "SELECT * FROM `pages` WHERE `template_id`=$template_id AND `status`=1 LIMIT 1";
								if ( ($query_page = mysql_query($sql)) && ($page = mysql_fetch_array($query_page)) )
								{
									$is_blocks_list_changed = true;
									
									$page_id   = $page["id"];
									$page_name = $page["name"];
									
									$_SESSION["page_id"]   = $page["id"];
									$_SESSION["page_name"] = $page["name"];
								}
								else
									$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе активной страницы шаблона «{$template_title}»</span>";
							}
							else
								$message .= "<span class=\"error\">Шаблон «{$template["title"]}» не выбран из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Статусы остальных шаблонов не изменены из-за ".get_error(1)."</span>";
					}
				}
				
				// Удалить шаблон
				if (isset($_GET["action"]) && ($_GET["action"] == "delete"))
				{
					if ($template["status"] != 1)
					{
						$sql = "DELETE FROM `templates` WHERE `id`=$id";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
						{
							$message .= "<span class=\"success\">Шаблон «{$template["title"]}» успешно удалён</span>";
							
							if (remove_dir($templates_path.$template["catalog"]))
								$message .= "<span class=\"success\">Каталог шаблона {$template["catalog"]} успешно удалён</span>";
							else
								$message .= "<span class=\"error\">В процессе удаления каталога шаблона «{$template["catalog"]}» произошли ".get_error(1)."</span>";
							
							mysql_query("DELETE FROM `blocks`  WHERE `template_id`=$id");
							mysql_query("DELETE FROM `styles`  WHERE `template_id`=$id");
							mysql_query("DELETE FROM `layouts` WHERE `template_id`=$id");
							mysql_query("DELETE FROM `pages`   WHERE `template_id`=$id");
						}
						else
							$message .= "<span class=\"error\">Шаблон «{$template["title"]}» не удалён из-за ".get_error(1)."</span>";
					}
					else
						$message .= "<span class=\"error\">Активный шаблон удалять нельзя</span>";
				}
			}
			else
			// Действия на странице редактирования шаблона
			{
				// Заполняем массив css медиа-запросов
				$layouts = array();
				$layouts = get_layouts($id, $templates_path.$template["catalog"]."/styles/", "");
				
				if ($layouts !== false)
				{
					// Добавить css медиа-запрос
					if (isset($_GET["action"]) && ($_GET["action"] == "add_layout"))
					{
						if (isset($_GET["name"]) && ($_GET["name"] != ""))
						{
							$layout_title = $_GET["name"];
							
							if (preg_match("#^[a-z0-9а-яё\_\-\s]+$#imsu", $layout_title) == 1)
							{
								$sort = -1;
								$is_present_title = false;
								foreach ($layouts as $layout)
								{
									if ($layout["title"] == $layout_title)
										$is_present_title = true;
									if (intval($layout["sort"]) > $sort)
										$sort = intval($layout["sort"]);
								}
								$sort = $sort + 1;
								
								if (!$is_present_title)
								{
									$blocks_text = ""; // Текст с отметками всех блоков этого шаблона
									$layout_id = create_layout($id, $layout_title, $sort, $templates_path.$template["catalog"]."/styles/");
									
									// Добавляем новый медиа-запрос во все массивы медиа-запросов
									if ($layout_id != -1)
									{
										$query_layout = mysql_query("SELECT * FROM `layouts` WHERE `id`=$layout_id");
										$layout = mysql_fetch_array($query_layout);
										
										$layout["template_cssfile"] = $template_css . "-" . $layout_id . ".css";
										$layout["template_csstext"] = "";
										$layout["blocks_cssfile"]   = $blocks_css . "-" . $layout_id . ".css";
										$layout["blocks_csstext"]   = $blocks_text;
										
										$layouts[$layout_id] = $layout;
									}
								}
								else
									$message .= "<span class=\"error\">Css медиа-запрос с названием «{$layout_title}» уже существует</span>";
							}
							else
								$message .= "<span class=\"error\">Название css медиа-запроса может состоять из латинских и русских букв, цифр, тире и знака подчёркивания</span>";
						}
						else
							$message .= "<span class=\"error\">Отсутствует название css медиа-запроса</span>";
					}
					
					// Удалить css медиа-запрос
					if (isset($_GET["action"]) && ($_GET["action"] == "delete_layout"))
					{
						if (isset($_GET["id"]) && ($_GET["id"] != ""))
						{
							if (count($layouts) > 1)
							{
								$layout_id = $_GET["id"];
								
								// Удаление из базы данных
								$sql = "DELETE FROM `layouts` WHERE `id`=$layout_id";
								if (mysql_query($sql) && (mysql_affected_rows() == 1))
									$message .= "<span class=\"success\">Css медиа-запрос «{$layouts[$layout_id]["title"]}» успешно удалён</span>";
								else
									$message .= "<span class=\"error\">Css медиа-запрос «{$layouts[$layout_id]["title"]}» не удалён из-за ".get_error(1)."</span>";
								
								// Удаление файла стилей шаблона
								$file = $layouts[$layout_id]["template_cssfile"];
								if (unlink($templates_path.$template["catalog"]."/styles/".$file))
									$message .= "<span class=\"success\">Файл стилей шаблона $file успешно удалён</span>";
								else
									$message .= "<span class=\"error\">Файл стилей шаблона $file не удалён из-за ".get_error(1)."</span>";
								
								// Удаление файла стилей блоков
								$file = $layouts[$layout_id]["blocks_cssfile"];
								if (unlink($templates_path.$template["catalog"]."/styles/".$file))
									$message .= "<span class=\"success\">Файл стилей блоков $file успешно удалён</span>";
								else
									$message .= "<span class=\"error\">Файл стилей блоков $file не удалён из-за ".get_error(1)."</span>";
									
								// Удаление из массива css медиа-запросов
								unset($layouts[$layout_id]);
							}
							else
								$message .= "<span class=\"error\">Должен существовать хотя бы один css медиа-запрос</span>";
						}
						else
							$message .= "<span class=\"error\">Отсутствует идентификатор css медиа-запроса для удаления</span>";
					}
					
					// Поднять css медиа-запрос вверх
					if (isset($_GET["action"]) && ($_GET["action"] == "move_up"))
					{
						if (isset($_GET["id"]) && ($_GET["id"] != ""))
						{
							$layout_id    = $_GET["id"];
							$layout_sort  = intval($layouts[$layout_id]["sort"]);
							$layout_title = $layouts[$layout_id]["title"];
							
							if ($layout_sort > 0)
							{
								$sql = "UPDATE `layouts` SET sort=sort-1 WHERE `id`=$layout_id";
								if (mysql_query($sql) && (mysql_affected_rows() == 1))
								{
									$message .= "<span class=\"success\">Порядок следования css медиа-запроса «{$layout_title}» успешно изменён</span>";
									$layouts[$layout_id]["sort"] = $layout_sort - 1;
									uasort($layouts, "sorting_function");
								}
								else
									$message .= "<span class=\"error\">Порядок следования css медиа-запроса «{$layout_title}» не изменён из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Порядок следования css медиа-запроса «{$layout_title}» не может быть меньше нуля</span>";
						}
						else
							$message .= "<span class=\"error\">Отсутствует идентификатор css медиа-запроса для изменения порядка следования</span>";
					}
					
					// Опустить css медиа-запрос вниз
					if (isset($_GET["action"]) && ($_GET["action"] == "move_down"))
					{
						if (isset($_GET["id"]) && ($_GET["id"] != ""))
						{
							$layout_id = $_GET["id"];
							$layout_sort  = intval($layouts[$layout_id]["sort"]);
							$layout_title = $layouts[$layout_id]["title"];
							
							$sql = "UPDATE `layouts` SET sort=sort+1 WHERE `id`=$layout_id";
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
							{
								$message .= "<span class=\"success\">Порядок следования для css медиа-запроса «{$layout_title}» успешно изменён</span>";
								$layouts[$layout_id]["sort"] = $layout_sort + 1;
								uasort($layouts, "sorting_function");
							}
							else
								$message .= "<span class=\"error\">Порядок следования для css медиа-запроса «{$layout_title}» не изменён из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Отсутствует идентификатор css медиа-запроса для изменения порядка следования</span>";
					}
					
					// Добавить css-переменную
					if (isset($_GET["action"]) && ($_GET["action"] == "add_style"))
					{
						add_style($id);
					}
					
					// Удалить css-переменную
					if (isset($_GET["action"]) && ($_GET["action"] == "delete_style"))
					{
						delete_style();
					}
					
					// Сохранить значения css-переменных
					if (isset($_GET["action"]) && ($_GET["action"] == "save_styles"))
					{
						save_styles();
					}
					
					// Добавить из генератора стилей новые css-правила
					if (isset($_POST["form_action"]) && ($_POST["form_action"] == "add_text_styles"))
					{
						$css_generator = generate_text_styles();
						
						if ($css_generator != "")
							$message .= "<span class=\"success\">Css-правила генератора стилей успешно получены</span>";
						
						// Сохранение в файлы стилей шаблона
						$count = 0;
						foreach ($layouts as $layout)
						{
							$file = $layout["template_cssfile"];
							$text = $layout["template_csstext"] . "\n\n" . $css_generator;
							
							if (file_put_contents($templates_path.$template["catalog"]."/styles/".$file, $text) !== false)
							{
								$count++;
								$layouts[$layout["id"]]["template_csstext"] = $text;
								
								if (!chmod_file($templates_path.$template["catalog"]."/styles/", $file))
									$message .= "<span class=\"info\">Полные права доступа к файлу стилей шаблона $file не установлены из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Css-правила шаблона не изменены,<br />так как файл стилей $file не сохранён из-за ".get_error(1)."</span>";
						}
						if ($count == count($layouts))
							$message .= "<span class=\"success\">Css-правила шаблона успешно изменены</span>";
					}
					
					// Загрузить изображение шаблона
					if (isset($_FILES["uploadfile"]))
					{
						if ($_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK)
						{
							$parts = pathinfo($_FILES["uploadfile"]["name"]);
							$parts["filename"] = translit_name($parts["filename"]);
							$name = $parts["filename"] . "." . $parts["extension"];
							
							$i = 0;
							while (file_exists($templates_path.$template["catalog"]."/".$name))
							{
								$i++;
								$name = $parts["filename"]."-".$i.".".$parts["extension"];
							}
							
							if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $templates_path.$template["catalog"]."/".$name))
							{
								$sql = "UPDATE `templates` SET `image`='$name' WHERE `id`=$id";
								if (mysql_query($sql) && (mysql_affected_rows() == 1))
									$message .= "<span class=\"success\">Изображение шаблона успешно загружено</span>";
								else
									$message .= "<span class=\"error\">Изображение шаблона успешно загружено, но не записано в базу данных из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Изображение шаблона не загружено из-за ".get_error(1)." перемещения</span>";
						}
						else
							$message .= "<span class=\"error\">Изображение шаблона не загружено из-за ".get_error(1)." загрузки</span>";
					}
					
					// Установить шаблон на клиентский сайт
					if (isset($_POST["install_to_client"]) && ($_POST["install_to_client"] == "yes"))
					{
						$site_id	= $_POST["site_id"];
						$site_title	= trim($_POST["site_title"]);
						$site_name 	= trim($_POST["site_name"]);
						$site_ip 	= trim($_POST["site_ip"]);
						
						$ftp_server = trim($_POST["ftp_server"]);
						$ftp_folder = trim($_POST["ftp_folder"]);
						$ftp_user   = trim($_POST["ftp_user"]);
						$ftp_pass   = trim($_POST["ftp_pass"]);
						
						$db_host 	= trim($_POST["db_host"]);
						$db_name 	= trim($_POST["db_name"]);
						$db_user 	= trim($_POST["db_user"]);
						$db_pass 	= trim($_POST["db_pass"]);
						
						$forbidden_full_rights = ( isset($_POST["forbidden_full_rights"]) ) ? "true" : "false";
						
						if (strripos($site_name, "http://") === false) $site_name = "http://" . $site_name;
						$site_name  = rtrim($site_name, "/") . "/";
						$ftp_folder = trim($ftp_folder, "/");
						
						// Обновить установочные данные
						if ($site_id > 0)
						{
							$sql = "UPDATE `sites` SET `site_title`='".addslashes($site_title)."', `site_ip`='".addslashes($site_ip)."', `ftp_server`='".addslashes($ftp_server)."', `ftp_folder`='".addslashes($ftp_folder)."', `ftp_user`='".addslashes($ftp_user)."', `ftp_pass`='".addslashes($ftp_pass)."', `db_host`='".addslashes($db_host)."', `db_name`='".addslashes($db_name)."', `db_user`='".addslashes($db_user)."', `db_pass`='".addslashes($db_pass)."', `date_install`='".date("Y-m-d H:i:s")."' WHERE `id`=$site_id";
							
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
								$message .= "<span class=\"success\">Установочные данные сайта успешно обновлены в базе данных</span>";
							else
								$message .= "<span class=\"info\">Установочные данные сайта не обновлены в базе данных из-за ".get_error(1)."</span>";
						}
						// Добавить установочные данные
						else
						{
							$sql = "INSERT INTO `sites` (`site_title`, `site_name`, `site_ip`, `ftp_server`, `ftp_folder`, `ftp_user`, `ftp_pass`, `db_host`, `db_name`, `db_user`, `db_pass`) VALUES ('".addslashes($site_title)."', '".addslashes($site_name)."', '".addslashes($site_ip)."', '".addslashes($ftp_server)."', '".addslashes($ftp_folder)."', '".addslashes($ftp_user)."', '".addslashes($ftp_pass)."', '".addslashes($db_host)."', '".addslashes($db_name)."', '".addslashes($db_user)."', '".addslashes($db_pass)."')";
							
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
								$message .= "<span class=\"success\">Установочные данные сайта успешно добавлены в базу данных</span>";
							else
								$message .= "<span class=\"info\">Установочные данные сайта не добавлены в базу данных из-за ".get_error(1)."</span>";
						}

						// Создать таблицы в базе данных сайта
						$is_tables_created = false;
						$db_tables = file_get_contents($install_path.$db_tables_sql);
						if ($db_tables !== false)
						{
							if (mysql_query_multiple($site_name, $site_ip, $db_name, $db_user, $db_pass, $db_tables))
							{
								$is_tables_created = true;
								$message .= "<span class=\"success\">Таблицы базы данных успешно созданы на сайте</span>";
							}
							else
								$message .= "<span class=\"error\">Произошла ошибка при выполнении запросов из SQL-скрипта $db_tables_sql для создания таблиц в базе данных сайта.<br />Удалите все таблицы из базы данных сайта и запустите вручную в phpMyAdmin сайта SQL-скрипт $install_path$db_tables_sql</span>";
						}
						else
							$message .= "<span class=\"error\">Произошла ошибка при открытии SQL-скрипта $db_tables_sql для создания таблиц в базе данных сайта.<br />Удалите все таблицы из базы данных сайта и запустите вручную в phpMyAdmin сайта SQL-скрипт $install_path$db_tables_sql</span>";
						
						// Взять из базы данных последнюю информацию о блоках-прототипах
						$db_data = get_sql("blocks", "`status`=2");
						
						// Взять из базы данных все цветовые схемы с последними изменениями
						$db_data .= get_sql("colors", "1");

						// Взять из базы данных формы с последними изменениями
						$db_data .= get_sql("forms", "1");

						// Взять из базы данных последнюю информацию обо всех настройках
						$db_data .= get_sql("settings", "1");

						// Взять из базы данных последнюю информацию о css переменных блоков-прототипов
						$db_data .= get_sql("styles", "`template_id`=0");

						// Внести в таблицы записи о выбранном шаблоне
						$db_data .= get_sql("templates", "`id`=$id");

						// Внести в таблицы css медиа-запросы выбранного шаблона
						$db_data .= get_sql("layouts", "`template_id`=$id");

						// Внести в таблицы css переменные выбранного шаблона
						$db_data .= get_sql("styles", "`template_id`=$id");

						// Внести в таблицы все блоки выбранного шаблона
						$db_data .= get_sql("blocks", "`template_id`=$id");

						// Внести в таблицы все страницы выбранного шаблона
						$db_data .= get_sql("pages", "`template_id`=$id");

						$list_pages = array();
						$sql = "SELECT `id` FROM `pages` WHERE `template_id`=$id";
						$query_pages = mysql_query($sql);
						if ($query_pages !== false)
						{
							while ($row = mysql_fetch_row($query_pages))
								$list_pages[] = $row[0];
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка страниц шаблона</span>";

						if (count($list_pages) > 0)
						{
							// Внести в таблицы все скрипты страниц выбранного шаблона
							$db_data .= get_sql("scripts", "`page_id` IN ( " . implode(",", $list_pages) . " )");
							
							// Внести в таблицы все блоки-ссылки страниц выбранного шаблона
							$db_data .= get_sql("mirrors", "`page_id` IN ( " . implode(",", $list_pages) . " )");
						}

						$list_mirrors = array();
						$sql = "SELECT `mirrors`.`id` FROM `mirrors` LEFT JOIN `pages` ON `mirrors`.`page_id`=`pages`.`id` WHERE `pages`.`template_id`=$id";
						$query_mirrors = mysql_query($sql);
						if ($query_mirrors !== false)
						{
							while ($row = mysql_fetch_row($query_mirrors))
								$list_mirrors[] = $row[0];
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков-ссылок шаблона</span>";
						
						// Если есть блоки-ссылки, взять из таблицы counters счётчики форм
						if (count($list_mirrors) > 0)
							$db_data .= get_sql("counters", "`mirror_id` IN ( " . implode(",", $list_mirrors) . " )");
						
						$list_strings = array();
						$sql = "SELECT * FROM `blocks` WHERE `template_id`=$id";
						$query_blocks = mysql_query($sql);
						if ($query_blocks !== false)
						{
							while ($block = mysql_fetch_array($query_blocks))
							{
								$block_file = $block["file"];
								if (file_exists($blocks_path.$block_file))
								{
									$block_code = file_get_contents($blocks_path.$block_file);
									if ($block_code !== false)
									{
										if (preg_match_all('#\{\$string\-([0-9]{1,10})\}#ims', $block_code, $matches) > 0)
										{
											$unique_matches = array_unique($matches[1]);
											foreach ($unique_matches as $string_id)
												$list_strings[] = $string_id;
										}
									}
									else
										$message .= "<span class=\"error\">Код блока «{$block["title"]}» не получен из файла $block_file из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Файл $block_file блока «{$block["title"]}» не найден</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков шаблона</span>";
						
						// Если есть строковые константы, взять из strings
						if (count($list_strings) > 0)
							$db_data .= get_sql("strings", "`id` IN ( " . implode(",", $list_strings) . " )");
						
						// Сохранить файл с SQL-запросами
						$is_db_data_sql_saved = false;
						if (file_exists($install_path.$db_data_sql)) unlink($install_path.$db_data_sql);
						if (file_put_contents($install_path.$db_data_sql, $db_data) !== false)
						{
							$is_db_data_sql_saved = true;
							chmod_file($install_path, $db_data_sql);
							$message .= "<span class=\"success\">SQL-скрипт для заполнения базы данных сайта данными выбранного шаблона<br />сохранён успешно: $install_path$db_data_sql</span>";
							if (!$is_tables_created)
								$message .= "<span class=\"success\">Запустите вручную в phpMyAdmin сайта SQL-скрипт $install_path$db_data_sql</span>";
						}
						else
							$message .= "<span class=\"error\">SQL-скрипт для заполнения базы данных сайта данными выбранного шаблона<br />не сохранён из-за ".get_error(1)."</span>";
						
						if ($is_tables_created)
						{
							if (mysql_query_multiple($site_name, $site_ip, $db_name, $db_user, $db_pass, $db_data))
								$message .= "<span class=\"success\">Таблицы базы данных на сайте успешно заполнены данными шаблона</span>";
							else
							{
								if ($is_db_data_sql_saved)
									$message .= "<span class=\"info\">Таблицы базы данных на сайте не заполнены данными шаблона из-за вышеперечисленных ошибок. Запустите вручную в phpMyAdmin сайта SQL-скрипт $install_path$db_data_sql</span>";
								else
									$message .= "<span class=\"error\">Таблицы базы данных на сайте не заполнены данными шаблона из-за вышеперечисленных ошибок</span>";
							}
						}
						
						// Сделать копию исходного установочного архива
						$copy_result = copy($install_path.$original_archive, $install_path.$install_archive);
						if ($copy_result === false)
							$message .= "<span class=\"error\">Копия исходного установочного архива не создана из-за ".get_error(1)."</span>";
						
						if ($copy_result && 
							add_directory_to_zip(ROOT."/", "main") && 
							add_directory_to_zip(ROOT."/", "templates/".$template["catalog"]) && 
							add_directory_to_zip(ROOT."/", "styles") && 
							add_directory_to_zip(ROOT."/", "scripts"))
						{
							$message .= "<span class=\"success\">Файлы шаблона, папки main, styles и scripts успешно добавлены в установочный архив</span>";
							
							$file  = array();
							$files = array();
							
							// Создать файл connect.php и поместить его в установочный архив в папку main/smarty/config/
							$settings_text = '<?php
	$db_vars["db_host"] = "'.$db_host.'";
	$db_vars["db_base"] = "'.$db_name.'";
	$db_vars["db_user"] = "'.$db_user.'";
	$db_vars["db_pass"] = "'.$db_pass.'";
	
	$ftp_vars["ftp_server"] = "'.$ftp_server.'";
	$ftp_vars["ftp_folder"] = "'.$ftp_folder.'";
	$ftp_vars["ftp_user"]   = "'.$ftp_user.'";
	$ftp_vars["ftp_pass"]   = "'.$ftp_pass.'";	
	
	$forbidden_full_rights  = '.$forbidden_full_rights.';
	
	mysql_connect($db_vars["db_host"], $db_vars["db_user"], $db_vars["db_pass"], false, 2) or die(mysql_error());
	mysql_select_db($db_vars["db_base"]) or die(mysql_error());
	mysql_query("set names \'utf8\'") or die(mysql_error());
?>';
							
							if (file_put_contents($install_path.$settings_file, $settings_text) !== false)
							{
								$message .= "<span class=\"success\">Конфигурационный файл $settings_file успешно создан</span>";
								
								array_splice($file, 0);
								array_splice($files, 0);
								$file["source"]  = $install_path.$settings_file;
								$file["archive"] = "main/smarty/config/$settings_file";
								$files[] = $file;
								if (add_file_to_zip($files))
								{
									$message .= "<span class=\"success\">Конфигурационный файл $settings_file успешно добавлен в установочный архив</span>";
									@unlink($install_path.$settings_file);
								}
								else
									$message .= "<span class=\"info\">Конфигурационный файл $settings_file не добавлен в установочный архив из-за выше указанной ошибки<br />Из папки $install_path скопируйте его в папку /main/smarty/config/ на ftp-сервере нового сайта</span>";
							}
							else
								$message .= "<span class=\"error\">Конфигурационный файл $settings_file не создан из-за ".get_error(1)."<br />Создайте его вручную и поместите в папку /main/smarty/config/ на ftp-сервере нового сайта</span>";
							
							// Создание файла лицензии и помещение его в установочный архив
							$key = get_license($site_name, $ftp_folder);
							if (file_put_contents($install_path.$license_file, $key) !== false)
							{
								$message .= "<span class=\"success\">Файл лицензии $license_file успешно создан</span>";
								
								array_splice($file, 0);
								array_splice($files, 0);
								$file["source"]  = $install_path.$license_file;
								$file["archive"] = "main/smarty/config/$license_file";
								$files[] = $file;
								if (add_file_to_zip($files))
								{
									$message .= "<span class=\"success\">Файл лицензии $license_file успешно добавлен в установочный архив</span>";
									@unlink($install_path.$license_file);
								}
								else
									$message .= "<span class=\"info\">Файл лицензии $license_file не добавлен в установочный архив из-за выше указанной ошибки<br />Из папки $install_path скопируйте его в папку /main/smarty/config/ на ftp-сервере нового сайта</span>";
							}
							else
								$message .= "<span class=\"error\">Файл лицензии $license_file не создан из-за ".get_error(1)."<br />Создайте его вручную и поместите в папку /main/smarty/config/ на ftp-сервере нового сайта</span>";
							
							unset($file, $files);
							
							// Закачать на ftp-сервер install.zip и разархивировать там
							if (put_install_archives($site_ip, $ftp_server, $ftp_folder, $ftp_user, $ftp_pass, $forbidden_full_rights))
							{
								$message .= "<span class=\"success\">Установочные файлы успешно закачаны на сайт</span>";
								@unlink($install_path.$install_archive);
								
								$text = file_get_contents($site_name.$extract_script);
								if ($text === false)
									$message .= "<span class=\"error\">Установочный архив не разархивирован на сайте из-за ".get_error(1)." запуска скрипта $extract_script на сайте</span>";
								elseif (strcmp($text, "success") == 0)
								{
									$message .= "<span class=\"success\">Установочный архив успешно разархивирован на сайте</span>";
									
									if (set_full_rights($site_ip, $ftp_server, $ftp_folder, $ftp_user, $ftp_pass) === false)
										$message .= "<span class=\"error\">Установите вручную полные права 777 на папки Смарти main/smarty/cache/ и main/smarty/compiled/</span>";
									
									if ($forbidden_full_rights == "false")
									{
										// Установить полные права на все файлы и папки
										$text = file_get_contents($site_name.$chmod_script);
										if ($text === false)
											$message .= "<span class=\"error\">Полные права на папки не установлены из-за ".get_error(1)." запуска скрипта $chmod_script на сайте</span>";
										elseif (strcmp($text, "success") == 0)
											$message .= "<span class=\"success\">Полные права на папки и файлы успешно установлены на сайте</span>";
										else
											$message .= "<span class=\"info\">Полные права не установлены на следующие файлы или папки: $text<br />Установите вручную на ftp-сервере полные права на эти файлы или папки</span>";
									}
								}
								else
									$message .= "<span class=\"error\">Установочные архивы не разархивированы на сайте из-за ошибки: $text</span>";
							}
							
							$message .= "<span class=\"success\"><a class=\"driver\" href=\"{$site_name}main/index.php\" onclick=\"this.target='_blank';\">Перейти в новый конструктор</a></span>";
						} // if ($copy_result && add_directory_to_zip ...
					} // if (isset($_POST["install_to_client"]) ...
					
					// Сохранить шаблон
					if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_template"))
					{
						// Сохранение названия
						$new_title = trim($_POST["title"]);
						if ($new_title != "")
						{
							if ($new_title != $template["title"])
							{
								if (preg_match("#^[a-zа-яё0-9\-\(\)\,\.\s]+$#imsu", $new_title) == 1)
								{
									$sql = "SELECT COUNT(`title`) FROM `templates` WHERE `title`='$new_title'";
									$query_titles = mysql_query($sql);
									if ($query_titles && ($row_count = mysql_fetch_row($query_titles)))
									{
										if ($row_count[0] == 0)
										{
											$sql = "UPDATE `templates` SET `title`='$new_title' WHERE `id`=$id";
											$res = mysql_query($sql);
											if ($res && (mysql_affected_rows() == 1))
											{
												$message .= "<span class=\"success\">Название шаблона успешно изменено</span>";
												
												$template["title"] = $new_title;
												
												if ($template["status"] == 1)
												{
													$template_title = $new_title;
													$_SESSION["template_title"] = $new_title;
												}
											}
											else
												$message .= "<span class=\"error\">Название шаблона не изменено из-за ".get_error(1)."</span>";
										}
										else
											$message .= "<span class=\"error\">Шаблон с названием «{$new_title}» уже существует</span>";
									}
									else
										$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе существования нового названия</span>";
								}
								else
									$message .= "<span class=\"error\">Название шаблона может состоять из латинских и русских букв, цифр, тире, точки, запятой и скобок</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Название шаблона не может быть пустым</span>";
							
						// Сохранение каталога
						$new_catalog = trim($_POST["catalog"]);
						$old_catalog = $template["catalog"];
						if ($new_catalog != "")
						{
							if ($new_catalog != $old_catalog)
							{
								if (preg_match("#^[a-z0-9\_\-]+$#ims", $new_catalog) == 1)
								{
									$catalogs = list_dir($templates_path);
									if (!in_array($new_catalog, $catalogs))
									{
										if (rename($templates_path.$template["catalog"], $templates_path.$new_catalog))
										{
											$sql = "UPDATE `templates` SET `catalog`='$new_catalog' WHERE `id`=$id";
											$res = mysql_query($sql);
											if ($res && (mysql_affected_rows() == 1))
											{
												$message .= "<span class=\"success\">Каталог шаблона успешно переименован</span>";
												
												$template["catalog"] = $new_catalog;
												
												if ($template["status"] == 1)
												{
													$template_catalog = "/templates/".$new_catalog;
													$_SESSION["template_catalog"] = "/templates/".$new_catalog;
													set_template_paths($template_catalog);
												}
												
												// Переименовываем каталог шаблона в строковых константах
												$count_strings = 0;
												$sql = "SELECT * FROM `strings` WHERE `content` LIKE '%/templates/$old_catalog/%'";
												$query_strings = mysql_query($sql);
												if ($query_strings)
												{
													while ($string = mysql_fetch_array($query_strings))
													{
														$new_content = str_ireplace($old_catalog, $new_catalog, $string["content"]);
														$sql = "UPDATE `strings` SET `content`='$new_content' WHERE `id`={$string["id"]}";
														mysql_query($sql);
														if (mysql_affected_rows() == 1)
															$count_strings++;
														else
															$message .= "<span class=\"error\">Строковая константа string-{$string["id"]} не изменена из-за ".get_error(1)."</span>";
													}
												}
												else
													$message .= "<span class=\"info\">Произошла ".get_error(0)." при запросе строковых констант, содержащих каталог шаблона</span>";
												if ($count_strings > 0)
													$message .= "<span class=\"success\">Cтроковых констант с каталогом шаблона успешно изменено: $count_strings</span>";
											}
											else
												$message .= "<span class=\"error\">Каталог шаблона «{$template["catalog"]}» переименован на диске, но не сохранён в базе данных из-за ".get_error(1)."</span>";
										}
										else
											$message .= "<span class=\"error\">Каталог шаблона «{$template["catalog"]}» не переименован на диске из-за ".get_error(1)."</span>";
									}
									else												
										$message .= "<span class=\"error\">Каталог с названием «{$new_catalog}» уже существует</span>";
								}
								else
									$message .= "<span class=\"error\">Название каталога может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Название каталога не может быть пустым</span>";
							
						// Сохранение описания
						$new_description = trim($_POST["description"]);
						if ($new_description != "")
						{
							if ($new_description != $template["description"])
							{
								$sql = "UPDATE `templates` SET `description`='".addslashes($new_description)."' WHERE `id`=$id";
								mysql_query($sql);
								if (mysql_affected_rows() == 1)
									$message .= "<span class=\"success\">Описание шаблона успешно изменено</span>";
								else
									$message .= "<span class=\"error\">Описание шаблона не изменено из-за ".get_error(1)."</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Описание шаблона не может быть пустыми</span>";
						
						$error = "";
						
						// Сохранение css медиа-запросов
						foreach ($layouts as $layout)
						{
							// Сохранение названия css медиа-запроса
							$post_title = "layout-title-" . $layout["id"];
							if (isset($_POST[$post_title]))
							{
								$new_layout_title = trim($_POST[$post_title]);
								if (preg_match("#^[a-z0-9а-яё\_\-\s]+$#imsu", $new_layout_title) == 1)
								{
									if ($new_layout_title != $layout["title"])
									{
										$sql = "UPDATE `layouts` SET `title`='$new_layout_title' WHERE `id`={$layout["id"]}";
										mysql_query($sql);
										if (mysql_affected_rows() == 1)
										{
											$message .= "<span class=\"success\">Название css медиа-запроса «{$layout["title"]}» успешно изменено</span>";
											$layouts[$layout["id"]]["title"] = $new_layout_title;
										}
										else
											$message .= "<span class=\"error\">Название css медиа-запроса «{$layout["title"]}» не изменено из-за ".get_error(1)."</span>";
									}
								}
								else
									$message .= "<span class=\"error\">Название css медиа-запроса может состоять из латинских и русских букв, цифр, тире и знака подчёркивания</span>";
							}
							else
								$message .= "<span class=\"error\">Отсутствует название css медиа-запроса «{$layout["title"]}»</span>";
							
							// Сохранение заголовка css медиа-запроса
							$post_text = "layout-text-" . $layout["id"];
							if (isset($_POST[$post_text]))
							{
								$new_layout_text = str_replace('{', '', $_POST[$post_text]);
								$new_layout_text = str_replace('}', '', $new_layout_text);
								$new_layout_text = trim($new_layout_text);
								
								if ($new_layout_text != $layout["text"])
								{
									$sql = "UPDATE `layouts` SET `text`='".addslashes($new_layout_text)."' WHERE `id`={$layout["id"]}";
									mysql_query($sql);
									if (mysql_affected_rows() == 1)
									{
										$message .= "<span class=\"success\">Заголовок css медиа-запроса «{$layout["title"]}» успешно изменён</span>";
										$layouts[$layout["id"]]["text"] = $new_layout_text;
									}
									else
										$error .= "<span class=\"error\">Заголовок css медиа-запроса «{$layout["title"]}» не изменён из-за ".get_error(1)."</span>";
								}
							}
							else
								$error .= "<span class=\"error\">Отсутствует заголовок css медиа-запроса «{$layout["title"]}»</span>";
							
							// Сохранение порядка следования css медиа-запроса
							$post_sort = "layout-sort-" . $layout["id"];
							if (isset($_POST[$post_sort]))
							{
								$new_layout_sort = trim($_POST[$post_sort]);
								if (preg_match("#\d#ims", $new_layout_sort) == 1)
								{
									if ($new_layout_sort != $layout["sort"])
									{
										$sql = "UPDATE `layouts` SET `sort`=$new_layout_sort WHERE `id`={$layout["id"]}";
										mysql_query($sql);
										if (mysql_affected_rows() == 1)
										{
											$message .= "<span class=\"success\">Порядок следования css медиа-запроса «{$layout["title"]}» успешно изменён</span>";
											$layouts[$layout["id"]]["sort"] = $new_layout_sort;
											uasort($layouts, 'sorting_function');
										}
										else												
											$error .= "<span class=\"error\">Порядок следования css медиа-запроса «{$layout["title"]}» не изменён из-за ".get_error(1)."</span>";
									}
								}
								else
									$error .= "<span class=\"error\">Порядок следования css медиа-запроса должен быть числом</span>";
							}
							else
								$error .= "<span class=\"error\">Отсутствует порядок следования css медиа-запроса «{$layout["title"]}»</span>";
							
							// Сохранение текста css медиа-запросов
							$post_css = "css-" . $layout["id"];
							if (isset($_POST[$post_css]))
							{
								$new_css = $_POST[$post_css];
								$old_css = $layout["template_csstext"];
								
								if (strcmp($new_css, $old_css) != 0)
								{
									$file = $layout["template_cssfile"];
									if (file_put_contents($templates_path.$template["catalog"]."/styles/".$file, $new_css) !== false)
									{
										$message .= "<span class=\"success\">Текст css медиа-запроса «{$layout["title"]}» успешно изменён</span>";
										
										$layouts[$layout["id"]]["template_csstext"] = $new_css;
										
										if (!chmod_file($templates_path.$template["catalog"]."/styles/", $file))
											$message .= "<span class=\"info\">Полные права доступа к файлу стилей шаблона $file не установлены из-за ".get_error(1)."</span>";
									}
									else
										$error .= "<span class=\"error\">Текст css медиа-запроса «{$layout["title"]}» не изменён,<br />так как файл стилей шаблона $file не сохранён из-за ".get_error(1)."</span>";
								}
							}
							else
								$error .= "<span class=\"error\">Отсутствует текст файла стилей шаблона для css медиа-запроса «{$layout["title"]}»</span>";
						}
						
						// После успешного сохранения пересоздать сайт
						if ($error == "")
							$is_refresh_site = true;
						else
							$message .= $error;
					}
					
					// Открыть шаблон
					$row = array();
					$sql = "SELECT * FROM `templates` WHERE `id`=$id";
					$query = mysql_query($sql);
					if ($query && ($row = mysql_fetch_array($query)))
					{
						$row["caption"] = (mb_strlen($row["title"], "UTF-8") > 13) ? mb_substr($row["title"], 0, 12, "UTF-8")."..." : $row["title"];
							
						foreach ($layouts as $layout)
						{
							$title = $layouts[$layout["id"]]["title"];
							$layouts[$layout["id"]]["caption"] = (mb_strlen($title, "UTF-8") > 11) ? mb_substr($title, 0, 10, "UTF-8")."..." : $title;
						}
					}
					else
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе шаблона с id=$id</span>";
					
					$smarty->assign("template", $row);
					$smarty->assign("layouts", $layouts);								
					
					// Создание списка css-переменных
					$styles = array();
					$sql = "SELECT * FROM `styles` WHERE `template_id`=$id";
					$query_styles = mysql_query($sql);
					if ($query_styles)
					{
						while ($style = mysql_fetch_array($query_styles)) 
							$styles[] = $style;
					}
					else
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка css-переменных шаблона</span>";
					$smarty->assign("styles", $styles);
						
					// Создание списка изображений
					$count_images = 0;
					$list_images = array();
					$images_files = list_file($images_path, true, "", "db");
					foreach ($images_files as $index => $file)
					{
						$image = array();
						$image["id"]   = $count_images++;
						$image["src"]  = $template_catalog."/images/".$file;
						$image["file"] = $file;
						$list_images[] = $image;
					}
					$image_dirs = list_dir($images_path);
					foreach ($image_dirs as $dir)
					{
						$images_files = list_file($images_path.$dir."/", true, "", "db");
						foreach ($images_files as $index => $file)
						{
							$image = array();
							$image["id"]   = $count_images++;
							$image["src"]  = $template_catalog."/images/".$dir."/".$file;
							$image["file"] = $file;
							$list_images[] = $image;
						}
					}				
					$smarty->assign("list_images", $list_images);
					
					// Создание списка сайтов
					if ($is_superadmin && $is_server)
					{
						$sites = array();
						$sql = "SELECT * FROM `sites`";
						$query = mysql_query($sql);
						if ($query)
						{
							while ($row = mysql_fetch_array($query))
								$sites[] = $row;
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка установочных данных сайтов</span>";
						$smarty->assign("sites", $sites);
						
						$site = array();
						if (isset($_GET["site_id"]) && (intval($_GET["site_id"]) > 0))
						{
							$site_id = intval($_GET["site_id"]);
							$sql = "SELECT * FROM `sites` WHERE `id`=$site_id";
							if (($query = mysql_query($sql)) && ($site = mysql_fetch_array($query)))
								$is_success = true;
							else
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе установочных данных сайта с id=$site_id</span>";
						}
						else
						{
							$site["id"] 		= "0";
							$site["site_title"]	= "";
							$site["site_name"] 	= "";
							$site["site_ip"] 	= "";
							$site["ftp_server"] = "";
							$site["ftp_folder"] = "";
							$site["ftp_user"] 	= "";
							$site["ftp_pass"] 	= "";
							$site["db_host"] 	= "localhost";
							$site["db_name"] 	= "";
							$site["db_user"] 	= "";
							$site["db_pass"] 	= "";
							$site["forbidden_full_rights"]	= "0";
						}
						$smarty->assign("site", $site);
					}
				} // if ($is_css_sucess)
				else
					$_GET["type"] = "all";
			} // if ($_GET["type"] != "all")
		}
		else
		{
			$_GET["type"] = "all";
			
			if ($id != "-1")
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе шаблона с id=$id</span>";
		}
	}
	
	if ($_GET["type"] == "all")
	{
		$templates = array();
		$sql = "SELECT * FROM `templates` WHERE `id`>0";
		$query_templates = mysql_query($sql);
		if ($query_templates)
		{
			while ($template = mysql_fetch_array($query_templates))
				$templates[] = $template;
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка шаблонов</span>";
		$smarty->assign("templates", $templates);
	}
?>