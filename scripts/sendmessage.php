<?php	
	define("ROOT", rtrim($_SERVER["DOCUMENT_ROOT"], "/"));
	define("SITE", str_replace("www.", "", strtolower($_SERVER["SERVER_NAME"])));
	
	require ROOT . "/main/smarty/config/connect.php";
	
	$upload_dir = ROOT . "/files/";
	
	// Если доменное имя с кириллическими символами
	if (strpos(SITE, "xn--") !== false)
	{
		try
		{
			include ROOT . "/main/idna_convert.class.php";
			
			$IDN = new idna_convert();
			$site_rus = $IDN->decode(SITE);
			define("SITE_NAME", $site_rus);
			
			unset($IDN);
		}
		catch (Exception $e)
		{
			@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при определении кириллического домена', '<b>File</b>: sendmessage.php<br /><b>Error</b>: ".addslashes($e->getMessage())."')");
		}
	}
	
	if (!defined("SITE_NAME"))
		define("SITE_NAME", SITE);
	
	function translit_name($str)
	{
		$rus = array("а","б","в","г","д","е","ё" ,"ж" ,"з","ы","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц", "ч", "ш", "щ",  "ъ","ь","э","ю" ,"я");
		$lat = array("a","b","v","g","d","e","yo","zh","z","y","i","y","k","l","m","n","o","p","r","s","t","u","f","h","ts","ch","sh","sch","" ,"" ,"e","yu","ya");
		
		$result = mb_strtolower(html_entity_decode($str, ENT_QUOTES), "utf-8");
		$result = preg_replace("/[^0-9a-z]/", "-", str_replace($rus, $lat, $result));
		$result = str_replace("--", "-", $result);
		
		return $result;
	}
	
	function get_user_ip()
	{
		if     (!empty($_SERVER['HTTP_X_REAL_IP'])) 		$ip = $_SERVER['HTTP_X_REAL_IP'];
		elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) 		$ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else 												$ip = $_SERVER['REMOTE_ADDR'];
		return $ip;
	}
	
	function get_mail_attach($boundary, $message, $file_name, $is_file)
	{
		global $upload_dir;
		
		$message_base64 = chunk_split(base64_encode($message));
		
		$result = "--$boundary
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: base64

$message_base64
";
		
		if ($is_file)
		{
			$file_content = implode("", file($upload_dir . $file_name));
			$file_base64 = chunk_split(base64_encode($file_content));

			$result .= "--$boundary
Content-Type: application/octet-stream; name=\"$file_name\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$file_name\"

$file_base64
";
		}

		$result .= "--$boundary--
";

		return $result;
	}
	
	function parseReferrer($referrer)
	{
		$crawler = "";
		$phrase  = "";
		$advert  = "";
		
		if (stristr($referrer, "yandex")) // http://yandex.ru
		{
			$search  = "text=";
			$crawler = "Yandex";
			
			if (stristr($referrer, "yabs.yandex") !== false)
				$advert = ", контекстная реклама";
			else
				$advert = ", естественная выдача";
		}
		if (stristr($referrer, "rambler.ru")) // rambler.ru/search
		{
			$search  = "query=";
			$crawler = "Rambler";
		}
		if (stristr($referrer, "google")) // http://www.google.ru
		{
			$search  = "q=";
			$crawler = "Google";
		}
		if (stristr($referrer, "mail.ru")) // http://go.mail.ru
		{
			$search  = "q=";
			$crawler = "Mailru";
		}
		if (stristr($referrer, "bing.com")) // http://www.bing.com
		{	
			$search  = "q=";
			$crawler = "Bing";
		}
		if (stristr($referrer, "qip.ru")) // http://search.qip.ru/search/
		{
			$search  = "query=";
			$crawler = "Qip";
		}
		if (stristr($referrer, "yahoo.com")) // search.yahoo.com/search/
		{
			$search  = "p=";
			$crawler = "Yahoo";
		}
		if (stristr($referrer, "ask.com")) // http://ru.ask.com
		{
			$search  = "q=";
			$crawler = "Ask.com";
		}

		if ($crawler != "")
		{
			$referrer_decoded = urldecode($referrer);
			$result = preg_match_all('#'.$search.'(.*?)\&#ims', $referrer_decoded . "&", $matches);
			if (($result !== false) && ($result > 0))
			{
				if (isset($matches[1][0]) and ($matches[1][0] != ""))
					$phrase = ", поисковая фраза: " . $matches[1][0];
			}
			return "Поисковая система: " . $crawler . $advert . $phrase;
		}
		
		return $referrer;
	}
	
	ob_start();
	
	$upload_file = "";
	$is_upload_file = false;
	if (isset($_POST["user_file"]) && (trim($_POST["user_file"]) != "") && (strpos($_POST["user_file"], "<") === false))
	{
		$parts = pathinfo($_POST["user_file"]);
		$upload_file = translit_name($parts["filename"]) . "." . $parts["extension"];
		
		if (file_exists($upload_dir . $upload_file))
		{
			$is_upload_file = true;
			
			$i = 1;
			$parts = pathinfo($upload_file);
			$temp_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
			while (file_exists($upload_dir . $temp_name))
			{
				$upload_file = $temp_name;
				$i++;
				$temp_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
			}
		}
	}
	
	$name  = "";
	$email = "";
	$phone = "";
	$text  = "";
	$file  = "";
	$form  = "";
	$date  = date("Y-m-d H:i:s");
	
	$boundary = md5(rand(0, time()));
	
	$subject  = "Заявка с сайта " . SITE_NAME;
	$subject  = "=?UTF-8?B?" . base64_encode($subject) . "?=";
	
	$company_name = "Компания «Такси Ларгус»";
	$sql = "SELECT `value` FROM `settings` WHERE `name`='company_name'";
	$query = @mysql_query($sql);
	if ($query && ($row = @mysql_fetch_array($query)))
		$company_name = str_replace('"', '\"', $row["value"]);
	else
	{
		$err = mysql_error();
		@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('В таблице настроек не найдено свойство «Название компании» (company_name)', '<b>File</b>: sendmessage.php<br /><b>SQL</b>: ".addslashes($sql)."<br /><b>Error</b>: ".addslashes($err)."')");
	}
	
	$company_name = "=?UTF-8?B?" . base64_encode($company_name) . "?=";
	
	$headers = "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "From: $company_name <info@".SITE.">\r\n";
	
	$message  = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head><body>\r\n";
	
	if (isset($_POST["user_phone"]))
	{
		$phone = addslashes($_POST["user_phone"]);
		$message .= "<p><b>Контактный телефон:</b> " . htmlspecialchars($_POST["user_phone"]) . "</p>\r\n";
	}
	if (isset($_POST["user_from"]))
	{
		$name = addslashes($_POST["user_from"]);
		$message .= "<p><b>Откуда:</b> " . htmlspecialchars($_POST["user_from"]) . "</p>\r\n";
	}
	if (isset($_POST["user_to"]))
	{
		$email = addslashes($_POST["user_to"]);
		$message .= "<p><b>Куда:</b> " . htmlspecialchars($_POST["user_to"]) . "</p>\r\n";
	}
	if (isset($_POST["user_date"]))
	{
		$text = addslashes($_POST["user_date"]);
		$message .= "<p><b>Дата, время:</b> " . htmlspecialchars($_POST["user_date"]) . "</p>\r\n";
	}
	
	if (isset($_POST["user_childs"]))
	{
		$text .= 'Количество детей до 7 лет: ' . addslashes($_POST["user_childs"]) . '. ';
		$message .= "<p><b>Количество детей до 7 лет:</b> " . htmlspecialchars($_POST["user_childs"]) . "</p>\r\n";
	}
	
	if (isset($_POST["user_adults"]))
	{
		$text .= 'Количество взрослых: ' . addslashes($_POST["user_adults"]) . '. ';
		$message .= "<p><b>Количество взрослых:</b> " . htmlspecialchars($_POST["user_adults"]) . "</p>\r\n";
	}
	
	if ($is_upload_file)
	{
		$file = $upload_file;
		$message .= "<p><b>Файл:</b> " . $upload_file . "</p>\r\n";
		// $message .= "<p><b>Изображение:</b><br /><img src=\"cid:user_photo_uploaded\" alt=\"\" /></p>\r\n"; // Для $mail_body_inside
	}
	
	$download_file = "";
	$is_download_file = false;
	if (isset($_POST["user_permail"]) && ($_POST["user_permail"] == "on"))
	{
		if (isset($_POST["download_file"]) && (trim($_POST["download_file"]) != ""))
		{
			$download_file = trim($_POST["download_file"]);
			$file = $download_file;
			
			if (file_exists($upload_dir . $download_file))
			{
				$is_download_file = true;
				$message .= "<p><b>Запрошенный файл:</b> " . $download_file . "</p>\r\n";
			}
			else
				$message .= "<p><b>Запрошенный файл:</b> " . $download_file . " (файл не послан посетителю, так как не найден в папке $upload_dir)</p>\r\n";
		}
	}
	
	// Информация скрытых полей
	$message .= "<br />";
	
	if (isset($_POST["form_name"]))
	{
		$form = addslashes($_POST["form_name"]);
		$message .= "<i>Форма:</i> " . htmlspecialchars($_POST["form_name"]) . "<br />\r\n";
	}
	
	if (isset($_POST["user_time"]) && ($_POST["user_time"] == "yes"))
		$message .= "<i>Время:</i> " . date("d.m.Y H:m") . "<br />\r\n";
	
	if (isset($_POST["user_agent"]) && ($_POST["user_agent"] == "yes"))
		$message .= "<i>Браузер:</i> " . $_SERVER["HTTP_USER_AGENT"] . "<br />\r\n";
	
	if (isset($_POST["user_ip"]) && ($_POST["user_ip"] == "yes"))
	{
		$city = "";
		$ip = get_user_ip();
		
		try
		{
			include ROOT . "/main/sxgeo.php";
			$SxGeo = new SxGeo(ROOT . "/main/sxgeocity.dat");
			$city_full = $SxGeo->getCityFull($ip);
			
			$arr = array();
			if ($city_full["country"]["name_ru"] != "") $arr[] = $city_full["country"]["name_ru"];
			if ($city_full["region"]["name_ru"] != "") 	$arr[] = $city_full["region"]["name_ru"];
			if ($city_full["city"]["name_ru"] != "") 	$arr[] = $city_full["city"]["name_ru"];
			$city = implode(", ", $arr);
			
			unset($SxGeo);
		}
		catch (Exception $e)
		{
			@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при определении города посетителя', '<b>File</b>: sendmessage.php<br /><b>Error</b>: ".addslashes($e->getMessage())."')");
		}
		
		$message .= "<i>IP-адрес:</i> " . $ip . "<br />\r\n";
		if ($city != "") $message .= "<i>Город:</i> " . $city . "<br />\r\n";
	}
	
	if (isset($_POST["user_referrer"]) && ($_POST["user_referrer"] == "yes"))
	{
		$referrer = $_SERVER["HTTP_REFERER"];
		
		if ( (stristr($referrer, SITE) !== false) || ($referrer == "") )
			$referrer = "прямой заход";
		
		// Если реферрер равен "прямой заход", то, возможно, посетитель уже ходит по страницам сайта и уже потерян его реферрер, откуда он пришёл
		if ($referrer == "прямой заход")
		{
			$enable_visitors_db = 0;
			$sql = "SELECT `value` FROM `settings` WHERE `name`='enable_visitors_db'";
			$query = @mysql_query($sql);
			if ($query && ($row = @mysql_fetch_array($query)))
				$enable_visitors_db = $row["value"];
			else
			{
				$err = mysql_error();
				@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('В таблице настроек не найдено свойство «Включение записи данных о посетителях» (enable_visitors_db)', '<b>File</b>: sendmessage.php<br /><b>SQL</b>: ".addslashes($sql)."<br /><b>Error</b>: ".addslashes($err)."')");
			}
			
			session_start();
			// Взять реферер из базы данных
			if ($enable_visitors_db == 1)
			{
				$session_id = session_id();
				
				$sql = "SELECT `referrer` FROM `sessions` WHERE `session_id`='$session_id'";
				$query = @mysql_query($sql);
				if ($query && ($row = @mysql_fetch_array($query)))
				{
					if ( ($row["referrer"] != "") && (stristr($row["referrer"], SITE) === false) )
						$referrer = $row["referrer"];
				}
				else
				{
					$err = mysql_error();
					@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('Произошла ошибка при запросе реферера из таблицы sessions', '<b>File</b>: sendmessage.php<br /><b>SQL</b>: ".addslashes($sql)."<br /><b>Error</b>: ".addslashes($err)."')");
				}
			}
			// Взять реферер из сессии
			else
			{
				if (isset($_SESSION["referrer"]))
					if ( ($_SESSION["referrer"] != "") && (stristr($_SESSION["referrer"], SITE) === false) )
						$referrer = $_SESSION["referrer"];
			}
		}
		
		if ($referrer != "прямой заход") $referrer = parseReferrer($referrer);
		
		$message .= "<i>Откуда пришёл:</i> " . $referrer . "\r\n";
	}
	
	$message .= "</body></html>";
	
	$mail_body_attach = get_mail_attach($boundary, $message, $upload_file, $is_upload_file);
	
	$message_file = date("Y-m-d_H-i-s")."_message.html";
	$message_url  = "http://".SITE."/logs/".$message_file;

	////////////////
	// Добавление записи о новом сообщении от посетителя в таблицу orderds
	///////////////
	$sql = "INSERT INTO `orders` (`form`,`name`,`email`,`phone`,`message`,`file`,`date`) VALUES ('$form','$name','$email','$phone','$text','$file','$date')";
	$res = @mysql_query($sql);
	if ( ($res === false) || (mysql_affected_rows() < 1) )
	{
		@file_put_contents(ROOT . "/logs/$message_file", $message);
		
		$err = mysql_error();
		@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('<a class=\"fancybox-order driver\" data-fancybox-type=\"iframe\" href=\"$message_url\">Письмо посетителя</a> не добавлено в таблицу заказов', '<b>File</b>: sendmessage.php<br /><b>SQL</b>: ".addslashes($sql)."<br /><b>Error</b>: ".addslashes($err)."')");
	}
	
	////////////
	// Отправка письма с сообщением всем администраторам
	///////////
	$sql = "SELECT `value` FROM `settings` WHERE `name`='orders_email'";
	$query = @mysql_query($sql);
	if ($query && ($row = @mysql_fetch_array($query)))
	{
		$admin_emails = explode(",", $row["value"]);
		foreach ($admin_emails as $admin_email)
		{
			if (!@mail(trim($admin_email), $subject, $mail_body_attach, $headers))
			{
				@file_put_contents(ROOT . "/logs/$message_file", $message);
				
				@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('<a class=\"fancybox-order driver\" data-fancybox-type=\"iframe\" href=\"$message_url\">Письмо посетителя</a> на электронную почту администратора $admin_email не отправлено', '<b>File</b>: sendmessage.php')");
			}
		}
	}
	else
	{
		@file_put_contents(ROOT . "/logs/$message_file", $message);
		
		$err = mysql_error();
		@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('<a class=\"fancybox-order driver\" data-fancybox-type=\"iframe\" href=\"$message_url\">Письмо посетителя</a> не отправлено, так как в таблице настроек не найдено свойство orders_email', '<b>File</b>: sendmessage.php<br /><b>SQL</b>: ".addslashes($sql)."<br /><b>Error</b>: ".addslashes($err)."')");
	}
	
	//////////////
	// Отправка файла посетителю, если был запрошен файл для загрузки
	//////////////
	if ($is_download_file)
	{
		$text_email = "С уважением, тех. поддержка сайта ".SITE_NAME;
		$sql = "SELECT `value` FROM `settings` WHERE `name`='text_email'";
		$query = @mysql_query($sql);
		if ($query && ($row = @mysql_fetch_array($query)))
			$text_email = $row["value"];
		else
		{
			$err = mysql_error();
			@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('В таблице настроек не найдено свойство «Подпись для писем» (text_email)', '<b>File</b>: sendmessage.php<br /><b>SQL</b>: ".addslashes($sql)."<br /><b>Error</b>: ".addslashes($err)."')");
		}
		
		$boundary = md5(rand(0, time()));
		
		$subject  = "Запрошенный файл с сайта ".SITE_NAME;
		$subject  = "=?UTF-8?B?" . base64_encode($subject) . "?=";
		
		$headers = "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "From: $company_name <info@".SITE.">\r\n";
		
		$message  = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head><body>\r\n";
		$message .= "Добрый день!<br /><br />\r\n";
		$message .= "К письму присоединён файл $download_file.<br /><br />\r\n";
		$message .= "$text_email\r\n";
		$message .= "</body></html>";
		
		$mail_body_attach = get_mail_attach($boundary, $message, $download_file, $is_download_file);
		
		if (!@mail($email, $subject, $mail_body_attach, $headers))
		{
			$message_file = date("Y-m-d_H-i-s")."_download.html";
			$message_url  = "http://".SITE."/logs/".$message_file;
			
			@file_put_contents(ROOT . "/logs/$message_file", $message);
			
			@mysql_query("INSERT INTO `errors` (`text`, `data`) VALUES ('<a class=\"fancybox-order driver\" data-fancybox-type=\"iframe\" href=\"$message_url\">Письмо с файлом</a> на электронную почту посетителя $email не отправлено', '<b>File</b>: sendmessage.php')");
		}
	}
	
	//////////////
	// Сообщение о результате операции скрипту form_sendmessage.js
	/////////////
	ob_clean();
	echo "true";
	ob_end_flush();
?>