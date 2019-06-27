
<?php
require("../config/config.php");
$tipo = $_POST['tipo'];
$consulta = $_POST['consulta'];

$salida ="";
//si no pone nada tomo todo
if($tipo == 0){
	$query = "SELECT * FROM Factura WHERE tipo_operacion = 1 OR tipo_operacion = 2";
}

if($tipo > 0){
	$query = "SELECT * FROM Factura WHERE tipo_operacion = '$tipo'";
}

//si escribió algo en buscar
if(isset($_POST['consulta'])){
	if($tipo == 1){
			$id = $conexion -> real_escape_string($_POST['consulta']);
			$query = "SELECT * FROM Factura WHERE NroComprobante like '%".$id."%' or Tipo like '%".$id."%' and tipo_operacion = '$tipo' ";
	}
	if($tipo == 2){
		$id = $conexion -> real_escape_string($_POST['consulta']);
		$query = "SELECT * FROM Factura WHERE id_compra like '%".$id."%' or Tipo like '%".$id."%' and tipo_operacion = '$tipo' ";
	}
	if($tipo == 0) {
		$id = $conexion -> real_escape_string($_POST['consulta']);
		$query = "SELECT * FROM Factura WHERE NroComprobante like '%".$id."%' or Tipo like '%".$id."%' and tipo_operacion = '1' or tipo_operacion = '2'";
	}
}

$resultado = $conexion -> query($query);

if($resultado->num_rows > 0){

	$salida .= "<table class='tabla_datos' border='2'>
					<thead>
						<tr>
						  <td>Tipo Operacion</td>
							<td>Numero Comprobante</td>
							<td>Tipo Comprobante</td>
							<td>Fecha </td>
							<td>Descuento</td>
							<td>Forma de Pago</td>
							<td>IVA</td>
						</tr>
					</thead>
					<tbody>";

	while($fila = $resultado -> fetch_assoc()){
		if ($fila['tipo_operacion'] == 1){
			$salida.="<tr>
					<td> Venta </td>
					<td>".$fila['NroComprobante']."</td>
					<td>".$fila['Tipo']."</td>
					<td>".$fila['Fecha']."</td>
					<td>".$fila['Descuento']."</td>
					<td>".$fila['FormaPago']."</td>
					<td>".$fila['Iva']."</td>
					<td><a class='btn btn-success btn-sm' href='javascript:ver_lista_factura(".$fila['Id'].")'>Ver detalle</a></td>
			</tr>";
		}elseif ($fila['tipo_operacion'] == 2) {
			$salida.="<tr>
					<td> Compra </td>
					<td>".$fila['id_compra']."</td>
					<td>".$fila['Tipo']."</td>
					<td>".$fila['Fecha']."</td>
					<td>".$fila['Descuento']."</td>
					<td>".$fila['FormaPago']."</td>
					<td>".$fila['Iva']."</td>
					<td><a class='btn btn-success btn-sm' href='javascript:ver_lista_facturaCompra(".$fila['Id'].")'>Ver detalle</a></td>
			</tr>";
		}
	}

	$salida.="</tbody></table>";

}else{
	$salida.= "<div class='alert alert-danger' role='alert'><b>Datos no Encontrados !!!</b></div>";

}

echo $salida;

$conexion -> close();

?>
