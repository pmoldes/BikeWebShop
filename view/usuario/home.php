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
        <li><a href="index.php?controller=producto&action=listarProductos&filtro=<?php echo $cat->getCategoria()?>"><?php echo $cat->getCategoria()?></a></li>
        <?php }?>
      </ul>
    </div><!-- end sidebar -->  
	</div>
    <div class="span9">

		<div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
              <div class="item active">
				<img src="css/images/carousel_1.jpg" alt="">
                <div class="carousel-caption">
                  <h4>Mountain Bike</h4>
                  <p>Mountain Bike</p>
                </div>
              </div>
              <div class="item">
                <img src="css/images/carousel_2.jpg" alt="">
                <div class="carousel-caption">
                  <h4>Fixed</h4>
                  <p>Fixed</p>
                </div>
              </div>
			  <div class="item">
				<img src="css/images/carousel_3.jpg" alt="">
                <div class="carousel-caption">
                  <h4>BMX</h4>
                  <p>BMX</p>
              </div>
             </div>
             <div class="item">
				<img src="css/images/carousel_4.jpg" alt="">
                <div class="carousel-caption">
                  <h4>Carretera</h4>
                  <p>Carretera</p>
                </div>
              </div>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
          </div>
          </div>
		  
		  
		  
		<div class="span7 popular_products">
  		<h4>Productos populares</h4><br />
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
		
		<div class="roe">
  		<h4>Newsletter</h4><br />
  		<p>Subscribete a nuestro boletin semanal para enterarte todas la novedades y ofertas de productos.</p>
  		
  		    <form class="form-search">
      <input type="text" class="span2" placeholder="Introduce tu email" /><br /><br />
      <button type="submit" class="btn pull-right">Subscribe</button>
      </form>
  		</div><br /><br />
              <a href="#"><img alt="" title="" src="css/images/paypal_mc_visa_amex_disc_150x139.gif" /></a>
  			<a href="#"><img alt="" src="css/images/bnr_nowAccepting_150x60.gif" /></a>

		</div>
	  
  </div>






<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.rating.pack.js"></script>


