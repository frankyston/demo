<?php
	/*=============================================
		DEFINES
	=============================================*/
	
	define(HOST, 'localhost');
	define(USER, 'root');
	define(PASS, '');
	define(DB, 'd3mo');
	
	$con = mysql_connect(HOST, USER, PASS) or die (mysql_error());
	$db = mysql_select_db(DB, $con);
?>