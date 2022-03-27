<?php
	session_start();
	$session_id = session_id();
	
	// С PHP5.3 - константа __DIR__ 
	// На PHP 5.2.5 константа __DIR__ неизвестна
	//$domain_path = __DIR__; // В случае работы на домене с поддоменами - ставить путь к главному домену
	$domain_path = dirname(__FILE__); // В случае работы на домене с поддоменами - ставить путь к главному домену
	
	require $domain_path . "/smarty/config/connect.php";
	
	function get_user_ip()
	{
		if     (!empty($_SERVER['HTTP_X_REAL_IP'])) 		$ip = $_SERVER['HTTP_X_REAL_IP'];
		elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) 		$ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else 												$ip = $_SERVER['REMOTE_ADDR'];
		return $ip;
	}
	
	$sql = "SELECT `id` FROM `sessions` WHERE `session_id`='$session_id'";
	$query = @mysql_query($sql);
	if ($query !== false)
	{
		// Если сессия с таким номером уже существует, значит пользователь online - обновляем время его последнего посещения 
		if (mysql_num_rows($query) > 0)
		{
			$sql = "UPDATE `sessions` SET `last_date`=NOW(), `online`=1 WHERE `session_id`='$session_id'";
			$res = @mysql_query($sql);
			if ( ($res === false) || (mysql_affected_rows() < 1) )
			{
				$err = mysql_error();
				@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при обновлении данных посетителя', '<b>File</b>: session_db.php<br><b>SQL</b>: ".addslashes($sql)."<br><b>Error</b>: ".addslashes($err)."')");
			}
		}
		// Иначе, если такого номера нет - посетитель только что вошёл - помещаем в таблицу нового посетителя 
		else
		{
			$city = "";
			$ip = get_user_ip();
			
			try
			{
				include $domain_path . "/sxgeo.php";
				$SxGeo = new SxGeo($domain_path . "/sxgeocity.dat");
				$city_full = $SxGeo->getCityFull($ip);
				
				$arr = array();
				if ($city_full["country"]["name_ru"] != "") $arr[] = $city_full["country"]["name_ru"];
				if ($city_full["region"]["name_ru"] != "") 	$arr[] = $city_full["region"]["name_ru"];
				if ($city_full["city"]["name_ru"] != "") 	$arr[] = $city_full["city"]["name_ru"];
				$city = addslashes(implode(", ", $arr));
				
				if (empty($city)) $city = "<не найден>";
				
				unset($SxGeo);
			}
			catch (Exception $e)
			{
				$city = "<не получен>";
				@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при определении города посетителя', '<b>File</b>: session_db.php<br><b>Error</b>: ".addslashes($e->getMessage())."')");
			}
			
			$ref = (isset($_SERVER["HTTP_REFERER"])) ? addslashes($_SERVER["HTTP_REFERER"]) : "";
			$uri = (isset($_SERVER["REQUEST_URI"])) ? addslashes($_SERVER["REQUEST_URI"]) : "";
			$agt = (isset($_SERVER["HTTP_USER_AGENT"])) ? addslashes($_SERVER["HTTP_USER_AGENT"]) : "";
			$ip  = addslashes($ip);
			
			$sql = "INSERT INTO `sessions` (`session_id`, `last_date`, `ip_address`, `city`, `referrer`, `request`, `user_agent`) 
					VALUES ('$session_id', NOW(), '$ip', '$city', '$ref', '$uri', '$agt')";
			if ( (@mysql_query($sql) === false) || (mysql_affected_rows() < 1) )
			{
				$err = mysql_error();
				@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при добавлении записи о посетителе', '<b>File</b>: session_db.php<br><b>SQL</b>: ".addslashes($sql)."<br><b>Error</b>: ".addslashes($err)."')");
			}
		}
	}
	else
	{
		$err = mysql_error();
		@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при запросе данных текущей сессии', '<b>File</b>: session_db.php<br><b>SQL</b>: ".addslashes($sql)."<br><b>Error</b>: ".addslashes($err)."')");
	}
	
	// Будем считать, что пользователи, которые отсутствуют больше 10 минут, покинули сайт
	$minutes_visitor_online = 10;
	$sql = "SELECT `value` FROM `settings` WHERE `name`='minutes_visitor_online'";
	$query_setting = @mysql_query($sql);
	if ($query_setting && ($setting = mysql_fetch_array($query_setting)))
		$minutes_visitor_online = $setting["value"];
	else
	{
		$err = mysql_error();
		@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при получении настройки minutes_visitor_online', '<b>File</b>: session_db.php<br><b>SQL</b>: ".addslashes($sql)."<br><b>Error</b>: ".addslashes($err)."')");
	}
	
	$sql = "UPDATE `sessions` SET `online`=0 WHERE `last_date` < NOW() - INTERVAL '$minutes_visitor_online' MINUTE";
	if (@mysql_query($sql) === false)
	{
		$err = mysql_error();
		@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при обновлении поля online посетителя', '<b>File</b>: session_db.php<br><b>SQL</b>: ".addslashes($sql)."<br><b>Error</b>: ".addslashes($err)."')");
	}
?>