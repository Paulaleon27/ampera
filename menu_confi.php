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
		<title>Configuración| Ampera</title>
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
		<section id='openmodal' class='modalDialog1'>
			<section class='modal1'>
				<h2>Por favor ingresa tu C.C/NIT.:</h2>
				<center>(Sin puntos ni comas)</center>
				<h1></h1>
				<center>
				<input type="number" name="validar_cc" required="required">
				<input type="number"  name="validar_dv" required="required">
				<br>
				<a href='#close'><button class="button1">CANCELAR</button></a> 
				<a href="f_venta.html"><button class="button2">SIGUIENTE</button></a> 
				</center>
			</section>
		</section>
		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h1>CONFIGURACIÓN</h1>	
			</header>
			<div class="main clearfix">
			<div style="padding: 0 0 0 13%;">
				<nav id="menu" class="nav">					
					<ul>
						<li>
							<a href="confi_parametros.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-cogs"></i>
								</span>
								<span>General</span>
							</a>
						</li>
						<li>
							<a href="#openmodal" class="open">
								<span class="icon"> 
									<i aria-hidden="true" class="icon-droplet"></i>
								</span>
								<span>Batería</span>
							</a>
						</li>
						<li>
							<a href="menu_i.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-user-check"></i>
								</span>
								<span>Cliente/Proveedor</span>
							</a>
						</li>
						<li>
							<a href="registro_pers.html">
								<span class="icon">
									<i aria-hidden="true" class="icon-map"></i>
								</span>
								<span>Ciudades</span>
							</a>
						</li>
						<li>
							<a href="confi_usuarios.php">
								<span class="icon">
									<i aria-hidden="true" class="icon-user-tie"></i>
								</span>
								<span>Usuarios</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
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