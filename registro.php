<?php
require("config/config.php");

$cantidad=$_GET['cantidad'];
$producto=$_GET['producto'];

mysqli_query($conexion, "INSERT INTO Pedidos (cantidad, producto, estado) VALUES('$cantidad','$producto',0);");
 ?>
