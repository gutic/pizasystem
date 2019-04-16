<?php
require("config/config.php");

$id=$_GET["id"];


if($resultset=mysqli_query($conexion,"SELECT * FROM `Usuario` WHERE Id='$id'")){
	while ($row = $resultset->fetch_array(MYSQLI_NUM)){
		echo json_encode($row);
	}
}else {
	$datos[0] = 0;
	$datos[1] = 0;
	$datos[2] = 0;
	$datos[3] = 0;
	echo json_encode($datos);
}

?>
