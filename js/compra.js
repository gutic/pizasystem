function factura_compraProducto()
{
	var data_form = $("#formulario").serialize()
	$.ajax({
		url:'php/compra.php',
		type:'POST',
		data: "boton=factura_compraProducto&"+data_form+'&tabla_cant='+tabla_cant+'&tabla_id='+tabla_id+'&tabla_precio='+tabla_precio+'&tabla_tipo='+tabla_tipo
	}).done(function(resp){
		var data = eval(resp);
		NumeroFactura = data[0]["Id"];
		if(NumeroFactura > 0){
			location.href='facturaYaCompra.php?num='+NumeroFactura
			// window.open(
			// 'facturaYaCompra.php?num='+NumeroFactura,
			// '_blank' // <- This is what makes it open in a new window.
			// )
		}else {
			if(resp == 0){
				alertify.success("debe rellenar los cambos");
			};
		};
	});
}
// function test(){
// 	alert("asd")
// 	$.ajax({
// 		url:'php/compra.php',
// 		type:'POST',
// 		data: "boton=test"
// 	}).done(function(resp){
// 		var data = eval(resp);
// 		alert(data[0]["Id"]);
// 	});
// }

function limpiar()
{
	$("#formulario [type='text']").val("")//limpiar formulario (todos los  type="text")
	$("#formulario select").val(0)//loimpiar select de los formulario

}
