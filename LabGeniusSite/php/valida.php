<?php

require_once "conn.php";
session_start();
    
    $user = $_POST['user'];
    $user = trim($user);

    $senha = $_POST['passwd'];

if (empty($user)){
        $_SESSION['vazio_user'] = "<p class='alertlog'>*Preencha todos os campos.</p>";
        header("Location: ../login.php?form=aluno");

    }else if (empty($senha)){
        $_SESSION['vazio_senha'] = "<p class='alertlog'>*Preencha todos os campos.</p>";
        header("Location: ../login.php?form=aluno");

    }else{
 
        $query1 = mysqli_num_rows(mysqli_query($conn, "SELECT usuario FROM aluno WHERE usuario = '$user' AND senha = '$senha'"));
        
        
        if($query1 == 1){
            $_SESSION ['user_session'] = $user;
            $_SESSION ['passwd_session'] = $senha;
            $_SESSION['user_type'] = 1;
            
            
            echo "<script>alert('Logado com Sucesso!');</script>";
            header("Location: ../app/");
           
        }else{
            
            $_SESSION['aut_error'] = "<p class='alertlog'>Usuário e senha incorretos.</p>";
            header("Location: ../login.php?form=aluno");
             
            
            
            
            
        }
    }

?>