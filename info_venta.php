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
		<title>Venta | Ampera</title>
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

		<section id='openmodal1' class='modalDialog2'>
			<section class='modal2'>
				<a href="#close" class="x">X</a>
				<h2>ESTO ES UNA PRUEBA</h2>
			</section>
		</section>
		

		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h2>VENTA <!--<span>Re-evolucionando la educación </span>--></h2>	
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
								<th class="ancho_t">Num. Factura</th>
								<th class="ancho_t">Fecha venta</th>
								<th class="ancho">Cliente</th>
								<th class="ancho">Deta. Batería</th>
								<th class="ancho_t">Valor venta</th>
								<th class="ancho_t">Usuario</th>
							</tr>
							<tr>
								<td><a style=" color: #000; height: 10%; " href="#openmodal1" class="open1"> A1250 
									<span aria-hidden="true" class="icon-new-tab"></span></a>
								</td>
								<td class="conse">01/03/2017</td>
								<td class="ancho">Juan Perez</td>
								<td>42D-800, 245-9000</td>
								<td>$100.000.000</td>
								<td>Paula León</td>
							</tr>
							<tr>
								<td><a style=" color: #000; height: 10%; " href="#openmodal1" class="open1">A2222<span aria-hidden="true" class="icon-new-tab"></span></a></td>
								<td class="conse">16/04/2017</td>
								<td class="ancho">Jose Vazquez Jose Vazquez Jose Vazquez</td>
								<td>24BI-800</td>
								<td>$500.000</td>
								<td>Deybic Rojas</td> 
							</tr>
							<tr>
								<td><a style=" color: #000; height: 10%; " href="#openmodal1" class="open1">A9302<span aria-hidden="true" class="icon-new-tab"></span></a></td>
								<td class="conse">19/04/2017</td>
								<td class="ancho">Luis Astorga</td>
								<td>34I-1000</td>
								<td>%300.000</td>
								<td>Paula Rojas</td>
							</tr>
							<tr>
								<td><a style=" color: #000; height: 10%; " href="#openmodal1" class="open1">A5256<span aria-hidden="true" class="icon-new-tab"></span></a></td>
								<td class="conse">09/05/2017</td>
								<td class="ancho">Luisa Valdes</td>
								<td>48-1000</td>
								<td>$900.000</td>
								<td>Deybic León</td>
							</tr>
							<tr>
								<td><a style=" color: #000; height: 10%; " href="#openmodal1" class="open1">A6258<span aria-hidden="true" class="icon-new-tab"></span></a></td>
								<td class="conse">01/12/2015</td>
								<td class="ancho">Juan Perez</td>
								<td>42D-800</td>
								<td>$250.000</td>
								<td>Deybic Rojas</td>
							</tr>
							<tr>
								<td><a style=" color: #000; height: 10%; " href="#openmodal1" class="open1">A308<span aria-hidden="true" class="icon-new-tab"></span></a></td>
								<td class="conse">16/06/2016</td>
								<td class="ancho">Jose Vazquez</td>
								<td>24BI-800</td>
								<td>$1.000.000</td>
								<td>Paula León</td>
							</tr>
						</table>
					</p>

				</nav>
			</div>
		</div><!-- /container -->
	</body>
</html>