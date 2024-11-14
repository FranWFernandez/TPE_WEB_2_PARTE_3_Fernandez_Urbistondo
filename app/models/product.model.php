<?php

class ProductModel extends DB {

    public function getProducts($filter = false, $paginado = false, $orden = false) {
        $sql = 'SELECT * FROM alimentos';

        if($filter) {
            switch($filter) {
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

        if ($orden) {
            switch ($orden) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre ASC';
                    break;
                case 'valor':
                    $sql .= ' ORDER BY valor ASC';
                    break;
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

    public function filter($id) {
        $query = $this->connect()->prepare('SELECT * FROM alimentos WHERE id_producto = ?');
        $query->execute([$id]);

        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
}