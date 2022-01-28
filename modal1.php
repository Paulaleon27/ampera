<?php
session_start();
echo "
<link rel='stylesheet' type='text/css' href='css/modal.css' />
<script src='http://code.jquery.com/jquery-1.0.4.js'></script>";
echo "<section id='openmodal2' class='modalDialog1'>
		<section class='modal1'>
			<h2>Por favor ingresa tu C.C/NIT.:</h2>
			<center>(Sin puntos ni comas)</center>
			<h1></h1>
			<center>
			<form method='post' action='php/validar_id_c.php'>
			<input type='number' name='validar_cc' required='required' placeholder='Número identificación' id='documento'>
			<br><a href='f_venta.html'><button class='button2'>SIGUIENTE</button></a> 
			</form>
			<a href='#close'><button class='button1'>CANCELAR</button></a> 
			</center>
		</section>
	</section>";
?>