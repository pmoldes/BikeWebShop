<?php 
 //file: view/tienda/misproductos.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $productos = $view->getVariable("productos");

?>

<div class="row">
	<div class="span12">
		<ul class="breadcrumb"> <!-- Start Indice -->
		    <li><a href="index.php">Inicio</a> <span class="divider">/</span></li>				
		    <li>
		    	<a href="index.php?controller=usuario&amp;action=micuenta">Mi Cuenta</a> <span class="divider">/</span>
	    	</li>
			<li class="active">
		    	<a href="#">Mis productos</a> 
		    </li>
	    </ul><!-- End Indice -->
		
		<?php foreach ($productos as $prods){?>
		 <div class="row">
		 <div class="span1">
		  <a href="index.php?controller=producto&amp;action=detallesProducto&amp;id=<?php echo $prods->getId()?>"><img alt="imagen producto" id="tmp" src="<?php echo $prods->getFoto() ?>"></a>
		  </div>	 
		  
		  <div class="span6">
		   <a href="index.php?controller=producto&amp;action=detallesProducto&amp;id=<?php echo $prods->getId()?>"><h5><?php echo $prods->getNombre() ?></h5></a>
	              <p><?php echo $prods->getDescripcion() ?></p>
		  </div>	

		  <div class="span1">
		   <p>Precio: <?php echo $prods->getPrecio() ?>€</p>
		  </div>	 
		  
		  <div class="span2 pull-right btn-group">
		   	<div><a class="btn btn-primary" href="index.php?controller=producto&amp;action=modificarProducto&amp;id=<?php echo $prods->getId() ?>">Modificar</a></div>
		   	<div><a class="btn btn-danger" onclick="javascript:return confirmar();"  href="index.php?controller=producto&amp;action=bajaProducto&amp;id=<?php echo $prods->getId()?>">Eliminar</a></div>
		  </div>

	  	</div>
	  	<hr/>	  
	  	<?php } ?>	
	  	<div class="span2">
	  		<a class="btn btn-primary" href="index.php?controller=producto&amp;action=altaProducto">Añadir Producto</a>
	  	</div>
	</div>
</div>

<script>

function confirmar ()
		  {
		      rc = confirm("¿Seguro que desea eliminar este producto?");
		      return rc;
		  }
</script>