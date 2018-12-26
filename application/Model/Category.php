<?php
namespace Mini\Model;
use Mini\Core\Model;
use PDO;

class Category extends Model
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

}