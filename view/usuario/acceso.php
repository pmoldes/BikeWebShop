<?php 
 //file: view/usuario/acceso.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $view->setVariable("title", "acceso");
 $errors = $view->getVariable("errors");

?>



<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li><a href="#">Cuenta</a> <span class="divider">/</span></li>
			<li class="active"><a href="#">Acceso</a></li>
		</ul>

		<div class="row">
			<div class="span9">
				<h1>Acceso a la cuenta</h1>
			</div>
		</div>
		
		<hr />

		<div class="row">

			<div class="span5 well">
				<h2>Nuevo Cliente</h2>
				<p>Creando una cuenta en nuestra tienda podras realizar compras, comentar los productos y llevar un registro de tus compras.</p><br />
				<a href="index.php?controller=usuario&amp;action=registro" class="btn btn-primary pull-right">Crear una cuenta</a>
			</div>	 		
			
			<div class="span5 well pull-right">
				<h2>Usuario Registrado</h2>
				<p>Si tienes una cuenta con nosotros simplemente inicia sesión</p>
				
				<form class="login" id="loginform" action="index.php?controller=usuario&amp;action=acceso" method="POST" novalidate>
					<fieldset>
						<div class="control-group">
							<label for="focusedInput" class="control-label">email</label>
							<div class="controls">
							<input type="text" placeholder="Introduce tu email" class="input-xlarge focused" id="correo" name="correo">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Contraseña</label>
							<div class="controls">
							<input type="password" placeholder="Introduce tu contraseña" class="input-xlarge" id="contra" name="contra">
							</div>
						</div>
					</fieldset>
					<?= isset($errors["general"])?$errors["general"]:"" ?>
					<input class="btn btn-primary pull-right" type="submit" value="Acceso">
				</form>
				
			</div>

		</div>
	</div>

</div>


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.rating.pack.js"></script>

<script>
$(document).ready(function() {  
    $("#loginform").validate({  
            rules: {  
                correo:  {required: true, email: true },  
                contra:    {required: true, minlength: 6, maxlength: 35}
            },  
        messages: {  
            correo:   {  
                required: "Campo requerido: Email",  
                email:   "Formato de email no valido"
            },  
            contra:       {  
                required:  "Campo requerido: Contraseña",  
                minlength: "Contraseña debe de tener minimo 6 caracteres",
                maxlength: "Contraseña debe de tener maximo 35 caracteres",
            }
        },

    });  
    
});  
</script>
