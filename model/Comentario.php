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
  private $producto_id;
  private $us_nif;
  private $comentario_eliminado;
  

  //constructor
   
  public function __construct($comentario_id=NULL, $comentario_titulo=NULL, $comentario_texto=NULL,
                              $comentario_autor=NULL,$comentario_valoracion=NULL,$producto_id=NULL, 
                              $us_nif=NULL,$comentario_eliminado=NULL) {
	   $this->db = PDOConnection::getInstance();
    
     $this->comentario_id = $comentario_id;
     $this->comentario_titulo = $comentario_titulo;
     $this->comentario_texto = $comentario_texto;
     $this->comentario_autor = $comentario_autor;
     $this->comentario_valoracion = $comentario_valoracion;
     $this->producto_id = $producto_id; 
     $this->us_nif = $us_nif; 
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
    return $this->producto_id;
  }

  public function setProductoId($producto_id) {
    $this->producto_id = $producto_id;
  }

  public function getNif() {
    return $this->us_nif;
  }

  public function setNif($us_nif) {
    $this->us_nif = $us_nif;
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
      $comentario->getValoracion(),$comentario->getProductoId(),$comentario->getNif()));  
  }

  public function getComentarios($producto_id){
    $stmt = $this->db->prepare("SELECT * FROM comentarios WHERE producto_id=? AND comentario_eliminado != '1'");  
    $stmt -> execute(array($producto_id));
    $comentario_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $array_comentario=array();
    foreach($comentario_db as $comentario){
      array_push($array_comentario, new Comentario($comentario["comentario_id"], 
        $comentario["comentario_titulo"], $comentario["comentario_texto"],$comentario["comentario_autor"],
        $comentario["comentario_valoracion"], $comentario["producto_id"],$comentario["us_nif"]));
    }
    if(!empty($array_comentario))
      return $array_comentario;
    else
      return NULL;
  }

  public function obtenerNif($us_email){
    $stmt = $this->db->prepare("SELECT us_nif FROM usuarios WHERE us_email = ?");
    $stmt->execute(array($us_email));

    $nif = $stmt->fetch(PDO::FETCH_ASSOC);

    return $nif["us_nif"];
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
                                WHERE U.us_nif=C.us_nif and C.comentario_id=? and us_email=?");
    $stmt->execute(array($comentario_id,$us_email));

    if ($stmt->fetchColumn() > 0)
      return true;
  }

  public function bajaComentario($comentario_id, $us_nif){
    $stmt = $this->db->prepare("UPDATE comentarios set comentario_eliminado = '1' 
                                WHERE comentario_id = ? AND us_nif = ?");
    $stmt->execute(array($comentario_id, $us_nif));

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