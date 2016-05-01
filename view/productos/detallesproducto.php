<?php 
 //file: view/tienda/detallesproducto.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $producto = $view->getVariable("producto");
 $categorias = $view->getVariable("categorias");
 $comentarios = $view->getVariable("comentarios");

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
		</div>
	</div><!-- end sidebar -->	


	<div class="span9">

		<div class="span9">
			<ul class="breadcrumb"> <!-- Start Indice -->
		    	<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>				
		    	<li>
		    		<a href="index.php?controller=producto&amp;action=listarProductos">Productos</a> <span class="divider">/</span>
	    		</li>
				<li class="active">
		    		<a href="#"><?php echo $producto[0]->getNombre() ?></a> 
		    	</li>
	    	</ul><!-- End Indice -->
		</div>
		
		 <div class="row">
			 <div class="span9">
				<h1><?php echo $producto[0]->getNombre() ?></h1>
			 </div>
		</div>
		<hr>
		<div class="row">
			<div class="span3">
				<img alt="" class="img-responsive" src="<?php echo $producto[0]->getFoto() ?>" />
			</div>	 
		  	<div class="span6">
					<strong>Stock:</strong> <span><?php echo $producto[0]->getCantidad() ?></span><br />
					<strong>Estado:</strong> 
					<span>
						<?php if ($producto[0]->getNuevo() == 1) 
									echo "Nuevo";
							  else 
									echo "Usado";?>
					</span><br/>
					<h2><strong>Precio: <?php echo $producto[0]->getPrecio() ?>€</strong></h2>
					<a class="btn btn-primary" 
					href="index.php?controller=producto&amp;action=anhadirAlCarrito&amp;id=<?php echo $producto[0]->getId()?>">Añadir al carrito</a>
			</div>
				
		</div>	
		<hr>
			
		<!-- <div class="span6">
			
			<p>
			<input name="star1" type="radio" class="star"/>
			<input name="star1" type="radio" class="star"/>
			<input name="star1" type="radio" class="star"/>
			<input name="star1" type="radio" class="star"/>
			<input name="star1" type="radio" class="star"/>&nbsp;&nbsp;
			</p>
		</div>	 -->

	   
		<div class="row">
			<div class="span9">
			    <div class="tabbable">
				    <ul class="nav nav-tabs">
					    <li class="active"><a href="#tab1" data-toggle="tab">Descripcion</a></li>
					    <li><a href="#tab2" data-toggle="tab">Comentarios</a></li>
				    </ul>
				    <div class="tab-content">
					    <div class="tab-pane active" id="tab1">
					    	<p><?php echo $producto[0]->getDescripcion()?></p>
					    </div>
					    <div class="tab-pane" id="tab2">
					    <?php if($comentarios == NULL){ ?>
					    		<p>No hay comentarios sobre este producto</p>
					    <?php }else{ ?>
						    <?php foreach ($comentarios as $comentario){?>
						    	<div class "row">
						    		<h4><?php echo $comentario->getTitulo()?></h4><h6>por <?php echo $comentario->getAutor()?></h6>
						    		<p>Valoracion: <?php echo $comentario->getValoracion()?>/5</p>
						    		<p><?php echo $comentario->getTexto()?></p>
				    				<?php if($comentario->comprobarAutor($comentario->getComentarioId(),$_SESSION["currentuser"]) ||
				    					$comentario->esAdmin($_SESSION["currentuser"])){ //Si el usuario actual es el autor del comentario puede editar/eliminar?>
				    					
				    					<a data-toggle="modal" data-target="#modificarcomentario<?php echo $comentario->getComentarioId()?>" ><i class="icon-pencil" ></i></a>
						    			
						    			<a onclick="javascript:return confirmar();" href="index.php?controller=producto&amp;action=bajaComentario&amp;idComentario=<?php echo $comentario->getComentarioId()?>&amp;idProducto=<?php echo $comentario->getProductoId()?>">
							    			<i class="icon-remove-sign" ></i>
						    			</a>

						    			<!-- Modal modificarcomentario -->
										<div class="modal fade" id="modificarcomentario<?php echo $comentario->getComentarioId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  <div class="modal-dialog">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title" id="myModalLabel">Modificar comentario</h4>
										      </div><!--cierre modal header-->
										      <div class="modal-body">
										       	<form enctype="multipart/form-data" class="form-horizontal" id="formmodificarcomentario" action="index.php?controller=producto&amp;action=modificarComentario&amp;id=<?php echo $comentario->getProductoId()?>" method="POST">
										       		<fieldset>
										       			<input type="hidden" name="comentario_id" value="<?php echo $comentario->getComentarioId() ?>">
											       		<div class="control-group">
											       			<label class="control-label">Titulo</label>
															<div class="controls docs-input-sizes">
														  		<input type="text" value="<?php echo $comentario->getTitulo()?>" class="span4" name="mod_titulo">
															</div>
											  			</div><!--cierre control group-->
											  			<div class="control-group">
											                <label class="control-label">Valoracion</label>
											                <div class="controls docs-input-sizes">
											                  <select class="span4" name="valoracion">
											                    <option <option <?php 
                            										if($comentario->getValoracion() == '1')
                              										{echo("selected='selected'");}
                            										?> 
                            										value="1">1
                    											</option>
											                    <option <option <?php 
                            										if($comentario->getValoracion() == '2')
                              										{echo("selected='selected'");}
                            										?> 
                            										value="2">2
                    											</option>
											                    <option <option <?php 
                            										if($comentario->getValoracion() == '3')
                              										{echo("selected='selected'");}
                            										?> 
                            										value="3">3
                    											</option>
											                    <option <option <?php 
                            										if($comentario->getValoracion() == '4')
                              										{echo("selected='selected'");}
                            										?> 
                            										value="4">4
                    											</option>
											                    <option <option <?php 
                            										if($comentario->getValoracion() == '5')
                              										{echo("selected='selected'");}
                            										?> 
                            										value="5">5
                    											</option>
											                  </select>
											                </div>
										              	</div><!--cierre control group-->
										              	<div class="control-group">
											  				<label class="control-label">Texto</label>
												  				<div class="controls docs-input-sizes">
												  					<textarea class="span4"rows="4" cols="50" name="mod_texto"><?php echo $comentario->getTexto()?></textarea>
												                </div>
													  	</div><!--cierre control group-->
										       		
										      </div> <!--End modal body -->
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
										        <button type="submit" class="btn btn-primary">Enviar</button>
										        </fieldset>
										       	</form>
										      </div> <!--cierre modal footer-->
										    </div><!--cierre modal content-->
										  </div> <!--cierre modal dialog-->
									    </div> <!-- fin Modal modificarcomentario -->   
						    		<?php } ?><!-- Fin if de comprobar autor -->
						    	</div>
						    	<hr>
						    <?php } ?> <!-- fin foreach de comentarios -->
						<?php } ?> <!-- fin else de si hay comentarios -->
						<!-- Button trigger modal -->
						<?php  if (isset($_SESSION["currentuser"])){?>
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#altacomentario">
						  Escribir comentario
						</button>
						<?php } ?>

						<!-- Modal altacomentario -->
						<div class="modal fade" id="altacomentario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Escribir comentario</h4>
						      </div>
						      <div class="modal-body">
						       	<form enctype="multipart/form-data" class="form-horizontal" id="form_alta" action="index.php?controller=producto&amp;action=altaComentario&amp;id=<?php echo $producto[0]->getId()?>" method="POST">
						       		<fieldset>
							       		<div class="control-group">
							       			<label class="control-label">Titulo</label>
											<div class="controls docs-input-sizes">
										  		<input type="text" placeholder="Escribe el título del comentario" class="span4" name="titulo">
											</div>
							  			</div>
							  			<div class="control-group">
							                <label class="control-label">Valoracion</label>
							                <div class="controls docs-input-sizes">
							                  <select class="span4" name="valoracion">
							                    <option value="1">1</option>
							                    <option value="2">2</option>
							                    <option selected=selected value="3">3</option>
							                    <option value="4">4</option>
							                    <option value="5">5</option>
							                  </select>
							                </div>
						              	</div>
						              	<div class="control-group">
							  				<label class="control-label">Texto</label>
							  				<div class="controls docs-input-sizes">
							  					<textarea placeholder="Escribe tu opinión sobre el producto, máximo 500 caracteres"class="span4"rows="4" cols="50" name="texto"></textarea>
							                </div>
									  	</div>
						      	</div> <!--End modal body -->
						      	<div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						        <button type="submit" class="btn btn-primary">Enviar</button>
						        </fieldset>
						       	</form>
						      </div>
						    </div>
						  </div>
						</div>
					    </div> <!-- fin Modal altacomentario -->   
					
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>	 
	 
<script src="js/jquery.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script>
function confirmar (){
		      rc = confirm("¿Seguro que desea eliminar este comentario?");
		      return rc;
		  }

</script>
<script>
	$("#form_alta").validate({
    rules: {
      titulo: {
      	required: true,
        maxlength:45
      },
      texto: {
        required: true,
        maxlength:500
      }

    },


    messages: {
      
      titulo: {
        required: "Campo vacío",
        maxlength:"El titulo es muy largo"
      },
      texto: {
        required: "Campo vacío",
        maxlength:"El texto es muy largo"
      }
      
    }
  });

  
</script>


