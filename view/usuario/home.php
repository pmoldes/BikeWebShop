<?php 
   //file: view/usuario/home.php
   require_once(__DIR__."/../../core/ViewManager.php");
   
   $view = ViewManager::getInstance();
   $view->setVariable("title", "home");
   $errors = $view->getVariable("errors");
   $populares = $view->getVariable("populares");
   $categorias = $view->getVariable("categorias");
?>

<div class="row">
	<div class="span3"><!-- start sidebar -->
  <?php include(__DIR__."/../productos/componentelistacategorias.php"); ?>
	</div><!-- end sidebar -->  

  <div class="span9"><!--Start right column-->
  <div class="carousel-container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel"><!--Start Carousel-->
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" data-interval="3000" role="listbox">
        <div class="item active">
          <img class="img-responsive tales" src="css/images/carousel_1.jpg" alt="">
        </div>

        <div class="item">
          <img class="img-responsive tales" src="css/images/carousel_2.jpg" alt="">
        </div>

        <div class="item">
          <img class="img-responsive tales" src="css/images/carousel_3.jpg" alt="">
        </div>

        <div class="item">
          <img class="img-responsive tales" src="css/images/carousel_4.jpg" alt="">
        </div>
      </div>
      <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </a>
      </div><!--End Carousel-->
    </div>
    </br>
    <div class="row">
    		<div class="span9 popular_products">
      		<h2>Productos populares</h2><br />
      		<ul class="thumbnails">
             <?php 
             foreach ($populares as $popular) { ?>
              <li class="span2">
                <div class="thumbnail">
                  <div class="imagecontainer">
                    <a class="img" href="index.php?controller=producto&amp;action=detallesProducto&amp;id=<?php echo $popular->getId()?>"><img alt="imagenproducto" src="<?php echo $popular->getFoto() ?>" /></a>
                  </div>
                  <div class="caption">
                    <a href="index.php?controller=producto&amp;action=detallesProducto&amp;id=<?php echo $popular->getId()?>"> <h5><?php echo $popular->getNombre() ?></h5></a>
                    <p>Precio: <?php echo $popular->getPrecio() ?>€</p> 
                  </div>
                </div>
              </li>
             <?php } ?>
          </ul>
    		</div>
    </div>
  </div>
</div>
