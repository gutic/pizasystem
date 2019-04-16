<?php
require("config/config.php");

    $respuesta = array();
    $respuesta["productos"] = array();

// Conectarse al servidor y seleccionar base de datos.

$sql="SELECT Id, NombreProducto FROM Producto";
$result=mysqli_query($conexion,$sql);
    while($row = mysqli_fetch_array($result)){
        // Array temporal para crear una sola categoría
        $tmp = array();
        $tmp["Id"] = $row["Id"];
        $tmp["NombreProducto"] = $row["NombreProducto"];

        // Push categoría a final json array
        array_push($respuesta["productos"], $tmp);
    }

    // Mantener el encabezado de respuesta a json
    header('Content-Type: application/json');

    //Escuchando el resultado de json
    echo json_encode($respuesta);
?>
