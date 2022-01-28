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
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
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
			$parametros = pg_query("SELECT * FROM tab_parametros");
			$parametros1 = pg_fetch_array($parametros);
		?>
		<style type="text/css" media="screen">
			.ocultar{
				display: none;
			}
			.cargando{
				position: fixed;
				height: 100%;
				width: 100%;
			}
			.cargando img{
				width: 400px;
				height: 400px;
			}
		</style>
		<div class="ocultar" id="cargando">
			<img src="https://loading.io/spinners/double-ring/lg.double-ring-spinner.gif" alt="">
		</div>
		<div class="container">	
			<!-- Codrops top bar -->

			<header>
				<h2>FACTURA DE COMPRA</h2>
			</header>
			<div class="main clearfix">
				<div class="main1">
					<form name="form1" method="post" action="php/insert_f_compra.php">
						<!-- PRIMERA PARTE DE LA FACTURA -->
				        <table class="superiorizquierdotabla inferiorizquierdotabla inferiorderechotabla superiorderechotabla">
				        	<!-- Fila#1 -->
				            <tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho centrado">	
				                <td class="superiorizquierdotabla"> <!-- Columna#1 -->
				                	<B>Fecha Elaboración:</B> 
				                	<input type="text" name="fecha_e1" id="fecha_e1" placeholder="dd/mm/aaaa" value="<?php echo date('d-m-Y'); ?>" readonly="readonly">  
				                </td>
				                <td>
				                	<B>Fecha Vencimiento:</B><!-- Columna#2 -->
				                	<input type="text" name="fecha_v1" id="fecha_v1" placeholder="dd/mm/aaaa" value="<?php echo date('d-m-Y'); ?>" readonly="readonly">
				                </td>
				                <td>
				                	<B>C.C./NIT. </B><!-- Columna#3 -->
				                	<input class="cc-nit1" type="text" name="cc-nit" id="cc-nit" value="<?php echo $buscar1['id_persona']; ?>" placeholder="Cédula o NIT" readonly="readonly">
				                	-
				                	<?php echo $buscar1['digito_v']; ?>
				                </td>
				                <td class="coltitles superiorderecho"><!-- Columna#4 -->
				                	<B>FACTURA DE COMPRA</B>
				                </td>
				            </tr>												
				            <!-- Fin-Fila#1 -->
				            <!-- Fila#2 -->
				            <tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho centrado">	
				                <td colspan="2" class="nom_cliente"> <!-- Columna#1 -->
				                	<B>Cliente: </B>
				                	<input type="text" name="nom_cliente" id="nom_cliente" class="nom_cliente1"  placeholder="Nombre del cliente" value="<?php echo $buscar1['nom_persona']; ?>" readonly="readonly">
				                </td>		
				                <td class="tel_cliente"><!-- Columna#2 -->
				                	<B>Teléfono: </B>
				                	<input type="text" name="tel_cliente" id="tel_cliente" class="tel_cliente1"  placeholder="Teléfono del cliente" value="<?php echo $buscar1['tel_persona']; ?>" readonly="readonly">
				                </td>
				                <td rowspan="2" class="consec"><!-- Columna#3 -->
				                	<input type="text" name="num_factura" id="num_factura" class=""  placeholder="N° Factura">
				                </td>
				            </tr>												
				            <!-- Fin-Fila#2 -->
				            <!-- Fila#3 -->
				            <tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho centrado">
				                <td colspan="2" class="dir_cliente inferiorizquierdo"><!-- Columna#1 -->
				                	<B>Dirección: </B>
				                	<input type="text" name="dir_cliente" id="dir_cliente" class="dir_cliente1"  placeholder="Dirección del cliente" value="<?php echo $buscar1['dir_persona']; ?>" readonly="readonly">
				                </td>
				                <td class="for_pago"><!-- Columna#2 -->
				                	<B>Forma de pago:</B>
				                	<input type="text" name="for_pago" id="for_pago" class="for_pago1"  placeholder="Forma de pago">
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
				            	<td>PRECIO COMPRA</td>
				            	<td>PRECIO VENTA</td>
				            	<td>VALOR TOTAL</td>
				            	<td class="superiorderecho inferiorderecho">Acción</td>
				            </tr>
				        	<tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho" id="filafactura1">
				        		<td class="superiorizquierdo colcant"> 
				        			<input type="number" id="canti1" name="canti1" class="canti" onkeyup="valor(1);"><!--  style=" background: #ff0000; font-size: 17px; width: 20px; "  -->
				        		</td>
				        		<td class="centrado widthart">
				        			<select name="referencia1" id="referencia1" class="select">
				        				<option value="0">Selecciona..</option>
				        				<?php
				        					$sql = pg_query("SELECT * FROM tab_referencias");
				        					while ($row = pg_fetch_array($sql)){
				        						echo " <option value='".$row['id_referencia']."'>".$row['nom_referencia']." </option> \n";
				        					}
				        				?>
				        			</select>
				        		</td>
				        		<td class="centrado"> <input type="number" onkeyup="valor(1);" name="prec_compra1" id="prec_compra1" class="val_uni"></td> 
				        		<td class="centrado"> <input type="number" id="prec_venta1" name="prec_venta1" class="val_uni"></td> 
				        		<!-- style=" background: #fff; font-size: 17px; width: 10%; " -->
				        		<td class="colvaltotal"><input type="number" id="val_total1" name="val_total1" class="val_total"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 
				        		<td class="superiorderecho colvaltotal"><input type="button" value="+" onclick="agregar_fila();"></td> <!-- style=" background: rgb(232, 178, 121); font-size: 17px; width: 10%; " --> 
				        	</tr>
				        </table>
				        <!-- FIN-SEGUNDA PARTE DE LA FACTURA -->
				        <input type="number" id="num_filas_factura" value="1" style="display: none;">
				        <!-- TERCERA PARTE DE LA FACTURA -->	                 
		                <div>
		                	<br>
		                	<B style=" font-size: 20px; " >¿Deja baterías regaladas?</B>
		                	<label>
		                		<input type="radio" name="tipo_attach" id="tipo_attach" onclick="toggle(this)" value="si">Si &nbsp;
		                	</label>
		                	<label>
		                		<input type="radio" name="tipo_attach" id="tipo_attach" onclick="toggle(this)" value="no" checked="checked">No
		                	</label>
		                </div>

		                <!-- FUNCIÓN PARA QUE OCULTE LA TABLA -->

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
			                <table class="tabla" id="regalada">
			                	<tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho coltitles centrado">
			                		<td class="superiorizquierdotabla">Cant.</td>
			                		<td>Artículo</td>
				            		<td class="superiorderecho inferiorderecho">Acción</td>
			                	</tr>
			                	<tr id="fila_regalada1">
			                		<td class="colcant">
			                			<input type="number" name="cant_regalada1" id="cant_regalada1">
			                		</td>
			                		<td class="centrado widthart">
				        			<select name="referencia_regal1" id="referencia_regal1" class="select">
				        				<option value="0">Selecciona..</option>
				        				<?php
				        					$sql2 = pg_query("SELECT * FROM tab_referencias");
				        					while ($row = pg_fetch_array($sql2)){
				        						echo " <option value='".$row['id_referencia']."'>".$row['nom_referencia']." </option> \n";
				        					}
				        				?>
				        			</select>
			                		</td>
			                		<td class="superiorderecho colvaltotal"><input type="button" name="delete_regalada1" id="delete_regalada1" value="+" onclick="agregar_fila_regalada();"></td>	
			                	</tr>
			                </table>
				        	<input type="number" id="num_filas_regaladas" value="1" style="display: none;">
		                </div>

		                <div class="descuento">
			                <br>
			                <B style=" font-size: 20px; " >Descuento:</B>
			                <label>
			                	<input type="radio" id="desc" name="desc" onchange="habilitar(this.value);" value="cero" >$0 &nbsp;
			                </label>
							<label>
			                	<input type="radio" id="desc" name="desc" onchange="habilitar(this.value);" value="otro" checked="checked"> Otro &nbsp;
							</label>
							&nbsp;&nbsp;&nbsp; <input type="number" onkeyup="funj_descuento();" name="descuento" id="descuento" class="descuento_d" placeholder="0.00" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
							<label id="men_desc" style="visibility: hidden;">El descuento no puede ser mayor al valor total</label>
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
									<input type="number" disabled placeholder="0.00" id="sub_total" name="sub_total" required name="price" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
								</td>
							</tr>
							<tr>
								<td class="primeracolumna bordeabajo">IVA</td>
								<td class="segundacolumna bordeabajo">
									<input type="number" disabled placeholder="0.00" id="iva" name="iva" required name="price" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
								</td>
							</tr>
							<tr>
								<td class="inferiorizquierdo inferiorderecho primeracolumna bordeabajo">Total $</td>
								<td class="inferiorderecho inferiorizquierdo segundacolumna borde">
									<input type="number" disabled placeholder="0.00" id="total" name="total" required name="price" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
								</td>
							</tr>
						</table>
						<!-- <h4>Aquí va una nota.....................................................................................................................................................................................................</h4>
						<h4>Aquí va una nota.....................................................................................................................................................................................................</h4> -->
						<button type="button" class="button" onclick="guardar_factura();">Guardar Factura</button>
					</form>
				</div>
			</div>
		</div><!-- /container -->
		
	</body>

<!-- FUNCION PARA SACAR LOS VALORES DEL SUBTOTAL, IVA Y TOTAL -->

<script type="text/javascript">
	function valor(numfila){
		var cantidad = document.getElementById("canti"+numfila).value;
		var precio_compra = document.getElementById("prec_compra"+numfila).value;
		valor_total = (parseInt(precio_compra) * parseInt(cantidad));
		document.getElementById("val_total"+numfila).value = valor_total;
		total();
		funj_descuento();
	}

	function total() {
		var numfilasfactura = $("#num_filas_factura").val();
		var valor_total = 0;
		for (var i = 1; i <= numfilasfactura; i++) {
			valor_total = parseInt(valor_total) + parseInt($("#val_total"+i).val());
		}
		valor_subtotal = (valor_total/1.19).toFixed(2);
		document.getElementById("sub_total").value = valor_subtotal;
		val_iva = ((valor_subtotal * <?php echo "0.".$parametros1['val_iva']; ?>).toFixed(2));
		document.getElementById("iva").value = val_iva;
		totaldetodo = (Math.round(valor_subtotal) + Math.round(val_iva)).toFixed(2);
		document.getElementById("total").value = totaldetodo;
	}

	function funj_descuento() {
		total();
		var totalpd = document.getElementById("total").value;
		var descuentopd = document.getElementById("descuento").value;
		if (parseFloat(descuentopd).toFixed(2) <= parseFloat(totalpd)) {
			var totaldetodopd = (totalpd - descuentopd).toFixed(2);
			document.getElementById("total").value = totaldetodopd;
			document.getElementById("men_desc").style.visibility="hidden";
		}else if(parseFloat(descuentopd).toFixed(2) > parseFloat(totalpd)){
			/*alert("TOTAL: "+totalpd+" - desc: "+parseFloat(descuentopd).toFixed(2)+" result: "+totaldetodopd);*/
			document.getElementById("men_desc").style.visibility="visible";
		}
	}

	function guardar_factura(){
		var fecha_elaboracion = $("#fecha_e1").val();
		var fecha_vencimiento = $("#fecha_v1").val();
		var cedula_nit = $("#cc-nit").val();
		var nom_cliente = $("#nom_cliente").val();
		var tel_cliente = $("#tel_cliente").val();
		var num_factura = $("#num_factura").val();
		var dir_cliente = $("#dir_cliente").val();
		var for_pago = $("#for_pago").val();
		/*-----------------------------*/
		
		var numfilasfactura = $("#num_filas_factura").val();
		for (var i = 1; i <= numfilasfactura; i++) {
			var canti_f = $("#canti"+i).val();
			var referencia_f = $("#referencia"+i).val();
			var precio_compra_f = $("#prec_compra"+i).val();
			var precio_venta_f = $("#prec_venta"+i).val();
			var val_total_f = $("#val_total"+i).val();

			if (canti_f == 0 || canti_f == "") {
				$("#canti"+i).focus();
				return false;
			}else if (referencia_f == 0) {
				$("#referencia"+i).focus();
				return false;
			}else if (precio_compra_f == 0 || precio_compra_f == "") {
				$("#prec_compra"+i).focus();
				return false;
			}else if (precio_venta_f == 0 || precio_venta_f == "") {
				$("#prec_venta"+i).focus();
				return false;
			}else if (val_total_f == 0 || val_total_f == "") {
				$("#val_total"+i).focus();
				return false;
			}
		}
		/*-----------------------------*/
		var ind_bat_r = $('input:radio[name=tipo_attach]:checked').val();
		if (ind_bat_r == "si") {
			var numfilasregaladas = $("#num_filas_regaladas").val();
			for (var i = 1; i <= numfilasregaladas; i++) {
				
				var cant_regalada = $("#cant_regalada"+i).val();
				var referencia_r = $("#referencia_regal"+i).val();

				if (cant_regalada == 0 ||cant_regalada == "") {
					$("#cant_regalada"+i).focus();
					return false;
				}else if (referencia_r == 0) {
					$("#referencia_regal"+i).focus();
					return false;
				}
			}
		}
		var ind_descuento = $('input:radio[name=desc]:checked').val();
		if (ind_descuento == "otro") {
			var valor_descuento = $("#descuento").val();
			if (valor_descuento == "") {
				$("#descuento").focus();
					return false;
			}
		}
		/*-----------------------------*/
		var val_sub_total = $("#sub_total").val();
		var val_iva = $("#iva").val();
		var val_total = $("#total").val();
		if (val_sub_total == 0 && val_sub_total == "") {
			$("#sub_total").focus();
				return false;
		}else if (val_iva == 0 && val_iva == "") {
			$("#iva").focus();
				return false;
		}else if (val_total == 0 && val_total == "") {
			$("#total").focus();
				return false;
		}

		/*-----------------------------*/
		var form1 = $("#form1");
		var formData = new FormData(form1);
	        formData.append('fecha_elaboracion',fecha_elaboracion);
	        formData.append('fecha_vencimiento',fecha_vencimiento);
	        formData.append('cedula_nit',cedula_nit);
	        formData.append('tel_cliente',tel_cliente);
	        formData.append('num_factura',num_factura);
	        formData.append('dir_cliente',dir_cliente);
		    formData.append('for_pago',for_pago);
		    formData.append('valor_descuento',valor_descuento);
		    formData.append('val_sub_total',val_sub_total);
		    formData.append('val_iva',val_iva);
		    formData.append('val_total',val_total);
		/*-----------------------------*/
		var numfilasfactura = $("#num_filas_factura").val();
		for (var i = 1; i <= numfilasfactura; i++) {
			var canti_f = $("#canti"+i).val();
			var referencia_f = $("#referencia"+i).val();
			var precio_compra_f = $("#prec_compra"+i).val();
			var precio_venta_f = $("#prec_venta"+i).val();
			var val_total_f = $("#val_total"+i).val();

			
				formData.append('ind_bat_n',"TRUE");
				formData.append('ind_bat_r',"FALSE");
				formData.append('canti_f',canti_f);
				formData.append('referencia_f',referencia_f);
				formData.append('precio_compra_f',precio_compra_f);
				formData.append('precio_venta_f',precio_venta_f);
				formData.append('val_total_f',val_total_f);

	        $.ajax({
	            url: 'php/insert_f_compra.php',
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            type: 'POST',
	            beforeSend: function () {
                    $("#cargando").attr("class","cargando");
            	},
	            success: function(data){
	                alert(data);
                    $("#cargando").attr("class","ocultar");
	            }
	        });
		}
		/*-----------------------------*/
		if (ind_bat_r == "si") {
			var numfilasregaladas = $("#num_filas_regaladas").val();
			for (var i = 1; i <= numfilasregaladas; i++) {
				var cant_regalada = $("#cant_regalada"+i).val();
				var referencia_r = $("#referencia_regal"+i).val();
				
					formData.append('ind_bat_r',"TRUE");
					formData.append('ind_bat_n',"FALSE");
					formData.append('cant_regalada',cant_regalada);
					formData.append('referencia_r',referencia_r);

		        $.ajax({
		            url: 'php/insert_f_compra.php',
		            data: formData,
		            cache: false,
		            contentType: false,
		            processData: false,
		            type: 'POST',
		            beforeSend: function () {
                    $("#cargando").attr("class","cargando");
	            	},
		            success: function(data){
		                alert(data);
	                    $("#cargando").attr("class","ocultar");
		            }
		        });
			}
		}
		/*window.print();
		return false;*/
		/*-----------------------------*/
	}
</script>
<!-- FUNCION PARA AGREGAR FILA A LA TABLA: 'SEGUNDA PARTE DE LA FACTURA'  -->

<script language="javascript">

    function agregar_fila() {
    	var numfila = $("#num_filas_factura").val();
    	numfila = parseInt(numfila) + 1;
    	$("#num_filas_factura").val(numfila);
	    var tabla = $("#factura");
	   	var filapd = $("#filafactura1").html();
	   	var referenciapd = $("#referencia1").html();
	   	tabla.append('<tr class="superiorizquierdo inferiorizquierdo inferiorderecho superiorderecho" id="filafactura'+numfila+'">'+
	   		'<td class="superiorizquierdo colcant">		<input type="number" id="canti'+numfila+'" name="canti'+numfila+'" class="canti" onkeyup="valor('+numfila+');"></td>'+
	   		'<td class="centrado widthart"> <select name="referencia'+numfila+'" id="referencia'+numfila+'" class="select"> '+referenciapd+' </select> </td>'+
	   		'<td class="centrado"> <input type="number" onkeyup="valor('+numfila+');" name="prec_compra'+numfila+'" id="prec_compra'+numfila+'" class="val_uni"></td>'+
	   		'<td class="centrado"> <input type="number" id="prec_venta'+numfila+'" name="prec_venta'+numfila+'" class="val_uni"></td>'+
	   		'<td class="colvaltotal"><input type="number" id="val_total'+numfila+'" name="val_total'+numfila+'" class="val_total"></td>'+
	   		'<td class="superiorderecho colvaltotal"><input type="button" id="delete'+numfila+'" name="delete'+numfila+'" value="-" onclick="borrar_fila('+numfila+');"></td>'+
	   		'</tr>'
	   	);
	}

	function borrar_fila(numfila){
	    $("#filafactura"+numfila).remove();
		numfilanext = numfila + 1;
		var numfilasfactura = $("#num_filas_factura").val();
		for (var i = numfila; i <= numfilasfactura; i++) {
			$("#filafactura"+numfilanext).attr("id","filafactura"+numfila);

			$("#canti"+numfilanext).attr("id","canti"+numfila);
			$("#canti"+numfila).attr("name","canti"+numfila);
			$("#canti"+numfila).attr("onkeyup","valor("+numfila+")");

			$("#referencia"+numfilanext).attr("id","referencia"+numfila);
			$("#referencia"+numfila).attr("name","referencia"+numfila);

			$("#prec_compra"+numfilanext).attr("id","prec_compra"+numfila);
			$("#prec_compra"+numfila).attr("name","prec_compra"+numfila);
			$("#prec_compra"+numfila).attr("onkeyup","valor("+numfila+")");

			$("#prec_venta"+numfilanext).attr("id","prec_venta"+numfila);
			$("#prec_venta"+numfila).attr("name","prec_venta"+numfila);

			$("#val_total"+numfilanext).attr("id","val_total"+numfila);
			$("#val_total"+numfila).attr("name","val_total"+numfila);

			$("#delete"+numfilanext).attr("id","delete"+numfila);
			$("#delete"+numfila).attr("name","delete"+numfila);
			$("#delete"+numfila).attr("onclick","borrar_fila("+numfila+")");
		}
		$("#num_filas_factura").val(numfilasfactura - 1);
		total();
	}

	function agregar_fila_regalada() {
	    var numfila = $("#num_filas_regaladas").val();
    	numfila = parseInt(numfila) + 1;
    	$("#num_filas_regaladas").val(numfila);
	    var tabla = $("#regalada");
	   	var filapd = $("#fila_regalada1").html();
	   	var referenciapd = $("#referencia_regal1").html();
	   	tabla.append('<tr id="fila_regalada'+numfila+'">'+
	   		'<td class="colcant"><input type="number" name="cant_regalada'+numfila+'" id="cant_regalada'+numfila+'"></td>'+
	   		'<td class="centrado widthart"><select name="referencia_regal'+numfila+'" id="referencia_regal'+numfila+'" class="select">'+referenciapd+'</select></td>'+
	   		'<td class="superiorderecho colvaltotal"><input type="button" name="delete_regalada'+numfila+'" id="delete_regalada'+numfila+'" value="-" onclick="borrar_fila_regalada('+numfila+');"></td>'+
	   		'</tr>'
	   	);
	}
	function borrar_fila_regalada(numfila){
		$("#fila_regalada"+numfila).remove();
		numfilanext = numfila + 1;
		var numfilasregaladas = $("#num_filas_regaladas").val();
		for (var i = numfila; i <= numfilasregaladas; i++) {
			$("#fila_regalada"+numfilanext).attr("id","fila_regalada"+numfila);

			$("#cant_regalada"+numfilanext).attr("id","cant_regalada"+numfila);
			$("#cant_regalada"+numfila).attr("name","cant_regalada"+numfila);

			$("#referencia_regal"+numfilanext).attr("id","referencia_regal"+numfila);
			$("#referencia_regal"+numfila).attr("name","referencia_regal"+numfila);
			
			$("#delete_regalada"+numfilanext).attr("id","delete_regalada"+numfila);
			$("#delete_regalada"+numfila).attr("name","delete_regalada"+numfila);
			$("#delete_regalada"+numfila).attr("onclick","borrar_fila_regalada("+numfila+")");
		}
		$("#num_filas_regaladas").val(numfilasregaladas - 1);
	}
	function vaciar_campo(input) {
	   
	    input.value = "";
	   
	}
</script>

<!-- FUNCIÓN PARA EL DESCUENTO -->

<script>
	function habilitar(value)
	{
		if(value=="otro")
		{
			// habilitamos
			document.getElementById("descuento").disabled=false;
		}else{
			// deshabilitamos
			document.getElementById("descuento").disabled=true;
			$("#descuento").val(0);
			funj_descuento();
		}
	}
</script>
</html>