<?php 
 //file: view/productos/altaproducto.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");

?>
<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
      <li><a href="index.php?controller=usuario&amp;action=miCuenta">Mi cuenta</a> <span class="divider">/</span></li>
      <li><a href="index.php?controller=producto&amp;action=listarMisProductos">Mis Productos</a> <span class="divider">/</span></li>
			<li class="active"><a href="#">Añadir producto</a></li>
		</ul>
	</div>

			<div class="span12">
				<h1>Añadir un producto</h1>
				
				<br/>
				<!-- Inicio del formulario-->		


				<form enctype="multipart/form-data" class="form-horizontal" id="formproducto" action="index.php?controller=producto&amp;action=altaProducto" method="POST">
					<fieldset>
          <h2>Datos producto</h2><hr> 
						<div class="span6 no_margin_left">
						  <div class="control-group">
  							<label class="control-label">Nombre</label>
  							<div class="controls docs-input-sizes">
  							  <input type="text" class="span4" name="producto_nombre">
  							</div>
						  </div>
						  <div class="control-group">
  							<label class="control-label">Modalidad</label>
  							<div class="controls docs-input-sizes">
                  <select class="span4" name="producto_modalidad">
                    <option value="BMX">BMX</option>
                    <option value="Carretera">Carretera</option>
                    <option value="Fixed">Fixed</option>
                    <option value="Montaña">Montaña</option>
                    <option value="Ropa">Ropa y accesorios</option>
                    <option value="Mecanica">Mecánica</option>
                  </select>
  							</div>
						  </div>
						  <div class="control-group">
  							<label class="control-label">Categoria</label>
  							<div class="controls docs-input-sizes">
  							  <select class="span4" name="producto_categoria">
                    <option value="Bicicletas">Bicicletas</option>
                    <option value="Bielas">Bielas</option>
                    <option value="Cadenas">Cadenas</option>
                    <option value="Camisetas">Camisetas</option>
                    <option value="Calzado">Calzado</option>
                    <option value="Camisetas">Cascos</option>
                    <option value="Cuadros">Cuadros</option>
                    <option value="Cubiertas">Cubiertas</option>
                    <option value="Frenos">Frenos y accesorios</option>
                    <option value="Herramientas">Herramientas</option>
                    <option value="Horquillas">Horquillas</option>
                    <option value="Manillar">Manillar</option>
                    <option value="Pedales">Pantalones</option>
                    <option value="Pedales">Pedales</option>
                    <option value="Platos">Platos</option>
                    <option value="Potencias">Potencias</option>
                    <option value="Pedales">Protecciones</option>
                    <option value="Puños">Puños</option>
                    <option value="Ruedas">Ruedas</option>
                    <option value="Sillines">Sillines</option>
                    <option value="Tijas">Tijas</option>
                    <option value="Otros">Otros</option>
                  </select>
  							</div>
						  </div>					  			 

						  <div class="control-group">
  							<label class="control-label">Descripción</label>
  							<div class="controls docs-input-sizes">
  							  <textarea class="span4"rows="4" cols="50" name="producto_descripcion"></textarea>
                </div>
						  </div>

						</div> <!--Fin primera columna -->
					  <div class="span6">
						  <div class="control-group">
							<label class="control-label">Precio</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value="" class="span4" name="producto_precio">
							</div>
						  </div>
						  	
						  <div class="control-group">
  							<label class="control-label">Cantidad</label>
  							<div class="controls docs-input-sizes">
  							  <input type="text" value="" class="span4" name="producto_cantidad">
  							</div>
						  </div>
              
              <div class="control-group">
                <label class="control-label">Estado</label>
                <div class="controls docs-input-sizes">
                  <select class="span4" name="producto_nuevo">
                    <option value="0">Usado</option>
                    <option value="1">Nuevo</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Foto</label>
                <div class="controls docs-input-sizes">
                  <input type="file" value="" class="span4" name="producto_foto">
                </div>
              </div>
              <?php if (isset($errors)){?>
                <div class="span4 alert alert-danger pull-right" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  <?= isset($errors)?$errors:"" ?>                
                </div>
              <?php } ?>			 
					  </div>
						  
						<div class=" span12 ">
							<hr>
							 <div class="span3"><button class="btn btn-primary btn-large pull-right" type="submit">Añadir producto</button></div>
		          		</div>
	          		</fieldset>
				  </form>
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
<script src="js/jquery.rating.pack.js"></script>

<script>


	$("#formproducto").validate({
    rules: {
      producto_nombre: {
        required: true,
        maxlength:50
      },
      producto_descripcion: {
        required: true,
        maxlength:500
      },
      producto_precio: {
        required: true,
    	  number: true
      },
      producto_cantidad: {
        required: true,
        digits: true
      }

    },


    messages: {
      
      producto_nombre: {
        required: "Campo vacío",
        maxlength:"El nombre es muy largo"
      },
      producto_descripcion: {
        required: "Campo vacío",
        maxlength:"La descricion es muy larga"
      },
      producto_precio: {
        required: "Campo vacío",
        number:"El precio solo puede ser un numero con separador ."
      },
      producto_cantidad: {
        required: "Campo vacío",
    	  digits: "La cantidad solo puede contener digitos"
      }
      
    }
  });
</script>
