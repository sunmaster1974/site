<?php
	header("content-type: text/html; charset=utf-8");
	
	function translit_name($str)
	{
		$rus = array("а","б","в","г","д","е","ё" ,"ж" ,"з","ы","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц", "ч", "ш", "щ",  "ъ","ь","э","ю" ,"я");
		$lat = array("a","b","v","g","d","e","yo","zh","z","y","i","y","k","l","m","n","o","p","r","s","t","u","f","h","ts","ch","sh","sch","" ,"" ,"e","yu","ya");
		
		$result = mb_strtolower(html_entity_decode($str, ENT_QUOTES), "utf-8");
		$result = preg_replace("/[^0-9a-z]/", "-", str_replace($rus, $lat, $result));
		$result = str_replace("--", "-", $result);
		
		return $result;
	}

	if ($_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK)
	{
		$file_size = intval($_GET["size"]);
		$upload_dir = $_SERVER["DOCUMENT_ROOT"]."/files/";
		
		if($_FILES["uploadfile"]["size"] <= 1024*$file_size*1024)
		{
			$name = $_FILES["uploadfile"]["name"];
			
			$parts = pathinfo($name);
			$parts["filename"] = translit_name($parts["filename"]);
			$name = $parts["filename"] . "." . $parts["extension"];
			
			$i = 0;
			while (file_exists($upload_dir . $name))
			{
				$i++;
				$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
			}
	  
			if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $upload_dir . $name))
				echo "success";
			else
				echo "<ошибка перемещения файла>";
		}
	    else
			echo "<ошибка размера файла ($file_size мб)>";
	}
	else
		echo "<ошибка загрузки файла>";
?>