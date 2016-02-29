<?php 
 //file: view/usuario/micuenta.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $view->setVariable("title", "micuenta");
 $errors = $view->getVariable("errors");
 $tiendas = $view->getVariable("ti_datos");

?>
<div class="row">

	

	<div class="span12"><!-- Ruta-->
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li><a href="index.php?controller=usuario&amp;action=miCuenta">Mi Cuenta</a> <span class="divider">/</span></li>
			<li class="active"><a href="index.php?controller=tienda&amp;action=miTienda">Mi Tienda</a></li>
		</ul>
	</div>
		<div class="span12">
			<h1>Gestión de tienda</h1>
			
			<br/>

			<!-- Inicio del formulario-->		

			<?php foreach ($tiendas as $tienda){ ?>

			<form class="form-horizontal" id="form_modificar" action="index.php?controller=tienda&amp;action=modificarTienda" method="POST">
				<fieldset>
					<div class="span6 no_margin_left">
					  <legend>Detalles Tienda</legend>	
					  <div class="control-group">
						<label class="control-label">Nombre</label>
						<div class="controls docs-input-sizes">
						  <input type="text" value="<?php echo $tienda->getNombre() ?>" class="span4" name="nombre">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">Direccion completa (Calle, Ciudad, Pais)</label>
						<div class="controls docs-input-sizes">
						  <input type="text" value="<?php echo $tienda->getDireccion() ?>" class="span4" name="direccion">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">Email</label>
						<div class="controls docs-input-sizes">
						  <input type="text" value="<?php echo $tienda->getEmail() ?>" class="span4" name="correo">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">Telefono</label>
						<div class="controls docs-input-sizes">
						  <input type="text" value="<?php echo $tienda->getTelefono() ?>" class="span4" name="telefono">
						</div>
					  </div>
					  
					 </div>
					
					<div class=" span12 ">
						<hr>
						 <div class="span3"><button class="btn btn-primary btn-large pull-right" type="submit">Modificar Datos</button></div>
						 <div class="span3"><a href="index.php?controller=tienda&amp;action=bajaTienda" onclick="javascript:return confirmar();" class="btn btn-danger btn-large pull-right">Baja Tienda</a></div>
	          		</div>
          		</fieldset>
			  </form>
			  <?php } ?>
			  <!--Fin del formulario -->
		  

	</div>

</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.rating.pack.js"></script>

<script>

function confirmar ()
		  {
		      rc = confirm("¿Seguro que desea dar de baja su tienda?");
		      return rc;
		  }

$("#form_modificar").validate({
    rules: {
      
      nombre: {
        required: true,
        maxlength:45
      },
      
      telefono: {
        required: true,
        digits: true,
        minlength: 9,
    	maxlength: 9
      },
      direccion: {
        required: true,
    	maxlength: 100
      },
      correo: {
        required: true,
    	email: true
      }

    },


    messages: {
      
      
      nombre: {
        required: "Campo vacío",
        maxlength:"El nombre es muy largo"
      },
      
      telefono: {
        required: "Campo vacío",
        digits: "Telefono no valido (111222333)",
        minlength: "Telefono no valido (111222333)",
    	maxlength: "Telefono no valido (111222333)"
      },
      direccion: {
        required: "Campo vacío",
    	maxlength: "Direccion demasiado larga"
      },
      correo: {
        required: "Campo vacío",
    	email: "Email no valido",
      }
      
    }
  }); 
</script>
