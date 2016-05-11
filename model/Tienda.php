<?php

//file: model/Tienda.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Tienda {

  private $db; //variable control db

  //Variables de la clase

  private $tienda_id;
  private $tienda_nombre;
  private $tienda_direccion;
  private $tienda_telefono;
  private $tienda_email;
  private $tienda_eliminado;
  private $fk_us_id;

  

  //constructor
   
  public function __construct($tienda_id=NULL, $tienda_nombre=NULL, $tienda_direccion=NULL, 
                              $tienda_email=NULL,$tienda_telefono=NULL,  $fk_us_id=NULL, $tienda_eliminado=NULL) {
	   $this->db = PDOConnection::getInstance();
     $this->tienda_id = $tienda_id; 
     $this->tienda_nombre = $tienda_nombre;
	   $this->tienda_direccion = $tienda_direccion;
     $this->tienda_email = $tienda_email;
     $this->tienda_telefono = $tienda_telefono;
     $this->fk_us_id = $fk_us_id;
     $this->tienda_eliminado = $tienda_eliminado; 
   }
   
  //Getters y setters

  public function getId() {
    return $this->tienda_id;
  }

  public function setId($tienda_id) {
    $this->tienda_id = $tienda_id;
  }
 
  public function getNombre() {
    return $this->tienda_nombre;
  }

  public function setNombre($tienda_nombre) {
    $this->tienda_nombre = $tienda_nombre;
  }

  public function getDireccion() {
    return $this->tienda_direccion;
  }

  public function setDireccion($tienda_direccion) {
    $this->tienda_direccion = $tienda_direccion;
  }

  public function getTelefono() {
    return $this->tienda_telefono;
  }

  public function setTelefono($tienda_telefono) {
    $this->tienda_telefono = $tienda_telefono;
  }

  public function getEmail() {
    return $this->tienda_email;
  }

  public function setEmail($tienda_email) {
    $this->tienda_email = $tienda_email;
  }

  public function getusID() {
    return $this->fk_us_id;
  }

  public function setusID($fk_us_id) {
    $this->fk_us_id = $fk_us_id;
  }

  public function getEliminado() {
    return $this->tienda_eliminado;
  }

  public function setEliminado($tienda_eliminado) {
    $this->tienda_eliminado = $tienda_eliminado;
  }

  
  

  //Funciones de base de datos 
  
  public function save($tienda) {
    $stmt = $this->db->prepare("INSERT INTO tiendas values ('',?,?,?,?,?,'0')");
    $stmt->execute(array($tienda->getNombre(), $tienda->getDireccion(),$tienda->getEmail(),
                        $tienda->getTelefono(), $tienda->getusID()));  
  }

  public function obtenerID($us_email){
    $stmt = $this->db->prepare("SELECT us_id FROM usuarios WHERE us_email = ?");
    $stmt->execute(array($us_email));

    $us_id = $stmt->fetch(PDO::FETCH_ASSOC);

    return $us_id["us_id"];
  } 

  public function existeTienda($fk_us_id){
    $stmt = $this->db->prepare("SELECT count(fk_us_id) FROM tiendas WHERE fk_us_id = ? AND tienda_eliminado != '1'");
    $stmt->execute(array($fk_us_id));

    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }
  
  public function consultarTienda($fk_us_id){
    $stmt = $this->db->prepare("SELECT * FROM tiendas WHERE fk_us_id= ? AND tienda_eliminado != '1'");
    $stmt -> execute(array($fk_us_id));
    $ti_datos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $ti_datos=array();
    foreach($ti_datos_db as $ti_dato){
      array_push($ti_datos, new Tienda($ti_dato["tienda_id"], $ti_dato["tienda_nombre"], $ti_dato["tienda_direccion"],
                                        $ti_dato["tienda_email"],$ti_dato["tienda_telefono"], $ti_dato["fk_us_id"]));
    }
    if(!empty($ti_datos)){ return $ti_datos;}
    else{ return NULL;}
  }

  public function modificarTienda($tienda,$fk_us_id){

      $stmt = $this->db->prepare("UPDATE tiendas SET tienda_nombre=?,tienda_direccion=?,
                                 tienda_email=?, tienda_telefono=?  WHERE fk_us_id =?");

      $stmt->execute(array($tienda->getNombre(),$tienda->getDireccion(), 
                      $tienda->getEmail(),$tienda->getTelefono(), $fk_us_id));
  }

  public function bajaTienda($fk_us_id){
    $stmt = $this->db->prepare("UPDATE tiendas SET tienda_eliminado = '1' WHERE fk_us_id=? AND tienda_eliminado != '1'");
    $stmt->execute(array($fk_us_id));

    return true;

  }

  public function getTiendas(){
    $stmt = $this->db->prepare("SELECT * FROM tiendas WHERE tienda_eliminado != '1'");  
    $stmt -> execute();
    $tiendas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $tiendas=array();
    foreach($tiendas_db as $tienda){
      array_push($tiendas, new Tienda($tienda["tienda_id"], $tienda["tienda_nombre"], $tienda["tienda_direccion"],
                                        $tienda["tienda_email"], $tienda["tienda_telefono"], $tienda["fk_us_id"]));
    }
    if(!empty($tiendas))
      return $tiendas;
    else
      return NULL;
  }
  
  

}
?>