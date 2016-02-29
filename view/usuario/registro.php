<?php 
 //file: view/usuario/registro.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $view->setVariable("title", "Registro");
 $errors = $view->getVariable("errors");

?>
<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li><a href="index.php?controller=usuario&amp;action=miCuenta">Cuenta</a> <span class="divider">/</span></li>
			<li class="active"><a href="index.php?controller=usuario&amp;action=registro">Registro</a></li>
		</ul>
		</div>

			<div class="span12">
				<h1>Crear una cuenta</h1>
				
				<br />				
				<form class="form-horizontal" id="formregistro" action="index.php?controller=usuario&amp;action=registro" method="POST">
					<fieldset>
						<div class="span6 no_margin_left">
							<legend>Detalles Personales</legend>
						  <div class="control-group">
							<label class="control-label">DNI</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="nif">
						  		<?= isset($errors["nif"])?$errors["nif"]:"" ?>
							</div>
						  </div>	
						  <div class="control-group">
							<label class="control-label">Nombre</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="nombre">
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label">Apellidos</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="apellidos">
							</div>
						  </div>					  
						  <div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="correo">
							  <?= isset($errors["email"])?$errors["email"]:"" ?>
							</div>
						  </div>					 

						  <div class="control-group">
							<label class="control-label">Telefono</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="telefono">
							</div>
						  </div>
						  </div>
						  <div class="span6">
						  <legend>Direccion de envio</legend>
						  <div class="control-group">
							<label class="control-label">Direccion completa (Calle, Ciudad, Pais)</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="direccion">
							</div>
						  </div>
						  	
						  <div class="control-group">
							<label class="control-label">Codigo Postal</label>
							<div class="controls docs-input-sizes">
							  <input type="text" placeholder="" class="span4" name="cp">
							</div>
						  </div>					 
						  </div>
						  
						<div class="span12 no_margin_left">
							<legend>Tus datos de acceso </legend>
							<div class="span6 no_margin_left">
							  <div class="control-group">
							  
								<label class="control-label">Nombre de Usuario</label>
								<div class="controls docs-input-sizes">
								  <input type="text" placeholder="" class="span4"name="username">
								  <?= isset($errors["username"])?$errors["username"]:"" ?>
								</div>
							  </div>					 
							  </div>					 
							<div class="span6">
							  <div class="control-group">
								<label class="control-label">Contraseña</label>
								<div class="controls docs-input-sizes">
								  <input type="password" placeholder="" class="span4" name="contra" id="contra">
								</div>
							  </div>					  <div class="control-group">
								<label class="control-label">Confirmar contraseña</label>
								<div class="controls docs-input-sizes">
								  <input type="password" placeholder="" class="span4" name= "contra2" id="contra2">
								</div>
							  </div>
							</div>
						</div>

						
						<div class=" span12 no_margin_left">
							<hr>
							<div class="span8">
								<input type="checkbox" value="option1" name="checkbox1"> He leido los terminos y condiciones.<br />
								
							 </div>
							 <div class="span3"><button class="btn btn-primary btn-large pull-right" type="submit">Registrarse</button></div>
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
	
	$("#formregistro").validate({
    rules: {
      nif: {
        required: true,
        nif:true
      },
      nombre: {
        required: true,
        letras_espacios: true,
        maxlength:20
      },
      apellidos: {
        required: true,
        letras_espacios: true,
        maxlength:20
      },
      correo: {
        required: true,
    	email: true
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
      cp: {
        required:true,
        digits: true,
    	minlength: 5,
    	maxlength: 5
      },
      username: {
        alphanumeric: true,
        required: true,
        minlength: 5,
    	maxlength: 20
      },
      contra: {
        required: true,
        minlength: 6,
    	maxlength: 30
      },
      contra2: {
      	required: true,
        minlength: 6,
    	maxlength: 30,
    	equalTo: "#contra"
      },
      checkbox1: {
      	required: true
      }



    },


    messages: {
      
      nif: {
        required: "Campo vacío"
      },
      nombre: {
        required: "Campo vacío",
        letras_espacios: "El nombre solo puede contener letras",
        maxlength:"El nombre es muy largo"
      },
      apellidos: {
        required: "Campo vacío",
        letras_espacios: "Los apellidos solo pueden contener letras",
        maxlength:"Los apellidos son muy largos"
      },
      correo: {
        required: "Campo vacío",
    	email: "Email no valido",
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
      cp: {
        required: "Campo vacío",
        digits: "Codigo postal no válido",
    	minlength: "Codigo postal no válido",
    	maxlength: "Codigo postal no válido"
      },
      username: {
        alphanumeric: "El nombre de usuario no puede contrener caracteres especiales",
        required: "Campo vacío",
        minlength: "El usuario debe tener entre 5 y 30 caracteres",
    	maxlength: "El usuario debe tener entre 5 y 30 caracteres"
      },
      contra: {
        required: "Campo vacío",
        minlength: "La contraseña debe tener entre 6 y 30 caracteres",
    	maxlength: "La contraseña debe tener entre 6 y 30 caracteres"
      },
      contra2: {
      	required: "Campo vacío",
        minlength: "La contraseña debe tener entre 6 y 30 caracteres",
    	maxlength: "La contraseña debe tener entre 6 y 30 caracteres",
    	equalTo: "Las contraseñas no coinciden"
      },
      checkbox1: {
      	required: "Debes aceptar los terminos y condiciones"
      }
      
    }
  });
</script>
