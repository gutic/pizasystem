<table style="font-size: 11px;" id="listaF">
	<tbody>
		<tr><td colspan="4"><h3>DOCUMENTOS CLASIFICADOS</h3></td></tr>
		<tr><td colspan="4"></td></tr>
		<tr>
			<td width="60"><b>Número</b></td><td width="120"><b>Tipo</b></td><td width="240"><b>Descripcion</b></td><td width="140"><b>Tipo Documento</b></td><td width="240"></td>
		</tr>

		<tr id="tr_12">
			<td id="td_id">12</td><td><a href="#"><img src="assets/img/icon_img.png"> Imágen</a></td><td id="descr"><input type="text" value="22323" id="text_12" style="font-text: 11px; width: 220px; height: 16px;"></td><td>OTRO CAMPO</td><td>OTRO CAMPO</td>
		</tr>

		<tr id="tr_13">
			<td id="td_id">13</td><td><a href="#"><img src="assets/img/icon_img.png"> Imágen</a></td><td id="descr"><input type="text" value="22323" id="text_12" ></td><td>OTRO CAMPO</td><td>OTRO CAMPO</td>
		</tr>

		<tr id="tr_14">
			<td id="td_id">14</td><td><a href="#"><img src="assets/img/icon_img.png"> Imágen</a></td><td id="descr"><input type="text" value="22323" id="text_12" ></td><td>OTRO CAMPO</td><td>OTRO CAMPO</td>
		</tr>

		<tr id="tr_15">
			<td id="td_id">15</td><td><a href="#"><img src="assets/img/icon_img.png"> Imágen</a></td><td id="descr"><input type="text" value="22323" id="text_12" ></td><td>OTRO CAMPO</td><td>OTRO CAMPO</td>
		</tr>

		<tr id="tr_16">
			<td id="td_id">16</td><td><a href="#"><img src="assets/img/icon_img.png"> Imágen</a></td><td id="descr"><input type="text" value="22323" id="text_12" ></td><td>OTRO CAMPO</td><td>OTRO CAMPO</td>
		</tr>
	</tbody>
</table>

<div class="btn_save">
	<button class="btns" onclick="grabaTodoTabla('listaF');" title="Grabar">
		GRABAR DATOS
	</button>
</div>

<script type="text/javascript">
// Actualiza de manera masiva todos los archivos cargados en la tercera pestaña.
function grabaTodoTabla(<TABLAID></TABLAID>){
	//tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla
	var DATA 	= [],
	var TABLA 	= $("#"+TABLAID+" tbody > tr");

	//una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
	TABLA.each(function(){
		//por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select
		var ID 		= $(this).find("td[id='td_id']").text(),
			DESC 	= $(this).find("input[id*='text_']").val(),
			CLAS 	= $(this).find("select").val();

		//entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
		item = {};
		//si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
		if(ID !== ''){
	        item ["id"] 	= ID;
	        item ["desc"] 	= DESC;
	        item ['tipo'] 	= CLAS;
	        //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".
	        DATA.push(item);
		}
	});
	console.log(DATA);

	//eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.
	INFO 	= new FormData();
	aInfo 	= JSON.stringify(DATA);

	INFO.append('data', aInfo);

	$.ajax({
		data: INFO,
		type: 'POST',
		url : './funciones_upload.php',
		processData: false,
		contentType: false,
		success: function(r){
			//Una vez que se haya ejecutado de forma exitosa hacer el código para que muestre esto mismo.
		}
	});
}
</script>
