<?php
  require("../config/config.php");
  //extiende de la clase mysql asi no tngo q instanciarla
  //la clase mysql conecta a la base
    session_start();
    $usuario = $_SESSION['Id'];
    $boton=$_POST['boton'];

    switch ($boton) {
      case 'validar':
        $id_producto = $_POST['id_prod'];
        $cantidad = $_POST['Cantidad'];
        if($cantidad > 0){
          $result = mysqli_query($conexion,"SELECT Id, NombreProducto, stock FROM Producto WHERE Id ='$id_producto';");
          if(mysqli_num_rows($result)!=0){
            $list = mysqli_fetch_array($result);
            echo 1;
            //verifica stock suficiente
            // if( $list[2] >= $cantidad){
            //   echo 1;
            // }else{
            //   echo "cortina";
            // };
          }else{
            echo "cod inexistente";
          };
        }else {
          echo "ingrese Cantidad Mayor a Cero";
        }

        break;

      case 'ingresar':
        $Usuario = $_POST['Usuario'];
        $Contrasena =$_POST['Contrasena'];
        $logok = FALSE;
        $result = mysqli_query($conexion,"SELECT * FROM Usuario WHERE Usuario ='$Usuario' AND Contrasena='$Contrasena';");
        if($Usua=mysqli_fetch_array($result)){
          $_SESSION['Id']=$Usua[0];
          $_SESSION['Usuario']=$Usua[1];
          $_SESSION['logOk']='YES';
          $mensajeError='Logueado correctamente ok.';
          $logok = TRUE;
          echo $logok;
        }else{
          echo $logok;
        };
        break;

      case 'cerrar':
        session_start();
        if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
          );
        }
        session_destroy();
        echo TRUE;
        break;

      case 'agregar':
        $id_producto = $_POST['id_prod'];
        $cantidad = $_POST['Cantidad'];
        $result = mysqli_query($conexion,"SELECT Id, NombreProducto, stock FROM Producto WHERE Id ='$id_producto';");
        if(mysqli_num_rows($result)!=0){
            while( $reg = mysqli_fetch_assoc($result)){
              $data[] = $reg;
            echo json_encode($data);
          }
        }else{
          echo false;
        };
        break;

        case 'agregar_insumo':
          $id_producto = $_POST['id_prod'];
          $cantidad = $_POST['Cantidad'];
          $result = mysqli_query($conexion,"SELECT Id_insumo, Nombre FROM Insumo WHERE Id_insumo ='$id_producto';");
          if(mysqli_num_rows($result)!=0){
              while( $reg = mysqli_fetch_assoc($result)){
                $data[] = $reg;
              echo json_encode($data);
            }
          }else{
            echo false;
          };
          break;
      //al vender
      case 'factura':
        $tabla_cant = $_POST['tabla_cant'];
        $tabla_id = $_POST['tabla_id'];
        $cli = $_POST['cliente'];
        $dir = $_POST['dir'];
        $formapago = $_POST['formapago'];
        $tipo_factura = $_POST['tipo_factura'];
        $descuento = $_POST['Descuento'];
        $no_vacio = strlen($cli) * strlen($dir) * strlen($formapago);
        $tabla_id= explode(",",$tabla_id);
        $tabla_cant= explode(",",$tabla_cant);
        if ($no_vacio > 0 && $tabla_cant[0] > 0 ){
          $num_factura = ulti_factura(1);
          $result = mysqli_query($conexion,"SELECT * FROM Persona WHERE Nombre ='$cli';");
          if($reg_cli = mysqli_fetch_array($result)){
            mysqli_query($conexion, "INSERT INTO Factura (Id, Tipo, FormaPago, Persona, NroComprobante, Iva, Descuento, Direccion, tipo_operacion, usuario) VALUES(NULL, '$tipo_factura','$formapago','$reg_cli[0]','$num_factura','0.21','$descuento','$dir','1','$usuario');")
            or die("Problemas en el insert factura:".mysqli_error($conexion));
            for ($i=0; $i < sizeof($tabla_id); $i++) {
              if ($tabla_id[$i] > 0){
                $result = mysqli_query($conexion,"SELECT * FROM Producto WHERE Id ='$tabla_id[$i]';");
                $reg_producto = mysqli_fetch_array($result);
                if ($reg_producto[4] == 0) { //verifico si es un producto elaborado o un articulo.
                  $stock_actual = $reg_producto[1] - $tabla_cant[$i];
                  mysqli_query($conexion, "UPDATE Producto SET Stock ='$stock_actual' WHERE Id = '$tabla_id[$i]';") or
                  die("Problemas en el select:".mysqli_error($conexion));
                  //agregar a detalle factura
                  mysqli_query($conexion, "INSERT INTO DetalleFactura (Id, NroComprobante, IdProducto, Cantidad, Precio, tipo_operacion) VALUES(NULL, '$num_factura','$tabla_id[$i]','$tabla_cant[$i]','$reg_producto[3]','1');");
                  echo ulti_factura(1);
                };
                if ($reg_producto[4] == 1){
                  $receta = mysqli_query($conexion, "SELECT re.*, ins.* FROM Receta re INNER JOIN Insumo ins WHERE re.Id_producto = $reg_producto[0] AND re.Id_insumo = ins.Id_insumo AND ins.activo = 1") or
                  die("Problemas en el inner:".mysqli_error($conexion));
                  for ($r=0; $r < mysqli_num_rows($receta); $r++) {
                    $salida_receta = mysqli_fetch_array($receta);
                    $stock_actual = $salida_receta[6] - ($salida_receta[5] * $tabla_cant[$i]);
                    mysqli_query($conexion, "UPDATE Insumo SET Cantidad ='$stock_actual' WHERE Id_insumo = '$salida_receta[1]';") or
                     die("Problemas en el select:".mysqli_error($conexion));
                  };
                  mysqli_query($conexion, "INSERT INTO DetalleFactura (Id, NroComprobante, IdProducto, Cantidad, Precio, tipo_operacion) VALUES(NULL, '$num_factura','$tabla_id[$i]','$tabla_cant[$i]','$reg_producto[3]','1');");
                  echo ulti_factura(1);
                };
              };
            };
          }else {
            echo -1;
          };
        }else {
          echo 0;
        };
        break;
      case 'buscar':
        $Buscar = $_POST['Buscar'];
        $registros=mysqli_query($conexion,"SELECT Id, NombreProducto, Stock FROM Producto WHERE NombreProducto = '$Buscar' AND Stock > 0;") or
          die("Problemas en el select:".mysqli_error($conexion));
        if($reg=mysqli_fetch_array($registros)){
          $datos[] = array("id" => $reg[0], "ProdNombre" => $reg[1]);
          echo json_encode($datos);
        }else {
          echo FALSE;
        }
        break;
        //FACTURA AL VENDER ___________________________________________________
      case 'factura_ya':
        $tipo = $_POST['tipo'];
        $num = $_POST['num'];
        $registros=mysqli_query($conexion,"SELECT * FROM Factura WHERE NroComprobante = '$num' AND tipo_operacion = '$tipo';") or
               die("Problemas en el select:".mysqli_error($conexion));

        if($reg_factura=mysqli_fetch_array($registros))
        {
          $registros=mysqli_query($conexion,"SELECT * FROM Persona WHERE Id = '$reg_factura[6]';") or
            die("Problemas en el select:".mysqli_error($conexion));
          $reg_persona=mysqli_fetch_array($registros);

          $registros=mysqli_query($conexion,"SELECT * FROM DetalleFactura WHERE NroComprobante = '$ulti' AND tipo_operacion = '$tipo';") or
            die("Problemas en el select:".mysqli_error($conexion));
          $reg_detalle=mysqli_fetch_array($registros);

          $registros=mysqli_query($conexion,"SELECT NombreProducto FROM Producto WHERE Id = '$reg_detalle[2]';") or
            die("Problemas en el select:".mysqli_error($conexion));
          $reg_prod =mysqli_fetch_array($registros);

          $datos[] = array("tipo" => $reg_factura[4], "numero" => $ulti, "fecha" => $reg_factura[8], "formapago" => $reg_factura[5],
            "nombre_persona" => $reg_persona[2], "cuit_persona" => $reg_persona[5], "direccion" => $reg_persona[4], "cuit" => $reg_persona[5], "cantidad" => $reg_detalle[3], "precio" => $reg_detalle[4], "nombre_producto" => $reg_prod[0],
            "forma_pago" => $reg_factura[5], "direccion_emision" => $reg_factura[11]);
          echo json_encode($datos);
        }else{
          echo 0;
        }
        break;
      case 'detalle_factura':
        $num = $_POST['num'];
        if ($num == 0){
          $ulti = ulti_factura(1);
          $ulti -= 1;
        }else{
          $ulti = $num;
        }
        $result=mysqli_query($conexion,"SELECT df.*, pr.*, fa.* FROM DetalleFactura df INNER JOIN Producto pr INNER JOIN Factura fa WHERE df.NroComprobante = '$ulti' and df.tipo_operacion = 1 AND df.IdProducto = pr.Id and fa.NroComprobante = '$ulti';") or
          die("Problemas en el select:".mysqli_error($conexion));
        while( $reg = mysqli_fetch_assoc($result)){
          $data[] = $reg;
        }
        echo json_encode($data);
        break;
    ///================================//Buscardor factura ventas.-=====================================//
      case 'factura_yaVenta':
          $num = $_POST['num'];
          $registros=mysqli_query($conexion,"SELECT * FROM Factura WHERE Id = '$num';") or
                 die("Problemas en el select:".mysqli_error($conexion));
          if($reg_factura=mysqli_fetch_array($registros))
          {
            $registros=mysqli_query($conexion,"SELECT * FROM Persona WHERE Id = '$reg_factura[6]';") or
              die("Problemas en el select:".mysqli_error($conexion));
            $reg_persona=mysqli_fetch_array($registros);

            $registros=mysqli_query($conexion,"SELECT * FROM DetalleFactura WHERE NroComprobante = '$reg_factura[7]';") or
              die("Problemas en el select:".mysqli_error($conexion));
            $reg_detalle=mysqli_fetch_array($registros);

            $registros=mysqli_query($conexion,"SELECT NombreProducto FROM Producto WHERE Id = '$reg_detalle[2]';") or
              die("Problemas en el select:".mysqli_error($conexion));
            $reg_prod =mysqli_fetch_array($registros);

            $datos[] = array("tipo" => $reg_factura[4], "numero" => $reg_factura[7], "fecha" => $reg_factura[8], "formapago" => $reg_factura[5],
              "nombre_persona" => $reg_persona[2], "cuit_persona" => $reg_persona[5], "direccion" => $reg_persona[4], "cuit" => $reg_persona[5],
              "cantidad" => $reg_detalle[3], "precio" => $reg_detalle[4], "nombre_producto" => $reg_prod[0],
              "forma_pago" => $reg_factura[5], "direccion_emision" => $reg_factura[11]);
            echo json_encode($datos);
          }else{
            echo FALSE;
          }
          break;
        case 'detalle_factura_venta':
          $num = $_POST['num'];
          $result=mysqli_query($conexion,"SELECT df.*, pr.*, fa.* FROM DetalleFactura df INNER JOIN Producto pr INNER JOIN Factura fa
            WHERE fa.Id = '$num' AND df.tipo_operacion = 1 AND fa.NroComprobante = df.NroComprobante AND df.IdProducto = pr.Id;") or
            die("Problemas en el select:".mysqli_error($conexion));
          while( $reg = mysqli_fetch_assoc($result)){
            $data[] = $reg;
          }
          echo json_encode($data);
          break;


        //FACTURA AL COMPRAR ___________________________________________________
      case 'factura_yaCompra':
          $num = $_POST['num'];
          $registros=mysqli_query($conexion,"SELECT * FROM Factura WHERE Id = '$num';") or
                die("Problemas en el select:".mysqli_error($conexion));
          if($reg_factura=mysqli_fetch_array($registros))
          {
            $registros=mysqli_query($conexion,"SELECT * FROM Persona WHERE Id = '$reg_factura[6]';") or
              die("Problemas en el select:".mysqli_error($conexion));
            $reg_persona=mysqli_fetch_array($registros);

            $registros=mysqli_query($conexion,"SELECT * FROM DetalleFactura WHERE NroComprobante = '$reg_factura[1]';") or
              die("Problemas en el select:".mysqli_error($conexion));
            $reg_detalle=mysqli_fetch_array($registros);

            $registros=mysqli_query($conexion,"SELECT NombreProducto FROM Producto WHERE Id = '$reg_detalle[2]';") or
              die("Problemas en el select:".mysqli_error($conexion));
            $reg_prod =mysqli_fetch_array($registros);

            $datos[] = array("tipo" => $reg_factura[4], "numero" => $reg_factura[1], "fecha" => $reg_factura[8], "formapago" => $reg_factura[5],
              "nombre_persona" => $reg_persona[2], "cuit_persona" => $reg_persona[5], "direccion" => $reg_persona[4], "cuit" => $reg_persona[5],
              "Cantidad" => $reg_detalle[3], "precio" => $reg_detalle[4], "nombre_producto" => $reg_prod[0],
              "forma_pago" => $reg_factura[5], "direccion_emision" => $reg_factura[11]);
            echo json_encode($datos);
          }else{
            echo FALSE;
          }
          break;
      case 'detalle_factura_compra':
        $num = $_POST['num'];
        $result=mysqli_query($conexion,"SELECT df.*, pr.*, fa.* FROM DetalleFactura df INNER JOIN Producto pr INNER JOIN Factura fa
          WHERE fa.Id = '$num' AND df.tipo_operacion = 2 AND fa.id_compra = df.NroComprobante AND df.IdProducto = pr.Id;") or
          die("Problemas en el select:".mysqli_error($conexion));
        while( $reg = mysqli_fetch_assoc($result)){
          $data[] = $reg;
        }
        echo json_encode($data);
        break;



      case 'extraer_dinero':
        $dinero = $_POST['dinero'];
        $observacion = $_POST['observacion'];
        $persona = $_POST['persona'];
        $dir = $_POST['dir'];
        $formapago = $_POST['formapago'];
        $num_factura = ulti_factura(3);
        mysqli_query($conexion, "INSERT INTO Factura(Id, id_egreso, FormaPago, Direccion, tipo_operacion, usuario) VALUES(NULL,'$num_factura','$formapago','$dir','3','$usuario');")or
          die("Problemas en el select:".mysqli_error($conexion));
          mysqli_query($conexion, "INSERT INTO DetalleFactura (Id, NroComprobante, Precio, tipo_operacion, observacion) VALUES(NULL, '$num_factura','$dinero','3','$observacion');");
        echo "ok";
        break;
      case 'ingreso_dinero':
        $dinero = $_POST['dinero'];
        $observacion = $_POST['observacion'];
        $dir = $_POST['dir'];
        $formapago = $_POST['formapago'];
        $num_factura = ulti_factura(4);
        mysqli_query($conexion, "INSERT INTO Factura(Id, id_ingreso, FormaPago, Direccion, tipo_operacion, usuario) VALUES(NULL,'$num_factura','$formapago','$dir','4','$usuario');")or
          die("Problemas en el select:".mysqli_error($conexion));
          mysqli_query($conexion, "INSERT INTO DetalleFactura (Id, NroComprobante, Precio, tipo_operacion, observacion) VALUES(NULL, '$num_factura','$dinero','4','$observacion');");
        echo "ok";
        break;
      case 'movimientos_caja':
        $fecha1 = $_POST['fecha1'];
        $fecha2 = $_POST['fecha2'];
        $hoy = date("Y-m-d");
        if($fecha2 > $hoy){
          echo 1;
        }else {
          $result = mysqli_query($conexion,"SELECT fa.*, de.* FROM Factura fa INNER JOIN DetalleFactura de WHERE (fa.Fecha >= '$fecha1' AND fa.Fecha <= '$fecha2')
          AND (    ((fa.id_compra = de.NroComprobante) AND (de.tipo_operacion = 5 OR de.tipo_operacion = 2 ))
              OR ((fa.id_egreso = de.NroComprobante) AND (de.tipo_operacion = 3))
              OR ((fa.id_ingreso = de.NroComprobante) AND (de.tipo_operacion = 4))
              OR ((fa.NroComprobante = de.NroComprobante) AND (de.tipo_operacion = 1))
            );") or
            die("Problemas en el select koky:".mysqli_error($conexion));
          if($result){
            while( $reg = mysqli_fetch_assoc($result)){
              $data[] = $reg;
            }
            echo json_encode($data);
          }else {
            echo 0;
          }
        }
        break;

    }
    //verificar funcionalidad depende del host donde se encuentra por problemas en buscar el archivo confi.php
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
