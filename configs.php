<?php
	/*=============================================
		DEFINES
	=============================================*/
	
	define(HOST, 'localhost');
	define(USER, 'root');
	define(PASS, '');
	
	$con = mysql_connect(HOST, USER, PASS) or die (mysql_error());
?>