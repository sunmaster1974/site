<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	if (!isset($_GET["type"])) $_GET["type"] = "all";
	
	if (isset($_GET["action"]))
	{
		// Переместить изображение
		if ($_GET["action"] == "move_file")
		{
			$count_strings = 0;
			if (isset($_GET["name"]) && ($_GET["name"] != ""))
			{
				if ( ($_GET["name"] != "null") && ($_GET["name"] != "no_folders") )
				{
					if (isset($_GET["file"]) && ($_GET["file"] != ""))
					{
						if (isset($_GET["folder"]) && ($_GET["folder"] != ""))
						{
							$old_folder = ($_GET["folder"] == "images") ? $images_path : $images_path.$_GET["folder"]."/";
							$new_folder = ($_GET["name"]   == "images") ? $images_path : $images_path.$_GET["name"]."/";
							
							if (!file_exists($new_folder.$_GET["file"]))
							{
								if (rename($old_folder.$_GET["file"], $new_folder.$_GET["file"]))
								{
									$message .= "<span class=\"success\">Файл {$_GET["file"]} успешно перемещён в папку «{$_GET["name"]}»</span>";
									rename_strings($old_folder.$_GET["file"], $new_folder.$_GET["file"], true);
								}
								else
									$message .= "<span class=\"error\">Файл {$_GET["file"]} не перемещён из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">В папке «{$_GET["name"]}» уже существует файл {$_GET["file"]}</span>";
						}
						else
							$message .= "<span class=\"error\">Отсутствует название прежней папки файла для перемещения</span>";
					}
					else
						$message .= "<span class=\"error\">Отсутствует название файла для перемещения</span>";
				}
				else
					$message .= "<span class=\"error\">Отсутствует папка для перемещения</span>";
			}
			else
				$message .= "<span class=\"error\">Отсутствует название папки для перемещения</span>";
			
			if ($count_strings > 0)
				$message .= "<span class=\"success\">Строковые константы с этим файлом успешно изменены ($count_strings)</span>";
		}
		
		// Удалить изображение
		if ($_GET["action"] == "delete_file")
		{
			if (isset($_GET["file"]) && ($_GET["file"] != ""))
			{
				if (isset($_GET["folder"]) && ($_GET["folder"] != ""))
				{
					if ($_GET["folder"] == "images")
						$folder = $images_path;
					elseif ($_GET["folder"] == "files")
						$folder = $files_path;
					else
						$folder = $images_path.$_GET["folder"]."/";
					
					if (file_exists($folder.$_GET["file"]))
					{
						if ($_GET["folder"] != "files")
							$blocks_titles = get_blocks_strings($template_id, $folder.$_GET["file"]);
						else
							$blocks_titles = "";
						
						if ($blocks_titles == "")
						{
							if (unlink($folder.$_GET["file"]))
								$message .= "<span class=\"success\">Файл {$_GET["file"]} успешно удалён</span>";
							else
								$message .= "<span class=\"error\">Файл {$_GET["file"]} не удалён из-за ".get_error(1)."</span>";
						}
						else
							$message .= "<span class=\"error\">Файл {$_GET["file"]} не может быть удалён,<br />так как используется в строковой константе в блоке(ах): $blocks_titles</span>";
					}
					else
						$message .= "<span class=\"error\">Файл {$_GET["file"]} не существует в папке «{$_GET["folder"]}»</span>";
				}
				else
					$message .= "<span class=\"error\">Отсутствует название папки файла для удаления</span>";
			}
			else
				$message .= "<span class=\"error\">Отсутствует название файла для удаления</span>";
		}
		
		// Создать папку
		if ($_GET["action"] == "create_folder")
		{
			$new_folder = trim($_GET["name"]);
			
			if ($new_folder != "")
			{
				if (preg_match("#^[a-z0-9\_\-]+$#ims", $new_folder) == 1)
				{
					if ($new_folder != "images")
					{
						if ($new_folder != "files")
						{
							$catalogs = list_dir($images_path);
							
							if (!in_array($new_folder, $catalogs))
							{
								$message .= create_dir($template_catalog."/images/", $new_folder);
								if (strpos($message, '"success"') !== false)
									$_GET["type"] = $new_folder;
							}
							else
								$message .= "<span class=\"error\">Папка с названием «{$new_folder}» уже существует</span>";
						}
						else
							$message .= "<span class=\"error\">Папка не может иметь зарезервированное название «files»</span>";
					}
					else
						$message .= "<span class=\"error\">Папка не может иметь зарезервированное название «images»</span>";
				}
				else
					$message .= "<span class=\"error\">Название папки может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
			}
			else
				$message .= "<span class=\"error\">Название папки не может быть пустым</span>";
		}
		
		// Удалить папку
		if ($_GET["action"] == "delete_folder")
		{
			$blocks_titles = get_dir_strings($images_path.$_GET["type"]);
			
			if ($blocks_titles == "")
			{
				if (remove_dir($images_path.$_GET["type"]))
				{
					$message .= "<span class=\"success\">Папка «{$_GET["type"]}» успешно удалена</span>";
					$_GET["type"] = "all";
				}
				else
					$message .= "<span class=\"error\">В процессе удаления папки «{$_GET["type"]}» произошли ".get_error(1)."</span>";
			}
			else
				$message .= "<span class=\"error\">Папка {$_GET["type"]} не может быть удалена,<br />так как содержит изображения, которые используются в виде строковой константы в блоках: $blocks_titles</span>";
		}
		
		// Переименовать папку
		if ($_GET["action"] == "rename_folder")
		{
			$new_folder = trim($_GET["name"]);
			$old_folder = $_GET["type"];
			
			$count_strings = 0;
			
			if ($new_folder != "")
			{
				if ($new_folder != "images")
				{
					if ($new_folder != "files")
					{
						if (preg_match("#^[a-z0-9\_\-]+$#ims", $new_folder) == 1)
						{
							$catalogs = list_dir($images_path);
							if (!in_array($new_folder, $catalogs))
							{
								if (rename($images_path.$old_folder, $images_path.$new_folder))
								{
									$_GET["type"] = $new_folder;
									$message .= "<span class=\"success\">Папка «{$old_folder}» успешно переименована в «{$new_folder}»</span>";
									rename_strings($images_path.$old_folder, $images_path.$new_folder, false);
								}
								else
									$message .= "<span class=\"error\">Папка «{$old_folder}» не переименована из-за ".get_error(1)."</span>";
							}
							else
								$message .= "<span class=\"error\">Папка с названием «{$new_folder}» уже существует</span>";
						}
						else
							$message .= "<span class=\"error\">Название папки может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
					}
					else
						$message .= "<span class=\"error\">Папка не может иметь зарезервированное название «files»</span>";
				}
				else
					$message .= "<span class=\"error\">Папка не может иметь зарезервированное название «images»</span>";
			}
			else
				$message .= "<span class=\"error\">Название папки не может быть пустым</span>";
				
			if ($count_strings > 0)
				$message .= "<span class=\"success\">Строковые константы с этой папкой успешно изменены ($count_strings)</span>";
		}
	}
	
	// Загрузить изображение
	if (isset($_FILES["uploadfile"]))
	{
		if ($_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK)
		{
			if ($_GET["type"] == "images")
				$folder = $images_path;
			elseif ($_GET["type"] == "files")
				$folder = $files_path;
			else
				$folder = $images_path.$_GET["type"]."/";
			
			$parts = pathinfo($_FILES["uploadfile"]["name"]);
			$parts["filename"] = translit_name($parts["filename"]);
			$name = $parts["filename"] . "." . $parts["extension"];
			
			$i = 0;
			while (file_exists($folder.$name))
			{
				$i++;
				$name = $parts["filename"]."-".$i.".".$parts["extension"];
			}
			
			if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $folder.$name))
				$message .= "<span class=\"success\">Файл успешно загружен</span>";
			else
				$message .= "<span class=\"error\">Файл не загружен из-за ".get_error(1)." перемещения</span>";
		}
		else
			$message .= "<span class=\"error\">Файл не загружен из-за ".get_error(1)." загрузки</span>";
	}
	
	// Сохранить имена изображений
	if (isset($_POST["save_names"]))
	{
		$count = 0;
		$count_strings = 0;
		
		if ($_GET["type"] == "images")
			$folder = $images_path;
		elseif ($_GET["type"] == "files")
			$folder = $files_path;
		else
			$folder = $images_path.$_GET["type"]."/";
		
		$images_files = list_file($folder, true, "", "");
		foreach ($_POST as $id => $new_name)
		{
			if ($id != "save_names")
			{
				$id = preg_replace('#\D#ims', '', $id);
				if (trim($new_name) != "")
				{
					if (preg_match('#^[a-z0-9\-\_]+\.[a-z0-9]+$#ims', $new_name) == 1)
					{
						$parts_new = pathinfo($new_name);
						$parts_old = pathinfo($images_files[$id]);
						if (strtolower($parts_new["filename"]) != strtolower($parts_old["filename"]))
						{
							if (!in_array($new_name, $images_files))
							{
								if (strtolower($parts_new["extension"]) == strtolower($parts_old["extension"]))
								{
									if (rename($folder.$images_files[$id], $folder.$new_name))
									{
										$count++;
										if ($_GET["type"] != "files")
											rename_strings($folder.$images_files[$id], $folder.$new_name, true);
									}
									else
										$message .= "<span class=\"error\">Файл {$images_files[$id]} не был переименован из-за ".get_error(1)."</span>";
								}
								else
									$message .= "<span class=\"error\">Новое расширение файла {$images_files[$id]} не совпадает со старым</span>";
							}
							else
								$message .= "<span class=\"error\">Файл с названием $new_name уже существует в папке «{$_GET["type"]}»</span>";
						}
						else
							$count++;
					}
					else
						$message .= "<span class=\"error\">Название файла может состоять из латинских букв, цифр, тире и знака подчёркивания</span>";
				}
				else
					$message .= "<span class=\"error\">Название файла {$images_files[$id]} не может быть пустым</span>";
			}
		}
		
		if ( ($count > 0) && ($count == (count($_POST) - 1)) )
			$message .= "<span class=\"success\">Названия файлов успешно сохранены</span>";
		
		if ($count_strings > 0)
			$message .= "<span class=\"success\">Строковые константы с переименованными изображениями успешно изменены ($count_strings)</span>";
	}
	
	$images = array();
	
	$dirs = list_dir($images_path);
	
	// Добавить файлы из папки files в корне сайта
	if ( ($_GET["type"] == "files") || ($_GET["type"] == "all") )
	{
		$other_files = list_file($files_path, true, "", "");
		foreach ($other_files as $index => $file)
		{
			$row = array();
			$row["id"] 	   = $index;
			$row["file"]   = $file;
			$row["folder"] = "files";
			$row["url"]    = "http://" . SITE . "/files/" . $file;
			$row["time"]   = date("d.m.Y H:i:s", filemtime($files_path.$file));
			
			$parts = pathinfo($file);
			$ext = strtolower($parts["extension"]);
			if ( ($ext != "jpg") && ($ext != "jpeg") && ($ext != "gif") && ($ext != "bmp") && ($ext != "png") && ($ext != "jp2") && ($ext != "tiff") && ($ext != "tif") && ($ext != "ico") && ($ext != "wbmp") )
				$row["src"] = "http://" . SITE . "/main/styles/file_icon.png";
			else
				$row["src"] = $row["url"];
			
			$images[] = $row;
		}
	}
	
	if ($_GET["type"] == "all")
	{
		$images_files = list_file($images_path, true, "", "db");
		foreach ($images_files as $index => $file)
		{
			$row = array();
			$row["id"] 	   = $index;
			$row["file"]   = $file;
			$row["folder"] = "images";
			$row["url"]    = $template_catalog."/images/" . $file;
			$row["src"]    = $row["url"];
			$row["time"]   = date("d.m.Y H:i:s", filemtime($images_path.$file));
			
			$images[] = $row;
		}
		
		foreach ($dirs as $dir)
		{
			$images_files = list_file($images_path.$dir."/", true, "", "db");
			foreach ($images_files as $index => $file)
			{
				$row = array();
				$row["id"] 	   = $index;
				$row["file"]   = $file;
				$row["folder"] = $dir;
				$row["url"]    = $template_catalog."/images/".$dir."/".$file;
				$row["src"]    = $row["url"];
				$row["time"]   = date("d.m.Y H:i:s", filemtime($images_path.$dir."/".$file));
				
				$images[] = $row;
			}
		}
	}
	elseif ($_GET["type"] != "files")
	{
		$catalog = ($_GET["type"] == "images") ? "" : $_GET["type"]."/";
		
		$images_files = list_file($images_path.$catalog, true, "", "db");
		foreach ($images_files as $index => $file)
		{
			$row = array();
			$row["id"] 	   = $index;
			$row["file"]   = $file;
			$row["folder"] = ($_GET["type"] == "images") ? "images" : $_GET["type"];
			$row["url"]    = $template_catalog."/images/".$catalog.$file;
			$row["src"]    = $row["url"];
			$row["time"]   = date("d.m.Y H:i:s", filemtime($images_path.$catalog.$file));
			
			$images[] = $row;
		}
	}
	
	// Создание списка папок для перемещения
	$catalogs = array();
	foreach ($dirs as $dir)
	{
		$catalog = array();
		$catalog["name"]  = $dir;
		$catalog["title"] = (strlen($dir) > 13) ? substr($dir, 0, 12)."..." : $dir;
		
		$catalogs[] = $catalog;
	}
	
	if ($_GET["type"] != "images")
	{
		$catalog = array();
		$catalog["name"]  = "images";
		$catalog["title"] = "images";
		
		$catalogs[] = $catalog;
	}
	
	$smarty->assign("images", $images);
	$smarty->assign("catalogs", $catalogs);
?>