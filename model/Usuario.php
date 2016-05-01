<?php

//file: model/Usuario.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Usuario {

  private $db; //variable control db

  //Variables de la clase

  private $us_id;
  private $us_email;
  private $us_username;
  private $us_password;
  private $us_nombre;
  private $us_apellidos;
  private $us_direccion;
  private $us_codigopostal;
  private $us_telefono;
  private $us_rol;
  private $us_eliminado;
  

  //constructor
   
  public function __construct($us_id=NULL, $us_email=NULL, $us_username=NULL, $us_password=NULL, $us_nombre=NULL,
                               $us_apellidos=NULL, $us_direccion=NULL, $us_codigopostal=NULL, $us_telefono=NULL, 
                               $us_rol=NULL, $us_eliminado = NULL) {
	   $this->db = PDOConnection::getInstance();
     $this->us_id = $us_id; 
     $this->us_email = $us_email;
	   $this->us_username = $us_username;
	   $this->us_password = $us_password;
     $this->us_nombre = $us_nombre; 
     $this->us_apellidos = $us_apellidos; 
     $this->us_direccion = $us_direccion; 
     $this->us_codigopostal = $us_codigopostal; 
     $this->us_telefono = $us_telefono; 
     $this->us_rol = $us_rol;
     $this->us_eliminado = $us_eliminado;
   }
   
  //Getters y setters
  
  public function getId() {
    return $this->us_id;
  }

  public function setId($us_id) {
    $this->us_id = $us_id;
  }

  public function getEmail() {
    return $this->us_email;
  }

  public function setEmail($us_email) {
    $this->us_email = $us_email;
  }
 
  public function getUsername() {
    return $this->us_username;
  }

  public function setUsername($us_username) {
    $this->us_username = $us_username;
  }

  public function getPassword() {
    return $this->us_password;
  }

  public function setPassword($us_password) {
    $this->us_password = $us_password;
  }

  public function getNombre() {
    return $this->us_nombre;
  }

  public function setNombre($us_nombre) {
    $this->us_nombre = $us_nombre;
  }

  public function getApellidos() {
    return $this->us_apellidos;
  }

  public function setApellidos($us_apellidos) {
    $this->us_apellidos = $us_apellidos;
  }

  public function getDireccion() {
    return $this->us_direccion;
  }

  public function setDireccion($us_direccion) {
    $this->us_direccion = $us_direccion;
  }

  public function getCP() {
    return $this->us_codigopostal;
  }

  public function setCP($us_codigopostal) {
    $this->us_codigopostal = $us_codigopostal;
  }

  public function getTelefono() {
    return $this->us_telefono;
  }

  public function setTelefono($us_telefono) {
    $this->us_telefono = $us_telefono;
  }

  public function getRol() {
    return $this->us_rol;
  }

  public function setRol($us_rol) {
    $this->us_rol = $us_rol;
  }

  public function getEliminado() {
    return $this->us_eliminado;
  }

  public function setEliminado($us_eliminado) {
    $this->us_eliminado = $us_eliminado;
  }
  

  //Funciones de base de datos 
  
  public function save($usuario) {
    $stmt = $this->db->prepare("INSERT INTO usuarios values ('',?,?,?,?,?,?,?,?,'1','0')");
    $stmt->execute(array($usuario->getEmail(),$usuario->getUsername(), $usuario->getPassword(),
                    $usuario->getNombre(),$usuario->getApellidos(),$usuario->getDireccion(),$usuario->getCP(),
                    $usuario->getTelefono()));  
  }

  public function IdExists($us_id) {
    $stmt = $this->db->prepare("SELECT count(us_id) FROM usuarios where us_id=?");
    $stmt->execute(array($us_id));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }

  public function obtenerIDbyEmail($email){
    $stmt = $this->db->prepare("SELECT us_id FROM usuarios WHERE us_email = ?");
    $stmt->execute(array($email));

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return $usuario["us_id"];
  }

  public function emailExists($us_email) {
    $stmt = $this->db->prepare("SELECT count(us_email) FROM usuarios where us_email=?");
    $stmt->execute(array($us_email));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }

  public function usernameExists($us_username) {
    $stmt = $this->db->prepare("SELECT count(us_username) FROM usuarios where us_username=?");
    $stmt->execute(array($us_username));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }
  
  public function emailModificar($us_id, $us_email) { //devuelve true si existe el mail para usuario con distinto Id
    $stmt = $this->db->prepare("SELECT count(us_email) FROM usuarios where us_id != ? and us_email=?");
    $stmt->execute(array($us_id, $us_email));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }
  
  public function isValidUser($us_email, $us_password) {
    $stmt = $this->db->prepare("SELECT count(us_email) 
                                FROM usuarios 
                                where us_email=? and us_password=? AND us_eliminado!= '1'");
    $stmt->execute(array($us_email, $us_password));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }

  public function getPass($us_email) {
    $stmt = $this->db->prepare("SELECT us_password
                                FROM usuarios 
                                where us_email=? AND us_eliminado!= '1'");
    $stmt->execute(array($us_email));
    $password = $stmt->fetch(PDO::FETCH_ASSOC);

    return $password["us_password"];
  }

  public function bajaUsuario($us_email){
    $stmt = $this->db->prepare("UPDATE usuarios SET us_eliminado='1' WHERE us_email=?");
    $stmt->execute(array($us_email));

    return true;

  }

  public function consultarUsuario($us_email){
    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE us_email= ? AND us_eliminado != '1'");
    $stmt -> execute(array($us_email));
    $us_datos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $us_datos=array();
    foreach($us_datos_db as $us_dato){
      array_push($us_datos, new Usuario($us_dato["us_id"], $us_dato["us_email"],$us_dato["us_username"], 
                                        $us_dato["us_password"], $us_dato["us_nombre"], $us_dato["us_apellidos"], 
                                        $us_dato["us_direccion"], $us_dato["us_codigo_postal"],$us_dato["us_telefono"],
                                        $us_dato["us_rol"]));
    }
    if(!empty($us_datos)){ return $us_datos;}
    else{ return NULL;}
  }
  
   public function modificarUsuario($usuario,$us_email){

      $stmt = $this->db->prepare("UPDATE usuarios SET us_email=?,us_username=?,us_password=?,us_nombre=?,
                                  us_apellidos=?,us_direccion=?,us_codigo_postal=?,us_telefono=? 
                                  WHERE us_email =?");

      $stmt->execute(array($usuario->getEmail(),$usuario->getUsername(), $usuario->getPassword(),
                    $usuario->getNombre(),$usuario->getApellidos(),$usuario->getDireccion(),$usuario->getCP(),
                    $usuario->getTelefono(), $us_email));
                     

   }

   public function esTienda($us_email){
    $stmt = $this->db->prepare("SELECT count(us_email) FROM usuarios where us_email=? and us_rol='2'");
    $stmt->execute(array($us_email));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }
  
  

}