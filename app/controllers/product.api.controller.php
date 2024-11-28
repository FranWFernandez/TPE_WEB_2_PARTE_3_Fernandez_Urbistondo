<?php
require_once './app/models/product.model.php';
require_once './app/views/json.view.php';

class ProductApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ProductModel;
        $this->view = new JSONView;
        
    }

    public function setOrden(){
        //para hacer el orden
        if(isset($_GET['Orden'])){
            $Orden=$_GET['Orden'];
            return $Orden;
        }

    }
    public function setFiltro(){
        if(isset($_GET['Filtro'])){
            $campo=$_GET['Filtro'];
            return $campo;
        }
    }
    public function variableOrden(){
        if(isset($_GET['Sort'])){
            $variableorden=$_GET['Sort'];
            return $variableorden;
        }
    }
    public function setPaginado() {
        if(isset($_GET['Pagina'])) {
            $pagina = $_GET['Pagina'];
            return $pagina;
        }
    }

    public function getAll($req, $res) {
        $getParametro=[];
            $filtro=$this->setFiltro();
            $order = $this->setOrden();
            $pagina = $this->setPaginado();
            $variableorden = $this->variableOrden();

            if(!empty($filtro)) {
                $getParametro['Filtro'] = $filtro;
            }
            if(!empty($order)) {
                $getParametro['Orden'] = $order;
            }
            if(!empty($variableorden)) {
                $getParametro['Sort'] = $variableorden;
            }
            if(!empty($pagina)) {
                $getParametro['Pagina'] = $pagina;
            }
            

            $productos=$this->model->getProducts($getParametro);

            if($productos) {
                $this->view->response($productos,200);
            } else {
                $this->view->response("no existe", 404);
            }
    }

    public function getProductById($req, $res) {
        $id = $req->params->id;
        $product = $this->model->getProductById($id);

        if(!$product) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }

        return $this->view->response($product);
    }


    public function delete($req, $res) {
        if(!$res->user) {
            return $this->view->response('Usuario inexistente');
        }
        $id = $req->params->id;
        $product = $this->model->getProductById($id);
        
        if(!$product) {
            return $this->view->response("El producto con el id=$id, no existe.", 404);
        }
        
        $this->model->eraseProduct($id);
        $this->view->response("El producto con el id=$id fue eliminado con exito.");
    }

    public function create($req, $res) {
        if(!$res->user) {
            return $this->view->response('Usuario inexistente');
        }
        if(empty($req->body->nombre) || empty($req->body->valor) || empty($req->body->id_producto)) {
            return $this->view->response("Faltan completar datos", 400);
        }

        $nombre = $req->body->nombre;
        $descripcion = $req->body->descripcion;
        $valor = $req->body->valor;
        $tipo = $req->body->id_producto;

        

        $id = $this->model->addProduct($nombre, $descripcion, $valor, $tipo);
        
        if($id) {
            $product = $this->model->getProductById($id);
            $this->view->response($product, 201);    
        }else{
            return $this->view->response("Error al insertar el producto", 500);
        }
    }

    public function update($req, $res) {
        if(!$res->user) {
            return $this->view->response('Usuario inexistente');
        }
        $id = $req->params->id;
        $producto = $this->model->getProductById($id);

        if(!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }

        if(empty($req->body->nombre) || empty($req->body->valor) || empty($req->body->id_producto)) {
            return $this->view->response("Faltan completar datos", 400);
        }

        $nombre = $req->body->nombre;
        $descripcion = $req->body->descripcion;
        $valor = $req->body->valor;
        $tipo = $req->body->id_producto;

        $this->model->updateProduct($id, $nombre, $descripcion, $valor, $tipo);
     
        $producto = $this->model->getProductById($id);
        $this->view->response($producto);
    }

}