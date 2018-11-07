<?php
require("../config/config.php");
$tipo = $_POST['tipo'];
$date1 = $_POST['fecha1'];
$date2 = $_POST['fecha2'];
$boton = $_POST['boton'];
  switch ($boton) {
    case 'busco':

    if($tipo == 5){
      $query = "SELECT fact.*, usr.Usuario FROM Factura as fact INNER JOIN Usuario as usr WHERE fact.usuario = usr.Id";
      $resultado = $conexion -> query($query);
      if($resultado->num_rows > 0){
        while ($reg = mysqli_fetch_assoc($resultado)) {
          $data[] = $reg;
        }
        echo json_encode($data);
        console.log($data);
      }else{
        echo 0;
      }
    }else {
      $query = "SELECT fact.*, usr.Usuario FROM Factura as fact INNER JOIN Usuario as usr WHERE fact.usuario = usr.Id AND tipo_operacion = '$tipo'";
      $resultado = $conexion -> query($query);
      if($resultado->num_rows > 0){
        while ($reg = mysqli_fetch_assoc($resultado)) {
          $data[] = $reg;
        }
        echo json_encode($data);
      }else{
        echo 0;
      }
    }
    break;
    case 'detalle':
    $tipo_op = $_POST['tipos'];
    $id = $_POST['id'];
    if($tipo_op == 4){
      $query = "SELECT fact.*, df.* FROM Factura as fact INNER JOIN DetalleFactura as df WHERE fact.ID = '$id' AND fact.tipo_operacion = df.tipo_operacion  AND fact.id_ingreso = df.NroComprobante";
      $resultado = $conexion -> query($query);
      if($resultado->num_rows > 0){
        while ($reg = mysqli_fetch_assoc($resultado)) {
          $data[] = $reg;
        }
        echo json_encode($data);
      }else{
        echo 0;
      }
    }else {
      $query = "SELECT fact.*, df.* FROM Factura as fact INNER JOIN DetalleFactura as df WHERE fact.ID = '$id' AND fact.tipo_operacion = df.tipo_operacion  AND fact.id_egreso = df.NroComprobante";
      $resultado = $conexion -> query($query);
      if($resultado->num_rows > 0){
        while ($reg = mysqli_fetch_assoc($resultado)) {
          $data[] = $reg;
        }
        echo json_encode($data);
      }else{
        echo 0;
      }
    }
    break;
  }





?>
