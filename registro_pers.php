<?php
	session_start();
	if(isset($_SESSION['autenticado']) AND $_SESSION['autenticado']){
		$pass = $_SESSION['passwd'];
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
		<title>Personas | Ampera</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<?php
			include("php/modal_redirect1.php");
			include("php/codigo_v.php");
			include("php/menu_float.php");
			include ("php/conexion.php");
			$cc = $_SESSION["validar_cc"];
			$dv = calcularDV($cc);
			$boton = $_POST['validar'];
			if ($cc != NULL){
				$_SESSION["validar_cc"] = NULL;
			}
		?>

		<div class="container">	
			<!-- Codrops top bar -->
			<header>
				<h2>REGISTRO PERSONAS</h2> 	
			</header>
			<div class="main clearfix">

				<form  name="registro" method="post" action="php/insert_pers.php">
				  <label><br>C.C./NIT.*:</label><br>
                  <input type="textarea" autocomplete="off" onkeyup="CalcularDv();" id="wid" name="wid" required="required" placeholder="Escribe tu número de identificación" value="<?php echo $cc; ?>" style="width: 80%;" />
                  <!-- <input type="button" class="button1" name="" value="Calcular"> -->
                  <input type="textarea" autocomplete="off" id="wdig" name="wdig" readonly="readonly" placeholder="Dígito de verificación" value="<?php echo $dv; ?>" style="width: 19%;"/> 

                  <label><br>Nombre Completo*:</label>
                  <input type="textarea" autocomplete="off" id="wnom" name="wnom" required="required" placeholder="Escribe tu nombre" value="" />


                  <label><br>Dirección*:</label>
                  <input type="textarea" autocomplete="off" id="wdir" name="wdir"  required="required" placeholder="Escribe tu dirección de residencia" value="">
                  
                  <label><br>País:</label>
                  <select name="wpais" class="select1" required="required" onClick="pais(this)">
	    				<option value="0" >Selecciona..</option>
	    				<?php
	    					$sql = pg_query("SELECT * FROM tab_paises ORDER BY nom_pais ASC");
	    					while ($row = pg_fetch_array($sql)){
	    						echo " <option value='".$row['id_pais']."'\">".$row['nom_pais']." </option> \n";
	    					}
	    				?>
	    			</select>

        			<script type="text/javascript">
        				function pais(this) {
        					var wpais = $(this).value();
							alert(wpais);  
        				}
						      				
        				/*if (wpais.getselectedIndex()==0) {
							alert("Debe Seleccionar una categoria");
							return false;
						}*/
        			</script>

                  <label>Departamento:</label>
                  <select name="wdepartamento" class="select1" required="required">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_departamentos ORDER BY nom_departamento ASC");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value='".$row['id_departamento']."'\">".$row['nom_departamento']." </option> \n";
			        					}
			        				?>
			        			</select>	
                  
                  <label>Ciudad:</label>
                  <select name="wciudad" class="select1" required="required">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_ciudades ORDER BY nom_ciudad ASC");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value='".$row['id_ciudad']."'\">".$row['nom_ciudad']." </option> \n";
			        					}
			        				?>
			        			</select>

                  <label><br>Celular:</label>
                   <input type="number" autocomplete="off" id="wcel" name="wcel" min="1111111111" max="9999999999" placeholder="Escribe tu celular" 
                  value="">

                  <label><br>Teléfono:</label>
                   <input type="number" autocomplete="off" id="wtel" name="wtel" min="1111111" max="9999999" placeholder="Escribe tu teléfono" 
                  value="">

                  <label><br>Correo electrónico:</label>
                   <input type="email" autocomplete="off" id="wmail" name="wmail" placeholder="Escribe tu email" 
                  value="">


                  
					<div id="tipo" class="radio">
						<h2>Tipo*:</h2>
						<input type="radio" required="required" name="tipo1" id="persona" value="persona" onclick="toggle(this)" checked="checked" >
						<label for="persona">Persona</label>
				
						<input type="radio" name="tipo1" id="empresa" value="empresa" onclick="toggle(this)">
						<label for="empresa">Empresa</label>
					</div>
					
					<script type="text/javascript">
				        function toggle(elemento) {
				          if(elemento.value=="persona") {
				              document.getElementById("tipo_pe").style.display = "block";
				              document.getElementById("tipo_pe1").style.display = "none";
				           }else{
				               if(elemento.value=="empresa"){
				                   document.getElementById("tipo_pe").style.display = "none";
				                   document.getElementById("tipo_pe1").style.display = "block";
				               }
				            }
				        }
					</script>
					
					<h2><span id="tipo_pe"  >Tipo Persona*:</span> <span id="tipo_pe1" style=" display: none; " > Tipo Empresa*:</span></h2>
					<div class="radio">
						<input type="radio" required="required" name="tipo" id="cliente" value="cliente">
						<label for="cliente">Cliente</label>
						<input type="radio" name="tipo" id="proveedor" value="proveedor" >
						<label for="proveedor">Proveedor</label>
					</div>

                  <br>
                  <input class="button" type="submit" value="REGISTRAR">
                </form>
			</div>
		</div><!-- /container -->
	</body>
	<script src="js/codigo_v.js" ></script>
</html>