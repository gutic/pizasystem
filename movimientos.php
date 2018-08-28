<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');

?>
<form class="p-3 mb-2 bg-dark text-white">

<div class="form-row">
	<div class="form-group col-md-3">
		<label for="inputState">Tipo Movimiento</label>
			<select id="tipo" class="form-control">
				<option selected>Tipo...</option>
				<option value="0">Venta</option>
				<option value="1">Extraxión</option>
				<option id="compra">Compra</option>

			</select>
	</div>
	<div class="form-group col-md-3">
		<label>Desde</label>
		<input type="date" class="form-control" id="fecha1">
	</div>
	<div class="form-group col-md-3">
		<label>Hasta</label>
		<input type="date" class="form-control" id="fecha2">
	</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputCity">City</label>
			<input type="text" class="form-control" id="inputCity">
		</div>
	<div class="form-group col-md-4">
		<label for="inputState">State</label>
			<select id="inputState" class="form-control">
				<option selected>Choose...</option>
				<option>...</option>
			</select>
	</div>
		<div class="form-group col-md-2">
			<label for="inputZip">Zip</label>
			<input type="text" class="form-control" id="inputZip">
		</div>
		</div>
		<div class="form-group">
		<div class="form-check">
			<input class="form-check-input" type="checkbox" id="gridCheck">
			<label class="form-check-label" for="gridCheck">
				Check me out
			</label>
		</div>
		</div>
		<button type="submit" class="btn btn-primary">Sign in</button>

</form>

	<form style="center">
		<table>
			<tr>
				<td bgcolor="white">Buscar desde:</td>
				<td><input type="date" name="fecha1" placeholder="dd/mm/aaaa" id="fecha1"></td>
			</tr>
			<tr>
				<td bgcolor="white">Hasta:</td>
				<td><input type="date" name="fecha2" placeholder="dd/mm/aaaa" id="fecha2" value="<?php echo date("Y-m-d");?>"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td><center>
				<input type="button" value="Buscar Movimientos" onclick="movimientos_caja();">
				</center></td>
			</tr>
		</table>

		<div id="resultado">

		</div>
		<br>
		<br>
		<div id="total">

		</div>

	</form>
<?php
  	include_once('views/footer.php');
?>
