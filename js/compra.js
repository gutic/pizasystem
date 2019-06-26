function factura_compraProducto()
{
	var data_form = $("#formulario").serialize()
	$.ajax({
		url:'php/compra.php',
		type:'POST',
		data: "boton=factura_compraProducto&"+data_form+'&tabla_cant='+tabla_cant+'&tabla_id='+tabla_id+'&tabla_precio='+tabla_precio
	}).done(function(resp){
		alert(resp);
		if(resp > 0){
			NumeroFactura = resp;
			limpiar();
			alertify.succes("Compra Producto Ok");
		}else {
			if(resp == 0){
				alertify.error("debe rellenar los cambos");
			};
		};
	});
}
function factura_compraInsumo()
{
	var data_form = $("#formulario").serialize()
	$.ajax({
		url:'php/compra.php',
		type:'POST',
		data: "boton=factura_compraInsumo&"+data_form+'&tabla_cant='+tabla_cant+'&tabla_id='+tabla_id+'&tabla_precio='+tabla_precio
	}).done(function(resp){
		alert(resp);
		if(resp > 0){
			NumeroFactura = resp;
			limpiar();
			alertify.succes("Compra Insumo Ok");
		}else {
			if(resp == 0){
				alertify.error("debe rellenar los cambos");
			};
		};
	});
}

function limpiar()
{
	$("#formulario [type='text']").val("")//limpiar formulario (todos los  type="text")
	$("#formulario select").val(0)//loimpiar select de los formulario

}
