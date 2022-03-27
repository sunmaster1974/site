<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "new";
		
	if ($_GET["type"] == "errors")
	{
		// Очищение журнала ошибок
		if (isset($_GET["action"]) && ($_GET["action"] == "clear_errors"))
		{
			mysql_query("DELETE FROM `errors`");
			if (mysql_affected_rows() > 0)
			{
				mysql_query("ALTER TABLE `errors` AUTO_INCREMENT =1");
				$message .= "<span class=\"success\">Журнал отправки писем успешно очищен</span>";
				
				// Удалить все файлы сохранённых писем
				$files = array();
				$files = glob(ROOT . "/logs/*");
				foreach ($files as $file) unlink($file);
			}
		}
		
		// Получение количества записей
		$count_rows = 0;
		$sql = "SELECT COUNT(*) FROM `errors`";
		$query_errors = mysql_query($sql);
		if ($query_errors)
		{
			$row = mysql_fetch_row($query_errors);
			$count_rows = $row[0];
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества записей журнала отправки писем</span>";
		
		$per_page = 10;
		$count_pages = $count_rows / $per_page + 1;
		
		$page_number = 1;
		if (isset($_GET["number"]))
		{
			$page_number = preg_replace('#\D#ims', '', $_GET["number"]);
			if (empty($page_number)) $page_number = 1;
		}
		
		$errors = array();
		$paginator = "";
		if ($page_number <= $count_pages)
		{
			if ($count_rows > $per_page)
			{
				$start_record = ($page_number - 1) * $per_page + 1;
				$limit_clause = " LIMIT $start_record, $per_page";
				
				$paginator = "Страницы: | ";
				for ($i = 1; $i <= $count_pages; $i++)
				{
					if ($i == $page_number)
						$paginator .= "$i | ";
					else
						$paginator .= "<a class=\"paginator\" href=\"index.php?page=orders&amp;type=errors&amp;number=$i\">$i</a> | ";
				}
			}
			else
				$limit_clause = "";
			
			$sql = "SELECT `id`, DATE_FORMAT(`date`, '%d.%m.%Y %H:%i:%s') AS `date_time`,`text`,`data` FROM `errors` ORDER BY `id` DESC$limit_clause";
			$query_errors = mysql_query($sql);
			if ($query_errors)
			{
				while ($row = mysql_fetch_array($query_errors))
					$errors[] = $row;
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе записей журнала отправки писем</span>";
		}
		else
			$message .= "<span class=\"error\">Страница №$page_number журнала отправки писем не существует</span>";
		
		$smarty->assign("errors", $errors);
		$smarty->assign("paginator", $paginator);
	}
	else
	{
		if (isset($_GET["action"]))
		{
			if (isset($_GET["id"]))
			{
				$id = trim($_GET["id"]);
				
				$sql = "SELECT `file` FROM `orders` WHERE `id`=$id";
				$query_order = mysql_query($sql);
				if ($query_order && ($order = mysql_fetch_array($query_order)))
				{
					// Удалить заявку
					if ($_GET["action"] == "delete")
					{
						$file = $order["file"];
						
						$sql = "DELETE FROM `orders` WHERE `id`=$id";
						mysql_query($sql);
						if (mysql_affected_rows() == 1)
						{
							$message .= "<span class=\"success\">Заявка успешно удалена</span>";
							
							if (isset($_GET["file"]) && ($_GET["file"] == "yes") && ($file != ""))
							{
								if (file_exists($files_path.$file))
								{
									if (unlink($files_path.$file))
										$message .= "<span class=\"success\">Файл-вложение успешно удалён</span>";
									else
										$message .= "<span class=\"info\">Файл-вложение не удалён из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"info\">Файл-вложение не найден на диске</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Заявка не удалена из-за ".get_error(1)."</span>";
					}
					
					// Переместить заявку в архив
					if ($_GET["action"] == "move")
					{
						$sql = "UPDATE `orders` SET `status`=1 WHERE `id`=$id";
						mysql_query($sql);
						if (mysql_affected_rows() == 1)
							$message .= "<span class=\"success\">Заявка успешно перемещена в «Архив»</span>";
						else
							$message .= "<span class=\"error\">Заявка не перемещена в «Архив» из-за ".get_error(1)."</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе заявки с id=$id</span>";
			}
			else
				$message .= "<span class=\"error\">Отсутствует идентификатор заявки</span>";
		}
		
		if ($_GET["type"] == "new") $where = "WHERE `status`=0";
		if ($_GET["type"] == "all") $where = "";
		if ($_GET["type"] == "old") $where = "WHERE `status`=1";
		
		$orders = array();
		$sql = "SELECT * FROM `orders` $where ORDER BY `date` DESC";
		$query_orders = mysql_query($sql);
		if ($query_orders)
		{
			while ($order = mysql_fetch_array($query_orders))
			{
				$order["date"] = format_mysql_date($order["date"], "d.m.y h:i");
				
				if (mb_strlen($order['message'], "utf-8") > 120)
				{
					$order["is_message_long"] = true;
					$order["message_short"] = mb_substr($order["message"], 0, 120, "utf-8") . "...";
				}
				else
				{
					$order["is_message_long"] = false;
					$order["message_short"] = $order["message"];
				}
				
				$orders[] = $order;
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка заявок</span>";
		
		$smarty->assign("orders", $orders);
	}
?>