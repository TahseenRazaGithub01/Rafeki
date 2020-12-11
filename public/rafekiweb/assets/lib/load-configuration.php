<?php
	error_reporting(E_ALL ^ (E_STRICT | E_NOTICE | E_WARNING));
	session_start();
	
	ini_set('default_charset', 'utf-8');
	ini_set('max_execution_time', 3600);
	ini_set('max_input_time', 3600);
	ini_set('memory_limit', '1024M');
	ini_set('upload_max_filesize', '999M');
	
	date_default_timezone_set('Asia/Riyadh');
	
	$path = $_SERVER['PHP_SELF'];
	$pageName = basename($path, ".php").".php";	
	$alreadyMember = false;
	$_CONF = array();
		

	$protocol = ($_SERVER['SERVER_PORT']=='80' || $_SERVER['SERVER_PORT']=='8080')?'http':'https';
	define("HOST",$protocol.'://'.$_SERVER['HTTP_HOST'].'/rafeki/');
?>