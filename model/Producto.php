<?php

//file: model/Producto.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Producto {

  private $db; //variable control db

  //Variables de la clase

  private $producto_id;
  private $producto_nombre;
  private $producto_modalidad;
  private $producto_categoria;
  private $producto_descripcion;
  private $producto_precio;
  private $producto_cantidad;
  private $producto_foto;
  private $producto_nuevo;
  private $fk_us_id;
  private $producto_eliminado;

  //constructor
   
  public function __construct($producto_id=NULL, $producto_nombre=NULL, $producto_modalidad=NULL, 
                              $producto_categoria=NULL, $producto_descripcion=NULL,
                              $producto_precio=NULL,$producto_cantidad=NULL,$producto_foto=NULL,
                              $producto_nuevo=NULL,$fk_us_id=NULL, $producto_eliminado=NULL) {
	   $this->db = PDOConnection::getInstance();
     $this->producto_id = $producto_id; 
     $this->producto_nombre = $producto_nombre;
	   $this->producto_modalidad = $producto_modalidad;
     $this->producto_categoria = $producto_categoria;
     $this->producto_descripcion = $producto_descripcion;
     $this->producto_precio = $producto_precio;
     $this->producto_cantidad = $producto_cantidad;
     $this->producto_foto = $producto_foto; 
     $this->producto_nuevo = $producto_nuevo;
     $this->fk_us_id = $fk_us_id;
     $this->producto_eliminado = $producto_eliminado;

   }
   
  //Getters y setters

  public function getId() {
    return $this->producto_id;
  }

  public function setId($producto_id) {
    $this->producto_id = $producto_id;
  }
 
  public function getNombre() {
    return $this->producto_nombre;
  }

  public function setNombre($producto_nombre) {
    $this->producto_nombre = $producto_nombre;
  }

  public function getModalidad() {
    return $this->producto_modalidad;
  }

  public function setModalidad($producto_modalidad) {
    $this->producto_modalidad = $producto_modalidad;
  }

  public function getCategoria() {
    return $this->producto_categoria;
  }

  public function setCategoria($producto_categoria) {
    $this->producto_categoria = $producto_categoria;
  }
  public function getDescripcion() {
    return $this->producto_descripcion;
  }

  public function setDescripcion($producto_descripcion) {
    $this->producto_descripcion = $producto_descripcion;
  }

  public function getPrecio() {
    return $this->producto_precio;
  }

  public function setPrecio($producto_precio) {
    $this->producto_precio = $producto_precio;
  }

  public function getCantidad() {
    return $this->producto_cantidad;
  }

  public function setCantidad($producto_cantidad) {
    $this->producto_cantidad = $producto_cantidad;
  }

  public function getFoto() {
    return $this->producto_foto;
  }

  public function setFoto($producto_foto) {
    $this->producto_foto = $producto_foto;
  }

  public function getNuevo() {
    return $this->producto_nuevo;
  }

  public function setNuevo($producto_nuevo) {
    $this->producto_nuevo = $producto_nuevo;
  }

  public function getUsId() {
    return $this->fk_us_id;
  }

  public function setUsId($fk_us_id) {
    $this->fk_us_id = $fk_us_id;
  }

  public function getEliminado() {
    return $this->producto_eliminado;
  }

  public function setEliminado($producto_eliminado) {
    $this->producto_eliminado = $producto_eliminado;
  }

  //Funciones de base de datos 
  
  public function save($producto) {
    $stmt = $this->db->prepare("INSERT INTO producto values ('',?,?,?,?,?,?,?,?,?,'0')");
    $stmt->execute(array($producto->getNombre(), $producto->getModalidad(),$producto->getCategoria(),$producto->getDescripcion(), $producto->getPrecio(),
                          $producto->getCantidad(), $producto->getFoto(),$producto->getNuevo(),
                          $producto->getUsId()));  
  }

  public function modificarProducto($producto,$producto_id) {
    $stmt = $this->db->prepare("UPDATE producto SET producto_nombre=?, producto_modalidad=?, producto_categoria=?,
                                producto_descripcion=?, producto_precio=?, producto_cantidad=?, producto_foto=?,
                                producto_nuevo=? WHERE producto_id=?");
    $stmt->execute(array($producto->getNombre(), $producto->getModalidad(),$producto->getCategoria(),
                          $producto->getDescripcion(), $producto->getPrecio(),
                          $producto->getCantidad(), $producto->getFoto(),$producto->getNuevo(),
                          $producto_id)); 

    return true; 
  }

  public function bajaProducto($producto_id, $fk_us_id){
    $stmt = $this->db->prepare("UPDATE producto set producto_eliminado = '1' WHERE producto_id = ? AND fk_us_id = ?");
    $stmt->execute(array($producto_id, $fk_us_id));

    return true;

  }

  public function getProductos($filtro){
    $stmt = $this->db->prepare("SELECT * FROM producto 
                                WHERE (`producto_modalidad` = ? OR `producto_categoria` = ? OR `fk_us_id` = ?) 
                                AND producto_eliminado != 1");  
    $stmt -> execute(array($filtro,$filtro,$filtro));
    $producto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_producto=array();
    foreach($producto_db as $producto){
      array_push($array_producto, new Producto($producto["producto_id"], $producto["producto_nombre"], $producto["producto_modalidad"],
                                        $producto["producto_categoria"],$producto["producto_descripcion"], $producto["producto_precio"],
                                        $producto["producto_cantidad"],$producto["producto_foto"], $producto["producto_nuevo"], 
                                        $producto["fk_us_id"]));
    }
    if(!empty($array_producto))
      return $array_producto;
    else
      return NULL;
  }

  public function getTodosProductos(){
    $stmt = $this->db->prepare("SELECT * FROM producto WHERE producto_eliminado != 1");  
    $stmt -> execute();
    $producto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_producto=array();
    foreach($producto_db as $producto){
      array_push($array_producto, new Producto($producto["producto_id"], $producto["producto_nombre"], $producto["producto_modalidad"],
                                        $producto["producto_categoria"],$producto["producto_descripcion"], $producto["producto_precio"],
                                        $producto["producto_cantidad"],$producto["producto_foto"], $producto["producto_nuevo"], 
                                        $producto["fk_us_id"]));
    }
    if(!empty($array_producto))
      return $array_producto;
    else
      return NULL;
  }

  public function getProductosPopulares(){
    $stmt = $this->db->prepare("SELECT count(*) as cuenta, P.`producto_id`, P.`producto_nombre`, P.`producto_precio`, P.`producto_foto`
                                FROM producto P, comentarios C 
                                WHERE P.`producto_id`= C.`fk_producto_id` AND producto_eliminado != 1
                                group by P.`producto_id` 
                                order by cuenta desc
                                limit 8");  
    $stmt -> execute();
    $producto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_producto=array();
    foreach($producto_db as $producto){
      array_push($array_producto, new Producto($producto["producto_id"], $producto["producto_nombre"], NULL,NULL,NULL, 
                                              $producto["producto_precio"],NULL,$producto["producto_foto"], NULL,NULL));
    }
    if(!empty($array_producto))
      return $array_producto;
    else
      return NULL;
  }

  public function buscarProductos($filtro){
    
    $stmt = $this->db->prepare("SELECT * FROM producto WHERE (`producto_modalidad` LIKE '{$filtro}' OR
    `producto_categoria` LIKE '{$filtro}' OR `producto_nombre` LIKE '{$filtro}') AND producto_eliminado != 1");
    
    $stmt->execute();
    $producto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $array_producto=array();

    foreach($producto_db as $producto){
      array_push($array_producto, new Producto($producto["producto_id"], $producto["producto_nombre"], $producto["producto_modalidad"],$producto["producto_categoria"],$producto["producto_descripcion"], $producto["producto_precio"],$producto["producto_cantidad"],$producto["producto_foto"], $producto["producto_nuevo"], 
        $producto["fk_us_id"]));
    }
    if(!empty($array_producto))
      return $array_producto;
    else
      return NULL;
  }

  public function getCategorias(){
    $stmt = $this->db->prepare("SELECT DISTINCT producto_categoria  
                                FROM producto 
                                WHERE producto_eliminado != 1 
                                ORDER BY 1");  
    $stmt -> execute();
    $producto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_producto=array();
    foreach($producto_db as $producto){
      array_push($array_producto, new Producto(NULL, NULL, NULL,$producto["producto_categoria"], NULL, 
                                                NULL, NULL, NULL, NULL, NULL));
    }
    if(!empty($array_producto))
      return $array_producto;
    else
      return NULL;
  }

  public function obtenerID($nombre){
    $stmt = $this->db->prepare("SELECT producto_id FROM producto WHERE producto_nombre = ?");
    $stmt->execute(array($nombre));

    $id = $stmt->fetch(PDO::FETCH_ASSOC);

    return $id["producto_id"];
  }

  public function getDetallesProducto($producto_id){
    $stmt = $this->db->prepare("SELECT * FROM producto WHERE `producto_id` = ?");  
    $stmt -> execute(array($producto_id));
    $producto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_producto=array();
    foreach($producto_db as $producto){
      array_push($array_producto, new Producto($producto["producto_id"], $producto["producto_nombre"],
      $producto["producto_modalidad"],$producto["producto_categoria"],$producto["producto_descripcion"], $producto["producto_precio"],$producto["producto_cantidad"],$producto["producto_foto"], $producto["producto_nuevo"], 
                                        $producto["fk_us_id"]));
    }
    if(!empty($array_producto))
      return $array_producto;
    else
      return NULL;
    
  }

  public function obtenerUsID($us_email){
    $stmt = $this->db->prepare("SELECT us_id FROM usuarios WHERE us_email = ?");
    $stmt->execute(array($us_email));

    $us_id = $stmt->fetch(PDO::FETCH_ASSOC);

    return $us_id["us_id"];
  } 





}