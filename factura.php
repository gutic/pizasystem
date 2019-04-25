<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');
?>
<!-- Busqueda de facutras -->
<script type="text/javascript" src="js/ajaxListaFacturas.js"></script>
<section id="factura">
	<div class="col-xs-0 col-sm-0 col-md-0 col-lg-0 well">
		<table>
			<tr>
				<td><b>Id de Factura:  </b></td>
				<td><input type="text" class="form-control" name="num" id="num" placeholder="Clic y enter para buscar todo" size="40"></td>
				<br>
			</tr>
			<tr>
				<td><b>Tipo de operación: </b></td>
				<td>
					<select id="tipo">
						<option value="0">Todo</option>
						<option value="1">Ventas</option>
						<option value="2">Compras</option>
					</select>
				</td>
			</tr>
		</table>

		<br>
		<br>

		<div id="datos" align="center"></div>


		<br>
		<br>

		<table id="numero1" style="width:100%" border="3">

	 </table>
	 <table style="width:100%">
		 <tr>
			 <td id="numero2" style="width:45%" valign="top">

			 </td>
			 <td id="numero3" align="center" valign="top">

			 </td>
			 <td id="numero4" align="right" valign="top">

			 </td>
		 </tr>
	 </table>
	 <table style="width:100%" border="3" bgcolor="black">
		 <tr>
			 <td style="width:50%">Detalle</td>
			 <td style="width:20%">cantidad</td>
			 <td style="width:20%">Precio</td>
			 <td style="width:10%">Total</td>
		 </tr>
	 </table>
	 <br>
	 <table id="numero5" style="width:100%" border="1">

	 </table>
	 <table style="width:100%" border="3">
		 <tr>
			 <br>
			 <br>
			 <td style="width:20%, hight:10px" align"left">
				 SUBTOTAL <br>
					 DESCUENTO <br>
					 IVA ___%
			 </td>
			 <td id="numero6" style="width:20%">

			 </td>
			 <td id="numero7" style="width:60%" valign="top">

			 </td>
		 </tr>
	 </table>
	 <br>
	 <br>


	  <div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
	<script type="text/javascript">
		// funcion que se inicia luego de cargar la pagina
		function mostrar(num, tipo)
		{
			$.ajax({
				url:'php/cl_abm.php',
				type:'POST',
				data: 'tipo='+tipo+'&num='+num+"&boton=factura_ya"
			}).done(function(resp){
				if(resp){
					data = eval(resp);
					alert(tipo);
					if(tipo == 1){
						var listado = "";
						listado += '<tr>'
						listado += '<td  style="width:50%" valign="top">EMPRESA: '
						listado += '<br>'
						listado += '<p align="center"> Pizeria Lo Vago SA</p>'
						listado += '</td>'
						listado += '<td style="width:50%">TIPO FACTURA: '+data[0].tipo+' <br>'
						listado += 'NUMERO: '+data[0].numero+' <br> FECHA: '+data[0].fecha+' <br> CUIT: MICUIT  <br>'
						listado += '</td>'
						listado += '</tr>'
					}
					if(tipo == 2){
						var listado = "";
						listado += '<tr>'
						listado += '<td  style="width:50%" valign="top">EMPRESA: '
						listado += '<br>'
						listado += '<p align="center"> '+data[0].nombre_persona+'</p>'
						listado += '</td>'
						listado += '<td style="width:50%">TIPO FACTURA: '+data[0].tipo+' <br>'
						listado += 'NUMERO: '+data[0].numero+' <br> FECHA: '+data[0].fecha+' <br> CUIT: '+data[0].cuit_persona+'  <br>'
						listado += '</td>'
						listado += '</tr>'
					}
					$("#numero1").html( listado );
					if(tipo == 1){
						var listado = "";
						listado += '<br>NOMBRE CLIENTE: '+data[0].nombre_persona+'  </b>'
						listado += '<br>domicilio: '+data[0].direccion+'  '
						listado += '<br>LUGAR de EMISION: '+data[0].direccion_emision+' '
					}
					if(tipo == 2){
						var listado = "";
						listado += '<br>NOMBRE VENDEDOR: '+data[0].nombre_persona+'  </b>'
						listado += '<br>domicilio: '+data[0].direccion+'  '
						listado += '<br>LUGAR de EMISION: '+data[0].direccion_emision+' '
					}
					$("#numero2").html(listado);
					var listado = "";
					listado += '<br>'
					listado += 'CUIT/CUIL: <br> '+data[0].cuit+' '
					$("#numero3").html(listado);
					var listado = "";
					listado += '<br>'
					listado += 'Forma de pago: <br> '+data[0].forma_pago+' '
					$("#numero4").html(listado);
					mostrar_detalle(num, tipo);
				}else{
					alert("Factura No Existente");
				}
			});
	}
		function mostrar_detalle(num, tipo)
		{
			$.ajax({
			type: "POST",
			url: 'php/cl_abm.php',
			data: 'tipo='+tipo+'&num='+num+"&boton=detalle_factura_ya"
			}).done(function(resp){
				if(tipo == 1){
					datos = eval(resp);
					var subtotal = 0;
					var listado = "";
					for(var i=0;i<datos.length;i++){
						var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
						listado += '	<tr bgcolor="'+bgcolor+'">'
						listado += ' 		<td style="width:50%">'+datos[i]["NombreProducto"]+'</td>'
						listado += ' 		<td style="width:20%">'+datos[i]["Cantidad"]+'</td>'
						listado += ' 		<td style="width:20%">$'+datos[i]["Precio"]+'</td>'
						listado += ' 		<td style="width:10%">$'+(datos[i]["Precio"]*datos[i]["Cantidad"]).toFixed(2)+'</td>'
						listado += '	</tr>'
						subtotal += datos[i]["Precio"]*datos[i]["Cantidad"];
					}
				}
				if(tipo == 2){
					datos = eval(resp);
					var subtotal = 0;
					var listado = "";
					for(var i=0;i<datos.length;i++){
						var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
						listado += '	<tr bgcolor="'+bgcolor+'">'
						listado += ' 		<td style="width:50%">'+datos[i]["Nombre"]+'</td>'
						listado += ' 		<td style="width:20%">'+datos[i]["Cantidad"]+'</td>'
						listado += ' 		<td style="width:20%">$'+datos[i]["Precio"]+'</td>'
						listado += ' 		<td style="width:10%">$'+(datos[i]["Precio"]*datos[i]["Cantidad"]).toFixed(2)+'</td>'
						listado += '	</tr>'
						subtotal += datos[i]["Precio"]*datos[i]["Cantidad"];
					}
				}
				$("#numero5").html(listado);
				if(tipo == 1){
					iva = subtotal*(datos[0]["Iva"]);
					total = (iva + subtotal)-(datos[0]["Descuento"]);
					var lista = "";
					lista += ' $'+subtotal.toFixed(2)+''
					lista += ' <br> $'+datos[0]["Descuento"]+' '
					lista += '<br> $'+iva.toFixed(2)+''
				}
				if(tipo == 2){
					total = subtotal;
					var lista = "";
					lista += ' $'+subtotal.toFixed(2)+''

				}
				$("#numero6").html(lista);

				var lista = "";
				lista += 'TOTAL'
				lista += '<br>'
				lista += '<p align="center"> $'+total.toFixed(2)+'</p>'
				$("#numero7").html(lista);

			});

		}
	</script>
</section>


<script type="text/javascript">
	// funcion que se inicia luego de cargar la pagina
	$(function () {
	location.href="#factura";
	})
</script>
<?php
    include_once('views/footer.php');
?>
