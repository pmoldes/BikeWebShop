<?php
//file: controller/InteresController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/Interes.php");
require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Producto.php");
require_once(__DIR__."/../model/Email.php");
require_once(__DIR__."/../controller/BaseController.php");

class InteresController extends BaseController {
  private $interes;
  //date_default_timezone_set('Europe/Madrid');

	public function __construct() {    
		parent::__construct();
		$this->interes = new Interes();
		$this->usuario = new Usuario();
		$this->producto = new Producto();
	}
	
  public function mostrarInteres(){
    if(!isset($_SESSION["currentuser"])){
    	$errors = array();
    	$errors["intereslogin"] = "Tienes que estar registrado para mostrar interés";
      	$this->view->setVariable("errors", $errors);
    }
    else if(!isset($_SESSION["carrito"])){
			    	$errors = array();
			    	$errors["interescarrito"] = "Tienes que tener productos en el carrito para mostrar interés";
		        $this->view->setVariable("errors", $errors);
		        $this->view->redirect("producto", "verCarrito");
    			}
		    	else{
			    	$idComprador = $this->usuario->obtenerIDbyEmail($_SESSION["currentuser"]);
			    	$productos = $_SESSION['carrito'];
            $comprador = $this->usuario->consultarUsuarioByID($idComprador);
			    	foreach ($productos as $prod) {
			    		$idVendedor = $this->producto->obtenerUsuarioIdByProductoId($prod["id"]);
              $vendedor = $this->usuario->consultarUsuarioByID($idVendedor);

				    	$newInteres = new Interes();
				    	$newInteres->setPrecio($prod["precio"]);
				    	$newInteres->setFecha(date("Ymd"));
				    	$newInteres->setProductoID($prod["id"]);
				    	$newInteres->setCompradorID($idComprador);
				    	$newInteres->setVendedorID($idVendedor);

				    	$this->interes->save($newInteres);

              $email = new Email();
              $email->setComprador($comprador);
              $email->setVendedor($vendedor);
              $email->setProducto($prod);

				    	$email->enviarEmailMuestraInteresComprador();
              $email->enviarEmailMuestraInteresVendedor();

	      			$this->view->setFlash("Has mostrado interés por los productos");
				    	unset($_SESSION['carrito']);
				    	$this->view->redirect("interes", "consultarInteresComprador");
			    	}
		    	}
  }

  public function consultarInteresComprador(){
    if (isset($_SESSION["currentuser"])){
      $us_id=$this->producto->obtenerUsID($_SESSION["currentuser"]);
      $intereses = $this->interes->obtenerInteresbyComprador($us_id);
      $this->view->setVariable("intereses", $intereses);
      $this->view->render("interes","misintereses");
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function consultarInteresVendedor(){
    if (isset($_SESSION["currentuser"])){
      $us_id=$this->producto->obtenerUsID($_SESSION["currentuser"]);
      $intereses = $this->interes->obtenerInteresbyVendedor($us_id);
      $this->view->setVariable("intereses", $intereses);
      $this->view->render("interes","misintereses");
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function eliminarInteres(){
  	if ( isset($_SESSION["currentuser"]) && isset($_GET["int"]) ){
  		$us_id=$this->usuario->obtenerIDbyEmail($_SESSION["currentuser"]);
  		$interesToDelete = $this->interes->obtenerInteresbyId($_GET["int"]);


  		if ( $interesToDelete->getCompradorID() == $us_id ) { //Si esta eliminando el comprador
        $comprador = $this->usuario->consultarUsuarioByID($us_id);
        $vendedor = $this->usuario->consultarUsuarioByID( $interesToDelete->getVendedorID() );
        $prod = $this->producto->getDetallesProducto( $interesToDelete->getProductoID() );

  			
        $this->interes->eliminarInteres( $interesToDelete->getId() );
  			
        $email = new Email();
        $email->setComprador($comprador);
        $email->setVendedor($vendedor);
        $email->setObjProducto($prod[0]);  

        $email->enviarEmailEliminarInteresbyComprador();

  			$this->view->setFlash("Has eliminado el interés por el producto");
  			$this->view->redirect("interes","consultarInteresComprador");
  		}
  		else if ( $interesToDelete->getVendedorID() == $us_id ) { //Si esta eliminando el vendedor
        $vendedor = $this->usuario->consultarUsuarioByID($us_id);
        $comprador = $this->usuario->consultarUsuarioByID( $interesToDelete->getVendedorID() );
        $prod = $this->producto->getDetallesProducto( $interesToDelete->getProductoID() );

  			$this->interes->eliminarInteres( $interesToDelete->getId() );
  			
        $email = new Email();
        $email->setComprador($comprador);
        $email->setVendedor($vendedor);
        $email->setObjProducto($prod[0]);

        $email->enviarEmailEliminarInteresbyVendedor();

  			$this->view->setFlash("Has eliminado el interés del comprador por el producto");
  			$this->view->redirect("interes","consultarInteresVendedor");
  		}

  	}
  	else
      $this->view->render("usuario", "acceso");
  }

  


}
?>