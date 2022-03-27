<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################

	if (!isset($_GET["type"])) $_GET["type"] = "logs";

	if (isset($_GET["view"]))
		$smarty->assign("view_id", $_GET["view"]);
	else
		$smarty->assign("view_id", "");
	
	// Очищение журнала ошибок
	if (isset($_GET["action"]) && ($_GET["action"] == "clear_logs"))
	{
		$sql = "DELETE FROM `logs`";
		if (mysql_query($sql))
		{
			if (mysql_affected_rows() > 0)
			{
				mysql_query("ALTER TABLE `logs` AUTO_INCREMENT =1");
				$message .= "<span class=\"success\">Журнал ошибок успешно очищен</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при очищении журнала ошибок</span>";
	}
	
	// Получение количества записей
	$count_rows = 0;
	$sql = "SELECT COUNT(*) FROM `logs`";
	if (($query_logs = mysql_query($sql)) && ($row = mysql_fetch_row($query_logs)))
		$count_rows = $row[0];
	else
		$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества записей журнала ошибок</span>";
	
	$per_page = 10;
	$count_pages = $count_rows / $per_page + 1;
	
	$page_number = 1;
	if (isset($_GET["number"]))
	{
		$page_number = preg_replace('#\D#ims', '', $_GET["number"]);
		if (empty($page_number)) $page_number = 1;
	}
	
	$logs = array();
	$paginator = "";
	if ($page_number <= $count_pages)
	{
		if ($count_rows > $per_page)
		{
			$start_record = ($page_number - 1) * $per_page;
			$limit_clause = " LIMIT $start_record, $per_page";
			
			$paginator = "Страницы: | ";
			for ($i = 1; $i <= $count_pages; $i++)
			{
				if ($i == $page_number)
					$paginator .= "$i | ";
				else
					$paginator .= "<a class=\"paginator\" href=\"index.php?page=journal&amp;number=$i\">$i</a> | ";
			}
		}
		else
			$limit_clause = "";
		
		$sql = "SELECT `id`, DATE_FORMAT(`date`, '%d.%m.%Y %H:%i:%s') AS `date_time`,`text`,`data` FROM `logs` ORDER BY `id` DESC$limit_clause";
		if ($query_logs = mysql_query($sql))
		{
			while ($log = mysql_fetch_array($query_logs))
				$logs[] = $log;
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе записей журнала ошибок</span>";
	}
	else
		$message .= "<span class=\"error\">Страница №$page_number журнала ошибок не существует</span>";
	
	$smarty->assign("logs", $logs);
	$smarty->assign("paginator", $paginator);
?>