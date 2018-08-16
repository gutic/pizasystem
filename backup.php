<select>
	<option value="0">Selección:</option>
	<?php
	$query = $conexion -> query ("SELECT * FROM Persona WHERE TipoPersona = 2");
	while ($valores = mysqli_fetch_array($query)) {
		echo '<option value="'.$valores[0].'">'.$valores[2].'</option>';
	}
	?>
</select>
