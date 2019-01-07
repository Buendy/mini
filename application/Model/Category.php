<?php
namespace Mini\Model;
use Mini\Libs\Dbpdo;

class Category extends Dbpdo
{

    public function catego($table, $campo1, $campo2)
    {
        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);

        $prepare->execute();

        return $prepare->fetchall(PDO::FETCH_ASSOC);

    }
    public function alls($table, $limit = 10)
    {
        $prepare = $this->db->prepare('SELECT * FROM ' . $table);
        $prepare->execute();

        return $prepare;

    }

    public function update($table, $data)
    {
        if(isset($table) || isset($data)){

            $prepare = $this->db->prepare("UPDATE $table SET nombre=:nombre, descripcion=:descripcion WHERE id = :id");

            $prepare->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $prepare->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);

            $prepare->execute();

        }else {
            throw new Exception('A ocurrido un error con la base de datos');
        }


    }



}