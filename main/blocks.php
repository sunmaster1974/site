<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "all";
	
	$block_code = "";
	$blocks = array();
	$strings = array();
	
// Создание нового блока
if (isset($_POST["form_action"]) && ($_POST["form_action"] == "create_block"))
{
	if ($_POST["block_type"] == "block_mirror")
	{
		if (isset($_POST["realblock_id"]) && ($_POST["realblock_id"] != ""))
		{
			$block_id = $_POST["realblock_id"];
			create_mirror($page_id, $block_id, true);
		}
		else
			$message .= "<span class=\"error\">Не указан исходный блок для создания блока-ссылки</span>";
	}
	else
	{
		$new_block_title = trim($_POST["new_block_title"]);
		$new_block_file  = trim($_POST["new_block_file"]);
		$new_block_file  = str_ireplace(".tpl", "", $new_block_file);
		
		$temp_template_id = $template_id;
		$temp_blocks_path = $blocks_path;
		$temp_page_id = $page_id;
		$block_status = 1;
		$block_desc   = "";
		$word = "";
		$new_id = 0;
		
		$is_create_on_server = false;
			
		if ($_POST["block_type"] == "block_prototype")
		{
			$temp_template_id = 0;
			$temp_blocks_path = $prototypes_path;
			$temp_page_id = 0;
			$block_status = 2;
			$block_desc   = trim($_POST["prototype_description"]);
			$word = "-прототип";
			if (isset($_POST["create_on_server"]))
				$is_create_on_server = ($_POST["create_on_server"] == "yes") ? true : false;
			// Если создаётся блок-прототип - всегда случайный четырёхзначный id
			$new_id = rand(1000, 9999);
		}
		else
		{
			$sql = "SELECT MAX(`id`) FROM `blocks` WHERE `id`<1000";
			if ( ($query_max = mysql_query($sql)) && ($max = mysql_fetch_row($query_max)) )
				$new_id = intval($max[0]) + 1;
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе максимального номера блока</span>";
		}
		
		$result = check_names($temp_template_id, $temp_page_id, $temp_blocks_path, $new_block_title, $new_block_file, true, true);
		
		if ( ($result == "") && ($new_id > 0) )
		{
			// Код блока по умолчанию
			$new_block_code = "\t<div id=\"$new_block_file\">\n\t\t\n\t</div> <!-- #$new_block_file -->\n";
			
			// Код блока из настроек
			$sql = "SELECT * FROM `settings` WHERE `name`='block_html'";
			$query_setting = mysql_query($sql);
			if ($query_setting && ($setting = mysql_fetch_array($query_setting)))
			{
				if (strpos($setting["value"], '{$new_block_file_name}') !== false)
					$new_block_code = str_replace('{$new_block_file_name}', $new_block_file, $setting["value"]);
				else
					$new_block_code = $setting["value"];
			}
			else
			{
				if ($query_setting === false)
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «HTML-код нового блока»</span>";
				else
					$message .= "<span class=\"error\">Предустановка «HTML-код нового блока» не найденa в базе данных</span>";
			}
			
			// Код блока из блока-прототипа
			if ($_POST["block_type"] == "block_base")
			{
				$is_form = false;
				$patterns = array();
				$replacements = array();
				
				$prototype_file = $_POST["prototype_file"] . ".tpl";
				if (file_exists($prototypes_path.$prototype_file))
				{
					$prototype_text = file_get_contents($prototypes_path.$prototype_file);
					if ($prototype_text !== false)
					{
						$new_block_code = $prototype_text;
						
						// Создаём новые строковые константы, если они есть, и заменяем их в коде блока
						$new_block_code = double_strings("-прототипа", $new_block_code, true);
						
						// Заменяем id форм, если они есть, на id со счётчиком
						if (preg_match_all('#\<div.*?id\=[\"\']div_contact(\d)[\"\']#ims', $new_block_code, $matches) > 0)
						{
							foreach ($matches[1] as $form_id)
							{
								$sql = "SELECT `counter`,`title` FROM `forms` WHERE `id`=$form_id";
								$query_form = mysql_query($sql);
								if ($query_form && ($form = mysql_fetch_array($query_form)))
								{
									$is_form = true;
									
									$counter = intval($form["counter"]) + 1;
									$sql = "UPDATE `forms` SET `counter`='$counter' WHERE `id`=$form_id";
									mysql_query($sql);
									if (mysql_affected_rows() < 1)
										$message .= "<span class=\"info\">Счётчик добавлений формы «{$form["title"]}» не увеличен в базе данных из-за ".get_error(1)."</span>";
									
									$patterns[] = "/div_contact$form_id/";
									$replacements[] = "div_contact$form_id-$counter";
								}
								else
									$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$form_id</span>";
							}
							
							if ($is_form)
							{
								$text_replaced = preg_replace($patterns, $replacements, $new_block_code);
								if ($text_replaced !== null)
									$new_block_code = $text_replaced;
								else
									$message .= "<span class=\"error\">Счётчики добавлений форм не внесены в код блока из-за ".get_error(1)."</span>";
							}
						}
					}
					else
						$message .= "<span class=\"error\">Содержимое файла $prototype_file блока-прототипа не получено</span>";
				}
				else
					$message .= "<span class=\"error\">Файл $prototype_file блока-прототипа не найден</span>";
			}
			
			// Добавление блока в таблицу блоков
			$sort = get_max_sort($temp_page_id);
			$sql = "INSERT INTO `blocks` (`id`,`template_id`,`page_id`,`title`,`sort`,`description`,`file`,`status`) VALUES ($new_id, $temp_template_id,$temp_page_id,'$new_block_title',$sort,'$block_desc','$new_block_file.tpl',$block_status)";
			if (mysql_query($sql) && (mysql_affected_rows() == 1))
			{
				$is_blocks_list_changed = true;
				$insert_id = mysql_insert_id();
				
				$_GET["type"] = $insert_id;
				$message .= "<span class=\"success\">Новый блок{$word} «{$new_block_title}» успешно создан</span>";
				
				if ($is_create_on_server) $sql_create_on_server = $sql;
				
				// Сохранение файла блока
				if (file_put_contents($temp_blocks_path.$new_block_file.".tpl", $new_block_code) !== false)
				{
					$message .= "<span class=\"success\">Файл нового блок{$word}а $new_block_file.tpl успешно создан</span>";
					
					if (!chmod_file($temp_blocks_path, $new_block_file.".tpl"))
						$message .= "<span class=\"info\">Полные права доступа к файлу нового блок{$word}а $new_block_file.tpl не установлены из-за ".get_error(1)."</span>";
					
					// Заполнение массива css медиа-запросов
					$layouts = array();
					$layouts_prototypes = array();
					
					if ($_POST["block_type"] == "block_prototype")
					{
						$layouts = get_layouts_prototypes("", false);
						$styles_path = $prototypes_path;
					}
					else
					{
						$layouts = get_layouts($template_id, $styles_path, "");
						
						// Если новый блок создаётся на основе блока-прототипа, заполняем также массив css медиа-запросов блоков-прототипов
						if ($_POST["block_type"] == "block_base")
							$layouts_prototypes = get_layouts_prototypes($_POST["prototype_file"], false);
					}
					
					// Получаем css-правила из предустановки
					$sql = "SELECT * FROM `settings` WHERE `name`='block_css'";
					$query_setting = mysql_query($sql);
					if ($query_setting && ($setting = mysql_fetch_array($query_setting)))
					{
						if (strpos($setting["value"], '#new_block_file_name#') !== false)
							$new_css_code = str_replace('#new_block_file_name#', $new_block_file, $setting["value"]);
						else
							$new_css_code = $setting["value"];
					}
					else
					{
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «CSS-правила нового блока»</span>";
						// Css-правила по умолчанию
						$new_css_code = <<< EOB
#$css_title {
position111: relative;
height: 100px;
width: 100%;
background-image: url(back.jpg);
background-repeat: repeat-x;
background-position: 50% 0;
}
EOB;
					}
					
					// Создаём метки нового блока в файлах стилей блоков
					if (($layouts !== false) && ($layouts_prototypes !== false))
					{
						$i = 0;
						$count = 0;
						foreach ($layouts as $layout)
						{
							$css_title = $new_block_file;
							
							// Css-правила указанного блока-прототипа
							if ($_POST["block_type"] == "block_base")
							{
								if (isset($layouts_prototypes[$i]["block_csstext"]))
								{
									$new_css_code = $layouts_prototypes[$i]["block_csstext"];
									if ($is_form)
									{
										$text_replaced = preg_replace($patterns, $replacements, $new_css_code);
										if ($text_replaced !== null)
											$new_css_code = $text_replaced;
										else
											$message .= "<span class=\"error\">Счётчики добавлений форм не внесены в css медиа-запрос «{$layout["title"]}» из-за ".get_error(1)."</span>";
									}
								}
								else
									$new_css_code = "";
							}
							
							$new_blocks_csstext = rtrim($layout["blocks_csstext"]) . "\n\n/*$css_title*/\n$new_css_code\n/*/$css_title*/";
							
							$file = $layout["blocks_cssfile"];
							if (file_put_contents($styles_path.$file, $new_blocks_csstext) !== false)
							{
								$count++;
								
								if (!chmod_file($styles_path, $file))
									$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Метки нового блок{$word}а не добавлены в файл стилей $file,<br />так как он не сохранён из-за ".get_error(1)."</span>";
							$i++;
						}
						if ($count == count($layouts))
							$message .= "<span class=\"success\">Метки нового блок{$word}а успешно добавлены в файлы стилей</span>";
					}
					
					if ($is_create_on_server)
					{
						if ($new_id == $insert_id)
						{
							if (mysql_query_server($sql_create_on_server))
							{
								$message .= "<span class=\"success\">Новый блок-прототип «{$new_block_title}» успешно создан на сервере</span>";
								
								if (put_file_on_server($new_block_file.".tpl", $temp_blocks_path.$new_block_file.".tpl", true))
									$message .= "<span class=\"success\">Файл нового блока-прототипа $new_block_file.tpl успешно создан на сервере</span>";
								add_css_on_server($new_css_code, $new_block_file);
							}
						}
						else
							$message .= "<span class=\"error\">При создании нового блока-прототипа «{$new_block_title}» произошло нарушение уникальности номера записи<br />Попробуйте ещё раз создать этот блок-прототип на сервере</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Файл нового блок{$word}а $new_block_file.tpl не создан из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Новый блок{$word} «{$new_block_title}» не создан из-за ".get_error(1)."</span>";
		}
		else
			$message .= $result;
	}
	} // Создание нового блока
	
	// Создание дубликата блока (не прототипа)
	if (isset($_POST["form_action"]) && ($_POST["form_action"] == "double_block"))
	{
		$block_id = intval($_GET["type"]);
		
		$new_block_title = trim($_POST["new_block_title"]);
		$new_block_file  = trim($_POST["new_block_file"]);
		$new_block_file  = str_ireplace(".tpl", "", $new_block_file);
		
		// В режиме пользователя имя файла подбирается программно
		if (!$is_admin) $new_block_file = "";
		
		$new_block_id = double_block($page_id, $block_id, $new_block_title, $new_block_file, true, true);
		if ($new_block_id != 0) $_GET["type"] = $new_block_id;
	} // Создание дубликата блока
	
	// Действия на странице списка блоков 
	if (($_GET["type"] == "all") || ($_GET["type"] == "prototypes"))
	{
		// Дублировать блок-ссылку
		if (isset($_GET["action"]) && ($_GET["action"] == "double_mirror"))
		{
			if (isset($_GET["id"]) && ($_GET["id"] != ""))
			{
				$mirror_id = $_GET["id"];
				double_mirror($page_id, $mirror_id, true);
			}
			else
				$message .= "<span class=\"error\">Отсутствует идентификатор блока-ссылки для дублирования</span>";
		}
		
		// Удалить блок
		if (isset($_GET["action"]) && ($_GET["action"] == "delete"))
		{
			if (isset($_GET["id"]) && ($_GET["id"] != ""))
			{
				$block_id = $_GET["id"];
				
				// Удалить блок-ссылку
				if (isset($_GET["mirror"]) && ($_GET["mirror"] == "yes"))
				{
					$sql = "SELECT `blocks`.`title` FROM `mirrors` LEFT JOIN `blocks` ON `mirrors`.`block_id`=`blocks`.`id` WHERE `mirrors`.`id`=$block_id";
					$query_block = mysql_query($sql);
					if ($query_block && ($block = mysql_fetch_array($query_block)))
						delete_mirrors(0, 0, $block_id, $block["title"], "");
					else
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе блока-ссылки с id=$block_id</span>";
				}
				// Удалить обычный блок 
				else
				{
					$is_prototypes = ($_GET["type"] == "prototypes");
					
					$is_delete_mirrors = (isset($_GET["mirrors"]) && ($_GET["mirrors"] == "yes"));
					$is_delete_file    = (isset($_GET["file"])    && ($_GET["file"] == "yes"));
					$is_delete_css     = (isset($_GET["css"])     && ($_GET["css"] == "yes"));
					
					$is_on_server = (isset($_GET["server"]) && ($_GET["server"] == "yes")); // Удалить блок-прототип на сервере
					
					delete_block($block_id, $is_prototypes, $is_delete_mirrors, $is_delete_file, $is_delete_css, $is_on_server, true);
				}
			}
			else
				$message .= "<span class=\"error\">Отсутствует идентификатор блока для удаления</span>";
		}
		
		// Получение списка блоков для их отображения
		if ($_GET["type"] == "all")
		{
			$is_prototypes = "no";
			$words = "";
			$blocks = get_page_blocks($page_id, $page_name);
		}
		
		if ($_GET["type"] == "prototypes")
		{
			$is_prototypes = "yes";
			$words = "-прототипов";
			$blocks = get_page_blocks(0, "");
		}
		
		// Сохранение порядка следования, видимости и описания блоков-прототипов
		$count = 0;
		$data = array();
		$server_data = array();
		$is_sort_changed = false;
		$count_blocks = count($blocks);
		for ($i = 0; $i < $count_blocks; $i++)
		{
			// Сохранить сортировку и видимость блоков
			if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_sorts"))
			{
				if ($blocks[$i]["mirror"] == 0)
				{
					$table = "blocks";
					$word = "";
					$id = $blocks[$i]["id"];
				}
				
				if ($blocks[$i]["mirror"] == 1)
				{
					$table = "mirrors";
					$word = "-ссылки";
					$id = $blocks[$i]["mirror_id"];
				}
					
				$sort = trim($_POST["sort-$id"]);
				if (preg_match('#\d#ims', $sort) == 1)
				{
					if ($blocks[$i]["sort"] != $sort)
					{
						$sql = "UPDATE `$table` SET `sort`=$sort WHERE `id`=$id";
						if (mysql_query($sql))
						{
							if (mysql_affected_rows() == 1)
							{
								$count++;
								$is_sort_changed = true;
								$is_blocks_list_changed = true;
								$blocks[$i]["sort"] = $sort;
							}
						}
						else
							$message .= "<span class=\"error\">Порядок следования блока$word «{$blocks[$i]["title"]}» не изменён из-за ".get_error(1)."</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Порядок следования блока$word «{$blocks[$i]["title"]}» не является числом</span>";
				
				$status = (isset($_POST["status-$id"])) ? "1" : "0";
				if ($blocks[$i]["status"] != $status)
				{
					$sql = "UPDATE `$table` SET `status`=$status WHERE `id`=$id";
					if (mysql_query($sql))
					{
						if (mysql_affected_rows() == 1)
						{
							$count++;
							$is_blocks_list_changed = true;
							$blocks[$i]["status"] = $status;
						}
					}
					else
						$message .= "<span class=\"error\">Видимость блока$word «{$blocks[$i]["title"]}» не изменена из-за ".get_error(1)."</span>";
				}
			}
			
			// Сохранить описания блоков-прототипов
			if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_descs"))
			{
				$desc = trim($_POST["desc-{$blocks[$i]["id"]}"]);
				if ($desc != "")
				{
					if ($blocks[$i]["description"] != $desc)
					{
						$sql = "UPDATE `blocks` SET `description`='".addslashes($desc)."' WHERE `id`={$blocks[$i]["id"]}";
						mysql_query($sql);
						if (mysql_affected_rows() == 1)
						{
							$count++;
							$blocks[$i]["description"] = $desc;
						}
						else
							$message .= "<span class=\"error\">Описание блока-прототипа «{$blocks[$i]["title"]}» не изменено из-за ".get_error(1)."</span>";
					}
					
					if (isset($_POST["server-{$blocks[$i]["id"]}"]))
					{
						array_splice($data, 0);
						$data["sql"]     = "UPDATE `blocks` SET `description`='".addslashes($desc)."' WHERE `id`={$blocks[$i]["id"]}";
						$data["success"] = "Описание блока-прототипа «{$blocks[$i]["title"]}» успешно сохранено в базе данных сервера";
						$data["error"]   = "Описание блока-прототипа «{$blocks[$i]["title"]}» не сохранено в базе данных сервера из-за";
						$data["info"]    = "Блок-прототип «{$blocks[$i]["title"]}» не существует в базе данных сервера";
						
						$server_data[] = $data;
					}
				}
				else
					$message .= "<span class=\"error\">Описание блока-прототипа «{$blocks[$i]["title"]}» не может быть пустым</span>";
			}
		}
		if ($count > 0)
		{
			$message .= "<span class=\"success\">Параметры блоков$words успешно изменены</span>";
			if ($is_sort_changed) usort($blocks, "sorting_function");
			if ($is_prototypes == "no") $is_refresh_site = true;
		}
		if (count($server_data) > 0) save_to_server($server_data, "Описания блоков-прототипов успешно сохранены на сервере");
	}
	else
	{
		$block_id = intval($_GET["type"]);
		
		$block_title = "";
		$block_file  = "";
		$css_title   = "";
		
		$layouts = array();
		
		$sql = "SELECT * FROM `blocks` WHERE `id`=$block_id";
		if ( ($query_block = mysql_query($sql)) && ($block = mysql_fetch_array($query_block)) )
		{
			$block_title = $block["title"];
			$block_file  = $block["file"];					
			$css_title   = str_ireplace(".tpl", "", $block_file);
			
			$meta_title 	  = $block["meta_title"];
			$meta_description = $block["meta_description"];
			$meta_keywords 	  = $block["meta_keywords"];
			
			if ($block["status"] == 2)
			{
				$temp_blocks_path = $prototypes_path;
				$temp_styles_path = $prototypes_path;
				$temp_template_id = 0;
				$temp_page_id 	  = 0;
				$is_prototypes = "yes";
				
				$layouts = get_layouts_prototypes($css_title, false);
			}
			else
			{
				$temp_blocks_path = $blocks_path;
				$temp_styles_path = $styles_path;
				$temp_template_id = $template_id;
				$temp_page_id	  = $page_id;
				$is_prototypes = "no";
				
				$layouts = get_layouts($template_id, $styles_path, $css_title);
			}
			
			// Получение свойства страницы "SEO-оптимизированная"
			$page_scrollable = 0;
			$sql = "SELECT `scrollable` FROM `pages` WHERE `id`=$page_id";
			if ( ($query_page = mysql_query($sql)) && ($page_property = mysql_fetch_array($query_page)) )
				$page_scrollable = $page_property["scrollable"];
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе свойства «SEO-оптимизированная» страницы</span>";
			
			// Получение кода html блока
			$is_html_success = false;
			if (file_exists($temp_blocks_path.$block_file))
			{
				$text = file_get_contents($temp_blocks_path.$block_file);
				if ($text !== false)
				{
					$is_html_success = true;
					$block_code = $text;
				}
				else
					$message .= "<span class=\"error\">Код блока «{$block_title}» не получен из файла $block_file из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Файл $block_file блока «{$block_title}» не найден</span>";
			
			if ($is_html_success && ($layouts !== false))
			{
				// Добавить css-переменную
				if (isset($_GET["action"]) && ($_GET["action"] == "create_style"))
				{
					add_style($template_id);
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
	
				// Переименование блока
				if (isset($_POST["form_action"]) && ($_POST["form_action"] == "rename_block"))
				{
					$new_block_title = trim($_POST["new_block_title"]);
					$new_block_file  = trim($_POST["new_block_file"]);
					$new_block_file  = str_ireplace(".tpl", "", $new_block_file);
					
					$result = check_names($temp_template_id, $temp_page_id, $temp_blocks_path, $new_block_title, $new_block_file, ($block_title != $new_block_title), ($block_file != $new_block_file.".tpl"));
					
					if ($result == "")
					{
						// Переименовываем название блока
						if ($block_title != $new_block_title)
						{
							$sql = "UPDATE `blocks` SET `title`='$new_block_title' WHERE `id`=$block_id";
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
							{
								$is_blocks_list_changed = true;
								$message .= "<span class=\"success\">Блок «{$block_title}» успешно переименован в «{$new_block_title}»</span>";
								$block_title = $new_block_title;
							}
							else
								$message .= "<span class=\"error\">Блок «{$block_title}» не переименован из-за ".get_error(1)."</span>";
						}
						// else $message .= "<span class=\"info\">Новое и старое названия блока «{$block_title}» одинаковы</span>";
						
						// Переименовываем файл блока
						if ($block_file != $new_block_file.".tpl")
						{
							if (rename($temp_blocks_path.$block_file, $temp_blocks_path.$new_block_file.".tpl"))
							{
								$message .= "<span class=\"success\">Файл блока $block_file успешно переименован в $new_block_file.tpl</span>";
									
								$sql = "UPDATE `blocks` SET `file`='$new_block_file.tpl' WHERE `id`=$block_id";
								if (mysql_query($sql) && (mysql_affected_rows() == 1))
								{
									$message .= "<span class=\"success\">Имя файла блока $new_block_file.tpl успешно сохранено в базе данных</span>";
									
									// Переименовываем метки блока в файлах стилей блоков всех css медиа-запросов
									$count = 0;
									foreach ($layouts as $layout)
									{
										$file = $layout["blocks_cssfile"];
										$text = $layout["blocks_csstext"];
										
										$count_matches = 0;
										$new_text = preg_replace('#'.$css_title.'\*\/#ims', $new_block_file.'*/', $text, -1, $count_matches);
										if (($new_text !== null) && ($count_matches > 0))
										{
											if (file_put_contents($temp_styles_path.$file, $new_text) !== false)
											{
												$count++;
												$layouts[$layout["id"]]["blocks_csstext"] = $new_text;
												
												if (!chmod_file($temp_styles_path, $file))
													$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
											}
											else
												$message .= "<span class=\"error\">Метки блока в файле стилей $file не переименованы,<br />так как файл стилей не сохранён из-за ".get_error(1)."</span>";
										}
										else
											$message .= "<span class=\"error\">Метки блока в файле стилей $file не переименованы,<br />так как раздел, относящийся к блоку $block_file, не найден</span>";
									}
									if ($count == count($layouts))
										$message .= "<span class=\"success\">Метки блока успешно переименованы в файлах стилей</span>";
									
									$block_file = $new_block_file.".tpl";
									$css_title  = $new_block_file;
								}
								else
									$message .= "<span class=\"error\">Имя файла блока $new_block_file.tpl не сохранено в базе данных из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Файл блока $block_file не переименован из-за ".get_error(1)."</span>";
						}
						// elseif ($is_admin) $message .= "<span class=\"info\">Новое и старое имена файла блока $block_file одинаковы</span>";
					}
					else
						$message .= $result;
				}
				
				// Действия в режиме администратора
				if ($is_admin)
				{
					// Добавить переменную
					if (isset($_GET["action"]) && ($_GET["action"] == "add_variable"))
					{
						add_variable($block["page_id"]);
					}
					
					// Удалить переменную
					if (isset($_GET["action"]) && ($_GET["action"] == "delete_variable"))
					{
						delete_variable($block["page_id"]);
					}
					
					// Сохранить значения переменных
					if (isset($_GET["action"]) && ($_GET["action"] == "save_variables"))
					{
						save_variables();
					}
			
					// Внесение css-правил генератора стилей
					if (isset($_POST["form_action"]) && ($_POST["form_action"] == "add_text_styles"))
					{
						$generator_css = generate_text_styles();
						
						if ($generator_css != "")
						{
							$message .= "<span class=\"success\">Css-правила для текста успешно получены</span>";
							
							$count = 0;
							foreach ($layouts as $layout)
							{
								$count_replaces = 0;
								$file = $layout["blocks_cssfile"];
								
								$new_block_text  = $layout["block_csstext"] . "\n\n" . $generator_css;
								$new_blocks_text = preg_replace('#\/\*'.$css_title.'\*\/.*?\/\*\/'.$css_title.'\*\/#ims', '/*'.$css_title.'*/'."\n".$new_block_text."\n".'/*/'.$css_title.'*/', $layout["blocks_csstext"], -1, $count_replaces);
								
								if (($new_blocks_text !== null) && ($count_replaces == 1))
								{
									if (file_put_contents($temp_styles_path.$file, $new_blocks_text) !== false)
									{
										$count++;
										
										$layouts[$layout["id"]]["blocks_csstext"] = $new_blocks_text;
										$layouts[$layout["id"]]["block_csstext"]  = $new_block_text;
										
										if (!chmod_file($temp_styles_path, $file))
											$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
									}
									else
										$message .= "<span class=\"error\">Сss-правила блока не сохранены,<br />так как файл стилей $file не сохранён из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Сss-правила блока не сохранены,<br />так как метки блока $css_title не найдены в файле стилей $file</span>";
							}
							if ($count == count($layouts))
								$message .= "<span class=\"success\">Css-правила блока успешно сохранены</span>";
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
							
							// В блок-прототип с одним и тем же id форму второй раз добавлять нельзя
							$is_success = true;
							if ($block["status"] == 2)
							{
								if (strpos($block_code, "div_contact$form_id") !== false)
									$is_success = false;
							}
							
							if ($is_success)
							{
								if ($form_link != "")
									$form_code = $form_link . "\n" . $form_code;
								$form_code = "\n\n" . preg_replace("#^(.*?)$#ims", "\t\t$1", $form_code) . "\n";
								
								// Для блока-прототипа счётчик не нужен
								if ($block["status"] != 2)
								{
									$counter = intval($form["counter"]) + 1;
									
									$sql = "UPDATE `forms` SET `counter`='$counter' WHERE `id`=$form_id";
									mysql_query($sql);
									if (mysql_affected_rows() == 0)
										$message .= "<span class=\"error\">Счётчик добавлений формы не изменён из-за ".get_error(1)."</span>";
									
									$counter = "-" . $counter;
								}
								else
									$counter = "";
								
								// Вносим в код блока код формы
								$number = $form_id . $counter;
								$form_code = str_replace("div_contact", "div_contact$number", $form_code);
								$count_replaces = 0;
								$result = preg_replace('#^(\s*)\<div(.*?)\>(.*?)$#is', '$1<div$2>'.$form_code.'$3', $block_code, -1, $count_replaces);
								if (($result !== null) && ($count_replaces == 1))
									$new_block_code = $result;
								else
									$new_block_code = $block_code . $form_code;
								
								// Сохраняем код блока
								if (file_put_contents($temp_blocks_path.$block_file, $new_block_code) !== false)
								{
									$block_code = $new_block_code;
									$message .= "<span class=\"success\">Код блока успешно сохранён</span>";
									
									if (!chmod_file($temp_blocks_path, $block_file))
										$message .= "<span class=\"info\">Полные права доступа к файлу блока $block_file не установлены из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Код блока не сохранён в файле $block_file из-за ".get_error(1)."</span>";
								
								// Сохраняем css-правила блока
								if ($form_css != "")
								{
									$form_css  = str_replace("div_contact", "div_contact$number", $form_css);
								
									$form_css  = preg_replace("#^(\s*)\#(.*?)$#ims", "$1#div_contact$number #$2", $form_css);
									$form_css  = preg_replace("#^(\s*)\.(.*?)$#ims", "$1#div_contact$number .$2", $form_css);
									
									$count = 0;
									foreach ($layouts as $layout)
									{
										$count_replaces = 0;
										$file = $layout["blocks_cssfile"];
										
										$new_block_text  = $layout["block_csstext"] . "\n\n" . $form_css;
										$new_blocks_text = preg_replace('#\/\*'.$css_title.'\*\/.*?\/\*\/'.$css_title.'\*\/#ims', '/*'.$css_title.'*/'."\n".$new_block_text."\n".'/*/'.$css_title.'*/', $layout["blocks_csstext"], -1, $count_replaces);
										
										if (($new_blocks_text !== null) && ($count_replaces == 1))
										{
											if (file_put_contents($temp_styles_path.$file, $new_blocks_text) !== false)
											{
												$count++;
												
												$layouts[$layout["id"]]["blocks_csstext"] = $new_blocks_text;
												$layouts[$layout["id"]]["block_csstext"]  = $new_block_text;
												
												if (!chmod_file($temp_styles_path, $file))
													$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
											}
											else
												$message .= "<span class=\"error\">Сss-правила блока не сохранены,<br />так как файл стилей $file не сохранён из-за ".get_error(1)."</span>";
										}
										else
											$message .= "<span class=\"error\">Сss-правила блока не сохранены,<br />так как метки блока $css_title не найдены в файле стилей $file</span>";
									}
									if ($count == count($layouts))
										$message .= "<span class=\"success\">Css-правила блока успешно сохранены</span>";
								}
							}
							else
								$message .= "<span class=\"error\">В этом блоке-прототипе форма «{$form["title"]}» уже присутствует</span>";
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$form_id</span>";
					}
				
					// Разбор блока на текстовые константы
					if (isset($_POST["form_action"]) && ($_POST["form_action"] == "parse_block"))
					{
						if (preg_match_all('#\{\$string\-\d+\}#is', $block_code, $matches) == 0)
						{
							$new_block_code = $block_code;
							
							// Замена текстовых значений
							if (preg_match_all('#<(\w+)[^\>]+class\s*\=\s*[\"\'].*?\bstring\b.*?[\"\'].*?>(.*?)<\/\1>#ims', $new_block_code, $matches_strings) > 0)
							{
								$count = 0;
								foreach ($matches_strings[2] as $content)
								{
									$title = preg_replace('#<br\s?\/?>#i', ' ', $content);
									$title = strip_tags(trim($title));
									$title = mb_strtolower($title, "UTF-8");
									$title = preg_replace('#\s+#is', ' ', $title);
									$words = explode(" ", $title);
									array_splice($words, 3); // Первые три слова
									$title = implode(" ", $words);
									$title = mb_ucfirst($title);
									
									$sql = "INSERT INTO `strings`(`title`,`content`) VALUES ('$title','".addslashes($content)."')";
									mysql_query($sql);
									if (mysql_affected_rows() == 1)
									{
										$count++;
										$string_id = mysql_insert_id();
										$new_block_code = str_replace($content, '{$string-'.$string_id.'}', $new_block_code);
									}
									else
										$message .= "<span class=\"error\">Текстовый элемент «{$content}» не добавлен в качестве строковой константы из-за ".get_error(1)."</span>";
								}
								
								if (($count > 0) && ($count == count($matches_strings[2])))
								{
									$message .= "<span class=\"success\">Строковые константы с текстом успешно созданы</span>";
									
									// Если у элемента класс string один - убрать вместе с атрибутом class
									$new_block_code = preg_replace('#\sclass\s*\=\s*[\"\']string[\"\']#ims', '', $new_block_code);
									// Если у элемента класс string не один - убрать только класс string
									$new_block_code = preg_replace('#(\sclass\s*\=\s*[\"\'].*?)\bstring\b(.*?[\"\'])#ims', '$1$2', $new_block_code);
								}
							}
							else
								$message .= "<span class=\"info\">Текстовые элементы с классом string отсутствуют</span>";
								
							// Замена атрибутов src изображений
							if (preg_match_all('#<img.*?src[ ]*\=[ ]*[\"\'](.*?)[\"\']#ims', $new_block_code, $matches_images) > 0)
							{
								$count = 0;
								foreach ($matches_images[1] as $file)
								{
									$parts = pathinfo($file);
									$title = $parts["filename"];
									if (!empty($parts["extension"]))
									{
										$path = trim($template_catalog."/images", "/");
										if (stripos($file, $path) === false)
											$content = $template_catalog."/images/" . $file;
										else
											$content = $file;
										
										$sql = "INSERT INTO `strings` (`title`,`content`) VALUES ('$title','$content')";
										if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
										{
											$count++;
											$string_id = mysql_insert_id();
											$new_block_code = str_replace($file, '{$string-'.$string_id.'}', $new_block_code);
										}
										else
											$message .= "<span class=\"error\">Атрибут src изображения $file не добавлен в качестве строковой константы из-за ".get_error(1)."</span>";
									}
									else
										$message .= "<span class=\"error\">Атрибут src изображения $file не является файлом (нет расширения)</span>";
								}
								if (($count > 0) && ($count == count($matches_images[1])))
									$message .= "<span class=\"success\">Строковые константы с изображениями успешно созданы</span>";
							}
							else
								$message .= "<span class=\"info\">Теги изображений img со свойством src отсутствуют</span>";
							
							// Сохранение кода блока
							if (file_put_contents($temp_blocks_path.$block_file, $new_block_code) !== false)
							{
								$block_code = $new_block_code;
								$message .= "<span class=\"success\">Код блока успешно сохранён</span>";
								
								if (!chmod_file($temp_blocks_path, $block_file))
									$message .= "<span class=\"info\">Полные права доступа к файлу блока $block_file не установлены из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Код блока не сохранён в файле $block_file из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Разбор блока невозможен, так как в коде блока уже присутствуют строковые константы вида {\$string-n}.<br />Для повтора разбора блока удалите в коде блока все строковые константы.</span>";
					}
					
					// Сохранение кода блока и файлов стилей блоков
					if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_block"))
					{
						$block_save_success = true;
						$css_save_success   = true;
						
						$new_block_code = htmlspecialchars_decode($_POST["block_code"]);
						
						if ($page_scrollable == 1)
						{
							$new_meta_title 	  = trim($_POST["meta_title"]);
							$new_meta_description = trim($_POST["meta_description"]);
							$new_meta_keywords 	  = trim($_POST["meta_keywords"]);
							
							if ( ($meta_title != $new_meta_title) || ($meta_description != $new_meta_description) || ($meta_keywords != $new_meta_keywords) )
							{
								$sql = "UPDATE `blocks` SET `meta_title`='$new_meta_title', `meta_description`='$new_meta_description', `meta_keywords`='$new_meta_keywords' WHERE `id`=$block_id";
								if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
								{
									$message .= "<span class=\"success\">Мета-теги блока успешно изменены</span>";
									
									$meta_title 	  = $new_meta_title;
									$meta_description = $new_meta_description;
									$meta_keywords 	  = $new_meta_keywords;
								}
								else
									$message .= "<span class=\"error\">Мета-теги блока не изменены из-за ".get_error(1)."</span>";
							}
						}
						
						$new_block_css = array();
						foreach ($layouts as $layout)
						{
							$post_title = "css_code-" . $layout["id"];
							$new_block_css[$layout["id"]] = htmlspecialchars_decode($_POST[$post_title]);
						}
						
						if ($new_block_code != $block_code)
						{
							if (file_put_contents($temp_blocks_path.$block_file, $new_block_code) !== false)
							{
								$block_code = $new_block_code;
								$message .= "<span class=\"success\">Код блока успешно сохранён</span>";
								
								if (!chmod_file($temp_blocks_path, $block_file))
									$message .= "<span class=\"info\">Полные права доступа к файлу блока $block_file не установлены из-за ".get_error(1)."</span>";
							}
							else
							{
								$block_save_success = false;
								$message .= "<span class=\"error\">Код блока не сохранён в файле $block_file из-за ".get_error(1)."</span>";
							}
						}
						
						$count = 0;
						foreach ($layouts as $layout)
						{
							$blocks_text = $layout["blocks_csstext"];
							$block_text  = $layout["block_csstext"];

							$new_block_text = $new_block_css[$layout["id"]];
							
							if (isset($_POST["save_to_server"]) && ($_POST["save_to_server"] == "yes"))
							{
								$layouts[$layout["id"]]["layout_server_id"] = preg_replace('#\D#ims', "", $_POST["layout_client_{$layout["id"]}"]);
								$layouts[$layout["id"]]["new_block_text"]   = $new_block_text;
							}
							
							if ($new_block_text != $block_text)
							{
								$count_replaces = 0;
								$file = $layout["blocks_cssfile"];
							
								$new_blocks_text = preg_replace('#\/\*'.$css_title.'\*\/.*?\/\*\/'.$css_title.'\*\/#ims', '/*'.$css_title.'*/'."\n".$new_block_text."\n".'/*/'.$css_title.'*/', $blocks_text, -1, $count_replaces);
								
								if (($new_blocks_text != null) && ($count_replaces == 1))
								{
									if (file_put_contents($temp_styles_path.$file, $new_blocks_text) !== false)
									{
										$count++;
										
										$layouts[$layout["id"]]["blocks_csstext"] = $new_blocks_text;
										$layouts[$layout["id"]]["block_csstext"]  = $new_block_text;
										
										if (!chmod_file($temp_styles_path, $file))
											$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
									}
									else
									{
										$css_save_success = false;
										$message .= "<span class=\"error\">Css-правила блока не сохранены,<br />так как файл стилей $file не сохранён из-за ".get_error(1)."</span>";
									}
								}
								else
								{
									$css_save_success = false;
									$message .= "<span class=\"error\">Css-правила блока не сохранены,<br />так как метки блока $css_title не найдены в файле стилей $file</span>";
								}
							}
						}
						if (($count > 0) && $css_save_success)
							$message .= "<span class=\"success\">Css-правила блока успешно сохранены</span>";
						
						if ($block_save_success && $css_save_success)
						{
							// Если сохраняется блок-прототип - пересоздавать сайт не надо
							if ($block["status"] != 2) $is_refresh_site = true;
						}
					}
				} // if ($is_admin)
					
				// Загрузка изображения в качестве строковой константы
				if (isset($_FILES["uploadfile"]))
				{
					if ($_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK)
					{
						$parts = pathinfo($_FILES["uploadfile"]["name"]);
						$parts["filename"] = translit_name($parts["filename"]);
						$name = $parts["filename"] . "." . $parts["extension"];
					 
						$i = 0;
						while (file_exists($images_path.$name))
						{
							$i++;
							$name = $parts["filename"]."-".$i.".".$parts["extension"];
						}
						
						if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $images_path.$name))
						{
							$message .= "<span class=\"success\">Файл изображения успешно загружен</span>";
							
							$sql = "UPDATE `strings` SET `content`='$template_catalog/images/$name' WHERE `id`={$_GET["id"]}";
							if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
								$message .= "<span class=\"success\">Строковая константа string-{$_GET["id"]} успешно изменена</span>";
							else
								$message .= "<span class=\"error\">Строковая константа string-{$_GET["id"]} не изменена из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Файл изображения не загружен из-за ".get_error(1)." перемещения</span>";
					}
					else
						$message .= "<span class=\"error\">Файл изображения не загружен из-за ".get_error(1)." загрузки</span>";
				}
				
				// Внесение изображения из списка изображений для строковой константы
				if (isset($_POST["selected_image"]))
				{
					$sql = "UPDATE `strings` SET `content`='{$_POST["selected_image"]}' WHERE `id`={$_POST["selected_string"]}";
					if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
						$message .= "<span class=\"success\">Изображение успешно записано в строковую константу</span>";
					else
						$message .= "<span class=\"error\">Изображение не записано в строковую константу из-за ".get_error(1)."</span>";
				}
				
				// Считываем из кода блока все строковые константы, предварительно сохраняя, если была нажата кнопка Сохранить
				if (preg_match_all('#\{\$string\-([0-9]{1,10})\}#ims', $block_code, $matches) > 0)
				{
					$count = 0;
					$unique_matches = array_unique($matches[1]);
					foreach ($unique_matches as $id)
					{
						$sql = "SELECT * FROM `strings` WHERE `id`=$id";
						if ( ($query_string = mysql_query($sql)) && ($string = mysql_fetch_array($query_string)) )
						{
							if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_block"))
							{
								if (isset($_POST["title-$id"]))
								{
									$new_title = trim(htmlspecialchars_decode($_POST["title-$id"]));
									if ($new_title != "")
									{
										if ($string["title"] != $new_title)
										{
											$sql = "UPDATE `strings` SET `title`='".addslashes($new_title)."' WHERE `id`=$id";
											if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
											{
												$count++;
												$string["title"] = $new_title;
											}
											else
												$message .= "<span class=\"error\">Название строковой константы string-$id не изменено из-за ".get_error(1)."</span>";										  }
									}
									else
										$message .= "<span class=\"error\">Название строковой константы string-$id не может быть пустым</span>";
								}
								
								if (isset($_POST["content-$id"]))
								{
									$new_content = trim(htmlspecialchars_decode($_POST["content-$id"]));
									if ($new_content != "")
									{
										if ($string["content"] != $new_content)
										{
											$sql = "UPDATE `strings` SET `content`='".addslashes($new_content)."' WHERE `id`=$id";
											if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
											{
												$count++;
												$string["content"] = $new_content;
											}
											else											
												$message .= "<span class=\"error\">Содержимое строковой константы string-$id не изменено из-за ".get_error(1)."</span>";
										}
									}
									else
										$message .= "<span class=\"error\">Содержимое строковой константы string-$id не может быть пустым</span>";
								}
							}
							
							$string["is_image"] = (strpos($string["content"], "images/") !== false);
							$string["title"]    = htmlspecialchars($string["title"]);
							$string["content"]  = htmlspecialchars($string["content"]);
							
							$strings[] = $string;
						}
						else
						{
							if ($query_string === false)
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе строковой константы string-$id</span>";
							else
								$message .= "<span class=\"error\">Строковая константа string-$id не найдена в базе данных</span>";
						}
					}
					
					if (isset($_POST["form_action"]) && ($_POST["form_action"] == "save_block"))
					{
						if ($count > 0)
						{
							// Если сохраняются константы блока-прототипа - пересоздавать сайт не надо
							if ($block["status"] != 2) $is_refresh_site = true;
							$message .= "<span class=\"success\">Строковые константы успешно сохранены</span>";
						}
					}
				}
				
				// Добавление новой строковой константы
				if (isset($_POST["form_action"]) && ($_POST["form_action"] == "add_string"))
				{
					$new_title = trim($_POST["new_string_title"]);
					
					if ($new_title != "")
					{
						// Для блока-прототипа четырёхзначный id константы всегда выбирается случайно
						$new_id = 0;
						if ($block["status"] == 2)
							$new_id = rand(1000, 9999);
						else
						{
							$sql = "SELECT MAX(`id`) FROM `strings` WHERE `id`<1000";
							if ( ($query_max = mysql_query($sql)) && ($max = mysql_fetch_row($query_max)) )
								$new_id = intval($max[0]) + 1;
							else
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе максимального номера строковой константы</span>";
						}
						
						if ($new_id > 0)
						{
							$sql = "INSERT INTO `strings` (`id`, `title`) VALUES ($new_id, '".addslashes($new_title)."')";
							if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
							{
								$message .= "<span class=\"success\">Строковая константа «{$new_title}» успешно добавлена</span>";
								
								$new_row = array();
								
								$new_row["id"] 	     = mysql_insert_id();
								$new_row["title"]    = $new_title;
								$new_row["content"]  = "";
								$new_row["is_image"] = false;
								
								$strings[] = $new_row;
							}
							else
								$message .= "<span class=\"error\">Строковая константа «{$new_title}» не добавлена из-за ".get_error(1)."</span>";
						}
					}
					else
						$message .= "<span class=\"error\">Название строковой константы не может быть пустым</span>";
				}
				
				// Сохранение блока на сервере
				if (isset($_POST["save_to_server"]) && ($_POST["save_to_server"] == "yes"))
				{
					$is_codes_differs = true;
					$path = "http://" . $server_name . str_replace(ROOT, "", $prototypes_path);
					$old_block_code = file_get_contents($path.$block_file);
					if ($old_block_code !== false)
					{
						$old_block_code = str_replace("\n", "\r\n", $old_block_code); // Из Dos/Windows в UNIX
						if (strcmp($old_block_code, $new_block_code) == 0)
							$is_codes_differs = false;
					}
					
					if ($is_codes_differs)
						if (put_file_on_server($block_file, $temp_blocks_path.$block_file))
							$message .= "<span class=\"success\">Код блока-прототипа успешно сохранён на сервере</span>";
					
					create_strings_on_server($block_code, $block_file);
					replace_css_on_server($css_title);
				}
				
				foreach ($layouts as $layout)
				{
					$layouts[$layout["id"]]["block_csstext"] = htmlspecialchars($layouts[$layout["id"]]["block_csstext"]);
					$layouts[$layout["id"]]["hint"] = htmlspecialchars(str_replace("\r\n", "<br />", $layouts[$layout["id"]]["text"]));
					$title = $layouts[$layout["id"]]["title"];
					$layouts[$layout["id"]]["caption"] = (mb_strlen($title, "UTF-8") > 11) ? mb_substr($title, 0, 10, "UTF-8")."..." : $title;
				}
				
				// Для блока-прототипа, если суперадмин и на клиенте - создать список css медиа-запросов на сервере
				if (($block["status"] == 2) && $is_superadmin && !$is_server)
				{
					// Создание списка css медиа-запросов на сервере
					$layouts_server = array();
					$layouts_server = get_layouts_prototypes("", true);
					$smarty->assign("layouts_server", $layouts_server);
				}
			} // if ($is_html_success && ($layouts !== false))
			
			// Создание списка изображений
			$list_images = array();
			$count_images = 0;
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
			
			// Создание списка форм
			$list_forms = array();
			$sql = "SELECT `id`, `title`, `modal` FROM `forms` ORDER BY `id`";
			if ($query_forms = mysql_query($sql))
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
			
			// Создание списка css-переменных
			$styles = array();
			$sql = "SELECT * FROM `styles` WHERE `template_id`=$temp_template_id ORDER BY `id`";
			if ($query_styles = mysql_query($sql))
			{
				while ($style = mysql_fetch_array($query_styles))
					$styles[] = $style;
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка css-переменных шаблона с id=$temp_template_id</span>";
			$smarty->assign("styles", $styles);
			
			// Создание списка переменных страницы
			$variables = array();
			$sql = "SELECT * FROM `variables` WHERE `page_id`={$block["page_id"]} ORDER BY `id`";
			if ($query_variables = mysql_query($sql))
			{
				while ($variable = mysql_fetch_array($query_variables)) 
					$variables[] = $variable;
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка переменных страницы</span>";
			$smarty->assign("variables", $variables);
		}
		else
		{
			if ($query_block === false)
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе блока с id=$block_id</span>";
			else
				$message .= "<span class=\"error\">Блок с id=$block_id не найден в базе данных</span>";
		}
		
		$smarty->assign("page_scrollable", 	$page_scrollable);
		$smarty->assign("meta_title", 		$meta_title);
		$smarty->assign("meta_description", $meta_description);
		$smarty->assign("meta_keywords", 	$meta_keywords);
		
		$smarty->assign("layouts", $layouts);
		if (mb_strlen($block_title, "utf-8") > 11)
			$block_title = mb_substr($block_title, 0, 10, "utf-8")."...";					
		
		$smarty->assign("block_title", $block_title);
		$smarty->assign("block_file", $block_file);
	} // Страница редактирования блока
	
	// Создание списка блоков-прототипов для создания блока на основе прототипа
	$prototypes = array();
	$sql = "SELECT * FROM `blocks` WHERE `status`=2 ORDER BY `sort`,`id`";
	if ($query_prototypes = mysql_query($sql))
	{
		while ($block = mysql_fetch_array($query_prototypes))
		{
			$block["file"] = str_ireplace(".tpl", "", $block["file"]);
			$prototypes[] = $block;
		}
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков-прототипов</span>";
	$smarty->assign("prototypes", $prototypes);
	
	// Создание списка реальных блоков для создания блока-ссылки
	$realblocks = array();
	$sql = "SELECT * FROM `blocks` WHERE (`status`=0 OR `status`=1) AND `template_id`=$template_id ORDER BY `sort`,`id`";
	if ($query_blocks = mysql_query($sql))
	{
		while ($block = mysql_fetch_array($query_blocks))
			$realblocks[] = $block;
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков шаблона</span>";
	$smarty->assign("realblocks", $realblocks);
	
	$smarty->assign("block_code", htmlspecialchars($block_code));
	$smarty->assign("strings", $strings);
	$smarty->assign("blocks", $blocks);
	$smarty->assign("is_prototypes", $is_prototypes);
?>