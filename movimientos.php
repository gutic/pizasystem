<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');
?>

<form class="p-3 mb-2 bg-dark text-white">
	<div class="form-row">
		<label>Busqueda</label>
	</div>

	<div class="form-row">
		<div class="form-group col-md-3">
			<label>Desde</label>
			<input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" id="fecha1" onchange="validar_desde();">
		</div>
		<div class="form-group col-md-3">
			<label>Hasta</label>
			<input type="date" class="form-control"  value="<?php echo date("Y-m-d");?>" id="fecha2" onchange="validar_hasta();">
		</div>
			<div class="form-group col-md-1">
				<label for="inputState">Tipo Movimiento</label>
					<select onchange="buscar();" id="tipo">
						<option selected value="5">Todo...</option>
						<option value="1">Venta</option>
						<option value="2">Compra</option>
						<option value="3">Extracción</option>
						<option value="4">Ingreso</option>
					</select>
			</div>
			<div class="form-group col-md-4">
				<button type="button" class="btn btn-default" onclick="buscar();">Buscar</button>
			</div>
		</div>


	<table style="width:100%" id="resultado" border="1">

	</table>


		<div id="resultado">

</form>

		<br>
		<br>
		<div id="total">

		</div>

	</form>
<?php
  	include_once('views/footer.php');
?>
