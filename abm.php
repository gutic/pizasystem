<?php

	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar_abm.php');

	?>

<section id="provedor">
	<br>
	<div class="col-xs-110 col-sm-110 col-md-100 col-lg-100 well">
	  <table style="width:100%">
	    <tr>
	      <td style="width:50%" valign="top">
	        <fieldset>
	          <legend>ABM proveedores</legend>
	          <form id="form_prove">
	            <table>
	              <tr>
	                <td><b>Nombre*:</b></td>
	                <td><input type="text" name="prov" ></td>
	              </tr>
	              <tr>
	                <td><b>CUIT*:</b></td>
	                <td><input type="text" name="cuit_prove" ></td>
	              </tr>
	              <tr>
	                <td><b>Direcci&oacute;n:</b></td>
	                <td><input type="text" name="dir_prove" ></td>
	              </tr>
	              <tr>
	                <td><b>Telef&oacute;no:</b></td>
	                <td><input type="text" name="tel_prove" ></td>
	              </tr>
	            </table>
	            <input type="button" value="Guardar" onclick="guardar_proveedor();" />
	            <input type="button" value="Limpiar"  onclick="limpiar();" />
	          </form>
	        </fieldset>
	      </td>
	      <!-- ______________________________Zona de filtro______________________________ -->
	      <td style="width:50%" valign="top">
	          <fieldset>
							<legend>Buscar Prove</legend>
							<table>
								<tr>
									<td><b>Nombre o cod Provedor:</b></td>
									<td><input type="text" name="prove" id="prove" onchange="buscar_prove();" ></td> <!--cliente -->
									<td><input type="button" value="Buscar Proveedor"  onclick="buscar_prove();" /></td>
								</tr>
							</table>
					</form>
					<table style="width:100%" border="2">
						<tr>
							<td style="width:20%"><b>nombre:</b></td>
							<td style="width:20%"><b>telefono:</b></td>
							<td style="width:20%"><b>direccion</b></td>
							<td style="width:20%"><b>Cuit</b></td>
							<td style="width:10%">editar </td>
							<td style="width:10%">eliminar </td>
						</tr>
					</table>
					<table id="busco_prove">

					</table>

				</form>
			</fieldset>
		</td>
	</tr>

	</table>


	<div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
</section>

<section id="clientes">
	<br>
	<br>
	<div class="col-xs-110 col-sm-110 col-md-100 col-lg-100 well">
		<table style="width:100%">
			<tr>
				<td style="width:50%" valign="top">
					<fieldset>
						<legend>ABM Clientes</legend>
						<form id="form_cliente">
							<table>
								<tr>
									<td><b>Nombre Cliente*:</b></td>
									<td><input type="text" name="cli" ></td>
								</tr>
								<tr>
									<td><b>CUIT*:</b></td>
									<td><input type="text" name="cuit_cliente" ></td>
								</tr>
								<tr>
									<td><b>Direcci&oacute;n:</b></td>
									<td><input type="text" name="dir_cliente" ></td>
								</tr>
								<tr>
									<td><b>Telef&oacute;no:</b></td>
									<td><input type="text" name="tel_cliente" ></td>
								</tr>
								<tr>
									<td><b>Cumpleaños:</b></td>
									<td> <input type="date" name="cumple_cliente" id="cumple"> </td>
								</tr>
							</table>
							<input type="button" value="Guardar" onclick="guardar_cliente();" />
							<input type="button" value="Limpiar"  onclick="limpiar();" />
						</form>
					</fieldset>
				</td>
	      <!-- ______________________________Zona de filtro______________________________ -->
	       <td style="width:50%" valign="top">
					 <fieldset>
						 <legend>Buscar Cliente</legend>
						 <table>
							 <tr>
								 <td><b>Nombre o cod Cliente:</b></td>
								 <td><input type="text" name="cliente" id="cliente" onchange="buscar_cliente()" ></td> <!--cliente -->
								 <td><input type="button" value="Buscar Cliente"  onclick="buscar_cliente();" /></td>
							 </tr>
					 	 </table>
				 </form>
				 <table style="width:100%" border="2">
					 <tr>
						 <td style="width:20%"><b>nombre:</b></td>
						 <td style="width:20%"><b>telefono:</b></td>
						 <td style="width:20%"><b>direccion</b></td>
						 <td style="width:20%"><b>Cuit</b></td>
						 <td style="width:20%"><b>Cumpleaños</b></td>
						 <td style="width:10%">editar </td>
						 <td style="width:10%">eliminar </td>
					 </tr>
				 </table>
				 <table id="busco_cliente">

				 </table>

			 </form>
		 </fieldset>
	      </td>
	    </tr>

	  </table>


		<div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
</section>

<section id="insumos">
	<br>
	<br>
	<br>
	<div class="col-xs-110 col-sm-110 col-md-100 col-lg-100 well">
	  <table style="width:100%">
	    <tr>
	      <td style="width:50%" valign="top">
	        <fieldset>
	          <legend>ABM Insumos</legend>
	          <form id="form_insumo">
	            <table>
	              <tr>
	                <td><b>Nombre*:</b></td>
	                <td><input type="text" name="insumo" ></td>
	              </tr>
	              <tr>
	                <td><b>Unidad Medida*:</b></td>
	                <td><input type="number" name="udm" ></td>
	              </tr>
	            </table>
	            <input type="button" value="Guardar" onclick="guardar_insumo();" />
	            <input type="button" value="Limpiar"  onclick="limpiar();" />
	          </form>
	        </fieldset>
	      </td>
	      <!-- ______________________________Zona de filtro______________________________ -->
	       <td style="width:50%" valign="top">
	        <fieldset>
						<fieldset>
 						 <legend>Buscar Insumos</legend>
 						 <table>
							 <td><b>Nombre o cod Insumo:</b></td>
							 <td><input type="text" name="insumo" id="insumo" onchange="buscar_insumo()" ></td> <!--cliente -->
							 <td><input type="button" value="Buscar Insumo"  onclick="buscar_insumo();" /></td>
 					 	 </table>
 				 </form>
 				 <table style="width:100%" border="2">
 					 <tr>
 						 <td style="width:20%"><b>nombre:</b></td>
 						 <td style="width:20%"><b>UnidadDeMedida:</b></td>
 					 </tr>
 				 </table>
 				 <table id="busco_insumo">

 				 </table>

 			 </form>
 		 </fieldset>
	      </td>
	    </tr>
	  </table>
		<div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
	<br>
</section>

<section id="articulos">
	<br>
	<br>
	<br>
	<div class="col-xs-110 col-sm-110 col-md-100 col-lg-100 well">
	  <table style="width:100%">
	    <tr>
	      <td style="width:50%" valign="top">
	        <fieldset>
	          <legend>ABM Articulos</legend>
	          <form id="form_articulo">
	            <table >
	              <tr>
	                <td><b>Nombre*:</b></td>
	                <td><input type="text" name="articulo" ></td>
	              </tr>
								<tr>
									<td><b>Precio*:</b></td>
									<td><input type="text" name="precio" value="0"></td>
								</tr>
	            </table>
							<input type="button" value="Guardar" onclick="guardar_articulo();" />
							<input type="button" value="Limpiar"  onclick="limpiar();" />
	          </form>
	        </fieldset>
	      </td>
	      <!-- ______________________________Zona de filtro______________________________ -->
	       <td style="width:50%" valign="top">
	        <fieldset>
						<fieldset>
 						 <legend>Buscar articulo</legend>
						 <table>
							 <td><b>Nombre o cod Articulo:</b></td>
							 <td><input type="text" name="articulo" id="articulo" onchange="buscar_articulo()" ></td> <!--cliente -->
							 <td><input type="button" value="Buscar Articulo"  onclick="buscar_articulo();" /></td>
 					 	 </table>
 				 </form>
 				 <table style="width:100%" border="2">
 					 <tr>
 						 <td style="width:20%"><b>nombre:</b></td>
 						 <td style="width:20%"><b>Precio:</b></td>
 					 </tr>
 				 </table>
 				 <table id="busco_articulo">

 				 </table>

 			 </form>
 		 </fieldset>
	      </td>
	    </tr>
	  </table>
		<div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
	<br>
</section>

<section id="receta">
	<br>
	<br>
	<br>
	<div class="col-xs-110 col-sm-110 col-md-100 col-lg-100 well">
	  <table style="width:100%">
	    <tr>
	      <td style="width:50%" valign="top">
	        <fieldset>
	          <legend>ABM Recetas</legend>
	          <form id="form_receta">
	            <table >
	              <tr>
	                <td><b>Nombre del Receta*:</b></td>
	                <td><input type="text" name="receta" ></td>
	              </tr>
								<tr>
									<td><b>Precio de venta:</b></td>
									<td><input type="text" name="precio_receta" value="0"></td>
								</tr>
	            </table>
							<input type="button" value="Guardar" onclick="guardar_receta();" />
							<input type="button" value="Limpiar"  onclick="limpiar();" />
	          </form>
						<br>
						 <fieldset>
								<legend>Buscar Receta</legend>
								<b>Nombre o cod Usuario:</b>
								<input type="text" name="receta" id="_receta" onchange="buscar_receta()"/ >
								<input type="button" value="Buscar recetas"  onclick="buscar_receta();" />
						<table style="width:100%" border="2">
							<tr>
								<td style="width:70%"><b>nombre:</b></td>
								<td style="width:10%"><b>precio:</b></td>
								<td style="width:10%"><b>Editar:</b></td>
								<td style="width:10%"><b>Eliminar:</b></td>
							</tr>
						</table>
						<table id="busco_receta">

						</table>
	        </fieldset>
	      </td>
	      <!-- ______________________________Zona de filtro______________________________ -->
	       <td style="width:50%" valign="top">
	        <fieldset id="oculto" style="display:none;">
						<fieldset>
 						 <legend>Buscar Ingredientes de Receta: <b id="editando"></b></legend>
						 <input type="text" name="insumo_" id="insumo_" onchange="buscar_datos_insumo()"/ >
						 <input type="button" value="Buscar insumos"  onclick="buscar_datos_insumo();" />
						 <div id="resultado_busqueda_insumo">

						 </div>
		 				 <table style="width:100%" border="2">
		 					 <tr>
		 						 <td style="width:80%"><b>nombre Insumo:</b></td>
								 <td style="width:10%"><b>Consume:</b></td>
								 <td style="width:10%"><b>Eliminar:</b></td>
		 					 </tr>
		 				 	</table>
		 				 <table id="busco_insumo_receta">

		 				 </table>
 		 				</fieldset>
	      </td>
	    </tr>
	  </table>
		<div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
	<br>
</section>

<section id="usuarios">
	<div class="col-xs-110 col-sm-110 col-md-100 col-lg-100 well">
		<table style="width:100%">
			<tr>
				<td style="width:50%" valign="top">
					<fieldset>
						<legend>ABM Usuarios</legend>
						<form id="form_usr">
							<table>
								<tr>
									<td><b>Nombre Usuario*:</b></td>
									<td><input type="text" name="nombre" ></td>
								</tr>
								<tr>
									<td><b>Contraseña*:</b></td>
									<td><input type="text" name="contrasena" ></td>
								</tr>
								<tr>
									<td><b>Direcci&oacute;n e-mail:</b></td>
									<td><input type="text" name="email" ></td>
								</tr>
								<tr>
									<td><b>Tipo usuario:</b></td>
									<td><input type="text" name="tipo_usr" ></td>
								</tr>
							</table>
							<input type="button" value="Guardar" onclick="guardar_usuario();" />
							<input type="button" value="Limpiar"  onclick="limpiar();" />
						</form>
					</fieldset>
				</td>
	      <!-- ______________________________Zona de filtro______________________________ -->
	       <td style="width:50%" valign="top">
					 <fieldset>
						 <legend>Buscar Usuario</legend>
						 <table>
							 <td><b>Nombre o cod Usuario:</b></td>
							 <td><input type="text" name="usuario" id="usuario" onchange="buscar_usuario()" ></td> <!--cliente -->
							 <td><input type="button" value="Buscar Usuario"  onclick="buscar_usuario();" /></td>
 					 	 </table>
				 </form>
				 <table style="width:100%" border="2">
					 <tr>
						 <td style="width:20%"><b>nombre:</b></td>
						 <td style="width:20%"><b>contraseña:</b></td>
						 <td style="width:20%"><b>email</b></td>
						 <td style="width:20%"><b>TipoUsr</b></td>
						 <td style="width:10%">editar </td>
						 <td style="width:10%">eliminar </td>
					 </tr>
				 </table>
				 <table id="busco_usuario">

				 </table>
			 </form>
		 </fieldset>
	      </td>
	    </tr>
	  </table>
		<div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
	</div>
</section>
<br>
<br>
<br>
<br>

<?php
  include_once('views/footer.php');
	?>
