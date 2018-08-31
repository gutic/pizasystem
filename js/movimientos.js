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
