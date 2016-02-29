<?php 
 //file: view/usuario/registro.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $view->setVariable("title", "AltaTienda");
 $errors = $view->getVariable("errors");

?>
<div class="row">

	<div class="span12"><!-- Ruta-->
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li><a href="index.php?controller=usuario&amp;action=miCuenta">Mi Cuenta</a> <span class="divider">/</span></li>
			<li><a href="index.php?controller=tienda&amp;action=miTienda">Mi Tienda</a></li><span class="divider">/</span></li>
			<li class="active"><a href="index.php?controller=tienda&amp;action=altaTienda">Alta Tienda</a></li>
		</ul>
	</div>

			<div class="span12">
				<h1>Dar de alta una tienda</h1>
				
				<br />				
				<form class="form-horizontal" id="formalta" action="index.php?controller=tienda&amp;action=altaTienda" method="POST">
					<fieldset>
						<div class="span6 no_margin_left">
							<legend>Detalles tienda</legend>
						  <div class="control-group">
							<label class="control-label">Nombre</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="nombre">
							</div>
						  </div>	
						  <div class="control-group">
							<label class="control-label">Direccion</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="direccion">
							</div>
						  </div>
						   <div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="correo">
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label">Telefono</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="telefono">
							</div>
						  </div>
						 					  
							
						</div>

						
						<div class=" span12 no_margin_left">
							<hr>
							<div class="span8">
								<input type="checkbox" value="option1" name="checkbox1"> He leido los terminos y condiciones.<br />
								
							 </div>
							 <div class="span3"><button class="btn btn-primary btn-large pull-right" type="submit">Alta tienda</button></div>
							 <hr>
		          		</div>
	          		</fieldset>
				  </form>
	  
			</div>
		
		<hr/>


	
</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/additional-methods.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.rating.pack.js"></script>

<script>
	
	$("#formalta").validate({
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
      },
      checkbox1: {
      	required: true
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
      },
      checkbox1: {
      	required: "Debes aceptar los terminos y condiciones"
      }
      
    }
  });
</script>