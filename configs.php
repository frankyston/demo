<?php
	/*=============================================
		DEFINES
	=============================================*/
	
	define(HOST, 'localhost');
	define(DB, 'd3mo');
	define(USER, 'root');
	define(PASS, '');
	
	$con = mysql_connect(HOST, USER, PASS) or die (mysql_error());
	$db = mysql_select_db(DB, $con);
?>