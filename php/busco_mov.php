<?php
require("../config/config.php");
$tipo = $_POST['tipo'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$boton = $_POST['boton'];

  switch ($boton) {
    case 'busco':
    if($tipo == 5){ // 5 Todo
      $query = "SELECT fact.*, usr.Usuario, det.*, IF(det.tipo_operacion = 1 OR det.tipo_operacion = 2 , SUM((det.Cantidad * det.Precio)*fact.Iva + (det.Cantidad * det.Precio)),SUM(det.Precio)) as total
      FROM Factura as fact, Usuario as usr, DetalleFactura as det
      WHERE (fact.Fecha >= '$desde 00:00:00' AND fact.fecha <= '$hasta 23:59:59')
	    AND fact.usuario = usr.Id
      AND (det.NroComprobante = fact.NroComprobante OR det.NroComprobante = fact.id_compra OR det.NroComprobante = fact.id_egreso OR det.NroComprobante = fact.id_ingreso)
      AND fact.tipo_operacion = det.tipo_operacion
      GROUP BY fact.Id
      ORDER BY fact.Fecha";
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
      $query = "SELECT fact.Id, fact.Persona,fact.NroComprobante,fact.Fecha, fact.tipo_operacion, fact.usuario, fact.Descuento, usr.Usuario, det.NroComprobante,
      SUM((det.Cantidad * det.Precio)*fact.Iva + (det.Cantidad * det.Precio)) as total, det.tipo_operacion
      FROM Factura as fact, Usuario as usr, DetalleFactura as det
      WHERE (fact.Fecha >= '$desde 00:00:00'AND
       fact.fecha <= '$hasta 23:59:59')
      AND fact.usuario = usr.Id
      AND det.NroComprobante = fact.NroComprobante
      AND fact.tipo_operacion = 1
      AND det.tipo_operacion = 1
      GROUP BY fact.Id";
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
    if($tipo_op == 4){ //ingreso dinero
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
    }else { //egreso de dinero
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
