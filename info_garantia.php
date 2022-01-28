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
		<title>Garantía | Ampera</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/informe.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
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
				<h2>GARANTÍA <!--<span>Re-evolucionando la educación </span>--></h2>	
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
								<th class="conse">Num. Garantía</th>
								<th class="conse">Batería</th>
								<th class="conse">Fecha venta</th>
								<th class="ancho_t">Tiempo transcurrido</th>
								<th class="ancho">Cliente</th>
								<th class="conse">Indicador BD. Estado garantía</th>
								<th class="conse">Usuario</th>
							</tr>
							<tr>
								<td>1250302</td>
								<td>42D-800</td>
								<td class="conse">01/03/2017</td>
								<td>Un año y 20 días</td>
								<td class="ancho">Juan Perez</td>
								<td class="conse">Vencida</td>
								<td>Paula León</td>
							</tr>
							<tr>
								<td>1250222</td>
								<td>24BI-800</td>
								<td class="conse">16/04/2017</td>
								<td>12 meses y 30 días</td>
								<td class="ancho">Jose Vazquez Jose Vazquez Jose Vazquez</td>
								<td class="conse">Vigente</td>
								<td>Paula Rojas</td>
							</tr>
							<tr>
								<td>9990302</td>
								<td>34I-1000</td>
								<td class="conse">19/04/2017</td>
								<td>Un día</td>
								<td class="ancho">Luis Astorga</td>
								<td class="conse">Vencida</td>
								<td>Deybic León</td>
							</tr>
							<tr>
								<td>1250256</td>
								<td>48-1000</td>
								<td class="conse">09/05/2017</td>
								<td>1 semana</td>
								<td class="ancho">Luisa Valdes</td>
								<td class="conse">Vigente</td>
								<td>Deybic Rojas</td>
							</tr>
							<tr>
								<td>356258</td>
								<td>42D-800</td>
								<td class="conse">01/12/2015</td>
								<td>Un año y 20 días</td>
								<td class="ancho">Juan Perez</td>
								<td class="conse">Vencida</td>
								<td>Paula León</td>
							</tr>
							<tr>
								<td>1250308</td>
								<td>24BI-800</td>
								<td class="conse">16/06/2016</td>
								<td>12 meses y 30 días</td>
								<td class="ancho">Jose Vazquez</td>
								<td class="conse">Vigente</td>
								<td>Deybic Rojas</td>
							</tr>
						</table>
					</p>

				</nav>
			</div>
		</div><!-- /container -->
	</body>
</html>