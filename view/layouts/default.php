<?php
 //file: view/layouts/default.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");
 
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Web Productos Ciclismo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Estilos -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!--<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">-->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/jquery.rating.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="container">
		<div class="row"><!-- start header -->
			<div class="span4 logo">
			<a href="index.php">
				<h1>Web Productos Ciclismo</h1>
			</a>
			</div>
			<div class="span8">
			
				<div class="row">
					<div class="links pull-right">
						<div class="span2">
							<a href="cart.html"><h4>Carrito</h4></a>
							<a href="cart.html">2 producto(s) - 30€</a>
						</div>

						<div class="span3 customer_service">
							<h4>Envio gratuito en pedidos superiores a 50 euros</h4>
							<h4><small>Atencion al cliente: 0800 8475 548</small></h4>
						</div>
					</div>	
				</div>
				<br />
				<div class="row">
					<div class="links pull-right">
						<a href="home.php">Inicio</a> |
						<a href="index.php?controller=usuario&amp;action=miCuenta">Mi Cuenta</a> |
						<a href="cart.html">Carrito de la compra</a> |
						<a href="two-column.html">Acerca de</a> |
						<a href="contact.html">Contacto</a>
					</div>
				
				</div>
			</div>
		</div><!-- end header -->
		
		<div class="row"><!-- start nav -->
			<div class="span12">
			  <div class="navbar">
					<div class="navbar-inner">
					  <div class="container" style="width: auto;">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						  <span class="icon-bar"></span>

						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</a>
						<div class="nav-collapse">
						  <ul class="nav">
							<li class="nav.header"></li>
							<li><a href="index.php?controller=tienda&action=listarTiendas">Tiendas</a></li>
							<li><a href="index.php?controller=producto&action=listarProductos&filtro=BMX">BMX</a></li>
							<li><a href="index.php?controller=producto&action=listarProductos&filtro=Carretera">Carretera</a></li>
							<li><a href="index.php?controller=producto&action=listarProductos&filtro=Fixed">Fixed</a></li>
							<li><a href="index.php?controller=producto&action=listarProductos&filtro=Montaña">Montaña</a></li>
							<li><a href="index.php?controller=producto&action=listarProductos&filtro=Ropa">Ropa y accesorios</a></li>
							<li><a href="index.php?controller=producto&action=listarProductos&filtro=Mecanica">Mecánica</a></li>
						  </ul>

						  <ul class="nav pull-right">
						   <li class="divider-vertical"></li>
							<form class="navbar-search" action="">
								<input type="text" class="search-query span2" placeholder="Buscar">
								<button class="btn btn-primary btn-small search_btn" type="submit">GO!</button>
							</form>
							
						  </ul>
						</div><!-- /.nav-collapse -->
					  </div>
					</div><!-- /navbar-inner -->
				</div><!-- /navbar -->
			</div>
		</div><!-- end nav -->	 

	<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>   <!-- fragment -->	

	<footer>
	<hr/>
	<div class="row well no_margin_left">

	<div class="span3">
		<h4>Informacion</h4>
		<ul>
			<li><a href="two-column.html">Sobre nosotros</a></li>
			<li><a href="typography.html">Informacion de envio</a></li>
			<li><a href="typography.html">Devoluciones</a></li>
			<li><a href="typography.html">Terminos y condiciones</li>
		</ul>
	</div>

	</div>
	
	

	</footer>

</div> <!-- /container -->

</body>
</html>

<script src="js/jquery.rating.pack.js"></script>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
  