<?php
//file: controller/ProductoController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/Producto.php");
require_once(__DIR__."/../model/Comentario.php");
require_once(__DIR__."/../controller/BaseController.php");

class ProductoController extends BaseController {
  private $producto;   

  public function __construct() {    
    parent::__construct();
    $this->producto = new Producto();
    $this->comentario = new Comentario();
	
  }

  public function listarProductos(){
    if (isset($_GET["filtro"])){
      $productos = $this->producto->getProductos($_GET["filtro"]);
      $this->view->setVariable("indice", $_GET["filtro"]);
    }
    else{
      $productos = $this->producto->getTodosProductos();
    }

    $categorias = $this->producto->getCategorias();
    $this->view->setVariable("productos", $productos);
    $this->view->setVariable("categorias", $categorias);
    $this->view->render("productos","listarproductos");
  }

  public function listarProductoModalidad(){
    $modalidad=$_GET["modalidad"];
    $productos = $this->producto->getProductoModalidad($modalidad);
    $categorias = $this->producto->getCategorias();
    $this->view->setVariable("productos", $productos);
    $this->view->setVariable("categorias", $categorias);
    $this->view->setVariable("indice", $modalidad);
    $this->view->render("productos","listarproductos");
  }

  public function listarProductoCategoria(){
    $categoria=$_GET["categoria"];
    $productos = $this->producto->getProductoCategoria($categoria);
    $categorias = $this->producto->getCategorias();
    $this->view->setVariable("productos", $productos);
    $this->view->setVariable("categorias", $categorias);
    $this->view->setVariable("indice", $categoria);
    $this->view->render("productos","listarproductos");
  }


  public function listarProductosTienda(){
    $nif=$_GET["id"];
    $productos = $this->producto->getProductos($nif);
    $categorias = $this->producto->getCategorias();
    $this->view->setVariable("productos", $productos);
    $this->view->setVariable("categorias", $categorias);
    $this->view->render("productos","listarproductos");
  }

  public function detallesProducto(){
    $id_producto=$_GET["id"];
    $producto = $this->producto->getDetallesProducto($id_producto);
    $comentarios = $this->comentario->getComentarios($id_producto);
    $categorias = $this->producto->getCategorias();

    $this->view->setVariable("producto", $producto);
    $this->view->setVariable("comentarios", $comentarios);
    $this->view->setVariable("categorias", $categorias);
    $this->view->render("productos","detallesproducto");
  }

  public function listarMisProductos(){
    if (isset($_SESSION["currentuser"])){
      $nif=$this->producto->obtenerNif($_SESSION["currentuser"]);
      $productos = $this->producto->getProductos($nif);
      $this->view->setVariable("productos", $productos);
      $this->view->render("productos","misproductos");
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  

  public function altaProducto() {
    $errors="";
    if (isset($_SESSION["currentuser"])){
      if (isset($_POST["producto_nombre"])){ // reaching via HTTP Post...
          
          $producto_nif=$this->producto->obtenerNif($_SESSION["currentuser"]);
          $new_producto = new Producto();

          $new_producto->setNombre($_POST["producto_nombre"]);
          $new_producto->setModalidad($_POST["producto_modalidad"]);
          $new_producto->setCategoria($_POST["producto_categoria"]);
          $new_producto->setDescripcion($_POST["producto_descripcion"]);
          $new_producto->setPrecio($_POST["producto_precio"]);
          $new_producto->setCantidad($_POST["producto_cantidad"]);
          $new_producto->setNuevo($_POST["producto_nuevo"]);
          $new_producto->setNif($producto_nif);

          $target_dir = "css/images/";
          $target_file = $target_dir . basename($_FILES["producto_foto"]["name"]);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["producto_foto"]["tmp_name"]);
          if($check !== false) {
              $uploadOk = 1;
          } else {
              $uploadOk = 0;
          }
          // Check file size
          if ($_FILES["producto_foto"]["size"] > 500000) {
              $errors = $errors. "Lo sentimos tu imagen es muy grande, tamaño maximo permitido 1MB.</br>";
              $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
              $errors = $errors. "Unicamente archivos JPG, JPEG, PNG & GIF estan permitidos.</br>";
              $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $errors = $errors. "Tu archivo no se ha subido.";
          } else {
              if (move_uploaded_file($_FILES["producto_foto"]["tmp_name"], $target_file)) {
                  //echo "The file ". basename( $_FILES["producto_foto"]["name"]). " has been uploaded.";
                  $new_producto->setFoto($target_file);
                  $this->producto->save($new_producto,$producto_nif);
                  $this->view->redirect("producto","listarMisProductos");
              } else {
                   $errors = $errors. "Lo sentimos, se ha producido un error, intentalo de nuevo";
              }
          }
          $this->view->setVariable("errors",$errors);
          $this->view->render("productos","altaproducto");
        }
      else
        $this->view->render("productos","altaproducto");
    }
    else
      $this->view->redirect("usuario","acceso");
  }

  public function modificarProducto() {
    if (isset($_SESSION["currentuser"])){
      if (isset($_POST["producto_nombre"])){ // reaching via HTTP Post...
          
          $new_producto = new Producto();

          $new_producto->setNombre($_POST["producto_nombre"]);
          $new_producto->setModalidad($_POST["producto_modalidad"]);
          $new_producto->setCategoria($_POST["producto_categoria"]);
          $new_producto->setDescripcion($_POST["producto_descripcion"]);
          $new_producto->setPrecio($_POST["producto_precio"]);
          $new_producto->setCantidad($_POST["producto_cantidad"]);
          $new_producto->setFoto($_POST["producto_foto"]);
          $new_producto->setNuevo($_POST["producto_nuevo"]);

          $this->producto->modificarProducto($new_producto,$_POST["producto_id"]);
          $this->view->setFlash("Datos modificados correctamente.");
          $this->view->redirect("producto","listarMisProductos");
        }
      else
        $id_producto=$_GET["id"];
        $producto = $this->producto->getDetallesProducto($id_producto);
        $this->view->setVariable("producto", $producto);
        $this->view->render("productos","modificarproducto");
    }
    else
      $this->view->redirect("usuario","acceso");
  }

  public function bajaProducto(){
    if (isset($_SESSION["currentuser"])){
      $nif=$this->producto->obtenerNif($_SESSION["currentuser"]);
      $this->producto->bajaProducto($_GET["id"],$nif);
      $this->view->setFlash("Producto eliminado");
      $this->view->redirect("producto","listarMisProductos");

    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function altaComentario(){
    if (isset($_SESSION["currentuser"])){
      
      $nif=$this->comentario->obtenerNif($_SESSION["currentuser"]);
      $autor=$this->comentario->obtenerAutor($_SESSION["currentuser"]);

      $new_comentario = new Comentario();

      $new_comentario->setTitulo($_POST["titulo"]);
      $new_comentario->setValoracion($_POST["valoracion"]);
      $new_comentario->setTexto($_POST["texto"]);
      $new_comentario->setProductoID($_GET["id"]);
      $new_comentario->setNif($nif);
      $new_comentario->setAutor($autor);

      $new_comentario->save($new_comentario);
      $this->view->setFlash("Comentario guardado");
      $this->view->redirect("producto","detallesproducto","id=".$_GET["id"]);
    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }

  public function bajaComentario(){
    if (isset($_SESSION["currentuser"])){
      $nif=$this->comentario->obtenerNif($_SESSION["currentuser"]);
      $this->comentario->bajaComentario($_GET["idComentario"],$nif);
      $this->view->setFlash("Comentario eliminado");
      $this->view->redirect("producto","detallesproducto","id=".$_GET["idProducto"]);

    }
    else{
      $this->view->render("usuario", "acceso");
    }
  }
  

  public function modificarComentario() {
    if (isset($_SESSION["currentuser"])){
      if (isset($_POST["comentario_id"])){ // reaching via HTTP Post...
          
        $new_comentario = new Comentario();

        $new_comentario->setTitulo($_POST["mod_titulo"]);
        $new_comentario->setValoracion($_POST["valoracion"]);
        $new_comentario->setTexto($_POST["mod_texto"]);

        $new_comentario->modificarcomentario($new_comentario,$_POST["comentario_id"]);
        $this->view->setFlash("Comentario modificado");
        $this->view->redirect("producto","detallesproducto","id=".$_GET["id"]);
        }
      else
        $this->view->redirect("usuario","acceso");
    }
    else
      $this->view->redirect("usuario","acceso");
  }


}

?>
  
