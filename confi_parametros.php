<?php
	session_start();
	if(isset($_SESSION['autenticado']) AND $_SESSION['autenticado']){
		$_SESSION['passwd'] = $pass;
	} else{
    //Si el usuario no está logueado redireccionamos al login.
    	header('Location: login/index.php');
    	exit;
 	}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Parámetros | Ampera</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops"/>
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" /> 
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/modal.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		
		<?php
			include("php/modal.php");
			include("php/menu_float.php");
			include("php/menu_float_confi.php");
			include ("php/conexion.php");
			$info_factura = pg_query("SELECT * FROM tab_parametros;");
			$info_factura1 = pg_fetch_array($info_factura);

			$info_pais = pg_query("SELECT * FROM tab_paises WHERE id_pais = ".$info_factura1['id_pais'].";");
			$info_pais1 = pg_fetch_array($info_pais);

			$info_departamento = pg_query("SELECT * FROM tab_departamentos WHERE id_departamento = ".$info_factura1['id_departamento'].";");
			$info_departamento1 = pg_fetch_array($info_departamento);

			$info_ciudad = pg_query("SELECT * FROM tab_ciudades WHERE id_ciudad = ".$info_factura1['id_ciudad']." AND id_departamento = ".$info_factura1['id_departamento'].";");
			$info_ciudad1 = pg_fetch_array($info_ciudad);
		?>

		<div class="container">	
			<!-- Codrops top bar -->
			<header>
				<h2>INFORMACIÓN DE LA EMPRESA</h2> 	
			</header>
			<div class="main clearfix">

				<form  name="registro" method="post" action="php/insert_pers.php">
				  <label><br>Año Actual:</label><br>
                  <input type="textarea" id="wano" name="wano" required="required" placeholder="" disabled="disabled" value="<?php echo $info_factura1['ano']; ?>" readonly />

                  <label><br>Nit:</label>
                  <input type="textarea" id="wnit" name="wnit" required="required" placeholder="Escribe el nit de tu empresa" value="<?php echo $info_factura1['nit_local']; ?>" /> 

                  <label><br>Nombre del Representante Legal:</label>
                  <input type="textarea" id="wnomd" name="wnomd"  required="required" placeholder="Escribe el nombre del representante legal" value="<?php echo $info_factura1['nom_dueno']; ?>">

                  <label><br>Dirección:</label>
                  <input type="textarea" id="wdir" name="wdir"  required="required" placeholder="Escribe la dirección de tu empresa" value="<?php echo $info_factura1['dir_local']; ?>">

                  <label><br>País:</label>
                  <select name="wpais" class="select1" required>
			        				<option>Selecciona..</option>
			        				<option selected><?php echo $info_pais1['nom_pais']; ?></option>
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_paises ORDER BY nom_pais ASC");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value=/".$row['id_pais']."\">".$row['nom_pais']." </option> \n";
			        					}
			        				?>
			        			</select>

                  <label>Departamento:</label>
                  <select name="wdepartamento" class="select1" required>
			        				<option>Selecciona..</option>
			        				<option selected><?php echo $info_departamento1['nom_departamento']; ?></option>
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_departamentos ORDER BY nom_departamento ASC");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value=/".$row['id_departamento']."\">".$row['nom_departamento']." </option> \n";
			        					}
			        				?>
			        			</select>	
                  
                  <label>Ciudad:</label>
                  <select name="wciudad" class="select1" required>
			        				<option>Selecciona..</option>
			        				<option selected><?php echo $info_ciudad1['nom_ciudad']; ?></option>
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_ciudades ORDER BY nom_ciudad ASC");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value=/".$row['id_ciudad']."\">".$row['nom_ciudad']." </option> \n";
			        					}
			        				?>
			        			</select>

                  <label><br>Teléfono:</label>
                   <input type="number" id="wtel" name="wtel" min="1111111" max="9999999" placeholder="Escribe el teléfono de tu empresa" value="<?php echo $info_factura1['tel_local']; ?>">

                  <label><br>Celular:</label>
                   <input type="number" id="wcel" name="wcel" min="1111111111" max="9999999999" placeholder="Escribe el celular de tu empresa" value="<?php echo $info_factura1['cel_local']; ?>">

                 <label><br>Lema:</label>
                  <input type="textarea" id="wdir" name="wdir"  required="required" placeholder="Escribe el lema de tu empresa" value="<?php echo $info_factura1['val_lema']; ?>">
                  <br>

                  <label><br>Nota:</label><br>
                  <textarea id="wnota" name="wnota" class="wnota" rows="8"  required="required"><?php echo $info_factura1['val_nota']; ?></textarea>

                  <label><br>Autorización:</label><br>
                  <textarea id="wauto" name="wauto" class="wauto"><?php echo $info_factura1['deta_autorizacion']; ?></textarea>

                  <input class="button" type="submit" value="GUARDAR">
                </form>
			</div>
		</div><!-- /container -->
	</body>
</html