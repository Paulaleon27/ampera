<?php
session_start();
	include ("conexion.php");
	$validar_cc = $_POST['validar_cc'];
	$id = pg_query("SELECT * FROM tab_personas WHERE id_persona = '$validar_cc';");
	$rows_id = pg_num_rows($id);
	$datos_pers = pg_fetch_array($id);
	if($rows_id != 0){
		echo "<script language='javascript'>
				alert('La persona con ".$datos_pers['id_persona']."-".$datos_pers['digito_v']." ya está registrada');
				window.location.href='../f_compra.php';
			  </script>";
		$_SESSION["ccnit"] = $validar_cc; 
		$_SESSION["dig"] = $datos_pers['digito_v'];
	} else {
		echo "<script language='javascript'>
				alert('La persona con ".$validar_cc." no está registrada');
					window.location.href='../registro_pers.php';
			  </script>";
		
		$_SESSION["validar_cc"] = $validar_cc; 
		$_SESSION["dig"] = $datos_pers['digito_v'];
	}
?>