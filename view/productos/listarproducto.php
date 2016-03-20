<?php 
 //file: view/tienda/listarproducto.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $productos = $view->getVariable("productos");
 $indice = $view->getVariable("indice");
 $categorias = $view->getVariable("categorias");

?>
<div class="row">
<div class="span3"><!-- start sidebar -->
	<ul class="breadcrumb">
	    <li>Categorias</span></li>
	</ul>
		<div class="span3 product_list">
			<ul class="nav">
				<?php foreach ($categorias as $cat){ ?>
				<li><a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=<?php echo $cat->getCategoria()?>"><?php echo $cat->getCategoria()?></a></li>
				<?php }?>
			</ul>
		</div><!-- end sidebar -->		
		</div>
		 <div class="span9"><!--indice -->
		    <ul class="breadcrumb">
				<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
				<li><a href="index.php?controller=producto&amp;action=listarProductos">Productos</a> <span class="divider">/</span></li>
				<li class="active"><a href="#"><?php echo $indice?></a> </li>
			
			</ul>
			
	
	 <div class="row">
	 <div class="span9"><!-- start producto -->
		<ul class="thumbnails">
		<?php foreach ($productos as $prod){ ?>
	        <li class="span3">
	          <div class="thumbnail">
	            <a href="index.php?controller=producto&amp;action=listarProductos&amp;id=<?php echo $prod->getId()?>"><img alt="foto producto" src= "<?php echo $prod->getFoto()?>" ></a>
	            <div class="caption">
	               <a href="index.php?controller=producto&amp;action=listarProductos&amp;id=<?php echo $prod->getId()?>"><h5><?php echo $prod->getNombre() ?></h5></a>
	            </div>
	          </div>
	        </li>
	        <?php } ?>				
      </ul>
	  </div><!-- end producto -->
		</div>
      </div>
    </div>