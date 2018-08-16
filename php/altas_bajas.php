<?php
  require("../config/config.php");
  $boton = $_POST['boton'];

  switch ($boton) {
  //ABM proveedor //
    case 'insertar_prove':
      $provedor = $_POST["prov"];
      $cuit_prove = $_POST["cuit_prove"];
      $dir_prove = $_POST["dir_prove"];
      $tel = $_POST["tel_prove"];
      mysqli_query($conexion,"INSERT INTO Persona(Id, TipoPersona, Nombre, Telefono, Direccion, Cuit, activo)
      VALUES(NULL, '2', '$provedor', '$tel', '$dir_prove', '$cuit_prove', '1')") or
      die("Problemas en el select:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'buscar':
      $consulta = $_POST['consulta'];

      	$query = "SELECT * FROM Persona WHERE activo = '1' AND TipoPersona = '2'";

      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
      	$id = $conexion -> real_escape_string($_POST['consulta']);
      	$query = "SELECT * FROM Persona WHERE activo = '1' AND TipoPersona = '2' AND (Nombre like '%".$id."%' OR Id like '%".$id."%')";
      }
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
    case 'upd_prove':
      $id = $_POST["id"];
      $provedor = $_POST["prov"];
      $cuit_prove = $_POST["cuit_prove"];
      $dir_prove = $_POST["dir_prove"];
      $tel = $_POST["tel_prove"];
      mysqli_query($conexion,"UPDATE Persona SET Nombre = '$provedor', Telefono = '$tel', Direccion = '$dir_prove', Cuit = '$cuit_prove' WHERE Id = '$id';")or
      die("Problemas en el update:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'del_prove':
      $id = $_POST["id"];
      mysqli_query($conexion,"UPDATE Persona SET activo = '0' WHERE Id = '$id';") or
      die("Problemas en el delete:".mysqli_error($conexion));
      break;
  //ABM Clientes //
    case 'insertar_cliente':
      $cliente = $_POST["cli"];
      $cuit = $_POST["cuit_cliente"];
      $dir = $_POST["dir_cliente"];
      $tel = $_POST["tel_cliente"];
      mysqli_query($conexion,"INSERT INTO Persona(Id, TipoPersona, Nombre, Telefono, Direccion, Cuit, activo)
      VALUES(NULL, '1', '$cliente', '$tel', '$dir', '$cuit', '1')") or
      die("Problemas en el select:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'buscar_cliente':
      $consulta = $_POST['consulta'];
      $salida ="";
      //si no pone nada tomo todo
      	$query = "SELECT * FROM Persona WHERE activo ='1'";
      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
      	$id = $conexion -> real_escape_string($_POST['consulta']);
      	$query = "SELECT * FROM Persona WHERE activo = '1' AND  (Nombre like '%".$id."%' OR Id like '%".$id."%')";
      }
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
    case 'upd_cliente':
      $id = $_POST["id"];
      $cliente = $_POST["cli"];
      $cuit = $_POST["cuit_cliente"];
      $dir = $_POST["dir_cliente"];
      $tel = $_POST["tel_cliente"];
      mysqli_query($conexion,"UPDATE Persona SET Nombre = '$cliente', Telefono = '$tel', Direccion = '$dir', Cuit = '$cuit' WHERE Id = '$id';")or
      die("Problemas en el update:".mysqli_error($conexion));
      echo "ok";
      break;
      //ABM Insumos//
    case 'insertar_insumo':
      $insumo = $_POST["insumo"];
      $udm = $_POST["udm"];
      mysqli_query($conexion,"INSERT INTO Insumo(Id_insumo, Nombre, UnidadMedida, activo) VALUES(NULL, '$insumo', '$udm', '1');")or
      die("Problemas en el selecttttt:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'buscar_insumo':
      $consulta = $_POST['consulta'];
      $salida ="";
      //si no pone nada tomo todo
        $query = "SELECT * FROM Insumo WHERE activo ='1'";
      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
        $id = $conexion -> real_escape_string($_POST['consulta']);
      	$query = "SELECT * FROM Insumo WHERE activo = '1' AND (Nombre like '%".$id."%' OR Id_insumo like '%".$id."%')";
      }
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
    case 'upd_insumo':
      $id = $_POST["id"];
      $insumo = $_POST["insumo"];
      $udm = $_POST["udm"];
      mysqli_query($conexion,"UPDATE Insumo SET Nombre = '$insumo', UnidadMedida = '$udm' WHERE Id_insumo = '$id';")or
      die("Problemas en el update:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'del_insumo':
      $id = $_POST["id"];
      mysqli_query($conexion,"UPDATE Insumo SET activo = '0' WHERE Id_insumo = '$id';") or
      die("Problemas en el delete:".mysqli_error($conexion));
      break;
      //ABM Insumos//
    case 'insertar_articulo':
      $articulo = $_POST["articulo"];
      $precio = $_POST["precio"];
      mysqli_query($conexion,"INSERT INTO Producto(Id, NombreProducto, CostoProducto, esElaborado, activo) VALUES(NULL, '$articulo', '$precio', '0', '1');")or
      die("Problemas en el selecttttt:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'buscar_articulo':
      $consulta = $_POST['consulta'];
      $salida ="";
      //si no pone nada tomo todo
        $query = "SELECT * FROM Producto WHERE activo ='1' AND esElaborado = '0'";
      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
      	$id = $conexion -> real_escape_string($_POST['consulta']);
      	$query = "SELECT * FROM Producto WHERE activo = '1' AND esElaborado = '0' AND (NombreProducto like '%".$id."%' OR Id like '%".$id."%')";
      }
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
    case 'upd_articulo':
      $id = $_POST["id"];
      $articulo = $_POST["articulo"];
      $precio = $_POST["precio"];
      mysqli_query($conexion,"UPDATE Producto SET NombreProducto = '$articulo', CostoProducto = '$precio' WHERE Id = '$id';")or
      die("Problemas en el update:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'del_articulo':
      $id = $_POST["id"];
      mysqli_query($conexion,"UPDATE Producto SET activo = '0' WHERE Id = '$id';") or
      die("Problemas en el delete:".mysqli_error($conexion));
      break;
     //_________PRODUCTO ELABORADO / RECETAS_________________ //
    case 'buscar_receta':
      $consulta = $_POST['consulta'];
      //si no pone nada tomo todo
        $query = "SELECT * FROM Producto WHERE activo ='1' AND esElaborado = '1'";
      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
        $id = $conexion -> real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM Producto WHERE activo = '1' AND esElaborado = '1' AND (NombreProducto like '%".$id."%' OR Id like '%".$id."%')";
      }
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
    case 'buscar_insumo_receta':
      $id = $_POST["id_editar"];
      $result = mysqli_query($conexion,"SELECT re.*, ins.* FROM Receta re INNER JOIN Insumo ins WHERE re.Id_producto = $id AND ins.Id_insumo = re.Id_insumo AND ins.activo = 1 ") or
        die("Problemas en el inner:".mysqli_error($conexion));
      if(mysqli_num_rows($result)!=0){
        while ($reg = mysqli_fetch_assoc($result)) {
        $data[] = $reg;
      }
        echo json_encode($data);
      }
      break;
    case 'agregar_insumo_receta':
      $id_insumo = $_POST["id_insumo"];
      $id_prod = $_POST["id_editar"];
      mysqli_query($conexion,"INSERT INTO Receta(Id_insumo, Id_producto) VALUES ('$id_insumo','$id_prod');") or
      die("Problemas en el insert new receta:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'del_insumo_receta':
      $id_insumo = $_POST["id_insumo"];
      $id_prod = $_POST["id_editar"];
      mysqli_query($conexion,"DELETE FROM Receta WHERE Id_insumo = '$id_insumo' AND Id_producto = '$id_prod';") or
      die("Problemas en el delete:".mysqli_error($conexion));
      break;
    case 'insertar_receta':
      $receta = $_POST["receta"];
      $precio = $_POST["precio_receta"];
      mysqli_query($conexion,"INSERT INTO Producto (NombreProducto, CostoProducto, esElaborado, activo) VALUES('$receta','$precop','1','1');")or
      die("Problemas en el update:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'upd_receta':
      $id = $_POST["id"];
      $receta = $_POST["receta"];
      $precio = $_POST["precio_receta"];
      mysqli_query($conexion,"UPDATE Producto SET NombreProducto = '$receta', CostoProducto = '$precio' WHERE Id = '$id';")or
      die("Problemas en el update:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'buscar_datos_insumo':
      $consulta = $_POST['consulta'];
      $salida ="";
      //si no pone nada tomo todo
        $query = "SELECT * FROM Insumo WHERE activo ='1'";
      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
        $id = $conexion -> real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM Insumo WHERE activo = '1' AND (Nombre like '%".$id."%' OR Id_insumo like '%".$id."%')";
      }
      $resultado = $conexion -> query($query);
      if($resultado->num_rows > 0){
        $salida .= "<table class='tabla_datos' border='2'>
                <thead>
                  <tr>
                    <td>Insumos</td>
                  </tr>
                </thead>
                <tbody>";
        $x=0;
        $name[$x] = "";
        while($fila = $resultado -> fetch_assoc()){
            $name[$x] = $fila['Nombre'];
            $salida.="<tr>
                <td>".$fila['Nombre']."</td>
                <td><a class='btn btn-success btn-sm'  onclick='agregar_insumo_receta(".$fila['Id_insumo'].");'>Agregar</a></td>
            </tr>";
            $x +=1;
        }
        $salida.="</tbody></table>";
      }else{
        $salida.= "<div class='alert alert-danger' role='alert'><b>Datos no Encontrados !!!</b></div>";
      }
      echo $salida;
      break;
  //ABM usuarios //
    case 'insertar_usuario':
      $nombre = $_POST["nombre"];
      $contrasena = $_POST["contrasena"];
      $email = $_POST["email"];
      $tipo_usr = $_POST["tipo_usr"];
      mysqli_query($conexion,"INSERT INTO Usuario(Id, Usuario, Contrasena, Email, TipoUsuario)
      VALUES(NULL,'$nombre', '$contrasena', '$email', '$tipo_usr')") or
      die("Problemas insertar usr:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'buscar_usuario':
      $consulta = $_POST['consulta'];
      //si no pone nada tomo todo
        $query = "SELECT * FROM Usuario";
      //si escribió algo en buscar
      if(isset($_POST['consulta'])){
        $id = $conexion -> real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM Usuario WHERE Usuario like '%".$id."%' OR Id like '%".$id."%'";
      }
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
    case 'upd_usuario':
      $id = $_POST["id"];
      $nombre = $_POST["nombre"];
      $contrasena = $_POST["contrasena"];
      $email = $_POST["email"];
      $tipo_usr = $_POST["tipo_usr"];
      mysqli_query($conexion,"UPDATE Usuario SET Usuario = '$nombre', Contrasena = '$contrasena', Email = '$email', TipoUsuario = '$tipo_usr' WHERE Id = '$id';")or
      die("Problemas en el update usr:".mysqli_error($conexion));
      echo "ok";
      break;
    case 'del_usuario':
      $id = $_POST["id"];
      mysqli_query($conexion,"DELETE FROM Usuario WHERE Id = '$id';") or
      die("Problemas en el delete:".mysqli_error($conexion));
      break;
  }

 ?>
