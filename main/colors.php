<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	$active_scheme_id    = 1;
	$active_scheme_title = "";
	
	$sql = "SELECT `id`, `title` FROM `colors` WHERE `active`=1 LIMIT 1";
	$query_scheme = mysql_query($sql);
	if ($query_scheme && ($row_scheme = mysql_fetch_array($query_scheme)))
	{
		$active_scheme_id    = $row_scheme["id"];
		$active_scheme_title = $row_scheme["title"];
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе идентификатора выбранной цветовой схемы</span>";
	
	if (!isset($_GET["type"])) $_GET["type"] = $active_scheme_id;
	
	if (isset($_GET["action"]))
	{
		if ($_GET["action"] == "create")
		{
			$new_scheme_title = trim($_POST["new_scheme_title"]);
			$base_id = $_POST["base_scheme_id"];
			
			$sql = "SELECT COUNT(`id`) FROM `colors` WHERE `title` = '".addslashes($new_scheme_title)."'";
			$query_count = mysql_query($sql);
			if ($query_count && ($row_count = mysql_fetch_row($query_count)))
			{
				if ($row_count[0] == 0)
				{
					$is_insert_success = false;
					$sql = "CREATE TABLE `tmp` AS SELECT * FROM `colors` WHERE `id` = $base_id";
					if (mysql_query($sql))
					{
						$sql = "UPDATE `tmp` SET `id` = NULL, `active` = 0, `title`='".addslashes($new_scheme_title)."'";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
						{
							$sql = "INSERT INTO `colors` SELECT * FROM `tmp`";
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
							{
								$is_insert_success = true;
								$new_scheme_id = mysql_insert_id();
								$_GET["type"] = $new_scheme_id;
								mysql_query("DROP TABLE `tmp`");
							}
						}
					}
					if ($is_insert_success)
						$message .= "<span class=\"success\">Цветовая схема «{$new_scheme_title}» успешно создана</span>";
					else
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при создании новой цветовой схемы «{$new_scheme_title}»</span>";
				}
				else
					$message .= "<span class=\"error\">Название цветовой схемы «{$new_scheme_title}» уже существует</span>";
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при проверке существования названия новой цветовой схемы «{$new_scheme_title}»</span>";
		}
		
		if ($_GET["action"] == "delete")
		{
			$sql = "SELECT COUNT(*) FROM `colors`";
			$query_count = mysql_query($sql);
			if ($query_count && ($row_count = mysql_fetch_row($query_count)))
			{
				if (count($_POST) < $row_count[0])
				{
					foreach ($_POST as $scheme_id => $scheme_title)
					{
						$scheme_id = preg_replace("#\D#ims", "", $scheme_id);
						if ($scheme_title != "")
						{
							$sql = "SELECT `active` FROM `colors` WHERE `id`=$scheme_id";
							$query = mysql_query($sql);
							if ($query && ($row = mysql_fetch_array($query)))
							{
								if ($row["active"] == 1)
									$message .= "<span class=\"error\">Цветовую схему «{$scheme_title}» нельзя удалять, так как она установлена в конструкторе</span>";
								else
								{
									$sql = "DELETE FROM `colors` WHERE `id`=$scheme_id";
									$query = mysql_query($sql);
									if ($query && (mysql_affected_rows() == 1))
										$message .= "<span class=\"success\">Цветовая схема «{$scheme_title}» успешно удалена</span>";
									else
										$message .= "<span class=\"error\">Цветовая схема «{$scheme_title}» не удалена из-за ".get_error(1)."</span>";
								}
							}
						}
					}
				}
				else
					$message .= "<span class=\"error\">Все цветовые схемы удалять нельзя</span>";
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества цветовых схем</span>";
		}
	}
	
	$id = preg_replace('#\D#ims', '', $_GET["type"]);
	if ($id == "") $id = 1;
	$_GET["type"] = $id;
	
	// Сохранить цветовую схему
	$save_scheme_id = 0;
	if (isset($_POST["save_scheme"]))
	{
		$sql = "UPDATE `colors` SET `main-color`='{$_POST["main-color"]}', `text-color`='{$_POST["text-color"]}', `link-color`='{$_POST["link-color"]}', `bright-color`='{$_POST["bright-color"]}', `info-color`='{$_POST["info-color"]}', `error-color`='{$_POST["error-color"]}', `success-color`='{$_POST["success-color"]}', `back-color`='{$_POST["back-color"]}', `back-acive-color`='{$_POST["back-acive-color"]}', `back-input-color`='{$_POST["back-input-color"]}', `shadow-color`='{$_POST["shadow-color"]}', `border-input-color`='{$_POST["border-input-color"]}' WHERE `id`={$_POST["scheme_id"]}";
		$res = mysql_query($sql);
		if ($res && (mysql_affected_rows() == 1))
		{
			$message .= "<span class=\"success\">Цветовая схема «{$_POST["scheme_title"]}» успешно сохранена</span>";
			$save_scheme_id = $_POST["scheme_id"];
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при сохранении цветовой схемы «{$_POST["scheme_title"]}»</span>";
	}
	
	$is_need_apply = false;
	
	$scheme = array();
	$sql = "SELECT * FROM `colors` WHERE `id`=$id";
	$query = mysql_query($sql);
	if ($query)
	{
		$scheme = mysql_fetch_array($query);
		if ( ($scheme["id"] == $save_scheme_id) && ($scheme["active"] == 1) ) $is_need_apply = true;
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе цветовой схемы с id=$id</span>";
	
	// Применить цветовую схему
	if (isset($_POST["apply_scheme"]))
	{
		$sql = "UPDATE `colors` SET `active`=0";
		$query1 = mysql_query($sql);
		$sql = "UPDATE `colors` SET `active`=1 WHERE `id`={$_POST["scheme_id"]}";
		$query2 = mysql_query($sql);
		if ( $query1 && $query2 && (mysql_affected_rows() == 1) )
		{
			$is_need_apply = true;
			$active_scheme_title = $_POST["scheme_title"];
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при применении цветовой схемы «{$_POST["scheme_title"]}»</span>";
	}
	
	if ($is_need_apply)
	{
		$variables_file = ROOT."/main/styles/variables.less";
		$admin_file     = ROOT."/main/styles/stylea.css";
		$login_file     = ROOT."/main/styles/stylel.css";
		
		if (is_writable($variables_file) && is_writable($admin_file) && is_writable($login_file))
		{
			$variables = file($variables_file, FILE_IGNORE_NEW_LINES);
			foreach ($variables as $i => $variable)
			{
				$count = preg_match('#\@([\w\-]+color)\:#is', $variable, $matches);
				if ($count == 1)
				{
					$name = $matches[1];
					$variables[$i] = "@$name: {$scheme[$name]};";
				}
			}
			
			$variables_less = implode("\r\n", $variables);
			if (file_put_contents($variables_file, $variables_less))
			{
				$admin_less = file_get_contents(str_replace(".css", ".less", $admin_file));
				$login_less = file_get_contents(str_replace(".css", ".less", $login_file));
				
				if ( ($admin_less !== false) && ($login_less !== false) )
				{
					$admin_css = "";
					$login_css = "";
					
					try
					{
						require "lessc.inc.php";
						$less = new lessc;
						
						$admin_css = $less->compile($variables_less . $admin_less);
						$login_css = $less->compile($variables_less . $login_less);
						
						unset($less);
					}
					catch (Exception $e)
					{
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при компиляции в файлы стилей цветовой схемы «{$_POST["scheme_title"]}» (".$e->getMessage().")</span>";
					}
					
					if (!empty($admin_css) && !empty($login_css))
					{
						if (file_put_contents($admin_file, $admin_css) && file_put_contents($login_file, $login_css))
							$message .= "<span class=\"success\">Цветовая схема «{$_POST["scheme_title"]}» успешно применена</span>";
						else
							$message .= "<span class=\"error\">Запись в файлы стилей $admin_file или $login_file не произведена</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Содержимое файлов стилей ".str_replace(".css", ".less", $admin_file)." или ".str_replace(".css", ".less", $login_file)." не получено</span>";
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при записи в файл стилей $variables_file цветовой схемы «{$_POST["scheme_title"]}»</span>";
		}
		else
			$message .= "<span class=\"error\">Файлы стилей $variables_file, $admin_file или $login_file не существуют или не доступны для записи</span>";
	}
	
	// Список цветовых схем для вывода в выпадающем списке
	$schemes = array();
	$sql = "SELECT `id`, `title` FROM `colors`";
	$query = mysql_query($sql);
	if ($query)
	{
		while ($row = mysql_fetch_array($query))
			$schemes[] = $row;
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка цветовых схем</span>";
	
	$smarty->assign("scheme",  $scheme);
	$smarty->assign("schemes", $schemes);
	$smarty->assign("active_scheme_title", $active_scheme_title);
?>