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
		<title>Informes | Ampera</title>
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
			include("php/modal.php");
			include("php/menu_float.php");
		?>

		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h2>Informes</h2>	
			</header>
			<div class="main clearfix" >
			<div style="padding: 0 0 0 13%;">
				<nav id="menu" class="nav">			
					<ul>
						<li>
							<a href="info_compra.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-box-add"></i>
								</span>
								<span>Compra</span>
							</a>
						</li>
						<li>
							<a href="info_venta.php">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-box-remove"></i>
								</span>
								<span>Venta</span>
							</a>
						</li>
						<li>
							<a href="info_garantia.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-clipboard"></i>
								</span>
								<span>Garantía</span>
							</a>
						</li>
						<li>
							<a href="info_inventario.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-paste"></i>
								</span>
								<span>Inventario</span>
							</a>
						</li>
						<li>
							<a href="info_personas.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-users"></i>
								</span>
								<span>Personas</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			</div>
		</div><!-- /container -->
	</body>
</html>