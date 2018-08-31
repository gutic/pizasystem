function validar_hasta()
{
    //
		 var fecha1=$('#fecha1').val();
		 var fecha2=$('#fecha2').val();
     if(fecha1 > fecha2){
       $('#fecha1').val(fecha2);
     }

    //
		// $.ajax({
		// 	type: "POST",
		// 	dataType: 'json',
		// 	url: "php/cl_abm.php",
		// 	data: 'Usuario='+Usuario+'&Contrasena='+Contrasena+"&boton=ingresar"
		// }).done(function(resp){
		// 	if(resp){
		// 		location.href='main.php';
		// 	}else {
		// 		alert('Usuario o Contraseña incrorrecto');
		// 	}
		// });
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
