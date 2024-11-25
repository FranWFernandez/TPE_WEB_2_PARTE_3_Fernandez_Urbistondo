<?php
require_once 'model.php';

class ProductModel extends DB {

    public function getProducts($getParametro) {
        $sql = 'SELECT * FROM alimentos';

        if (!empty($getParametro['Filtro'])){
            $sql .=' WHERE '.$getParametro['Filtro'];   
        }
        if (!empty($getParametro['Sort'])){
            $sql .=' ORDER BY '.$getParametro['Sort'];
            if (!empty($getParametro['Orden'])) {
                $sql .= ' '.$getParametro['Orden'];
            }
        }

        $query = $this->connect()->prepare($sql);
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getProductById($id) {
        $query = $this->connect()->prepare('SELECT * FROM alimentos WHERE id_alimento = ?');
        $query->execute([$id]);

        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    public function eraseProduct($id) {
        $query = $this->connect()->prepare('DELETE FROM alimentos WHERE id_alimento = ?');
        $query->execute([$id]);
    }

    public function addProduct($nombre, $descripcion, $valor, $tipo) {
        $query = $this->connect()->prepare('INSERT INTO alimentos(nombre, descripcion, valor, id_producto) VALUE(?,?,?,?)');
        $query->execute([$nombre, $descripcion, $valor, $tipo]);
    
        $id = $this->connect()->lastInsertId();
        return $id;
    }

    public function updateProduct($id, $nombre, $descripcion, $valor, $tipo) {
        $query = $this->connect()->prepare('UPDATE alimentos SET nombre = ?, descripcion = ?, valor = ?, id_producto  = ? WHERE id_alimento = ?');
        $query->execute([$nombre, $descripcion, $valor, $tipo, $id]);
    }
}