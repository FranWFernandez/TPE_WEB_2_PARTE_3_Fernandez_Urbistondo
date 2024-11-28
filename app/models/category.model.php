<?php

class CategoryModel extends DB {

    public function getCategories($getParametro) {
        $sql = 'SELECT * FROM productos';

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
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    public function getCategoryById($id) {
        $query = $this->connect()->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);

        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category;
    }

    public function eraseCategory($id) {
        $query = $this->connect()->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
    }

    public function addCategory($nombre) {
        $query = $this->connect()->prepare('INSERT INTO productos(nombre) VALUE(?)');
        $query->execute([$nombre]);
    
        $id = $this->connect()->lastInsertId();
        return $id;
    }

    public function updateCategory($id, $nombre) {
        $query = $this->connect()->prepare('UPDATE productos SET nombre = ? WHERE id_producto = ?');
        $query->execute([$nombre,  $id]);
    }
}