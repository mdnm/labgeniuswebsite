<?php
require_once "DB.php";

class Curso extends DB{

    public function getTotalCursos($id_instrutor){
        $sql = "SELECT * FROM cursos WHERE id_owner = :id_instrutor";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_instrutor', $id_instrutor);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $total = count($result);
        return  $total;
    }

    public function getTotalAulas($id_curso){
        $sql = "SELECT * FROM aulas WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $total = count($result);
        return  $total;
    }

    public function getNumeroTodosCursos(){
        $sql = "SELECT * FROM cursos";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return count($stmt->fetchAll());
    }
    
    public function getRating($id_curso){
        $sql = "SELECT * FROM rating WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $qtd_rating = 0;
        $nota = 0;
        foreach ($result as $key => $value) {
            // Soma a quantidade de avaliações
            $qtd_rating++;
            // Soma os valores das avaliações
            $nota = $nota + $value->nota;
        }

        //calculo da média
        $media = $nota/$qtd_rating;

        //calculo porcentagem
        $porcent = 100*$media/5;

        return $porcent;
    }

    public function getTags($id_curso){
        $sql = "SELECT * FROM cursos_tag_ref WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                $id_tag = $value->id_tag;

                $sql2 = "SELECT * FROM tags WHERE id_tag = :id_tag";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':id_tag', $id_tag);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll();

                foreach ($result2 as $key => $tag) {
                    $array[] = $tag;  
                }
            }
            return $array;
        }
    }
    
    public function getId($id_curso){

        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
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


    public function getIdOwner($id_curso){
        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {
                return $curso->id_owner;
            }
        }else{
            echo "Error";
        }
    }

    public function getTitulo($id_curso){

        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
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

    public function getPercent($id_curso, $id_aluno){
        $sql = "SELECT * FROM aulas WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        // Total de aulas
        $total_aulas = count($result);

        $sql2 = "SELECT * FROM aluno_aula_rel WHERE id_aluno = :id_aluno AND id_curso = :id_curso";
        $stmt2 = DB::prepare($sql2);
        $stmt2->bindParam(':id_aluno', $id_aluno);
        $stmt2->bindParam(':id_curso', $id_curso);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();

        //Quantas aulas o aluno assistiu daquele curso
        $aulas_assistidas = count($result2);   

        // //Conta da porcentagem
        if($total_aulas == 0){
            $porcent = 0;
        }else{
            $porcent = $aulas_assistidas/$total_aulas*100;
        }
        
        return $porcent;
    }

    public function getInstructorName($id_curso){

        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {

                $sql2 = "SELECT * FROM instrutor WHERE id = :id_owner";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':id_owner', $curso->id_owner);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll();
                if(count($result2) > 0){
                    foreach ($result2 as $key => $instructor) {
                        $nome = $instructor->nome." ".$instructor->sobrenome;
                        return $nome;
                    }
                }else{
                    echo "Erro ao procurar instrutor.";
                }
               
            }
        }else{
            echo "Erro o pedido";
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

    public function getVisibilidade($id_curso){
        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {
                return $curso->visibilidade;
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }

    public function getIdSala($id_curso){
        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $curso) {
                return $curso->id_sala;
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }

    public function searchCurso($word){
        $query = '%'.$word.'%';
        $sql = "SELECT * FROM cursos WHERE titulo LIKE :word AND visibilidade = 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':word', $query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarCursos($id_instrutor){
        $sql = "SELECT * FROM cursos WHERE id_owner = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id_instrutor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarCursoPrivado($id_sala){
        $sql = "SELECT * FROM cursos WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarCursoPublico(){
        $sql = "SELECT * FROM cursos WHERE visibilidade = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarCursosAleatorio(){
        $sql = "SELECT * FROM cursos WHERE visibilidade = 1 ORDER BY RAND()";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarTodosCursos(){
        $sql = "SELECT * FROM cursos";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function mostrarCursosIngressados($id_aluno){
        $sql = "SELECT * FROM aluno_curso_rel WHERE id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();
        $count = $stmt->rowCount();
        $result = $stmt->fetchAll();

        if($count > 0){
            foreach ($result as $key => $value) {
                $sql2 = "SELECT * FROM cursos WHERE id = :id_curso";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':id_curso', $value->id_curso);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll();

                foreach ($result2 as $key => $curso) {
                    $array[] = $curso;  
                }
            }
            return @$array;
        }
    }


    public function verificaRating($id_aluno, $id_curso){
        $sql = "SELECT * FROM rating WHERE id_curso = :id_curso AND id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return count($result);
    }

    public function insertRating($id_aluno, $id_curso, $nota){
        $sql = "SELECT * FROM rating WHERE id_curso = :id_curso AND id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        if(count($result) == 0){
            $sql = "INSERT INTO rating (id_aluno, id_curso, nota) VALUES (:id_aluno, :id_curso, :nota)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_aluno', $id_aluno);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->bindParam(':nota', $nota);
            $stmt->execute();
        }
    }

    public function Cadastrar($id_instrutor, $titulo, $desc, $tags, $visibilidade, $thumbnail, $id_sala){
        $sql = "INSERT INTO cursos (id_owner, titulo, descricao, thumbnail, visibilidade, id_sala) VALUES (:id_instrutor, :titulo, :descricao, :thumbnail, :visibilidade, :id_sala)";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_instrutor', $id_instrutor);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $desc);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':visibilidade', $visibilidade);
        $stmt->bindParam(':id_sala', $id_sala);
        $stmt->execute();

        $sql2 = "SELECT LAST_INSERT_ID()";
        $stmt2 = DB::prepare($sql2);
        $stmt2->execute();
        $lastid = $stmt2->fetchColumn();

        //separação das tags
        $tag = explode(",", $tags);

        foreach ($tag as $key => $tagrecebida) {

            //verifica se 
            $sql3 = "SELECT * FROM tags WHERE tag_word = :value";
            $stmt3 = DB::prepare($sql3);
            $stmt3->bindParam(":value", $tagrecebida);
            $stmt3->execute();
            $result_tags = $stmt3->fetchAll();

            //caso já existir, somente insere na tabela de relaçao
            if(count($result_tags) > 0){
                //echo "ja existe tag</br>";
                foreach ($result_tags as $key => $value2) {
                    $sql4 = "INSERT INTO cursos_tag_ref (id_curso, id_tag) VALUES (:id_curso, :id_tag)";
                    $stmt4 = DB::prepare($sql4);
                    $stmt4->bindParam(":id_curso", $lastid);
                    $stmt4->bindParam(":id_tag", $value2->id_tag);
                    $stmt4->execute();
                }

            //caso não exista, criará uma nova tag, e insere na tabela de relação 
            }else{
                //echo "ainda nao existe tag</br>";
                //insere na tabela tag a nova tag
                $sql4 = "INSERT INTO tags (tag_word) VALUES (:tag_name)";
                $stmt4 = DB::prepare($sql4);
                $stmt4->bindParam(":tag_name", $tagrecebida);
                $stmt4->execute();

                //pega o id da tag inserida acima
                $sql5 = "SELECT LAST_INSERT_ID()";
                $stmt5 = DB::prepare($sql5);
                $stmt5->execute();
                $lastidtag = $stmt5->fetchColumn();

                //cria nova relaçao de tag
                $sql6 = "INSERT INTO cursos_tag_ref (id_curso, id_tag) VALUES (:id_curso, :id_tag)";
                $stmt6 = DB::prepare($sql6);
                $stmt6->bindParam(":id_curso", $lastid);
                $stmt6->bindParam(":id_tag", $lastidtag);
                $stmt6->execute();    
            } 
        }
    }



    public function excluirCurso($id_instrutor, $id_curso){

        //excluir imagem
        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $count = $stmt->rowCount();

        foreach ($result as $key => $value) {

            unlink('../img/courses/thumb/'.$value->thumbnail);

            $sql = "DELETE FROM cursos WHERE id_owner = :id_instrutor AND id = :id_curso";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id_instrutor', $id_instrutor);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->execute();
            $count = $stmt->rowCount();

            //fiz a verificação para ver se a query de cima foi executada, e se foi por quem é dono do curso
            if($count > 0){
                $sql2 = "DELETE FROM cursos_tag_ref WHERE id_curso = :id_curso";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':id_curso', $id_curso);
                $stmt2->execute();
            }else{
                echo "Ocorreu um erro ao excluir";
            }
        }
    }

    public function verificarEntrada($id_aluno, $id_curso){
        $sql = "SELECT * FROM aluno_curso_rel WHERE id_aluno = :id_aluno AND id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        return $count = $stmt->rowCount();
    }

    public function ingressarCurso($id_aluno, $id_curso){
        $sql = "INSERT INTO aluno_curso_rel (id_aluno, id_curso) VALUES (:id_aluno, :id_curso)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
    }

    public function sairCurso($id_aluno, $id_curso){
        $sql = "DELETE FROM aluno_aula_rel WHERE id_curso = :id_curso AND id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();

        $sql2 = "DELETE FROM aluno_curso_rel WHERE id_curso = :id_curso AND id_aluno = :id_aluno";
        $stmt2 = DB::prepare($sql2);
        $stmt2->bindParam(':id_curso', $id_curso);
        $stmt2->bindParam(':id_aluno', $id_aluno);
        $stmt2->execute();
    }

    public function editCurso($id_curso, $id_instrutor, $titulo, $desc, $tags, $visibilidade, $thumbnail, $id_sala){
        $sql = "SELECT * FROM cursos WHERE id = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){

            if($thumbnail == 1){
                $sql2 = "UPDATE cursos SET titulo = :titulo, descricao = :desc, visibilidade = :visibilidade, id_sala = :id_sala WHERE id = :id_curso";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':titulo', $titulo);
                $stmt2->bindParam(':desc', $desc);
                $stmt2->bindParam(':visibilidade', $visibilidade);
                $stmt2->bindParam(':id_sala', $id_sala);
                $stmt2->bindParam(':id_curso', $id_curso);
                $stmt2->execute();
            }else{
                // exclui foto antiga
                foreach ($result as $key => $value) {
                    $file = "../../img/courses/thumb/".$value->thumbnail;
                    unlink($file);
                }

                $sql2 = "UPDATE cursos SET titulo = :titulo, descricao = :desc, thumbnail = :thumbnail, visibilidade = :visibilidade, id_sala = :id_sala WHERE id = :id_curso";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':titulo', $titulo);
                $stmt2->bindParam(':desc', $desc);
                $stmt2->bindParam(':thumbnail', $thumbnail);
                $stmt2->bindParam(':visibilidade', $visibilidade);
                $stmt2->bindParam(':id_sala', $id_sala);
                $stmt2->bindParam(':id_curso', $id_curso);
                $stmt2->execute();
            }
            //excluir todas as tags do curso
            $sql3 = "DELETE FROM cursos_tag_ref WHERE id_curso = :id_curso";
            $stmt3 = DB::prepare($sql3);
            $stmt3->bindParam(':id_curso', $id_curso);
            $stmt3->execute();
            
            //inserir novas tags ou as que já tinham
            $tag = explode(",", $tags);
            foreach ($tag as $key => $tagrecebida) {

                $sql4 = "SELECT * FROM tags WHERE tag_word = :value";
                $stmt4 = DB::prepare($sql4);
                $stmt4->bindParam(":value", $tagrecebida);
                $stmt4->execute();
                $result_tags = $stmt4->fetchAll();

                //caso já existir, somente insere na tabela de relaçao
                if(count($result_tags) > 0){
                    //echo "ja existe tag</br>";
                    foreach ($result_tags as $key => $value2) {
                        $sql5 = "INSERT INTO cursos_tag_ref (id_curso, id_tag) VALUES (:id_curso, :id_tag)";
                        $stmt5 = DB::prepare($sql5);
                        $stmt5->bindParam(":id_curso", $id_curso);
                        $stmt5->bindParam(":id_tag", $value2->id_tag);
                        $stmt5->execute();
                    }

                //caso não exista, criará uma nova tag, e insere na tabela de relação 
                }else{
                    //echo "ainda nao existe tag</br>";
                    //insere na tabela tag a nova tag
                    $sql5 = "INSERT INTO tags (tag_word) VALUES (:tag_name)";
                    $stmt5 = DB::prepare($sql5);
                    $stmt5->bindParam(":tag_name", $tagrecebida);
                    $stmt5->execute();

                    //pega o id da tag inserida acima
                    $sql6 = "SELECT LAST_INSERT_ID()";
                    $stmt6 = DB::prepare($sql6);
                    $stmt6->execute();
                    $lastidtag = $stmt6->fetchColumn();

                    //cria nova relaçao de tag
                    $sql7 = "INSERT INTO cursos_tag_ref (id_curso, id_tag) VALUES (:id_curso, :id_tag)";
                    $stmt7 = DB::prepare($sql7);
                    $stmt7->bindParam(":id_curso", $id_curso);
                    $stmt7->bindParam(":id_tag", $lastidtag);
                    $stmt7->execute();    
                } 
            }

        }
    }


} 
