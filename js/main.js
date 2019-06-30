var num = 0;
var tabla_id = [];
var tabla_cant = [];
var tabla_precio = [];
var tabla_tipo = [];
var num_id = [];
var  id_fila;
var NumeroFactura;

//____ movimientos///
var listado = "";
var id;
var ingreso;


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
			NumeroFactura = resp - 1;
			location.href='factura_ya.php?num='+NumeroFactura;
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



function mostrar_factura(num)
{
	var num = num;
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

function mostrar_facturaCompra(num)
{
	var num = num;
	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data: 'num='+num+"&boton=factura_yaCompra"
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
	data: 'num='+num+"&boton=detalle_factura_compra"
	}).done(function(resp){
		datos = eval(resp);
		var subtotal = 0;
		var listado = "";
		console.log(resp);
		for(var i=0;i<datos.length;i++){
			var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
			listado += '	<tr bgcolor="'+bgcolor+'">'
			listado += ' 		<td style="width:50%">'+datos[i]["Nombre"]+'</td>'
			listado += ' 		<td style="width:20%">'+datos[i]["Cantidad"]+'</td>'
			listado += ' 		<td style="width:20%">$'+datos[i]["Precio"]+'</td>'
			listado += ' 		<td style="width:10%">$'+datos[i]["Precio"]+'</td>'
			listado += '	</tr>'
			subtotal += datos[i]["Precio"]*1;
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

//AL vender

function mostrar_facturaVenta(num)
{
	var num = num;
	$.ajax({
		url:'php/cl_abm.php',
		type:'POST',
		data: 'num='+num+"&boton=factura_yaVenta"
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
	data: 'num='+num+"&boton=detalle_factura_venta"
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

//==================== CAJA ======================== //

function extraer_dinero()
{
	if(validarCaja()){
		var data_form = $("#formulario").serialize()//esta funcion ya arma la cadena para enviar
		$.ajax({
			type: "POST",
			url: "php/cl_abm.php",
			data: "boton=extraer_dinero&"+data_form
			}).done(function( msg ) {
					alertify.success(msg);
					limpiar_caja();
			});
		}else{
	    alertify.error("Complete todos los datos");
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
					alertify.success(msg);
					limpiar_caja();
			});
		}else{
	    alertify.error("Complete todos los datos");
	  }
}

function validarCaja(){
	if($.trim($("[name='dinero']").val()) == "" ||
	$.trim($("[name='observacion']").val()) == "" )return false;
	return true;
}

function limpiar_caja()
{
	$('#dinero').val("");//limpiar formulario (todos los  type="text")
	$('#observacion').val("");//loimpiar select de los formulario
	// $('#fecha1').val(fecha2);

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

//_Movimientos//


function buscar()
{
	var saldo = 0;
	var tipo = $('#tipo').val();
	var desde = $('#fecha1').val();
	var hasta = $('#fecha2').val();
	var accion = "busco";
	$.ajax({
		type: "POST",
		url: 'php/busco_mov.php',
		data: {tipo : tipo, boton : accion, desde : desde, hasta : hasta}
	}).done(function(resp){
		datos = eval(resp);
		if (datos != 0){
			listado += '<tr>'
			listado += '<td style="width:10%"><b>Id:</b></td>'
			listado += '<td style="width:10%"><b>N°comprobante</b></td>'
			listado += '<td style="width:10%"><b>Fecha</b></td>'
			listado += '<td style="width:10%"><b>Hora</b></td>'
			listado += '<td style="width:20%"><b>Operador</b></td>'
			listado += '<td style="width:10%"><b>Detalle</b></td>'
			listado += '<td style="width:10%"><b>ingreso</b></td>'
			listado += '<td style="width:10%"><b>Egreso</b></td>'
			listado += '<td style="width:10%"><b>Saldo</b></td>'
			listado += '</tr>'
			for(var i=0;i<datos.length;i++){
				var tipos = datos[i]["tipo_operacion"];
				if(tipos != 5){
					var hora = datos[i]["Fecha"];
					hora = hora.split(" ");
					observacion = "";
					listado += '<tr>'
					listado += ' 		<td style="width:10%">'+datos[i]["idFactura"]+'</td>'
					listado += ' 		<td style="width:10%">'+datos[i]["NroComprobante"]+'</td>'
					listado += ' 		<td style="width:10%">'+hora[0]+'</td>'
					listado += ' 		<td style="width:10%">'+hora[1]+'</td>'
					listado += ' 		<td style="width:10%">'+datos[i]["Usuario"]+'</td>'
					id = datos[i]["Id"];
					if(tipos == 4 || tipos == 3){
						accion = "detalle";
						var observ = "";
						$.ajax({
							type: "POST",
							url: 'php/busco_mov.php',
							data: {tipos : tipos, id : id, boton : accion}
						}).done(function(respuesta){
							datos2 = eval(respuesta);
							observ = datos2[0]["observacion"];
						});
						listado +=' 		<td style="width:10%">'+datos[i]["observacion"]+'</td>'
					}else{
						if(tipos == 1){
							listado +=' <td style="width:10%"> <a class="btn btn-success btn-sm" type="button" href="javascript:ver_factura('+i+')">Ver Factura</a></td>'
						}else{
							listado +=' <td style="width:10%"> <a class="btn btn-success btn-sm" type="button" href="javascript:ver_facturaCompra('+i+')">Ver Factura</a></td>'
						}
					}
					var total = parseFloat(datos[i]["total"]-datos[i]["Descuento"]);
					if(tipos == 1 || tipos == 4){
						saldo = total + saldo;
						listado += '	<td style="width:10%">'+total.toFixed(2)+'</td>'
						listado += '	<td style="width:10%">_____________</td>'
					}
					if(tipos == 2 || tipos == 3){
						saldo = saldo - total ;
						listado += '	<td style="width:10%">_____________</td>'
						listado += '	<td style="width:10%">'+total.toFixed(2)+'</td>'
					}
					listado += '	<td style="width:10%">'+saldo.toFixed(2)+'</td>'
					listado += '</tr>'
				}else{
					saldo += datos[i]['anterior'];
					listado += '<tr> <td> </td> <td> </td> <td> </td>  <td> <div class="alert alert-danger" style="height:80px" style="width:100%" role="alert"><b>Saldo Anterior = '+datos[i]['anterior'].toFixed(2)+'</b></div></td><td> <div class="alert alert-danger" style="height:80px" style="width:100%" role="alert"><b>Total = '+saldo.toFixed(2)+'</b></div> </tr>'

				}

			}



			$('#todos_movimientos').html(listado);

		} else {
				var listado = "";
				listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
				$('#todos_movimientos').html(listado);
		}
	});

}

//=============DATA TABLE =====================


function cliente_producto(){

	$.ajax({
		type: "POST",
		data: {
			"boton":"cliente_producto",
			// "id_loc_origen": 1,
			// "id_loc_destino": 28,
			// "fecha": "2019-05-21"
		},
		url: "php/busco_mov.php",
		dataType: "json",
		cache: false,
		success: function(resp) {
			console.log(resp);
			var table = $("#cliente_producto").DataTable();
			for (var i = 0; i < resp.length; i++) {
				table.row.add([resp[i].Fecha, resp[i].Cantidad, resp[i].NombreProducto, resp[i].Nombre, '<button class="btn btn-success btn-sm" onclick=test('+resp[i].factura+')>Ver Factura</button>']).draw();
			}
		}
	});
}

function test(i){
	NumeroFactura = i;
	window.open('facturaYaVenta.php?num='+NumeroFactura, '_blank');
}

function limpiar_tabla1(){
	table.destroy();
	// listado += ''
	// $('#todos_movimientos').html(listado);
}

function limpiar_tabla2(){
	listado += ''
	$('#cliente_producto').html(listado);
}


function observar(observ, listado){

	listado +=' 		<td style="width:10%">HOLA</td>'
}

function ver_factura(i){
	//alert(i);
	NumeroFactura = datos[i]["idFactura"];
	window.open(
	'facturaYaVenta.php?num='+NumeroFactura,
	'_blank' // <- This is what makes it open in a new window.
);
}
function ver_facturaCompra(i){
	NumeroFactura = datos[i]["idFactura"];
	window.open(
	'facturaYaCompra.php?num='+NumeroFactura,
	'_blank' // <- This is what makes it open in a new window.
);
}

function validar_hasta()
{

	 var fecha1=$('#fecha1').val();
	 var fecha2=$('#fecha2').val();
   if(fecha1 > fecha2){
     $('#fecha1').val(fecha2);
   }
}
function validar_desde()
{
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1; //hoy es 0!
	var yyyy = hoy.getFullYear();

	if(dd<10) {
	    dd='0'+dd
	}

	if(mm<10) {
	    mm='0'+mm
	}

	hoy = yyyy+'-'+mm+'-'+dd;


	var fecha1=$('#fecha1').val();
	var fecha2=$('#fecha2').val();

	if(fecha1 > hoy){
		$('#fecha1').val(hoy);
		$('#fecha2').val(hoy);
	}else {
		if(fecha1 > fecha2){
			$('#fecha2').val(fecha1);
		}
	}
}
