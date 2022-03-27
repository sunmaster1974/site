<?php
	session_start();
	$ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "";
	if (!isset($_SESSION["referrer"]))
		$_SESSION["referrer"] = $ref;
?>