<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "stat";
	
	$ips_google = array();
	$ips_google[] = "66.249."; // (compatible; Googlebot/2.1; +http://www.google.com/bot.html), AdsBot-Google (+http://www.google.com/adsbot.html)
	$ips_google[] = "107.178.195."; // AppEngine-Google; (+http://code.google.com/appengine; appid: s~domxssscanner-hrd)
	
	$ips_yandex = array();
	$ips_yandex[] = "5.255.253.";
	$ips_yandex[] = "37.9.118."; // (compatible; YandexImageResizer/2.0; +http://yandex.com/bots)"
	$ips_yandex[] = "37.9.122."; // (compatible; YandexBot/3.0; +http://yandex.com/bots)
	$ips_yandex[] = "37.140.141.";
	$ips_yandex[] = "87.250.241.";
	$ips_yandex[] = "93.158.152.";
	$ips_yandex[] = "95.108."; // (compatible; YandexMetrika/2.0; +http://yandex.com/bots mtmon01i.yandex.ru)
	$ips_yandex[] = "100.43.";
	$ips_yandex[] = "130.193."; // (compatible; YandexMobileBot/3.0; +http://yandex.com/bots)  (compatible; YandexImages/3.0; +http://yandex.com/bots)
	$ips_yandex[] = "141.8."; // (compatible; YandexBot/3.0; +http://yandex.com/bots)
	$ips_yandex[] = "178.154."; // (compatible; YandexMetrika/2.0; +http://yandex.com/bots mtmon01i.yandex.ru)
	$ips_yandex[] = "213.180.206"; // (compatible; YandexMetrika/2.0; +http://yandex.com/bots mtmon01i.yandex.ru)
	
	$words_yandex = array();
	$words_yandex[] = "yandex.com/bots"; // Перейти на эту запись, когда пройдёт время - записи есть в таблицах без user_agent, тогда его можно распознать только по ip
	
	$words_bot = array();
	$words_bot[] = "crawler";
	$words_bot[] = "HostTracker";
	$words_bot[] = "GuzzleHttp";
	$words_bot[] = "Monitoring";
	$words_bot[] = "Yahoo!"; // (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)
	
	if (isset($_GET["action"]) && ($_GET["action"] == "clear_list"))
	{
		$sql = "DELETE FROM `sessions`";
		if (mysql_query($sql))
		{
			if (mysql_affected_rows() > 0)
			{
				mysql_query("ALTER TABLE `sessions` AUTO_INCREMENT =1");
				$message .= "<span class=\"success\">Список посетителей успешно удалён</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при удалении списка посетителей</span>";
	}
	
	if ($_GET["type"] == "stat")
	{
		$months = array("январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь");
		
		// Параметр $month показывает число месяцев от текущего для показа
		$month = (isset($_GET["month"])) ? $_GET["month"] : 0;
		$month = preg_replace('#\D#is', '', $month);
		if ($month == "") $month = 0;
		
		$month_curr = date("m", strtotime("-".$month." month"));
		$year_curr  = date("Y", strtotime("-".$month." month"));
		$link_center = $months[$month_curr - 1];
		
		if ($month == 0)
			$link_forwards = '<span class="stat_links inactive"> &gt;&gt; </span>';
		else
		{
			$month_next = date("m", strtotime("-".($month - 1)." month"));
			$year_next  = date("Y", strtotime("-".($month - 1)." month"));
			$link_forwards = '<a class="stat_links tooltip" title="Статистика посещений по дням<br />за '.$months[$month_next - 1].' '.$year_next.' года" href="index.php?page=visitors&amp;type=stat&amp;month='.($month - 1).'"> &gt;&gt; </a>';
		}
		
		$month_prev = date("m", strtotime("-".($month + 1)." month"));
		$year_prev  = date("Y", strtotime("-".($month + 1)." month"));
		$link_backwards = '<a class="stat_links tooltip" title="Статистика посещений по дням<br />за '.$months[$month_prev - 1].' '.$year_prev.' года" href="index.php?page=visitors&amp;type=stat&amp;month='.($month + 1).'"> &lt;&lt; </a>';
		
		$start = date("Y-m-", strtotime("-".$month." month")) . "01"; // Начало периода для показа - первое число месяца
		$end   = date("Y-m-d", strtotime("-$month month"));
		
		$show_yandex = (isset($_SESSION["show_yandex"])) ? $_SESSION["show_yandex"] : true;
		$show_google = (isset($_SESSION["show_google"])) ? $_SESSION["show_google"] : true;
		$show_bots   = (isset($_SESSION["show_bots"]))   ? $_SESSION["show_bots"]   : true;
		
		if (isset($_GET["action"]))
		{
			if ($_GET["action"] == "show_yandex")
			{
				$show_yandex = ($_GET["value"] == "yes");
				$_SESSION["show_yandex"] = $show_yandex;
			}
			
			if ($_GET["action"] == "show_google")
			{
				$show_google = ($_GET["value"] == "yes");
				$_SESSION["show_google"] = $show_google;
			}
			
			if ($_GET["action"] == "show_bots")
			{
				$show_bots = ($_GET["value"] == "yes");
				$_SESSION["show_bots"] = $show_bots;
			}
		}
		
		$yandex_arr = array();
		foreach ($ips_yandex as $ip)
			$yandex_arr[] = "`ip_address` LIKE '%$ip%'";
		//foreach ($words_yandex as $word)
			//$yandex_arr[] = "`user_agent` LIKE '%$word%'";
		$sql_like_yandex = implode(" OR ", $yandex_arr);
		
		// Получение количества заходов робота Яндекса за месяц
		$count_yandex = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE `last_date` LIKE '%$year_curr-$month_curr%' AND ($sql_like_yandex)";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$count_yandex = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества заходов робота Яндекса за месяц</span>";
		
		// Получение количества заходов робота Яндекса за всё время
		$count_total_yandex = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE $sql_like_yandex";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$count_total_yandex = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества заходов робота Яндекса за всё время</span>";
		
		$google_arr = array();
		foreach ($ips_google as $ip)
			$google_arr[] = "`ip_address` LIKE '%$ip%'";
		$sql_like_google = implode(" OR ", $google_arr);
		
		// Получение количества заходов робота Гугла за месяц
		$count_google = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE `last_date` LIKE '%$year_curr-$month_curr%' AND ($sql_like_google)";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$count_google = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества заходов робота Гугла за месяц</span>";
		
		// Получение количества заходов робота Гугла за всё время
		$count_total_google = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE $sql_like_google";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$count_total_google = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества заходов робота Гугла за всё время</span>";
			
		$bots_arr = array();
		foreach ($words_bot as $word)
			$bots_arr[] = "`user_agent` LIKE '%$word%'";
		$sql_like_bots = "`user_agent` = '' OR " . implode(" OR ", $bots_arr);
		
		// Получение количества заходов остальных роботов за месяц
		$count_bots = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE `last_date` LIKE '%$year_curr-$month_curr%' AND NOT ($sql_like_yandex) AND NOT ($sql_like_google) AND ($sql_like_bots OR `user_agent` LIKE '%bot%')";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$count_bots = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества заходов остальных роботов за месяц</span>";
		
		// Получение количества заходов остальных роботов за всё время
		$count_total_bots = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE NOT ($sql_like_yandex) AND NOT ($sql_like_google) AND ($sql_like_bots OR `user_agent` LIKE '%bot%')";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$count_total_bots = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества заходов остальных роботов за всё время</span>";
		
		$where = "";
		if (!$show_yandex) $where .= " AND NOT ($sql_like_yandex)";
		if (!$show_google) $where .= " AND NOT ($sql_like_google)";
		if (!$show_bots)
		{
			$where .= " AND NOT ($sql_like_bots) AND (`user_agent` NOT LIKE '%bot%'";
			if ($show_yandex) $where .= " OR `user_agent` LIKE '%Yandex%'";
			if ($show_google) $where .= " OR `user_agent` LIKE '%Google%'";
			$where .= ")";
		}
		$_SESSION["where"] = $where;
		
		// Получение максимума посещений за все периоды
		$max_days = 0;
		$sql = "SELECT MAX(visits) FROM (SELECT COUNT(`id`) AS visits FROM `sessions` WHERE 1$where GROUP BY DATE(`last_date`) ORDER BY visits DESC) AS Alias";
		$query = mysql_query($sql);
		if ($query && ($row = mysql_fetch_row($query)))
			$max_days = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе максимального количества посещений за все периоды</span>";
		
		$i = 0;
		$data1 = array();
		$date_first = $year_curr."-".$month_curr."-01";
		$date_last  = $year_curr."-".$month_curr."-31";
		
		if ($max_days > 0)
		{
			$day = $date_first;
			while (date("m", strtotime($day)) == $month_curr)
			{
				$date_last = $day;
				$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE DATE(`last_date`)='$day'$where";
				$query = mysql_query($sql);
				if ($query && ($row = mysql_fetch_row($query)))
				{
					if ($day <= date("Y-m-d"))
						$data1[] = "['$day', {$row[0]}]";
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества посещений за дату $day</span>";
				$i++;
				$day = date("Y-m-d", strtotime("+$i days", strtotime($date_first)));
			}
		}
		
		// Статистика по месяцам
		$max_months = 0;
		$data2 = array();
		$sql = "SELECT DISTINCT MONTH( `last_date` ) AS `month` , YEAR( `last_date` ) AS `year` FROM `sessions`";
		if ($query_months = mysql_query($sql))
		{
			while ($date = mysql_fetch_array($query_months))
			{
				if ((int)$date["month"] < 10) $date["month"] = "0" . $date["month"];
				$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE `last_date` LIKE '%{$date["year"]}-{$date["month"]}%'$where";
				$query = mysql_query($sql);
				if ($query && ($row = mysql_fetch_row($query)))
				{
					if ((int)$row[0] > $max_months) $max_months = $row[0];
					$data2[] = "['{$date["year"]}-{$date["month"]}-01', {$row[0]}]";
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества посещений за месяц {$date["month"]}.{$date["year"]}</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка месяцев за все периоды</span>";
		
		$smarty->assign("show_google", $show_google);
		$smarty->assign("show_yandex", $show_yandex);		
		$smarty->assign("show_bots",   $show_bots);
		
		$smarty->assign("count_yandex", 	  $count_yandex);
		$smarty->assign("count_total_yandex", $count_total_yandex);
		$smarty->assign("count_google", 	  $count_google);
		$smarty->assign("count_total_google", $count_total_google);
		$smarty->assign("count_bots", 		  $count_bots);
		$smarty->assign("count_total_bots",   $count_total_bots);
		
		$smarty->assign("date_first", $date_first);
		$smarty->assign("date_last",  $date_last);
		
		$smarty->assign("link_forwards",  $link_forwards);
		$smarty->assign("link_center",    $link_center);
		$smarty->assign("link_backwards", $link_backwards);
		
		$smarty->assign("max_days", $max_days + $max_days*0.3);
		$smarty->assign("line1", implode(",", $data1));
		
		$smarty->assign("max_months", $max_months + $max_months*0.3);
		$smarty->assign("line2", implode(",", $data2));
	}
	
	// Статистика по сайтам-реферрерам
	if ($_GET["type"] == "refer")
	{
		$domain = str_replace('www.', '', strtolower(SITE));
		$referrers = array();
		$referrers_counts = array();
		
		$sql = "SELECT `referrer` FROM `sessions` WHERE `referrer` <> '' AND `referrer` <> '/' AND LOWER(`referrer`) NOT LIKE '%$domain%'";
		if ($query_refs = mysql_query($sql))
		{
			$refs = array();
			while ($ref = mysql_fetch_array($query_refs))
			{
				$ref["referrer"] = str_replace("www.", "", strtolower($ref["referrer"]));
				
				if (stripos($ref["referrer"], "http") === false)
					$ref["referrer"] = "http://" . $ref["referrer"];
				
				if ($ref["referrer"] != "")
				{
					$str = parse_url($ref["referrer"], PHP_URL_HOST);
					if (is_string($str))
						$refs[] = $str;
				}
			}
			
			$referrers_counts = @array_count_values($refs);
			asort($referrers_counts);
			$referrers_counts = array_reverse($referrers_counts);
			foreach ($referrers_counts as $key => $value)
			{
				$referrer = array();
				$referrer["url"]   = $key;
				$referrer["count"] = $value;
				
				$referrers[] = $referrer;
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка сайтов-реферреров</span>";
		
		$count_refers = count($referrers);
		$page_number = 1;
		if (isset($_GET["number"]))
		{
			$page_number = preg_replace('#\D#ims', '', $_GET["number"]);
			if (empty($page_number)) $page_number = 1;
		}
		
		$refers_per_page = 50;
		$count_pages = ceil($count_refers / $refers_per_page);
		
		$paginator = "";
		
		if ($count_refers > 0)
		{
			if ($page_number <= $count_pages)
			{
				if ($count_refers > $refers_per_page)
				{
					$offset = ($page_number - 1) * $refers_per_page;
					
					$referrers = array_slice($referrers, $offset, $refers_per_page);
					
					if ($count_pages == 2)
					{
						if ($page_number == 1)
							$paginator .= "Страницы: | <span class=\"active_page\">1</span> | <a class=\"paginator\" href=\"index.php?page=visitors&amp;type=refer&amp;number=2\">2</a> |";
						if ($page_number == 2)
							$paginator .= "Страницы: | <a class=\"paginator\" href=\"index.php?page=visitors&amp;type=refer&amp;number=1\">1</a> | <span class=\"active_page\">2</span> |";
					}
					elseif ($count_pages > 2)
					{
						$paginator = "Страницы:&nbsp;&nbsp;&nbsp;<a class=\"paginator\" href=\"index.php?page=visitors&amp;type=refer&amp;number=1\">1</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						
						if ($page_number == 1)
							$paginator .= "<span class=\"inactive\">&lt;&lt;</span>";
						else
							$paginator .= "<a style=\"text-decoration: none;\" href=\"index.php?page=visitors&amp;type=refer&amp;number=".($page_number - 1)."\">&lt;&lt;</a>";
						
						$paginator .= "<input type=\"text\" class=\"input_text tooltip visitors_page\" title=\"Введите номер страницы и нажмите Enter для перехода\" name=\"number\" value=\"$page_number\" onkeyup=\"if (event.keyCode == 13) {event.preventDefault(); event.returnValue = false; event.cancel = true; window.location = 'index.php?page=visitors&amp;type=refer&amp;number=' + this.value;}\" />";
						
						if ($page_number == $count_pages)
							$paginator .= "<span class=\"inactive\">&gt;&gt;</span>";
						else
							$paginator .= "<a style=\"text-decoration: none;\" href=\"index.php?page=visitors&amp;type=refer&amp;number=".($page_number + 1)."\">&gt;&gt;</a>";
						
						$paginator .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class=\"paginator\" href=\"index.php?page=visitors&amp;type=refer&amp;number=$count_pages\">$count_pages</a>";
					}
				}
			}
			else
				$message .= "<span class=\"error\">Страница №$page_number списка сайтов-реферреров не существует</span>";
		}
		
		$smarty->assign("paginator", $paginator);
		$smarty->assign("referrers", $referrers);
	}
	
	if ($_GET["type"] == "list")
	{
		// Получение настройки записи данных о посетителях сайта
		$enable_visitors_db    = 1;
		$enable_visitors_title = "Включить запись данных о посетителях сайта";
		$enable_visitors_hint  = "Поставьте галочку, если необходимо сохранять в базе данных информацию о посетителях сайта. После изменения этой настройки страница сайта index.php будет обновлена.";
		
		$sql = "SELECT `title`, `description`, `value` FROM `settings` WHERE `name`='enable_visitors_db'";
		if ( ($query_setting = mysql_query($sql)) && ($setting = mysql_fetch_array($query_setting)) )
		{
			$enable_visitors_db    = $setting["value"];
			$enable_visitors_title = $setting["title"];
			$enable_visitors_hint  = $setting["description"];
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе настройки записи данных о посетителях сайта</span>";
		
		// Получение настройки количества записей на странице
		$visitors_per_page       = 50;
		$visitors_per_page_title = "Количество записей на странице списка посетителей: ";
		$visitors_per_page_hint  = "Сколько записей о посещении выводить на каждой странице списка посетителей сайта";
		
		$sql = "SELECT `title`, `description`, `value` FROM `settings` WHERE `name`='visitors_per_page'";
		if ( ($query_setting = mysql_query($sql)) && ($setting = mysql_fetch_array($query_setting)) )
		{
			$visitors_per_page       = $setting["value"];
			$visitors_per_page_title = $setting["title"];
			$visitors_per_page_hint  = $setting["description"];
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе настройки количества записей на странице списка посетителей сайта</span>";
		
		// Сохранение настроек
		if (isset($_POST["submit_save_settings"]))
		{
			$new_value = (isset($_POST["enable_visitors_db"])) ? 1 : 0;
			if ($new_value != $enable_visitors_db)
			{
				$sql = "UPDATE `settings` SET `value`=$new_value WHERE `name`='enable_visitors_db'";
				if (mysql_query($sql) && (mysql_affected_rows() == 1))
				{
					$is_refresh_site = true; // Обновить сайт, чтобы вписать в index.php скрипт session.php или session_db.php
					$enable_visitors_db = $new_value;
					$message .= "<span class=\"success\">Настройка записи данных о посетителях сайта успешно изменена</span>";
				}
				else
					$message .= "<span class=\"error\">Настройка записи данных о посетителях сайта не изменена из-за ".get_error(1)."</span>";
			}
			
			$new_value = preg_replace('#\D#is', '', $_POST["minutes_visitor_online"]);
			if ($new_value != "")
			{
				if ($new_value != $_SESSION["minutes_visitor_online"])
				{
					$sql = "UPDATE `settings` SET `value`=$new_value WHERE `name`='minutes_visitor_online'";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
					{
						$_SESSION["minutes_visitor_online"] = $new_value;
						$message .= "<span class=\"success\">Настройка количества минут нахождения посетителя на сайте успешно изменена</span>";
					}
					else
						$message .= "<span class=\"error\">Настройка количества минут нахождения посетителя на сайте не изменена из-за ".get_error(1)."</span>";
				}
			}
			else
				$message .= "<span class=\"error\">Ошибочное значение количества минут</span>";
			
			$new_value = preg_replace('#\D#is', '', $_POST["visitors_per_page"]);
			if ($new_value != "")
			{
				if ($new_value != $visitors_per_page)
				{
					$sql = "UPDATE `settings` SET `value`=$new_value WHERE `name`='visitors_per_page'";
					if (mysql_query($sql) && (mysql_affected_rows() == 1))
					{
						$visitors_per_page = $new_value;
						$message .= "<span class=\"success\">Настройка количества записей на странице списка посетителей успешно изменена</span>";
					}
					else
						$message .= "<span class=\"error\">Настройка количества записей на странице списка посетителей не изменена из-за ".get_error(1)."</span>";
				}
			}
			else
				$message .= "<span class=\"error\">Ошибочное значение количества записей на странице списка посетителей</span>";
		}
		
		$where = (isset($_SESSION["where"])) ? $_SESSION["where"] : "";
		
		// Получение количества записей
		$count_rows = 0;
		$sql = "SELECT COUNT(`id`) FROM `sessions` WHERE 1$where";
		if ( ($query_visitors = mysql_query($sql)) && ($row = mysql_fetch_row($query_visitors)) )
			$count_rows = $row[0];
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества посетителей</span>";
		
		$count_pages = ceil($count_rows / $visitors_per_page);
		
		$page_number = 1;
		if (isset($_GET["number"]))
		{
			$page_number = preg_replace('#\D#ims', '', $_GET["number"]);
			if (empty($page_number)) $page_number = 1;
		}
		
		$paginator = "";
		$visitors  = array();
		
		if ($count_rows > 0)
		{
			if ($page_number <= $count_pages)
			{
				if ($count_rows > $visitors_per_page)
				{
					$start_record = ($page_number - 1) * $visitors_per_page;
					$limit_clause = " LIMIT $start_record, $visitors_per_page";
						
					if ($count_pages == 2)
					{
						if ($page_number == 1)
							$paginator .= "Страницы: | 1 | <a class=\"paginator\" href=\"index.php?page=visitors&amp;type=list&amp;number=2\">2</a> |";
						if ($page_number == 2)
							$paginator .= "Страницы: | <a class=\"paginator\" href=\"index.php?page=visitors&amp;type=list&amp;number=1\">1</a> | 2 |";
					}
					elseif ($count_pages > 2)
					{
						$paginator = "Страницы:&nbsp;&nbsp;&nbsp;<a class=\"paginator\" href=\"index.php?page=visitors&amp;type=list&amp;number=1\">1</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						
						if ($page_number == 1)
							$paginator .= "<span class=\"inactive\">&lt;&lt;</span>";
						else
							$paginator .= "<a style=\"text-decoration: none;\" href=\"index.php?page=visitors&amp;type=list&amp;number=".($page_number - 1)."\">&lt;&lt;</a>";
						
						$paginator .= "<input type=\"text\" class=\"input_text tooltip visitors_page\" title=\"Введите номер страницы и нажмите Enter для перехода\" name=\"number\" value=\"$page_number\" onkeyup=\"if (event.keyCode == 13) {event.preventDefault(); event.returnValue = false; event.cancel = true; window.location = 'index.php?page=visitors&amp;type=list&amp;number=' + this.value;}\" />";
						
						if ($page_number == $count_pages)
							$paginator .= "<span class=\"inactive\">&gt;&gt;</span>";
						else
							$paginator .= "<a style=\"text-decoration: none;\" href=\"index.php?page=visitors&amp;type=list&amp;number=".($page_number + 1)."\">&gt;&gt;</a>";
						
						$paginator .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class=\"paginator\" href=\"index.php?page=visitors&amp;type=list&amp;number=$count_pages\">$count_pages</a>";
					}
				}
				else
					$limit_clause = "";
				
				$sql = "SELECT * FROM `sessions` WHERE 1$where ORDER BY `last_date` DESC$limit_clause";
				$query_visitors = mysql_query($sql);
				if ($query_visitors)
				{
					while ($visitor = mysql_fetch_array($query_visitors))
					{
						foreach ($ips_yandex as $ip)
						{
							if (strpos($visitor["ip_address"], $ip) === 0)
							{
								$visitor["note"] = "Робот Yandex";
								break;
							}
						}
						
						foreach ($ips_google as $ip)
						{
							if (strpos($visitor["ip_address"], $ip) === 0)
							{
								$visitor["note"] = "Робот Google";
								break;
							}
						}
						
						if     (strpos($visitor["ip_address"], "157.55.39.") === 0) 		$visitor["note"] = "Робот Bing.com";
						elseif (strpos($visitor["ip_address"], "40.77.167.") === 0) 		$visitor["note"] = "Робот Bing.com";
						elseif (strpos($visitor["ip_address"], "212.193.117.227") === 0) 	$visitor["note"] = "Робот Statdom.ru";
						elseif (strpos($visitor["ip_address"], "192.99.") === 0) 			$visitor["note"] = "Робот Meanpath.com";
						elseif (strpos($visitor["ip_address"], "151.80.31.111") === 0) 		$visitor["note"] = "Робот Ahrefs.com";
						elseif (strpos($visitor["ip_address"], "51.255.65.21") === 0) 		$visitor["note"] = "Робот Ahrefs.com";
						elseif (strpos($visitor["ip_address"], "188.165.15.29") === 0) 		$visitor["note"] = "Робот Ahrefs.com";
						elseif (strpos($visitor["ip_address"], "91.224.140.223") === 0) 	$visitor["note"] = "Робот на основе http-клиента GuzzleHttp";
						elseif (strpos($visitor["ip_address"], "207.241.226.232") === 0) 	$visitor["note"] = "Robot Archive.org";
						elseif (strpos($visitor["ip_address"], "185.60.133.162") === 0) 	$visitor["note"] = "RIPE Network Coordination Center";
						elseif (strpos($visitor["ip_address"], "185.48.236.101") === 0) 	$visitor["note"] = "RIPE Network Coordination Center";
						elseif (strpos($visitor["ip_address"], "90.156.218.30") === 0) 		$visitor["note"] = "Робот MasterHost";
						elseif (strpos($visitor["ip_address"], "65.52.228.") === 0) 		$visitor["note"] = "Microsoft Hosting";
						elseif (strpos($visitor["ip_address"], "31.177.83.") === 0) 		$visitor["note"] = "Система мониторинга распространённости веб-технологий";
						elseif (strpos($visitor["ip_address"], "85.174.214.") === 0) 		$visitor["note"] = "Branch of the Public Joint Stock Company";
						elseif (strpos($visitor["ip_address"], "79.137.223.57") === 0) 		$visitor["note"] = "Hosting and Colocation Services";
						elseif (strpos($visitor["ip_address"], "144.76.27.118") === 0) 		$visitor["note"] = "Робот MegaIndex.ru";
						elseif (strpos($visitor["ip_address"], "119.9.43.241") === 0) 		$visitor["note"] = "Сервис Redbot.org";
						elseif (strpos($visitor["ip_address"], "204.187.14.67") === 0) 		$visitor["note"] = "Сервис GTmetrix.com";
						
						if     (stripos($visitor["user_agent"], "HostTracker") !== false)	$visitor["note"] = "Робот Host-tracker.com";
						elseif (stripos($visitor["user_agent"], "majestic12") !== false)  	$visitor["note"] = "Робот Majestic12.co.uk";
						elseif (stripos($visitor["user_agent"], "bingbot") !== false)  		$visitor["note"] = "Робот Bing.com";
						elseif (stripos($visitor["user_agent"], "Yahoo!") !== false)  		$visitor["note"] = "Робот Yahoo.com";
						elseif (stripos($visitor["user_agent"], "AhrefsBot") !== false)  	$visitor["note"] = "Робот Ahrefs.com";
						elseif (stripos($visitor["user_agent"], "Mail.RU_Bot") !== false)  	$visitor["note"] = "Робот Mail.ru";
						elseif (stripos($visitor["user_agent"], "SputnikBot") !== false)  	$visitor["note"] = "Робот Sputnik.ru";
						elseif (stripos($visitor["user_agent"], "openstat.ru") !== false)  	$visitor["note"] = "Робот Openstat.ru";
						
						if ($visitor["note"] == "")
						{
							if (filter_var($visitor["ip_address"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false)
							{
								$org = file_get_contents("http://ipinfo.io/{$visitor["ip_address"]}/org");
								$org_arr = explode(" ", $org);
								$org_arr[0] = "";
								$visitor["note"] = implode(" ", $org_arr);
								
								// https://www.iplocation.net/ - post-запрос 5.5s 1.4mb
								
								//$org = file_get_contents("https://ipdb.at/ip/".$visitor["ip_address"]);
								
								// http://ipinfo.info/html/ip_checker.php - post-запрос
								
								// http://ipgeobase.ru/?address=62.183.127.138
								
								/*
								$org = file_get_contents("https://www.nic.ru/whois/?query=".$visitor["ip_address"]); // 4s 565kb
								$org = str_replace('&nbsp; ', '', $org);
								if (preg_match('#netname\:.*?\<br\>.*?descr\:(.*?)\<br\>#is', $org, $matches))
									$visitor["note"] = $matches[1];
								*/
							}
						}
						
						$visitor["date"] = format_mysql_date($visitor["last_date"], "d.m.y h:i");
						
						if (!empty($visitor["referrer"]))
						{
							$visitor["referrer"] = htmlspecialchars($visitor["referrer"]);
							$link_text = (strlen($visitor["referrer"]) > 120) ? substr($visitor["referrer"], 0, 120)."..." : $visitor["referrer"];
							$visitor["referrer"] = "<a class=\"driver\" href=\"{$visitor["referrer"]}\">$link_text</a>";
						}
						
						if (!empty($visitor["request"]))
						{
							$visitor["request"] = htmlspecialchars($visitor["request"]);
							$link_text = (strlen($visitor["request"]) > 120) ? substr($visitor["request"], 0, 120)."..." : $visitor["request"];
							$visitor["request"] = "<a class=\"driver\" href=\"{$visitor["request"]}\">$link_text</a>";
						}
						
						if (!empty($visitor["user_agent"]))
							$visitor["user_agent"] = htmlspecialchars($visitor["user_agent"]);
						
						$visitors[] = $visitor;
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка посетителей</span>";
			}
			else
				$message .= "<span class=\"error\">Страница №$page_number списка посетителей не существует</span>";
		}
		
		$smarty->assign("visitors", $visitors);
		$smarty->assign("paginator", $paginator);
		
		$smarty->assign("visitors_per_page",       $visitors_per_page);
		$smarty->assign("visitors_per_page_title", $visitors_per_page_title);
		$smarty->assign("visitors_per_page_hint",  $visitors_per_page_hint);
		
		$smarty->assign("enable_visitors_db",     $enable_visitors_db);
		$smarty->assign("enable_visitors_title",  $enable_visitors_title);
		$smarty->assign("enable_visitors_hint",   $enable_visitors_hint);
		
		$smarty->assign("minutes_visitor_online", $_SESSION["minutes_visitor_online"]);
		$smarty->assign("minutes_visitor_title",  $_SESSION["minutes_visitor_title"]);
		$smarty->assign("minutes_visitor_hint",   $_SESSION["minutes_visitor_hint"]);
	}
?>