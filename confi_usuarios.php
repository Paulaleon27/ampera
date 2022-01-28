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
		<title>Usuarios | Ampera</title>
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
		?>

		<div class="container">	
			<!-- Codrops top bar -->
			<header>
				<h2>USUARIOS</h2> 	
			</header>
			<div class="main clearfix">

				<table>
					<tr>
						<td>Hola</td>
					</tr>
				</table>












































				<form  name="registro" method="post" action="php/insert_pers.php">
				  <label><br>Año Actual:</label><br>
                  <input type="textarea" id="wano" name="wano" required="required" placeholder="" disabled="disabled" value="2017" readonly />

                  <label><br>Nit:</label>
                  <input type="textarea" id="wnit" name="wnit" required="required" placeholder="Escribe el nit de tu empresa" value="91.475.657-8" /> 

                  <label><br>Nombre del Representante Legal:</label>
                  <input type="textarea" id="wnomd" name="wnomd"  required="required" placeholder="Escribe el nombre del representante legal" value="Daniel Lizarazo Calderón">

                  <label><br>Dirección:</label>
                  <input type="textarea" id="wdir" name="wdir"  required="required" placeholder="Escribe la dirección de tu empresa" value="Cra. 14 No. 18-06">

                  <label><br>País:</label>
                  <select name="wpais" class="select1" required>
			        				<option>Selecciona..</option>
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
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_ciudades ORDER BY nom_ciudad ASC");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value=/".$row['id_ciudad']."\">".$row['nom_ciudad']." </option> \n";
			        					}
			        				?>
			        			</select>

                  <label><br>Teléfono:</label>
                   <input type="number" id="wtel" name="wtel" min="1111111" max="9999999" placeholder="Escribe el teléfono de tu empresa" value="6719006">

                  <label><br>Celular:</label>
                   <input type="number" id="wcel" name="wcel" min="1111111111" max="9999999999" placeholder="Escribe el celular de tu empresa" value="3155385113">

                 <label><br>Lema:</label>
                  <input type="textarea" id="wdir" name="wdir"  required="required" placeholder="Escribe el lema de tu empresa" value="Venta, Reparación y Carga de todo tipo de Baterías Garantizadas">
                  <br>

                  <label><br>Nota:</label><br>
                  <textarea id="wnota" name="wnota" class="wnota" rows="8"  required="required">NOTA: La garantía del producto se hace efectiva, siempre y cuando el usuario mantenga un buen estado de funcionamiento del sistema eléctrico de su vehículo y cumpla con los requisitos de hacerle mantenimiento en su batería cada un(1) mes. Únicamente respondemos por defectos de fabricación, no por maltrato o rotura de la batería</textarea>

                  <label><br>Autorización:</label><br>
                  <textarea id="wauto" name="wauto" class="wauto">Autorización, Numeración de Facturación ####### de Fecha ##/##/## Numerado desde ### al ###</textarea>

                  <input class="button" type="submit" value="GUARDAR">
                </form>
			</div>
		</div><!-- /container -->
	</body>
</html