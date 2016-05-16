<?php 
 //file: view/tienda/misproductos.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $intereses = $view->getVariable("intereses");

?>

<div class="row">

	<div class="span12">
		<ul class="breadcrumb"> <!-- Start Indice -->
		    <li><a href="index.php">Inicio</a> <span class="divider">/</span></li>				
		    <li>
		    	<a href="index.php?controller=usuario&amp;action=micuenta">Mi Cuenta</a> <span class="divider">/</span>
	    	</li>
			<li class="active">
		    	<a href="#">Mis intereses</a> 
		    </li>
	  </ul><!-- End Indice -->
		<?php if (empty($intereses)){ ?>
						<div class="row row-centered">
							<h4>No tienes ningun interés de este tipo</h4>
						</div>
		<?php }else {?>
				<div class="row span11 text-center">
					<?php foreach ($intereses as $interes){?>
						<?php $productoRel = $interes->getProducto()?>
						<?php $usuarioRel = $interes->getVendedorComprador()?>
					 	<div class="row text-center">
						 	<div class="span1">
						  	<a href="index.php?controller=producto&amp;action=detallesProducto&amp;id=<?php echo $interes->getProductoID()?>"><img alt="imagen producto" src="<?php echo $productoRel->getFoto() ?>"></a>
						  	</div>	 
						  
						  <div class="span6">
						   <a href="index.php?controller=producto&amp;action=detallesProducto&amp;id=<?php echo $productoRel->getId()?>"><h3><?php echo $productoRel->getNombre() ?></h3></a>
					     	<p><span class="right5 glyphicon glyphicon-envelope"></span><a href="mailto:<?php echo $usuarioRel->getEmail() ?>"><?php echo $usuarioRel->getEmail() ?></a></p>
					     	<p><span class="right5 glyphicon glyphicon-earphone"></span><a href="tel:<?php echo $usuarioRel->getTelefono() ?>"><?php echo $usuarioRel->getTelefono() ?></a></p>
						  </div>	

						  <div class="span1">
						   <p><b>Precio:</b> <?php echo $interes->getPrecio() ?>€</p>
						  </div>	 
						  
						  <div class="span3">
						  	<div class="row">
						   		<a class="btn btn-danger pull-right" onclick="javascript:return confirmar();"  href="index.php?controller=interes&amp;action=eliminarInteres&amp;int=<?php echo $interes->getId() ?>">Eliminar</a>
						  	</div>
						  </div>
				  	</div>
				  	<hr/>	  
				  <?php } ?>	<!-- Fin foreach -->
				</div>
		<?php } ?>	<!-- Fin else -->
	  	
	</div>
</div>

<script>

function confirmar ()
		  {
		      rc = confirm("¿Seguro que desea eliminar este interes?");
		      return rc;
		  }
</script>