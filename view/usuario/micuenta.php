<?php 
 //file: view/usuario/micuenta.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $view->setVariable("title", "micuenta");
 $errors = $view->getVariable("errors");

?>

<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li class="active"><a href="index.php?controller=usuario&amp;action=miCuenta">Mi Cuenta</a> <span class="divider">/</span></li>
			
		</ul>

		<div class="row">
			<div class="span9">
				<h1>Bienvenido</h1>
			</div>
		</div>
		
		<hr />

		<div class="row">

			<div class="span5 well">
				<h2>Añadir un producto</h2>
				<p>Añade un producto que estés interesado en vender</p><br />
				<a href="index.php?controller=producto&amp;action=altaproducto" class="btn btn-primary pull-right">Añadir producto</a>
			</div>

			<div class="span5 well pull-right">
				<h2>Consultar mis productos</h2>
				<p>Consulta los productos que tienes a la venta</p><br />
				<a href="index.php?controller=producto&amp;action=listarMisProductos" class="btn btn-primary pull-right">Consultar productos</a>
			</div>	 		 		

		</div>

		<div class="row">

			<div class="span5 well">
				<h2>Consultar mis Datos</h2>
				<p>Consulta o modifica los datos de tu cuenta</p>
				<a href="index.php?controller=usuario&amp;action=consultarUsuario" class="btn btn-primary pull-right">Mis datos</a>
			</div>

			<div class="span5 well pull-right">
				<h2>Consultar mis intereses</h2>
				<p>Consulta los productos en los que has mostrado interés</p>
				<a href="#" class="btn btn-primary pull-right">Consultar productos</a>
			</div>

		</div>

		<div class="row">

			<div class="span5 well">
				<h2>Darse de baja</h2>
				<p>Dar de baja tu cuenta de usuario</p>
				<a href="index.php?controller=usuario&amp;action=bajaUsuario" onclick="javascript:return confirmar();" class="btn btn-danger pull-right">Baja Cuenta</a>
			</div>

			<div class="span5 well pull-right">
				<h2>Cerrar sesión</h2>
				<p>Cierra tu sesion de usuario</p>
				<a href="index.php?controller=usuario&amp;action=logout" class="btn btn-primary pull-right">Salir</a>
			</div>

		</div>

		
	</div>

</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.rating.pack.js"></script>

<script>

function confirmar ()
		  {
		      rc = confirm("¿Seguro que desea Dar de baja su cuenta?");
		      return rc;
		  }
</script>
