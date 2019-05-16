<?php
require_once "DB.php";

class LabgeniusAula extends DB{

    
    public function getTitulo($id_aula){
        $sql = "SELECT * FROM lab_aula WHERE id = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aula) {
                return $aula->titulo;
            }
        }else{
            echo "Erro ao procurar o título da aula";
        }
    }

    public function getType($id_aula){
        $sql = "SELECT * FROM lab_aula WHERE id = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->type;
            }
        }else{
            echo "Erro ao procurar o tipo da aula";
        }
    }

    public function getIdByOrdem($ordem, $id_curso){
        $sql = "SELECT * FROM lab_aula WHERE id_curso = :id_curso AND ordem = :ordem ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':ordem', $ordem);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->id;
            }
        }else{
            return 0;
            echo "Erro ao procurar a ordem";
        }
    }

    public function getOrdem($id_aula){
        $sql = "SELECT * FROM lab_aula WHERE id = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->ordem;
            }
        }else{
            echo "Erro ao procurar a ordem";
        }
    }
   
    public function cadastrarAula1($id_curso, $titulo, $dialog, $img, $type){
        $sql = "SELECT * FROM lab_aula WHERE id_curso = :id_curso ORDER BY datetime DESC LIMIT 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) == 0){
            $nvordem = 1;
            $sql3 = "INSERT INTO lab_aula (id_curso, titulo, datetime, type, ordem) VALUES (:id_curso, :titulo, now(), :type, :ordem)";
            $stmt3 = DB::prepare($sql3);
            $stmt3->bindParam(':id_curso', $id_curso);
            $stmt3->bindParam(':titulo', $titulo);
            $stmt3->bindParam(':type', $type);
            $stmt3->bindParam(':ordem', $nvordem);
            $stmt3->execute();
        }else{
            foreach ($result as $key => $value) {
                $nvordem = $value->ordem+1;
                $sql3 = "INSERT INTO lab_aula (id_curso, titulo, datetime, type, ordem) VALUES (:id_curso, :titulo, now(), :type, :ordem)";
                $stmt3 = DB::prepare($sql3);
                $stmt3->bindParam(':id_curso', $id_curso);
                $stmt3->bindParam(':titulo', $titulo);
                $stmt3->bindParam(':type', $type);
                $stmt3->bindParam(':ordem', $nvordem);
                $stmt3->execute();
            }
        }
                    
        $sql4 = "SELECT LAST_INSERT_ID()";
        $stmt4 = DB::prepare($sql4);
        $stmt4->execute();
        $lastid = $stmt4->fetchColumn();

        $sql5 = "INSERT INTO labaula_conteudo1 (id_aula, id_curso, dialog, img) VALUES (:id_aula, :id_curso, :dialog, :img)";
        $stmt5 = DB::prepare($sql5);
        $stmt5->bindParam(':id_aula', $lastid);
        $stmt5->bindParam(':id_curso', $id_curso);
        $stmt5->bindParam(':dialog', $dialog);
        $stmt5->bindParam(':img', $img);
        $stmt5->execute();
    }

    public function cadastrarAula2($id_curso, $titulo, $dialog1, $dialog2, $type){

        $sql = "SELECT * FROM lab_aula WHERE id_curso = :id_curso ORDER BY datetime DESC LIMIT 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) == 0){
            $nvordem = 1;
            $sql2 = "INSERT INTO lab_aula (id_curso, titulo, datetime, type, ordem) VALUES (:id_curso, :titulo, now(), :type, :ordem)";
            $stmt2 = DB::prepare($sql2);
            $stmt2->bindParam(':id_curso', $id_curso);
            $stmt2->bindParam(':titulo', $titulo);
            $stmt2->bindParam(':type', $type);
            $stmt2->bindParam(':ordem', $nvordem);
            $stmt2->execute();
        }else{
            foreach ($result as $key => $value) {
                $nvordem = $value->ordem+1;
                $sql2 = "INSERT INTO lab_aula (id_curso, titulo, datetime, type, ordem) VALUES (:id_curso, :titulo, now(), :type, :ordem)";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':id_curso', $id_curso);
                $stmt2->bindParam(':titulo', $titulo);
                $stmt2->bindParam(':type', $type);
                $stmt2->bindParam(':ordem', $nvordem);
                $stmt2->execute();
            }
        }

        $sql4 = "SELECT LAST_INSERT_ID()";
        $stmt4 = DB::prepare($sql4);
        $stmt4->execute();
        $lastid = $stmt4->fetchColumn();

        $sql5 = "INSERT INTO labaula_conteudo2 (id_aula, id_curso, dialog1, dialog2) VALUES (:id_aula, :id_curso, :dialog1, :dialog2)";
        $stmt5 = DB::prepare($sql5);
        $stmt5->bindParam(':id_aula', $lastid);
        $stmt5->bindParam(':id_curso', $id_curso);
        $stmt5->bindParam(':dialog1', $dialog1);
        $stmt5->bindParam(':dialog2', $dialog2);
        $stmt5->execute();
    }

    public function buscarAulas($id_curso){
        $sql = "SELECT * FROM lab_aula WHERE id_curso = :id_curso ORDER BY datetime";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarConteudoAula($id_aula, $id_curso, $type){
        if($type == "1"){
            $sql = "SELECT * FROM labaula_conteudo1 WHERE id_aula = :id_aula AND id_curso = :id_curso";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_aula', $id_aula);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->execute();
            return $stmt->fetchAll();
        }else if($type == "2"){
            $sql = "SELECT * FROM labaula_conteudo2 WHERE id_aula = :id_aula AND id_curso = :id_curso";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_aula', $id_aula);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
    }

    public function excluirAula($id_curso, $id_aula, $type){
        if($type == "1"){
            $sql = "SELECT * FROM labaula_conteudo1 WHERE id_curso = :id_curso AND id_aula = :id_aula";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->bindParam(':id_aula', $id_aula);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if(count($result) > 0){
                foreach ($result as $key => $value) {
                    unlink('../img/labcourses/classes/img/'.$value->img);
                    $sql2 = "DELETE FROM labaula_conteudo1 WHERE id_curso = :id_curso AND id_aula = :id_aula";
                    $stmt2 = DB::prepare($sql2);
                    $stmt2->bindParam(':id_curso', $id_curso);
                    $stmt2->bindParam(':id_aula', $id_aula);
                    $stmt2->execute();

                    $sql3 = "DELETE FROM lab_aula WHERE id_curso = :id_curso AND id = :id_aula";
                    $stmt3 = DB::prepare($sql3);
                    $stmt3->bindParam(':id_curso', $id_curso);
                    $stmt3->bindParam(':id_aula', $id_aula);
                    $stmt3->execute();
                }
            }

        }else if($type == "2"){

            $sql = "DELETE FROM labaula_conteudo2 WHERE id_curso = :id_curso AND id_aula = :id_aula";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->bindParam(':id_aula', $id_aula);
            $stmt->execute();

            $sql2 = "DELETE FROM lab_aula WHERE id_curso = :id_curso AND id = :id_aula";
            $stmt2 = DB::prepare($sql2);
            $stmt2->bindParam(':id_curso', $id_curso);
            $stmt2->bindParam(':id_aula', $id_aula);
            $stmt2->execute();
        }
    }
    
} 
