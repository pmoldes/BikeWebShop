<?php
 //file: view/productos/componentelistacategorias.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");
 
?>
<div class="custom-collapse">
	<div class="breadcrumb categorias collapse-toggle" type="button" data-toggle="collapse" 
		data-parent="custom-collapse" data-target="#side-menu-collapse">
	    <span><li>Categorias</li></span>
	</div>
	<ul class="list-group collapse in product_list .hidden-phone" id="side-menu-collapse">
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

<script type="text/javascript">
	$(window).bind('resize load', function() {
	    if ($(this).width() < 767) {
	        $('#side-menu-collapse').removeClass('in');
	        $('#side-menu-collapse').addClass('out');
	    } else {
	        $('#side-menu-collapse').removeClass('out');
	        $('#side-menu-collapse').addClass('in');
	    }
	});
</script>