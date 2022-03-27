<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################

	if (!isset($_GET["type"])) $_GET["type"] = "data";
	
	$sql = "SELECT * FROM `users` WHERE `id`={$_SESSION["user_id"]}";
	$query_user = mysql_query($sql);
	if ($query_user && ($user = mysql_fetch_array($query_user)))
	{
		$login_id   = $user["id"];
		$login      = $user["login"];
		$name       = $user["name"];
		$email      = $user["email"];
		$old_pass   = $user["pass"];
		$show_error = $user["show_error"];
		
		if ($_GET["type"] == "data")
		{
			if (isset($_POST["save_account"]))
			{
				$new_login = strtolower(trim($_POST["user_login"]));
				$new_name  = trim($_POST["user_name"]);
				$new_email = trim($_POST["user_email"]);
				$new_show_error = ( isset($_POST["show_error"]) && ($_POST["show_error"] == "on") ) ? 1 : 0;
				
				// Изменение логина
				if ($new_login != "")
				{
					if (preg_match("#^[a-z0-9\_\-]+$#ims", $new_login) == 1)
					{
						if (    ($_SESSION["user_id"] == 1) && ($new_login != "superadmin"))
							$message .= "<span class=\"error\">Логин superadmin не может быть сменён</span>";
						elseif (($_SESSION["user_id"] == 2) && ($new_login != "admin"))
							$message .= "<span class=\"error\">Логин admin не может быть сменён</span>";
						elseif (($_SESSION["user_id"] != 1) && ($new_login == "superadmin"))
							$message .= "<span class=\"error\">Логин superadmin не может быть присвоен пользователю</span>";
						elseif (($_SESSION["user_id"] != 2) && ($new_login == "admin"))
							$message .= "<span class=\"error\">Логин admin не может быть присвоен пользователю</span>";
						elseif ($login != $new_login)
						{
							$sql = "UPDATE `users` SET `login`='$new_login' WHERE `id`={$_SESSION["user_id"]}";
							mysql_query($sql);
							if (mysql_affected_rows() == 1)
							{
								$login = $new_login;
								$message .= "<span class=\"success\">Логин успешно изменён</span>";
							}
							else
								$message .= "<span class=\"error\">Логин не изменён из-за ".get_error(1)."</span>";
						}
					}
					else
						$message .= "<span class=\"error\">Логин может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
				}
				else
					$message .= "<span class=\"error\">Логин не может быть пустым</span>";
				
				// Изменение имени
				if ($new_name != "")
				{
					if (preg_match("#^[a-zа-яё0-9\_\-\s]+$#imsu", $new_name) == 1)
					{
						if ($name != $new_name)
						{
							$sql = "UPDATE `users` SET `name`='$new_name' WHERE `id`={$_SESSION["user_id"]}";
							mysql_query($sql);
							if (mysql_affected_rows() == 1)
							{
								$name = $new_name;
								$_SESSION["user_name"] = $new_name;
								$message .= "<span class=\"success\">Имя успешно изменено</span>";
							}
							else
								$message .= "<span class=\"error\">Имя не изменено из-за ".get_error(1)."</span>";
						}
					}
					else
						$message .= "<span class=\"error\">Имя может состоять из латинских и русских букв, цифр, тире и знака подчёркивания</span>";
				}
				else
					$message .= "<span class=\"error\">Имя не может быть пустым</span>";
				
				// Изменение email
				if ($new_email != "")
				{
					if (filter_var($new_email, FILTER_VALIDATE_EMAIL))
					{
						if ($email != $new_email)
						{
							$sql = "UPDATE `users` SET `email`='$new_email' WHERE `id`={$_SESSION["user_id"]}";
							mysql_query($sql);
							if (mysql_affected_rows() == 1)
							{
								$email = $new_email;
								$_SESSION["user_email"] = $new_email;
								$message .= "<span class=\"success\">Email успешно изменён</span>";
							}
							else
								$message .= "<span class=\"error\">Email не изменён из-за ".get_error(1)."</span>";
						}								
					}
					else
						$message .= "<span class=\"error\">Email не является корректным</span>";
				}
				else
					$message .= "<span class=\"error\">Email не может быть пустым</span>";
				
				// Сохранение настройки для показа сообщений
				if ($show_error != $new_show_error)
				{
					$sql = "UPDATE `users` SET `show_error`=$new_show_error WHERE `id`={$_SESSION["user_id"]}";
					mysql_query($sql);
					if (mysql_affected_rows() == 1)
					{
						$show_error = $new_show_error;
						$_SESSION["show_error"] = $new_show_error;
						$message .= "<span class=\"success\">Настройка для показа сообщений успешно изменена</span>";
					}
					else
						$message .= "<span class=\"error\">Настройка для показа сообщений не изменена из-за ".get_error(1)."</span>";
				}
			} // if (isset($_POST["save_account"]))
			
			$smarty->assign("user_login", htmlspecialchars($login));
			$smarty->assign("user_name",  htmlspecialchars($name));
			$smarty->assign("user_email", htmlspecialchars($email));
			$smarty->assign("show_error", $show_error);
		} // if ($_GET["type"] == "data")
		
		// Изменение пароля
		if ($_GET["type"] == "pass")
		{
			if (isset($_POST["save_account"]))
			{
				$pass  = trim($_POST["user_pass"]);
				$pass1 = trim($_POST["user_new_pass1"]);
				$pass2 = trim($_POST["user_new_pass2"]);
				
				if (($pass != "") && ($pass1 != "") && ($pass2 != ""))
				{
					if (md5($pass) == $old_pass)
					{
						if ((preg_match("#^[a-z0-9\_\-]+$#ims", $pass1) == 1) && (strlen($pass1) >= 6))
						{
							if ($pass1 == $pass2)
							{
								$sql = "UPDATE `users` SET `pass`='".md5($pass1)."' WHERE `id`={$_SESSION["user_id"]}";
								mysql_query($sql);
								if (mysql_affected_rows() == 1)
								{
									if (isset($_POST["send_data"]))
									{
										$subject  = "Данные для доступа (Конструктор лендингов LandKit)";
			
										$headers  = "From:info@landkit.ru\r\n";
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=\"utf-8\"\r\n";

										$letter  = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head>\r\n";
										$letter .= "<body style=\"font-size: 14px; font-family: Georgia, serif; background: Snow;\">\r\n";
										$letter .= "<p style=\"font-weight: bold; color: #0066CB;\">Данные для доступа</p>";
										$letter .= "<p>Ваш логин: $login<br />Ваш пароль: $pass1</p>";
										$letter .= "</body></html>";

										if (mail($email, $subject, $letter, $headers))
											$message .= "<span class=\"success\">Пароль успешно изменён и отправлен на email $email</span>";
										else
											$message .= "<span class=\"info\">Пароль успешно изменён, но не отправлен письмом из-за ".get_error(1)."</span>";
									}
									else
										$message .= "<span class=\"success\">Пароль успешно изменён</span>";
								}
								else
									$message .= "<span class=\"error\">Новый пароль не изменён из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Новый пароль не совпадает с повтором</span>";
						}
						else
							$message .= "<span class=\"error\">Новый пароль может состоять из латинских букв, цифр, тире и знака подчёркивания и иметь длину 6 или более символов</span>";
					}
					else
						$message .= "<span class=\"error\">Старый пароль не совпадает с существующим паролем</span>";
				}
				else
					$message .= "<span class=\"error\">Заполнены не все поля паролей</span>";
			}
		} // if ($_GET["type"] == "pass")
		
		if ($_GET["type"] == "list")
		{
			// Добавить запись о пользователе
			if (isset($_POST["new_user_login"]))
			{
				$new_user_login	= trim($_POST["new_user_login"]);
				$new_user_pass 	= trim($_POST["new_user_pass"]);
				$new_user_name 	= trim($_POST["new_user_name"]);
				$new_user_email	= trim($_POST["new_user_email"]);
				
				$new_user_id = create_user($new_user_login, $new_user_pass, $new_user_name, $new_user_email);
			}
			
			// Удалить запись о пользователе
			if (isset($_GET["action"]) && ($_GET["action"] == "delete"))
			{
				if (isset($_GET["id"]) && (trim($_GET["id"]) != ""))
				{
					$id = preg_replace('#\D#is', '', $_GET["id"]);
					if ($id != "")
					{
						$sql = "DELETE FROM `users` WHERE `id`=$id";
						if (mysql_query($sql))
						{
							if (mysql_affected_rows() == 1)
								$message .= "<span class=\"success\">Запись о пользователе успешно удалена</span>";
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при удалении пользователя</span>";
					}
					else
						$message .= "<span class=\"error\">Идентификатор удаляемого пользователя некорректный</span>";
				}
				else
					$message .= "<span class=\"error\">Отсутствует идентификатор удаляемого пользователя</span>";
			}
			
			// Список пользователей, кроме текущего и кроме суперадмина и админа
			$users = array();
			$sql = "SELECT * FROM `users` WHERE `id`<>{$_SESSION["user_id"]} AND `id`>2";
			$query_users = mysql_query($sql);
			if ($query_users)
			{
				while ($row = mysql_fetch_array($query_users))
					$users[] = $row;
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка пользователей</span>";
			
			$smarty->assign("users", $users);
		} // if ($_GET["type"] == "list")
	}
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе пользователя с id={$_SESSION["user_id"]}</span>";
?>