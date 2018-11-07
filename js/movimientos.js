
var listado = "";
var algo ="";
function buscar()
{
	var tipo = $('#tipo').val();
	var busco = "busco";
	$.ajax({
		type: "POST",
		url: 'php/busco_mov.php',
		data: {tipo : tipo, boton : busco}
	}).done(function(resp){
		datos = eval(resp);
		if (datos != 0){

		for(var i=0;i<datos.length;i++){
			var hora = datos[i]["Fecha"];
			hora = hora.split(" ");
			var tipos = datos[i]["tipo_operacion"];
			listado += '<div class="form-row">'
			listado += '<div class="form-group col-md-1">'
			listado += ' 		<td style="width:23%">'+datos[i]["Id"]+'</td>'
			listado += '</div>'
			listado += '<div class="form-group col-md-1">'
			listado += ' 		<td style="width:20%">'+datos[i]["NroComprobante"]+'</td>'
			listado += '</div>'
			listado += '<div class="form-group col-md-1">'
			listado += ' 		<td style="width:20%">'+hora[0]+'</td>'
			listado += '</div>'
			listado += '<div class="form-group col-md-1">'
			listado += ' 		<td style="width:20%">'+hora[1]+'</td>'
			listado += '</div>'
			listado += '<div class="form-group col-md-1">'
			listado += ' 		<td style="width:20%">'+datos[i]["Usuario"]+'</td>'
			listado += '</div>'
			if ( (tipos != 4) && (tipos != 3) ){
				listado += '<div class="form-group col-md-1">'
				listado += '		<td style="width:10%"> <a type="button" href="javascript:ver_factura('+i+')">Ver Factura</a></td>'
				listado += '</div>'
			}else{
				id = datos[i]["Id"];
				busco = "detalle";
				$.ajax({
					type: "POST",
					url: 'php/busco_mov.php',
					data: {tipos : tipos, id : id, boton : busco}
				}).done(function(respuesta){
					datos2 = eval(respuesta);
					listado += '<div class="form-group col-md-1">'
					listado += ' 		<td style="width:20%">'+datos2[0]["observacion"]+'</td>'
					alert(datos2[0]["observacion"]);
					listado += '</div>'
					algo = datos2[0]["observacion"];
				});
			}
			listado += '</div>'
			}
			$('#resultado').html(listado);
		}else {
			var listado = "";
			listado += '<div class="alert alert-danger" style="height:40px" role="alert"><b>Datos no Encontrados </b></div>'
			$('#resultado').html(listado);
		}
	});
}

function ver_factura(i){
	var ver = datos[i]["Id"];
	alert(ver);

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
