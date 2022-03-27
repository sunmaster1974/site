<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "main";
	
	if ($_GET["type"] == "main")  	 $type = 0;
	if ($_GET["type"] == "counters") $type = 1;
	if ($_GET["type"] == "defaults") $type = 3;
	if ($_GET["type"] == "scripts")  $type = 4;
	
	$server_data = array();
	$data = array();
	
	// Сохранить настройки
	if (isset($_POST["save_settings"]))
	{
		$sql = "SELECT * FROM `settings` WHERE `type`=$type";
		$query_setting = mysql_query($sql);
		if ($query_setting)
		{
			$settings_count = 0;
			$settings_success = true;
			
			while ($setting = mysql_fetch_array($query_setting))
			{
				$setting_success = true;
				
				$name  = $setting["name"];
				$value = rtrim($_POST[$name]);
				
				// На клиентском сайте сохранять, только если значение изменено. Если суперадмин - сохранять, если поставлена галочка
				if ( ($value != $setting["value"]) || (($_GET["type"] == "defaults") && (isset($_POST[$name."_server"]))) )
				{
					// Основные настройки сайта
					if ($_GET["type"] == "main")
					{
						if ($name == "orders_email")
						{
							if ($value != "")
							{
								$emails = explode(",", $value);
								foreach ($emails as $email)
								{
									//if (filter_var(trim($email), FILTER_VALIDATE_EMAIL) === false)
									if (preg_match('#.*?\@.*?\..*?#', trim($email)) !== 1)
									{
										$setting_success = false;
										$message .= "<span class=\"error\">Электронный адрес $email является некорректным</span>";
									}
								}
							}
							else
							{
								$setting_success = false;
								$message .= "<span class=\"error\">Электронный адрес не может быть пустым</span>";
							}
						}
					}
					
					// Предустановки конструктора
					if ($_GET["type"] == "defaults")
					{
						if ($name == "page_body")
						{
							if (preg_match("#\<\!\-\-\s*start_blocks\s*\-\-\>\s*\<\!\-\-\s*end_blocks\s*\-\-\>#ims", $value) < 1)
							{
								$setting_success = false;
								$message .= "<span class=\"error\">В предустановке «{$setting["title"]}» не найдены метки start_blocks и end_blocks</span>";
							}
						}
						
						if ($name == "css_variables")
						{
							// Удалить сначала из таблицы все css-переменные для блоков-прототипов (если они есть)
							$sql = "SELECT `id` FROM `styles` WHERE `template_id`=0";
							$query_styles = mysql_query($sql);
							if ($query_styles && (mysql_num_rows($query_styles) > 0))
							{
								$sql = "DELETE FROM `styles` WHERE `template_id`=0";
								mysql_query($sql);
								if (mysql_affected_rows() == 0)
									$message .= "<span class=\"info\">Прошлые css-переменные для блоков-прототипов не удалены из-за ".get_error(1)."</span>";
							}
							elseif ($query_styles === false)
								$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка css-переменных для блоков-прототипов</span>";
							
							$value = trim($value);
							if ($value != "")
							{
								$count_preg = preg_match_all('#\$([\w\d\-\_]+)\=(.*?)\;#is', $value, $matches);										
								if ($count_preg > 0)
								{
									$count_insert = 0;
									foreach ($matches[1] as $index => $var_name)
									{
										$sql = "INSERT INTO `styles`(`template_id`,`name`,`value`) VALUES (0,'$var_name','".addslashes($matches[2][$index])."')";
										mysql_query($sql);
										if (mysql_affected_rows() == 1)
											$count_insert++;
										else
										{
											$setting_success = false;
											$message .= "<span class=\"error\">Css-переменная $var_name не добавлена из-за ".get_error(1)."</span>";
										}
									}
									if ($count_preg == $count_insert)
										$message .= "<span class=\"success\">Список css-переменных успешно обновлён</span>";
								}
								else
								{
									$setting_success = false;
									$message .= "<span class=\"info\">В предустановке «{$setting["title"]}» не найдены css-переменные в виде: $<имя>=<значение>;</span>";
								}
							}
						}
						
						if ($name == "prototypes_css")
						{
							$value = trim($value);
							if ($value != "")
							{
								$count_strings = substr_count($value, "\n") + 1;
								$count_preg = preg_match_all('#^([а-яё0-9\-\_]+) ([a-z0-9\-\_]+)\s?(\/\*.*?\*\/)?\s?(\@media.*?)?$#imu', $value, $matches);
								if ($count_preg > 0)
								{
									if ($count_preg == $count_strings)
									{
										// Создаём текст с отметками всех блоков-прототипов
										$blocks_text = "";
										$sql = "SELECT `file` FROM `blocks` WHERE `status`=2 ORDER BY `id`";
										$query_blocks = mysql_query($sql);
										if ($query_blocks)
										{
											while ($block = mysql_fetch_array($query_blocks))
											{
												$css_title = str_ireplace(".tpl", "", $block["file"]);
												$blocks_text .= "/*$css_title*/\n\n/*/$css_title*/\n\n";
											}
											
											// Создаём файлы-стилей блоков-прототипов введённых css медиа-запросов
											for ($i = 0; $i < $count_preg; $i++)
											{
												$file = $blocks_css . "-" . $matches[2][$i] . ".css";
												if (!file_exists($prototypes_path.$file))
												{
													if (file_put_contents($prototypes_path.$file, $blocks_text) !== false)
													{
														$message .= "<span class=\"success\">Файл стилей блоков-прототипов $file успешно создан</span>";
														
														if (!chmod_file($prototypes_path, $file))
															$message .= "<span class=\"info\">Полные права доступа к файлу стилей блоков-прототипов $file не установлены из-за ".get_error(1)."</span>";
													}
													else
														$message .= "<span class=\"error\">Файл стилей блоков-прототипов $file не создан из-за ".get_error(1)."</span>";
												}
											}
										}
										else
											$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка файлов блоков-прототипов</span>";
									}
									else
									{
										$setting_success = false;
										$message .= "<span class=\"error\">В предустановке «{$setting["title"]}» у некоторых css медиа-запросов не найдено обязательные названия русскими и латинскими буквами</span>";
									}
								}
								else
								{
									$setting_success = false;
									$message .= "<span class=\"error\">В предустановке «{$setting["title"]}» не найден ни один css медиа-запрос вида:<br /><русское_название> <латинское_название> /* <комментарий> */ @media <параметры></span>";
								}
							}
							else
							{
								$setting_success = false;
								$message .= "<span class=\"error\">В предустановке «{$setting["title"]}» должен быть хотя бы один css медиа-запрос</span>";
							}
						}
					}
					
					// Скрипты
					if ($_GET["type"] == "scripts")
					{
						if (preg_match_all("#\<link.*?href\=[\"\'](.*?)[\"\']#ims", $value, $matches) > 0)
						{
							foreach ($matches[1] as $file)
							{
								$path = ROOT."/".$file;
								if (!file_exists($path))
								{
									$setting_success = false;
									$message .= "<span class=\"error\">Файл стилей $path не найден</span>";
								}
							}
						}
						
						if (preg_match_all("#\<script.*?src\=[\"\'](.*?)[\"\']#ims", $value, $matches) > 0)
						{
							foreach ($matches[1] as $file)
							{
								$path = ROOT."/".$file;
								if (!file_exists($path))
								{
									$setting_success = false;
									$message .= "<span class=\"error\">Файл скрипта $path не найден</span>";
								}
							}
						}
					}
					
					if ($setting_success)
					{
						$sql = "UPDATE `settings` SET `value`='".addslashes($value)."' WHERE `name`='$name'";
						
						if ( ($_GET["type"] == "defaults") && isset($_POST[$name."_server"]) )
						{
							array_splice($data, 0);
							$data["sql"]     = $sql;
							$data["success"] = "Предустановка «{$setting["title"]}» успешно сохранена в базе данных сервера";
							$data["error"]   = "Предустановка «{$setting["title"]}» не сохранена в базе данных сервера из-за";
							$data["info"]    = "Предустановка «{$setting["title"]}» не существует в базе данных сервера";
							
							$server_data[] = $data;
						}
						
						// Сохраняем в клентской базе, только если значение изменено
						if ($value != $setting["value"])
						{
							mysql_query($sql);
							if (mysql_affected_rows() == 1)
								$settings_count++;
							else
							{
								$settings_success = false;
								$message .= "<span class=\"error\">Настройка «{$setting["title"]}» ($name) не сохранена из-за ".get_error(1)."</span>";
							}
						}
					}
					else
						$settings_success = false;
				} // if ( ($value != $setting["value"]) || (($_GET["type"] == "defaults") && (isset($_POST[$name."_server"]))) )
			} // while ($setting = mysql_fetch_array($query_setting))
			
			if ($settings_success)
			{
				if ($settings_count > 0) $message .= "<span class=\"success\">Настройки успешно сохранены</span>";
				
				// Если сохраняются предустановки - сохранить на сервере
				if (count($server_data) > 0) save_to_server($server_data, "Предустановки успешно сохранены на сервере");
				
				// Если сохраняются настройки не предустановки - обновить сайт
				if ($_GET["type"] != "defaults") $is_refresh_site = true;
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка настроек для их сохранения</span>";
	} // if (isset($_POST["save_settings"]))
		
	if ($_GET["type"] == "scripts")
	{
		// Добавить скрипт
		if (isset($_GET["action"]) && ($_GET["action"] == "create"))
		{
			$name = trim($_POST["new_script_title"]);
			$description = trim($_POST["new_script_description"]);
			
			if (preg_match("#^[a-z0-9\_\-]+$#ims", $name) == 1)
			{
				$is_name_free = true;
				
				$sql = "SELECT `name` FROM `settings` WHERE `type`=4";
				$query_scripts = mysql_query($sql);
				if ($query_scripts)
				{
					while ($script = mysql_fetch_array($query_scripts))
					{
						if ($script["name"] == $name)
							$is_name_free = false;
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка имён скриптов</span>";
					
				if ($is_name_free)
				{
					$title = "Скрипт «" . mb_ucfirst($name) . "»";
					$sql = "INSERT INTO `settings`(`name`,`title`,`description`,`value`,`type`) VALUES ('$name','$title','".addslashes($description)."','',4)";
					mysql_query($sql);
					if (mysql_affected_rows() == 1)
					{
						$script_id = mysql_insert_id();
						$message .= "<span class=\"success\">$title успешно добавлен</span>";
						
						// Добавить отметки о новом скрипте в таблицу подключений для всех страниц
						$count_pages = 0;
						$sql = "SELECT `id`,`name` FROM `pages`";
						$query_pages = mysql_query($sql);
						if ($query_pages)
						{
							while ($page = mysql_fetch_array($query_pages))
							{
								$sql = "INSERT INTO `scripts` (`page_id`,`script_id`,`status`) VALUES ({$page["id"]},$script_id,1)";
								mysql_query($sql);
								if (mysql_affected_rows() == 1)
									$count_pages++;
								else
									$message .= "<span class=\"error\">Запись о скрипте $name не добавлена в таблицу подключений скриптов для страницы «{$page["name"]}» из-за ".get_error(1)."</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка страниц для внесения записи в таблицу подключений скриптов</span>";
						
						$message .= "<span class=\"success\">Для скрипта $name в таблицу подключений скриптов успешно внесены записи: $count_pages</span>";
					}
					else
						$message .= "<span class=\"error\">$title не добавлен из-за ".get_error(1)."</span>";
				}
				else
					$message .= "<span class=\"error\">Скрипт с названием $name уже существует</span>";
			}
			else
				$message .= "<span class=\"error\">Название скрипта может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
		}
	
		// Удалить скрипт
		if (isset($_GET["action"]) && ($_GET["action"] == "delete"))
		{
			foreach ($_POST as $script_id => $value)
			{
				$script_id = preg_replace("#\D#ims", "", $script_id);
				if ($value != "")
				{
					$sql = "DELETE FROM `settings` WHERE `id`=$script_id";
					mysql_query($sql);
					if (mysql_affected_rows() == 1)
					{
						$message .= "<span class=\"success\">$value успешно удалён</span>";
						mysql_query("DELETE FROM `scripts` WHERE `script_id`=$script_id");
					}
					else
						$message .= "<span class=\"error\">$value не удалён из-за ".get_error(1)."</span>";
				}
			}
		}
	} // if ($_GET["type"] == "scripts")
	
	$settings = array();
	$sql = "SELECT * FROM `settings` WHERE `type`=$type ORDER BY `id` ASC";
	$query_settings = mysql_query($sql);
	if ($query_settings)
	{
		while ($setting = mysql_fetch_array($query_settings))
		{
			$setting["value"] = htmlspecialchars($setting["value"]);
			$settings[] = $setting;
		}
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка настроек для их отображения</span>";
	
	$smarty->assign("settings", $settings);
?>