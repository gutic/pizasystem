<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');
?>
<script type="text/javascript" src="js/ajaxListaProductos.js"></script>

<section id="venta">
	<div class="col-xs-0 col-sm-0 col-md-0 col-lg-0 well">
	  <table style="width:100%">
	    <tr>
	      <td style="width:50%" valign="top">
						<fieldset>
							<legend>Filtros</legend>
							<form id="busqueda">
							Buscar por Nombre <input type="text" name="Buscar" id="Buscar" onchange="buscar_datos()" >
							<input type="button" value="Buscar"  onclick="buscar_datos();" />
							<br>
							Cantidad<input type='number' name='Cantidad' id='Cantidad' value='0'>
							<div id="datos" align="left"></div>
							<br>
							<br>
						</form>
						<br>
							<div >
								<table style="width:100%" border="3" bgcolor="black">
									<td style="width:30%">ID</td>

									<td style="width:50%">producto</td>

									<td style="width:10%"> cantidad </td>

									<td style="width:10%">________ </td>

								</table>

								<table id="productos" style="width:100%">

								</table>

							</div>
						<div id="navegador"></div>
					</fieldset>
	      </td>
				<td style="width:50%" valign="top">
					<fieldset>
						<legend>Formulario Venta</legend>
						<form id="formulario">
							<table>
								<tr>
									<td><b>fecha:</b></td>
									<td><input type="date" name="anti" placeholder="dd/mm/aaaa" id="fecha" value="<?php echo date("Y-m-d");?>" readonly="readonly"></td>
								</tr>
								<tr>
									<td><b>Señor(es):</b></td>
									<td><input type="text" name="cliente" id="cliente" onchange="buscar_clientes()" ></td> <!--cliente -->
									<td><input type="button" value="Buscar Clientes"  onclick="buscar_clientes();" /></td>
								</tr>
								<tr>
									<td>Busqueda</td>
									<td id="clientes"></td>
								</tr>
								<tr>
									<td><br></td>
									<td><br></td>
								</tr>
								<tr>
									<td><b>Direcci&oacute;n de emisi&oacute;n:</b></td>
									<td><input type="text" name="dir" id="dir" value="Local Conercial" ></td>					<!--lugar de emision -->
								</tr>
								<tr>
									<td><b>Forma de pago</b></td>
									<td><input type="text" name="formapago" id="formapago" ></td>
								</tr>
								<tr>
									<td><b>Descuento </b></td>
									<td><input type="text" name="Descuento" id="Descuento" value="0"></td>
								</tr>
								<tr>
									<td><b>Tipo Factura</b></td>
									<td>
										<select name="tipofactura" id="tipo_factura">
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="X">X</option>
										</select>
									</td>
								</tr>
							</table>
							<input type="button" value="Limpiar"  onclick="limpiar();" />
							<input type="button" value="Generar Factura" onclick="factura_venta();" />
						</form>
					</fieldset>
				</td>
			</tr>
	    </table>
			<script type="text/javascript">
			</script>
	  <div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
</section>
<script type="text/javascript">
	// funcion que se inicia luego de cargar la pagina
	$(function () {
	location.href="#venta";
	})
</script>
<script type="text/javascript">
function validar(id_prod){
	var Cantidad = $('#Cantidad').val();

	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data: 'Cantidad='+Cantidad+'&id_prod='+id_prod+"&boton=validar"
	}).done(function(resp){
		if(resp == 1){
			agregar(id_prod, Cantidad);
		}else {
			alert("Ingrese Cantidad Mayor a Cero");
		}
	});
}

function agregar(id_prod, Cantidad)
{

		tabla_id[tabla_id.length] = id_prod;
		tabla_cant[tabla_cant.length] = Cantidad;
		$.ajax({
			url:'php/cl_abm.php',
			type:'POST',
			data: 'Cantidad='+Cantidad+'&id_prod='+id_prod+"&boton=agregar"
		}).done(function(resp){
				alert("OK");
				var listado = "";
				data = eval(resp);
				var id_fila = "name"+num;
				listado += '<tr id="'+id_fila+'">'
				listado += '<td  name=$'+num+'  style="width:30%">'+data[0]["Id"]+'</td>'
				listado += '<td  style="width:50%">'+data[0]["NombreProducto"]+'</td>'
				listado += '<td  name=$'+num+' style="width:10%">'+Cantidad+'</td>'
				listado += '<td style="width:10%"><input type="button" value="Eliminar" onclick="$('+id_fila+').remove();borrar('+num+');" /></td>'
				listado += '</tr>'
				$('#productos').append(listado);
				num +=1;
		});
}


</script>

<?php
  	include_once('views/footer.php');
?>
