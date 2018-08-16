
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


//_____________compra productos _________________//

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
