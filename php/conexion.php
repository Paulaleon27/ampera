<?php
	$conexion="host='127.0.0.1' port='5432' dbname='db_ampera' user='root' password='root'";
	$postgres=pg_connect($conexion) or die("Error de conexion a la BD o al servidor... Revise bien.". pg_last_error());
?>