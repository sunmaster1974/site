<?php
#########################################
# LandKit: Скрипт конструктора лендингов 
# Copyright (c) by WebVertex             
# http://www.webvertex.ru                
#########################################
	
	require "smarty/Smarty.class.php";
	
	class LandingSmarty extends Smarty
	{
	   function __construct()
	   {
			parent::__construct();
			
			$this->setTemplateDir("smarty/templates");
			$this->setConfigDir("smarty/config");
			$this->setPluginsDir("smarty/plugins");
			$this->setCompileDir("smarty/compiled");
			$this->setCacheDir("smarty/cache");
			
			$this->force_compile = false;
			$this->caching = false;
			$this->compile_check = false;
	    }
	}
	
	$smarty = new LandingSmarty;
?>