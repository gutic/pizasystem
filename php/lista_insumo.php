
<?php
require("../config/config.php");
$consulta = $_POST['consulta'];

$salida ="";
//si no pone nada tomo todo

	$query = "SELECT * FROM Insumo WHERE activo ='1'";


//si escribió algo en buscar
if(isset($_POST['consulta'])){
	$id = $conexion -> real_escape_string($_POST['consulta']);
	$query = "SELECT * FROM Insumo WHERE activo = '1' AND (Nombre like '%".$id."%' OR Id_insumo like '%".$id."%')";
}

$resultado = $conexion -> query($query);

if($resultado->num_rows > 0){

	$salida .= "<table class='tabla_datos' border='2'>
					<thead>
						<tr>
						  <td>Insumos</td>
						</tr>
					</thead>
					<tbody>";
  $x=0;
  $name[$x] = "";
  while($fila = $resultado -> fetch_assoc()){
      $name[$x] = $fila['Nombre'];
      $salida.="<tr>
					<td>".$fila['Nombre']."</td>
					<td><a class='btn btn-success btn-sm'  onclick='agregar_insumo(".$fila['Id_insumo'].");'>Agregar</a></td>
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
