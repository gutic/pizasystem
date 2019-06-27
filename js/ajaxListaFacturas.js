
function buscar(){

	$(buscar_datos());

	$(document).on('keyup','#num', function(){
		var valor = $(this).val();
		if(valor !=""){
			buscar_datos(valor);
		} else{
			buscar_datos();
		}
	});
}

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
function ver_lista_factura(i){
	NumeroFactura = i
	window.open(
  'facturaYaVenta.php?num='+NumeroFactura,
  '_blank' // <- This is what makes it open in a new window.
);
}
function ver_lista_facturaCompra(i){
	NumeroFactura = i;
	window.open(
	'facturaYaCompra.php?num='+NumeroFactura,
	'_blank' // <- This is what makes it open in a new window.
);
}
