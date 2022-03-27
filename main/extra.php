<?php
	function get_license($domain, $folder)
	{
		$domain = strtolower(rtrim($domain, "/"));
		$domain = str_replace("http://", "", $domain);
		$domain = str_replace("www.", "", $domain);
		
		$folder = trim($folder, "/");
		$arr = explode('/', $folder);
		$count = count($arr);
		if ($count == 1)
			$folder = $arr[0];
		elseif ($count > 1)
			$folder = $arr[$count - 2] . "/" . $arr[$count - 1];
		
		$salt = 'iuadba73333330k0kfmv0m03lzkjd.poz@3^&l)(kkmcz';
		
		return md5($domain . $folder . $salt);
	}
	
	function check_enter($user)
	{
		global $is_error, $is_login;
		
		$key = file_get_contents(ROOT."/main/smarty/config/license.txt");
		if ($key !== false)
		{
			$check_key = get_license(SITE, ROOT);
			if ($check_key == $key)
			{
				$_SESSION["is_login"]  	= true;
				$_SESSION["user_id"]   	= $user["id"];
				$_SESSION["user_email"] = $user["email"];
				$_SESSION["show_error"] = $user["show_error"];
				
				$_SESSION["page_blocks"] = array();
				$_SESSION["page_forms"]  = array();
				
				// Список форм для меню
				$sql = "SELECT `id`, `title` FROM `forms`";
				if ($query_forms = mysql_query($sql))
				{
					while ($row_form = mysql_fetch_assoc($query_forms))
						$_SESSION["page_forms"][$row_form["id"]] = $row_form["title"];
				}
				else
					add_log($sql);
				
				// Выбор активного шаблона
				$sql = "SELECT * FROM `templates` WHERE `status`=1 LIMIT 1";
				if ( ($query_template = mysql_query($sql)) && ($template = mysql_fetch_assoc($query_template)) )
				{
					$_SESSION["template_id"]      = intval($template["id"]);
					$_SESSION["template_title"]   = $template["title"];
					$_SESSION["template_catalog"] = "/templates/".$template["catalog"];
					
					$sql = "SELECT * FROM `pages` WHERE `template_id`={$template["id"]} AND `status`=1 LIMIT 1";
					if ( ($query_page = mysql_query($sql)) && ($page = mysql_fetch_assoc($query_page)) )
					{
						$_SESSION["page_id"]   = $page["id"];
						$_SESSION["page_name"] = $page["name"];
						$_SESSION["page_file"] = $page["file"];
					}
					else
						add_log($sql);
				}
				else
					add_log($sql);
				
				// Получение настройки, в течение скольки минут посетитель считается находящимся на сайте после последнего своего действия
				$sql = "SELECT `title`, `description`, `value` FROM `settings` WHERE `name`='minutes_visitor_online'";
				if ( ($query_setting = mysql_query($sql)) && ($setting = mysql_fetch_assoc($query_setting)) )
				{
					$_SESSION["minutes_visitor_online"] = $setting["value"];
					$_SESSION["minutes_visitor_title"]  = $setting["title"];
					$_SESSION["minutes_visitor_hint"]   = $setting["description"];
				}
				else
				{
					add_log($sql);
					
					$_SESSION["minutes_visitor_online"] = 10;
					$_SESSION["minutes_visitor_title"]  = "Число минут, в течение которых посетитель считается находящимся на сайте: ";
					$_SESSION["minutes_visitor_hint"]   = "В течение скольки минут посетитель считается находящимся на сайте после последнего своего действия на сайте";
				}
				
				$is_login = "true";
				
				return true;
			}
			else
				$is_error = "Лицензия не действительна";
		}
		else
			$is_error = "Отсутствует лицензионный файл";
		
		return false;
	}
	
	function set_initial_settings()
	{
		global $smarty, $server_name, $is_server, $is_admin, $is_superadmin;
		
		$is_server     = (strcasecmp(str_replace("www.", "", strtolower(SITE)), $server_name) === 0);
		$is_admin      = ($_SESSION["user_id"] == 1) || ($_SESSION["user_id"] == 2);
		$is_superadmin = ($_SESSION["user_id"] == 1);
		
		$smarty->assign("is_server", 	  $is_server);
		$smarty->assign("is_admin", 	  $is_admin);
		$smarty->assign("is_superadmin",  $is_superadmin);
		$smarty->assign("is_global_save", ($is_superadmin && !$is_server));
	}
	
	$is_login = "";
	
	$server_db_vars  = array();
	$server_db_vars["server_db_host"] = "";
	$server_db_vars["server_db_base"] = "";
	$server_db_vars["server_db_user"] = "";
	$server_db_vars["server_db_pass"] = "";
	
	$server_ftp_vars = array();
	$server_ftp_vars["server_ftp_server"] = "";
	$server_ftp_vars["server_ftp_user"]   = "";
	$server_ftp_vars["server_ftp_pass"]   = "";
	$server_ftp_vars["server_ftp_folder"] = "";
	
	$server_name = "landkit.ru";
	
	$is_server = false;
	$is_admin  = false;
	$is_superadmin = false;
?>