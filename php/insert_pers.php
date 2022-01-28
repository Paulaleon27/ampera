<?php
	/*INCIO SESSION PARA MANTENER LOS DATOS RECOGIDOS*/
	session_start();
	/*TOMO DATOS DEL FORMULARIO DE REGISTRO PERSONAS Y LOS GUARDO EN VARIABLES*/
	$ccnit 			= $_POST['wid'];
	$dig 			= $_POST['wdig'];
	$nombre 		= $_POST['wnom'];
	$direccion 		= $_POST['wdir'];
	$pais			= $_POST['wpais'];
	$departamento	= $_POST['wdepartamento'];
	$ciudad			= $_POST['wciudad'];
	$cel 			= $_POST['wcel'];
	$tel 			= $_POST['wtel'];
	$mail 			= $_POST['wmail'];
	$tipo 			= $_POST['tipo'];
	$tipo1 			= $_POST['tipo1'];
	/*TOMO EL VALOR DEL BOTON SELECCIONADO EN EL MODAL*/
	$boton 			= $_POST['validar'];
	echo $boton;
	/*CONDICIONO SEGÚN EL BOTÓN SELECCIONADO*/
	/*SI ES NULL QUE ABRA EL MODAL Y ALMACENE LOS DATOS EN VARIABLES DE SESSION*/
	if($boton == NULL) {
		$_SESSION['ccnit'] 			= $ccnit;
		$_SESSION['dig'] 			= $dig;
		$_SESSION['nombre'] 		= $nombre;
		$_SESSION['direccion'] 		= $direccion;
		$_SESSION['pais']			= $pais;
		$_SESSION['departamento']	= $departamento;
		$_SESSION['ciudad']			= $ciudad;
		$_SESSION['cel'] 			= $cel;
		$_SESSION['tel'] 			= $tel;
		$_SESSION['mail'] 			= $mail;
		$_SESSION['tipo'] 			= $tipo;
		$_SESSION['tipo1'] 			= $tipo1;
		echo "<script language='javascript'> 
						window.location.href='../registro_pers.php#openmodal1';
				  </script>";
		/*VALIDAMOS EL VALOR DEL BOTON SELECCIONADO*/
		/*SI ES 1 O 2 ENTONCES QUE REGISTRE*/
	} else if ($boton == 1 OR $boton == 2) {
				include ("conexion.php");
				/*	$ccnit = $_POST['wid'];
					$dig = $_POST['wdig'];
					$nombre = $_POST['wnom'];
					$direccion = $_POST['wdir'];
					$ciudad	= $_POST['wciu'];
					$cel = $_POST['wcel'];
					$tel = $_POST['wtel'];
					$mail = $_POST['wmail'];
					$tipo = $_POST['tipo'];*/
					/*CREO VARIABLES Y GUARDO LOS DATOS ALMACENADOS EN LA SESION*/
					$ccnit 			= $_SESSION['ccnit'];
					$dig 			= $_SESSION['dig'];
					$nombre 		= $_SESSION['nombre'];
					$direccion 		= $_SESSION['direccion'];
					$pais 			= $_SESSION['pais'];
					$departamento 	= $_SESSION['departamento'];
					$ciudad 		= $_SESSION['ciudad'];
					$cel 			= $_SESSION['cel'];
					$tel 			= $_SESSION['tel'];
					$mail 			= $_SESSION['mail'];
					$tipo 			= $_SESSION['tipo'];
					$tipo1 			= $_SESSION['tipo1'];
					/*QUERY PARA VALIDAR SI ESTÁ REGISTRADO O NO*/
					$validar = pg_query("SELECT * FROM tab_personas WHERE id_persona = '$ccnit' AND digito_v = '$dig';");
					/*CUENTA LAS LINEAS ENCONTRADAS CON EL QUERY*/
					$validar1 = pg_num_rows($validar);
					/*CONDICIÓN QUE VALIDA SI EXISTE O NO EN LA BASE DE DATOS*/
					/*SI EL QUERY TOMÓ UNA O MÁS LÍNEAS EXISTE EN LA BASE DE DATOS*/
					/*SI NO, NO EXISTE Y PROCEDEMOS A HACER EL REGISTRO*/
					if($validar1 != 0){
						echo "<script language='javascript'> 
									alert('El usuario ".$ccnit."-".$dig." ya existe');
									window.location.href='../registro_pers.php';
							  </script>";
					} else {
						/*COMPARAMOS Y CONVERTIMOS EL VALOS BOOLEAN*/
						/*PARA SI EL VALOR TOMADO ES CLIENTE ENTONCES ES VERDADERO(TRUE)*/
						/*PARA SI EL VALOR TOMADO ES PROVEEDOR ENTONCES ES FALSO(FALSE)*/
						if($tipo == "cliente"){
							$ind_pers =  "TRUE";
						} else {
							$ind_pers = "FALSE";
						}
						if($tipo1 == "persona"){
							$ind_pers1 =  "TRUE";
						} else {
							$ind_pers1 = "FALSE";
						}
						/*VALIDAMOS EL CELULAR Y EL TELÉFONO*/
						/*SI NO ESCRIBIÓ ALGUNO DE LOS DOS*/
						/*ENTONCES INSERTAMOS UN CERO EN LA BASE DE DATOS*/
						if($cel==NULL){
		 					$cel = 0;
						}
						if($tel==NULL){
							$tel = 0;
						} 
						if($mail==NULL){
							$mail = "";
						}
						/*MIRAMOS EL CONSECUTIVO DE LA TABLA*/
						$consec = pg_query("SELECT MAX(id_consec) as maximo FROM tab_personas;");
						$consec1 = pg_fetch_assoc($consec);
						$consec2 = $consec1['maximo'];
						if($consec2 == NULL){
							$consec2 = 1;
						} else {
							$consec2 = $consec2 + 1;
						}
						/*HACEMOS UN QUERY PARA INSERTAR A LA PERSONA EN LA BASE DE DATOS*/
						$query = "INSERT INTO tab_personas VALUES($consec2,$ccnit,$dig,$pais,$departamento,$ciudad,'$nombre','$direccion',$cel,$tel,'$mail',$ind_pers,$ind_pers1,'N/A');";
						/*EJECUTAMOS EL QUERY PARA INSERTARLO*/
						$query1 = pg_query($query);
						/*VALIDAMOS REDIRECCIONES DE SI SE REALIZA EL REGISTRO O NO*/
						if($query1){
							echo "<script language='javascript'> 
										alert('El registro fue exitoso');
								  </script>";
								  /*window.location.href='../f_venta.php';*/
								/*SI EL VALOR DEL BOTON ES 2 QUE REGISTRE Y GENERE LA FACTURA CON LOS DATOS RECOJIDOS*/
								 if ($boton == 2) {
										echo "<script language='javascript'>
													alert('Generando factura venta');
													window.location.href='../f_venta.php';
												</script>";
								/*SI EL VALOR DEL BOTON ES 1 QUE REGISTRE Y REDIRIJA AL FORMULARIO REGISTRO PERSONAS*/
								} elseif ($boton == 1) {
										echo "<script language='javascript'>
													alert('Redireccionando a registro personas');
													window.location.href='../registro_pers.php';
												</script>";
								}
						/*MENSAJE DE FALLO DEL REGISTRO*/
						} else {
							echo "<script language='javascript'> 
										alert('No se pudo registrar');
										window.location.href='../registro_pers.php';
							  	</script>";/**/
							  	/*window.location.href='../registro_pers.php';*/
						}
					}
			/*} elseif ($boton == 2) {
					echo "<script language='javascript'> 
								alert('Redireccionando a factura venta');
								window.location.href='../f_venta.php';
							</script>";*/
				/*BOTON DE CANCELAR CON EL QUE BORRAMOS DATOS DE LA SESION*/
				/*Y REDIRIGIMOS DE NUEVO AL REGISTRO PERSONAS*/
				} elseif ($boton == 3) {
					session_destroy();
					echo "<script language='javascript'> 
								alert('Se ha cancelado el registro');
								window.location.href='../registro_pers.php';
							</script>";
						}
?>