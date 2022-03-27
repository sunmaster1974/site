<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	function get_error($case)
	{
		global $sql, $log_id;
		
		$result = $case ? "ошибки" : "ошибка";
		
		// Ошибка работы с базой данных
		$err = mysql_error();
		if ($err != "")
		{
			mysql_query("INSERT INTO `logs`(`text`,`data`) VALUES ('<b>Error</b>: ".addslashes($err)."','<b>Sql</b>: ".addslashes($sql)."')");
			if (mysql_affected_rows() == 1)
			{
				$sql = "";
				$id = mysql_insert_id();
				$result = '<a class="error_link tooltip" href="index.php?page=journal&amp;view='.$id.'" title="Посмотреть расширенное описание ошибки">'.$result.'</a>';
			}
		}
		else
		// Ошибка работы с файлами
		{
			if (isset($log_id) && ($log_id != ""))
			{
				$result = '<a class="error_link tooltip" href="index.php?page=journal&amp;view='.$log_id.'" title="Посмотреть расширенное описание ошибки">'.$result.'</a>';
				$log_id = "";
			}
		}
		
		return $result;
	}
	
	function my_error_handler($code, $text, $file, $line)
	{
		global $log_id;
		
		switch ($code)
		{
			case E_USER_ERROR:   $code = "<b>Ошибка</b>: "; break;
			case E_USER_WARNING: $code = "<b>Предупреждение</b>: "; break;
			case E_USER_NOTICE:  $code = "<b>Сообщение</b>: "; break;
			default:             $code = "<b>Сообщение</b>: "; break;
		}
		
		$data = "<b>Файл</b>: $file<br />\n<b>Строка</b>: $line";
		$res = mysql_query("INSERT INTO `logs` (`text`, `data`) VALUES ('$code".addslashes($text)."', '".addslashes($data)."')");
		if ($res && (mysql_affected_rows() == 1))
			$log_id = mysql_insert_id();
		
		// Если функция возвращает false, управление передаётся встроенному обработчику ошибок PHP
		return true;
	}
	
	// Входящий формат даты. YYYY-MM-DD HH:MM:SS. Тип поле в MySQL - DATETIME
	function format_mysql_date($datetime, $style = "y.m.d h:i:s")
	{
        if (mb_strlen($datetime, "UTF-8") != 19) return $datetime;
		
        $ex = explode(" ", $datetime);
        $ex_date = explode("-", $ex[0]);
        $ex_time = explode(":", $ex[1]);
        if ((count($ex_date) == 3) && (count($ex_time) == 3))
		{
            $text_month = "";
            switch ($ex_date[1]) 
			{
                case 1:  $text_month = "января"; 	break;
                case 2:  $text_month = "февраля"; 	break;
                case 3:  $text_month = "марта"; 	break;
                case 4:  $text_month = "апреля"; 	break;
                case 5:  $text_month = "мая"; 		break;
                case 6:  $text_month = "июня"; 		break;
                case 7:  $text_month = "июля"; 		break;
                case 8:  $text_month = "августа"; 	break;
                case 9:  $text_month = "сентября"; 	break;
                case 10: $text_month = "октября"; 	break;
                case 11: $text_month = "ноября"; 	break;
                case 12: $text_month = "декабря"; 	break;
            }
            $style = str_replace("y", $ex_date[0], $style);
            $style = str_replace("m", $ex_date[1], $style);
            $style = str_replace("d", $ex_date[2], $style);
            $style = str_replace("f", $text_month, $style);
            $style = str_replace("h", $ex_time[0], $style);
            $style = str_replace("i", $ex_time[1], $style);
            $style = str_replace("s", $ex_time[2], $style);
			
            return $style;
        }
		
		return $datetime;
	}
	
	function translit_name($str)
	{
		$rus = array("а","б","в","г","д","е","ё" ,"ж" ,"з","ы","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц", "ч", "ш", "щ",  "ъ","ь","э","ю" ,"я");
		$lat = array("a","b","v","g","d","e","yo","zh","z","y","i","y","k","l","m","n","o","p","r","s","t","u","f","h","ts","ch","sh","sch","" ,"" ,"e","yu","ya");
		
		$result = mb_strtolower(html_entity_decode($str, ENT_QUOTES), "utf-8");
		$result = preg_replace("/[^0-9a-z]/", "-", str_replace($rus, $lat, $result));
		$result = str_replace('--', '-', $result);
		
		return $result;
	}
	
	function list_file($dir, $with_ext = true, $ext_include = "", $ext_exclude = "")
	{
		$files = array();
		
		$nDir = @opendir($dir);
		if ($nDir !== false)
		{
			while (($file = readdir($nDir)) !== false)
			{
				if ( ($file != ".") && ($file != "..") )
				{
					if (!is_dir($dir.$file))
					{
						$is_right = true;
						$parts = pathinfo($file);
						
						if ( ($ext_include != "") && (strcasecmp($parts["extension"], $ext_include) != 0) ) $is_right = false;
						if ( ($ext_exclude != "") && (strcasecmp($parts["extension"], $ext_exclude) == 0) ) $is_right = false;
						
						if ($is_right)
						{
							if ($with_ext)
								$files[] = $file;
							else
								$files[] = $parts["filename"];
						}
					}
				}
			}
			closedir($nDir);
			sort($files);
		}
		
		return $files;
	}
	
	function list_dir($root)
	{
		$dirs = array();
		$nRoot = @opendir($root);
		if ($nRoot !== false)
		{
			while (($dir = readdir($nRoot)) !== false)
			{
				if (($dir != ".") && ($dir != ".."))
				{
					if (is_dir($root . $dir))
					{
						 $dirs[] = $dir;
					}
				}
			}			
			closedir($nRoot);
			sort($dirs);
		}
		
		return $dirs;
	}
	
	function remove_dir($dir)
	{
		$result = true;
		if ($objects = glob($dir."/*"))
		{
			foreach ($objects as $object)
			{
				if (is_dir($object))
					remove_dir($object);
				else
					if (!unlink($object)) $result = false;
			}
		}
		if (!rmdir($dir)) $result = false;
		return $result;
	}
	
	function create_dir($dir, $name)
	{
		global $ftp_vars;
		
		$result = "";
		
		if (@mkdir(ROOT.$dir.$name) === false)
		{
			$conn_id = ftp_connect($ftp_vars["ftp_server"]);
			if ($conn_id !== false)
			{
				if (ftp_login($conn_id, $ftp_vars["ftp_user"], $ftp_vars["ftp_pass"]))
				{
					$is_success = false;
					
					ftp_pasv($conn_id, true); // пассивный режим включен
					if (ftp_chdir($conn_id, $ftp_vars["ftp_folder"].$dir))
					{
						if (ftp_mkdir($conn_id, $name))
							$is_success = true;
					}
					
					if ($is_success === false)
					{
						ftp_pasv($conn_id, false); // пассивный режим выключен
						if (ftp_chdir($conn_id, $ftp_vars["ftp_folder"].$dir))
						{
							if (ftp_mkdir($conn_id, $name))
								$is_success = true;
							else
								$result .= "<span class=\"error\">Каталог не создан из-за ".get_error(1)." создания каталога на ftp-сервере</span>";
						}
						else
							$result .= "<span class=\"error\">Каталог не создан из-за ".get_error(1)." смены директории на ftp-сервере</span>";
					}
					
					if ($is_success)
					{
						$result .= "<span class=\"success\">Каталог «{$name}» успешно создан</span>";
						
						if (ftp_chmod($conn_id, 0777, $name) === false)
							$result .= "<span class=\"info\">Полные права доступа к каталогу «{$name}» не установлены из-за ".get_error(1)."</span>";
					}
				}
				else
					$result .= "<span class=\"error\">Каталог не создан из-за ".get_error(1)." входа на ftp-сервер</span>";
					
				ftp_close($conn_id);
			}
			else
				$result .= "<span class=\"error\">Каталог не создан из-за ".get_error(1)." соединения с ftp-сервером</span>";
		}
		else
			$result .= "<span class=\"success\">Каталог «{$name}» успешно создан</span>";
		
		return $result;
	}
	
	function chmod_ftp($dir, $file, $is_server)
	{
		global $ftp_vars, $server_ftp_vars, $message;
		
		$vars = array();
		if ($is_server)
		{
			$ftp_server = $server_ftp_vars["server_ftp_server"];
			$ftp_user   = $server_ftp_vars["server_ftp_user"];
			$ftp_pass   = $server_ftp_vars["server_ftp_pass"];
			$ftp_folder = $server_ftp_vars["server_ftp_folder"];
		}
		else
		{
			$ftp_server = $ftp_vars["ftp_server"];
			$ftp_user   = $ftp_vars["ftp_user"];
			$ftp_pass   = $ftp_vars["ftp_pass"];
			$ftp_folder = $ftp_vars["ftp_folder"];
		}
		
		$result = false;
		
		$conn_id = ftp_connect($ftp_server);
		if ($conn_id !== false)
		{
			if (ftp_login($conn_id, $ftp_user, $ftp_pass))
			{
				ftp_pasv($conn_id, true); // пассивный режим включен
				if (ftp_chmod($conn_id, 0777, $ftp_folder.$dir.$file) !== false)
					$result = true;
				
				if ($result === false)
				{
					ftp_pasv($conn_id, false); // пассивный режим выключен
					if (ftp_chmod($conn_id, 0777, $ftp_folder.$dir.$file) !== false)
						$result = true;
					else
						$message .= "<span class=\"error\">Полные права доступа к файлу $file не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
				}
			}
			else
				$message .= "<span class=\"error\">Полные права доступа к файлу $file не установлены из-за ".get_error(1)." входа на ftp-сервер</span>";
			ftp_close($conn_id);
		}
		else
			$message .= "<span class=\"error\">Полные права доступа к файлу $file не установлены из-за ".get_error(1)." соединения с ftp-сервером</span>";
		
		return $result;
	}
	
	// обычный chmod не работает, так как ftp-пользователь не имеет права менять права на файл, созданный php-пользователем
	function chmod_file($path, $file)
	{
		$result = false;
		
		$dir = str_replace(ROOT, "", $path);
		
		// Проверяем права
		$mod = substr(sprintf('%o', fileperms($path.$file)), -4);
		if ($mod != "0777")
		{
			if (@chmod($path.$file, 0777)) // Меняем права для php-пользователя
				$result = true;
			else
				$result = chmod_ftp($dir, $file, false); // Меняем права для ftp-пользователя
		}
		else
			$result = true;
		
		return $result;
	}
	
	function check_names($template_id, $page_id, $blocks_path, $new_block_title, $new_block_file, $check_title, $check_file)
	{
		global $sql;
		
		$result = "";
		
		$prototype = ($template_id == 0) ? "-прототип" : "";
		
		if (($new_block_title != "") && ($new_block_file != ""))
		{
			if (preg_match("#^[a-zа-яё0-9\-\(\)\,\.\s]+$#imsu", $new_block_title) == 1)
			{
				if (preg_match("#^[a-z0-9\_\-]+$#ims", $new_block_file) == 1)
				{
					if ($check_title)
					{
						$sql = "SELECT COUNT(`id`) FROM `blocks` WHERE `page_id`=$page_id AND `title`='$new_block_title'";
						if ( ($query_title = mysql_query($sql)) && ($row_title = mysql_fetch_row($query_title)) )
						{
							if (intval($row_title[0]) > 0)
								$result .= "<span class=\"error\">Блок{$prototype} с названием «{$new_block_title}» уже существует</span>";
						}
						else
							$result .= "<span class=\"error\">Произошла ".get_error(0)." при запросе на уникальность названия блок{$prototype}ов</span>";
					}
					
					if ($check_file)
					{
						$blocks_files = list_file($blocks_path, false, "tpl", "");					
						if (in_array($new_block_file, $blocks_files))
							$result .= "<span class=\"error\">Файл с названием {$new_block_file}.tpl уже существует</span>";
					}
				}
				else
					$result .= "<span class=\"error\">Имя файла может состоять только из латинских букв, цифр, тире и знака подчёркивания</span>";
			}
			else
				$result .= "<span class=\"error\">Название блок{$prototype}а может состоять только из латинских или русских букв, цифр, тире, запятой, точки и скобок</span>";
		}
		else
			$result .= "<span class=\"error\">Название блок{$prototype}а и имя файла не должны быть пустыми</span>";
		
		return $result;
	}
	
	function mb_ucfirst($text)
	{
		return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
	}
	
function create_field($field)
{
	if (isset($_POST[$field."_yes"]))
	{
		global $form_code, $form_css, $is_bootstrap;
		
		$title 			  = trim($_POST[$field."_title"]);  
		$input_class   	  = trim($_POST[$field."_input_class"]);
		$phone_class   	  = ($field == "phone") ? " input_phone" : "";
		$required_class	  = isset($_POST[$field."_required"]) ? " required" : "";		
		
		$attr_class 	  = ($input_class != "") || ($phone_class != "") || ($required_class != "") ? "class=\"$input_class$phone_class$required_class\" " : "";
		$attr_required 	  = isset($_POST[$field."_required"]) ? "title=\"Обязательное поле\" " : "";
		$attr_placeholder = !isset($_POST[$field."_show"]) ? "placeholder=\"$title\" " : "";
		
		$label_class   	  = trim($_POST[$field."_label_class"]);
		$attr_label_class = ($label_class != "") ? " class=\"$label_class\"" : "";
		
		if ($is_bootstrap)
			$form_code .= "\t<div class=\"form-group\">\n";
		
		if ( ($is_bootstrap || isset($_POST[$field."_show"])) && ($title != "") ) 
			$form_code .= "\t<label for=\"user_$field\"$attr_label_class>$title</label>\n";
		
		// Добавить css-правила для классов input и label
		if (!$is_bootstrap)
		{
			if (($input_class != "") && (strpos($form_css, $input_class) === false))
				$form_css .= "\t.$input_class {\n\t}\n";
			
			if (($label_class != "") && (strpos($form_css, $label_class) === false))
				$form_css .= "\t.$label_class {\n\t}\n";
		}
		
		if ($field == "file")
		{
			$file_size = preg_replace('#\D#ims', '', $_POST["file_size"]);
			if ($file_size == "") $file_size = 5;
			$attr_title = "title=\"Возможно загрузить только файл размером не больше $file_size мб\"";
			
			$script_text = "";
			
			$button_class = trim($_POST["button_class"]);
			$attr_buttons_class = ($button_class != "") ? " class=\"$button_class\"" : "";
			
			$file_types = str_replace(" ", "", $_POST["file_type"]);
			if ($file_types != "")
			{
				$arr_file_types = explode(",", $file_types);
				$files_exts = implode("|", $arr_file_types);
				
				$script_text = "if (!(ext && /^($files_exts)$/.test(ext))) {
				alert(\"Возможно загрузить только файл с расширением из списка: $file_types\");
				return false;
			}";
				$attr_title = "title=\"Возможно загрузить только файл с расширениями из списка: $file_types и размером не больше $file_size мб\"";
			}
			
			if (!$is_bootstrap && ($button_class != "") && (strpos($form_css, $button_class) === false))
				$form_css .= "\t.$button_class {\n\t}\n";
			
			$form_code .= "\t<input type=\"text\" id=\"user_file\" name=\"user_file\" value=\"\" readonly=\"readonly\" $attr_class$attr_required$attr_placeholder/> \n";
			
			if ($is_bootstrap)
			{
				$form_code .= "\t<button type=\"button\" id=\"upload_file\" name=\"upload_file\"$attr_buttons_class $attr_title>Загрузить</button> \n\t<button type=\"button\" id=\"clear_file\" name=\"clear_file\"$attr_buttons_class onclick=\"clearFile();\">Очистить</button>\n\t</div>\n\n";
			}
			else
			{
				$form_code .= "\t<input type=\"button\" id=\"upload_file\" name=\"upload_file\"$attr_buttons_class $attr_title value=\"Загрузить\" /> \n\t<input type=\"button\" id=\"clear_file\" name=\"clear_file\"$attr_buttons_class value=\"Очистить\" onclick=\"clearFile();\" />\n<br />\n";
			}
			
			$form_code .= <<<EOB
<script type="text/javascript">
	function clearFile() {
		$("#div_contact #user_file").val("");
	}
	$(document).ready(function() {
		var btnUpload = $("#div_contact #upload_file");
		var txtFile   = $("#div_contact #user_file");
		new AjaxUpload(btnUpload, {
			action: "scripts/fileupload.php?size=$file_size",
			name: "uploadfile",
			onSubmit: function(file, ext) {
				$script_text
				txtFile.val("<идёт загрузка...>");
			},
			onComplete: function(file, response) {
				if (response === "success") {
					txtFile.val(file);
				} else {
					txtFile.val(response);
				}
			}
		});
	});
</script>\n\n
EOB;
		}
		elseif ($field == "message")
		{
			$form_code .= "\t<textarea id=\"user_message\" name=\"user_message\" rows=\"5\" $attr_class$attr_required$attr_placeholder></textarea>\n";
			
			if ($is_bootstrap)
				$form_code .= "\t</div>\n\n";
			else
				$form_code .= "<br />\n";
		}
		elseif ($field == "download")
		{
			$checkbox_mail = "<input type=\"checkbox\" name=\"user_permail\" id=\"user_permail\" onclick=\"if (this.checked) this.value='on'; else this.value='';\" value=\"\" $attr_class$attr_required/>";
			$checkbox_link = "<input type=\"checkbox\" name=\"user_download\" id=\"user_download\" onclick=\"if (this.checked) this.value='on'; else this.value='';\" value=\"\" $attr_class$attr_required/>";
			
			if ($is_bootstrap)
			{
				$form_code .= <<<EOB
	<div class="checkbox">
		<label>$checkbox_mail {$_POST["download_mail"]}</label>
	</div>
	<div class="checkbox">
		<label>$checkbox_link {$_POST["download_link"]}</label>
	</div>
	<input type="hidden" name="download_file" id="download_file" value="{$_POST["download_file"]}" />
	</div>\n\n
EOB;
			}
			else
			{
				$form_code .= <<<EOB
	$checkbox_mail {$_POST["download_mail"]}<br />
	$checkbox_link {$_POST["download_link"]}<br />
	<input type="hidden" name="download_file" id="download_file" value="{$_POST["download_file"]}" />\n
EOB;
			}	
		}
		else
		{
			$form_code .= "\t<input type=\"text\" id=\"user_$field\" name=\"user_$field\" $attr_class$attr_required$attr_placeholder/>\n";
			
			if ($is_bootstrap)
				$form_code .= "\t</div>\n\n";
			else
				$form_code .= "<br />\n";
		}
	}
}

	// Переименовать строковые константы, в которых указан переименованный файл
	function rename_strings($old_path, $new_path, $is_file)
	{
		global $sql, $message, $count_strings;
		
		$file_name = "";
		$content = str_replace(ROOT, "", $old_path);
		if (!$is_file) $content .= "/";
		
		if ($is_file)
		{
			$word = "с файлом " . basename($old_path);
			$where = "WHERE `content`='$content'";
		}
		else
		{
			$word = "с папкой " . $old_path;
			$where = "WHERE `content` LIKE '%$content%'";
		}
		
		$sql = "SELECT `id`,`content` FROM `strings` $where";
		$query_strings = mysql_query($sql);
		if ($query_strings)
		{
			while ($string = mysql_fetch_array($query_strings))
			{
				if (!$is_file) $file_name = "/" . basename($string["content"]);
				
				$new_content = str_replace(ROOT, "", $new_path) . $file_name;
				$sql = "UPDATE `strings` SET `content`='$new_content' WHERE `id`={$string["id"]}";
				mysql_query($sql);
				if (mysql_affected_rows() == 1)
					$count_strings++;
				else
					$message .= "<span class=\"error\">Строковая константа string-{$string["id"]} $word не изменена из-за ".get_error(1)."</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка строковых констант, содержащих имена перемещаемых файла или папки</span>";
	}

	function get_blocks_strings($template_id, $path)
	{
		global $blocks_path, $sql, $message;
		
		$blocks_titles = "";
		
		$content = str_replace(ROOT, "", $path);
		
		$sql = "SELECT `id` FROM `strings` WHERE `content`='$content'";
		$query_strings = mysql_query($sql);
		if ($query_strings)
		{
			while ($string = mysql_fetch_array($query_strings))
			{
				$sql = "SELECT `title`, `file` FROM `blocks` WHERE `template_id`=$template_id";
				$query_blocks = mysql_query($sql);
				if ($query_blocks)
				{
					while ($block = mysql_fetch_array($query_blocks))
					{
						if (file_exists($blocks_path.$block["file"]))
						{
							$text = file_get_contents($blocks_path.$block["file"]);
							if ($text !== false)
							{
								if (strpos($text, '{$string-' . $string["id"] . '}') !== false)
								{
									if ($blocks_titles == "")
										$blocks_titles .= $block["title"];
									else
										$blocks_titles .= ", " . $block["title"];
								}
							}
						}
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков, содержащих строковые константы с именем удаляемого изображения</span>";
			}			
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка строковых констант, содержащих имя удаляемого изображения</span>";
		
		return $blocks_titles;
	}
	
	function get_dir_strings($dir)
	{
		$blocks_titles = "";
		
		if ($objects = glob($dir."/*"))
		{
			foreach ($objects as $object)
			{
				if (is_dir($object))
					remove_dir($object);
				else
				{
					$new_titles = get_blocks_strings($object);
					if ($blocks_titles == "")
						$blocks_titles .= $new_titles;
					else
						$blocks_titles .= "," . $new_titles;
				}
			}
		}
		
		if ($blocks_titles != "")
		{
			$titles = explode(",", $blocks_titles);
			$unique_titles = array_unique($titles);
			$blocks_titles = implode(", ", $unique_titles);
		}
		
		return $blocks_titles;
	}
	
	function generate_text_styles()
	{
		global $_POST;
		
		$css = "";
		
		// Цвет фона
		if (!isset($_POST["no_color_dominante"]))
		{
			if ($_POST["o_color_dominante"] == "1")
				$css .= "#example { background-color: #".$_POST["color_dominante"]."; }\n";
			else
			{
				$iOpacity = (float)$_POST["o_color_dominante"];
				$iOpacity = $iOpacity*100;
				$red   = hexdec(substr($_POST["color_dominante"],0,2));
				$green = hexdec(substr($_POST["color_dominante"],2,2));
				$blue  = hexdec(substr($_POST["color_dominante"],4,2));
				$css .= "#example { background-color: rgb($red,$green,$blue); filter: alpha(Opacity=$iOpacity); }\n"; // For IE
				$css .= "#example { background-color: rgba($red,$green,$blue,{$_POST["o_color_dominante"]}); }\n";
			}
		}
		else
			$css .= "#example { background-color: white; }\n";
		
		if ($_POST["back_image"] != "no")
			$css .= "#example { background-image: url({$_POST["back_image"]}); background-repeat: {$_POST["back_repeat"]}; }\n";
		
		if (isset($_POST["back_fixed"]))
			$css .= "#example { background-attachment: {$_POST["back_fixed"]}; }\n";
		
		// Настройки текста
		$css .= "#example { font-family: {$_POST["text_font_family"]}; font-size: {$_POST["text_font_size"]}; color: #{$_POST["color_txt"]}; text-align: {$_POST["align_text"]}; }\n";
		if (isset($_POST["bold_text"]))
			$css .= "#example { font-weight: {$_POST["bold_text"]}; }\n";
		if (isset($_POST["italic_text"]))
			$css .= "#example { font-style: {$_POST["italic_text"]}; }\n";
		if (isset($_POST["underline_text"]))
			$css .= "#example { text-decoration: {$_POST["underline_text"]}; }\n";
			
		if (!isset($_POST["text_shadow_no"]))
		{
			if (isset($_POST["text_shadow"]) && ($_POST["text_shadow"] != "")) 
				$shadowColor = "#".$_POST["text_shadow"];
			else 
				$shadowColor = "#666";
			if (isset($_POST["text_shadow_shiftx"]) && ($_POST["text_shadow_shiftx"] != ""))
				$shiftX = $_POST["text_shadow_shiftx"];
			else
				$shiftX = "2px";
			if (isset($_POST["text_shadow_shifty"]) && ($_POST["text_shadow_shifty"] != ""))
				$shiftY = $_POST["text_shadow_shifty"];
			else
				$shiftY = "2px";
			if (isset($_POST["text_shadow_blur"]) && ($_POST["text_shadow_blur"] != ""))
				$blur = $_POST["text_shadow_blur"];
			else
				$blur = "0px";
				 
			$css .= "#example { text-shadow: $shiftX $shiftY $blur $shadowColor; }\n";
		}
		
		// Настройки заголовков
		$css .= ".titles { font-family: {$_POST["title_font_family"]}; font-size: {$_POST["title_font_size"]}; color: #{$_POST["color_titres"]}; text-align: {$_POST["align_titres"]}; }\n";
		if (isset($_POST["bold_titres"]))
			$css .= ".titles { font-weight: {$_POST["bold_titres"]}; }\n";
		if (isset($_POST["italic_titres"]))
			$css .= ".titles { font-style: {$_POST["italic_titres"]}; }\n";
		if (isset($_POST["underline_titres"]))
			$css .= ".titles { text-decoration: {$_POST["underline_titres"]}; }\n";
		
		$css .= ".titles { padding: {$_POST["paddingTop_titres"]} {$_POST["paddingRight_titres"]} {$_POST["paddingBottom_titres"]} {$_POST["paddingLeft_titres"]}; }\n";

		if (!isset($_POST["title_shadow_no"]))
		{
			if (isset($_POST["title_shadow"]) && ($_POST["title_shadow"] != ""))
				$shadowColor = "#".$_POST["title_shadow"];
			else 
				$shadowColor = "#666";
			if (isset($_POST["title_shadow_shiftx"]) && ($_POST["title_shadow_shiftx"] != ""))
				$shiftX = $_POST["title_shadow_shiftx"];
			else
				$shiftX = "2px";
			if (isset($_POST["title_shadow_shifty"]) && ($_POST["title_shadow_shifty"] != ""))
				$shiftY = $_POST["title_shadow_shifty"];
			else
				$shiftY = "2px";
			if (isset($_POST["title_shadow_blur"]) && ($_POST["title_shadow_blur"] != ""))
				$blur = $_POST["title_shadow_blur"];
			else
				$blur = "0px";
				 
			$css .= ".titles { text-shadow: $shiftX $shiftY $blur $shadowColor; }\n";
		}
		
		// Ссылки в тексте обычные
		$css .= ".links { color: #{$_POST["color_link"]}; }\n";
		if (isset($_POST["bold_link"]))
			$css .= ".links { font-weight: {$_POST["bold_link"]}; }\n";
		if (isset($_POST["italic_link"]))
			$css .= ".links { font-style: {$_POST["italic_link"]}; }\n";
		
		if ($_POST["under_link"] == "none")
			$css .= ".links { text-decoration: none; }\n";
		elseif ($_POST["under_link"] == "normal")
			$css .= ".links { text-decoration: underline; }\n";
		else
			$css .= ".links { text-decoration: none; border-bottom: {$_POST["width_underlink"]} {$_POST["under_link"]} #{$_POST["color_underlink"]}; }\n";
		
		if (!isset($_POST["bgcolor_link_no"]))
			$css .= ".links { background-color: #{$_POST["bgcolor_link"]}; }\n";
		
		// Ссылки в тексте наведённые
		$css .= ".links:hover { color: #{$_POST["color_hoverlink"]}; }\n";
		if (isset($_POST["bold_hoverlink"]))
			$css .= ".links:hover { font-weight: {$_POST["bold_hoverlink"]}; }\n";
		if (isset($_POST["italic_hoverlink"]))
			$css .= ".links:hover { font-style: {$_POST["italic_hoverlink"]}; }\n";
		
		if ($_POST["under_hoverlink"] == "none")
			$css .= ".links:hover { text-decoration: none; }\n";
		elseif ($_POST["under_hoverlink"] == "normal")
			$css .= ".links:hover { text-decoration: underline; }\n";
		else
			$css .= ".links:hover { text-decoration: none; border-bottom: {$_POST["width_underhoverlink"]} {$_POST["under_hoverlink"]} #{$_POST["color_underhoverlink"]}; }\n";
		
		if (!isset($_POST["bgcolor_hoverlink_no"]))
			$css .= ".links:hover { background-color: #{$_POST["bgcolor_hoverlink"]}; }\n";
			
		return $css;
	}
		
	function sorting_function($object1, $object2) {
		if ($object1["sort"] == $object2["sort"]) {
			return 0;
		}
		return ($object1["sort"] < $object2["sort"]) ? -1 : 1;
	}
	
	function add_style($template_id)
	{
		global $_GET, $sql, $message;
		
		if (!empty($_GET["name"]))
		{
			$style_name = $_GET["name"];
				
			if (preg_match("#^[a-z0-9\_\-]+$#ims", $style_name) == 1)
			{
				$sql = "SELECT COUNT(*) FROM `styles` WHERE `name`='$style_name' AND `template_id`=$template_id";
				$query_count = mysql_query($sql);
				if ($query_count && ($row_count = mysql_fetch_row($query_count)))
				{
					if (intval($row_count[0]) == 0)
					{
						$sql = "INSERT INTO `styles`(`template_id`, `name`) VALUES ($template_id, '$style_name')";
						$res = mysql_query($sql);
						if ($res && (mysql_affected_rows() == 1))
							$message .= "<span class=\"success\">Новая css-переменная \${$style_name} успешно добавлена</span>";
						else
							$message .= "<span class=\"error\">Новая css-переменная \${$style_name} не добавлена из-за ".get_error(1)."</span>";
					}
					else
						$message .= "<span class=\"error\">Css-переменная с названием $style_name уже существует</span>";
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества css-переменных</span>";
			}
			else
				$message .= "<span class=\"error\">Название css-переменной может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
		}
		else
			$message .= "<span class=\"error\">Отсутствует название css-переменной</span>";
	}
	
	function delete_style()
	{
		global $_POST, $layouts, $sql, $message;
		
		foreach ($_POST as $style_id => $style_name) // [style-12] => shade_color 
		{
			if (preg_match('#^style\-\d+$#ims', $style_id) == 1)
			{
				$style_id = preg_replace("#\D#ims", "", $style_id);
				
				// Удаляем css-переменную, которая отмечена: onclick="if (this.checked) this.value='shade_color'; else this.value='';"
				if ($style_name != "")
				{
					$is_style_present = false;
					
					foreach ($layouts as $layout)
					{
						if (strpos($layout["template_csstext"], "\$$style_name") !== false)
						{
							$is_style_present = true;
							$message .= "<span class=\"error\">Css-переменная \${$style_name} не удалена,<br />так как она присутствует в тексте css медиа-запроса «{$layout["title"]}» шаблона</span>";
						}
						
						if (strpos($layout["blocks_csstext"], "\$$style_name") !== false)
						{
							$is_style_present = true;
							$message .= "<span class=\"error\">Css-переменная \${$style_name} не удалена,<br />так как она присутствует в тексте css медиа-запроса «{$layout["title"]}» блоков</span>";
						}
					}
					
					if (!$is_style_present)
					{
						$sql = "DELETE FROM `styles` WHERE `id`=$style_id";
						mysql_query($sql);
						if (mysql_affected_rows() == 1)
							$message .= "<span class=\"success\">Css-переменная \${$style_name} успешно удалена</span>";
						else
							$message .= "<span class=\"error\">Css-переменная \${$style_name} не удалена из-за ".get_error(1)."</span>";
					}
				}
			}
		}
	}
	
	function save_styles()
	{
		global $_POST, $sql, $message;
		
		foreach ($_POST as $style_id => $style_value)
		{
			if (preg_match('#^style\-\d+$#ims', $style_id) == 1)
			{
				$style_id = preg_replace("#\D#ims", "", $style_id);
				$style_value = trim($style_value);
				
				$sql = "SELECT * FROM `styles` WHERE `id`=$style_id";
				$query_style = mysql_query($sql);
				if ($query_style && ($style = mysql_fetch_array($query_style)))
				{
					if ($style["value"] != $style_value)
					{
						$sql = "UPDATE `styles` SET `value`='".addslashes($style_value)."' WHERE `id`=$style_id";
						mysql_query($sql);
						if (mysql_affected_rows() == 1)
							$message .= "<span class=\"success\">Css-переменная \${$style["name"]} успешно изменена</span>";
						else
							$message .= "<span class=\"error\">Css-переменная \${$style["name"]} не изменена из-за ".get_error(1)."</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе css-переменной с id=$style_id</span>";
			}
		}
	}
	
	function add_variable($page_id)
	{
		global $_GET, $sql, $message;
		
		if (!empty($_GET["name"]))
		{
			$variable_name = $_GET["name"];
			
			if (preg_match("#^[a-z0-9\_\-]+$#ims", $variable_name) == 1)
			{
				if (strpos($variable_name, "string") === false)
				{
					$sql = "SELECT COUNT(*) FROM `variables` WHERE `name`='$variable_name' AND `page_id`=$page_id";
					$query_count = mysql_query($sql);
					if ($query_count && ($row_count = mysql_fetch_row($query_count)))
					{
						if (intval($row_count[0]) == 0)
						{
							$sql = "INSERT INTO `variables` (`page_id`, `name`) VALUES ($page_id, '$variable_name')";
							if (mysql_query($sql) && (mysql_affected_rows() == 1))
								$message .= "<span class=\"success\">Новая переменная \${$variable_name} успешно добавлена</span>";
							else
								$message .= "<span class=\"error\">Новая переменная \${$variable_name} не добавлена из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Переменная с названием $variable_name уже существует</span>";
					}
					else
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе количества переменных</span>";
				}
				else
					$message .= "<span class=\"error\">В названии переменной не должно быть словa string, которым обозначаются строковые переменные</span>";
			}
			else
				$message .= "<span class=\"error\">Название переменной может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
		}
		else
			$message .= "<span class=\"error\">Отсутствует название переменной</span>";
	}
	
	function delete_variable($page_id)
	{
		global $_POST, $blocks_path, $sql, $message;
		
		$block_codes  = array();
		$block_titles = array();
		
		$sql = "SELECT `title`, `file` FROM `blocks` WHERE `page_id`=$page_id";
		if ($query_blocks = mysql_query($sql))
		{
			while ($block = mysql_fetch_array($query_blocks))
			{
				$block_file = $block["file"];
				if (file_exists($blocks_path.$block_file))
				{
					$block_code = file_get_contents($blocks_path.$block_file);
					if ($block_code !== false)
					{
						$block_codes[]  = $block_code;
						$block_titles[] = $block["title"];
					}
					else
						$errors .= "<span class=\"error\">Код блока «{$block["title"]}» не получен из файла $block_file из-за ".get_error(1)."</span>";
				}
				else
					$errors .= "<span class=\"error\">Файл $block_file блока «{$block["title"]}» не найден</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе блоков страницы</span>";
		
		foreach ($_POST as $variable_id => $variable_name)
		{
			if (preg_match('#^variable\-\d+$#ims', $variable_id) == 1)
			{
				$variable_id = preg_replace("#\D#ims", "", $variable_id);
				
				// Удаляем css-переменную, которая отмечена: onclick="if (this.checked) this.value='shade_color'; else this.value='';"
				if ($variable_name != "")
				{
					$is_variable_present = false;
					
					foreach ($block_codes as $index => $block)
					{
						if (strpos($block, "\$$variable_name") !== false)
						{
							$is_variable_present = true;
							$message .= "<span class=\"error\">Переменная \${$variable_name} не удалена, так как она присутствует в блоке «{$block_titles[$index]}»</span>";
						}
					}
					
					if (!$is_variable_present)
					{
						$sql = "DELETE FROM `variables` WHERE `id`=$variable_id";
						if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
							$message .= "<span class=\"success\">Переменная \${$variable_name} успешно удалена</span>";
						else
							$message .= "<span class=\"error\">Переменная \${$variable_name} не удалена из-за ".get_error(1)."</span>";
					}
				}
			}
		}
	}
	
	function save_variables()
	{
		global $_POST, $sql, $message;
		
		foreach ($_POST as $variable_id => $variable_value)
		{
			if (preg_match('#^variable\-\d+$#ims', $variable_id) == 1)
			{
				$variable_id = preg_replace("#\D#ims", "", $variable_id);
				$variable_value = trim($variable_value);
				
				$sql = "SELECT * FROM `variables` WHERE `id`=$variable_id";
				if ( ($query_variable = mysql_query($sql)) && ($variable = mysql_fetch_array($query_variable)) )
				{
					if ($variable["value"] != $variable_value)
					{
						$sql = "UPDATE `variables` SET `value`='".addslashes($variable_value)."' WHERE `id`=$variable_id";
						if ( mysql_query($sql) && (mysql_affected_rows() == 1) )
							$message .= "<span class=\"success\">Переменная \${$variable["name"]} успешно изменена</span>";
						else
							$message .= "<span class=\"error\">Переменная \${$variable["name"]} не изменена из-за ".get_error(1)."</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе переменной с id=$variable_id</span>";
			}
		}
	}
	
	function get_layouts($template_id, $styles_path, $css_title)
	{
		global $template_css, $blocks_css, $sql, $message;
		
		$result = false;
		
		$sql = "SELECT * FROM `layouts` WHERE `template_id`=$template_id ORDER BY `sort`,`id`";
		$query_layouts = mysql_query($sql);
		if ($query_layouts)
		{
			$count_layouts = mysql_num_rows($query_layouts);
			
			if (($count_layouts == 0) && ($template_id > 0))
			{
				$message .= "<span class=\"info\">У шаблона отсутствовали css медиа-запросы</span>";
				
				$layout_id = create_layout($template_id, "Основной", 1, $styles_path);
				if ($layout_id > -1)
				{
					$query_layouts = mysql_query($sql);
					$count_layouts = mysql_num_rows($query_layouts);
				}
			}
			
			if ($count_layouts > 0)
			{
				$count = 0;
				$layouts = array();
				while ($layout = mysql_fetch_array($query_layouts))
				{
					$file = $template_css . "-" . $layout["id"] . ".css";
					if (file_exists($styles_path.$file))
					{
						$text = file_get_contents($styles_path.$file);
						if ($text !== false)
						{
							$count++;
							$layout["template_cssfile"] = $file;
							$layout["template_csstext"] = $text;
						}
						else
							$message .= "<span class=\"error\">Содержимое общего файла стилей $file не получено из-за ".get_error(1)."</span>";
					}
					else
						$message .= "<span class=\"error\">Общий файл стилей $styles_path$file не найден</span>";
						
					$file = $blocks_css . "-" . $layout["id"] . ".css";
					if (file_exists($styles_path.$file))
					{
						$text = file_get_contents($styles_path.$file);
						if ($text !== false)
						{
							$layout["blocks_cssfile"] = $file;
							$layout["blocks_csstext"] = $text;
							
							if ($css_title != "")
							{
								if (preg_match('#\/\*'.$css_title.'\*\/(.*?)\/\*\/'.$css_title.'\*\/#ims', $text, $matches) == 1)
								{
									$count++;
									$layout["block_csstext"] = trim($matches[1]);
								}
								else
									$message .= "<span class=\"error\">Раздел файла стилей $file, относящийся к блоку $css_title.tpl, не найден</span>";
							}
							else
								$count++;
						}
						else
							$message .= "<span class=\"error\">Содержимое файла стилей $file не получено из-за ".get_error(1)."</span>";
					}
					else
						$message .= "<span class=\"error\">Файл стилей $styles_path$file не найден</span>";
						
					$layouts[$layout["id"]] = $layout;
				}
				if ($count == $count_layouts*2)
					$result = $layouts;
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе css медиа-запросов шаблона</span>";
		
		return $result;
	}
	
	function get_layouts_prototypes($css_title, $is_server)
	{
		global $prototypes_path, $blocks_css, $server_name, $sql, $message;
		
		$result = false;
		
		$sql = "SELECT * FROM `settings` WHERE `name`='prototypes_css'";
		if ($is_server)
		{
			$path = "http://" . $server_name . str_replace(ROOT, "", $prototypes_path);
			$word = " на сервере";
			$query_setting = mysql_query_server($sql);
		}
		else
		{
			$path = $prototypes_path;
			$word = "";
			$query_setting = mysql_query($sql);
		}
		
		if ($query_setting && ($setting = mysql_fetch_array($query_setting)))
		{
			if ($setting["value"] != "")
			{
				$count_strings = substr_count($setting["value"], "\n") + 1;
				$count_preg = preg_match_all('#^([а-яё0-9\-\_]+) ([a-z0-9\-\_]+)\s?(\/\*.*?\*\/)?\s?(\@media.*?)?$#imu', $setting["value"], $matches);
				if ($count_preg > 0)
				{
					if ($count_preg == $count_strings)
					{
						$count = 0;
						$layouts = array();
						for ($i = 0; $i < $count_preg; $i++)
						{
							$layout = array();
							
							$layout["id"]    = $i;
							$layout["template_id"] = 0;
							$layout["sort"]  = $i + 1;
							$layout["title"] = $matches[1][$i];
							$layout["text"]  = trim($matches[3][$i] . "\r\n" . $matches[4][$i]);
							
							$file = $blocks_css . "-" . $matches[2][$i] . ".css";
							$text = file_get_contents($path.$file);
							if ($text !== false)
							{
								$layout["blocks_cssfile"] = $file;
								$layout["blocks_csstext"] = $text;
								
								if ($css_title != "")
								{
									if (preg_match('#\/\*'.$css_title.'\*\/(.*?)\/\*\/'.$css_title.'\*\/#ims', $text, $matches_block) == 1)
									{
										$count++;
										$layout["block_csstext"] = trim($matches_block[1]);
									}
									else
										$message .= "<span class=\"error\">Раздел файла стилей блоков-прототипов $file, относящийся к блоку-прототипу $css_title.tpl, не найден$word</span>";
								}
								else
									$count++;
							}
							else
								$message .= "<span class=\"error\">Содержимое файла стилей блоков-прототипов $file не получено$word из-за ".get_error(1)."</span>";
							
							$layouts[$layout["id"]] = $layout;
						}
						if ($count == $count_preg)
							$result = $layouts;
					}
					else
						$message .= "<span class=\"error\">В предустановке «{$setting["title"]}»$word у некоторых css медиа-запросов не найдено обязательные названия русскими и латинскими буквами</span>";
				}
				else
					$message .= "<span class=\"error\">В предустановке «{$setting["title"]}»$word не найден ни один css медиа-запрос вида:<br /><русское_название> <латинское_название> /* <комментарий> */ @media <параметры></span>";
			}
			else
				$message .= "<span class=\"error\">Предустановка «{$setting["title"]}»$word пуста</span>";
		}
		else
		{
			if ($query_setting === false)
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «CSS медиа-запросы для блоков-прототипов»$word</span>";
			else
				$message .= "<span class=\"error\">Предустановка «CSS медиа-запросы для блоков-прототипов» не найдена в базе данных$word</span>";
		}
		
		return $result;
	}
	
	function create_layout($template_id, $layout_title, $layout_sort, $styles_path)
	{
		global $template_css, $blocks_css, $sql, $message, $blocks_text;
		
		$layout_id = -1;
		
		$sql = "INSERT INTO `layouts`(`template_id`,`title`,`sort`) VALUES ($template_id,'$layout_title',$layout_sort)";
		mysql_query($sql);
		if (mysql_affected_rows() == 1)
		{
			$layout_id = mysql_insert_id();
			$message .= "<span class=\"success\">Css медиа-запрос «{$layout_title}» успешно добавлен</span>";
			
			// Считываем предустановки для нового css медиа-запроса
			$template_text = "";
			$sql = "SELECT * FROM `settings` WHERE `name`='template_css'";
			$query_setting = mysql_query($sql);
			if ($query_setting && ($setting = mysql_fetch_array($query_setting)))
			{
				$template_text = $setting["value"];
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «CSS-код нового медиа-запроса»</span>";
			
			// Создаём файл стилей шаблона для нового css медиа-запроса
			$file = $template_css . "-" . $layout_id . ".css";
			if (file_put_contents($styles_path.$file, $template_text) !== false)
			{
				$message .= "<span class=\"success\">Файл стилей шаблона $file успешно создан</span>";
				
				if (!chmod_file($styles_path, $file))
					$message .= "<span class=\"info\">Полные права доступа к файлу стилей шаблона $file не установлены из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Файл стилей шаблона $file не создан из-за ".get_error(1)."</span>";
				
			// Создаём текст с отметками всех блоков этого шаблона
			$sql = "SELECT `file` FROM `blocks` WHERE `template_id`=$template_id ORDER BY `sort`,`id`";
			$query_blocks = mysql_query($sql);
			if ($query_blocks)
			{
				while ($block = mysql_fetch_array($query_blocks))
				{
					$css_title = str_ireplace(".tpl", "", $block["file"]);
					$blocks_text .= "/*$css_title*/\n\n/*/$css_title*/\n\n";
				}
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе всех блоков шаблона</span>";
			
			// Создаём файл стилей блоков для нового css медиа-запроса
			$file = $blocks_css . "-" . $layout_id . ".css";
			if (file_put_contents($styles_path.$file, $blocks_text) !== false)
			{
				$message .= "<span class=\"success\">Файл стилей блоков $file успешно создан</span>";
				
				if (!chmod_file($styles_path, $file))
					$message .= "<span class=\"info\">Полные права доступа к файлу стилей блоков $file не установлены из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Файл стилей блоков $file не создан из-за ".get_error(1)."</span>";
		}
		else
			$message .= "<span class=\"error\">Css медиа-запрос «{$layout_title}» не создан из-за ".get_error(1)."</span>";
		
		return $layout_id;
	}
		
	function create_page($template_id, $file, $name, $main)
	{
		global $sql, $message;
		
		$result = 0;
		
		// Поля на непустоту проверяются javascript'ом
		$is_success = true;
		$is_first_page = false;
		if (preg_match("#^[a-z0-9\_\-\/\.]+$#ims", $file) == 1)
		{
			$sql = "SELECT `file` FROM `pages` WHERE `template_id`=$template_id";
			if ( ($query_pages = mysql_query($sql)) && (mysql_num_rows($query_pages) > 0) )
			{
				while ($page = mysql_fetch_array($query_pages))
				{
					if (strcasecmp($file, $page["file"]) == 0)
					{
						$is_success = false;
						$message .= "<span class=\"error\">Имя файла $file уже существует</span>";
					}
				}
			}
			else
			{
				if ($query_pages === false)
				{
					$is_success = false;
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе на уникальность имени файла новой страницы</span>";
				}
				elseif (mysql_num_rows($query_pages) == 0)
					$is_first_page = true;
			}
		}
		else
		{
			$is_success = false;
			$message .= "<span class=\"error\">Имя файла может состоять из латинских букв, цифр, тире, знака подчёркивания и слеша</span>";
		}
			
		if ($is_success)
		{
			$head = "";
			$sql = "SELECT * FROM `settings` WHERE `name`='page_head'";
			if ( ($query_setting = mysql_query($sql)) && ($setting = mysql_fetch_array($query_setting)) )
				$head = $setting["value"];
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «HTML-код секции head новой страницы»</span>";
			
			$body = "";
			$sql = "SELECT * FROM `settings` WHERE `name`='page_body'";
			if ( ($query_setting = mysql_query($sql)) && ($setting = mysql_fetch_array($query_setting)) )
			{
				if (preg_match("#\<\!\-\-\s*start_blocks\s*\-\-\>\s*\<\!\-\-\s*end_blocks\s*\-\-\>#ims", $setting["value"]) == 1)
					$body = $setting["value"];
				else
					$message .= "<span class=\"error\">В предустановке «{$setting["title"]}» не найдены метки start_blocks и end_blocks</span>";
			}
			else
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе предустановки «HTML-код секции body новой страницы»</span>";
			
			if ($body == "")
				$body = <<< EOB
	<!-- start_blocks -->
	<!-- end_blocks -->\n
EOB;
			
			$status = ($is_first_page) ? 1 : 0;
			
			$sql = "INSERT INTO `pages`(`template_id`,`status`,`file`,`name`,`title`,`meta_description`,`meta_keywords`,`doctype`,`favicon`,`head`,`body`,`main`,`visible`) VALUES ($template_id,$status,'$file','".addslashes($name)."','Заголовок страницы для тега title','Описание страницы для тега meta description','Ключевые слова для тега meta keywords','<!doctype html>','','".addslashes($head)."','".addslashes($body)."',$main,1)";
			
			if (mysql_query($sql) && (mysql_affected_rows() == 1))
			{
				$result = mysql_insert_id();
				$message .= "<span class=\"success\">Страница «{$name}» успешно создана</span>";
				
				// Внесение скриптов для страницы в таблицу подключений скриптов
				$sql = "SELECT * FROM `settings` WHERE `type`=4";
				if ($query_scripts = mysql_query($sql))
				{
					while ($script = mysql_fetch_array($query_scripts))
					{
						$sql = "INSERT INTO `scripts` (`page_id`,`script_id`,`status`) VALUES ($result,{$script["id"]},1)";
						if (!mysql_query($sql) || (mysql_affected_rows() == 0))
							$message .= "<span class=\"error\">Запись о скрипте {$script["name"]} не добавлена в таблицу подключений скриптов из-за ".get_error(1)."</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка настроек скриптов</span>";
			}
			else
				$message .= "<span class=\"error\">Страница «{$name}» не создана из-за ".get_error(1)."</span>";
		}
		
		return $result;
	}
	
	function get_max_sort($page_id)
	{
		global $sql, $message;
		
		$result = 1;
		
		$blocks_max  = 1;
		$mirrors_max = 1;
		
		// Находим максимум сортировки среди обычных блоков
		$sql = "SELECT MAX(`sort`) FROM `blocks` WHERE `page_id`=$page_id";
		$query_max = mysql_query($sql);
		if ($query_max && ($max = mysql_fetch_row($query_max)))
		{
			if ($max[0] != null)
				$blocks_max = intval($max[0]) + 1;
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе максимума порядков следования блоков</span>";
		
		// Находим максимум сортировки среди блоков-ссылок
		$sql = "SELECT MAX(`sort`) FROM `mirrors` WHERE `page_id`=$page_id";
		$query_max = mysql_query($sql);
		if ($query_max && ($max = mysql_fetch_row($query_max)))
		{
			if ($max[0] != null)
				$mirrors_max = intval($max[0]) + 1;
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе максимума порядков следования блоков-ссылок</span>";
		
		$result = ($blocks_max > $mirrors_max) ? $blocks_max : $mirrors_max;
		
		return $result;
	}
	
	function double_strings($block_title, $new_block_code, $is_show_success)
	{
		global $sql, $message;
		
		$result = $new_block_code;
		
		if (preg_match_all('#\{\$string\-([0-9]{1,10})\}#ims', $new_block_code, $matches) > 0)
		{
			$count = 0;
			$unique_matches = array_unique($matches[1]);
			foreach ($unique_matches as $id)
			{
				$sql = "SELECT * FROM `strings` WHERE `id`=$id";
				$query_string = mysql_query($sql);
				if ($query_string && ($string = mysql_fetch_array($query_string)))
				{
					$sql = "INSERT INTO `strings`(`title`,`content`) VALUES ('{$string["title"]}','{$string["content"]}')";
					mysql_query($sql);
					if (mysql_affected_rows() > 0)
					{
						$count++;
						$new_id = mysql_insert_id();
						$result = str_replace('{$string-'.$id.'}', '{$string-'.$new_id.'}', $result);
					}
					else
						$message .= "<span class=\"error\">Строковая константа string-$id блока$block_title не дублирована из-за ".get_error(1)."</span>";
				}
				else
				{
					if ($query_string === false)
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе строковой константы string-$id блока$block_title</span>";
					else
						$message .= "<span class=\"error\">Строковая константа string-$id блока$block_title не найдена в базе данных</span>";
				}
			}
			if (($count > 0) && ($count == count($unique_matches)))
			{
				if ($is_show_success)
					$message .= "<span class=\"success\">Строковые константы блока$block_title успешно дублированы</span>";
			}
		}
		
		return $result;
	}
	
	function double_block($page_id, $block_id, $new_block_title, $new_block_file, $is_new_sort, $is_show_success)
	{
		global $template_id, $styles_path, $blocks_path, $block_code, $sql, $message, $is_blocks_list_changed;
		
		$result = 0;
		
		$sql = "SELECT * FROM `blocks` WHERE `id`=$block_id";
		if ( ($query_block = mysql_query($sql)) && ($block = mysql_fetch_array($query_block)) )
		{
			$block_title = $block["title"];
			$block_file  = $block["file"];
			
			if (file_exists($blocks_path.$block_file))
			{
				$text = file_get_contents($blocks_path.$block_file);
				if ($text !== false)
				{
					$block_code = $text;
					
					if ($new_block_file == "")
					{
						$i = 0;
						$name = $block_file;
						$parts = pathinfo($name);
						while (file_exists($blocks_path.$name))
						{
							$i++;
							$name = $parts["filename"]."-".$i.".".$parts["extension"];
						}
						$new_block_file = str_ireplace(".tpl", "", $name);
					}
					
					// Названия блоков уникальные в пределах страницы
					if ($new_block_title == "")
					{
						$i = 0;
						$name = $block_title;
						$sql = "SELECT `title` FROM `blocks` WHERE `page_id`=$page_id AND `title`='$name'";
						if ($query_blocks = mysql_query($sql))
						{
							while (mysql_num_rows($query_blocks) > 0)
							{
								$i++;
								$name = $block_title . " $i";
								$sql = "SELECT `title` FROM `blocks` WHERE `page_id`=$page_id AND `title`='$name'";
								$query_blocks = mysql_query($sql);
							}
						}
						else
							$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка названий блоков для проверки уникальности имени нового блока</span>";
						$new_block_title = $name;
					}
					
					$result_check_names = check_names($template_id, $page_id, $blocks_path, $new_block_title, $new_block_file, true, true);
					
					if ($result_check_names == "")
					{
						$new_block_code = $block_code;
						
						// Создаём новые строковые константы и заменяем их в коде блока
						$new_block_code = double_strings(" «{$block_title}»", $new_block_code, $is_show_success);
						
						// Увеличиваем счётчики форм, если они есть
						$is_form = false;
						$patterns = array();
						$replacements = array();
						if (preg_match_all('#\<div id\=\"div_contact(\d)\-(\d)\"#ims', $new_block_code, $matches) > 0)
						{
							foreach ($matches[1] as $index => $form_id)
							{
								$counter = $matches[2][$index];
								
								$sql = "SELECT `counter`,`title` FROM `forms` WHERE `id`=$form_id";
								$query_form = mysql_query($sql);
								if ($query_form && ($form = mysql_fetch_array($query_form)))
								{
									$is_form = true;
									
									$new_counter = intval($form["counter"]) + 1;
									$sql = "UPDATE `forms` SET `counter`='$new_counter' WHERE `id`=$form_id";
									mysql_query($sql);
									if (mysql_affected_rows() < 1)
										$message .= "<span class=\"error\">Счётчик добавлений формы «{$form["title"]}» не увеличен в базе данных из-за ".get_error(1)."</span>";
									
									$patterns[] = "/div_contact$form_id-$counter/";
									$replacements[] = "div_contact$form_id-$new_counter";
								}
								else
									$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$form_id</span>";
							}
							
							if ($is_form)
							{
								$text_replaced = preg_replace($patterns, $replacements, $new_block_code);
								if ($text_replaced !== null)
									$new_block_code = $text_replaced;
								else
									$message .= "<span class=\"error\">Счётчики добавлений форм в коде блока не увеличены из-за ".get_error(1)."</span>";
							}
						}
						
						if ($is_new_sort)
							$sort = get_max_sort($page_id);
						else
							$sort = $block["sort"];
						
						// Сохраняем новый блок в таблице блоков
						$sql = "INSERT INTO `blocks` (`template_id`, `page_id`, `title`, `sort`, `file`) VALUES ($template_id, $page_id, '$new_block_title', '$sort', '$new_block_file.tpl')";
						if (mysql_query($sql) && (mysql_affected_rows() == 1))
						{
							$is_blocks_list_changed = true;
							$result = mysql_insert_id();
							
							$message .= "<span class=\"success\">Блок-дубликат «{$new_block_title}» успешно создан</span>";
							
							$block_code = $new_block_code;
							
							// Сохраняем файл нового блока
							if (file_put_contents($blocks_path.$new_block_file.".tpl", $new_block_code) !== false)
							{
								if ($is_show_success)
									$message .= "<span class=\"success\">Файл $new_block_file.tpl блока-дубликата «{$new_block_title}» успешно создан</span>";
								
								if (!chmod_file($blocks_path, $new_block_file.".tpl"))
									$message .= "<span class=\"info\">Полные права доступа к файлу блока-дубликата $new_block_file.tpl не установлены из-за ".get_error(1)."</span>";
								
								// Дублируем css-правила в файле стилей
								$css_title = str_ireplace(".tpl", "", $block_file);
								
								$layouts = array();
								$layouts = get_layouts($template_id, $styles_path, $css_title);
								if ($layouts !== false)
								{
									$count = 0;
									foreach ($layouts as $layout)
									{
										$blocks_csstext = $layout["blocks_csstext"];
										$block_csstext  = $layout["block_csstext"];
										
										if ($is_form)
										{
											$text_replaced = preg_replace($patterns, $replacements, $block_csstext);
											if ($text_replaced !== null)
												$block_csstext = $text_replaced;
											else
												$message .= "<span class=\"error\">Счётчики форм в css медиа-запросе «{$layout["title"]}» не увеличены из-за ".get_error(1)."</span>";
										}
										
										$new_blocks_csstext = trim($blocks_csstext) . "\n\n/*$new_block_file*/\n" . $block_csstext . "\n/*/$new_block_file*/";
										
										$file = $layout["blocks_cssfile"];
										if (file_put_contents($styles_path.$file, $new_blocks_csstext) !== false)
										{
											$count++;
											if (!chmod_file($styles_path, $file))
												$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
										}
										else
											$message .= "<span class=\"error\">Сss-правила блока «{$block_title}» не дублированы в файле стилей $file,<br />так как он не сохранён из-за ".get_error(1)."</span>";
									}
									if ($count == count($layouts))
									{
										if ($is_show_success)
											$message .= "<span class=\"success\">Сss-правила блока «{$block_title}» успешно дублированы в файлах стилей</span>";
									}
								}
							}
							else
								$message .= "<span class=\"error\">Файл $new_block_file.tpl блока-дубликата «{$new_block_title}» не создан из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Блок-дубликат «{$new_block_title}» не создан из-за ".get_error(1)."</span>";
					}
					else
						$message .= $result_check_names;
				}
				else
					$message .= "<span class=\"error\">Код дублируемого блока «{$block_title}» не получен из файла $block_file из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Файл $block_file дублируемого блока «{$block_title}» не найден</span>";
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе дублируемого блока с id=$block_id</span>";
		
		return $result;
	}
	
	function create_mirror($page_id, $block_id, $is_new_sort)
	{
		global $sql, $message, $is_blocks_list_changed;
		
		$result = 0;
		
		$sql = "SELECT * FROM `blocks` WHERE `id`=$block_id";
		if ( ($query_block = mysql_query($sql)) && (mysql_num_rows($query_block) == 1) )
		{
			$block = mysql_fetch_array($query_block);
			
			if ($is_new_sort)
				$sort = get_max_sort($page_id);
			else
				$sort = $block["sort"];
			
			$sql = "INSERT INTO `mirrors` (`page_id`, `block_id`, `sort`) VALUES ($page_id, $block_id, $sort)";
			if (mysql_query($sql) && (mysql_affected_rows() == 1))
			{
				$is_blocks_list_changed = true;
				$result = mysql_insert_id();
				$message .= "<span class=\"success\">Блок-ссылка «{$block["title"]}» успешно создан</span>";
			}
			else
				$message .= "<span class=\"error\">Блок-ссылка «{$block["title"]}» не создан из-за ".get_error(1)."</span>";
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе исходного блока с id=$block_id для создания блока-ссылки</span>";
		
		return $result;
	}	
	
	function double_mirror($page_id, $mirror_id, $is_new_sort)
	{
		global $sql, $message, $is_blocks_list_changed;
		
		$result = 0;
		
		$sql = "SELECT `blocks`.`id`,`blocks`.`title`,`mirrors`.`sort`,`mirrors`.`status` FROM `mirrors` LEFT JOIN `blocks` ON `mirrors`.`block_id`=`blocks`.`id` WHERE `mirrors`.`id`=$mirror_id";
		if ( ($query_block = mysql_query($sql)) && ($block = mysql_fetch_array($query_block)) )
		{
			if ($is_new_sort)
				$sort = get_max_sort($page_id);
			else
				$sort = $block["sort"];
			
			$sql = "INSERT INTO `mirrors` (`page_id`, `block_id`, `sort`, `status`) VALUES ($page_id, {$block["id"]}, $sort, {$block["status"]})";
			if (mysql_query($sql) && (mysql_affected_rows() == 1))
			{
				$is_blocks_list_changed = true;
				$result = mysql_insert_id();
				$message .= "<span class=\"success\">Блок-ссылка «{$block["title"]}» успешно дублирован</span>";
			}
			else
				$message .= "<span class=\"error\">Блок-ссылка «{$block["title"]}» не дублирован из-за ".get_error(1)."</span>";
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе блока-ссылки с id=$mirror_id</span>";
		
		return $result;
	}
	
	function delete_block($block_id, $is_prototypes, $is_delete_mirrors, $is_delete_file, $is_delete_css, $is_server, $is_show_success)
	{
		global $template_id, $styles_path, $blocks_path, $prototypes_path, $message, $sql, $is_blocks_list_changed;
		
		$sql = "SELECT * FROM `blocks` WHERE `id`=$block_id";
		$query_block = mysql_query($sql);
		if ($query_block && ($block = mysql_fetch_array($query_block)))
		{
			$block_title = $block["title"];
			$block_file  = $block["file"];
			$css_title   = str_ireplace(".tpl", "", $block_file);
			
			// Получение списка блоков-ссылок
			$pages_list = "";
			$no_mirrors = true;
			$sql = "SELECT `pages`.`name` AS `page_name` FROM `mirrors` LEFT JOIN `pages` ON `mirrors`.`page_id`=`pages`.`id` WHERE `block_id`=$block_id";
			$query_mirrors = mysql_query($sql);
			if ($query_mirrors)
			{
				while ($mirror = mysql_fetch_array($query_mirrors))
				{
					if ($pages_list == "")
						$pages_list .= "«{$mirror["page_name"]}»";
					else
						$pages_list .= ", «{$mirror["page_name"]}»";
				}
			}
			else
			{
				$no_mirrors = false;
				$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков-ссылок для блока «{$block_title}»</span>";
			}
			
			if ($pages_list != "")
			{
				if ($is_delete_mirrors)
					delete_mirrors(0, $block_id, 0, $block_title, $pages_list);
				else
				{
					$no_mirrors = false;
					$message .= "<span class=\"error\">Блок «{$block_title}» не может быть удалён,<br />так как имеет блок-ссылку(и) на странице(ах): $pages_list</span>";
				}
			}
			
			if ($no_mirrors)
			{
				$layouts = array();
				
				if ($is_prototypes)
				{
					$temp_blocks_path = $prototypes_path;
					$temp_styles_path = $prototypes_path;
					$word = "-прототип";
					
					$layouts = get_layouts_prototypes("", false);
				}
				else
				{
					$temp_blocks_path = $blocks_path;
					$temp_styles_path = $styles_path;
					$word = "";
					
					$layouts = get_layouts($template_id, $styles_path, "");
				}
				
				$sql = "DELETE FROM `blocks` WHERE `id`=$block_id";
				if ($is_server)
				{
					$server_data = array();
					$data = array();
					
					$data["sql"]     = $sql;
					$data["success"] = "Блок-прототип «{$block_title}» успешно удалён из базы данных сервера";
					$data["error"]   = "Блок-прототип «{$block_title}» не удалён из базы данных сервера из-за";
					$data["info"]    = "Блок-прототип «{$block_title}» не существует в базе данных сервера";
					
					$server_data[] = $data;
					
					//if (save_to_server($server_data))
					//{
						save_to_server($server_data, "Блок-прототип «{$block_title}» успешно удалён из базы данных сервера");
						delete_file_on_server($block_file);
						delete_css_on_server($css_title);
					//}
				}
				
				$sql = "DELETE FROM `blocks` WHERE `id`=$block_id";
				$res = mysql_query($sql);
				if ($res && (mysql_affected_rows() == 1))
				{
					$is_blocks_list_changed = true;
					$message .= "<span class=\"success\">Блок{$word} «{$block_title}» успешно удалён</span>";
					
					// Удалить файл блока
					if ($is_delete_file)
					{
						if (file_exists($temp_blocks_path.$block_file))
						{
							if (unlink($temp_blocks_path.$block_file))
							{
								if ($is_show_success)
									$message .= "<span class=\"success\">Файл $block_file блок{$word}а «{$block_title}» успешно удалён</span>";
							}
							else
								$message .= "<span class=\"error\">Файл $block_file блок{$word}а «{$block_title}» не удалён из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Файл $block_file блок{$word}а «{$block_title}» не найден</span>";
					}
					
					// Удалить css-правила блока из файлов стилей
					if ($is_delete_css)
					{
						if ($layouts !== false)
						{
							$count = 0;
							foreach ($layouts as $layout)
							{
								$blocks_csstext = $layout["blocks_csstext"];
								$file = $layout["blocks_cssfile"];
								
								$count_replaces = 0;												
								$new_blocks_csstext = preg_replace('#\/\*'.$css_title.'\*\/.*?\/\*\/'.$css_title.'\*\/#ims', '', $blocks_csstext, -1, $count_replaces);
								
								if ( ($new_blocks_csstext !== null) && ($count_replaces == 1) )
								{
									if (file_put_contents($temp_styles_path.$file, trim($new_blocks_csstext)) !== false)
									{
										$count++;
										
										if (!chmod_file($temp_styles_path, $file))
											$message .= "<span class=\"info\">Полные права доступа к файлу стилей $file не установлены из-за ".get_error(1)."</span>";
									}
									else
										$message .= "<span class=\"error\">Сss-правила блок{$word}а «{$block_title}» не удалены из файла стилей $file,<br />так как он не сохранён из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Сss-правила блок{$word}а «{$block_title}» не удалены из файла стилей $file,<br />так как метки блока $css_title не были найдены</span>";
							}
							if (($count == count($layouts)) && $is_show_success)
								$message .= "<span class=\"success\">Сss-правила блок{$word}а «{$block_title}» успешно удалены из файлов стилей</span>";
						}
					}
				}
				else
					$message .= "<span class=\"error\">Блок{$word} «{$block_title}» не удалён из-за ".get_error(1)."</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе блока с id=$block_id</span>";
	}
	
	function delete_mirrors($page_id, $block_id, $mirror_id, $title, $pages_list)
	{
		global $sql, $message, $is_blocks_list_changed;
		
		if ($page_id != 0)
		{
			$sql = "SELECT `id` FROM `mirrors` WHERE `page_id`=$page_id";
			$words = "списка блоков-ссылок страницы «{$title}»";
		}
		
		if ($block_id != 0)
		{
			$sql = "SELECT `id` FROM `mirrors` WHERE `block_id`=$block_id";
			$words = "списка блоков-ссылок блока «{$title}»";
		}
		
		if ($mirror_id != 0)
		{
			$sql = "SELECT `id` FROM `mirrors` WHERE `id`=$mirror_id";
			$words = "блока-ссылки «{$title}»";
		}
		
		$query_mirrors = mysql_query($sql);
		if ($query_mirrors)
		{
			$count = 0;
			$count_mirrors = mysql_num_rows($query_mirrors);
			
			while ($mirror = mysql_fetch_array($query_mirrors))
			{
				$sql = "DELETE FROM `mirrors` WHERE `id`={$mirror["id"]}";
				$res = mysql_query($sql);
				if ($res && (mysql_affected_rows() == 1))
				{
					$count++;
					mysql_query("DELETE FROM `counters` WHERE `mirror_id`={$mirror["id"]}");
					if ($mirror_id != 0)
					{
						$is_blocks_list_changed = true;
						$message .= "<span class=\"success\">Блок-ссылка «{$title}» успешно удалён</span>";
					}
				}
				else
					$message .= "<span class=\"error\">Блок-ссылка «{$title}» не удалён из-за ".get_error(1)."</span>";
			}
			
			if (($count > 0) && ($count == $count_mirrors))
			{
				if ($page_id != 0)
					$message .= "<span class=\"success\">Блоки-ссылки страницы «{$title}» успешно удалены</span>";
				
				if ($block_id != 0)
					$message .= "<span class=\"success\">Блоки-ссылки блока «{$title}» успешно удалены на страницах: $pages_list</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе $words</span>";
	}
		
	function get_page_blocks($page_id, $page_title, $only_visible = false, $get_block_code = false)
	{
		global $blocks_path, $sql, $message, $page_blocks_errors;
		
		$errors = "";
		$blocks = array();
		
		if ($page_id == 0)
			$word_title = "-прототипов";
		else
			$word_title = " страницы «{$page_title}»";
		
		// Добавление реальных блоков
		$where = ($only_visible) ? "`status`=1 AND" : "";
		$sql = "SELECT * FROM `blocks` WHERE $where `page_id`=$page_id";
		if ($query_blocks = mysql_query($sql))
		{
			while ($block = mysql_fetch_array($query_blocks))
			{
				// Получение кода блока
				if ($get_block_code)
				{
					$block_code = "";
					$block_file = $block["file"];
					if (file_exists($blocks_path.$block_file))
					{
						$text = file_get_contents($blocks_path.$block_file);
						if ($text !== false)
							$block_code = $text;
						else
							$errors .= "<span class=\"error\">Код блока «{$block["title"]}» не получен из файла $block_file из-за ".get_error(1)."</span>";
					}
					else
						$errors .= "<span class=\"error\">Файл $block_file блока «{$block["title"]}» не найден</span>";
					
					$block["block_code"] = $block_code;
				}
				
				$block["page_name"]  = $page_title;
				$block["form_title"] = "Блок «{$block["title"]}»";
				$block["form_name"]  = "block-{$block["id"]}";
				$block["menu_title"] = $block["title"];
				$block["menu_link"]  = "index.php?page=blocks&amp;type={$block["id"]}";
				$block["form_id"]    = $block["id"];
				$block["mirror"]     = 0;
				//$block["status"]     = 0;
				
				$blocks[] = $block;
			}
		}
		else
			$errors .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков$word_title</span>";
		/*
		// Добавление блоков-ссылок
		$where = ($only_visible) ? "`mirrors`.`status`=1 AND" : "";
		$sql = "SELECT `blocks`.*, `mirrors`.`id` AS `mirror_id`, `mirrors`.`sort` AS `mirror_sort`, `mirrors`.`status` AS `mirror_status` FROM `mirrors` LEFT JOIN `blocks` ON `mirrors`.`block_id`=`blocks`.`id` WHERE $where `mirrors`.`page_id`=$page_id";
		if ($query_mirrors = mysql_query($sql))
		{
			while ($block = mysql_fetch_array($query_mirrors))
			{
				// Получение названия страницы
				$original_page_name = "Стр. №{$block["page_id"]}";
				$sql = "SELECT `name` FROM `pages` WHERE `id`={$block["page_id"]}";
				$query_page = mysql_query($sql);
				if ($query_page && ($original_page = mysql_fetch_array($query_page)))
					$original_page_name = $original_page["name"];
				else
					$errors .= "<span class=\"error\">Произошла ".get_error(0)." при запросе названия страницы с id={$block["page_id"]}</span>";
				
				// Получение кода блока
				if ($get_block_code)
				{
					$block_code = "";
					$block_file = $block["file"];
					if (file_exists($blocks_path.$block_file))
					{
						$text = file_get_contents($blocks_path.$block_file);
						if ($text !== false)
						{
							$block_code = $text;
							
							// Увеличиваем и запоминаем счётчики форм, если они есть
							$is_form = false;
							$patterns = array();
							$replacements = array();
							if (preg_match_all('#\<div.*?id\=[\"\']div_contact(\d)\-(\d)[\"\']#ims', $block_code, $matches) > 0)
							{
								foreach ($matches[1] as $index => $form_id)
								{
									$counter = $matches[2][$index];
									
									$sql = "SELECT `title` FROM `forms` WHERE `id`=$form_id";
									$query_form = mysql_query($sql);
									if ($query_form && ($form = mysql_fetch_array($query_form)))
									{
										$is_form = true;
										
										// Проверяем сначала, есть ли запись о счётчике в таблице counters, 
										// Если есть - берём её, если нет, увеличиваем счётчик и записываем его в таблицу counters
										$sql = "SELECT `counter` FROM `counters` WHERE `mirror_id`={$block["mirror_id"]} AND `form_id`=$form_id";
										$query_counter = mysql_query($sql);
										if ($query_counter && ($row = mysql_fetch_array($query_counter)))
											$new_counter = $row["counter"];
										else
										{
											get_error(0);
											$new_counter = "";
											$sql = "UPDATE `forms` SET `counter`=`counter`+1 WHERE `id`=$form_id";
											mysql_query($sql);
											if (mysql_affected_rows() == 1)
											{
												$query_counter = mysql_query("SELECT `counter` FROM `forms` WHERE `id`=$form_id");
												if ($query_counter && ($row = mysql_fetch_array($query_counter)))
													$new_counter = $row["counter"];
												else
													get_error(0);
											}
											else
												get_error(0);
											
											// Если произошли ошибка, присваиваем счётчику случайное большое число
											if ($new_counter == "") $new_counter = rand(100, 999);
											
											// Вносим в таблицу counters новое значение счётчика для этой формы в этом блоке-ссылке
											$sql = "INSERT INTO `counters`(`mirror_id`,`form_id`,`counter`) VALUES ({$block["mirror_id"]},$form_id,$new_counter)";
											mysql_query($sql);
											if (mysql_affected_rows() < 1)
												get_error(0);
										}
										
										$patterns[] = "/div_contact$form_id-$counter/";
										$replacements[] = "div_contact$form_id-$new_counter";
									}
									else
										$errors .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$form_id</span>";
								}
								
								if ($is_form)
								{
									$text_replaced = preg_replace($patterns, $replacements, $block_code);
									if ($text_replaced !== null)
										$block_code = $text_replaced;
									else
										$errors .= "<span class=\"error\">Счётчики добавлений форм в коде блока не увеличены из-за ".get_error(1)."</span>";
								}
							}
						}
						else
							$errors .= "<span class=\"error\">Код блока «{$block["title"]}» не получен из файла $block_file из-за ".get_error(1)."</span>";
					}
					else
						$errors .= "<span class=\"error\">Файл $block_file блока «{$block["title"]}» не найден</span>";
					
					$block["block_code"] = $block_code;
				}
				
				$block["page_name"]  = '<img src="styles/mirror.png" alt="Блок-ссылка" width="15" />&nbsp;&nbsp;' . $original_page_name;
				$block["form_title"] = '<img src="styles/mirror.png" alt="Блок-ссылка" width="15" />&nbsp;&nbsp;' . "Блок-ссылка «{$block["title"]}»";
				$block["form_name"]  = "mirror-{$block["mirror_id"]}";
				$block["menu_title"] = '<img src="styles/mirror.png" alt="Блок-ссылка" width="15" />&nbsp;&nbsp;' . $block["title"];
				$block["menu_link"]  = "index.php?page=blocks&amp;type={$block["id"]}";
				$block["form_id"]    = $block["mirror_id"];
				$block["mirror"]     = 1;
				$block["sort"]       = $block["mirror_sort"];
				$block["status"]     = $block["mirror_status"];
				
				$blocks[] = $block;
			}
		}
		else
			$errors .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка блоков-ссылок$word_title</span>";
		*/
		// Сортировка массива блоков по полю sort
		usort($blocks, "sorting_function");
		
		if ($only_visible && $get_block_code)
			$page_blocks_errors = $errors; // Если генерация сайта - вывести сообщения об ошибках в отдельную переменную
		else
			$message .= $errors;
		
		return $blocks;
	}
	
	function get_error_sql($error_text, $sql_text)
	{
		$result = "ошибки";
		mysql_query("INSERT INTO `logs`(`text`,`data`) VALUES ('<b>Error</b>: ".addslashes($error_text)."','<b>Sql</b>: ".addslashes($sql_text)."')");
		if (mysql_affected_rows() == 1)
		{
			$id = mysql_insert_id();
			$result = '<a class="error_link tooltip" href="index.php?page=account&amp;type=logs&amp;view='.$id.'" title="Посмотреть расширенное описание ошибки">ошибки</a>';
		}
		return $result;
	}
	
	function mysql_query_server($sql_text)
	{
		global $db_vars, $server_db_vars, $message, $sql;
		
		$result = false;
		
		$errors  = array();
		$queries = array();
		$texts   = array();
		
		$sql = "";
		$link = mysql_connect($server_db_vars["server_db_host"], $server_db_vars["server_db_user"], $server_db_vars["server_db_pass"]);
		if ($link)
		{
			$sql = "";
			if (mysql_select_db($server_db_vars["server_db_base"], $link))
			{
				$sql = "set names 'utf8'";
				if (mysql_query($sql, $link))
				{
					$query = mysql_query($sql_text, $link);
					
					if ($query !== false)
					{
						if (strpos($sql_text, "SELECT") !== false)
						{
							if (mysql_num_rows($query) > 0)
								$result = $query;
							else
								$message .= "<span class=\"error\">Запрос на выборку данных на сервере вернул нулевой результат</span>";
						}
							
						if (strpos($sql_text, "INSERT") !== false)
						{
							if (mysql_affected_rows($link) == 1)
								$result = true;
							else
								$message .= "<span class=\"error\">Запрос на создание записи на сервере вернул отрицательный результат</span>";
						}
					}
					else
					{
						$errors[]  = mysql_error($link);
						$queries[] = $sql_text;
						$texts[]   = "Запрос к базе данных на сервере не выполнен из-за";
					}
				}
				else
				{
					$errors[]  = mysql_error($link);
					$queries[] = $sql;
					$texts[]   = "Установка кодировки базы данных сервера не произошла из-за";
				}
			}
			else
			{
				$errors[]  = mysql_error($link);
				$queries[] = $sql;
				$texts[]   = "Выбор базы данных на сервере не произошёл из-за";
			}
			
			mysql_close($link);
			
			// Снова подключаемся к клиентской базе данных
			$sql = "";
			if (mysql_connect($db_vars["db_host"], $db_vars["db_user"], $db_vars["db_pass"], false, 2))
			{
				$sql = "";
				if (mysql_select_db($db_vars["db_base"]))
				{
					$sql = "set names 'utf8'";
					if (mysql_query($sql))
					{
						if (count($errors) > 0)
						{
							foreach ($errors as $index => $error)
								$message .= "<span class=\"error\">{$texts[$index]} ".get_error_sql($error, $queries[$index])."</span>";
						}
					}
					else
						$message .= "<span class=\"error\">Установка кодировки базы данных сайта не произошла из-за ".get_error(1)."</span>";
				}
				else
					$message .= "<span class=\"error\">Выбор базы данных сайта не произошёл из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Подключение к базе данных сайта не произошло из-за ".get_error(1)."</span>";
		}
		else
			$message .= "<span class=\"error\">Подключение к базе данных сервера не произошло из-за ".get_error(1)."</span>";
		
		return $result;
	}
	
	function save_to_server($server_data, $text_success)
	{
		global $db_vars, $server_db_vars, $message, $sql;
		
		$result = false;
		
		$errors  = array();
		$queries = array();
		$texts   = array();
		
		$sql = "";
		$link = mysql_connect($server_db_vars["server_db_host"], $server_db_vars["server_db_user"], $server_db_vars["server_db_pass"]);
		if ($link)
		{
			$sql = "";
			if (mysql_select_db($server_db_vars["server_db_base"], $link))
			{
				$sql = "set names 'utf8'";
				if (mysql_query($sql, $link))
				{
					$count = 0;
					$sucesses = "";
					foreach ($server_data as $data)
					{
						// Сначала проверяем на существование записи
						if (strpos($data["sql"], "UPDATE") !== false) // "UPDATE `settings` SET `value`='".addslashes($value)."' WHERE `name`='$name'"
						{
							$sql_check = str_replace("UPDATE", "SELECT * FROM", $data["sql"]);
							$sql_check = preg_replace('#SET.*?WHERE#ms', "WHERE", $sql_check);
						}
						elseif (strpos($data["sql"], "DELETE") !== false) // "DELETE FROM `blocks` WHERE `id`=$block_id"
						{
							$sql_check = str_replace("DELETE", "SELECT *", $data["sql"]);
						}
						
						$query_check = mysql_query($sql_check, $link);
						if ($query_check !== false)
						{
							$rows_check = mysql_num_rows($query_check);
							
							if ($rows_check == 1)
							{
								// Затем выполняем сам запрос
								mysql_query($data["sql"], $link);
								if (mysql_affected_rows($link) == 1)
								{
									$count++;
									$sucesses .= "<span class=\"success\">{$data["success"]}</span>";
								}
								else
								{
									$errors[]  = mysql_error($link);
									$queries[] = $data["sql"];
									$texts[]   = $data["error"];
								}
							}
							
							if ($rows_check == 0)
							{
								if (isset($data["sql_insert"]) && ($data["sql_insert"] != ""))
								{
									// Если такой строковой константы не найдено, создаём её на сервере
									mysql_query($data["sql_insert"], $link);
									if (mysql_affected_rows($link) == 1)
									{
										$count++;
										$sucesses .= "<span class=\"success\">{$data["info"]}</span>";
									}
									else
									{
										$errors[]  = mysql_error($link);
										$queries[] = $data["sql"];
										$texts[]   = $data["error"];
									}
								}
								else
								{
									$count++;
									$message .= "<span class=\"info\">{$data["info"]}</span>";
								}
							}
						}
						else
						{
							$errors[]  = mysql_error($link);
							$queries[] = $sql_check;
							$texts[]   = "Запрос на существование записи в базе данных сервера не выполнен из-за";
						}
					}
					if ($count > 0) 
					{
						if ($count == count($server_data))
							$result = true;
						if ($count <= 3)
							$message .= $sucesses;
						else
							$message .= "<span class=\"success\">$text_success</span>";
					}
				}
				else
				{
					$errors[]  = mysql_error($link);
					$queries[] = $sql;
					$texts[]   = "Установка кодировки базы данных сервера не произошла из-за";
				}
			}
			else
			{
				$errors[]  = mysql_error($link);
				$queries[] = $sql;
				$texts[]   = "Выбор базы данных на сервере не произошёл из-за";
			}
			
			mysql_close($link);
			
			// Снова подключаемся к клиентской базе данных
			$sql = "";
			if (mysql_connect($db_vars["db_host"], $db_vars["db_user"], $db_vars["db_pass"], false, 2))
			{
				$sql = "";
				if (mysql_select_db($db_vars["db_base"]))
				{
					$sql = "set names 'utf8'";
					if (mysql_query($sql))
					{
						if (count($errors) > 0)
						{
							foreach ($errors as $index => $error)
								$message .= "<span class=\"error\">{$texts[$index]} ".get_error_sql($error, $queries[$index])."</span>";
						}
					}
					else
						$message .= "<span class=\"error\">Установка кодировки базы данных сайта не произошла из-за ".get_error(1)."</span>";
				}
				else
					$message .= "<span class=\"error\">Выбор базы данных сайта не произошёл из-за ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Подключение к базе данных сайта не произошло из-за ".get_error(1)."</span>";
		}
		else
			$message .= "<span class=\"error\">Подключение к базе данных сервера не произошло из-за ".get_error(1)."</span>";
		
		return $result;
	}

	function create_strings_on_server($block_code, $block_file)
	{
		global $message, $sql;

		if (preg_match_all('#\{\$string\-([0-9]{1,10})\}#ims', $block_code, $matches) > 0)
		{
			$unique_matches = array_unique($matches[1]);
		
			$data = array();
			$server_data = array();
			foreach ($unique_matches as $id)
			{
				$sql = "SELECT * FROM `strings` WHERE `id`=$id";
				$query_string = mysql_query($sql);
				if ($query_string && ($string = mysql_fetch_array($query_string)))
				{
					array_splice($data, 0);
					$data["sql"]     = "UPDATE `strings` SET `title`='".addslashes($string["title"])."', `content`='".addslashes($string["content"])."' WHERE `id`=$id";
					$data["sql_insert"] = "INSERT INTO `strings`(`id`,`title`,`content`) VALUES ($id, '".addslashes($string["title"])."', '".addslashes($string["content"])."')";
					$data["success"] = "Строковая константа string-$id успешно изменена на сервере";
					$data["error"]   = "Строковая константа string-$id не сохранена на сервере из-за";
					$data["info"]    = "Строковая константа string-$id успешно создана на сервере";
					
					$server_data[] = $data;
				}
				else
				{
					if ($query_string === false)
						$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе строковой константы string-$id</span>";
					else
						$message .= "<span class=\"error\">Строковая константа string-$id не найдена в базе данных</span>";
				}
			}
			save_to_server($server_data, "Строковые константы успешно сохранены на сервере");
		}
	}
		
	function put_file_on_server($file, $local_file, $is_new = false)
	{
		global $server_ftp_vars, $prototypes_path, $message;
		
		$dir = str_replace(ROOT, "", $prototypes_path);
		
		$result = false;
		
		$conn_id = ftp_connect($server_ftp_vars["server_ftp_server"]);
		if ($conn_id !== false)
		{
			if (ftp_login($conn_id, $server_ftp_vars["server_ftp_user"], $server_ftp_vars["server_ftp_pass"]))
			{
				$is_error = false;
				ftp_pasv($conn_id, true); // пассивный режим включен
				if (ftp_chdir($conn_id, $server_ftp_vars["server_ftp_folder"].$dir))
				{
					$files_list = ftp_nlist($conn_id, ".");
					if ($files_list !== false)
					{
						$is_exists = in_array($file, $files_list);
						
						if (($is_new && !$is_exists) || (!$is_new && $is_exists))
						{
							if (ftp_put($conn_id, $file, $local_file, FTP_ASCII)) // ftp_put overwrites existing file
							{
								$result = true;
								ftp_chmod($conn_id, 0777, $file);
							}
						}
						else
						{
							$is_error = true;
							if (!$is_new && !$is_exists)
								$message .= "<span class=\"error\">Файл $file не существует на сервере</span>";
							if ($is_new && $is_exists)
								$message .= "<span class=\"error\">Файл $file уже существует на сервере</span>";
						}
					}
				}
				
				if (!$result && !$is_error)
				{
					ftp_pasv($conn_id, false); // пассивный режим выключен
					if (ftp_chdir($conn_id, $server_ftp_vars["server_ftp_folder"].$dir))
					{
						$files_list = ftp_nlist($conn_id, ".");
						if ($files_list !== false)
						{
							$is_exists = in_array($file, $files_list);
							
							if (($is_new && !$is_exists) || (!$is_new && $is_exists))
							{
								if (ftp_put($conn_id, $file, $local_file, FTP_ASCII))
								{
									$result = true;
									if (ftp_chmod($conn_id, 0777, $file) === false)
										$message .= "<span class=\"error\">Полные права доступа к файлу $file на сервере не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
								}
								else
									$message .= "<span class=\"error\">Файл $file не сохранён на сервере из-за ".get_error(1)." передачи файла на ftp-сервер</span>";
							}
							else
							{
								if (!$is_new && !$is_exists)
									$message .= "<span class=\"error\">Файл $file не существует на сервере</span>";
								if ($is_new && $is_exists)
									$message .= "<span class=\"error\">Файл $file уже существует на сервере</span>";
							}
						}						
						else
							$message .= "<span class=\"error\">Файл $file не сохранён на сервере из-за ".get_error(1)." получения списка файлов на ftp-сервер</span>";
					}
					else
						$message .= "<span class=\"error\">Файл $file не сохранён на сервере из-за ".get_error(1)." смены директории на ftp-сервере</span>";
				}
			}
			else
				$message .= "<span class=\"error\">Файл $file не сохранён на сервере из-за ".get_error(1)." входа на ftp-сервер</span>";
			
			ftp_close($conn_id);
		}
		else
			$message .= "<span class=\"error\">Файл $file не сохранён на сервере из-за ".get_error(1)." соединения с ftp-сервером</span>";
		
		return $result;
	}
	
	function delete_file_on_server($file)
	{
		global $server_ftp_vars, $prototypes_path, $message;
		
		$dir = str_replace(ROOT, "", $prototypes_path);
		
		$conn_id = ftp_connect($server_ftp_vars["server_ftp_server"]);
		if ($conn_id !== false)
		{
			if (ftp_login($conn_id, $server_ftp_vars["server_ftp_user"], $server_ftp_vars["server_ftp_pass"]))
			{
				$is_success = false;
				$is_exists  = true;
				
				ftp_pasv($conn_id, true); // пассивный режим включен
				if (ftp_chdir($conn_id, $server_ftp_vars["server_ftp_folder"].$dir))
				{
					$files_list = ftp_nlist($conn_id, ".");
					if ($files_list !== false)
					{
						if (in_array($file, $files_list))
						{
							if (ftp_delete($conn_id, $file))
								$is_success = true;
						}
						else
							$is_exists = false;
					}
				}
				
				if (!$is_success && $is_exists)
				{
					ftp_pasv($conn_id, false); // пассивный режим выключен
					if (ftp_chdir($conn_id, $server_ftp_vars["server_ftp_folder"].$dir))
					{
						$files_list = ftp_nlist($conn_id, ".");
						if ($files_list !== false)
						{
							if (in_array($file, $files_list))
							{
								if (ftp_delete($conn_id, $file))
									$is_success = true;
								else
									$message .= "<span class=\"error\">Файл $file не удалён на сервере из-за ".get_error(1)." удаления файла на ftp-сервере</span>";
							}
							else
								$is_exists = false;
						}
						else
							$message .= "<span class=\"error\">Файл $file не удалён на сервере из-за ".get_error(1)." получения списка файлов на ftp-сервере</span>";
					}
					else
						$message .= "<span class=\"error\">Файл $file не удалён на сервере из-за ".get_error(1)." смены директории на ftp-сервере</span>";
				}
				
				if ($is_success)
					$message .= "<span class=\"success\">Файл $file успешно удалён на сервере</span>";
				if (!$is_exists)
					$message .= "<span class=\"info\">Файл $file не существует на сервере</span>";
			}
			else
				$message .= "<span class=\"error\">Файл $file не удалён на сервере из-за ".get_error(1)." входа на ftp-сервер</span>";
			
			ftp_close($conn_id);
		}
		else
			$message .= "<span class=\"error\">Файл $file не удалён на сервере из-за ".get_error(1)." соединения с ftp-сервером</span>";
	}
	
	function delete_css_on_server($css_title)
	{
		global $files_path, $message;
		
		$layouts = array();
		$layouts = get_layouts_prototypes("", true);
		if ($layouts !== false)
		{
			$count = 0;
			foreach ($layouts as $layout)
			{
				$blocks_csstext = $layout["blocks_csstext"];
				$file           = $layout["blocks_cssfile"];
				
				$count_replaces = 0;												
				$new_blocks_csstext = preg_replace('#\/\*'.$css_title.'\*\/.*?\/\*\/'.$css_title.'\*\/#ims', '', $blocks_csstext, -1, $count_replaces);
				
				if ( ($new_blocks_csstext !== null) && ($count_replaces == 1) )
				{
					// Помещаем новый текст во временный файл
					if (file_put_contents($files_path.$file, trim($new_blocks_csstext)) !== false)
					{
						if (put_file_on_server($file, $files_path.$file)) $count++;
						unlink($files_path.$file);
					}
					else
						$message .= "<span class=\"error\">Сss-правила блока-прототипа не удалены из файла стилей $file на сервере,<br />так как он не сохранён из-за ".get_error(1)."</span>";
				}
				else
					$message .= "<span class=\"error\">Сss-правила блока-прототипа не удалены из файла стилей $file на сервере,<br />так как метки блока $css_title не были найдены</span>";
			}
			if ($count == count($layouts))
				$message .= "<span class=\"success\">Сss-правила блока-прототипа успешно удалены из файлов стилей на сервере</span>";
		}
	}
	
	function replace_css_on_server($css_title)
	{
		global $files_path, $layouts, $message;
		
		$layouts_server = array();
		$layouts_server = get_layouts_prototypes($css_title, true);
		if ($layouts_server !== false)
		{
			$count_presents = 0;
			$count_changed  = 0;
			foreach ($layouts as $layout)
			{
				if ($layout["layout_server_id"] != "")
				{
					$count_presents++;
					$blocks_text = $layouts_server[$layout["layout_server_id"]]["blocks_csstext"];
					$block_text  = $layouts_server[$layout["layout_server_id"]]["block_csstext"];
					$file        = $layouts_server[$layout["layout_server_id"]]["blocks_cssfile"];
					$new_block_text = $layout["new_block_text"];
					
					if ($new_block_text != $block_text)
					{
						$count_replaces = 0;
						$new_blocks_text = preg_replace('#\/\*'.$css_title.'\*\/.*?\/\*\/'.$css_title.'\*\/#ims', '/*'.$css_title.'*/'."\n".$new_block_text."\n".'/*/'.$css_title.'*/', $blocks_text, -1, $count_replaces);
						if (($new_blocks_text != null) && ($count_replaces == 1))
						{
							// Помещаем новый текст во временный файл
							if (file_put_contents($files_path.$file, trim($new_blocks_text)) !== false)
							{
								if (put_file_on_server($file, $files_path.$file)) $count_changed++;
								unlink($files_path.$file);
							}
							else
								$message .= "<span class=\"error\">Сss-правила блока-прототипа не изменены в файле стилей $file на сервере,<br />так как файл стилей не сохранён из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Сss-правила блока-прототипа не изменены в файле стилей $file на сервере,<br />так как метки блока $css_title не найдены в файле стилей</span>";
					}
				}
			}
			if ( ($count_presents > 0) && ($count_presents == $count_changed) )
				$message .= "<span class=\"success\">Сss-правила блока-прототипа успешно сохранены в файлах стилей на сервере</span>";
		}
	}
	
	function add_css_on_server($css_code, $css_title)
	{
		global $files_path, $message;
		
		$layouts_server = array();
		$layouts_server = get_layouts_prototypes("", true);
		if ($layouts_server !== false)
		{
			$count = 0;
			foreach ($layouts_server as $layout)
			{
				$new_blocks_csstext = trim($layout["blocks_csstext"]) . "\n\n/*$css_title*/\n$css_code\n/*/$css_title*/";
				
				// Помещаем новый текст во временный файл
				$file = $layout["blocks_cssfile"];
				if (file_put_contents($files_path.$file, $new_blocks_csstext) !== false)
				{
					if (put_file_on_server($file, $files_path.$file)) $count++;
					unlink($files_path.$file);
				}
				else
					$message .= "<span class=\"error\">Сss-правила нового блока-прототипа не добавлены в файл стилей $file на сервере,<br />так как файл стилей не сохранён из-за ".get_error(1)."</span>";
			}
			if ($count == count($layouts_server))
				$message .= "<span class=\"success\">Сss-правила нового блока-прототипа успешно добавлены в файлы стилей на сервере</span>";
		}
	}
	
	function put_install_archives($ip, $ftp_server, $ftp_folder, $ftp_user, $ftp_pass, $forbidden_full_rights)
	{
		global $install_path, $extract_script, $chmod_script, $install_archive, $message;
		
		$result = false;
		
		$conn_id = ftp_connect($ftp_server);
		
		if ($conn_id === false) $conn_id = ftp_connect($ip);
		
		if ($conn_id !== false)
		{
			if (ftp_login($conn_id, $ftp_user, $ftp_pass))
			{
				ftp_pasv($conn_id, true); // пассивный режим включен
				if (ftp_chdir($conn_id, $ftp_folder))
				{
					$is_chmod    = ftp_put($conn_id, $chmod_script, $install_path.$chmod_script, FTP_BINARY);
					$is_extract  = ftp_put($conn_id, $extract_script, $install_path.$extract_script, FTP_BINARY);
					$is_archive  = ftp_put($conn_id, $install_archive, $install_path.$install_archive, FTP_BINARY);
					
					if ($is_chmod && $is_extract && $is_archive)
					{
						$result = true;
						
						// На некоторых хостингах запрещён запуск PHP-скриптов, имеющих права 777, например, на сайте vtp63.ru
						if ($forbidden_full_rights == "false")
						{
							ftp_chmod($conn_id, 0777, $chmod_script);
							ftp_chmod($conn_id, 0777, $extract_script);
							ftp_chmod($conn_id, 0777, $install_archive);
						}
					}
				}
				
				if (!$result)
				{
					ftp_pasv($conn_id, false); // пассивный режим выключен
					if (ftp_chdir($conn_id, $ftp_folder))
					{
						$is_chmod    = ftp_put($conn_id, $chmod_script, $install_path.$chmod_script, FTP_BINARY);
						$is_extract  = ftp_put($conn_id, $extract_script, $install_path.$extract_script, FTP_BINARY);
						$is_archive  = ftp_put($conn_id, $install_archive, $install_path.$install_archive, FTP_BINARY);
						
						if ($is_chmod && $is_extract && $is_archive)
						{
							$result = true;
							
							if ($forbidden_full_rights == "false")
							{
								if (ftp_chmod($conn_id, 0777, $chmod_script) === false)
									$message .= "<span class=\"error\">Полные права доступа к скрипту $chmod_script не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
								if (ftp_chmod($conn_id, 0777, $extract_script) === false)
									$message .= "<span class=\"error\">Полные права доступа к скрипту $extract_script не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
								if (ftp_chmod($conn_id, 0777, $install_archive) === false)
									$message .= "<span class=\"error\">Полные права доступа к архиву $install_archive не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
							}
						}
						else
							$message .= "<span class=\"error\">Установочные файлы не закачаны на сайт из-за ".get_error(1)." функции передачи на ftp-сервер</span>";
					}
					else
						$message .= "<span class=\"error\">Установочные файлы не закачаны на сайт из-за ".get_error(1)." смены директории на ftp-сервере ($ftp_folder)</span>";
				}
			}
			else
				$message .= "<span class=\"error\">Установочные файлы не закачаны на сайт из-за ".get_error(1)." входа на ftp-сервер ($ftp_user)</span>";
			
			ftp_close($conn_id);
		}
		else
			$message .= "<span class=\"error\">Установочные файлы не закачаны на сайт из-за ".get_error(1)." соединения с ftp-сервером ($ftp_server)</span>";
		
		return $result;
	}
	
	function set_full_rights($ip, $ftp_server, $ftp_folder, $ftp_user, $ftp_pass)
	{
		global $message;
		
		$result = false;
		
		$conn_id = ftp_connect($ftp_server);
		
		if ($conn_id === false) $conn_id = ftp_connect($ip);
		
		if ($conn_id !== false)
		{
			if (ftp_login($conn_id, $ftp_user, $ftp_pass))
			{
				ftp_pasv($conn_id, true); // пассивный режим включен
				if (ftp_chdir($conn_id, $ftp_folder))
				{
					if ( (ftp_chmod($conn_id, 0777, "main/smarty/cache/") !== false) && 
					     (ftp_chmod($conn_id, 0777, "main/smarty/compiled/") !== false)
                       )
						$result = true;
				}
				
				if (!$result)
				{
					ftp_pasv($conn_id, false); // пассивный режим выключен
					if (ftp_chdir($conn_id, $ftp_folder))
					{
						$result = true;
						
						if (ftp_chmod($conn_id, 0777, "main/smarty/cache/") === false)
							$message .= "<span class=\"error\">Полные права доступа к папке main/smarty/cache/ не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
						if (ftp_chmod($conn_id, 0777, "main/smarty/compiled/") === false)
							$message .= "<span class=\"error\">Полные права доступа к скрипту main/smarty/compiled/ не установлены из-за ".get_error(1)." функции на ftp-сервере</span>";
					}
					else
						$message .= "<span class=\"error\">Полные права на папки Смарти cache и compiled не установлены из-за ".get_error(1)." смены директории на ftp-сервере ($ftp_folder)</span>";
				}
			}
			else
				$message .= "<span class=\"error\">Полные права на папки Смарти cache и compiled не установлены из-за ".get_error(1)." входа на ftp-сервер ($ftp_user)</span>";
			
			ftp_close($conn_id);
		}
		else
			$message .= "<span class=\"error\">Полные права на папки Смарти cache и compiled не установлены из-за ".get_error(1)." соединения с ftp-сервером ($ftp_server)</span>";
		
		return $result;
	}
	
	function mysql_query_multiple($site_name, $db_host, $db_name, $db_user, $db_pass, $sql_text, $is_show_success = false)
	{
		global $message;
		
		$result = false;
		
		$link = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		if ($link)
		{
			if (@mysqli_set_charset($link, "utf8"))
			{
				// Returns false if the first statement failed. 
				// To retrieve subsequent errors from other statements you have to call mysqli_next_result() first. 
				if (@mysqli_multi_query($link, $sql_text))
				{
					// $mysqli->next_result() will return false if it runs out of statements OR if the next statement has an error
					$i = 1;
					do {
						$i++;
					} while (mysqli_more_results($link) && mysqli_next_result($link));
					
					$error_no = mysqli_errno($link);
					if ($error_no != 0)
						$message .= "<span class=\"error\">Произошла ошибка при выполнении запроса №$i к базе данных сайта $site_name: ".mysqli_error($link)." (код: $error_no)<br /></span>";
					else
					{
						if ($is_show_success)
							$message .= "<span class=\"success\">SQL-запрос к базе данных сайта $site_name выполнен успешно</span>";
						$result = true;
					}
				}
				else
					$message .= "<span class=\"error\">Произошла ошибка при выполнении первого запроса к базе данных сайта $site_name: ".mysqli_error($link)." (код: ".mysqli_errno($link).")<br /></span>";
			}
			else
				$message .= "<span class=\"error\">Произошла ошибка при установке кодировки в базе данных сайта $site_name: ".mysqli_error($link)." (код: ".mysqli_errno($link).")</span>";
			
			if (!@mysqli_close($link))
				$message .= "<span class=\"info\">Произошла ошибка при закрытии соединения с базой данных сайта $site_name: ".mysqli_error($link)." (код: ".mysqli_errno($link).")</span>";
		}
		else
			$message .= "<span class=\"error\">Произошла ошибка при подключении к базе данных сайта $site_name: ".mysqli_connect_error()." (код: ".mysqli_connect_errno().")</span>";
		
		return $result;
	}
	
	function add_directory_to_zip($path, $folder)
	{
		global $install_path, $install_archive, $message;
		
		$result = true;
		
		if (extension_loaded('zip'))
		{
			$zip = new ZipArchive();
			$res = $zip->open($install_path.$install_archive);
			if ($res === true)
			{
				if ($zip->addEmptyDir($folder))
				{
					$source = $path.$folder."/";
					$source = str_replace('\\', '/', realpath($source));
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file)
					{
						if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))	continue; // Ignore "." and ".." folders
						
						$file = str_replace('\\', '/', realpath($file));
						$new = str_replace($path, "", $file);
						if (is_dir($file))
						{
							if (!$zip->addEmptyDir($new))
							{
								$result = false;
								$message .= "<span class=\"error\">Произошла ошибка при добавлении в установочный архив пустого каталога: $new</span>";
							}
						}
						elseif (is_file($file))
						{
							if (!$zip->addFromString($new, file_get_contents($file))) 
							{
								$result = false;
								$message .= "<span class=\"error\">Произошла ошибка при добавлении в установочный архив файла: $new</span>";
							}
						}
					}
				}
				else
				{
					$result = false;
					$message .= "<span class=\"error\">Произошла ошибка при добавлении в установочный архив пустого каталога: $folder</span>";
				}
				
				$zip->close();
			}
			else
			{
				switch ($res)
				{
					case ZipArchive::ER_EXISTS: $err = "файл уже существует"; break;
					case ZipArchive::ER_INCONS: $err = "несовместимый zip архив"; break;
					case ZipArchive::ER_MEMORY: $err = "ошибка выделения памяти"; break;
					case ZipArchive::ER_NOENT: 	$err = "файл не найден"; break;
					case ZipArchive::ER_NOZIP: 	$err = "файл не является zip архивом"; break;
					case ZipArchive::ER_OPEN: 	$err = "невозможно открыть файл"; break;
					case ZipArchive::ER_READ: 	$err = "ошибка чтения файла"; break;
					case ZipArchive::ER_SEEK:	$err = "ошибка поиска в файле"; break;
					default: 					$err = "неизвестная ошибка"; break;
				}
				
				$result = false;
				$message .= "<span class=\"error\">Произошла ошибка при открытии установочного архива для добавления файлов: $err</span>";
			}
			
			unset($zip);
		}
		else
		{
			$result = false;
			$message .= "<span class=\"error\">Добавление файлов в установочный архив невозможно, так как не установлено расширение php 'zip'</span>";
		}
		
		return $result;
	}
	
	function add_file_to_zip($files)
	{
		global $install_path, $install_archive, $message;
		
		$result = false;
		
		if (extension_loaded('zip'))
		{
			$zip = new ZipArchive();
			
			$res = $zip->open($install_path.$install_archive);
			if ($res === true)
			{
				$count = 0;
				foreach ($files as $file)
				{
					if ($zip->addFile($file["source"], $file["archive"]))
						$count++;
					else
						$message .= "<span class=\"error\">Файл {$file["archive"]} не добавлен в установочный архив из-за ".get_error(1)."</span>";
				}
				if (($count > 0) && ($count == count($files)))
					$result = true;
				
				$zip->close();
			}
			else
			{
				switch ($res)
				{
					case ZipArchive::ER_EXISTS: $err = "файл уже существует"; break;
					case ZipArchive::ER_INCONS: $err = "несовместимый zip архив"; break;
					case ZipArchive::ER_MEMORY: $err = "ошибка выделения памяти"; break;
					case ZipArchive::ER_NOENT: 	$err = "файл не найден"; break;
					case ZipArchive::ER_NOZIP: 	$err = "файл не является zip архивом"; break;
					case ZipArchive::ER_OPEN: 	$err = "невозможно открыть файл"; break;
					case ZipArchive::ER_READ: 	$err = "ошибка чтения файла"; break;
					case ZipArchive::ER_SEEK:	$err = "ошибка поиска в файле"; break;
					default: 					$err = "неизвестная ошибка"; break;
				}
				
				$message .= "<span class=\"error\">Произошла ошибка при открытии установочного архива для добавления файлов: $err</span>";
			}
			
			unset($zip);
		}
		else
			$message .= "<span class=\"error\">Добавление файлов в установочный архив невозможно, так как не установлено расширение php 'zip'</span>";
		
		return $result;
	}
	
	function get_sql($table_name, $where)
	{
		global $message, $sql;
		
		$result = "";
		
		$sql = "SELECT `COLUMN_NAME`, `DATA_TYPE` FROM `information_schema`.`COLUMNS` WHERE `TABLE_NAME` = '$table_name'";
		$query_columns = mysql_query($sql);
		if ($query_columns !== false)
		{
			// INSERT INTO `blocks` (`id`, `template_id`, `page_id`, `title`, `sort`, `description`, `file`, `status`) VALUES
			// (1, 0, 0, 'Шапка', 1, 'Логотип, телефон, УТП1', 'header.tpl', 2),
			// (2, 0, 0, 'Навигация', 2, 'Блок навигации для ссылок на доп. страницы', 'navigation.tpl', 2),
			// (3, 0, 0, 'Наши продукты, услуги', 3, 'Подробнее о продуктах, услугах', 'products.tpl', 2),
			
			$columns_type = array();
			$columns_name = array();
			$columns_count = mysql_num_rows($query_columns);
			while ($column = mysql_fetch_array($query_columns))
			{
				$columns_type[] = $column["DATA_TYPE"];
				$columns_name[] = "`" . $column["COLUMN_NAME"] . "`";
			}
			
			$sql = "SELECT * FROM `$table_name` WHERE $where";
			$query_rows = mysql_query($sql);
			if ($query_rows && (mysql_num_rows($query_rows) > 0))
			{
				$j = 0;
				$result = "INSERT INTO `$table_name` (".implode(",", $columns_name).") VALUES ";
				while ($row = mysql_fetch_row($query_rows))
				{
					$values = "";
					for ($i = 0; $i < $columns_count; $i++)
					{
						if ($columns_type[$i] == "varchar")
							$value = "'" . str_replace("'", "''", $row[$i] ). "'";
						else
							$value = $row[$i];
						
						if ($values != "")
							$values .= ",$value";
						else
							$values .= $value;
					}
					$values = "($values)";
					
					if ($j > 0)
						$result .= ", " . $values;
					else
						$result .= $values;
					$j++;
				}
				$result .= "; ";
			}
			else
			{
				if ($query_rows === false)
					$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе строк таблицы $table_name</span>";
				elseif ($table_name != "mirrors")
					$message .= "<span class=\"info\">Таблица $table_name не имеет строк, относящихся к выбранному шаблону</span>";
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе столбцов таблицы $table_name</span>";
		
		return $result; 		
	}
	
	function create_user($login, $pass, $name, $email)
	{
		global $sql, $message;
		
		$result = 0;
		
		if (preg_match("#^[a-z0-9\_\-]+$#ims", $login) == 1)
		{
			$sql = "SELECT `id` FROM `users` WHERE `login`='$login'";
			$query = mysql_query($sql);
			$row = mysql_fetch_array($query);
			if ($row === false)
			{
				if (preg_match("#^[a-zа-яё0-9\_\-\s]+$#imsu", $name) == 1)
				{
					if (strlen($pass) >= 6)
					{
						if (preg_match("#^[a-z0-9\_\-]+$#ims", $pass) == 1)
						{
							if (filter_var($email, FILTER_VALIDATE_EMAIL))
							{
								$pass_md5 = md5($pass);
								
								$sql = "INSERT INTO `users`(`login`, `pass`, `name`, `email`) VALUES ('$login', '$pass_md5', '$name', '$email')";
								$res = mysql_query($sql);
								if ( ($res !== false) && (mysql_affected_rows() == 1) )
								{
									$result = mysql_insert_id();
									
									$company_name = "Сайт " . SITE;
									$sql = "SELECT `value` FROM `settings` WHERE `name`='company_name'";
									$query = mysql_query($sql);
									if ($query && ($row = mysql_fetch_array($query)))
										$company_name = str_replace('"', '\"', $row["value"]);
									else
										$message .= "<span class=\"info\">В таблице настроек не найдено свойство «Название компании» (company_name) из-за ".get_error(1)."</span>";
									
									$text_email = "С уважением, сайт " . SITE;
									$sql = "SELECT `value` FROM `settings` WHERE `name`='text_email'";
									$query = mysql_query($sql);
									if ($query && ($row = mysql_fetch_array($query)))
										$text_email = $row["value"];
									else
										$message .= "<span class=\"info\">В таблице настроек не найдено свойство «Подпись для писем» (text_email) из-за ".get_error(1)."</span>";
									
									$message .= "<span class=\"success\">Новый пользователь успешно добавлен</span>";
									
									$subject  = "Данные для входа в Конструктор лендингов LandKit";
									$subject  = "=?UTF-8?B?" . base64_encode($subject) . "?=";
									
									$company_name = "=?UTF-8?B?" . base64_encode($company_name) . "?=";
									
									$headers = "Content-Type: text/html; charset=\"utf-8\"\r\n";
									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "From: $company_name <info@".str_replace("www.", "", strtolower(SITE)).">\r\n";
									
									$text  = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head>\r\n";
									$text .= "<body style=\"font-size: 14px; font-family: Georgia, serif; background: Snow;\">\r\n";
									$text .= "<span style=\"font-weight: bold; color: #4b73ba;\">Данные для входа</span><br /><br />\r\n";
									$text .= "Логин: $login<br />Пароль: $pass<br /><br />\r\n";
									$text .= "Вход в панель управления: http://".SITE."/main/index.php<br /><br />\r\n";
									$text .= "$text_email\r\n";
									$text .= "</body></html>";
									
									if (mail($email, $subject, $text, $headers))
										$message .= "<span class=\"success\">Новому пользователю отправлено письмо с данными доступа</span>";
									else
										$message .= "<span class=\"error\">Новому пользователю не отправлено письмо с данными доступа из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Новый пользователь не добавлен из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Введён некорректный email</span>";
						}
						else
							$message .= "<span class=\"error\">Пароль может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
					}
					else
						$message .= "<span class=\"error\">Длина пароля должна быть 6 или более символов</span>";
				}
				else
					$message .= "<span class=\"error\">Имя может состоять из латинских и русских букв, цифр, тире и знака подчёркивания</span>";
			}
			else
				$message .= "<span class=\"error\">Пользователь с логином $login уже существует</span>";
		}
		else
			$message .= "<span class=\"error\">Логин может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
		
		return $result;
	}
	
	function ftp_update_file($site, $ip, $ftp_server, $ftp_root, $ftp_user, $ftp_pass, $files)
	{
		global $message;
		
		$conn_id = ftp_connect($ftp_server);
		
		if ($conn_id === false) $conn_id = ftp_connect($ip);
		
		if ($conn_id !== false)
		{
			if (ftp_login($conn_id, $ftp_user, $ftp_pass))
			{
				// Пассивный режим включен. В пассивном режиме передача данных инициируется клиентом, а не сервером. 
				// Данный режим может понадобиться в случае, если клиент находится за файерволлом.
				ftp_pasv($conn_id, true);
				
				if (ftp_chdir($conn_id, $ftp_root))
				{
					$count = 0;
					foreach ($files as $file)
					{
						if (ftp_put($conn_id, ltrim($file["dir"], "/").$file["name"], ROOT.$file["dir"].$file["name"], FTP_ASCII)) // ftp_put overwrites existing file
							$count++;
						else
							$message .= "<span class=\"error\">Файл {$file["name"]} не закачан на сайт $site из-за ".get_error(1)." функции загрузки (".ROOT.$file["dir"].$file["name"].")</span>";
					}
					if ($count == count($files))
						$message .= "<span class=\"success\">Указанные файлы успешно обновлены на сайте $site</span>";
					
					// Очищение папки скомпилированных шаблонов
					$path_compiled = "main/smarty/compiled/";
					$files_compiled = ftp_nlist($conn_id, $path_compiled);
					$count = 0;
					foreach ($files_compiled as $file_compiled)
					{
						if (stripos($file_compiled, $path_compiled) === false)
							$file_compiled = $path_compiled . $file_compiled;
						
						if ( ($file_compiled != $path_compiled . ".") && ($file_compiled != $path_compiled . "..") )
						{
							if (ftp_delete($conn_id, $file_compiled))
								$count++;
							else
								$message .= "<span class=\"error\">Скомпилированный шаблон $file_compiled не удалён на сайте $site из-за ".get_error(1)." функции удаления</span>";
						}
					}
					//if ($count == (count($files_compiled) - 2))
						//$message .= "<span class=\"success\">Папка скомпилированных шаблонов успешно очищена на сайте $site</span>";
				}
				else
					$message .= "<span class=\"error\">Файлы не закачаны на сайт $site из-за ".get_error(1)." смены директории ($ftp_root)</span>";
			}
			else
				$message .= "<span class=\"error\">Файлы не закачаны на сайт $site из-за ".get_error(1)." входа на ftp-сервер ($ftp_user)</span>";
			
			ftp_close($conn_id);
		}
		else
			$message .= "<span class=\"error\">Файлы не закачаны на сайт $site из-за ".get_error(1)." соединения с ftp-сервером ($ftp_server)</span>";
	}
	
	function set_template_paths($template_catalog)
	{
		global $template_path, $blocks_path, $styles_path, $images_path;
		
		$template_path = ROOT.$template_catalog."/";
		$blocks_path   = ROOT.$template_catalog."/blocks/";
		$styles_path   = ROOT.$template_catalog."/styles/";
		$images_path   = ROOT.$template_catalog."/images/";
	}
?>