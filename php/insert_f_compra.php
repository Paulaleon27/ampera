<?php
	include("conexion.php");
	$consec = pg_query("SELECT MAX(id_consec) as maximo FROM tab_compras;");
	$consec1 = pg_fetch_assoc($consec);
	$consec2 = $consec1['maximo'];
	if($consec2 == NULL){
		$consec2 = 1;
	} else {
		$consec2 = $consec2 + 1;
	}

	$ind_bat_n 			= $_POST['ind_bat_n'];
	$ind_bat_r 			= $_POST['ind_bat_r'];

	/*---------------------------------------------------*/
	$fecha_elaboracion 	= $_POST['fecha_elaboracion'];
	$fecha_vencimiento 	= $_POST['fecha_vencimiento'];
	$cedula_nit 		= $_POST['cedula_nit'];
	$tel_cliente 		= $_POST['tel_cliente'];
	$num_factura 		= $_POST['num_factura'];
	$dir_cliente 		= $_POST['dir_cliente'];
	$for_pago 			= $_POST['for_pago'];
	$valor_descuento	= $_POST['valor_descuento'];
	$val_sub_total	= $_POST['val_sub_total'];
	$val_iva	= $_POST['val_iva'];
	$val_total	= $_POST['val_total'];
	/*echo "fecha_elaboracion = ".$fecha_elaboracion;
	echo "<br>fecha_vencimiento = ".$fecha_vencimiento;
	echo "<br>cedula_nit = ".$cedula_nit;
	echo "<br>tel_cliente = ".$tel_cliente;
	echo "<br>num_factura = ".$num_factura;
	echo "<br>dir_cliente = ".$dir_cliente;
	echo "<br>for_pago = ".$for_pago;
	echo "<br>valor_descuento = ".$valor_descuento;
	echo "<br>val_sub_total = ".$val_sub_total;
	echo "<br>val_iva = ".$val_iva;
	echo "<br>val_total = ".$val_total;*/
	/*---------------------------------------------------*/
	$ejec_select_dig_v = pg_query("SELECT digito_v FROM tab_personas WHERE id_persona = '$cedula_nit';");
	$datos_select_dig_v = pg_fetch_assoc($ejec_select_dig_v);
	$digito_v = $ejec_select_dig_v['digito_v'];
	/*---------------------------------------------------*/
	if ($ind_bat_n == "TRUE" && $ind_bat_r == "FALSE") {

		$canti_f 			= $_POST['canti_f'];
		$referencia_f 		= $_POST['referencia_f'];
		$precio_compra_f 	= $_POST['precio_compra_f'];
		$precio_venta_f 	= $_POST['precio_venta_f'];
		$val_total_f 		= $_POST['val_total_f'];
		echo "<br>ind_bat_n = ".$ind_bat_n ;

		$sql_select_ref_f = "SELECT * FROM tab_referencias WHERE id_referencia = '$referencia_f';";
		$ejec_select_ref_f = pg_query($sql_select_ref_f);
		$datos_select_ref_f = pg_fetch_array($ejec_select_ref_f);
		/*echo "ref: 1 - 2 - 3 ".$datos_select_ref_f['id_marca']." - ".$datos_select_ref_f['id_modelo']." - ".$datos_select_ref_f['id_referencia'];*/

		$sql_insert_bat_f = "INSERT INTO tab_compras VALUES($consec2,'$num_factura',".$datos_select_ref_f['id_marca'].",".$datos_select_ref_f['id_modelo'].",".$datos_select_ref_f['id_referencia'].",$cedula_nit,$digito_v,$ind_bat_n,FALSE,$ind_bat_r,$canti_f,'$fecha_elaboracion',$precio_compra_f,$precio_venta_f,$val_total_f,$valor_descuento);";
		//$ejec_insert_bat_f = pg_query($sql_insert_bat_f);

		/*echo "<br>canti_f = ".$canti_f ;
		echo "<br>referencia_f = ".$referencia_f ;
		echo "<br>precio_compra_f = ".$precio_compra_f;
		echo "<br>precio_venta_f = ".$precio_venta_f;
		echo "<br>val_total_f = ".$val_total_f;*/
	}elseif($ind_bat_r == "TRUE" && $ind_bat_n == "FALSE") {
		$cant_regalada 		= $_POST['cant_regalada'];
		$referencia_r 		= $_POST['referencia_r'];
		echo "<br>ind_bat_r = ".$ind_bat_r ;
		$sql_select_ref_r = "SELECT * FROM tab_referencias WHERE id_referencia = '$referencia_r';";
		$ejec_select_ref_r = pg_query($sql_select_ref_r);
		$datos_select_ref_r = pg_fetch_array($ejec_select_ref_r);
		/*echo "ref: 1 - 2 - 3 ".$datos_select_ref_r['id_marca']." - ".$datos_select_ref_r['id_modelo']." - ".$datos_select_ref_r['id_referencia'];*/

		$sql_insert_bat_r = "INSERT INTO tab_compras VALUES($consec2,'$num_factura',".$datos_select_ref_r['id_marca'].",".$datos_select_ref_r['id_modelo'].",".$datos_select_ref_r['id_referencia'].",$cedula_nit,$digito_v,$ind_bat_n,FALSE,$ind_bat_r,$cant_regalada,'$fecha_elaboracion',0,0,0,0);";
		//$ejec_insert_bat_r = pg_query($$sql_insert_bat_r);

		/*echo "<br>cant_regalada = ".$cant_regalada ;
		echo "<br>referencia_r = ".$referencia_r ;*/
	}
	/*---------------------------------------------------*/

?>