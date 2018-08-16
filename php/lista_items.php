
<?php
require("../config/config.php");
$consulta = $_POST['consulta'];

$salida ="";
//si no pone nada tomo todo

	$query = "SELECT * FROM Producto WHERE activo = 1";


//si escribió algo en buscar
if(isset($_POST['consulta'])){
	$id = $conexion -> real_escape_string($_POST['consulta']);
	$query = "SELECT * FROM Producto WHERE activo = '1' AND (NombreProducto like '%".$id."%' OR Id like '%".$id."%')";
}

$resultado = $conexion -> query($query);

if($resultado->num_rows > 0){

	$salida .= "<table class='tabla_datos' border='2'>
					<thead>
						<tr>
						  <td>Productos</td>
						</tr>
					</thead>
					<tbody>";
  $x=0;
  $name[$x] = "";
  while($fila = $resultado -> fetch_assoc()){
      $name[$x] = $fila['NombreProducto'];
      $salida.="<tr>
					<td>".$fila['NombreProducto']."</td>
					<td><a class='btn btn-success btn-sm'  onclick='validar(".$fila['Id'].");'>Agregar</a></td>
			</tr>";
      $x +=1;
	}

	$salida.="</tbody></table>";

}else{
	$salida.= "<div class='alert alert-danger' role='alert'><b>Datos no Encontrados !!!</b></div>";

}

echo $salida;

$conexion -> close();

?>
