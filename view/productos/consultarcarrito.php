<?php 
 //file: view/tienda/consultarcarrito.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $productos = $view->getVariable("productos");
 $categorias = $view->getVariable("categorias");
 $indice = $view->getVariable("indice");

?>

<div class="row">
<div class="span12">
	<h1>Carrito</h1><br/>
	<?php if(empty($productos)){ ?>
	<div class="row row-centered">
		<h4>Su carrito esta vacío</h4>
	</div>
	<?php }else {?>
        <table class="table table-bordered table-striped">
		  <thead>
			  <tr>
				<th>Imagen</th>
				<th>Nombre de producto</th>
				<th>Precio</th>
				<th>Eliminar</th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($productos as $prod){?>
				<tr>
					<td class="muted horizontal-center_text vertical-center_text">
						<img src=<?php echo $prod["foto"]?> width="100px">
					</td>
					<td class="vertical-center_text"><?php echo $prod["nombre"]?></td>
					<td class="vertical-center_text"><?php echo $prod["precio"]?>€</td>
					<td class="horizontal-center_text vertical-center_text">
						<a href="index.php?controller=producto&amp;action=eliminarDeCarrito&amp;id=<?php echo $prod["id"]?>"><span  class="glyphicon glyphicon-remove"></span></a>
					</td>
			  </tr>
	  		<?php } ?>
			</tbody>
		  </table>
          <div class="row">	  
			<div class="span12">
			<button href="#" class="btn btn-primary">
            	Actualizar
            </button>
            <button href="#" class="btn btn-primary pull-right">
            	Mostrar interés
            </button>
			</div>
          </div>
	<?php } ?>	
</div>
</div>




