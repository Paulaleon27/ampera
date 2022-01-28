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
<!-- Página factura de venta -->
<!DOCTYPE html>
<html lang="es" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Factura de venta | Ampera</title>
		<meta name="description" content="Responsive Retina-Friendly Menu with different, size-dependent layouts" />
		<meta name="keywords" content="responsive menu, retina-ready, icon font, media queries, css3, transition, mobile" />
		<meta name="author" content="Codrops" /> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>  
		
		<?php
			include("php/modal.php");
			include("php/menu_float.php");
			include ("php/conexion.php");
			$ccnit = $_SESSION['ccnit'];
			$dig = $_SESSION['dig'];
			/*QUERY PARA VALIDAR SI ESTÁ REGISTRADO O NO*/
			$buscar = pg_query("SELECT * FROM tab_personas WHERE id_persona = '$ccnit' AND digito_v = '$dig';");
			$buscar1 = pg_fetch_array($buscar);
		?>

		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h2>FACTURA DE VENTA</h2>
			</header>
			<div class="main clearfix">
				<div class="main1">
					<!-- PRIMERA PARTE DE LA FACTURA -->
			        <table class="superiorizquierdotabla inferiorizquierdotabla inferiorderechotabla superiorderechotabla">
			        	<!-- Fila#1 -->
			            <tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho centrado">	
			                <td class="superiorizquierdotabla"> <!-- Columna#1 -->
			                	<B>Fecha Elaboración:</B> 
			                	<input type="text" name="fecha_e1" placeholder="dd/mm/aaaa" value="<?php echo date('d-m-y'); ?>" readonly="readonly">  
			                </td>
			                <td>
			                	<B>Fecha Vencimiento:</B><!-- Columna#2 -->
			                	<input type="text" name="fecha_v1" placeholder="dd/mm/aaaa">
			                </td>
			                <td>
			                	<B>C.C./NIT. </B><!-- Columna#3 -->
			                	<input class="cc-nit1" type="text" name="cc-nit1" value="<?php echo $buscar1['id_persona']."-".$buscar1['digito_v']; ?>" placeholder="Cédula o NIT" readonly="readonly">
			                </td>
			                <td class="coltitles superiorderecho"><!-- Columna#4 -->
			                	<B>FACTURA DE VENTA</B>
			                </td>
			            </tr>												
			            <!-- Fin-Fila#1 -->
			            <!-- Fila#2 -->
			            <tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho centrado">	
			                <td colspan="2" class="nom_cliente"> <!-- Columna#1 -->
			                	<B>Cliente: </B>
			                	<input type="text" name="nom_cliente" class="nom_cliente1"  placeholder="Nombre del cliente" value="<?php echo $buscar1['nom_persona']; ?>" readonly="readonly">
			                </td>		
			                <td class="tel_cliente"><!-- Columna#2 -->
			                	<B>Teléfono: </B>
			                	<input type="text" name="tel_cliente" class="tel_cliente1"  placeholder="Teléfono del cliente" value="<?php echo $buscar1['tel_persona']; ?>" readonly="readonly">
			                </td>
			                <td rowspan="2" class="consec"><!-- Columna#3 -->
			                	<B>A</B> 
			                	<span>2704</span>
			                </td>
			            </tr>												
			            <!-- Fin-Fila#2 -->
			            <!-- Fila#3 -->
			            <tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho centrado">
			                <td colspan="2" class="dir_cliente inferiorizquierdo"><!-- Columna#1 -->
			                	<B>Dirección: </B>
			                	<input type="text" name="dir_cliente" class="dir_cliente1"  placeholder="Dirección del cliente" value="<?php echo $buscar1['dir_persona']; ?>" readonly="readonly">
			                </td>
			                <td class="for_pago"><!-- Columna#2 -->
			                	<B>Forma de pago:</B>
			                	<input type="text" name="for_pago" class="for_pago1"  placeholder="Forma de pago">
			                </td>
			            </tr>												
			            <!-- Fin-Fila#3 -->
			        </table>
			        <!-- FIN-PRIMERA PARTE DE LA FACTURA -->
			        <br>
			        <!-- SEGUNDA PARTE DE LA FACTURA -->
			        <table class="tabla" id="factura">
			            <tr class="superiorizquierdotabla inferiorizquierdo inferiorderecho superiorderecho coltitles centrado">
			            	<td class="superiorizquierdotabla inferiorizquierdo">Cant.</td>
			            	<td>ARTÍCULO</td>
			            	<td>VALOR UNITARIO</td>
			            	<td>VALOR TOTAL</td>
			            	<td class="superiorderecho inferiorderecho">Acción</td>
			            </tr>
			        	<tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho">
			        		<td class="superiorizquierdo colcant"> 
			        			<input type="number" name="canti" class="canti"><!--  style=" background: #ff0000; font-size: 17px; width: 20px; "  -->
			        		</td>
			        		<td class="centrado widthart">
			        			<select class="select">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql = pg_query("SELECT * FROM tab_referencias");
			        					while ($row = pg_fetch_array($sql)){
			        						echo " <option value=/".$row['nom_referencia']."\">".$row['nom_referencia']." </option> \n";
			        					}
			        				?>
			        			</select>
			        		</td>
			        		<td class="centrado"> <input type="number" name="val_uni" class="val_uni"></td> <!-- style=" background: #fff; font-size: 17px; width: 10%; " -->
			        		<td class="colvaltotal"><input type="number" name="val_total" class="val_total"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 	
			        		<td class="superiorderecho colvaltotal"><input type="button" value="Agregar Fila" onclick="agregar_fila();"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 
			        	</tr>
			        	<tr>
			        		<td class="colcant"><input type="number" name="cant"></td>
			        		<td class="centrado">
			        			<select class="select">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql1 = pg_query("SELECT * FROM tab_referencias");
			        					while ($row = pg_fetch_array($sql1)){
			        						echo " <option value=/".$row['nom_referencia']."\">".$row['nom_referencia']." </option> \n";
			        					}
			        				?>
			        			</select>
			        		</td>
			        		<td class="centrado"> <input type="number" name="val_uni" class="val_uni"></td> <!-- style=" background: #fff; font-size: 17px; width: 10%; " -->
			        		<td class="colvaltotal"><input type="number" name="val_total" class="val_total"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 	
			        		<td class="colvaltotal"><input type="button" value="Agregar Fila" onclick="agregar_fila();"></td>	
			        	</tr>
			        	<tr class="quinto">
			        		<td class="colcant"><input type="number" name="cant"></td>
			        		<td class="centrado">
			        			<select class="select">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql2 = pg_query("SELECT * FROM tab_referencias");
			        					while ($row = pg_fetch_array($sql2)){
			        						echo " <option value=/".$row['nom_referencia']."\">".$row['nom_referencia']." </option> \n";
			        					}
			        				?>
			        			</select>
			        		</td>
			        		<td class="centrado"> <input type="number" name="val_uni" class="val_uni"></td> <!-- style=" background: #fff; font-size: 17px; width: 10%; " -->
			        		<td class="colvaltotal"><input type="number" name="val_total" class="val_total"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 	
			        		<td class="colvaltotal"><input type="button" value="Agregar Fila" onclick="agregar_fila();"></td>	
			        	</tr>
			        	<tr class="quinto">
			        		<td class="colcant"><input type="number" name="cant"></td>
			        		<td class="centrado">
			        			<select class="select">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql3 = pg_query("SELECT * FROM tab_referencias");
			        					while ($row = pg_fetch_array($sql3)){
			        						echo " <option value=/".$row['nom_referencia']."\">".$row['nom_referencia']." </option> \n";
			        					}
			        				?>
			        			</select>
			        		</td>
			        		<td class="centrado"> <input type="number" name="val_uni" class="val_uni"></td> <!-- style=" background: #fff; font-size: 17px; width: 10%; " -->
			        		<td class="colvaltotal"><input type="number" name="val_total" class="val_total"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 	
			        		<td class="colvaltotal"><input type="button" value="Agregar Fila" onclick="agregar_fila();"></td> 	
			        	</tr>
			        	<tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho">
			        		<td class="inferiorizquierdo colcant"><input type="number" name="cant"></td>
			        		<td class="centrado">
			        			<select class="select">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql4 = pg_query("SELECT * FROM tab_referencias");
			        					while ($row = pg_fetch_array($sql4)){
			        						echo " <option value=/".$row['nom_referencia']."\">".$row['nom_referencia']." </option> \n";
			        					}
			        				?>
			        			</select>
			        		</td>
			        		<td class="centrado"> <input type="number" name="val_uni" class="val_uni"></td> <!-- style=" background: #fff; font-size: 17px; width: 10%; " -->
			        		<td class="colvaltotal"><input type="number" name="val_total" class="val_total"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 	
			        		<td class="colvaltotal"><input type="button" value="Agregar Fila" onclick="agregar_fila();"></td>	
			        	</tr>
			        </table>
			        <!-- FIN-SEGUNDA PARTE DE LA FACTURA -->

			        <!-- TERCERA PARTE DE LA FACTURA -->	                 
	                <div>
	                	<br>
	                	<B style=" font-size: 20px; " >¿Deja batería usada?</B>
	                	<label>
	                		<input type="radio" name="tipo_attach" onclick="toggle(this)" value="si">Si &nbsp;
	                	</label>
	                	<label>
	                		<input type="radio" name="tipo_attach" onclick="toggle(this)" value="no" checked="checked">No
	                	</label>
	                </div>

	                <script type="text/javascript">
				        function toggle(elemento) {
				          if(elemento.value=="no") {
				              document.getElementById("uno").style.display = "none";
				           }else{
				               if(elemento.value=="si"){
				                   document.getElementById("uno").style.display = "block";
				               }
				            }
				        }
					</script>

	                <br>

	                <div id="uno" style="display:none" >
		                <table class="tabla" >
		                	<tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho coltitles centrado">
		                		<td class="superiorizquierdotabla">Cant.</td>
		                		<td class="superiorderecho">Artículo</td>
		                	</tr>
		                	<tr>
		                		<td class="inferiorizquierdo colcant">
		                			<input type="number" name="cant_chatarra">
		                		</td>
		                		<td class="inferiorderecho centrado widthart">
			        			<select class="select">
			        				<option>Selecciona..</option>
			        				<?php
			        					$sql2 = pg_query("SELECT * FROM tab_referencias");
			        					while ($row = pg_fetch_array($sql2)){
			        						echo " <option value=/".$row['nom_referencia']."\">".$row['nom_referencia']." </option> \n";
			        					}
			        				?>
			        			</select>
		                		</td>
		                	</tr>
		                </table>
	                </div>

	                <script>
						function habilitar(value)
						{
							if(value=="otro")
							{
								// habilitamos
								document.getElementById("otro1").disabled=false;
							}else{
								// deshabilitamos
								document.getElementById("otro1").disabled=true;
							}
						}
					</script>


	                <div class="descuento">
		                <br>
		                <B style=" font-size: 20px; " >Descuento:</B>
		                <label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="cero" checked="checked">$0 &nbsp;
		                </label>
		                <label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="diez"> $10.000 &nbsp;
						</label>
						<label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="veinte"> $20.000 &nbsp;
						</label>
						<label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="treinta"> $30.000 &nbsp;
						</label>
						<label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="cuarenta"> $40.000 &nbsp;
						</label>
						<label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="cincuenta"> $50.000 &nbsp;
						</label>
						<label>
		                	<input type="radio" name="tipo" onchange="habilitar(this.value);" value="otro"> Otro &nbsp;
						</label>
						&nbsp;&nbsp;&nbsp; <input type="number" name="otro1" id="otro1" class="descuento_d"  placeholder="Sin puntos ni comas" disabled="">
	                </div>
	                <!-- FIN-TERCERA PARTE DE LA FACTURA -->


	                <br>
					<!-- <table class="superiorizquierdotabla inferiorizquierdotabla inferiorderechotabla superiorderechotabla anchotabla">
						<tr class="superiorizquierdo superiorderecho">
							<td class="superiorizquierdo lineaabajo espacio">ACEPTADA C.C ó NIT.</td>
							<td class="superiorderecho lineaabajo espacio1">Daniel Lizarazo Calderón <br><br></td>
						</tr>
						<tr class="tabla">
							<td class="lineaabajo lineaarriba"><br><br></td>
							<td class="lineaarriba lineaabajo"><br></td>
						</tr>
						<tr>
							<td class="inferiorizquierdo">Fecha de aceptación: </td>
							<td class="inferiorderecho">NIT. #########</td>
						</tr>
					</table> -->
					<table class="correr tabla4">
						<tr>
							<td class="superiorizquierdotabla superiorderecho primeracolumna bordeabajo">Sub Total</td>
							<td class="superiorderechotabla superiorizquierdotabla segundacolumna bordeabajo" style="border-top: solid 1px #ffffff;">
								<input type="number" name="sub_total">
							</td>
						</tr>
						<tr>
							<td class="primeracolumna bordeabajo">IVA</td>
							<td class="segundacolumna bordeabajo">
								<input type="number" name="iva">
							</td>
						</tr>
						<tr>
							<td class="inferiorizquierdo inferiorderecho primeracolumna bordeabajo">Total $</td>
							<td class="inferiorderecho inferiorizquierdo segundacolumna borde">
								<input type="number" name="total">
							</td>
						</tr>
					</table>
					<!-- <h4>Aquí va una nota.....................................................................................................................................................................................................</h4>
					<h4>Aquí va una nota.....................................................................................................................................................................................................</h4> -->

					<button type="button" >Guardar Factura</button>

				</div>
				
			</div>
		</div><!-- /container -->
	</body>
<script language="javascript">

    function agregar_fila() {
	    var tabla = document.getElementById("factura");
	   
	    var fila = tabla.insertRow();
	   
	    var celda1 = fila.insertCell(0);
	    var celda2 = fila.insertCell(1);
	    var celda3 = fila.insertCell(2);
	    var celda4 = fila.insertCell(3);
	    var celda5 = fila.insertCell(4);
	   
	    var campo1 = document.createElement("input");
	        campo1.type = "text";
	        campo1.setAttribute("onclick","vaciar_campo(this);");
	       
	    var campo2 = campo1.cloneNode(true);
	    var campo3 = campo1.cloneNode(true);
	    var campo4 = campo1.cloneNode(true);
	   
	    var campo5 = document.createElement("input");
	        campo5.type = "button";
	        campo5.value = "Borrar Fila";
	        campo5.onclick = function() {
	       
	            var fila = this.parentNode.parentNode;
	            var tbody = tabla.getElementsByTagName("tbody")[0];
	           
	            tbody.removeChild(fila);
	           
	        }
	   
	    celda1.appendChild(campo1);
	    celda2.appendChild(campo2);
	    celda3.appendChild(campo3);
	    celda4.appendChild(campo4);
	    celda5.appendChild(campo5);
	}
	function vaciar_campo(input) {
	   
	    input.value = "";
	   
	}
</script>
</html>