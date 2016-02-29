<?php 
 //file: view/tienda/listarproductos.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $productos = $view->getVariable("productos");
 $categorias = $view->getVariable("categorias");
 $indice = $view->getVariable("indice");

?>

<div class="row">
<div class="span3"><!-- start sidebar -->
	<ul class="breadcrumb">
	    <li>Categorias</span></li>
	</ul>
		<div class="span3 product_list">
			<ul class="nav">
				<?php foreach ($categorias as $cat){ ?>
				<li><a href="index.php?controller=producto&action=listarProductos&filtro=<?php echo $cat->getCategoria()?>"><?php echo $cat->getCategoria()?></a></li>
				<?php }?>
			</ul>
		</div><!-- end sidebar -->	
</div>
<div class="span9">
	<ul class="breadcrumb"> <!-- Start Indice -->
	    <li><a href="index.php">Inicio</a> <span class="divider">/</span></li>				
	    <li>
	    	<a href="index.php?controller=producto&action=listarProductos">Productos</a> <span class="divider">/</span>
    	</li>
		<li class="active">
	    	<a href="#"><?php echo $indice ?></a> 
	    </li>
    </ul><!-- End Indice -->
	
	<?php foreach ($productos as $prods){?>
	 <div class="row">
	 <div class="span1">
	  <a href="index.php?controller=producto&action=detallesProducto&id=<?php echo $prods->getId()?>"><img alt="imagen producto" id="tmp" src="<?php echo $prods->getFoto() ?>"></a>
	  </div>	 
	  
	  <div class="span6">
	   <a href="index.php?controller=producto&action=detallesProducto&id=<?php echo $prods->getId()?>"><h5><?php echo $prods->getNombre() ?></h5></a>
              <p><?php echo $prods->getDescripcion() ?></p>
	  </div>	

	  <div class="span1">
	   <p><?php echo $prods->getPrecio() ?>€</p>
	  </div>	 
	  
	  <div class="span2">
	   <p><a class="btn btn-primary" href="cart.html">Añadir al carrito</a></p>
	  </div>
  	</div>
  	<hr/>	  
  	<?php } ?>	
  

	  
	</div>

</div>