<?php 
 //file: view/productos/modificarproducto.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $producto = $view->getVariable("producto");

?>
<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
			<li><a href="index.php?controller=usuario&amp;action=miCuenta">Mi cuenta</a> <span class="divider">/</span></li>
      <li><a href="index.php?controller=producto&amp;action=listarmisproductos">Mis productos</a> <span class="divider">/</span></li>

			<li class="active"><a href="#">Modificar producto</a></li>
		</ul>
	</div>

			<div class="span12">
				<h1>Añadir un producto</h1>
				
				<br/>
				<!-- Inicio del formulario-->		


				<form class="form-horizontal" id="formproducto" action="index.php?controller=producto&amp;action=modificarProducto" method="POST">
					<fieldset>
          <h2>Datos producto</h2><hr> 
            <input type="hidden" name="producto_id" value="<?php echo $producto[0]->getId()?>">
						<div class="span6 no_margin_left">
						  <div class="control-group">
  							<label class="control-label">Nombre</label>
  							<div class="controls docs-input-sizes">
  							  <input type="text" value = "<?php echo $producto[0]->getNombre()?>" class="span4"  name="producto_nombre">
  							</div>
						  </div>
						  <div class="control-group">
  							<label class="control-label">Modalidad</label>
  							<div class="controls docs-input-sizes">
                  <select value = "Fixed" class="span4" name="producto_modalidad">
                    <option <?php 
                            if($producto[0]->getModalidad() == 'BMX')
                              {echo("selected='selected'");}
                            ?> 
                            value="BMX">BMX
                    </option>
                    <option 
                            <?php if($producto[0]->getModalidad() == 'Carretera')
                            {echo("selected='selected'");}?>
                            value="Carretera">Carretera
                    </option>
                    <option <?php if($producto[0]->getModalidad() == 'Fixed')
                            {echo("selected='selected'");}?>
                            value="Fixed">Fixed</option>
                    <option <?php if($producto[0]->getModalidad() == 'Montaña')
                            {echo("selected='selected'");}?>
                            value="Montaña">Montaña</option>
                    <option <?php if($producto[0]->getModalidad() == 'Ropa'){echo("selected='selected'");}?>value="Ropa">Ropa y accesorios</option>
                    <option <?php if($producto[0]->getModalidad() == 'Mecanica'){echo("selected='selected'");}?>value="Mecanica">Mecánica</option>
                  </select>
  							</div>
						  </div>
						  <div class="control-group">
  							<label class="control-label">Categoria</label>
  							<div class="controls docs-input-sizes">
  							  <select class="span4" name="producto_categoria">
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Bicicletas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Bicicletas">Bicicletas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Bielas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Bielas">Bielas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Bujes')
                              {echo("selected='selected'");}
                            ?> 
                            value="Bujes">Bujes</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Cadenas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Cadenas">Cadenas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Camisetas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Camisetas">Camisetas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Calzado')
                              {echo("selected='selected'");}
                            ?> 
                            value="Calzado">Calzado</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Cascos')
                              {echo("selected='selected'");}
                            ?> 
                            value="Camisetas">Cascos</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Cuadros')
                              {echo("selected='selected'");}
                            ?> 
                            value="Cuadros">Cuadros</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Cubiertas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Cubiertas">Cubiertas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Frenos')
                              {echo("selected='selected'");}
                            ?> 
                            value="Frenos">Frenos y accesorios</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Herramientas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Herramientas">Herramientas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Horquillas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Horquillas">Horquillas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Manillar')
                              {echo("selected='selected'");}
                            ?> 
                            value="Manillar">Manillar</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Pantalones')
                              {echo("selected='selected'");}
                            ?> 
                            value="Pantalones">Pantalones</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Pedales')
                              {echo("selected='selected'");}
                            ?> 
                            value="Pedales">Pedales</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Platos')
                              {echo("selected='selected'");}
                            ?> 
                            value="Platos">Platos</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Potencias')
                              {echo("selected='selected'");}
                            ?> 
                            value="Potencias">Potencias</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Protecciones')
                              {echo("selected='selected'");}
                            ?> 
                            value="Protecciones">Protecciones</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Puños')
                              {echo("selected='selected'");}
                            ?> 
                            value="Puños">Puños</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Ruedas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Ruedas">Ruedas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Sillines')
                              {echo("selected='selected'");}
                            ?> 
                            value="Sillines">Sillines</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Tijas')
                              {echo("selected='selected'");}
                            ?> 
                            value="Tijas">Tijas</option>
                    <option <?php 
                            if($producto[0]->getCategoria() == 'Otros')
                              {echo("selected='selected'");}
                            ?> 
                            value="Otros">Otros</option>
                  </select>
  							</div>
						  </div>					  			 

						  <div class="control-group">
  							<label class="control-label">Descripción</label>
  							<div class="controls docs-input-sizes">
  							  <textarea class="span4"rows="4" cols="50" name="producto_descripcion"><?php echo $producto[0]->getDescripcion() ?></textarea>
                </div>
						  </div>
						</div> <!--Fin primera columna -->
					  <div class="span6">
						  <div class="control-group">
							<label class="control-label">Precio</label>
							<div class="controls docs-input-sizes">
							  <input type="text" value = "<?php echo $producto[0]->getPrecio()?>" class="span4" name="producto_precio">
							</div>
						  </div>
						  	
						  <div class="control-group">
  							<label class="control-label">Cantidad</label>
  							<div class="controls docs-input-sizes">
  							  <input type="text" value = "<?php echo $producto[0]->getCantidad() ?>" class="span4" name="producto_cantidad">
  							</div>
						  </div>
              
              <div class="control-group">
                <label class="control-label">Estado</label>
                <div class="controls docs-input-sizes">
                  <select class="span4" name="producto_nuevo">
                    <option <?php 
                            if($producto[0]->getNuevo() == '0')
                              {echo("selected='selected'");}
                            ?>  value="0">Usado</option>
                    <option <?php 
                            if($producto[0]->getNuevo() == '1')
                              {echo("selected='selected'");}
                            ?>  value="1">Nuevo</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Foto</label>
                <div class="controls docs-input-sizes">
                  <input type="text" value="<?php echo $producto[0]->getFoto() ?>" class="span4" name="producto_foto">
                </div>
              </div>  					 
					  </div>
						  
						<div class=" span12 ">
							<hr>
							 <div class="span3"><button class="btn btn-primary btn-large pull-right" type="submit">Modificar producto</button></div>
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
    	  digits: true
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
        digits:"El precio solo puede contener digitos"
      },
      producto_cantidad: {
        required: "Campo vacío",
    	  digits: "La cantidad solo puede contener digitos"
      }
      
    }
  });
</script>
