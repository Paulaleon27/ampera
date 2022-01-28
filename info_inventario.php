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
		<title>Inventario | Ampera</title>
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
				<h2>Inventario <!--<span>Re-evolucionando la educación </span>--></h2>	
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
								<th class="ancho1">Ref. Batería</th>
								<th class="ancho1">Modelo</th>
								<th class="ancho1" >Marca</th>
								<th class="ancho2">Valor Unitario</th>
								<th class="ancho3">Cantidad</th>
								<th class="ancho4">Valor Total</th>
								
							</tr>
							<tr>
								<td class="ancho1">245-9000</td>
								<td class="conse">GOLD PLUS</td>
								<td>MAC</td>
								<td class="ancho">$250.000</td>
								<td>42</td>
								<td>$100.000.000</td> 
							</tr>
							<tr>
								<td class="ancho1">24BI-800</td>
								<td class="conse">SILVER PLUS</td>
								<td>MAC</td>
								<td class="ancho">$310.000</td>
								<td>20</td>
								<td>$5.000.000.000</td>
								
							</tr>
							<tr>
								<td class="ancho1">34I-1000</td>
								<td class="conse">TITANIO</td>
								<td>WILLARD</td>
								<td class="ancho">$100.000</td>
								<td>30</td>
								<td>$300.000</td>
								
							</tr>
							<tr>
								<td class="ancho1">48-1000</td>
								<td class="conse">GOLD PLUS</td>
								<td>MAC</td>
								<td class="ancho">$300.000</td>
								<td>30</td>
								<td>$9.000.000</td>
								
							</tr>
							<tr>
								<td class="ancho1">42D-800</td>
								<td class="conse">TITANIO</td>
								<td>WILLARD</td>
								<td class="ancho">$150.000</td>
								<td>42</td>
								<td>$2.500.000</td>
								
							</tr>
							<tr>
								<td class="ancho1">24BI-800</td>
								<td class="conse">TITANIO</td>
								<td>WILLARD</td>
								<td class="ancho">$200.000</td>
								<td>24</td>
								<td>$1.555.000</td>
								
							</tr>
						</table>
					</p>

				</nav>
			</div>
		</div><!-- /container -->
	</body>
</html>