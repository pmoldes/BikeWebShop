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
    <title>BikeWebShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Estilos -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
		<div class="row header"><!-- start header -->
			<div class="span4">
				<a href="index.php">
					<img class="img-responsive" src="css/images/logo.png">
				</a>
			</div>
			<div class="span8">
				<!-- <div class="row">
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
				</div> -->
				<div class="links pull-right">
					<a href="index.php">Inicio</a> |
					<a href="index.php?controller=usuario&amp;action=miCuenta">Mi Cuenta</a> |
					<a href="index.php?controller=producto&amp;action=verCarrito">Carrito</a> |
					<a href="index.php?controller=usuario&amp;action=about">Acerca de</a> |
					<a href="index.php?controller=usuario&amp;action=about">Contacto</a>
				</div>
			</div>
		</div><!-- end header -->
		
		<div class="row"><!-- start nav -->
		<div class="span12">
		  <div class="navbar">
			<div class="navbar-inner">
			  <div class="container main-container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</a>
				<div class="nav-collapse">
				  <ul class="nav">
					<li class="nav.header"></li>
					<li><a href="index.php?controller=tienda&amp;action=listarTiendas">Tiendas</a></li>
					<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=BMX">BMX</a></li>
					<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=Carretera">Carretera</a></li>
					<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=Fixed">Fixed</a></li>
					<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=Montaña">Montaña</a></li>
					<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=Ropa">Ropa y accesorios</a></li>
					<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=Mecanica">Mecánica</a></li>
				  </ul>
				  <ul class="nav pull-right">
				   <li class="divider-vertical"></li>
					<form id="searchForm" class="navbar-search"  method="POST" action="index.php?controller=producto&amp;action=buscarProductos">
						<fieldset>
						<input name="filtro" type="text" class="search-query span2" placeholder="Buscar">
						<button class="btn btn-primary btn-small search_btn" type="submit">GO!</button>
						</fieldset>
					</form>
				  </ul>
				</div><!-- /.nav-collapse -->
			  </div>
			</div><!-- /navbar-inner -->
			</div><!-- /navbar -->
		</div>
		</div><!-- end nav -->	 

	<!--Mensajes-->
	<?php if(isset($_SESSION["viewmanager__flasharray__"]["__flashmessage__"])){ ?>
		<div class="alert alert-success" id="success-alert">
			<?= $view->popFlash() ?>
	    </div>
    <?php } ?>
	<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>   <!-- fragment -->	
	<footer>
		<hr/>
		<div class="row well no_margin_left">
			<div class="">
				<h4>Informacion</h4>
				<ul>
					<li><a href="index.php?controller=usuario&amp;action=about">Sobre nosotros</a></li>
					<li><a href="index.php?controller=usuario&amp;action=about">Informacion de envio</a></li>
					<li><a href="index.php?controller=usuario&amp;action=about">Devoluciones</a></li>
					<li><a href="index.php?controller=usuario&amp;action=about">Terminos y condiciones</li>
				</ul>
			</div>
		</div>
	</footer>

</div> <!-- /container -->

</body>
</html>

<script src="js/jquery-1.12.3.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">
	$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
	});
</script>
  