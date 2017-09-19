<?php

	function getConnect()
	{
		$connect = mysql_connect("127.0.0.1","root","root") or die("Unale to connect"); 
		//$connect = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die("Unale to connect"); 	
		mysql_select_db("jasontang") or die("Unable to select database!");
		//mysql_select_db(SAE_MYSQL_DB,$connect) or die("Unable to select database!");
		mysql_query("set character_set_results=utf8");
		mysql_query("SET NAMES UTF8");

		date_default_timezone_set('Asia/Shanghai');
		
		return $connect;
	}
	
?>