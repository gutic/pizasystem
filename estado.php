<?php
require("config/config.php");

    $respuesta = array();
    $respuesta["Pedidos"] = array();

// Conectarse al servidor y seleccionar base de datos.

$sql="SELECT estado FROM Pedidos where estado != 5";
$result=mysqli_query($conexion,$sql);
if(mysqli_num_rows($result)!=0){
    while($row = mysqli_fetch_array($result)){
        // Array temporal para crear una sola categoría
        $tmp = array();
        $tmp["estado"] = $row["estado"];

        // Push categoría a final json array
        array_push($respuesta["Pedidos"], $tmp);
    }

    // Mantener el encabezado de respuesta a json
    header('Content-Type: application/json');

    //Escuchando el resultado de json
    echo json_encode($respuesta);
}else {
  $tmp["estado"] = 5;
  array_push($respuesta["Pedidos"], $tmp);
  header('Content-Type: application/json');
  //Escuchando el resultado de json
  echo json_encode($respuesta);
}
?>
