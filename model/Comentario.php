<?php

//file: model/Comentario.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Comentario {

  private $db; //variable control db

  //Variables de la clase


  private $comentario_id;
  private $comentario_titulo;
  private $comentario_autor;
  private $comentario_texto;
  private $comentario_valoracion;
  private $fk_producto_id;
  private $fk_us_id;
  private $comentario_eliminado;
  

  //constructor
   
  public function __construct($comentario_id=NULL, $comentario_titulo=NULL, $comentario_texto=NULL,
                              $comentario_autor=NULL,$comentario_valoracion=NULL,$fk_producto_id=NULL, 
                              $fk_us_id=NULL,$comentario_eliminado=NULL) {
	   $this->db = PDOConnection::getInstance();
    
     $this->comentario_id = $comentario_id;
     $this->comentario_titulo = $comentario_titulo;
     $this->comentario_texto = $comentario_texto;
     $this->comentario_autor = $comentario_autor;
     $this->comentario_valoracion = $comentario_valoracion;
     $this->fk_producto_id = $fk_producto_id; 
     $this->fk_us_id = $fk_us_id; 
     $this->comentario_eliminado = $comentario_eliminado; 
   }
   
  //Getters y setters

  public function getComentarioID() {
    return $this->comentario_id;
  }

  public function setComentarioID($comentario_id) {
    $this->comentario_id = $comentario_id;
  }
 
  public function getTitulo() {
    return $this->comentario_titulo;
  }

  public function setTitulo($comentario_titulo) {
    $this->comentario_titulo = $comentario_titulo;
  }

  public function getAutor() {
    return $this->comentario_autor;
  }

  public function setAutor($comentario_autor) {
    $this->comentario_autor = $comentario_autor;
  }

  public function getTexto() {
    return $this->comentario_texto;
  }

  public function setTexto($comentario_texto) {
    $this->comentario_texto = $comentario_texto;
  }

  public function getValoracion() {
    return $this->comentario_valoracion;
  }

  public function setValoracion($comentario_valoracion) {
    $this->comentario_valoracion = $comentario_valoracion;
  }

  public function getProductoId() {
    return $this->fk_producto_id;
  }

  public function setProductoId($fk_producto_id) {
    $this->fk_producto_id = $fk_producto_id;
  }

  public function getUsId() {
    return $this->fk_us_id;
  }

  public function setUsId($fk_us_id) {
    $this->fk_us_id = $fk_us_id;
  }

  public function getEliminado() {
    return $this->comentario_eliminado;
  }

  public function setEliminado($comentario_eliminado) {
    $this->comentario_eliminado = $comentario_eliminado;
  }

  //Funciones de base de datos 
  
  public function save($comentario) {
    $stmt = $this->db->prepare("INSERT INTO comentarios values ('',?,?,?,?,?,?,'0')");
    $stmt->execute(array($comentario->getTitulo(), $comentario->getTexto(),$comentario->getAutor(),
      $comentario->getValoracion(),$comentario->getProductoId(),$comentario->getUsId()));  
  }

  public function getComentarios($fk_producto_id){
    $stmt = $this->db->prepare("SELECT * FROM comentarios WHERE fk_producto_id=? AND comentario_eliminado != '1'");  
    $stmt -> execute(array($fk_producto_id));
    $comentario_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_comentario=array();
    foreach($comentario_db as $comentario){
      array_push($array_comentario, new Comentario($comentario["comentario_id"], 
        $comentario["comentario_titulo"], $comentario["comentario_texto"],$comentario["comentario_autor"],
        $comentario["comentario_valoracion"], $comentario["fk_producto_id"],$comentario["fk_us_id"]));
    }
    if(!empty($array_comentario))
      return $array_comentario;
    else
      return NULL;
  }

  public function obtenerUsId($us_email){
    $stmt = $this->db->prepare("SELECT us_id FROM usuarios WHERE us_email = ?");
    $stmt->execute(array($us_email));

    $us_id = $stmt->fetch(PDO::FETCH_ASSOC);

    return $us_id["us_id"];
  } 

  public function obtenerAutor($us_email){
    $stmt = $this->db->prepare("SELECT us_username FROM usuarios WHERE us_email = ?");
    $stmt->execute(array($us_email));

    $autor = $stmt->fetch(PDO::FETCH_ASSOC);

    return $autor["us_username"];
  } 

  public function comprobarAutor($comentario_id,$us_email){
    $stmt = $this->db->prepare("SELECT count(*) 
                                FROM comentarios as C, usuarios as U
                                WHERE U.us_id=C.fk_us_id and C.comentario_id=? 
                                and us_email=?");
    $stmt->execute(array($comentario_id,$us_email));

    if ($stmt->fetchColumn() > 0)
      return true;
  }

  public function esAdmin($us_email){
    $stmt = $this->db->prepare("SELECT count(us_email) FROM usuarios where us_email=? and us_rol='3'");
    $stmt->execute(array($us_email));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }

  public function bajaComentario($comentario_id, $fk_us_id){
    $stmt = $this->db->prepare("UPDATE comentarios set comentario_eliminado = '1' 
                                WHERE comentario_id = ? AND fk_us_id = ?");
    $stmt->execute(array($comentario_id, $fk_us_id));

    return true;

  } 

  public function modificarComentario($comentario,$comentario_id) {
    $stmt = $this->db->prepare("UPDATE comentarios SET comentario_titulo=?, comentario_valoracion=?, comentario_texto=?
                                WHERE comentario_id = ?");
    $stmt->execute(array($comentario->getTitulo(), $comentario->getValoracion(),$comentario->getTexto(),
                          $comentario_id)); 

    return true; 
  }


}