<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');

?>
<script type="text/javascript" src="js/ajaxListaProductos.js"></script>

<section id="compra">
	<div class="col-xs-0 col-sm-0 col-md-0 col-lg-0 well">
	  <table style="width:100%">
	    <tr>
	      <td style="width:50%" valign="top">
						<fieldset>
							<legend>Productos</legend>
							<form id="busqueda">
							Buscar producto <input type="text" name="Buscar" id="Buscar" onchange="buscar_datos_producto()" >
							<input type="button" value="Buscar"  onclick="buscar_datos_producto();" />
							<br>
							Cantidad<input type="number" id="Cantidad" value="0">
							<br>
							Precio Total<input type="number" id="precio" value="0">

							<div id="datos" align="left"></div>

							<br>
						</form>
						<br>
							<div >
								<table style="width:100%" border="3" bgcolor="black">
									<td style="width:30%">ID</td>

									<td style="width:40%">producto</td>

									<td style="width:10%"> cantidad </td>

									<td style="width:10%"> Precio Total </td>

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
						<legend>Formulario Compra Insumo</legend>
						<form id="formulario">
							<table>
								<tr>
									<td><b>fecha:</b></td>
									<td><input type="date" name="fecha" placeholder="dd/mm/aaaa" id="fecha" value="<?php echo date("Y-m-d");?>"></td>
								</tr>
								<tr>
									<td><b>Provedor:</b></td>
									<td><input type="text" name="prove" id="prove" onchange="buscar_provedores()" ></td> <!--cliente -->
									<td><input type="button" value="Buscar Proveedor"  onclick="buscar_provedores();" /></td>
								</tr>
								<tr>
									<td>Busqueda</td>
									<td id="provedores"></td>
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
							<input type="button" value="Generar Factura" onclick="factura_compraProducto();" />
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
	location.href="#compra";
	})
</script>


<?php
  	include_once('views/footer.php');
?>
