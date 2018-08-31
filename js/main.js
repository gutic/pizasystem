var num = 0;
var tabla_id = [];
var tabla_cant = [];
var tabla_precio = [];
var num_id = [];
var  id_fila;
var NumeroFactura;


function confirmar()
{

		var Usuario=$('#Usuario').val();
		var Contrasena=$('#Contrasena').val();

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "php/cl_abm.php",
			data: 'Usuario='+Usuario+'&Contrasena='+Contrasena+"&boton=ingresar"
		}).done(function(resp){
			if(resp){
				location.href='main.php';
			}else {
				alert('Usuario o Contraseña incrorrecto');
			}
		});
}

function cerrar()
{
	$.ajax({
			url:'php/cl_abm.php',
			type:'POST',
			data:"boton=cerrar"
		}).done(function(resp){
			window.location.href = "index.php";
		});
}

function limpiar()
{
	$("#formulario [type='text']").val("")//limpiar formulario (todos los  type="text")
	$("#formulario select").val(0)//loimpiar select de los formulario

}

function factura_venta()
{

	var id_prod = $('#id_prod').val();
	var Cantidad = $('#Cantidad').val();
	var fecha = $('#fecha').val();
	var cliente = $('#cliente').val();
	var dir = $('#dir').val();
	var formapago = $('#formapago').val();
	var tipo_factura = $('#tipo_factura').val();
	var Descuento = $('#Descuento').val();
	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data:'tabla_cant='+tabla_cant+'&tabla_id='+tabla_id+'&Descuento='+Descuento+'&id_prod='+id_prod+'&Cantidad='+Cantidad+'&fecha='+fecha+'&cliente='+cliente+'&dir='+dir+'&formapago='+formapago+'&tipo_factura='+tipo_factura+"&boton=factura"
	}).done(function(resp){
		if(resp > 0){
			NumeroFactura = resp;
			location.href='factura_ya.php';
		}else {
			if(resp == 0){
				alert("debe rellenar los cambos");
			};
			if(resp == -1){
				alert("no existe cliente");
			};
		};
	});
}
//valida el ingreso de prodcutos a posible venta
function validar()
{

	var id_prod= $('#id_prod').val();
	var Cantidad = $('#Cantidad').val();

	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data: 'Cantidad='+Cantidad+'&id_prod='+id_prod+"&boton=validar"
	}).done(function(resp){
		if(resp == 1){
			agregar(id_prod, Cantidad);

		}else {
			alert(resp);
		}
	});
}

function borrar(num){
	tabla_id[num] = 0;
}

//agrego productos a la tabla dinamica
function agregar(id_prod, Cantidad)
{

		tabla_id[tabla_id.length] = id_prod;
		tabla_cant[tabla_cant.length] = Cantidad;
		$.ajax({
			url:'php/cl_abm.php',
			type:'POST',
			data: 'Cantidad='+Cantidad+'&id_prod='+id_prod+"&boton=agregar"
		}).done(function(resp){
				alert("OK");
				var listado = "";
				data = eval(resp);
				var id_fila = "name"+num;
				listado += '<tr id="'+id_fila+'">'
				listado += '<td  name=$'+num+'  style="width:30%">'+data[0]["Id"]+'</td>'
				listado += '<td  style="width:50%">'+data[0]["NombreProducto"]+'</td>'
				listado += '<td  name=$'+num+' style="width:10%">'+Cantidad+'</td>'
				listado += '<td style="width:10%"><input type="button" value="Eliminar" onclick="$('+id_fila+').remove();borrar('+num+');" /></td>'
				listado += '</tr>'
				$('#productos').append(listado);
				alert(num);
				num +=1;
		});
}



function mostrar_factura()
{
	var num = NumeroFactura;

	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data: 'tipo='+1+'&num='+num+"&boton=factura_ya"
	}).done(function(resp){
		data = eval(resp);
		var listado = "";
		listado += '<tr>'
		listado += '<td  style="width:50%" valign="top">EMPRESA: '
		listado += '<br>'
		listado += '<p align="center"> Pizeria Lo Vago SA</p>'
		listado += '</td>'
		listado += '<td style="width:50%">TIPO FACTURA: '+data[0].tipo+' <br>'
		listado += 'NUMERO: '+data[0].numero+' <br> FECHA: '+data[0].fecha+' <br> CUIT: MICUIT  <br>'
		listado += '</td>'
		listado += '</tr>'
		$("#numero1").html( listado );
		var listado = "";
		listado += '<br>NOMBRE CLIENTE: '+data[0].nombre_persona+'  </b>'
		listado += '<br>domicilio: '+data[0].direccion+'  '
		listado += '<br>LUGAR de EMISION: '+data[0].direccion_emision+' '
		$("#numero2").html(listado);
		var listado = "";
		listado += '<br>'
		listado += 'CUIT/CUIL: <br> '+data[0].cuit+' '
		$("#numero3").html(listado);
		var listado = "";
		listado += '<br>'
		listado += 'Forma de pago: <br> '+data[0].forma_pago+' '
		$("#numero4").html(listado);
	});
	$.ajax({
	type: "POST",
	url: 'php/cl_abm.php',
	data: 'num='+num+"&boton=detalle_factura"
	}).done(function(resp){
		datos = eval(resp);
		var subtotal = 0;
		var listado = "";
		// alert(datos[0]["Precio"]);
		for(var i=0;i<datos.length;i++){
			var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
			listado += '	<tr bgcolor="'+bgcolor+'">'
			listado += ' 		<td style="width:50%">'+datos[i]["NombreProducto"]+'</td>'
			listado += ' 		<td style="width:20%">'+datos[i]["Cantidad"]+'</td>'
			listado += ' 		<td style="width:20%">$'+datos[i]["Precio"]+'</td>'
			listado += ' 		<td style="width:10%">$'+datos[i]["Precio"]*datos[i]["Cantidad"]+'</td>'
			listado += '	</tr>'
			subtotal += datos[i]["Precio"]*datos[i]["Cantidad"];
		}
		$("#numero5").html(listado);
		iva = subtotal*(datos[0]["Iva"]);
		total = (iva + subtotal)-(datos[0]["Descuento"]);
		var lista = "";
		lista += ' $'+subtotal.toFixed(2)+''
		lista += ' <br> $'+datos[0]["Descuento"]+' '
		lista += '<br> $'+iva.toFixed(2)+''
		$("#numero6").html(lista);

		var lista = "";
		lista += 'TOTAL'
		lista += '<br>'
		lista += '<p align="center"> $'+total.toFixed(2)+'</p>'
		$("#numero7").html(lista);

	});
}

function extraer_dinero()
{
	if(validarCaja()){
		var data_form = $("#formulario").serialize()//esta funcion ya arma la cadena para enviar
		$.ajax({
			type: "POST",
			url: "php/cl_abm.php",
			data: "boton=extraer_dinero&"+data_form
			}).done(function( msg ) {
					alert(msg);
					limpiar();
			});
		}else{
	    alert("Complete todos los datos");
	  }
}

function ingreso_dinero()
{
	if(validarCaja()){
		var data_form = $("#formulario").serialize()//esta funcion ya arma la cadena para enviar
		$.ajax({
			type: "POST",
			url: "php/cl_abm.php",
			data: "boton=ingreso_dinero&"+data_form
			}).done(function( msg ) {
					alert(msg);
					limpiar();
			});
		}else{
	    alert("Complete todos los datos");
	  }
}


function validarCaja(){
	if($.trim($("[name='dinero']").val()) == "")return false;
	return true;
}

//_______________________desde - hasta ____________________//

function movimientos_caja(){

	var fech= $('#fecha1').val();
	var egreso = 0;
	var salida_caja = 0;
	var ingreso = 0;
  var ventas = 0;
	if(fech == ""){
		alert("ingrese Fecha DESDE");
	}else {
		var data_form = $("#formulario").serialize()//esta funcion ya arma la cadena para enviar
		$.ajax({
			type: "POST",
			url: "php/cl_abm.php",
			data: "boton=movimientos_caja&"+data_form
		}).done(function(msg){
			egreso = 0;
			salida_caja = 0;
			ingreso = 0;
			ventas = 0;
			var listado = "";
			datos = eval(msg);
			if (datos == null){
				listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
				$('#resultado').html(listado);
				var salida = "";
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">0</td>'
				salida += '	</tr>'
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">0</td>'
				salida += '	</tr>'
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">0</td>'
				salida += '	</tr>'
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">0</td>'
				salida += '	</tr>'
				$('#total').html(salida);
			}else {
				for(var i=0;i<datos.length;i++){
					if (datos[i]["tipo_operacion"] == 3) {
						var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
						salida_caja = datos[i]['Precio'] + salida_caja;
						listado += '	<tr bgcolor="'+bgcolor+'">'
						listado += ' 		<td style="width:50%"> Egreso salida caja</td>'
						listado += ' 		<td style="width:50%">'+datos[i]["Precio"]+'</td>'
						listado += '	</tr>'
					}
					if (datos[i]["tipo_operacion"] == 2 || datos[i]["tipo_operacion"] == 5){
						var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
						egreso  += (datos[i]['Precio'] * datos[i]['Cantidad']);
						listado += '	<tr bgcolor="'+bgcolor+'">'
						listado += ' 		<td style="width:50%">compras</td>'
						listado += ' 		<td style="width:50%">'+datos[i]["Cantidad"]+'</td>'
						listado += ' 		<td style="width:50%">'+datos[i]["Precio"]+'</td>'
						listado += '	</tr>'
					}
					if (datos[i]["tipo_operacion"] == 4){
						var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
						ingreso += (datos[i]['Precio']);
						listado += '	<tr bgcolor="'+bgcolor+'">'
						listado += ' 		<td style="width:50%">Ingreso de dinero caja</td>'
						listado += ' 		<td style="width:50%">'+datos[i]["Precio"]+'</td>'
						listado += '	</tr>'
					}
					if (datos[i]["tipo_operacion"] == 1){
						var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
						ventas += (datos[i]['Precio'] * datos[i]['Cantidad']);
						listado += '	<tr bgcolor="'+bgcolor+'">'
						listado += ' 		<td style="width:50%">Ventas</td>'
						listado += ' 		<td style="width:50%">'+datos[i]['Cantidad']+'</td>'
						listado += ' 		<td style="width:50%">'+datos[i]["Precio"]+'</td>'
						listado += '	</tr>'
					}
				}
				$('#resultado').html(listado);
				var salida = "";
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">'+salida_caja.toFixed(2)+'</td>'
				salida += '	</tr>'
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">'+egreso.toFixed(2)+'</td>'
				salida += '	</tr>'
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">'+ingreso.toFixed(2)+'</td>'
				salida += '	</tr>'
				salida += '	<tr bgcolor="'+bgcolor+'">'
				salida += ' 		<td style="width:25%">'+ventas.toFixed(2)+'</td>'
				salida += '	</tr>'
				$('#total').html(salida);
			};
		});
	}
}


//_______________________INSUMO_____________________________//

//agrego productos a la tabla dinamica
function agregar_insumo(id_prod)
{
		var Cantidad = $('#Cantidad').val();
		var precio = $('#precio').val();
		if (Cantidad > 0 && precio > 0) {
			tabla_id[tabla_id.length] = id_prod;
			tabla_cant[tabla_cant.length] = Cantidad;
			tabla_precio[tabla_precio.length] = precio;
			alert(tabla_precio[num]);
			alert(precio);
			$.ajax({
				url:'php/cl_abm.php',
				type:'POST',
				data: 'Cantidad='+Cantidad+'&id_prod='+id_prod+"&boton=agregar_insumo"
			}).done(function(resp){
					alert("OK");
					var listado = "";
					data = eval(resp);
					var id_fila = "name"+num;
					listado += '<tr id="'+id_fila+'">'
					listado += '<td  name=$'+num+'  style="width:30%">'+data[0]["Id_insumo"]+'</td>'
					listado += '<td  style="width:40%">'+data[0]["Nombre"]+'</td>'
					listado += '<td  name=$'+num+' style="width:10%">'+Cantidad+'</td>'
					listado += '<td  name=$'+num+' style="width:10%">'+precio+'</td>'
					listado += '<td style="width:10%"><input type="button" value="Eliminar" onclick="$('+id_fila+').remove();borrar('+num+');" /></td>'
					listado += '</tr>'
					$('#productos').append(listado);
					num +=1;
			});
		}else {
			alert("Valores tienen que ser mayores a cero");
		}

}
//______________________PRODUCTO__________________________________//
//agrego productos a la tabla dinamica
function agregar_producto(id_prod)
{
		var Cantidad = $('#Cantidad').val();
		var precio = $('#precio').val();
		if (Cantidad > 0 && precio > 0) {
			tabla_id[tabla_id.length] = id_prod;
			tabla_cant[tabla_cant.length] = Cantidad;
			tabla_precio[tabla_precio.length] = precio;
			alert(tabla_precio[num]);
			alert(precio);
			$.ajax({
				url:'php/cl_abm.php',
				type:'POST',
				data: 'Cantidad='+Cantidad+'&id_prod='+id_prod+"&boton=agregar"
			}).done(function(resp){
					alert("OK");
					var listado = "";
					data = eval(resp);
					var id_fila = "name"+num;
					listado += '<tr id="'+id_fila+'">'
					listado += '<td  name=$'+num+'  style="width:30%">'+data[0]["Id"]+'</td>'
					listado += '<td  style="width:40%">'+data[0]["NombreProducto"]+'</td>'
					listado += '<td  name=$'+num+' style="width:10%">'+Cantidad+'</td>'
					listado += '<td  name=$'+num+' style="width:10%">'+precio+'</td>'
					listado += '<td style="width:10%"><input type="button" value="Eliminar" onclick="$('+id_fila+').remove();borrar('+num+');" /></td>'
					listado += '</tr>'
					$('#productos').append(listado);
					num +=1;
			});
		}else {
			alert("Valores tienen que ser mayores a cero");
		}

}

function factura_compra()
{
	var data_form = $("#formulario").serialize()
	alert(fecha);
	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data: "boton=factura_compra&"+data_form+'&tabla_cant='+tabla_cant+'&tabla_id='+tabla_id+'&tabla_precio='+tabla_precio
	}).done(function(resp){
		alert(resp);
		if(resp > 0){
			NumeroFactura = resp;
			limpiar();
		}else {
			if(resp == 0){
				alert("debe rellenar los cambos");
			};
		};
	});
}
