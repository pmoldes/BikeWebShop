<?php

//file: model/Interes.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/Usuario.php");
require_once(__DIR__."/Producto.php");

class Interes {

  private $db; //variable control db

  //Variables de la clase

  private $interes_id;
  private $interes_precio;
  private $interes_fecha;
  private $fk_producto_id;
  private $fk_us_id_comprador;
  private $fk_us_id_vendedor;
  private $interes_eliminado;

  private $producto;
  private $vendedorcomprador;

  //constructor
   
  public function __construct($interes_id=NULL, $interes_precio=NULL, $interes_fecha=NULL, 
                              $fk_producto_id=NULL,$fk_us_id_comprador=NULL,  $fk_us_id_vendedor=NULL, $interes_eliminado=NULL,
                              $producto=NULL, $vendedorcomprador=NULL) {
	 $this->db = PDOConnection::getInstance();
     $this->interes_id = $interes_id; 
     $this->interes_precio = $interes_precio;
	   $this->interes_fecha = $interes_fecha;
     $this->fk_producto_id = $fk_producto_id;
     $this->fk_us_id_comprador = $fk_us_id_comprador;
     $this->fk_us_id_vendedor = $fk_us_id_vendedor;
     $this->interes_eliminado = $interes_eliminado;
     $this->producto = $producto;
     $this->vendedorcomprador = $vendedorcomprador;
   }

  //Getters y setters

  public function getId() {
    return $this->interes_id;
  }

  public function setId($interes_id) {
    $this->interes_id = $interes_id;
  }

  public function getPrecio() {
    return $this->interes_precio;
  }

  public function setPrecio($interes_precio) {
    $this->interes_precio = $interes_precio;
  }

  public function getFecha() {
    return $this->interes_fecha;
  }

  public function setFecha($interes_fecha) {
    $this->interes_fecha = $interes_fecha;
  }

  public function getProductoID() {
    return $this->fk_producto_id;
  }

  public function setProductoID($fk_producto_id) {
    $this->fk_producto_id = $fk_producto_id;
  }

  public function getCompradorID() {
    return $this->fk_us_id_comprador;
  }

  public function setCompradorID($fk_us_id_comprador) {
    $this->fk_us_id_comprador = $fk_us_id_comprador;
  }

  public function getVendedorID() {
    return $this->fk_us_id_vendedor;
  }

  public function setVendedorID($fk_us_id_vendedor) {
    $this->fk_us_id_vendedor = $fk_us_id_vendedor;
  }

  public function getEliminado() {
    return $this->interes_eliminado;
  }

  public function setEliminado($interes_eliminado) {
    $this->interes_eliminado = $interes_eliminado;
  }

  public function getProducto() {
    return $this->producto;
  }

  public function setProducto($producto) {
    $this->producto = $producto;
  }

  public function getVendedorComprador() {
    return $this->vendedorcomprador;
  }

  public function setVendedorComprador($vendedorcomprador) {
    $this->vendedorcomprador = $vendedorcomprador;
  }

  //Funciones de base de datos 
  
  public function save($interes) {
    $stmt = $this->db->prepare("INSERT INTO interes values ('',?,?,?,?,?,'0')");
    $stmt->execute(array($interes->getPrecio(),$interes->getFecha(),$interes->getProductoID(), 
    	$interes->getCompradorID(), $interes->getVendedorID() ));  
  }

  public function obtenerInteresbyId($idInteres){
    $stmt = $this->db->prepare("SELECT *
                                FROM interes
                                WHERE interes_id = $idInteres
                                AND `interes_eliminado` != 1");  
    $stmt -> execute();
    $interes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($interes_db as $interes){
      $toret_interes = new Interes($interes["interes_id"], $interes["interes_precio"],$interes["interes_fecha"],
                              $interes["fk_producto_id"],$interes["fk_us_id_comprador"],$interes["fk_us_id_vendedor"],$interes["interes_eliminado"],
                              NULL, NULL);
    }
    if($toret_interes != NULL)
      return $toret_interes;
    else
      return NULL;
  }

  public function obtenerInteresbyComprador($idComprador){
    $stmt = $this->db->prepare("SELECT *
                                FROM interes I, producto P, usuarios U
                                WHERE P.`producto_id`= I.`fk_producto_id` 
                                AND U.`us_id` = I.`fk_us_id_vendedor`
                                AND I.`fk_us_id_comprador` = $idComprador
                                AND I.`interes_eliminado` != 1");  
    $stmt -> execute();
    $interes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_interes=array();
    foreach($interes_db as $interes){
    	$usuarioRel = new Usuario($interes["us_id"], $interes["us_email"], NULL, NULL, NULL, 
    														NULL, NULL,NULL,$interes["us_telefono"],NULL);
    	$productoRel = new Producto($interes["producto_id"], $interes["producto_nombre"], NULL,NULL,NULL, 
                   NULL,NULL,$interes["producto_foto"], NULL,NULL);
    

      array_push($array_interes, new Interes($interes["interes_id"], $interes["interes_precio"],$interes["interes_fecha"],
                              $interes["fk_producto_id"],$interes["fk_us_id_comprador"],$interes["fk_us_id_vendedor"],$interes["interes_eliminado"],
                              $productoRel, $usuarioRel));
    }
    if(!empty($array_interes))
      return $array_interes;
    else
      return NULL;
  }


  public function obtenerInteresbyVendedor($idVendedor){
    $stmt = $this->db->prepare("SELECT *
                                FROM interes I, producto P, usuarios U
                                WHERE P.`producto_id`= I.`fk_producto_id` 
                                AND U.`us_id` = I.`fk_us_id_comprador`
                                AND I.`fk_us_id_vendedor` = $idVendedor
                                AND I.`interes_eliminado` != 1");  
    $stmt -> execute();
    $interes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_interes=array();
    foreach($interes_db as $interes){
    	$usuarioRel = new Usuario($interes["us_id"], $interes["us_email"], NULL, NULL, NULL, 
    														NULL, NULL,NULL,$interes["us_telefono"],NULL);
    	$productoRel = new Producto($interes["producto_id"], $interes["producto_nombre"], NULL,NULL,NULL, 
                   NULL,NULL,$interes["producto_foto"], NULL,NULL);
    

      array_push($array_interes, new Interes($interes["interes_id"], $interes["interes_precio"],$interes["interes_fecha"],
                              $interes["fk_producto_id"],$interes["fk_us_id_comprador"],$interes["fk_us_id_vendedor"],$interes["interes_eliminado"],
                              $productoRel, $usuarioRel));
    }
    if(!empty($array_interes))
      return $array_interes;
    else
      return NULL;
  }

  public function eliminarInteres($interes_id){
    $stmt = $this->db->prepare("UPDATE interes set interes_eliminado = '1' WHERE interes_id = ?");
    $stmt->execute(array($interes_id));

    if ($stmt != NULL)
    	return true;
    
    return false;

  }
  

}
?>