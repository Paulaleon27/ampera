<?php
include("php/modal.php");
include("php/modal1.php");
echo '
	<h1>
		<div class="flotante">
			<a href="index.php">
				<span class="icon1 tooltip"> 
					<span class="tooltip1">Inicio</span>
					<i aria-hidden="true" class="icon-home"></i>	<!-- Inicio -->
				</span>
			</a>
			<br>
			<a href="#openmodal2">
				<span class="icon1 tooltip">
					<span class="tooltip1">Compras</span> 
					<i aria-hidden="true" class="icon-box-add"></i>	<!-- Compras -->
				</span>
			</a>
			<br>
			<a href="#openmodal" class="open">
				<span class="icon1 tooltip"> 
					<span class="tooltip1">Ventas</span>
					<i aria-hidden="true" class="icon-box-remove"></i>	<!-- Ventas -->
				</span>
			</a>
			<br>
			<a href="menu_i.php">
				<span class="icon1 tooltip">
					<span class="tooltip1">Informes</span> 
					<i aria-hidden="true" class="icon-books"></i>		<!-- Informes -->
				</span>
			</a>
			<br>
			<a href="registro_pers.php">
				<span class="icon1 tooltip"> 
					<span class="tooltip1">C/P</span>
					<i aria-hidden="true" class="icon-users"></i>		<!-- Cliente/Proveedor -->
				</span>
			</a>
			<br>
			<a href="menu_confi.php">
				<span class="icon1 tooltip"> 
					<span class="tooltip1">Configuración</span>
					<i aria-hidden="true" class="icon-cog"></i>		<!-- Configuración -->
				</span>
			</a>
			<br>
		</div>
	</h1>';
?>