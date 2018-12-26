<?php
namespace Mini\Model;
use Mini\Core\Model;
use PDO;
class Product extends Model
{
    public function checkRepeat($table, $campo1, $campo2)
    {

        $prepare = $this->db->prepare("SELECT $campo1 FROM $table WHERE $campo1 = :fields");
        $prepare->bindParam(":fields", $campo2, PDO::PARAM_STR);

        $prepare->execute();
        $check = $prepare->fetchall(PDO::FETCH_ASSOC);

        if($check){
            return true;
        } else{
            return false;
        }

    }

    public function insert($table, $fields)
    {
        if(isset($table) || isset($fields)){
            $nulo = null;
            $prepare = $this->db->prepare("INSERT INTO $table(nombre, descripcion, fechaAlta, marca, idUsr, idCategoria, foto)
                                       VALUES(:nombre, :descripcion, CURRENT_TIME(), :marca, :idUsr, :idCategoria, :archivo)");

            $prepare->bindParam(':nombre', $fields['nombre'], PDO::PARAM_STR);
            $prepare->bindParam(':descripcion', $fields['descripcion'], PDO::PARAM_STR);
            $prepare->bindParam(':marca', $fields['marca'], PDO::PARAM_STR);
            $prepare->bindParam(':idUsr', $fields['idUsr'], PDO::PARAM_STR);
            $prepare->bindParam(':idCategoria', $fields['categoria'], PDO::PARAM_STR);
            $prepare->bindParam(':archivo', $fields['archivo'], PDO::PARAM_STR);



            $prepare->execute();
        }else{
            throw new Exception('Hay problemas con la BD');
        }



    }

    public function detailProduct($table, $campo1, $campo2)
    {
        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);

        $prepare->execute();

        return $prepare->fetchall(PDO::FETCH_ASSOC);

    }

//    public function checkRepeatUpdate($table, $campo1, $campo2, $idProduct)
//    {
//
//
//        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field");
//        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);
//
//
//        $prepare->execute();
//
//        $check = $prepare->fetch(PDO::FETCH_ASSOC);
//
//        $id = $check['id'];
//
//
//
//        if ($prepare->rowCount()){
//            if($id == $idProduct){
//                return true;
//            } else {
//                return false;
//            }
//        }else {
//            return true;
//        }

//    }

    public function checkRepeatUpdate($table, $campo1, $campo2, $idProduct)
    {


        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);


        $prepare->execute();

        $check = $prepare->fetch(PDO::FETCH_ASSOC);

        $id = $check['id'];



        if ($prepare->rowCount()){
            if($id == $idProduct){
                return true;
            } else {
                return false;
            }
        }else {
            return true;
        }

    }

    public function updateProduct($table, $datos)
    {
        if(isset($table) || isset($datos)){

            $prepare = $this->db->prepare("UPDATE $table SET nombre=:nombre, descripcion=:descripcion, marca=:marca, 
                                                      idCategoria=:idCategoria WHERE id = :id");

            $prepare->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $prepare->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $prepare->bindParam(':marca', $datos['marca'], PDO::PARAM_STR);
            $prepare->bindParam(':idCategoria', $datos['categoria'], PDO::PARAM_STR);
            $prepare->bindParam(':id', $datos['id'], PDO::PARAM_STR);

            $prepare->execute();

        }else {
            throw new Exception('A ocurrido un error con la base de datos');
        }


    }

    public function updateProductPhoto($table, $datos)
    {
        if(isset($table) || isset($datos)){

            $prepare = $this->db->prepare("UPDATE $table SET nombre=:nombre, descripcion=:descripcion, marca=:marca,
                                                  idCategoria=:idCategoria, foto=:foto WHERE id = :id");


            $prepare->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $prepare->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $prepare->bindParam(':marca', $datos['marca'], PDO::PARAM_STR);
            $prepare->bindParam(':idCategoria', $datos['categoria'], PDO::PARAM_STR);
            $prepare->bindParam(':foto', $datos['archivo'], PDO::PARAM_STR);
            $prepare->bindParam(':id', $datos['id'], PDO::PARAM_STR);

            $prepare->execute();

        }else {
            throw new Exception('A ocurrido un error con la base de datos');
        }


    }

    public function categoriaProducto($field)
    {
        $prepare = $this->db->prepare("SELECT p.* FROM Productos p INNER JOIN Categorias C on p.idCategoria = C.id WHERE C.nombre = :field");
        $prepare->bindParam(':field', $field, PDO::PARAM_STR);
        $prepare->execute();
        return $prepare;

    }

    public function alls($table, $limit = 10)
    {
        $prepare = $this->db->prepare('SELECT * FROM ' . $table);
        $prepare->execute();

        return $prepare;

    }

    public function allsWithCategory($table, $limit = 10)
    {
        $prepare = $this->db->prepare('SELECT * FROM ' . $table);
        $prepare = $this->db->prepare('SELECT p.*, c.nombre AS nombrecat FROM ' . $table . ' p INNER JOIN Categorias c ON p.idCategoria = c.id;');
        $prepare->execute();

        return $prepare;

    }

    public function delete($table, $campo1, $campo2)
    {
        $prepare = $this->db->prepare("DELETE FROM $table WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);

        $prepare->execute();

    }

    public function search($table, $campo1, $campo2)
    {
        $prepare = $this->db->prepare("SELECT p.*, c.nombre AS nombrecat FROM $table p INNER JOIN Categorias c ON p.idCategoria = c.id  WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);
        $prepare->execute();
        return $prepare;
    }



}