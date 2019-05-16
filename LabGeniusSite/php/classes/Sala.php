<?php
require_once "DB.php";


class Sala extends DB{

    protected $tabela = 'sala';
    private $id_instrutor;
    private $id_aluno;
    private $id_sala;
    private $nome;
    private $senha;

    public function setIdSala($id_sala){
        $this->id_sala = $id_sala;
    }

    public function getIdSala(){
        return $this->id_sala;
    }

    public function setIdAluno($id_aluno){
        $this->id_aluno = $id_aluno;
    }

    public function getIdAluno(){
        return $this->id_aluno;
    }

    public function setInstrutor($id){
        $this->id_instrutor = $id;
    }

    public function getInstrutor(){
        return $this->id_instrutor;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getNome($id_sala){
        $sql = "SELECT * FROM sala WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $value) {
                return $value->nome;
            }
        }else{
            echo "Erro ao procurar o curso";
        }
    }

    public function getAllSalas(){
        $sql = "SELECT * FROM $this->tabela";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function buscaSalas($id_instrutor){
        $sql = "SELECT * FROM $this->tabela WHERE id_dono = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id_instrutor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscaSalasAluno($id_aluno){

        $sql = "SELECT * FROM sala_entrada WHERE id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $array = array();

        if($result > 0){
            foreach ($result as $key => $aluno_sala) {
                $sql2 = "SELECT * FROM sala WHERE id_sala = ".$aluno_sala->id_sala;
                $stmt2 = DB::prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll();
            
                foreach ($result2 as $key => $sala) {
                    $array[] = $sala;  
                }
            }
        }

        return $array;
    }

    public function buscaSala($id_sala){
        $sql = "SELECT * FROM $this->tabela WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscaAlunosSala($id_sala){
        $sql = "SELECT id_aluno FROM sala_entrada WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        $array = array();

        foreach ($result as $key => $value) {
            $sql2 = "SELECT * FROM aluno WHERE id_aluno = :id_aluno";
            $stmt2 = DB::prepare($sql2);
            $stmt2->bindParam(':id_aluno', $value->id_aluno, PDO::PARAM_INT);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll();        
            
            // Não sei o que eu fiz aqui, mas funcionou alguma coisa a ve cm isso https://stackoverflow.com/questions/23775086/return-single-array-from-foreach-class-function
            foreach ($result2 as $key => $aluno) {
                $array[] = $aluno;  
            }
        }
        return $array;
    }

    public function insertSala(){
        $sql = "INSERT INTO $this->tabela (id_dono, nome, senha) VALUES (:id_dono, :nome, :senha)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_dono', $this->id_instrutor);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->execute();
    }

    public function ingressaSala(){
        $sql = "SELECT * FROM sala WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $this->id_sala, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();

        // Verifica se existe a sala procurada logo acima
        if(count($result) > 0){
            $sql2 = "SELECT id_sala, id_aluno FROM sala_entrada WHERE id_sala = :id_sala AND id_aluno = :id_aluno";
            $stmt2 = DB::prepare($sql2);
            $stmt2->bindParam(':id_sala', $this->id_sala, PDO::PARAM_INT);
            $stmt2->bindParam(':id_aluno', $this->id_aluno, PDO::PARAM_INT);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll();
            //verifica se aluno já se resgistrou na sala
            if(count($result2) > 0){
                echo '<div class="error-msg">você já está ingressado nessa sala</div>';
            }else{
                foreach ($result as $key => $value) {
                    // verificação se a senha da sala que ele inseriu está corresponde com a do banco.
                    $senha_sala = $value->senha;
                    if($senha_sala == $this->senha){
                        $sql3 = "INSERT INTO sala_entrada (id_sala, id_aluno) VALUES (:id_sala, :id_aluno)";
                        $stmt3 = DB::prepare($sql3);
                        $stmt3->bindParam(':id_sala', $this->id_sala);
                        $stmt3->bindParam(':id_aluno', $this->id_aluno);
                        $stmt3->execute();
                        echo '<div class="success-msg">Ingressado na sala com Sucesso!</div>';
                    }else{
                        echo '<div class="error-msg">Senha ou código incorretos.</div>';
                    }
                }
            }

        }else{
            echo '<div class="error-msg">Não encontramos essa sala.</div>';
        }
    }


    public function removerAlunoSala($id_sala, $id_aluno, $id_instrutor){

        // pega a sala na qual o aluno vai ser removido.
        $sql = "SELECT * FROM sala WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(count($result) > 0){
            foreach ($result as $key => $sala) {
                //verifica se a sala é do instrutor que está querendo excluir o aluno.
                if($sala->id_dono == $id_instrutor){
                    //a sala é do instrutor no qual quer exlcuir o aluno.
                    $sql2 = "DELETE FROM sala_entrada WHERE id_sala = :id_sala AND id_aluno = :id_aluno";
                    $stmt2 = DB::prepare($sql2);
                    $stmt2->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
                    $stmt2->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
                    $stmt2->execute();
                }else{
                    //a sala NÃO é do instrutor no qual quer exlcuir o aluno.
                    echo "Você não possui permissão para essa ação.";
                }
            }
        }

        

    }

    public function excluirSala($id_sala, $id_instrutor){
        // Se ele deletar a sala, automaticamente todos os alunos ingressados seram removidos da sala
        $sql = "DELETE FROM sala_entrada WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->execute();

        $sql2 = "DELETE FROM sala WHERE id_dono = :id_instrutor AND id_sala = :id_sala";
        $stmt2 = DB::prepare($sql2);
        $stmt2->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt2->bindParam(':id_instrutor', $id_instrutor, PDO::PARAM_INT);
        $stmt2->execute();

    }

    public function excluirSalaAdmin($id_sala){
        // Se ele deletar a sala, automaticamente todos os alunos ingressados seram removidos da sala
        $sql = "DELETE FROM sala_entrada WHERE id_sala = :id_sala";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->execute();

        $sql2 = "DELETE FROM sala WHERE id_sala = :id_sala";
        $stmt2 = DB::prepare($sql2);
        $stmt2->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt2->execute();

    }

    public function sairSala($id_sala, $id_aluno){
        $sql = "DELETE FROM sala_entrada WHERE id_sala = :id_sala AND id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala, PDO::PARAM_INT);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
        $stmt->execute();
    }

    
    


}


?>