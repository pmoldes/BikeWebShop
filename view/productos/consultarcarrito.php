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
	<?php if(!isset($_SESSION["currentuser"])){ ?>
	<div class="row">
		<div class="span12">
			<div class="alert alert-warning" role="alert">
				<strong>Atencion!</strong> <p>Estas navegando como invitado, para mostrar interés deber estar registrado.
				Puedes registrarte o acceder a tu cuenta desde <a href="index.php?controller=usuario&amp;action=acceso">aquí</a></p>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if(empty($productos)){ ?>
	<div class="row row-centered">
		<h4>Su carrito esta vacío</h4>
	</div>
	<?php }else {?>
	<div class="row">
	<div class="">
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
						<a onclick="javascript:return confirmarEliminar();" href="index.php?controller=producto&amp;action=eliminarDeCarrito&amp;id=<?php echo $prod["id"]?>"><span  class="glyphicon glyphicon-remove"></span></a>
					</td>
			  </tr>
	  		<?php } ?>
			</tbody>
		  </table>
		  <div class="pull-right">
				<a onclick="javascript:return confirmarVaciar();" href="index.php?controller=producto&amp;action=vaciarCarrito" class="btn btn-primary">Vaciar carrito</a>
				<a href="index.php?controller=producto&amp;action=verCarrito" class="btn btn-primary">Actualizar</a>
		    <?php if(isset($_SESSION["currentuser"])){ ?>
		    	<button type="button" class="btn btn-primary pull right"	data-toggle="modal" data-target="#modalConfirm">Mostrar interés</button>
				<?php } ?>
			</div>
	</div>
	</div>
	<!-- Modal confirmación -->
	<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">¿Quieres mostrar interés en los productos?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Al mostrar interés en una serie de productos recibirás un email con los datos de contacto de los vendedores.<br/>
	        	Puedes consultar estos datos en la pantalla de "Mis intereses" dentro de las opciones de tu cuenta.<br/><br/>
	        	<div class="alert alert-warning" role="alert">Nota: En caso de no recibir el email cosulta tu bandeja correo no deseado.</div></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <a href="index.php?controller=interes&amp;action=mostrarInteres" class="btn btn-primary">Adelante</a>
	      </div>
	    </div>
	  </div>
	</div>

	<?php } ?>	
</div>
</div>

<script>

function confirmarEliminar ()
		  {
		      rc = confirm("¿Seguro que desea eliminar este producto del carrito?");
		      return rc;
		  }

function confirmarVaciar ()
		  {
		      rc = confirm("¿Seguro que desea vaciar su carrito?");
		      return rc;
		  }
</script>




