
//________________ para la factura venta __________________//

function buscar_datos(){
  var consulta =$('#Buscar').val();

	$.ajax({
		url: 'php/lista_items.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta : consulta},
	})
	.done(function(respuesta) {
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error")
	})
};

function buscar_clientes(){
  var consulta =$('#cliente').val();

	$.ajax({
		url: 'php/lista_clientes.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta : consulta},
	}).done(function(respuesta) {
    if(respuesta==0){
      var listado = "";
      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
      $('#clientes').html(listado);
    }else {
      datos = eval(respuesta);
      var listado = "";
      listado += '<table class="tabla_datos" border="2">'
      listado += '<thead>'
      listado += '<tr>'
      listado += '<td>Nombre</td>'
      listado += '</tr>'
      listado += '</thead>'
      listado += '<tbody>'
      for(var i=0;i<datos.length;i++){
        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
        listado += '<tr>'
        listado += '<td>'+datos[i]["Nombre"]+'</td>'
        listado += '<td><a class="btn btn-success btn-sm" href="javascript:agregar_persona('+i+')">Agregar</a></td>'
        listado += '</tr>'
      }
      $('#clientes').html(listado);
    }
  });
}

function agregar_persona(i){
  $("[name='cliente']").val(datos[i]["Nombre"]);
}

//_______________________listas insumos______________________________________ //

function buscar_datos_insumo(){
  var consulta =$('#Buscar').val();

	$.ajax({
		url: 'php/lista_insumo.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta : consulta},
	})
	.done(function(respuesta) {
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error")
	})
};

//_____________lista productos _________________//

function buscar_datos_producto(){
  var consulta =$('#Buscar').val();

	$.ajax({
		url: 'php/lista_producto.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta : consulta},
	})
	.done(function(respuesta) {
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error")
	})
};

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
      tabla_tipo[tabla_tipo.length] = 1;
			// alert(tabla_precio[num]);
			// alert(precio);
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
      tabla_tipo[tabla_tipo.length] = 2;
			// alert(tabla_precio[num]);
			// alert(precio);
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

function buscar_provedores(){

  var consulta =$('#prove').val();

	$.ajax({
		url: 'php/lista_prove.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta : consulta},
	}).done(function(respuesta) {
    if(respuesta==0){
      var listado = "";
      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
      $('#provedores').html(listado);
    }else {
      datos = eval(respuesta);
      var listado = "";
      listado += '<table class="tabla_datos" border="2">'
      listado += '<thead>'
      listado += '<tr>'
      listado += '<td>Nombre</td>'
      listado += '</tr>'
      listado += '</thead>'
      listado += '<tbody>'
      for(var i=0;i<datos.length;i++){
        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
        listado += '<tr>'
        listado += '<td>'+datos[i]["Nombre"]+'</td>'
        listado += '<td><a class="btn btn-success btn-sm" href="javascript:agregar_prove('+i+')">Agregar</a></td>'
        listado += '</tr>'
      }
      $('#provedores').html(listado);
    }
  });
}

function agregar_prove(i){
  $("[name='prove']").val(datos[i]["Nombre"]);
}
