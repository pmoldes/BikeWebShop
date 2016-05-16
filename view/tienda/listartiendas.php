<?php 
 //file: view/tienda/listartiendas.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $tiendas = $view->getVariable("tiendas");

?>

<div class="row"><!--main row -->
	<div class="span3"><!-- start sidebar -->
		<ul class="breadcrumb">
		    <span><li>Tiendas</li></span>
		</ul>
		<div class="product_list">
			<ul class="nav">
				<?php foreach ($tiendas as $tienda){?>
					<li><a href="#"><?php echo $tienda->getNombre() ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div><!-- end sidebar -->
	<div class="span9"><!--start right column -->
		<ul class="breadcrumb">
		    <li>
		    	<a href="index.php">Inicio</a> <span class="divider">/</span>
		    </li>
		    <li class="active">
		    	<a href="index.php?controller=tienda&amp;action=listarTiendas">Tiendas</a> 
		    </li>
	  </ul>
		<?php foreach ($tiendas as $tienda){?>
	 	<div class="row"> 
	  	<div class="span6 datos-tienda">
	  		<h2><?php echo $tienda->getNombre() ?></h2></a>
        <p><span class="right5 glyphicon glyphicon-map-marker"></span><strong>Direccion:</strong> <a target="_blank" href="http://maps.google.com/?q=<?php echo $tienda->getDireccion() ?>"><?php echo $tienda->getDireccion() ?></a> </p>
        <p><span class="right5 glyphicon glyphicon-envelope"></span><strong>Email:</strong> <a href="mailto:<?php echo $tienda->getEmail()?>"><?php echo $tienda->getEmail() ?></a></p>
        <p><span class="right5 glyphicon glyphicon-earphone"></span><strong>Telefono:</strong> <a href="tel:<?php echo $tienda->getTelefono()?>"><?php echo $tienda->getTelefono() ?></a></p>
			</div>
			<div class="span2 pull-right btn-group">
			   <div><a class="btn btn-primary" href="index.php?controller=producto&amp;action=listarProductosTienda&amp;id=<?php echo $tienda->getusId()?>">Ver productos</a></div>
			   <div><a class="btn btn-primary" data-toggle="modal" data-target="#modalMap">Ver mapa</a></div>
		  </div>
		</div>
		<hr/>


		<!-- Modal mapa -->
		<div class="modal fade" id="modalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Localización de la tienda</h4>
	      </div>
	      <div class="modal-body">
	      <iframe width="520" height="400" frameborder="0" style="border:0" 
	      	src="https://www.google.com/maps/embed/v1/place?q=<?php echo $tienda->getDireccion() ?>&amp;key=AIzaSyDKTTvu-uFediwqTltLUhIlsKd3rhbOAf0" allowfullscreen></iframe>
	      	<!-- <div id="map" style="width: 500px; height: 360px"></div> -->
	      </div>
	    </div>
	  </div>
		</div>

		<?php } ?>
	</div>
</div>

