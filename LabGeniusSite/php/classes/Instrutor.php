<?php
require_once "DB.php";

class Instrutor extends DB{

    
    
    public function getId($username){
        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $instrutor) {
                return $instrutor->id;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getNome($username){

        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $instrutor) {
                return $instrutor->nome;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }

    public function getFullnameById($id){

        $sql = "SELECT * FROM instrutor WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $instrutor) {
                $fullname = $instrutor->nome." ".$instrutor->sobrenome;
                return $fullname;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }

    


    public function getSobrenome($username){

        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $instrutor) {
                return $instrutor->sobrenome;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getEmail($username){

        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $instrutor) {
                return $instrutor->email;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getSenha($username){

        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
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

    public function getPicture($username){
        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->profile_pic;
            }
        }else{
            echo "Erro ao procurar a foto";
        }
    }

    public function getPictureById($id){
        $sql = "SELECT * FROM instrutor WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->profile_pic;
            }
        }else{
            echo "Erro ao procurar a foto";
        }
    }

    public function changeProfilePhoto($username, $new_img_tmp){

        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
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


    public function Cadastrar($nome, $sobrenome, $email, $senha, $usuario){
        $sql = "INSERT INTO instrutor (nome, sobrenome, email, senha, usuario, profile_pic) VALUES (:nome, :sobrenome, :email, :senha, :user, :profile_pic)";
        
        $new_name = md5(time()).'.png';
        $directory = "../img/profile/";
        copy('../img/defaultprofile/instrutor.png', $directory.$new_name);

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
        $sql = "UPDATE instrutor SET nome = :nome WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }

    public function mudarSobrenome($sobrenome, $username){
        $sql = "UPDATE instrutor SET sobrenome = :sobrenome WHERE usuario = :username ";
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
            $sql = "SELECT * FROM instrutor WHERE usuario = :user";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if(count($result) > 0){
                $_SESSION['error'] = '<div class="error-msg"><p>Erro! Já existe um usuário com este nome.</p></div>';
                
            }else{
                $_SESSION['user_session'] = $user;

                $sql2 = "UPDATE instrutor SET username = :user WHERE usuario = :username ";
                $stmt2 = DB::prepare($sql2);
                $stmt2->bindParam(':user', $user);
                $stmt2->bindParam(':username', $username);
                $stmt2->execute();
                //echo "Mudou o username com sucesso";
            }
        }


        
    }

    public function mudarEmail($email, $username){

        $sql = "SELECT * FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $aluno) {
                if($email == $aluno->email){
                    //echo "Nada foi mudado no email!";
                }else{
                    $sql2 = "SELECT * FROM instrutor WHERE email = :email";
                    $stmt2 = DB::prepare($sql2);
                    $stmt2->bindParam(':email', $email);
                    $stmt2->execute();
                    $result2 = $stmt2->fetchAll();

                    if(count($result2) > 0){
                        
                        $_SESSION['error'] = '<div class="error-msg"><p>Erro! Já existe um usuário com este email.</p></div>';
                    }else{
                        $sql3 = "UPDATE instrutor SET email = :email WHERE usuario = :username ";
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
        $sql = "UPDATE instrutor SET senha = :senha WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }

    public function excluirInstrutor($username){
        $sql = "DELETE FROM instrutor WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }
  
} 
