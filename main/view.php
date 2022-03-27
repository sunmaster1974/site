<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################

if ( (isset($_GET["step"]) && ($_GET["step"] == "create_site")) || $is_refresh_site )
{
	$sql = "SELECT * FROM `templates` WHERE `id`=$template_id";
	$query_template = mysql_query($sql);
	if ($query_template && ($template = mysql_fetch_array($query_template)))
	{
		$sql = "SELECT * FROM `pages` WHERE `template_id`=$template_id ORDER BY `id`";
		$query_pages = mysql_query($sql);
		if ($query_pages && (mysql_num_rows($query_pages) > 0))
		{
			// Считываем настройки верификации
			$yandex_verification = "";
			$google_verification = "";
			
			$sql = "SELECT * FROM `settings` WHERE `type`=0 AND `value`<>''";
			$query_settings = mysql_query($sql);
			if ($query_settings)
			{
				while ($setting = mysql_fetch_array($query_settings))
				{
					$value = trim($setting["value"]);
					switch ($setting["name"])
					{
						case "yandex-verification": if (strpos($value, 'content="XXX"') === false) $yandex_verification = "\n\t$value"; break;
						case "google-verification": if (strpos($value, 'content="XXX"') === false) $google_verification = "\n\t$value"; break;
					}
				}
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе основных настроек сайта</span>";
			
			// Считываем настройки счётчиков
			$counters = "";
			$sql = "SELECT `value` FROM `settings` WHERE `type`=1 AND `value`<>''";
			$query_counters = mysql_query($sql);
			if ($query_counters)
			{
				while ($counter = mysql_fetch_array($query_counters))
					$counters .= "\n" . preg_replace("#^(.*?)$#ims", "\t$1", $counter["value"]) ."\n";
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе настроек для подключения счётчиков</span>";
			
			// Получение настройки, запоминать ли реферер посетителя в сессии или в базе данных
			$enable_visitors_db = 0;
			$sql = "SELECT `value` FROM `settings` WHERE `name`='enable_visitors_db'";
			$query_visitors = mysql_query($sql);
			if ($query_visitors && ($visitors = mysql_fetch_array($query_visitors)))
				$enable_visitors_db = $visitors["value"];
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе настройки для сохранения реферера</span>";
			
			if ($enable_visitors_db == 0)
				$page_session = '<?php require "'.ROOT.'/main/session.php"; ?>';
			else
				$page_session = '<?php require "'.ROOT.'/main/session_db.php"; ?>';
			
			$all_blocks = array();
			$template_path = str_replace(ROOT."/", "", $template_path);
			$css_file = "/" . str_replace(ROOT."/", "", $styles_path) . $index_css;
			
			$is_scrollable_pages_exist = false;
			if (file_exists($index_path."blocks.php")) unlink($index_path."blocks.php");
			$blocks_file = '<?php
	$blocks = array();
	$blocks_path = "'.ROOT.'/'.$template_path.'blocks/";
';
			// Цикл по всем страницам шаблона
			while ($page = mysql_fetch_array($query_pages))
			{
				$error = "";
				
				if ($page["visible"] == 1)
				{
					// Скрипты верификации выводятся только на главной странице
					if ($page["main"] == 0)
					{
						$yandex_verification = "";
						$google_verification = "";
					}
					
					$meta_description = "";
					if ($page["meta_description"] != "")
						$meta_description = "\t<meta name=\"description\" content=\"{$page["meta_description"]}\" />\n";
					
					$meta_keywords = "";
					if ($page["meta_keywords"] != "")
						$meta_keywords = "\t<meta name=\"keywords\" content=\"{$page["meta_keywords"]}\" />\n";
					
					$favicon = "";
					if ($page["favicon"] != "")
						$favicon = "\n\n\t<link type=\"image/x-icon\" href=\"$template_path{$page["favicon"]}\" rel=\"shortcut icon\" />\n\t<link type=\"image/x-icon\" href=\"$template_path{$page["favicon"]}\" rel=\"icon\" />";
					
					$page_head = "";
					if ($page["head"] != "")
						$page_head = "\n" . preg_replace("#^(.*?)$#ims", "\t$1", $page["head"]);
					
					// Получаем переменные страницы
					$variable_names  = array();
					$variable_values = array();
					$sql = "SELECT `name`, `value` FROM `variables` WHERE `page_id`=".$page["id"];
					if ($query_variables = mysql_query($sql))
					{
						while ($variable = mysql_fetch_array($query_variables))
						{
							$variable_names[]  = '/\$'.$variable["name"].'/';
							$variable_values[] = $variable["value"];
						}
					}
					else
						$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка переменных страницы «{$page["name"]}»</span>";
					
					$html = $page_session . $page["doctype"] . "\n";
					
					if (strcasecmp($page["doctype"], "<!doctype html>") == 0)
						$meta_charset = '<meta charset="utf-8" />';
					else
						$meta_charset = '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
					
					$html .= <<<EOB
<html lang="ru">
<head>
	$meta_charset
	<meta name="generator" content="WebWertex LandKit (Landing page constructor 1.0)" />\n
EOB;
					// Получение данных о формах из всех блоков
					$page_blocks_errors = ""; // Переменная $page_blocks_errors заполняется в функции get_page_blocks()
					array_splice($all_blocks, 0);
					$all_blocks = get_page_blocks($page["id"], $page["name"], true, true);
					
					$first_block_name = "header";
					if (count($all_blocks) > 0)
					{
						foreach ($all_blocks as $item)
						{
							$first_block_name = str_ireplace(".tpl", "", $item["file"]);
							break;
						}
					}
					
					if ($page["scrollable"] == 0)
						$html .= "$meta_description$meta_keywords\n\t<title>{$page["title"]}</title>\n";
					elseif ($page["scrollable"] == 1)
					{
						$is_scrollable_pages_exist = true;
						$html .= '
	<style type="text/css" media="all">
		html, body {
			height: 100%;
	}
	</style>
<?php
	require "blocks.php";
	
	$site = "http://' . $_SERVER["SERVER_NAME"] . '";
	
	$block_name = isset($_GET["block"]) ? $_GET["block"] : "'.$first_block_name.'";
	
	if ($blocks[$block_name]["meta_description"] != "")
		echo "\n\t<meta name=\"description\" content=\"{$blocks[$block_name]["meta_description"]}\" />\n";
	
	if ($blocks[$block_name]["meta_keywords"] != "")
		echo "\n\t<meta name=\"keywords\" content=\"{$blocks[$block_name]["meta_keywords"]}\" />\n";
	
	echo "\n\t<title>{$blocks[$block_name]["meta_title"]}</title>\n\n";
	
	if ($blocks[$block_name]["prev_data_url"] == "")
		echo "\t<link rel=\"canonical\" href=\"$site/items.php\" />\n";
	else
		echo "\t<link rel=\"prev\" href=\"$site/" . str_replace("item.php", "items.php", $blocks[$block_name]["prev_data_url"]) . "\" />\n";
	
	if ($blocks[$block_name]["next_data_url"] != "")
		echo "\t<link rel=\"next\" href=\"$site/" . str_replace("item.php", "items.php", $blocks[$block_name]["next_data_url"]) . "\" />\n";
?>';
					}
					
					$html .= <<<EOB
$favicon$yandex_verification$google_verification$page_head\n\n\t<link type="text/css" href="$css_file" rel="stylesheet" />\n\n
EOB;
					
					$seo_scripts    = "";
					$form_scripts   = "";
					$form_functions = "";
					$sendMessages   = "";
					$forms_css 		= "";
					$hide_forms		= "";
					
					$form_exists   = false;
					$phone_exists  = false;
					$file_exists   = false;
					
					if ($page_blocks_errors == "")
					{
						// Цикл по все блокам
						foreach ($all_blocks as $b => $block)
						{
							$all_blocks[$b]["script"] = "";
							
							if (strpos($block["block_code"], "user_contact") !== false)
							{
								if (preg_match_all('#\<div.*?id\=[\"\']div_contact(\d+)\-(\d+)[\"\'].*?\>\s*\<form.*?id\=[\"\']user_contact[\"\']#ims', $block["block_code"], $matches) > 0)
								{
									foreach ($matches[1] as $index => $id)
									{
										$counter = $matches[2][$index];
										$sql = "SELECT * FROM `forms` WHERE `id`=$id";
										$query_forms = mysql_query($sql);
										if ($query_forms && ($form = mysql_fetch_array($query_forms)))
										{
											if ($form["status"] == 1)
											{
												$form_exists = true;
												
												if (strpos($block["block_code"], "user_phone") !== false) $phone_exists = true;
												if (strpos($block["block_code"], "user_file")  !== false) $file_exists  = true;
												
												if (($form["css"] != "") && (strpos($forms_css, "/* Базовые правила формы №$id */") === false))
													$forms_css .= "\t\t/* Базовые правила формы №$id */\n" . preg_replace('#^(.*?)$#ims', "\t\t$1", $form["css"]) . "\n\t\t/* Окончание базовых правил формы №$id */\n\n";
												
												// Для SEO страницы код скриптов внести в файл blocks.php
												if ($page["scrollable"] == 1)
												{
													$all_blocks[$b]["script"] .= "sendMessage('#div_contact$id-$counter');";
													$all_blocks[$b]["script"] .= "$('input,textarea').placeholder();";
													
													if (strpos($block["block_code"], "user_phone") !== false)
														$all_blocks[$b]["script"] .= "$('.input_phone').mask('(999) 999-9999');";
												}
												
												$sendMessages .= "\n\t\t\tsendMessage(\"#div_contact$id-$counter\");";
											}
											
											if ($form["status"] == 0)
											{
												$hide_forms .= "\n\t\t\t$(\"#div_contact$id-$counter\").css(\"display\", \"none\");\n";
												if ($form["modal"] == 1)
													$hide_forms .= "\t\t\t$(\"a.modalbox[href='#div_contact$id-$counter']\").css(\"display\", \"none\");\n";
											}
										}
										else
											$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$id</span>";
									}
								}
							}
						}
						
						// Проверка секции body страницы на наличие форм
						if (strpos($page["body"], "user_contact") !== false)
						{
							if (preg_match_all('#\<div.*?id\=[\"\']div_contact(\d+)\-(\d+)[\"\'].*?\>\s*\<form.*?id\=[\"\']user_contact[\"\']#ims', $page["body"], $matches) > 0)
							{
								foreach ($matches[1] as $index => $id)
								{
									$counter = $matches[2][$index];
									$sql = "SELECT * FROM `forms` WHERE `id`=$id";
									$query_forms = mysql_query($sql);
									if ($query_forms && ($form = mysql_fetch_array($query_forms)))
									{
										if ($form["status"] == 1)
										{
											$form_exists = true;
											
											if (strpos($page["body"], "user_phone") !== false) $phone_exists = true;
											if (strpos($page["body"], "user_file")  !== false) $file_exists  = true;
											
											if (($form["css"] != "") && (strpos($forms_css, "/* Базовые правила формы №$id */") === false))
												$forms_css .= "\t\t/* Базовые правила формы №$id */\n" . preg_replace('#^(.*?)$#ims', "\t\t$1", $form["css"]) . "\n\t\t/* Окончание базовых правил формы №$id */\n\n";
											
											$sendMessages .= "\n\t\t\tsendMessage(\"#div_contact$id-$counter\");";
										}
										
										if ($form["status"] == 0)
										{
											$hide_forms .= "\n\t\t\t$(\"#div_contact$id-$counter\").css(\"display\", \"none\");\n";
											if ($form["modal"] == 1)
												$hide_forms .= "\t\t\t$(\"a.modalbox[href='#div_contact$id-$counter']\").css(\"display\", \"none\");\n";
										}
									}
									else
										$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$id</span>";
								}
							}
						}
					}
					else
						$error .= $page_blocks_errors;
					
					// Подключение скриптов				
					$script_jquery = "";
					$page_scripts = "";
					$page_scripts_styles = "";
					
					$sql = "SELECT `settings`.`name`, `settings`.`value` FROM `scripts` LEFT JOIN `settings` ON `scripts`.`script_id`=`settings`.`id` WHERE `scripts`.`page_id`={$page["id"]} AND `scripts`.`status`=1 AND TRIM(`settings`.`value`)<>''";
					$query_scripts = mysql_query($sql);
					if ($query_scripts)
					{
						while ($script = mysql_fetch_array($query_scripts))
						{
							$script_style = "";
							$script_text  = $script["value"];
							
							if (preg_match_all('#\<link.*?\>#ims', $script_text, $matches) > 0)
							{
								foreach ($matches[0] as $match)
								{
									$script_style .= "\t" . $match . "\n";
									$script_text = trim(str_replace($match, "", $script_text));
								}
							}
							
							$script_text = preg_replace("#^(.*?)$#ims", "\t$1", $script_text) . "\n";
							
							if (strpos(strtolower($script["name"]), "jquery") !== false)
							{
								$script_jquery = "\t" . $script["value"];
							}
							else
							{
								$page_scripts .= $script_text;
								$page_scripts_styles .= $script_style;
							}
						}
					}
					else
						$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе подключённых скриптов для страницы</span>";
					
					// Подключение скриптов для форм
					if ($form_exists)
					{
						$form_scripts .= <<<EOB
	<script type="text/javascript" src="scripts/placeholder.js"></script>
	<script type="text/javascript" src="scripts/sendmessage.js"></script>\n
EOB;
						if ($phone_exists) $form_scripts .= "\t<script type=\"text/javascript\" src=\"scripts/maskedinput.js\"></script>\n";
						if ($file_exists)  $form_scripts .= "\t<script type=\"text/javascript\" src=\"scripts/ajaxupload.js\"></script>\n";
						
						$form_functions .= "\n\t\t\t$(\"input,textarea\").placeholder();\n";
						if ($phone_exists) $form_functions .= "\t\t\t$(\".input_phone\").mask(\"(999) 999-9999\");\n";
						$form_functions .= $sendMessages;
						
						if ($forms_css != "")
							$forms_css = "\n\t<style type=\"text/css\">\n$forms_css\t</style>\n";
					}
					
					if ($page["scrollable"] == 1)
						$seo_scripts = <<<EOB
	<script type="text/javascript" src="scripts/seo.js"></script>
	<script type="text/javascript">initBlock();</script>\n
EOB;
					
					$html .= <<<EOB
$script_jquery

$page_scripts_styles$forms_css</head>
<body>\n
EOB;
					$html_before = "";
					$html_after  = "";					
					if (preg_match('#^(.*?)\<\!\-\- start_blocks \-\-\>.*?\<\!\-\- end_blocks \-\-\>(.*?)$#is', trim($page["body"]), $matches) == 1)
					{
						if (trim($matches[1]) != "")
							$html_before = trim($matches[1]) . "\n\n";
						if (trim($matches[2]) != "")
							$html_after  = trim($matches[2]) . "\n\n";
					}
					else
						$error .= "<span class=\"error\">В коде секции body страницы «{$page["name"]}» не найдены метки start_blocks и end_blocks</span>";
					
					// Выводим начало кода из секции body страницы
					$html .= $html_before;
					
					// Выводим код блоков
					if ($page_blocks_errors == "")
					{
						$blocks_count = count($all_blocks);
						
						foreach ($all_blocks as $index => $block)
						{
							if ($page["scrollable"] == 1)
							{
								$block_name = str_ireplace(".tpl", "", $block["file"]);
								
								if ($index == 0)
								{
									$prev = "";
									if ($blocks_count > 1)
										$next = "item.php?block=" . str_ireplace(".tpl", "", $all_blocks[$index + 1]["file"]);
									else
										$next = "";
								}
								elseif ((0 < $index) && ($index < $blocks_count - 1))
								{
									$prev = "item.php?block=" . str_ireplace(".tpl", "", $all_blocks[$index - 1]["file"]);
									$next = "item.php?block=" . str_ireplace(".tpl", "", $all_blocks[$index + 1]["file"]);
								}
								elseif ($index == $blocks_count - 1)
								{
									if ($blocks_count > 1)
										$prev = "item.php?block=" . str_ireplace(".tpl", "", $all_blocks[$index - 1]["file"]);
									else
										$prev = "";
									$next = "";
								}
								
								$blocks_file .=	'
	$blocks["'.$block_name.'"]["prev_data_url"]  	= "'.$prev.'";
	$blocks["'.$block_name.'"]["next_data_url"]  	= "'.$next.'";
	$blocks["'.$block_name.'"]["script"]  			= "'.$block["script"].'";
	$blocks["'.$block_name.'"]["meta_title"] 		= "'.$block["meta_title"].'";
	$blocks["'.$block_name.'"]["meta_description"]	= "'.$block["meta_description"].'";
	$blocks["'.$block_name.'"]["meta_keywords"]   	= "'.$block["meta_keywords"].'";' . "\n";
							}
							
							$block_code = $block["block_code"];
							if (strlen(trim($block_code)) == 0) $block_code = trim($block_code);
							
							if ($block_code != "")
							{
								// Заменяем строковые константы на их значения
								if (preg_match_all('#\{\$string\-([0-9]{1,10})\}#ims', $block_code, $matches) > 0)
								{
									foreach ($matches[1] as $id)
									{
										$sql = "SELECT * FROM `strings` WHERE `id`=$id";
										if ($query_string = mysql_query($sql))
										{
											if ($string = mysql_fetch_array($query_string))
												$block_code = str_replace('{$string-'.$id.'}', $string["content"], $block_code);
											else
												$error .= "<span class=\"error\">Строковая константа string-$id из блока «{$block["title"]}» не найдена</span>";
										}
										else
											$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе строковой константы string-$id из блока «{$block["title"]}»</span>";
									}
								}
								
								// Заменяем переменные страницы на их значения
								if (count($variable_names) > 0)
								{
									$block_code_replaced = preg_replace($variable_names, $variable_values, $block_code);
									if ($block_code_replaced !== null)
										$block_code = $block_code_replaced;
									else
										$error .= "<span class=\"error\">Произошла ".get_error(1)." при замене переменных страницы их значениями в блоке «{$block["title"]}»</span>";
								}
								
								// Проверка, есть ли в коде блока незаменённые переменные
								$count_preg = preg_match_all('#\$[a-z0-9\-\_]+#ims', $block_code, $matches);
								if ($count_preg > 0)
								{
									$list = array();
									for ($i = 0; $i < $count_preg; $i++)
										$list[] = $matches[0][$i];
									
									$error .= "<span class=\"error\">В блоке «{$block["title"]}» найдены незаменённые переменные: ".implode(",", $list)."</span>";
								}
								
								$text_file = ROOT."/".$template_path."blocks/" . str_ireplace("tpl", "txt", $block["file"]);
								// Если страница обычная, добавить код блока на страницу удалить текстовый вариант файла блока, если есть
								if ($page["scrollable"] == 0)
								{
									$html .= $block_code."\n\n";
									// Если с одной страницы на другую есть блок-ссылка и одна страница SEO, а другая нет,
									// то тогда будет удаляться нужный для страницы с SEO текстовый файл блока во время прохода страницы не SEO
									// if (file_exists($text_file)) unlink($text_file);
								}
								// Если страница SEO-оптимизированная, сохранить код блока в текстовый файл
								else
								{
									if (!file_put_contents($text_file, $block_code))
										$error .= "<span class=\"error\">Текстовый файл блока $text_file не создан из-за ".get_error(1)."</span>";
								}
							}
						}
						
						if ($page["scrollable"] == 1)
						{
							$html .= '
<div id="listitems">
<?php
	$json = file_get_contents("$site/item.php?block=$block_name");
	$arr = json_decode($json, true);
	echo "\t" . $arr["response"] . "\n";
?>
</div>
<script type="text/javascript">
	prev_data_url = "<?php echo $blocks[$block_name]["prev_data_url"]; ?>";
	next_data_url = "<?php echo $blocks[$block_name]["next_data_url"]; ?>";
	$.getJSON(prev_data_url, function(data) { prev_data_cache = data; });
	$.getJSON(next_data_url, function(data) { next_data_cache = data; });
</script>
';
						}
					}
					
					// Выводим окончание кода из секции body страницы
					$html .= $html_after;
					
					// Выводим все скрипты и счётчики в конце страницы
					$html .= "\n$page_scripts$form_scripts$seo_scripts$counters\n";
					
					// Если есть, выводим функции форм
					if ( ($form_functions != "") || ($hide_forms != "") )
					{
						$html .= <<<EOB
	<script type="text/javascript">
		$(document).ready(function() { $form_functions$hide_forms
		});
	</script>\n
EOB;
					}
					
					$html .= <<<EOB
</body>
</html>
EOB;
					// Создание файла страницы
					if (strpos($page["file"], "/") === false)
						$file_path = $index_path . $page["file"] . ".php"; // Файлы страниц в одной папке
					else
						$file_path = $page["file"]; // Файлы страниц в разных папках
					
					if (file_exists($file_path))
					{
						if (!$forbidden_full_rights)
						{
							$mod = substr(sprintf('%o', fileperms($file_path)), -4);
							if ($mod != "0777")
							{
								$path_parts = pathinfo($file_path);
								if (!chmod_file($path_parts["dirname"]."/", $path_parts["basename"]))
									$error .= "<span class=\"error\">Полные права доступа к файлу страницы «{$page["name"]}» не установлены из-за ".get_error(1)."</span>";
							}
						}
					}
					
					if ($error == "")
					{
						if (file_put_contents($file_path, $html) === false)
							$message .= "<span class=\"error\">Файл страницы «{$page["name"]}» не сохранён из-за ".get_error(1)."</span>";
					}
					else
					{
						$message .= $error;
						$message .= "<span class=\"error\">Файл страницы «{$page["name"]}» не создан из-за вышеперечисленных ошибок</span>";
					}
				} // if ($page["visible"] == 1)
				else
				{
					if ($page["delete_inactive"] == 1)
					{
						// Удаление файла страницы
						if (strpos($page["file"], "/") === false)
							$file_path = $index_path . $page["file"] . ".php"; // Файлы страниц в одной папке
						else
							$file_path = $page["file"]; // Файлы страниц в разных папках
						
						if (file_exists($file_path))
						{
							if (!unlink($file_path))
								$message .= "<span class=\"info\">Файл отключённой страницы «{$page["name"]}» не удалён из-за ".get_error(1)."</span>";
						}
					}
				}
			} // while ($page = mysql_fetch_array($query_pages))
			
			$error = "";
			
			if ($is_scrollable_pages_exist)
			{
				$blocks_file .= "?>";
				
				if (!file_put_contents($index_path."blocks.php", $blocks_file, FILE_APPEND))
					$error .= "<span class=\"error\">Вспомогательный файл blocks.php не сохранён из-за ".get_error(1)."</span>";			
			}
			
			// Создание результирующего файла стилей из файлов стилей шаблона и блоков для всех css медиа-запросов
			$full_style_text = "";
			$sql = "SELECT * FROM `layouts` WHERE `template_id`=$template_id ORDER BY `sort`";
			$query_layouts = mysql_query($sql);
			if ($query_layouts && (mysql_num_rows($query_layouts) > 0))
			{
				while ($layout = mysql_fetch_array($query_layouts))
				{
					if (strpos($layout["text"], "@media") !== false) $is_present_media = true;
						else $is_present_media = false;
					
					if (trim($layout["text"]) != "")
						$full_style_text .= rtrim($layout["text"]) . "\n";
					
					if ($is_present_media) $full_style_text .= "{\n";
					
					$file = $template_css . "-" . $layout["id"] . ".css";
					if (file_exists($styles_path.$file))
					{
						$text = file_get_contents($styles_path.$file);
						if ($text !== false)
							$full_style_text .= rtrim($text) . "\n";
						else
							$error .= "<span class=\"error\">Содержимое файла стилей шаблона $file не получено из-за ".get_error(1)."</span>";
					}
					else
						$error .= "<span class=\"error\">Файл стилей шаблона $file не найден</span>";
					
					$file = $blocks_css . "-" . $layout["id"] . ".css";
					if (file_exists($styles_path.$file))
					{
						$text = file_get_contents($styles_path.$file);
						if ($text !== false)
							$full_style_text .= rtrim($text) . "\n";
						else
							$error .= "<span class=\"error\">Содержимое файла стилей блоков $file не получено из-за ".get_error(1)."</span>";
					}
					else
						$error .= "<span class=\"error\">Файл стилей блоков $file не найден</span>";
						
					if ($is_present_media) $full_style_text .= "}\n";
					
					 $full_style_text .= "\n";
				}
				
				// Замена css-переменных на их значения
				$patterns = array();
				$replacements = array();
				$sql = "SELECT * FROM `styles` WHERE `value`<>''";
				$query_styles = mysql_query($sql);
				if ($query_styles)
				{
					while ($style = mysql_fetch_array($query_styles))
					{
						$patterns[] = '/\$'.$style["name"].'/';
						$replacements[] = $style["value"];
					}
				}
				else
					$error .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка css-переменных</span>";
				
				if (count($patterns) > 0)
				{
					$text_replaced = preg_replace($patterns, $replacements, $full_style_text);
					if ($text_replaced !== null)
						$full_style_text = $text_replaced;
					else
						$error .= "<span class=\"error\">Результирующий файл стилей не получен в результате замен css-переменных из-за ".get_error(1)."</span>";
				}
				
				// Проверка, есть ли в файле стилей незаменённые переменные
				$count_preg = preg_match_all('#\$[a-z0-9\-\_]+#ims', $full_style_text, $matches);
				if ($count_preg > 0)
				{
					$list = array();
					for ($i = 0; $i < $count_preg; $i++)
						$list[] = $matches[0][$i];
					
					$error .= "<span class=\"error\">В результирующем файле стилей найдены незаменённые css-переменные: ".implode(",", $list)."</span>";
				}
				
				if (file_exists($styles_path.$index_css))
				{
					if (!$forbidden_full_rights)
					{
						$mod = substr(sprintf('%o', fileperms($styles_path.$index_css)), -4);
						if ($mod != "0777")
						{
							if (!chmod_file($styles_path, $index_css))
								$error .= "<span class=\"error\">Полные права доступа к файлу стилей $index_css не установлены из-за ".get_error(1)."</span>";
						}
					}
				}
				
				if ($error == "")
				{
					if (file_put_contents($styles_path.$index_css, rtrim($full_style_text)) === false)
						$message .= "<span class=\"error\">Файл стилей $index_css не сохранён из-за ".get_error(1)."</span>";
				}
				else
				{
					$message .= $error;
					$message .= "<span class=\"error\">Файл стилей $index_css не создан из-за вышеперечисленных ошибок</span>";
				}
			}
			else
			{
				if ($query_layouts === false)
					$message .= "<span class=\"error\">Создание файла стилей невозможно,<br />так как произошла ".get_error(0)." при запросе списка css медиа-запросов шаблона «{$template[title]}»</span>";
				else
					$message .= "<span class=\"error\">Создание файла стилей невозможно,<br />так как у шаблона «{$template[title]}» отсутствуют css медиа-запросы</span>";
			}
		}
		else
		{
			if ($query_pages === false)
				$message .= "<span class=\"error\">Создание страниц сайта невозможно,<br />так как произошла ".get_error(0)." при запросе списка страниц шаблона «{$template["title"]}»</span>";
			else
				$message .= "<span class=\"error\">Создание страниц сайта невозможно,<br />так как у шаблона «{$template["title"]}» отсутствуют страницы</span>";
		}
	}
	else
	{
		if ($template_id != "")
			$message .= "<span class=\"error\">Создание сайта невозможно,<br />так как произошла ".get_error(0)." при запросе шаблона с id=$template_id</span>";
		else
			$message .= "<span class=\"error\">Создание сайта невозможно,<br />так как ни один шаблон не выбран</span>";
	}
}
?>