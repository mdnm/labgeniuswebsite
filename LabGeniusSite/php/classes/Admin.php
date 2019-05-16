<?php
require_once "DB.php";

class Admin extends DB{
    private $nome;
    private $sobrenome;
    private $username;
    private $id_admin;

    // Pega somente o nome
    public function getNome($username){

        $sql = "SELECT * FROM admin WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //echo count($result);

        if(count($result) > 0){
            foreach ($result as $key => $admin) {
                return $admin->nome;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getSobrenome($username){

        $sql = "SELECT * FROM admin WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $admin) {
                return $admin->sobrenome;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }


    public function getEmail($username){

        $sql = "SELECT * FROM admin WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $admin) {
                return $admin->email;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }

    public function getId($username){

        $sql = "SELECT * FROM admin WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $admin) {
                return $admin->id_aluno;
            }
        }else{
            echo "Erro ao procurar o usuario";
        }
    }

 

    public function buscarAdmin($id_admin){
        $sql = "SELECT * FROM admin WHERE id = :id_admin";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_admin', $id_admin);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Retorna todas as  informações do aluno em um loop.
    public function getInfo($username){

        $sql = "SELECT * FROM aluno WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_INT);
        $stmt->execute();
        return $result = $stmt->fetchAll();

    }


    public function mudarNome($nome, $username){
        $sql = "UPDATE admin SET nome = :nome WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }

    public function mudarSobrenome($sobrenome, $username){
        $sql = "UPDATE admin SET sobrenome = :sobrenome WHERE usuario = :username ";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }


    public function excluirAdmin($username){
        $sql = "DELETE FROM admi WHERE usuario = :username";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }
    
} 
