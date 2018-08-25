<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');

?>
	<form id="formulario">
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
