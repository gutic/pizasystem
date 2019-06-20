<?php
require("../config/config.php");
$tipo = $_POST['tipo'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$boton = $_POST['boton'];
//1 vta, 2 compra, 3 extraxion, 4 ingreso
  switch ($boton) {
    case 'busco':

      if($tipo == 5){ // 5 Todo
        $query = "SELECT fact.*, fact.Id as idFactura, usr.Usuario, det.*, IF(det.tipo_operacion = 1 , SUM((det.Cantidad * det.Precio)*fact.Iva + (det.Cantidad * det.Precio)),SUM(det.Precio)) as total
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
          $saldo = saldoAnterior($desde);
          $data[] = array('tipo_operacion' => 5, 'anterior' => $saldo);
          echo json_encode($data);
        }else{
          echo 0;
        }
      }
      if($tipo == 1){ //venta
        $query = "SELECT fact.Id as idFactura, fact.Persona,fact.NroComprobante,fact.Fecha, fact.tipo_operacion, fact.usuario, fact.Descuento, usr.Usuario, det.NroComprobante,
        SUM((det.Cantidad * det.Precio)*fact.Iva + (det.Cantidad * det.Precio)) as total, det.tipo_operacion
        FROM Factura as fact, Usuario as usr, DetalleFactura as det
        WHERE (fact.Fecha >= '$desde 00:00:00'AND
         fact.fecha <= '$hasta 23:59:59')
        AND fact.usuario = usr.Id
        AND det.NroComprobante = fact.NroComprobante
        AND fact.tipo_operacion = 1
        AND det.tipo_operacion = 1
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
      }
      if($tipo == 2){ //compra
        $query = "SELECT fact.Id as idFactura, fact.Persona,fact.NroComprobante,fact.Fecha, fact.tipo_operacion, fact.usuario, fact.Descuento, usr.Usuario, det.NroComprobante,
        SUM(det.Precio) as total, det.tipo_operacion
        FROM Factura as fact, Usuario as usr, DetalleFactura as det
        WHERE (fact.Fecha >= '$desde 00:00:00'AND
         fact.fecha <= '$hasta 23:59:59')
        AND fact.usuario = usr.Id
        AND fact.id_compra = det.NroComprobante
        AND fact.tipo_operacion = 2
        AND det.tipo_operacion = 2
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
      }
      if($tipo == 3){ //extraxion
        $query = "SELECT fact.id as idFactura, fact.*, usr.Usuario, det.*, SUM(det.Precio) as total
        FROM Factura as fact, Usuario as usr, DetalleFactura as det
        WHERE (fact.Fecha >= '$desde 00:00:00' AND fact.fecha <= '$hasta 23:59:59')
        AND fact.usuario = usr.Id
        AND fact.id_egreso = det.NroComprobante
        AND fact.tipo_operacion = 3
        AND det.tipo_operacion = 3
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
      }
      if($tipo == 4){ //ingres
        $query = "SELECT fact.id as idFactura, fact.*, usr.Usuario, det.*, SUM(det.Precio) as total
        FROM Factura as fact, Usuario as usr, DetalleFactura as det
        WHERE (fact.Fecha >= '$desde 00:00:00' AND fact.fecha <= '$hasta 23:59:59')
        AND fact.usuario = usr.Id
        AND fact.id_ingreso = det.NroComprobante
        AND fact.tipo_operacion = 4
        AND det.tipo_operacion = 4
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
    case 'cliente_producto':
      $query = "SELECT fac.id as factura, date_format(fac.Fecha,'%d/%m/%Y') as Fecha, det.Cantidad, pr.NombreProducto, per.Nombre
      FROM Factura as fac, DetalleFactura as det, Persona as per, Producto as pr
      WHERE fac.NroComprobante = det.NroComprobante AND det.IdProducto = pr.Id AND fac.Persona = per.Id AND det.IdProducto = pr.Id";
      $resultado = $conexion -> query($query);
      if($resultado->num_rows > 0){
        while ($reg = mysqli_fetch_assoc($resultado)) {
          $data[] = $reg;
        }
        echo json_encode($data);
      }else{
        echo 0;
      }
    break;
    default:
      console.log("default");
      echo json_encode("mal");
      break;
  }

function saldoAnterior($desde){
  require("../config/config.php");
  $query = "SELECT fact.Id, det.tipo_operacion, IF(det.tipo_operacion = 1 , SUM((det.Cantidad * det.Precio)*fact.Iva + (det.Cantidad * det.Precio)),SUM(det.Precio)) as subtotal
    FROM Factura as fact, Usuario as usr, DetalleFactura as det
    WHERE (fact.Fecha <= '$desde 00:00:00')
    AND fact.usuario = usr.Id
    AND (det.NroComprobante = fact.NroComprobante OR det.NroComprobante = fact.id_compra OR det.NroComprobante = fact.id_egreso OR det.NroComprobante = fact.id_ingreso)
    AND fact.tipo_operacion = det.tipo_operacion
    GROUP BY fact.Id
    ORDER BY fact.Fecha";
    $resultado = $conexion -> query($query);
    if($resultado->num_rows > 0){
      while( $fila = $resultado -> fetch_assoc()){
        if($fila['tipo_operacion'] == 1 || $fila['tipo_operacion'] == 4 ){
          $saldo_anterior = $fila['subtotal'] + $saldo_anterior;
        }else{
          $saldo_anterior = $saldo_anterior - $fila['subtotal'];
        }
      }
      return $saldo_anterior;
    }else{
      return 0;
    }
}
?>
