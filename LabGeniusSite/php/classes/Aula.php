<?php
require_once "DB.php";

class Aula extends DB{


    public function getIdModulo($id_aula){
        $sql = "SELECT * FROM aulas WHERE id_aula = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result =  $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->id_modulo;
            }
        }else{
            echo "Erro ao buscar informações da aula";
        }
    }

    public function getNumeroTodasAulas(){
        $sql = "SELECT * FROM aulas";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return count($stmt->fetchAll());
    }

    public function getIdCurso($id_aula){
        $sql = "SELECT * FROM aulas WHERE id_aula = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result =  $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->id_curso;
            }
        }else{
            echo "Erro ao buscar informações da aula";
        }
    }

    public function getViews($id_instrutor){
        $sql = "SELECT * FROM cursos WHERE id_owner = :id_instrutor";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_instrutor', $id_instrutor);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            $i = 0;
            foreach ($result as $key => $value) {
                $sql2 = "SELECT * FROM aluno_aula_rel WHERE id_curso = :id_curso";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':id_curso', $value->id);
                $stmt2->execute();
                $result2 =$stmt2->fetchAll();

                foreach ($result2 as $key => $value) {
                    $i++;
                }    
            }
            return $i;
        }
    }

    public function getUltimaAula($id_curso){
        $sql = "SELECT * FROM aulas WHERE id_curso = :id_curso ORDER BY id_aula DESC LIMIT 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $key => $value) {
            return $value->id_aula;
        }
       
    }
    

    public function verAula($id_aluno, $id_aula, $id_curso){
        $sql2 = "SELECT * FROM aluno_aula_rel WHERE id_aluno = :id_aluno AND id_aula = :id_aula";
        $stmt2 = DB::prepare($sql2);
        $stmt2->bindParam(':id_aluno', $id_aluno);
        $stmt2->bindParam(':id_aula', $id_aula);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();

        if(count($result2) == 0){
            $sql = "INSERT INTO aluno_aula_rel (id_aluno, id_aula, id_curso) VALUES (:id_aluno, :id_aula, :id_curso)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_aluno', $id_aluno);
            $stmt->bindParam(':id_aula', $id_aula);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->execute();
        }
    }

    
    public function createVideoAula($id_curso, $id_modulo, $titulo, $descricao, $type, $video_url){

        $sql = "INSERT INTO aulas (id_curso, id_modulo, titulo, descricao, type, date) VALUES (:id_curso, :id_modulo, :titulo, :descricao, :type, CURRENT_DATE())";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':type', $type);
        $stmt->execute();

        $sql2 = "SELECT LAST_INSERT_ID()";
        $stmt2 = DB::prepare($sql2);
        $stmt2->execute();
        $lastid = $stmt2->fetchColumn();

        $sql3 = "INSERT INTO aulas_video_url (id_aula, video_url) VALUES (:id_aula, :video_url)";
        $stmt3 = DB::prepare($sql3);
        $stmt3->bindParam(':id_aula', $lastid);
        $stmt3->bindParam(':video_url', $video_url);
        $stmt3->execute();
    }

    public function getAulaOwner($id_curso, $id_aula){
        $sql = "SELECT * FROM aulas WHERE id_curso = :id_curso AND id_aula = :id_modulo ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarAula($id_curso, $id_modulo){

        $sql = "SELECT * FROM aulas WHERE id_curso = :id_curso AND id_modulo = :id_modulo ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->execute();
        return $stmt->fetchAll();

        // if(count($result) > 0){
        //     foreach ($result as $key => $curso) {
        //         return $curso->id;
        //     }
        // }else{
        //     echo "Erro ao procurar o curso";
        // }
    }

    public function getTitulo($id_aula, $id_curso){
        $sql = "SELECT * FROM aulas WHERE id_aula = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result =  $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aula) {
                if ($aula->id_curso == $id_curso){
                    return $aula->titulo;
                }else{
                    echo "Erro ao procurar a aula";
                }
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }

    public function getDescricao($id_aula, $id_curso){
        $sql = "SELECT * FROM aulas WHERE id_aula = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result =  $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aula) {
                if ($aula->id_curso == $id_curso){
                    return $aula->descricao;
                }else{
                    echo "Erro ao procurar a aula";
                }
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }


    public function getDate($id_aula, $id_curso){
        $sql = "SELECT * FROM aulas WHERE id_aula = :id_aula ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result =  $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aula) {
                if ($aula->id_curso == $id_curso){
                    return $aula->date;
                }else{
                    echo "Erro ao procurar a aula";
                }
            }
        }else{
            echo "Erro ao procurar o curso";
        }

    }
    
    public function getVideo($id_aula){
        $sql = "SELECT * FROM aulas_video_url WHERE id_aula = :id_aula";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0){
            foreach ($result as $key => $video_aula) {
                return $video_aula->video_url;
            }
        }else{
            echo "Erro ao procurar o video";
        }
    }

    public function editVideoAula($id_aula, $id_curso, $id_modulo, $titulo, $descricao, $type, $video_url){

        $sql = "UPDATE aulas SET id_curso = :id_curso, id_modulo = :id_modulo, titulo = :titulo, descricao = :descricao, type = :type, date = CURDATE() WHERE id_aula = :id_aula";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();

        $sql3 = "UPDATE aulas_video_url SET video_url = :video_url WHERE id_aula = :id_aula";
        $stmt3 = DB::prepare($sql3);
        $stmt3->bindParam(':id_aula', $id_aula);
        $stmt3->bindParam(':video_url', $video_url);
        $stmt3->execute();
    }

    public function excluirAula($id_curso, $id_aula){
        $sql = "DELETE FROM aulas WHERE id_curso = :id_curso AND id_aula = :id_aula";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_aula', $id_aula);
        $stmt->execute();
    }
} 
