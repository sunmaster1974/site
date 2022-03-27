<?php
	header('Content-Type: text/html; charset=utf-8');
	
	require "blocks.php";
	
	if (isset($_GET["block"]))
	{
		$block_name = trim($_GET["block"]);
		$block_file = $block_name . ".txt";
		$block_code = "<div class='listitemblock' data-url='/item.php?block=$block_name'>";
		
		if (file_exists($blocks_path.$block_file))
		{
			$text = file_get_contents($blocks_path.$block_file);
			if ($text !== false)
			{
				$text = str_replace("\r", "", $text);
				$text = str_replace("\n", "", $text);
				$text = str_replace("\t", "", $text);
				$text = str_replace('\\', '\\\\', $text);
				$text = str_replace('"', '\"', $text);
				
				$block_code .= $text;
			}
			else
				$block_code .= "Код блока не получен из файла $block_file";
		}
		else
			$block_code .= "Файл блока $block_file не найден";
		
		$block_code .= "</div>";
		
		$json = '{"next_data_url": "'.$blocks[$block_name]["next_data_url"].'", "prev_data_url": "'.$blocks[$block_name]["prev_data_url"].'", "script": "'.$blocks[$block_name]["script"].'", "response": "'.$block_code.'"}';
	}
	else
		$json = '{"next_data_url": "", "prev_data_url": "", "response": "В запросе отсутствует параметр block"}';
	
	echo $json;
?>