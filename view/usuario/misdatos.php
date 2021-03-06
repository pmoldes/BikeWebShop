<?php 
 //file: view/usuario/misdatos.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $usuarios = $view->getVariable("us_datos");

?>
<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li><a href="index.php?controller=usuario&amp;action=miCuenta">Cuenta</a> <span class="divider">/</span></li>
			<li class="active"><a href="index.php?controller=usuario&amp;action=consultarUsuario">Mis Datos</a></li>
		</ul>
	</div>

			<div class="span12">
				<h1>Modificar mis datos</h1>
				
				<br/>
				<!-- Inicio del formulario-->		

				<?php foreach ($usuarios as $usuario){ ?>

				<form class="form-horizontal" id="formmodificar" action="index.php?controller=usuario&amp;action=modificarUsuario" method="POST">
					<fieldset>
						<div class="span6 no_margin_left">
							<legend>Detalles Personales</legend>
						  <div class="control-group">
							<label class="control-label">Nombre</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="<?php echo $usuario->getNombre() ?>" class="span4" name="nombre">
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label">Apellidos</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="<?php echo $usuario->getApellidos() ?>" class="span4" name="apellidos">
							</div>
						  </div>					  
						  <div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="<?php echo $usuario->getEmail() ?>" class="span4" name="correo">
							  <?= isset($errors["email"])?$errors["email"]:"" ?>
							</div>
						  </div>					 

						  <div class="control-group">
							<label class="control-label">Telefono</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="<?php echo $usuario->getTelefono() ?>" class="span4" name="telefono">
							</div>
						  </div>
						  </div>
						  <div class="span6">
						  <legend>Direccion de envio</legend>
						  <div class="control-group">
							<label class="control-label">Direccion completa (Calle, Ciudad, Pais)</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="<?php echo $usuario->getDireccion() ?>" class="span4" name="direccion">
							</div>
						  </div>
						  	
						  <div class="control-group">
							<label class="control-label">Codigo Postal</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="<?php echo $usuario->getCp() ?>" class="span4" name="cp">
							</div>
						  </div>					 
						  </div>
						  
						<div class="span12 no_margin_left">
							<legend>Tus datos de acceso </legend>
							<div class="span6 no_margin_left">
							  <div class="control-group">
							  
								<label class="control-label">Nombre de Usuario</label>
								<div class="controls docs-input-sizes">
								  <input type="text" value="<?php echo $usuario->getUsername() ?>" class="span4"name="username">
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
						<div class=" span12 ">
							<hr>
							 <div class="span3"><button class="btn btn-primary btn-large pull-right" type="submit">Modificar Datos</button></div>
		          		</div>
	          		</fieldset>
				  </form>
				  <?php } ?>
				  <!--Fin del formulario -->
	  
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

<script>
	$("#formmodificar").validate({
    rules: {
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
