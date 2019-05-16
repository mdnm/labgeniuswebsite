<?php
require_once "DB.php";

class Modulo extends DB{

    public function createModulo($id_curso, $name){
        $sql = "INSERT INTO modules (id_course, name) VALUES (:id_curso, :name)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function excluirModulo($id_curso, $id_modulo){

        $sql = "DELETE FROM aulas WHERE id_modulo = :id_modulo AND id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();

        if($stmt == true){
            $sql2 = "DELETE FROM modules WHERE id = :id AND id_course = :id_course";
            $stmt2 = DB::prepare($sql2);
            $stmt2->bindParam(':id', $id_modulo);
            $stmt2->bindParam(':id_course', $id_curso);
            $stmt2->execute();
        }

        
    }

    public function getModulos($id_curso){
        $sql = "SELECT * FROM modules WHERE id_course = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        return $stmt->fetchAll();
    }
} 
