<?php
require_once "DB.php";

class Aluno extends DB{
    private $nome;
    private $sobrenome;
    private $username;
    private $id_aluno;

    public function getTotalAlunos($id_instrutor){
        $sql = "SELECT * FROM cursos WHERE id_owner = :id_instrutor";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_instrutor', $id_instrutor);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            $i = 0;
            foreach ($result as $key => $value) {
                $sql2 = "SELECT * FROM aluno_curso_rel WHERE id_curso = :id_curso";
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

    public function getTotalAlunosAdmin(){
        $sql = "SELECT * FROM aluno";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return count($stmt->fetchAll());
    }

    // Pega somente o nome
    public function getNome($username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //echo count($result);

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                return $aluno->nome;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getSobrenome($username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                return $aluno->sobrenome;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getEmail($username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                return $aluno->email;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }

    public function getId($username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                return $aluno->id_aluno;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }

    public function mudarFoto($username, $img){

    }

    public function buscarTodosAlunos(){
        $sql = "SELECT * FROM $alunos";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarAluno($id_aluno){
        $sql = "SELECT * FROM $alunos WHERE id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Retorna todas as  informações do aluno em um loop.
    public function getInfo($username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $result = $stmt->fetchAll();

    }

    public function changeProfilePhoto($username, $new_img_tmp){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0){
            foreach ($result as $key => $value) {
                move_uploaded_file($new_img_tmp, "../../img/profile/".$value->profile_pic);
            }
        }
    }

    public function getPicture($username){
        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                return $aluno->profile_pic;
            }
        }else{
            echo "Erro ao procurar a foto";
        }
    }

    public function cadastrar($nome, $sobrenome, $email, $senha, $usuario){
        $sql = "INSERT INTO aluno (nome, sobrenome, email, senha, usuario, profile_pic) VALUES (:nome, :sobrenome, :email, :senha, :user, :profile_pic)";
        
        $new_name = md5(time()).'.png';
        $directory = "../img/profile/";
        copy('../img/defaultprofile/profile2.png', $directory.$new_name);

        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':user', $usuario);
        $stmt->bindParam(':profile_pic', $new_name);
        $stmt->execute();
    }

    public function mudarNome($nome, $username){
        $sql = "UPDATE aluno SET nome = :nome WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }

    public function mudarSobrenome($sobrenome, $username){
        $sql = "UPDATE aluno SET sobrenome = :sobrenome WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }

    public function mudarUsername($user, $username){

        if($user == $username){
            //echo "Nada foi mudado no nome!";
        }else{
            //verifica se ja existe no banco o usuario desejado.
            $sql = "SELECT * FROM aluno WHERE usuario = :user";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if(count($result) > 0){
                $_SESSION['error'] = '<div class="error-msg"><p>Erro! Já existe um usuário com este nome.</p></div>';
                
            }else{
                $_SESSION['user_session'] = $user;

                $sql2 = "UPDATE aluno SET usuario = :user WHERE usuario = :username ";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':user', $user);
                $stmt2->bindParam(':username', $username);
                $stmt2->execute();
                //echo "Mudou o username com sucesso";
            }
        }


        
    }

    public function mudarEmail($email, $username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                if($email == $aluno->email){
                    //echo "Nada foi mudado no email!";
                }else{
                    $sql2 = "SELECT * FROM aluno WHERE email = :email";
                    $stmt2 = DB::prepare($sql2);
                    $stmt2->bindParam(':email', $email);
                    $stmt2->execute();
                    $result2 = $stmt2->fetchAll();

                    if(count($result2) > 0){
                        
                        $_SESSION['error'] = '<div class="error-msg"><p>Erro! Já existe um usuário com este email.</p></div>';
                    }else{
                        $sql3 = "UPDATE aluno SET email = :email WHERE usuario = :username ";
                        $stmt3 = DB::prepare($sql3);
                        $stmt3->bindParam(':email', $email);
                        $stmt3->bindParam(':username', $username);
                        $stmt3->execute();
                        //echo "Mudou o email com sucesso";
                    }
                }
            }
        }else{
            echo "Erro ao procurar o usuario";
        }

        

        
    }


    public function mudarSenha($user, $username){
        $sql = "UPDATE aluno SET senha = :senha WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }


    public function excluirAluno($username){
        $sql = "DELETE FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }
    
} 
