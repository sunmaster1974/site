<?php
	$db_vars["db_host"] = "localhost";
	$db_vars["db_base"] = "alshayx0_taxilar";
	$db_vars["db_user"] = "alshayx0_taxilar";
	$db_vars["db_pass"] = "EgL%8QeD";
	
	$ftp_vars["ftp_server"] = "alshayx0.beget.tech";
	$ftp_vars["ftp_folder"] = "/home/a/alshayx0/taxilargus.ru/public_html";
	$ftp_vars["ftp_user"]   = "alshayx0_dev";
	$ftp_vars["ftp_pass"]   = "%3saSwo0";
	
	$forbidden_full_rights = false;
	
	mysql_connect($db_vars["db_host"], $db_vars["db_user"], $db_vars["db_pass"], false, 2) or die(mysql_error());
	mysql_select_db($db_vars["db_base"]) or die(mysql_error());
	mysql_query("set names 'utf8'") or die(mysql_error());
?>