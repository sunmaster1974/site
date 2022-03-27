<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "sites";
	
	$sites = array();
	
	$sql = "SELECT * FROM `sites` ORDER BY `id` ASC";
	$query_sites = mysql_query($sql);
	if ($query_sites)
	{
		$count = 0;
		$count_sites = mysql_num_rows($query_sites);
		while ($site = mysql_fetch_array($query_sites))
		{
			if (isset($_POST["save_updates"]))
			{
				$is_update = isset($_POST["is-update-{$site["id"]}"]) ? 1 : 0;
				
				$sql = "UPDATE `sites` SET `is_update`=$is_update WHERE `id`=" . $site["id"];
				$query_update = mysql_query($sql);
				if ($query_update && (mysql_affected_rows() == 1))
				{
					$count++;
					$site["is_update"] = $is_update;
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при сохранении настройки обновления сайта с id={$site["id"]}</span>";
			}
			
			$site["date"] = format_mysql_date($site["date_install"], "d.m.y h:i");
			$sites[] = $site;
		}
		
		if ( isset($_POST["save_updates"]) && ($count == $count_sites) )
			$message .= "<span class=\"success\">Настройки обновления сохранены успешно</span>";
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка сайтов</span>";
	
	function get_files_dates($folder)
	{
		global $files;
		
		$names = list_file(ROOT.$folder);
		foreach ($names as $name)
		{
			$file = array();
			
			$file["name"] = $name;
			$file["dir"]  = $folder;
			$file["date"] = filemtime(ROOT.$folder.$name);
			$file["show"] = date("d.m.Y H:i:s", $file["date"]);
			
			$files[] = $file;
		}
	}
	
	function get_files_dates_rec($folder)
	{
		global $files;
		
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ROOT.$folder)) as $key => $val)
		{
			$path_parts = pathinfo($val);
			
			$file = array();
			
			$file["name"] = $path_parts["basename"];
			$file["dir"]  = str_replace(ROOT, '', $path_parts["dirname"]);
			$file["date"] = filemtime($val);
			$file["show"] = date("d.m.Y H:i:s", $file["date"]);
			
			$files[] = $file;
		}
	}
	
	$date_update = isset($_POST["update_files"]) ? $_POST["date_update"] : date("d.m.Y");
	$date_parts = explode(".", $date_update);
	
	$is_right_date = true;
	if (!checkdate($date_parts[1], $date_parts[0], $date_parts[2]))
	{
		$message .= "<span class=\"error\">Введена некорректная дата обновления</span>";
		
		$is_right_date = false;
		$date_update = date("d.m.Y");
		$date_parts = explode(".", $date_update);
	}
	
	$files = array();
	
	get_files_dates("/main/");
	get_files_dates("/main/styles/");
	get_files_dates("/main/scripts/");
	get_files_dates("/main/smarty/templates/");
	
	$files_for_show   = array();
	$files_for_update = array();
	
	$stamp_update = mktime(0, 0, 0, $date_parts[1], $date_parts[0], $date_parts[2]);
	foreach ($files as $index => $file)
	{
		// Файл variables.less не нужно перезаписывать - он может быть свой при установке другой цветовой схемы
		if ( ($file["date"] > $stamp_update) && ($file["name"] != "variables.less") )
		{
			$file["id"] = $index;
			$files_for_show[] = $file;
			
			if (isset($_POST["update_files"]) && isset($_POST["is-send-$index"]))
				$files_for_update[] = $file;
		}
	}
	
	// Послать файлы на сайты
	if (isset($_POST["update_files"]) && isset($_POST["update_files_to_sites"]) && $is_right_date)
	{
		if (count($files_for_update) > 0)
		{
			foreach ($sites as $site)
				if (intval($site["is_update"]) == 1)
					ftp_update_file($site["site_name"], $site["site_ip"], $site["ftp_server"], $site["ftp_folder"], $site["ftp_user"], $site["ftp_pass"], $files_for_update);
		}
	}
	
	// Послать SQL-запросы на сайты
	if (isset($_POST["send_queries"]) && isset($_POST["sql_query"]))
	{
		$sql_query = trim($_POST["sql_query"]);
		if ($sql_query != "")
		{
			foreach ($sites as $site)
				if (intval($site["is_update"]) == 1)
					mysql_query_multiple($site["site_name"], $site["site_ip"], $site["db_name"], $site["db_user"], $site["db_pass"], $sql_query, true);
		}
	}
	
	$smarty->assign("sites", $sites);
	$smarty->assign("date_update", $date_update);
	$smarty->assign("files_updated", $files_for_show);
?>