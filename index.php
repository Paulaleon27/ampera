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
		<title>Menú | Ampera</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" />
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
			include("php/modal1.php");
		?>
		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h1>!BIENVENIDO A AMPERA¡ <!--<span>Re-evolucionando la educación </span>--></h1>	
			</header>
			<div class="main clearfix">
				<nav id="menu" class="nav">					
					<ul>
						<li>
							<a href="#openmodal2" class="open">
								<span class="icon">
									<i aria-hidden="true" class="icon-box-add"></i>
								</span>
								<span>Factura Compra</span>
							</a>
						</li>
						<li>
							<a href="#openmodal" class="open">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-box-remove"></i>
								</span>
								<span>Factura Venta</span>
							</a>
						</li>
						<li>
							<a href="menu_i.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-books"></i>
								</span>
								<span>Informes</span>
							</a>
						</li>
						<li>
							<a href="registro_pers.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-user-plus"></i>
								</span>
								<span>Cliente/Proveedor</span>
							</a>
						</li>
						<li>
							<a href="menu_confi.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-cog"></i>
								</span>
								<span>Configuración</span>
							</a>
						</li>
						<li>
							<a href="php/cerrar_sesion.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-switch"></i>
								</span>
								<span>Salir</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div><!-- /container -->
		<script>
			//  The function to change the class
			var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};	

			//  Creating our button in JS for smaller screens
			var menuElements = document.getElementById('menu');
			menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu1"> </i> Menu</button>');

			//  Toggle the class on click to show / hide the menu
			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}

			// http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
			document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}
		</script>
	</body>
</html>