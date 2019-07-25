<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('views/navbar.php');
?>


<form class="p-3 mb-2 bg-dark text-white">
	<div class="form-row">
		<label>Busqueda</label>
	</div>

	<div class="form-row">
		<div class="form-group col-md-3">
			<label>Desde</label>
			<input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" id="fecha1" onchange="validar_desde();">
		</div>
		<div class="form-group col-md-3">
			<label>Hasta</label>
			<input type="date" class="form-control"  value="<?php echo date("Y-m-d");?>" id="fecha2" onchange="validar_hasta();">
		</div>
			<div class="form-group col-md-1">
				<label for="inputState">Tipo Movimiento</label>
					<select onchange="buscar();" id="tipo">
						<option selected value="5">Todo...</option>
						<option value="1">Venta</option>
						<option value="2">Compra</option>
						<option value="3">Extracción</option>
						<option value="4">Ingreso</option>
					</select>
			</div>
			<div class="form-group col-md-4">
				<button type="button" class="btn btn-default" onclick="buscar();">Buscar</button>
				<button type="button" class="btn btn-default" onclick="limpiar_tabla1();">borrar</button>
			</div>
		</div>



	<table style="width:100%" id="todos_movimientos" border="1">

	</table>

</form>

<br>
<br>
<br>


<form class="p-3 mb-2 bg-dark text-white">
	<div class="form-row">
		<label>Busqueda</label>
	</div>
	<form class="p-3 mb-2 bg-dark">

		<div class="form-row">
				<div class="form-group col-md-4">
					<button type="button" class="btn btn-default" onclick="cliente_producto();">Buscar</button>
					<button type="button" class="btn btn-default" onclick="limpiar_tabla2();">borrar</button>
				</div>
	    	<section class="content">
	    		<div class="row">
	    			<div class="col-xs-12">
	    				<div class="box">
	    					<div class="box-header">
	    						<h3 class="box-title">Movimientos Producto - Cliente </h3>
	    					</div>
	    					<!-- /.box-header -->
	    					<div class="box-body">
	    						<table id="cliente_producto" class="datatables" border="1" style="width:100%">
										<thead>
	    								<tr>
	    									<th>Fecha</th>
	    									<th>Cantidad</th>
	    									<th>Prodcuto</th>
	    									<th>Cliente</th>
												<th>Ver Factura</th>
	    								</tr>
	    							</thead>

	    						</table>
	    					</div>
	    					<!-- /.box-body -->
	    				</div>
	    			</div>
	    			<!-- /.col -->
	    		</div>
	    		<!-- /.row -->
	    	</section>

	    </div>
	</form>

</form>

<br>
<br>
<br>


<form class="p-3 mb-2 bg-dark text-white">
	<div class="form-row">
		<label>Busqueda</label>
	</div>
	<form class="p-3 mb-2 bg-dark">

		<div class="form-row">
				<div class="form-group col-md-4">
					<button type="button" class="btn btn-default" onclick="stock_productos();">Buscar</button>
					<button type="button" class="btn btn-default" onclick="limpiar_tabla3();">borrar</button>
				</div>
	    	<section class="content">
	    		<div class="row">
	    			<div class="col-xs-12">
	    				<div class="box">
	    					<div class="box-header">
	    						<h3 class="box-title">Movimientos de Productos e Insumos </h3>
	    					</div>
	    					<!-- /.box-header -->
	    					<div class="box-body">
	    						<table id="stock" class="datatables" border="1" style="width:100%">
										<thead>
	    								<tr>
												<th>Nombre Producto</th>
	    									<th>Fecha último ingreso</th>
	    									<th>Cantidad Ingreso</th>
	    									<th>Cantidad Salida</th>
	    									<th>Stock Actual</th>
	    								</tr>
	    							</thead>

	    						</table>
	    					</div>
	    					<!-- /.box-body -->
	    				</div>
	    			</div>
	    			<!-- /.col -->
	    		</div>
	    		<!-- /.row -->
	    	</section>

	    </div>
	</form>

</form>


<?php
  	include_once('views/footer.php');
?>
