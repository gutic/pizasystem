<?php

	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');

?>
 <div align="center" style="width:60%" class="col-xs-50 col-sm-0 col-md-50 col-lg-0 well">
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

	<a valign="center" href="venta_factura.php">Volver Menu venta</a>
	<script type="text/javascript">
	// funcion que se inicia luego de cargar la pagina
	$(function () {
		mostrar_factura(NumeroFactura);
	})
	</script>
<?php
   include_once('views/footer.php');
	?>
