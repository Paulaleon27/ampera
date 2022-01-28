<?php
echo "
<link rel='stylesheet' type='text/css' href='../css/modal.css' />
<script src='http://code.jquery.com/jquery-1.0.4.js'></script>";
echo "<section id='openmodal1' class='modalDialog1'>
		<section class='modal1'>
			<h2>Selecciona la opción que desea realizar:</h2>
			<h1></h1>
			<center>
				<form method='post' action='php/insert_pers.php'>
					<a href='f_venta.html'><button name='validar' id='validar' class='button2' value='1'>REGISTRAR</button></a> 
					<br>
					<a href='f_venta.html'><button name='validar' id='validar' class='button2' value='2'>GENERAR FACTURA</button></a> 
					<a href='#close'><button name='validar' id='validar' value='3' class='button1'>CANCELAR</button></a> 
				</form>
			</center>
		</section>
	</section>";
?>