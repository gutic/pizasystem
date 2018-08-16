
<?php
require("../config/config.php");
$consulta = $_POST['consulta'];

$salida ="";
//si no pone nada tomo todo

	$query = "SELECT Id, Nombre FROM Persona WHERE activo = '1' AND TipoPersona = '2'";


//si escribió algo en buscar
if(isset($_POST['consulta'])){
	$id = $conexion -> real_escape_string($_POST['consulta']);
	$query = "SELECT * FROM Persona WHERE activo = '1' AND TipoPersona = '2' AND (Nombre like '%".$id."%' OR Id like '%".$id."%')";
}

$resultado = $conexion -> query($query);

if($resultado->num_rows > 0){

  while ($reg = mysqli_fetch_assoc($resultado)) {
    $data[] = $reg;
  }
  echo json_encode($data);

}else{
	echo 0;

}

$conexion -> close();

?>
