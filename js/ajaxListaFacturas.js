
window.onload = function(){

	$(buscar_datos());

	$(document).on('keyup','#num', function(){
		var valor = $(this).val();
		if(valor !=""){
			buscar_datos(valor);
		} else{
			buscar_datos();
		}
	});


	function buscar_datos(consulta){
		var tipo = $('#tipo').val();

		$.ajax({
			url: 'php/lista_factura.php',
			type: 'POST',
			dataType: 'html',
			data: {consulta : consulta, tipo : tipo},
		})
		.done(function(respuesta) {
			$("#datos").html(respuesta);
		})
		.fail(function(){
			console.log("error")
		})
	};

}
