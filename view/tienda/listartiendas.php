<?php 
 //file: view/tienda/listartiendas.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $tiendas = $view->getVariable("tiendas");

?>

<div class="row">
<div class="span3"><!-- start sidebar -->
	<ul class="breadcrumb">
	    <li>Tiendas</span></li>
	</ul>
	<div class="span3 product_list">
		<ul class="nav">
		<?php foreach ($tiendas as $tienda){?>
			<li><a href="#"><?php echo $tienda->getNombre() ?></a></li>
		<?php } ?>
	</ul>
</div><!-- end sidebar -->
</div>
<div class="span9">
	<ul class="breadcrumb">
	    <li>
	    	<a href="index.php">Inicio</a> <span class="divider">/</span>
	    </li>
	    <li class="active">
	    	<a href="index.php?controller=tienda&action=listarTiendas">Tiendas</a> 
	    </li>
    </ul>
	
	<?php foreach ($tiendas as $tienda){?>
	 <div class="row"> 
	  
	  	<div class="span6">
		  <h2><?php echo $tienda->getNombre() ?></h2></a>
          <p><strong>Direccion:</strong> <?php echo $tienda->getDireccion() ?><br>
          <strong>Telefono:</strong> <?php echo $tienda->getTelefono() ?><br>
          <strong>Email:</strong> <?php echo $tienda->getEmail() ?></p>
		</div>	
		    
		<div class="span2 pull-right">
		   <a class="btn btn-primary btn-large" 
		   href="index.php?controller=producto&action=listarProductosTienda&id=<?php echo $tienda->getusNif()?>">Ver productos</a>
	  	</div>
  	</div>
  	<hr/>	  
  	<?php } ?>	
  

	  
	</div>

</div>