var id_editar = 0
var elaborado = 0
function limpiar()
{
	$("#form_prove [type='text']").val("")//limpiar formulario (todos los  type="text")
	$("#form_prove select").val(0)//loimpiar select de los formulario
  $("#form_cliente [type='text']").val("")//limpiar formulario (todos los  type="text")
	$("#form_articulo [type='text']").val("")
	$("#form_receta [type='text']").val("")
}

//_______________________________________PROVEEDOR__________________________________________
function guardar_proveedor(){
  if(validarDatos()){
    var data_form = $("#form_prove").serialize()//esta funcion ya arma la cadena para enviar
    if(id_editar == 0){
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=insertar_prove&"+data_form
      }).done(function( msg ) {
          alert(msg);
          limpiar();
          buscar_prove();
      });
    }else{
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=upd_prove&"+data_form+"&id="+id_editar
      }).done(function( msg ) {
          alert(msg)
          limpiar();
          buscar_prove();
          id_editar = 0;
      });
    }
  }else{
    alert("Complete todos los datos");
  }
}
function buscar_prove(){

	var consulta = $('#prove').val();
	var boton = "buscar";

  $.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: {consulta : consulta, boton : boton}
		}).done(function(resp){
      datos = eval(resp);
			if (datos != 0){
	      var listado = "";
	      for(var i=0;i<datos.length;i++){
	        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
	        listado += '<tr>'
	        listado += ' 		<td style="width:23%">'+datos[i]["Nombre"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Telefono"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Direccion"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Cuit"]+'</td>'
	        listado += '		<td style="width:10%"> <a type="button" href="javascript:editar_prove('+i+')">editar</a></td>'
	        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_prove('+i+')">eliminar</a></td>'
	        listado += '</tr>'
	      }
	      $('#busco_prove').html(listado);
			}else {
				var listado = "";
	      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
				$('#busco_prove').html(listado);
				// location.href='abm.php';
			}
	});
}
function editar_prove(i){
  id_editar = datos[i]["Id"];
  $("[name='prov']").val(datos[i]["Nombre"]);
  $("[name='cuit_prove']").val(datos[i]["Cuit"]);
  $("[name='dir_prove']").val(datos[i]["Direccion"]);
  $("[name='tel_prove']").val(datos[i]["Telefono"]);
}
function eliminar_prove(i){
  var statusConfirm = confirm("¿Realmente desea eliminar este proveedor?");
    if (statusConfirm == true)
      {
        alert ("Eliminado");
        var eliminar = datos[i]["Id"];
        $.ajax({
        type: "POST",
        url: "php/altas_bajas.php",
        data: "id="+eliminar+"&boton=del_prove"
        }).done(function( msg ) {
            limpiar();
            buscar_prove();
        });
      }
    else
      {
        alert("No se eliminó");
      }
}
function validarDatos(){
	if($.trim($("[name='prov']").val()) == "")return false;
	return true;
}
//_______________________________________CLIENTE__________________________________________
function validarDatosCliente(){
	if($.trim($("[name='cli']").val()) == "")return false;
	return true;
}
function guardar_cliente(){
  if(validarDatosCliente()){
    var data_form = $("#form_cliente").serialize()//esta funcion ya arma la cadena para enviar
    if(id_editar == 0){
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=insertar_cliente&"+data_form
      }).done(function( msg ) {
          alert(msg);
          limpiar();
          buscar_cliente();
      });
    }else{
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=upd_cliente&"+data_form+"&id="+id_editar
      }).done(function( msg ) {
          alert(msg)
          limpiar();
          buscar_cliente();
          id_editar = 0;
      });
    }
  }else{
    alert("Complete todos los datos");
  }
}
function editar_cliente(i){
  id_editar = datos[i]["Id"];
  $("[name='cli']").val(datos[i]["Nombre"]);
  $("[name='cuit_cliente']").val(datos[i]["Cuit"]);
  $("[name='dir_cliente']").val(datos[i]["Direccion"]);
  $("[name='tel_cliente']").val(datos[i]["Telefono"]);
}
function buscar_cliente(){

	var consulta = $('#cliente').val();
	var boton = "buscar_cliente";

  $.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: {consulta : consulta, boton : boton}
		}).done(function(resp){
      datos = eval(resp);
			if (datos != 0){
	      var listado = "";
	      for(var i=0;i<datos.length;i++){
	        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
	        listado += '<tr>'
	        listado += ' 		<td style="width:23%">'+datos[i]["Nombre"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Telefono"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Direccion"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Cuit"]+'</td>'
	        listado += '		<td style="width:10%"> <a type="button" href="javascript:editar_cliente('+i+')">editar</a></td>'
	        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_cliente('+i+')">eliminar</a></td>'
	        listado += '</tr>'
	      }
	      $('#busco_cliente').html(listado);
			}else {
				var listado = "";
	      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
				$('#busco_cliente').html(listado);
			}
	});
}
function eliminar_cliente(i){
  var statusConfirm = confirm("¿Realmente desea eliminar este Cliente?");
    if (statusConfirm == true)
      {
        alert ("Eliminado");
        var eliminar = datos[i]["Id"];
        $.ajax({
        type: "POST",
        url: "php/altas_bajas.php",
        data: "id="+eliminar+"&boton=del_prove"
        }).done(function( msg ) {
            limpiar();
            buscar_cliente();
        });
      }
    else
      {
        alert("No se eliminó");
      }
}
//_______________________________________INSUMO__________________________________________

function validarDatosInsumo(){
	if($.trim($("[name='insumo']").val()) == "")return false;
	return true;
}
function guardar_insumo(){
  if(validarDatosInsumo()){
    var data_form = $("#form_insumo").serialize()//esta funcion ya arma la cadena para enviar
    if(id_editar == 0){
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=insertar_insumo&"+data_form
      }).done(function( msg ) {
          alert(msg);
          limpiar();
          buscar_insumo();
      });
    }else{
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=upd_insumo&"+data_form+"&id="+id_editar
      }).done(function( msg ) {
          alert(msg)
          limpiar();
          buscar_insumo();
          id_editar = 0;
      });
    }
  }else{
    alert("Complete todos los datos");
  }
}
function editar_insumo(i){
  id_editar = datos[i]["Id_insumo"];
  $("[name='insumo']").val(datos[i]["Nombre"]);
  $("[name='udm']").val(datos[i]["UnidadMedida"]);
}
function buscar_insumo(){

	var consulta = $('#insumo').val();
  var boton = "buscar_insumo";


  $.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: {consulta : consulta, boton : boton}
		}).done(function(resp){
				datos = eval(resp);
				if (datos != 0){
		      var listado = "";
		      for(var i=0;i<datos.length;i++){
		        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
		        listado += '<tr>'
		        listado += ' 		<td style="width:23%">'+datos[i]["Nombre"]+'</td>'
		        listado += ' 		<td style="width:20%">'+datos[i]["UnidadMedida"]+'</td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:editar_insumo('+i+')">editar</a></td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_insumo('+i+')">eliminar</a></td>'
		        listado += '</tr>'
		      }
		      $('#busco_insumo').html(listado);
				}else {
					var listado = "";
		      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
					$('#busco_insumo').html(listado);
				}
	});
}
function eliminar_insumo(i){
  var statusConfirm = confirm("¿Realmente desea eliminar este Insumo?");
    if (statusConfirm == true)
      {
        alert ("Eliminado");
        var eliminar = datos[i]["Id_insumo"];
        $.ajax({
        type: "POST",
        url: "php/altas_bajas.php",
        data: "id="+eliminar+"&boton=del_insumo"
        }).done(function( msg ) {
            limpiar();
            buscar_insumo();
        });
      }
    else
      {
        alert("No se eliminó");
      }
}

//_______________________________________PRODUCTO/ARTICULO__________________________________________
function validarDatosArticulo(){
	if($.trim($("[name='articulo']").val()) == "")return false;
	return true;
}
function guardar_articulo(){
  if(validarDatosArticulo()){
    var data_form = $("#form_articulo").serialize()//esta funcion ya arma la cadena para enviar
    if(id_editar == 0){
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=insertar_articulo&"+data_form
      }).done(function( msg ) {
          alert(msg);
          limpiar();
          buscar_articulo();
      });
    }else{
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=upd_articulo&"+data_form+"&id="+id_editar
      }).done(function( msg ) {
          alert(msg)
          limpiar();
          buscar_articulo();
          id_editar = 0;
      });
    }
  }else{
    alert("Complete todos los datos");
  }
}
function editar_articulo(i){
  id_editar = datos[i]["Id"];
  $("[name='articulo']").val(datos[i]["NombreProducto"]);
  $("[name='precio']").val(datos[i]["CostoProducto"]);
}
function buscar_articulo(){

	var consulta = $('#articulo').val();
	var boton = "buscar_articulo";

  $.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: {consulta : consulta, boton : boton}
		}).done(function(resp){
				datos = eval(resp);
				if (datos != 0){
		      var listado = "";
		      for(var i=0;i<datos.length;i++){
		        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
		        listado += '<tr>'
		        listado += ' 		<td style="width:23%">'+datos[i]["NombreProducto"]+'</td>'
		        listado += ' 		<td style="width:20%">'+datos[i]["CostoProducto"]+'</td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:editar_articulo('+i+')">editar</a></td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_articulo('+i+')">eliminar</a></td>'
		        listado += '</tr>'
		      }
		      $('#busco_articulo').html(listado);
				}else {
					var listado = "";
		      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
					$('#busco_articulo').html(listado);
				}
	});
}
function eliminar_articulo(i){
  var statusConfirm = confirm("¿Realmente desea eliminar este Insumo?");
    if (statusConfirm == true)
      {
        alert ("Eliminado");
        var eliminar = datos[i]["Id"];
        $.ajax({
        type: "POST",
        url: "php/altas_bajas.php",
        data: "id="+eliminar+"&boton=del_articulo"
        }).done(function( msg ) {
            limpiar();
            buscar_articulo();
        });
      }
    else
      {
        alert("No se eliminó");
      }
}
//_______________________________________PRODUCTO ELABORADO__________________________________________
function validarDatosReceta(){
	if($.trim($("[name='receta']").val()) == "")return false;
	return true;
}

function guardar_receta(){
  if(validarDatosReceta()){
    var data_form = $("#form_receta").serialize()//esta funcion ya arma la cadena para enviar
    if(id_editar == 0){
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=insertar_receta&"+data_form
      }).done(function( msg ) {
          alert(msg);
          limpiar();
          buscar_receta();
      });
    }else{
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=upd_receta&"+data_form+"&id="+id_editar
      }).done(function( msg ) {
          alert(msg)
          limpiar();
          buscar_receta();
          id_editar = 0;
      });
    }
  }else{
    alert("Complete todos los datos");
  }
}

function buscar_receta(){

	var consulta = $('#_receta').val();
	var boton = "buscar_receta";

  $.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: {consulta : consulta, boton : boton}
		}).done(function(resp){
				datos = eval(resp);
				if (datos != 0){
		      var listado = "";
		      for(var i=0;i<datos.length;i++){
		        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
		        listado += '<tr>'
		        listado += ' 		<td style="width:70%">'+datos[i]["NombreProducto"]+'</td>'
		        listado += ' 		<td style="width:10%">'+datos[i]["CostoProducto"]+'</td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:editar_receta('+i+')">editar</a></td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_receta('+i+')">eliminar</a></td>'
		        listado += '</tr>'
		      }
		      $('#busco_receta').html(listado);
				}else {
					var listado = "";
		      listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
					$('#busco_receta').html(listado);
				}
	});
}
function editar_receta(i){
  id_editar = datos[i]["Id"];
  $("[name='receta']").val(datos[i]["NombreProducto"]);
  $("[name='precio_receta']").val(datos[i]["CostoProducto"]);
	listado = "";
	listado += '<a>'+datos[i]["NombreProducto"]+'</a>'
	$('#editando').html(listado);
	alert("Agregue o quite insumos. Cambie de nombre o precio");
  buscar_insunmo_de_receta();
}
function buscar_datos_insumo(){
  var consulta = $('#insumo_').val();
	var boton = "buscar_datos_insumo";
	$.ajax({
		url: 'php/altas_bajas.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta : consulta, boton : boton}
	})
	.done(function(respuesta) {
		$("#resultado_busqueda_insumo").html(respuesta);
	})
	.fail(function(){
		console.log("error")
	})
};

function agregar_insumo_receta(id_insumo){

	if (id_editar > 0) {
		if (id_insumo >  0){
			$.ajax({
				type: "POST",
				url: "php/altas_bajas.php",
				data: "id_insumo="+id_insumo+"&id_editar="+id_editar+"&boton=agregar_insumo_receta"
				}).done(function( msg ) {
					alert(msg);
  				buscar_insunmo_de_receta();
				});
		}else {
			alert("debe elegir un insumo");
		}
	}else {
		alert("debe elegir una receta");
	}
}
function buscar_insunmo_de_receta(){
	$.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: "id_editar="+id_editar+"&boton=buscar_insumo_receta"
		}).done(function(resp){
				var contenedor = document.getElementById("oculto");		
				contenedor.style.display = "block";
				insumo = eval(resp);
				if (insumo != null){
		      var listado = "";
		      for(var i=0;i<insumo.length;i++){
		        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
		        listado += '<tr>'
		        listado += ' 		<td style="width:23%">'+insumo[i]["Nombre"]+'</td>'
		        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_insumo_receta('+i+')">eliminar</a></td>'
		        listado += '</tr>'
		      }
		      $('#busco_insumo_receta').html(listado);
				}else {
					alert("No hay registros");
				}
	});
}
function eliminar_insumo_receta(i){
  var statusConfirm = confirm("¿Realmente desea eliminar este Insumo?");
    if (statusConfirm == true)
      {
        alert ("Eliminado");
        var eliminar = insumo[i]["Id_insumo"];
        $.ajax({
        type: "POST",
        url: "php/altas_bajas.php",
        data: "id_insumo="+eliminar+"&id_editar="+id_editar+"&boton=del_insumo_receta"
        }).done(function( msg ) {
            buscar_insunmo_de_receta();
        });
      }
    else
      {
        alert("No se eliminó");
      }
}
//_______________________________________USUARIO__________________________________________
function validarDatosUsuario(){
	if($.trim($("[name='nombre']").val()) == "")return false;
	return true;
}
function guardar_usuario(){
  if(validarDatosUsuario()){
    var data_form = $("#form_usr").serialize()//esta funcion ya arma la cadena para enviar
    if(id_editar == 0){
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=insertar_usuario&"+data_form
      }).done(function( msg ) {
          alert(msg);
          limpiar();
          buscar_cliente();
      });
    }else{
      $.ajax({
      type: "POST",
      url: "php/altas_bajas.php",
      data: "boton=upd_usuario&"+data_form+"&id="+id_editar
      }).done(function( msg ) {
          alert(msg)
          limpiar();
          buscar_usuario();
          id_editar = 0;
      });
    }
  }else{
    alert("Complete todos los datos");
  }
}
function editar_usuario(i){
  id_editar = datos[i]["Id"];
  $("[name='nombre']").val(datos[i]["Usuario"]);
  $("[name='contrasena']").val(datos[i]["Contrasena"]);
  $("[name='email']").val(datos[i]["Email"]);
  $("[name='tipo_usr']").val(datos[i]["TipoUsuario"]);
}
function buscar_usuario(){

	var consulta = $('#usuario').val();
	var boton = "buscar_usuario";

  $.ajax({
		type: "POST",
		url: 'php/altas_bajas.php',
		data: {consulta : consulta, boton : boton}
		}).done(function(resp){
      datos = eval(resp);
			if (datos != 0){
	      var listado = "";
	      for(var i=0;i<datos.length;i++){
	        var bgcolor = (i%2==0) ? "#FFFFFF":"#EDEDED";
	        listado += '<tr>'
	        listado += ' 		<td style="width:23%">'+datos[i]["Usuario"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Contrasena"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["Email"]+'</td>'
	        listado += ' 		<td style="width:20%">'+datos[i]["TipoUsuario"]+'</td>'
	        listado += '		<td style="width:10%"> <a type="button" href="javascript:editar_usuario('+i+')">editar</a></td>'
	        listado += '		<td style="width:10%"> <a type="button" href="javascript:eliminar_usuario('+i+')">eliminar</a></td>'
	        listado += '</tr>'
	      }
	      $('#busco_usuario').html(listado);
			}else {
				var listado = "";
				listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
				$('#busco_usuario').html(listado);
			}
	});
}
function eliminar_usuario(i){
  var statusConfirm = confirm("¿Realmente desea eliminar este Cliente?");
    if (statusConfirm == true)
      {
        alert ("Eliminado");
        var eliminar = datos[i]["Id"];
        $.ajax({
        type: "POST",
        url: "php/altas_bajas.php",
        data: "id="+eliminar+"&boton=del_usuario"
        }).done(function( msg ) {
            limpiar();
            buscar_usuario();
        });
      }
    else
      {
        alert("No se eliminó");
      }
}
