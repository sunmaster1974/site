<?php
	header("Content-type: text/html; charset=utf-8");
	
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
	define("SITE", trim($_SERVER["SERVER_NAME"], "/"));
	
	set_include_path(ROOT . "/main/");
	
	session_start();
	
	$db_vars  = array();
	$ftp_vars = array();
	
	require_once "init.php";
	require_once "smarty/config/connect.php";
	
	if (isset($_POST["logout_submit"]))
	{
		session_unset();
		session_destroy();
	}
	
	require "extra.php";
	
	if (!isset($_SESSION["is_login"]))
	{
		$is_login = "false";
		require "login.php";
	}
	
	if (isset($_SESSION["is_login"]) && ($_SESSION["is_login"] === true))
	{
		$is_login = "true";
		require "admin.php";
	}
	
	$smarty->assign("is_login", $is_login);
	
	$smarty->display("index.tpl");
?>