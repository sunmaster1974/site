<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "all";
	
	// Создание формы
if ($_GET["type"] == "new")
{
	$is_right = true;
	if (isset($_POST["download_yes"]))
	{
		if (!isset($_POST["email_yes"]))
		{
			$is_right = false;
			$message .= "<span class=\"error\">Для поля \"Скачать файл\" необходимо также выбрать поле \"Email\"</span>";
		}
		if (!file_exists($files_path . $_POST["download_file"]))
		{
			$is_right = false;
			$message .= "<span class=\"error\">Для поля \"Скачать файл\" файл для скачивания должен существовать: $files_path{$_POST["download_file"]}</span>";
		}
	}
		
	if ($is_right)
	{
		$form_title = isset($_POST["form_yes"]) ? $_POST["form_title"] : "Новая форма";
		$form_code  = "";
		$form_css   = "";
		
		$is_bootstrap = isset($_POST["bootstrap_yes"]);
		
		$form_modal = "0";
		$form_link  = "";
		$attr_display = 'style="display: block;"';
		
		$form_class = trim($_POST["form_class"]);
		$link_class = trim($_POST["link_class"]);
		
		if (isset($_POST["link_yes"]))
		{
			$form_modal = "1";
			
			$link_title = trim($_POST["link_title"]);
			
			if ($is_bootstrap)
			{
				$form_link = "<a href=\"#myModal\" class=\"$link_class\" data-toggle=\"modal\">$link_title</a>\n";
				
				$modal_title = isset($_POST["form_yes"]) && isset($_POST["window_yes"]) ? "\n\t\t\t\t<div class=\"modal-title $form_class\">$form_title</div>" : "";
				
				$form_code .= <<<EOB
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&nbsp;x&nbsp;</button>$modal_title
			</div>
			
			<div class="modal-body">\n\n
EOB;
			}
			else
			{
				$attr_title = isset($_POST["form_yes"]) && isset($_POST["window_yes"]) ? " title=\"$form_title\"" : "";
				$form_link  = "<a href=\"#div_contact\" class=\"modalbox $link_class\"$attr_title>$link_title</a>\n";
				$attr_display = 'style="display: none;"';
			}
		}
		
		$form_code .= "<div id=\"div_contact\" $attr_display>\n";
		$form_code .= "\t<form id=\"user_contact\" name=\"user_contact\" action=\"#\" method=\"post\">\n";
		
		if (!isset($_POST["link_yes"]) && isset($_POST["form_yes"]) && isset($_POST["site_yes"]))
		{
			$attr_class = ($form_class != "") ? " class=\"$form_class\"" : "";
			$form_code .= "\t<div$attr_class>$form_title</div>\n\n";
		}
		
		create_field("name");
		create_field("email");
		create_field("phone");
		create_field("message");
		create_field("download");
		create_field("file");
		
		// Настройки скрытых полей формы
		if (isset($_POST["form_yes"]) && isset($_POST["letter_yes"]))
			$form_code .= "\t" . '<input type="hidden" name="form_name" value="'.$form_title.'" />' . "\n";
		
		if (isset($_POST["time_yes"]))
			$form_code .= "\t" . '<input type="hidden" name="user_time" value="yes" />' . "\n";
		
		if (isset($_POST["agent_yes"]))
			$form_code .= "\t" . '<input type="hidden" name="user_agent" value="yes" />' . "\n";
		
		if (isset($_POST["ip_yes"]))
			$form_code .= "\t" . '<input type="hidden" name="user_ip" value="yes" />' . "\n";
		
		if (isset($_POST["referrer_yes"]))
			$form_code .= "\t" . '<input type="hidden" name="user_referrer" value="yes" />' . "\n";
		
		// Настройки кнопки "Отправить"
		$attr_submit_value   = (trim($_POST["send_title"]) != "") ? trim($_POST["send_title"]) : "Отправить";
		$submit_class        = trim($_POST["send_class"]);
		$attr_submit_class   = ($submit_class != "") ? " class=\"$submit_class\"" : "";
		$onclick_code        = str_replace("\"", "'", trim($_POST["send_onclick"]));
		$attr_submit_onclick = ($onclick_code != "") ? " onclick=\"$onclick_code\"" : "";
		
		if ($is_bootstrap)
			$form_code .= "\n\t<button type=\"button\" id=\"user_send\" name=\"user_send\"$attr_submit_class$attr_submit_onclick>$attr_submit_value</button>";
		else
			$form_code .= "\n\t<input type=\"button\" id=\"user_send\" name=\"user_send\"$attr_submit_class$attr_submit_onclick value=\"$attr_submit_value\" />";
			
		// Уверение в конфиденциальности
		$conf_text  = "";
		$conf_title = trim($_POST["conf_title"]);
		$conf_class = trim($_POST["conf_class"]);
		if (isset($_POST["conf_yes"]))
		{
			$attr_conf_class = ($conf_class != "") ? " class=\"$conf_class\"" : "";
			
			if ($is_bootstrap)
			{
				$conf_text = <<<EOB
				
				
			<div class="modal-footer">
				<div$attr_conf_class>$conf_title</div>
			</div>
EOB;
			}
			else
				$form_code .= "\n\t<div$attr_conf_class>$conf_title</div>";
		}
		
		$form_code .= <<<EOB

	</form>
</div> <!-- #div_contact -->\n
EOB;

		if (isset($_POST["link_yes"]) && $is_bootstrap)
		{
			$form_code .= <<<EOB
			
			</div>$conf_text
			
		</div> <!-- .modal-content -->
	</div> <!-- .modal-dialog -->
</div> <!-- .modal -->\n
EOB;
		}

		// Внесение css-правил
		if (!$is_bootstrap)
		{
			if ($link_class != "")
				$form_css .= "\t.$link_class {\n\t}\n";
			
			if ($form_class != "")
				$form_css .= "\t.$form_class {\n\t}\n";
			
			if ($submit_class != "")
				$form_css .= "\t.$submit_class {\n\t}\n";
			
			if ($conf_class != "")
				$form_css .= "\t.$conf_class {\n\t}\n";
		}
		
		$sql = "INSERT INTO `forms` (`title`, `modal`, `link`, `html`, `css`) VALUES ('" . addslashes($form_title) . "', $form_modal, '" . addslashes($form_link) . "', '" . addslashes($form_code) . "', '" . addslashes($form_css) . "')";
		$res = mysql_query($sql);
		if ($res && (mysql_affected_rows() == 1))
		{
			$form_id = mysql_insert_id();
			
			$_GET["type"] = $form_id;
			$_SESSION["page_forms"][$form_id] = $form_title;
			
			$message .= "<span class=\"success\">Новая форма успешно создана</span>";
		}
		else
		{
			$_GET["type"] = "all";
			$message .= "<span class=\"error\">Новая форма не создана из-за ".get_error(1)."</span>";
		}
	}
	else
		$_GET["type"] = "all";
}
	
	if ($_GET["type"] != "all") $_GET["id"] = $_GET["type"];
	
	if (isset($_GET["id"]) && ($_GET["id"] != ""))
	{
		$id = trim($_GET["id"]);

		$sql = "SELECT * FROM `forms` WHERE `id`=$id";
		$query_form = mysql_query($sql);
		if ($query_form && ($form = mysql_fetch_array($query_form)))
		{
			// Изменить модальность формы
			if (isset($_GET["action"]) && ($_GET["action"] == "change_modal"))
			{
				if (strpos($form["html"], "modal-dialog") === false)
				{
					$new_modal = ($form["modal"] == "1") ? "0" : "1";
					if ($new_modal == "1")
					{
						$new_link = '<a class="modalbox form_link" href="#div_contact" title="Оставить заявку">Оставить заявку</a>';
						$new_html = str_replace('<div id="div_contact" style="display: block;">', '<div id="div_contact" style="display: none;">', $form["html"]);
					}
					
					if ($new_modal == "0")
					{
						$new_link = "";
						$new_html = str_replace('<div id="div_contact" style="display: none;">', '<div id="div_contact" style="display: block;">', $form["html"]);
					}
					
					$sql = "UPDATE `forms` SET `modal`=$new_modal,`link`='$new_link',`html`='".addslashes($new_html)."' WHERE `id`=$id";
					mysql_query($sql);
					if (mysql_affected_rows() == 1)
					{
						$message .= "<span class=\"success\">Модальность формы «{$form["title"]}» успешно изменена</span>";
						
						$form["modal"] = $new_modal;
						$form["link"]  = $new_link;
						$form["html"]  = $new_html;
					}
					else
						$message .= "<span class=\"error\">Модальность формы «{$form["title"]}» не изменена из-за ".get_error(1)."</span>";
				}
				else
					$message .= "<span class=\"info\">Модальность формы, написанной с помощью фреймворка Twitter Bootstrap, возможно изменить только вручную в коде формы</span>";
			}
			
			// Изменить видимость формы
			if (isset($_GET["action"]) && ($_GET["action"] == "change_status"))
			{
				if ($form["status"] == "1")
				{
					$new_status = "0";
					$new_action = "выключена";
				}
				else
				{
					$new_status = "1";
					$new_action = "включена";
				}
				
				$sql = "UPDATE `forms` SET `status`=$new_status WHERE `id`=$id";
				mysql_query($sql);
				if (mysql_affected_rows() == 1)
				{
					$form["status"] = $new_status;
					$message .= "<span class=\"success\">Форма «{$form["title"]}» успешно $new_action</span>";
				}
				else
					$message .= "<span class=\"error\">Форма «{$form["title"]}» не $new_action из-за ".get_error(1)."</span>";
			}
			
			// Сохранить форму
			if (isset($_POST["save_form"]))
			{
				$count = 0;
				$count_changes = 0;
				foreach ($_POST as $name => $value)
				{
					if ($name != "save_form")
					{
						if ($form[$name] != $value)
						{
							$sql = "UPDATE `forms` SET `$name`='".addslashes(rtrim($value))."' WHERE `id`=$id";
							$res = mysql_query($sql);
							if ($res && (mysql_affected_rows() == 1))
							{
								$form[$name] = $value;
								
								if ($name == "title") $_SESSION["page_forms"][$id] = $value;
								
								$count_changes++;
								$count++;
							}
							else
								$message .= "<span class=\"error\">Поле формы $name не сохранено из-за ".get_error(1)."</span>";
						}
						else
							$count++;
					}
				}
				
				if (($count_changes > 0) && ($count == count($_POST) - 1))
					$message .= "<span class=\"success\">Данные формы успешно сохранены</span>";
			}
			
			// Удалить форму
			if (isset($_GET["action"]) && ($_GET["action"] == "delete"))
			{
				$sql = "DELETE FROM `forms` WHERE `id`=$id";
				$res = mysql_query($sql);
				if ($res && (mysql_affected_rows() == 1))
				{
					$_GET["type"] = "all";
					
					unset($_SESSION["page_forms"][$id]);
					
					mysql_query("DELETE FROM `counters` WHERE `form_id`=$id");
					$message .= "<span class=\"success\">Форма «{$form["title"]}» успешно удалена</span>";
				}
				else
					$message .= "<span class=\"error\">Форма «{$form["title"]}» не удалена из-за ".get_error(1)."</span>";
			}
			
			if ($_GET["type"] != "all")
			{
				$form["link"]    = htmlspecialchars($form["link"]);
				$form["html"]    = htmlspecialchars($form["html"]);
				$form["css"]     = htmlspecialchars($form["css"]);
				$form["caption"] = (mb_strlen($form["title"], "UTF-8") > 13) ? mb_substr($form["title"], 0, 12, "UTF-8")."..." : $form["title"];
				
				$smarty->assign("form", $form);
			}
		}
		else
		{
			$_GET["type"] = "all";
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе формы с id=$id</span>";
		}
	}
	elseif (isset($_GET["action"]) || isset($_POST["form_action"]))
	{
		$_GET["type"] = "all";
		$message .= "<span class=\"error\">Отсутствует идентификатор формы</span>";
	}
	
	if ($_GET["type"] == "all")
	{
		$forms = array();
		$sql = "SELECT * FROM `forms`";
		$query_forms = mysql_query($sql);
		if ($query_forms)
		{
			while ($form = mysql_fetch_array($query_forms))
			{
				$form["html"] 	 = htmlspecialchars($form["html"]);
				$form["css"]  	 = htmlspecialchars($form["css"]);
				$form["caption"] = (mb_strlen($form["title"], "UTF-8") > 13) ? mb_substr($form["title"], 0, 12, "UTF-8")."..." : $form["title"];
				
				$forms[] = $form;
			}
		}
		else
			$message .= "<span class=\"error\">Произошла ".get_error(0)." при запросе списка форм</span>";
		
		$smarty->assign("forms", $forms);
	}
?>