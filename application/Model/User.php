<?php
namespace Mini\Model;
use Mini\Core\Model;
use PDO;
class User extends Model
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


    public function checkRepeatPass($table, $campo1, $campo2, $campo3, $campo4)
    {

        $prepare = $this->db->prepare("SELECT $campo1 FROM $table WHERE $campo1 = :field AND clave = :clave ");
        $prepare->bindParam(':field', $campo3, PDO::PARAM_STR);
        $prepare->bindParam(':clave', $campo4, PDO::PARAM_STR);

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
            $prepare = $this->db->prepare("INSERT INTO $table(nombre, apellidos, email, nickname, clave, rol)
                                       VALUES(:nombre, :apellidos, :email, :nickname, :pass, :rol)");

            $prepare->bindParam(':nombre', $fields['nombre'], PDO::PARAM_STR);
            $prepare->bindParam(':apellidos', $fields['apellidos'], PDO::PARAM_STR);
            $prepare->bindParam(':nickname', $fields['nick'], PDO::PARAM_STR);
            $prepare->bindParam(':email', $fields['email'], PDO::PARAM_STR);
            $prepare->bindParam(':pass', $fields['pass'], PDO::PARAM_STR);
            $prepare->bindParam(':rol', $fields['rol'], PDO::PARAM_STR);


            $prepare->execute();
        }else{
            throw new Exception('Hay problemas con la BD');
        }



    }

    public function allFields($table, $campo1, $campo2, $campo3)
    {
        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field OR $campo2 = :field1");
        $prepare->bindParam(':field', $campo3, PDO::PARAM_STR);
        $prepare->bindParam(':field1', $campo3, PDO::PARAM_STR);
        $prepare->execute();

        return $prepare->fetch(PDO::FETCH_ASSOC);

    }

}