<?php
    require_once './app/models/category.model.php';
    require_once './app/views/json.view.php';

    class CategoryApiController {
        
        private $model;
        private $view;

        public function __construct() {
            $this->model = new CategoryModel;
            $this->view = new JSONView;
        }

        public function setOrden(){
            //para hacer el orden
            if(isset($_GET['Orden'])){
                $Orden=$_GET['Orden'];
                return $Orden;
            }
    
        }
        public function variableOrden(){
            if(isset($_GET['Sort'])){
                $variableorden=$_GET['Sort'];
                return $variableorden;
            }
        }
        public function setFiltro(){
            if(isset($_GET['Filtro'])){
                $campo=$_GET['Filtro'];
                return $campo;
            }
        }
        

        public function getAllCategories($req, $res) {

            $getParametro=[];
            $filtro=$this->setFiltro();
            $order = $this->setOrden();
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
            
            $categorias=$this->model->getCategories($getParametro);

            if($categorias) {
                $this->view->response($categorias,200);
            } else {
                $this->view->response("no existe", 404);
            }
        }

        public function getCategoryById($req, $res) {
            $id = $req->params->id;
            $categoria = $this->model->getCategoryById($id);

            if(!$categoria) {
                return $this->view->response("La categoria con el id=$id no existe", 404);
            }

            return $this->view->response($categoria);  
        }

        public function delete($req, $res) {
            if(!$res->user) {
                return $this->view->response('Usuario inexistente');
            }
            $id = $req->params->id;
            $product = $this->model->getCategoryById($id);
            
            if(!$product) {
                return $this->view->response("La categoria con el id=$id, no existe.", 404);
            }
            
            $this->model->eraseCategory($id);
            $this->view->response("La categoria con el id=$id fue eliminado con exito.");
        }

        public function create($req, $res) {
            if(!$res->user) {
                return $this->view->response('Usuario inexistente');
            }
            if(empty($req->body->nombre)) {
                return $this->view->response("Faltan completar datos", 400);
            }
    
            $nombre = $req->body->nombre;
    
            $id = $this->model->addCategory($nombre);
            
            if($id) {
                $product = $this->model->getCategoryById($id);
                $this->view->response($product, 201);    
            }else{
                return $this->view->response("Error al insertar la categoria", 500);
            }
        }

        public function update($req, $res) {
            if(!$res->user) {
                return $this->view->response('Usuario inexistente');
            }
            $id = $req->params->id;
            $category = $this->model->getCategoryById($id);
    
            if(!$category) {
                return $this->view->response("La categoria con el id=$id no existe", 404);
            }
    
            if(empty($req->body->nombre)) {
                return $this->view->response("Faltan completar datos", 400);
            }
    
            $nombre = $req->body->nombre;
    
            $this->model->updateCategory($id, $nombre);
         
            $category = $this->model->getCategoryById($id);
            $this->view->response($category);
        }
    }