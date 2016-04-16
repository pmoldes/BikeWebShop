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
  <ul class="breadcrumb">
      <li>Categorias</span></li>
  </ul>
    <div class="span3 product_list">
      <ul class="nav">
        <?php foreach ($categorias as $cat){ ?>
        <li>
        <a href="index.php?controller=producto&amp;action=listarProductos&amp;filtro=<?php echo $cat->getCategoria()?>">
        <?php echo $cat->getCategoria()?></a>
        </li>
        <?php }?>
      </ul>
    </div>
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
    		<div class="span7 popular_products">
      		<h2>Productos populares</h2><br />
      		<ul class="thumbnails">
             <?php foreach ($populares as $popular) { ?>
              <li class="span2">
                <div class="thumbnail">
                  <a href="index.php?controller=producto&action=detallesProducto&id=<?php echo $popular->getId()?>"><img alt="imagenproducto" src="<?php echo $popular->getFoto() ?>" /></a>
                  <div class="caption">
                    <a href="index.php?controller=producto&action=detallesProducto&id=<?php echo $popular->getId()?>"> <h5><?php echo $popular->getNombre() ?></h5></a>  Precio: <?php echo $popular->getPrecio() ?>€<br /><br />
                  </div>
                </div>
              </li>
             <?php } ?>
          </ul>
    		</div>
        <div class="span2">
      		<h4>Newsletter</h4><br/>
      		<p>Subscribete a nuestro boletin semanal para enterarte todas la novedades y ofertas de productos.</p>
      		<form class="form-search">
            <input type="text" class="span2" placeholder="Introduce tu email" /><br /><br />
            <button type="submit" class="btn pull-right">Subscribe</button>
          </form><br/><br/>
          <a href="#"><img alt="" title="" src="css/images/paypal_mc_visa_amex_disc_150x139.gif" /></a>
    			<a href="#"><img alt="" src="css/images/bnr_nowAccepting_150x60.gif" /></a>
    		</div>
    </div>
  </div>
</div>
