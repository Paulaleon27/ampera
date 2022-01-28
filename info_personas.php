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
		<title>Personas | Ampera</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/informe.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/modal.css" />
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src="js/informe.js"></script>
	</head>
	<body>

		<?php
			include("php/modal.php");
			include("php/menu_float.php");
		?>

		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h2>Personas <!--<span>Re-evolucionando la educación </span>--></h2>	
			</header>
			<div class="main clearfix">
				<nav id="menu" class="nav">	

					<!-- <h1>Buscar en el contenido de una tabla</h1> -->
					<form>
						Buscar:  <input id="searchTerm" type="text" onkeyup="doSearch()" autofocus />
					</form>
					<p>
						<table id="datos" class="tabla center">
							<tr>
								<th class="ancho_t">Nº Identificación</th>
								<th class="ancho_t">Nombre</th>
								<th class="ancho">Frecuencia(Viene 1 vez al mes es Cliente Ocasional.. 2 veces al mes Cliente Frecuente.. 3 veces Cliente Potencial.. 4 veces Cliente Actual</th>
								<th class="ancho_t">Total Compra</th>
								<th class="ancho_t">Usuario</th>
							</tr>
							<tr>
								<td>1250</td>
								<td class="conse">Juan Perez</td>
								<td class="ancho">Cliente Ocasional</td>
								<td>$100.000.000</td>
								<td>Deybic Rojas</td> 
							</tr>
							<tr>
								<td>2222</td>
								<td class="conse">Jose Vazquez Jose Vazquez Jose Vazquez</td>
								<td class="ancho">Cliente Frecuente</td>
								<td>$500.000.000</td>
								<td>Paula León</td>
							</tr>
							<tr>
								<td>9302</td>
								<td class="conse">Luis Astorga</td>
								<td class="ancho">Cliente Potencial</td>
								<td>$300.000.000</td>
								<td>Paula Rojas</td>
							</tr>
							<tr>
								<td>5256</td>
								<td class="conse">Luisa Valdes</td>
								<td class="ancho">Cliente Actual</td>
								<td>$900.000</td>
								<td>Deybic León</td>
							</tr>
							<tr>
								<td>6258</td>
								<td class="conse">Juan Perez</td>
								<td class="ancho">Cliente Actual</td>
								<td>$250.000.000</td>
								<td>Deybic Rojas</td>
							</tr>
							<tr>
								<td>308</td>
								<td class="conse">Jose Vazquez</td>
								<td class="ancho">Cliente Ocasional</td>
								<td>$1.000.000.000</td>
								<td>Paula León</td>
							</tr>
						</table>
					</p>

				</nav>
			</div>
		</div><!-- /container -->
	</body>
</html>