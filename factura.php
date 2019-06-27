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
				<td><input type="text" class="form-control" name="num" id="num" placeholder="Clic y enter para buscar todo" onchange="buscar();" size="40"></td>
				<br>
			</tr>
			<tr>
				<td><b>Tipo de operación: </b></td>
				<td>
					<select id="tipo" onchange="buscar();">
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


	  <div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
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
