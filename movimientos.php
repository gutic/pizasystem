<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');
?>

<script type="text/javascript" src="js/movimientos.js"></script>

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
			<select onchange="buscar();" id="tipo" >
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
<div class="form-row">
	<div class="form-group col-md-1">
		<label for="inputCity">Id</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputState">N°comprobante</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Fecha</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Hora</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Operador</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Detalle</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Ingreso</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Egreso</label>
	</div>
	<div class="form-group col-md-1">
		<label for="inputZip">Saldo</label>
	</div>

</div>


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
