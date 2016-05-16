<?php
//file: controller/TiendaController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/Tienda.php");
require_once(__DIR__."/../controller/BaseController.php");

class TiendaController extends BaseController {
  private $tienda;   

  public function __construct() {    
    parent::__construct();
    $this->tienda = new Tienda();
	
  }

  public function miTienda(){
    if(!isset($_SESSION["currentuser"]))
      $this->view->render("usuario", "acceso");
    else{
      $us_id=$this->tienda->obtenerID($_SESSION["currentuser"]);//obtener id a partir del email
      if(!$this->tienda->existeTienda($us_id))
        $this->view->render("tienda", "altatienda");
      else
        $ti_datos = $this->tienda->consultarTienda($us_id);
        $this->view->setVariable("ti_datos",$ti_datos);
        $this->view->render("tienda", "mitienda");
    }

  }

  public function altaTienda() {
    if (isset($_SESSION["currentuser"])){
      $newTienda = new Tienda();
      $us_id=$this->tienda->obtenerID($_SESSION["currentuser"]);//obtener id a partir del email
      $errors = array();
      
      if (isset($_POST["nombre"])){ // reaching via HTTP Post...
        $newTienda->setNombre($_POST["nombre"]);
        $newTienda->setDireccion($_POST["direccion"]);
        $newTienda->setTelefono($_POST["telefono"]);
        $newTienda->setEmail($_POST["correo"]);
        $newTienda->setusID($us_id);
        
        $this->tienda->save($newTienda);
        $this->view->setFlash("Tienda añadida correctamente");
        $this->view->redirect("tienda","miTienda");
      }
      $this->view->render("tienda","altatienda"); 
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }


   public function modificarTienda(){

    $tienda = new Tienda();

    if( isset($_SESSION["currentuser"]) && isset($_POST["nombre"]) ){
      $us_id=$this->tienda->obtenerID($_SESSION["currentuser"]);//obtener id a partir del email

      $tienda->setNombre($_POST["nombre"]);
      $tienda->setDireccion($_POST["direccion"]);
      $tienda->setTelefono($_POST["telefono"]);
      $tienda->setEmail($_POST["correo"]);

      $this->tienda->modificarTienda($tienda,$us_id);
      $this->view->setFlash("Datos modificados correctamente");
      $this->view->redirect("tienda","mitienda");
    }else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function bajaTienda(){
    if (isset($_SESSION["currentuser"])){
      $us_id=$this->tienda->obtenerID($_SESSION["currentuser"]);//obtener id a partir del email
      if($this->tienda->existeTienda($us_id)){
        $this->tienda->bajaTienda($us_id);
        $this->view->setFlash("Tienda eliminada correctamente");
        $this->view->redirect("usuario", "micuenta");
      }
      else{
        $errors["bajatienda"] = "Actualmente no tienes ninguna tienda";
        $this->view->setVariable("errors", $errors);
        $this->view->render("tienda","mitienda");
      }
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function listarTiendas(){
    $tiendas = $this->tienda->getTiendas();
    $this->view->setVariable("tiendas", $tiendas);
    $this->view->render("tienda","listartiendas");
  }
}