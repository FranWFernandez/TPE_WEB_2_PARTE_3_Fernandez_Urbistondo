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

        public function getAllCategories($req, $res) {

            $orden = false;
            if(isset($req->query->orden)){
                $orden = $req->query->orden;
            }
            
            $categorias  = $this->model->getCategories($orden);
            $this->view->response($categorias);
        }

        public function getCategoryById($req, $res) {
            $id = $req->params->id;
            $category = $this->model->getCategoryById($id);

            if (!$category) {
                return $this->view->response("La categoria con el id=$id no existe", 404);
            }
            return $this->view->response($category);
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