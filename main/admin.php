<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	require "functions.php";
	
	error_reporting(E_ALL & ~E_NOTICE);
	set_error_handler("my_error_handler");
	date_default_timezone_set("Europe/Moscow");
	set_initial_settings();
	
	$templates_path  = ROOT."/templates/";
	$prototypes_path = ROOT."/main/prototypes/";
	$files_path      = ROOT."/files/";
	$index_path      = ROOT."/";
	$install_path 	 = ROOT."/install/";
	
	$original_archive= "original.zip";
	$install_archive = "install.zip";
	$extract_script  = "extract.php";
	$chmod_script    = "chmod.php";
	$db_tables_sql   = "db_tables.sql";
	$db_data_sql     = "db_data.sql";
	$settings_file   = "connect.php";
	$license_file    = "license.txt";
	$index_css    	 = "index.css";
	$template_css 	 = "template";
	$blocks_css   	 = "blocks";
	
	$template_path   = "";
	$blocks_path   	 = "";
	$styles_path   	 = "";
	$images_path   	 = "";
	
	$sql 	 = "";
	$log_id  = "";
	$message = "";
	
	$template_id 	  = $_SESSION["template_id"];
	$template_title   = $_SESSION["template_title"];
	$template_catalog = $_SESSION["template_catalog"];
	
	$page_id 		  = $_SESSION["page_id"];
	$page_name 		  = $_SESSION["page_name"];
	$page_file 		  = $_SESSION["page_file"];
	
	set_template_paths($template_catalog);
	
	$is_refresh_site        = false;	
	$is_blocks_list_changed = false;
	
	$pages_list = array("account", "blocks", "colors", "forms", "images", "journal", "orders", "pages", "settings", "templates", "updates", "view", "visitors");
	if (!isset($_GET["page"]) || (trim($_GET["page"]) == ""))
		$_GET["page"] = "blocks";
	if (!in_array($_GET["page"], $pages_list))
		$_GET["page"] = "blocks";
	
	require $_GET["page"].".php";
	
	require "view.php";
	
	// Подсказка о количестве новых заказов
	$orders_new_count = 0;
	$sql = "SELECT COUNT(`id`) FROM `orders` WHERE `status`=0";
	if (($query_orders = mysql_query($sql)) && ($count_orders = mysql_fetch_row($query_orders)))
		$orders_new_count = $count_orders[0];
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества новых заказов</span>";
	$smarty->assign("orders_new_count", $orders_new_count);
	
	// Подсказка о количестве ошибок в журнале ошибок
	$errors_count = 0;
	$sql = "SELECT COUNT(`id`) FROM `logs`";
	if (($query_logs = mysql_query($sql)) && ($count_logs = mysql_fetch_row($query_logs)))
		$errors_count = $count_logs[0];
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества записей в журнале ошибок</span>";
	$smarty->assign("errors_count", $errors_count);
	
	// Подсказка о количестве посетителей online
	$visitors_online = 0;
	$sql = "UPDATE `sessions` SET `online`=0 WHERE `last_date` < NOW() - INTERVAL '{$_SESSION["minutes_visitor_online"]}' MINUTE";
	if (mysql_query($sql) === false)
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при обновлении поля online посетителей</span>";
	
	$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE `online`=1";
	if (($query_visitors = mysql_query($sql)) && ($count_visitors = mysql_fetch_row($query_visitors)))
		$visitors_online = $count_visitors[0];
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества посетителей на сайте</span>";
	$smarty->assign("visitors_online", $visitors_online);
	
	// Выпадающее меню блоков активной страницы
	if (empty($_SESSION["page_blocks"]) || $is_blocks_list_changed)
	{
		$is_blocks_list_changed = false;
		array_splice($_SESSION["page_blocks"], 0);
		$_SESSION["page_blocks"] = get_page_blocks($page_id, $page_name);
	}
	
	$smarty->assign("page_blocks", $_SESSION["page_blocks"]);
	$smarty->assign("page_forms",  $_SESSION["page_forms"]);
	
	if ($template_id == "")
		if (($_GET["page"] == "templates") || ($_GET["page"] == "pages") || ($_GET["page"] == "blocks") || ($_GET["page"] == "images"))
			$message .= "<span class=\"info\">Ни один шаблон не выбран. Для продолжения работы выберите или создайте шаблон</span>";
	
	if ($page_id == "")
		if (($_GET["page"] == "templates") || ($_GET["page"] == "pages") || ($_GET["page"] == "blocks"))
			$message .= "<span class=\"info\">Ни одна страница не выбрана. Для продолжения работы выберите или создайте страницу</span>";
	
	if (strpos($message, "error") !== false)
		$info = "<span class=\"error\">Не выполнено</span>";
	elseif (strpos($message, "info") !== false)
		$info = "<span class=\"info\">Предупреждение</span>";
	else
		$info = "<span class=\"success\">Выполнено</span>";
	
	if ($_SESSION["show_error"] == 1)
		if ( (strpos($message, "error") === false) && (strpos($message, "info") === false) )
			$message = "";
	
	// Файлы страниц в одной папке
	if (strpos($page_file, "/") === false)
	{
		$url = "http://".SITE."/".$page_file.".php";
	}
	// Файлы страниц в разных папках
	else
	{
		$url = "http://" . $page_name . "." . SITE . "/" . basename($page_file);
	}
	$smarty->assign("url", $url);
		
	$smarty->assign("info", 		  $info);
	$smarty->assign("message", 		  $message);
	$smarty->assign("page", 		  $_GET["page"]);
	$smarty->assign("type", 		  $_GET["type"]);
	$smarty->assign("page_id",		  $page_id);
	$smarty->assign("page_name", 	  $page_name);
	$smarty->assign("template_id", 	  $template_id);
	$smarty->assign("template_title", $template_title);
?>