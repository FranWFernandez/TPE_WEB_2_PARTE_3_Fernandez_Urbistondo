<?php

class ProductModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tpe_web_2;charset=utf8', 'root', '');
    }

    public function getProducts($orderBy = false, $paginado = false) {
        $sql = 'SELECT * FROM alimentos';

        if($orderBy) {
            switch($orderBy) {
                case 'valor':
                    $sql .= ' ORDER BY valor ASC';
                    break;
                case 'entradas':
                    $sql .= ' WHERE id_producto = 1';
                    break;
                case 'principales':
                    $sql .= ' WHERE id_producto = 2';
                    break;
                case 'postres':
                    $sql .= ' WHERE id_producto = 3';
                    break;
                case 'gaseosas':
                    $sql .= ' WHERE id_producto = 4';
                    break;
                case 'alcohol':
                     $sql .= ' WHERE id_producto = 5';
                    break;
            }
        }

        if($paginado) {
            switch($paginado) {
                case '1':
                    $sql .= ' LIMIT 5 OFFSET 0';
                    break;
                case '2': 
                    $sql .= ' LIMIT 5 OFFSET 5';
                    break;
                case '3':
                    $sql .= ' LIMIT 5 OFFSET 10';
                    break; 
            }
            
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getProduct($id) {
        $query = $this->db->prepare('SELECT * FROM alimentos WHERE id_alimento = ?');
        $query->execute([$id]);

        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    public function eraseProduct($id) {
        $query = $this->db->prepare('DELETE FROM alimentos WHERE id_alimento = ?');
        $query->execute([$id]);
    }

    public function addProduct($nombre, $descripcion, $valor, $tipo) {
        $query = $this->db->prepare('INSERT INTO alimentos(nombre, descripcion, valor, id_producto) VALUE(?,?,?,?)');
        $query->execute([$nombre, $descripcion, $valor, $tipo]);
    
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function updateProduct($id, $nombre, $descripcion, $valor, $tipo) {
        $query = $this->db->prepare('UPDATE alimentos SET nombre = ?, descripcion = ?, valor = ?, id_producto  = ? WHERE id_alimento = ?');
        $query->execute([$nombre, $descripcion, $valor, $tipo, $id]);
    }

    public function filter($id) {
        $query = $this->db->prepare('SELECT * FROM alimentos WHERE id_producto = ?');
        $query->execute([$id]);

        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
}