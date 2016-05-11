<?php

//file: model/Email.php
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/Usuario.php");

class Email {


  //Variables de la clase

  private $comprador;
  private $vendedor;
  private $producto;
  private $cabeceras;
  private $objProducto;

  //constructor
   
  public function __construct($comprador=NULL, $vendedor=NULL, $producto=NULL, $cabeceras=NULL, 
                              $objProducto=NULL) {
     $this->comprador = new Usuario(); 
     $this->vendedor = new Usuario();
	   $this->producto = $producto;
     $this->cabeceras = $cabeceras;
     $this->objProducto = new Producto();

   }

  //Getters y setters

  public function getComprador() {
    return $this->comprador;
  }

  public function setComprador($comprador) {
    $this->comprador = $comprador;
  }

  public function getVendedor() {
    return $this->vendedor;
  }

  public function setVendedor($vendedor) {
    $this->vendedor = $vendedor;
  }

  public function getProducto() {
    return $this->producto;
  }

  public function setProducto($producto) {
    $this->producto = $producto;
  }

  public function getCabeceras() {
    return $this->cabeceras;
  }

  public function setCabeceras($cabeceras) {
    $this->cabeceras = $cabeceras;
  }

  public function getObjProducto() {
    return $this->objProducto;
  }

  public function setObjProducto($objProducto) {
    $this->objProducto = $objProducto;
  }

  public function enviarEmailMuestraInteresComprador(){
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= "From: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "Reply-To: pablomoldesgonzalez@gmail.com\r\n";
    $cabeceras .= "Return-Path: pablomoldesgonzalez@gmail.com\r\n";
    //$cabeceras .= "CC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "BCC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";

    $asunto = 'BikeWebShop: Muestra de interés'; 

    // mensaje
    $mensaje = '
    <html>
    <head>
      <title><b>Has mostrado interés en un producto!</b></title>
    </head>
    <body>
      <p><b>Estimado/a '. $this->comprador->getNombre().' '.$this->comprador->getApellidos().':</b><br/>
      Has mostrado interés en el producto <a href="http://bikewebshop.roisoftstudio.com/index.php?controller=producto&action=detallesProducto&id='.$this->producto['id'].'">'.$this->producto['nombre'].'</a> por un precio de '.$this->producto['precio'].'€<br/>
      Puede ponerse en contacto con el vendedor a través del siguiente email: <a href="mailto:'. $this->vendedor->getEmail().'">'. $this->vendedor->getEmail().'</a><br/><br/>
      Muchas gracias por usar BikeWebShop, <br/>
      Visitanos en nuestra <a href="http://bikewebshop.roisoftstudio.com">web</a> </p>
    </body>
    </html>
    ';

    mail($this->comprador->getEmail(), $asunto, $mensaje, $cabeceras);

  }

  public function enviarEmailMuestraInteresVendedor(){
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= "From: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "Reply-To: pablomoldesgonzalez@gmail.com\r\n";
    $cabeceras .= "Return-Path: pablomoldesgonzalez@gmail.com\r\n";
    //$cabeceras .= "CC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "BCC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";

    $asunto = 'BikeWebShop: Muestra de interés'; 

    // mensaje
    $mensaje = '
    <html>
    <head>
      <title><b>Han mostrado interés en tu producto!</b></title>
    </head>
    <body>
      <p><b>Estimado/a '. $this->vendedor->getNombre().' '.$this->vendedor->getApellidos().':</b><br/>
      El usuario '.$this->comprador->getUsername().' ha mostrado interés en su producto <a href="http://bikewebshop.roisoftstudio.com/index.php?controller=producto&action=detallesProducto&id='.$this->producto['id'].'">'.$this->producto['nombre'].'</a> por un precio de '.$this->producto['precio'].'€<br/>
      Puede ponerse en contacto con el interesado a través del siguiente email: <a href="mailto:'. $this->comprador->getEmail().'">'. $this->comprador->getEmail().'</a><br/>
       </br>
       </br>
      Muchas gracias por usar BikeWebShop, <br/>

      Visitanos en nuestra <a href="http://bikewebshop.roisoftstudio.com">web</a> </p>
    </body>
    </html>
    ';

    mail($this->vendedor->getEmail(), $asunto, $mensaje, $cabeceras);

  }

  public function enviarEmailEliminarInteresbyComprador(){
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= "From: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "Reply-To: pablomoldesgonzalez@gmail.com\r\n";
    $cabeceras .= "Return-Path: pablomoldesgonzalez@gmail.com\r\n";
    //$cabeceras .= "CC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "BCC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";

    $asunto = 'BikeWebShop: Eliminación de interés'; 

    // mensaje
    $mensaje = '
    <html>
    <head>
      <title><b>Han eliminado el interés de tu producto!</b></title>
    </head>
    <body>
      <p><b>Estimado/a '. $this->vendedor->getNombre().' '.$this->vendedor->getApellidos().':</b><br/>
      El usuario '.$this->comprador->getUsername().' ya no está interesado en su producto <a href="http://bikewebshop.roisoftstudio.com/index.php?controller=producto&action=detallesProducto&id='.$this->objProducto->getId().'">'.$this->objProducto->getNombre().'</a> <br/>
      Si lo desea puede ponerse en contacto con el interesado a través del siguiente email: <a href="mailto:'. $this->comprador->getEmail().'">'. $this->comprador->getEmail().'</a> <br/>
      Muchas gracias por usar BikeWebShop, <br/>

      Visitanos en nuestra <a href="http://bikewebshop.roisoftstudio.com">web</a> </p>
    </body>
    </html>
    ';

    mail($this->vendedor->getEmail(), $asunto, $mensaje, $cabeceras);

  }

  public function enviarEmailEliminarInteresbyVendedor(){
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= "From: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "Reply-To: pablomoldesgonzalez@gmail.com\r\n";
    $cabeceras .= "Return-Path: pablomoldesgonzalez@gmail.com\r\n";
    //$cabeceras .= "CC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";
    $cabeceras .= "BCC: bikewebshop@bikewebshop.roisoftstudio.com\r\n";

    $asunto = 'BikeWebShop: Eliminación de interés'; 

    // mensaje
    $mensaje = '
    <html>
    <head>
      <title><b>Han eliminado tu interés por un producto!</b></title>
    </head>
    <body>
      <p><b>Estimado/a '. $this->comprador->getNombre().' '.$this->comprador->getApellidos().':</b><br/>
      El usuario vendedor '.$this->vendedor->getUsername().' ha eliminado tu interés por su producto <a href="http://bikewebshop.roisoftstudio.com/index.php?controller=producto&action=detallesProducto&id='.$this->objProducto->getId().'">'.$this->objProducto->getNombre().'</a><br/>
      Si lo desea puede ponerse en contacto con el vendedor a través del siguiente email: <a href="mailto:'. $this->vendedor->getEmail().'">'. $this->vendedor->getEmail().'</a> <br/>
      Muchas gracias por usar BikeWebShop, <br/>
      Visitanos en nuestra <a href="http://bikewebshop.roisoftstudio.com">web</a> </p>
    </body>
    </html>
    ';

    mail($this->comprador->getEmail(), $asunto, $mensaje, $cabeceras);

  }

}
?>