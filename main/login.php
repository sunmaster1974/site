<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	$is_error   = "";
	$is_restore = "false";
	
	$login = isset($_POST["user_login"]) ? strtolower(trim($_POST["user_login"])) : "";
	$pass  = isset($_POST["user_pass"])  ? trim($_POST["user_pass"])  : "";
	$email = isset($_POST["user_email"]) ? trim($_POST["user_email"]) : "";
	
	function add_log($sql)
	{
		$err = mysql_error();
		mysql_query("INSERT INTO `logs`(`text`, `data`) VALUES ('<b>Error</b>: ".addslashes($err)."', '<b>Sql</b>: ".addslashes($sql)."')");
	}
	
	if (isset($_POST["login_submit"]))
	{
		if (($login != "") && ($pass != ""))
		{
			if (preg_match("#^[a-z0-9\_\-]+$#ims", $login) == 1)
			{
				$sql = "SELECT * FROM `users` WHERE `login`='$login'";
				if (($query_user = mysql_query($sql)) && ($user = mysql_fetch_array($query_user)))
				{
					if (md5($pass) == $user["pass"])
						check_enter($user);
					else
						$is_error = "Введён неверный пароль";
				}
				else
				{
					add_log($sql);
					$is_error = "Пользователь $login не найден";
				}
			}
			else
				$is_error = "Логин может состоять из латинских букв, цифр, тире и знака подчёркивания";
		}
		else
			$is_error = "Поля логина и пароля должны быть заполнены";
	}

	if (isset($_POST["show_restore_submit"]))
	{
		$is_restore = "true";
	}

	if (isset($_POST["restore_submit"]))
	{
		$is_restore = "true";
		
		if ($login != "")
		{
			if (preg_match("#^[a-z0-9\_\-]+$#ims", $login) == 1)
			{
				$sql = "SELECT `email` FROM `users` WHERE `login`='$login'";
				$query_user = mysql_query($sql);
				if ($query_user && ($user = mysql_fetch_array($query_user)))
				{
					$email = $user["email"];
					if (filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						$pass = substr(preg_replace('#\W#ims', "", crypt(microtime())), 1, 8);
						
						$company_name = "Сайт " . SITE;
						$sql = "SELECT `value` FROM `settings` WHERE `name`='company_name'";
						$query = mysql_query($sql);
						if ($query && ($row = mysql_fetch_array($query)))
							$company_name = str_replace('"', '\"', $row["value"]);
						else
							add_log($sql);
						
						$text_email = "С уважением, сайт " . SITE;
						$sql = "SELECT `value` FROM `settings` WHERE `name`='text_email'";
						$query = mysql_query($sql);
						if ($query && ($row = mysql_fetch_array($query)))
							$text_email = $row["value"];
						else
							add_log($sql);
							
						$subject  = "Восстановление пароля для Конструктора лендингов LandKit";
						$subject  = "=?UTF-8?B?" . base64_encode($subject) . "?=";
						
						$company_name = "=?UTF-8?B?" . base64_encode($company_name) . "?=";
						
						$headers = "Content-Type: text/html; charset=\"utf-8\"\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "From: $company_name <info@".str_replace("www.", "", strtolower(SITE)).">\r\n";
						
						$message  = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head>\r\n";
						$message .= "<body style=\"font-size: 14px; font-family: Georgia, serif; background: Snow;\">\r\n";
						$message .= "<span style=\"font-weight: bold; color: #4b73ba;\">Восстановление пароля</span><br /><br />\r\n";
						$message .= "Ваш логин: $login<br />Ваш новый пароль: $pass<br /><br />\r\n";
						$message .= "Вход в панель управления: http://".SITE."/main/index.php<br /><br />\r\n";
						$message .= "$text_email<br /><br />\r\n";
						$message .= "</body></html>";
						
						if (mail($email, $subject, $message, $headers))
						{
							$pass = md5($pass);
							
							$sql = "UPDATE `users` SET `pass`='$pass' WHERE `login`='$login'";
							$query_update = mysql_query($sql);
							if ($query_update && (mysql_affected_rows() == 1))
							{
								$is_restore = "false";
								$is_error = "На электронный адрес $email отправлено письмо с новым паролем";
							}
							else
							{
								add_log($sql);
								$is_error = "Новый пароль был отправлен на электронный адрес $email, но не записан в базу данных из-за ошибки";
							}
						}
						else
							$is_error = "Письмо с новым паролем не отправлено из-за ошибки";
					}
					else
						$is_error = "Электронный адрес $email некорректен";
				}
				else
				{
					add_log($sql);
					$is_error = "Пользователь $login не найден";
				}
			}
			else
				$is_error = "Логин может состоять из латинских букв, цифр, тире и знака подчёркивания";
		}
		else
			$is_error = "Все поля должны быть заполнены";
	}
	
	$smarty->assign("is_restore", $is_restore);
	$smarty->assign("is_error",   $is_error);
	
	$smarty->assign("user_login", htmlspecialchars($login));
	$smarty->assign("user_email", htmlspecialchars($email));
?>