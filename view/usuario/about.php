<?php 
 //file: view/usuario/about.php
 require_once(__DIR__."/../../core/ViewManager.php");
 
 $view = ViewManager::getInstance();
 $view->setVariable("title", "about");
 $errors = $view->getVariable("errors");
?>

<div class="row">
  <div class="span12">
    <h2>¿Quienes somos?</h2>
    <p>BikeWebShop es una aplicación encargada de poner en contacto a compradores y vendedores de productos de ciclismo.<br/>
    Además los usuarios podrán dar su opinion sobre los productos que estén publicados en la web con el fin de aconsejar a otros usuarios</p>
    <h2>¿Como funciona?</h2>
    <p>Una vez te has registrado podrás publicar los productos que estás interesado en vender en la web. Cuando alguien muestre
    interés en tu producto recibirás un email con los datos del interesado para que puedas ponerte en contacto con él.<br/> De la misma 
    manera si muestras interés en un producto tambien recibirás el correspondiente email con los datos del vendedor.</p>

    <h2>Tengo una tienda y quiero anunciarla en BikeWebShop, ¿Que debo hacer?</h2>
    <p>No tienes mas que enviarnos un email a <a href="mailto:info@bikewebshop.roisoftstudio.com">info@bikewebshop.roisoftstudio.com</a>
     y nos podremos en contacto contigo lo antes posible.</p>
  </div>
</div>
