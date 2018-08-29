<?php
	session_start();
	if ($_SESSION['logOk'] != 'YES') {
		session_destroy();
		header('Location: index.php');
	}
?>
<?php
	error_reporting(E_ERROR);
	include_once('views/head.php');
	include_once('css');
?>

<link href="css/simple-sidebar.css" rel="stylesheet">
<script type="text/javascript" src="js/altas_bajas.js"></script>
<div class="navbar navbar-default navbar-fixed-top" style="background:black" rol="navigation">
  <li>
    <a  href="#provedor">ABM Proveedores </a>
  </li>
  <li>
    <a  href="#clientes">ABM clientes </a>
  </li>
  <li>
    <a  href="#insumos"> ABM insumos </a>
  </li>
	<li>
		<a  href="#articulos"> ABM articulos </a>
	</li>
	<li>
		<a  href="#receta"> ABM recetas </a>
	</li>
	<li>
		<a  href="#usuarios"> ABM usuarios </a>
	</li>
  <ul class="navbar-right">
    <li><a href="#inicio"> Al menu </a></li>
  	</li>
	</ul>
</div>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LOGIN TEST</title>
	</head>
<body>
	<div id="wrapper">
			<div id="sidebar-wrapper">
								<ul class="sidebar-nav">
						<li class="sidebar-brand">
							<a href="main.php">
								Inicio
							</a>
						</li>
						<li>
							<a href="abm.php">____ABM____ </a>
						</li>
				</ul>
			</div>

			<!-- Page Content -->
    <section id="inicio">
      <div id="page-content-wrapper" >
					<br>
					<br>
					<div class="container-fluid" id="cont2" >
							<h1>Menú de opciones</h1>
							<p> Pulse el menú para ir  a las ABM, ver facturas o estados, cambiar datos de su cuenta.-</p>
							<a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu de Opciones</a>
					</div>
			</div>
    </section>
			<!-- /#page-content-wrapper -->

	</div>
	<script>
	$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
	});
	</script>
