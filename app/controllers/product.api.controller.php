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

    public function getAll($req, $res) {
        $orderBy = false;
        if(isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }

       $paginado = false;
        if(isset($req->query->paginado)) {
             $paginado = $req->query->paginado;
        }
        $products  = $this->model->getProducts($orderBy, $paginado);

        $this->view->response($products);
    }

    public function get($req, $res) {
        
        $id = $req->params->id;
        $product = $this->model->getProduct($id);

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
        $product = $this->model->getProduct($id);
        
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
            $product = $this->model->getProduct($id);
            $this->view->response($product, 201);    
        }else{
            return $this->view->response("Error al insertar la tarea", 500);
        }
    }

    public function update($req, $res) {
        if(!$res->user) {
            return $this->view->response('Usuario inexistente');
        }
        $id = $req->params->id;
        $producto = $this->model->getProduct($id);

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
     
        $producto = $this->model->getProduct($id);
        $this->view->response($producto);
    }

    public function getCategory($req, $res) {
        $id = $req->params->id;

        $productos = $this->model->filter($id);
        $this->view->response($productos, 200);
    }
}