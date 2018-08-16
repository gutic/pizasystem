<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
?>

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 well" id="cont">
				<div class="main">
					<form id="formulario_login">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" id="Usuario" name="Usuario" placeholder="Usuario" required />
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" id="Contrasena" name="Contrasena" placeholder="Contrasena" required />
						</div><br/>
						<div class="input-group">
							<button type="button" onclick="confirmar();" value="Iniciar Sesion" id="Iniciar">Iniciar Sesion </button>
						</div>
					</form>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="mensaje"></div></div>

<?php
	//include_once('views/footer.php');
?>
