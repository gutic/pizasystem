<?php
require("config/config.php");

$Estado=$_GET['Estado'];


mysqli_query($conexion, "UPDATE Pedidos SET estado = '5';");
 ?>
