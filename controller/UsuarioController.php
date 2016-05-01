<?php
//file: controller/UsuarioController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Producto.php");
require_once(__DIR__."/../controller/BaseController.php");

class UsuarioController extends BaseController {
  private $usuario, $producto;  

  public function __construct() {    
    parent::__construct();
    $this->usuario = new Usuario(); 
    $this->producto = new Producto();
	
  }

  public function home(){
    $this->view->setlayout('default');
    $categorias = $this->producto->getCategorias();
    $populares = $this->producto->getProductosPopulares();
    $this->view->setVariable("populares", $populares);
    $this->view->setVariable("categorias", $categorias);
    $this->view->render("usuario", "home"); 
  }

  public function about(){
    $this->view->setlayout('default');
    $categorias = $this->producto->getCategorias();
    $populares = $this->producto->getProductosPopulares();
    $this->view->render("usuario", "about"); 
  }


  public function miCuenta(){
    if(!isset($_SESSION["currentuser"]))
      $this->view->render("usuario", "acceso");
    else{
      if($this->usuario->esTienda($_SESSION["currentuser"]))
        $this->view->render("usuario", "micuentatienda");
      else
        $this->view->render("usuario", "micuenta");
    }
  }


  public function acceso() {
     if (isset($_POST["correo"])){  
      //if ($this->usuario->isValidUser($_POST["correo"], $_POST["contra"])) {
      $hash_pass = $this->usuario->getPass($_POST["correo"]);
      $check = password_verify($_POST["contra"], $hash_pass);
      if ($check) {
          $_SESSION["currentuser"]=$_POST["correo"];
          $this->view->setFlash("Login correcto!");
          $this->view->redirect("usuario","miCuenta");   
      }else{
        $errors = array();
        $errors["general"] = "Datos de acceso no validos";
        $this->view->setVariable("errors", $errors);
        }
    }
    $this->view->render("usuario","acceso");
  }

  public function logout() {
    session_destroy();
    $this->view->redirect("usuario","home");   

  }
 
 
  public function registro() {
    
    $user = new Usuario();
    $valid=true;
    $errors = array();

    if (isset($_POST["correo"])){ // reaching via HTTP Post...
      

      //Comprobamos si existe el email y username
      if($this->usuario->emailExists($_POST["correo"])){
        $errors["email"] = "El email ya existe";
        $this->view->setVariable("errors", $errors);
        $valid=false;
      }

      if($this->usuario->usernameExists($_POST["username"])){
        $errors["username"] = "El nombre de usuario ya existe";
        $this->view->setVariable("errors", $errors);
        $valid=false;
      }
      
      
      //Si no existe ningun usuario con esos datos lo creamos
      if($valid){
        $user->setEmail($_POST["correo"]);
        $user->setUsername($_POST["username"]);
        $user->setPassword(password_hash($_POST["contra"], PASSWORD_DEFAULT));
        $user->setNombre($_POST["nombre"]);
        $user->setApellidos($_POST["apellidos"]);
        $user->setDireccion($_POST["direccion"]);
        $user->setCP($_POST["cp"]);
        $user->setTelefono($_POST["telefono"]);

  		  $this->usuario->save($user);
  		 
  		  $this->view->setFlash("Tu usuario se ha creado correctamente, ya puedes acceder.");
        $this->view->redirect("usuario","miCuenta");
      }
    }
   
    $this->view->render("usuario","registro");
  }


  public function bajaUsuario(){
    if (isset($_SESSION["currentuser"])){
      if($this->usuario->bajaUsuario($_SESSION["currentuser"]))
        $this->view->setFlash("Tu cuenta se ha dado de baja correctamente");
        $this->view->redirect("usuario", "logout");
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function consultarUsuario(){
    if (isset($_SESSION["currentuser"])){
        $us_datos = $this->usuario->consultarUsuario($_SESSION["currentuser"]);
        $this->view->setVariable("us_datos",$us_datos);
        $this->view->setVariable("errors", $errors);
        $this->view->render("usuario", "misdatos");
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function modificarUsuario(){

    $user = new Usuario();

    if( isset($_SESSION["currentuser"]) && isset($_POST["correo"]) ){
        $us_id = $this->usuario->obtenerIDbyEmail($_SESSION["currentuser"]);
        if($this->usuario->emailModificar($us_id,$_POST["correo"])){
          $errors["email"] = "El email ya existe";
          $us_datos = $this->usuario->consultarUsuario($_SESSION["currentuser"]);
          $this->view->setVariable("us_datos",$us_datos);
          $this->view->setVariable("errors", $errors);
          $this->view->render("usuario", "misdatos");
        }else{
          $user->setEmail($_POST["correo"]);
          $user->setUsername($_POST["username"]);
          $user->setPassword(password_hash($_POST["contra"], PASSWORD_DEFAULT));
          $user->setNombre($_POST["nombre"]);
          $user->setApellidos($_POST["apellidos"]);
          $user->setDireccion($_POST["direccion"]);
          $user->setCP($_POST["cp"]);
          $user->setTelefono($_POST["telefono"]);

          $this->usuario->modificarUsuario($user,$_SESSION["currentuser"]);
          $_SESSION["currentuser"] = $_POST["correo"];
          $this->view->setFlash("Datos modificados correctamente");
          $this->view->redirect("usuario","consultarUsuario");
        }
        $this->view->setFlash("Datos modificados correctamente");
    
    }else{
      $this->view->render("usuario", "acceso");
    }
  }


}
  
