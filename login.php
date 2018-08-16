<?php
require("config/config.php");

$id=$_GET["id"];


if($resultset=mysqli_query($conexion,"SELECT * FROM `Usuario` WHERE Email='$id'")){
	while ($row = $resultset->fetch_array(MYSQLI_NUM)){
		echo json_encode($row);
	}
}

?>
