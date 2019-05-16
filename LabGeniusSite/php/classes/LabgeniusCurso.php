<?php
require_once "DB.php";

class LabgeniusCurso extends DB{


    public function getAllInfo($id_curso){
        $sql = "SELECT * FROM labcourses WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        return $result = $stmt->fetchAll();
    }
    
    public function getId($id_curso){

        $sql = "SELECT * FROM labcourses WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {
                return $curso->id;
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }

    public function getTitulo($id_curso){

        $sql = "SELECT * FROM labcourses WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {
                return $curso->titulo;
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }


    public function getDescricao($id_curso){

        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {
                return $curso->descricao;
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }

    public function buscarCursos(){
        $sql = "SELECT * FROM labcourses";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function Cadastrar($titulo, $desc, $color, $img){
        $sql = "INSERT INTO labcourses (titulo, descricao, color, img) VALUES (:titulo, :descricao, :color, :img)";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $desc);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':img', $img);
        $stmt->execute();

    }

    public function excluirCurso($id_curso){
        $sql = "DELETE FROM labaula_conteudo1 WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();

        $sql2 = "DELETE FROM labaula_conteudo2 WHERE id_curso = :id_curso";
        $stmt2 = DB::prepare($sql2);
        $stmt2->bindParam(':id_curso', $id_curso);
        $stmt2->execute();

        $sql3 = "DELETE FROM lab_aula WHERE id_curso = :id_curso";
        $stmt3 = DB::prepare($sql3);
        $stmt3->bindParam(':id_curso', $id_curso);
        $stmt3->execute();

        $sql4 = "DELETE FROM labcourses WHERE id = :id_curso";
        $stmt4 = DB::prepare($sql4);
        $stmt4->bindParam(':id_curso', $id_curso);
        $stmt4->execute();
    }
} 
