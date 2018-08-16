<?php
require("../config/config.php");
//extiende de la clase mysql asi no tngo q instanciarla
//la clase mysql conecta a la base
$boton=$_POST['boton'];

switch ($boton) {
  case 'factura_compra':
  $tabla_cant = $_POST['tabla_cant'];
  $tabla_id = $_POST['tabla_id'];
  $tabla_precio = $_POST['tabla_precio'];
  $fecha = $_POST['fecha'];
  $ff= explode("/",$fecha);
  $prove = $_POST['prove'];
  $dir = $_POST['dir'];
  $formapago = $_POST['formapago'];
  $tipo_factura = $_POST['tipo_factura'];
  $descuento = $_POST['Descuento'];
  $no_vacio = strlen($fecha) * strlen($prove) * strlen($dir) * strlen($formapago);
  $tabla_id= explode(",",$tabla_id);  //el array tabla_id y tabla_cant me los envia separados por ',' los datos. hago el split
  $tabla_cant= explode(",",$tabla_cant);
  $tabla_precio = explode(",",$tabla_precio);
  if ($no_vacio > 0 && $tabla_cant[0] > 0 ){
    $num_factura = ulti_factura(2);
    $result = mysqli_query($conexion,"SELECT * FROM Persona WHERE Nombre = '$prove';");
    if($reg_cli = mysqli_fetch_array($result)){
      mysqli_query($conexion, "INSERT INTO Factura (Id, Tipo, FormaPago, Persona, id_compra, Fecha, Descuento, Direccion, tipo_operacion) VALUES(NULL, '$tipo_factura','$formapago','$reg_cli[0]','$num_factura','".$ff[0]."-".$ff[1]."-".$ff[2]."','$descuento','$dir','2');");
      for ($i=0; $i < sizeof($tabla_id); $i++) {
        if ($tabla_id[$i] > 0){
          $result = mysqli_query($conexion,"SELECT Stock, Id FROM Producto WHERE Id ='$tabla_id[$i]';");
          $reg_producto = mysqli_fetch_array($result);
          $stock_actual = $reg_producto[0] + $tabla_cant[$i];
          mysqli_query($conexion, "UPDATE Producto SET Stock = '$stock_actual' WHERE Id = '$tabla_id[$i]';") or
          die("Problemas en el select:".mysqli_error($conexion));
          //agregar a detalle factura
          mysqli_query($conexion, "INSERT INTO DetalleFactura (Id, NroComprobante, IdProducto, Cantidad, Precio, tipo_operacion) VALUES(NULL, '$num_factura','$tabla_id[$i]','$tabla_cant[$i]','$tabla_precio[$i]','5');");
        };
      };
      echo $num_factura;
    }else {
      echo -1;
    };
  }else {
    echo 0;
  };
  break;
}

function ulti_factura($tipo){
  require("../config/config.php");
  if($tipo == 1){
    //venta
    $registros=mysqli_query($conexion,"SELECT NroComprobante FROM Factura;") or
      die("Problemas en el select:".mysqli_error($conexion));
  }
  if($tipo == 2){
    //compra
    $registros=mysqli_query($conexion,"SELECT id_compra FROM Factura;") or
      die("Problemas en el select:".mysqli_error($conexion));
  }
  if($tipo == 3){
    //egreso dinero
    $registros=mysqli_query($conexion,"SELECT id_egreso FROM Factura;") or
      die("Problemas en el select:".mysqli_error($conexion));
  }
  if($tipo == 4){
      //ingreso dinero
    $registros=mysqli_query($conexion,"SELECT id_ingreso FROM Factura;") or
      die("Problemas en el select:".mysqli_error($conexion));
  }

  $reg=mysqli_fetch_array($registros);
   $ultimo = $reg[0];
   while ($reg=mysqli_fetch_array($registros))
   {
     if ($ultimo < $reg[0]){
         $ultimo = $reg[0];
     };
   };
  //  if($ultimo == 0){
  //    $ultimo = 1;
  //  };
   $ultimo += 1;   //aumento en 1 cada vez q llamo//
   return $ultimo;
 };

?>
