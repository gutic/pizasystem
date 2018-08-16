<?php
require("config/config.php");

$nombres=$_GET['nombres'];
$email=$_GET['tel'];
$tipusr = $_GET['tipusr'];
$contr = $_GET['contr'];
mysqli_query($conexion, "INSERT INTO Usuario (Id, Usuario, Contrasena, Email, TipoUsuario ) VALUES(NULL, '$nombres','$contr','$email','$tipusr');");
 ?>
