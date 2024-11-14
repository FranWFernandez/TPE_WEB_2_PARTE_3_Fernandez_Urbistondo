<?php

class CategoryModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tpe_web_2;charset=utf8', 'root', '');
    }

    public function categoryAll() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
}