<?php
 //file: view/productos/componentelistacategorias.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");
 
?>
<div class="custom-collapse">
	<div class="breadcrumb collapse-toggle visible-xs" type="button" data-toggle="collapse" 
		data-parent="custom-collapse" data-target="#side-menu-collapse">
	    <span><li>Categorias</li></span>
	</div>
	<ul class="list-group collapse product_list" id="side-menu-collapse">
	  <ul>
	    <?php foreach ($categorias as $cat){ ?>
	    <li class="list-group-item dropdown-toggle">
	    <a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=<?php echo $cat->getCategoria()?>">
	    <?php echo $cat->getCategoria()?></a>
	    </li>
	    <?php }?>
	  </ul>
	</ul>
</div>