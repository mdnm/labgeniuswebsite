<?php

require_once "conn.php";
session_start();

include 'autoload.php';

    $user = $_POST['user'];
    $email = $_POST['email'];
    $senha = $_POST['passwd'];
    $nome = $_POST['nome'];
    $nome = preg_replace('/\d/', '', $nome);
    $nome = preg_replace('/[\n\t\r]/', ' ', $nome);
    $nome = preg_replace('/\s(?=\s)/', '', $nome);
    $nome = trim($nome);

    $sobrenome = $_POST['sobrenome'];
    $sobrenome = preg_replace('/\d/', '', $sobrenome);
    $sobrenome = preg_replace('/[\n\t\r]/', ' ', $sobrenome);
    $sobrenome = preg_replace('/\s(?=\s)/', '', $sobrenome);
    $sobrenome = trim($sobrenome);


    if (empty($user)){
        $_SESSION['vazio_user'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?id=aluno");
    }else  
        
    if (empty($nome)){
        $_SESSION['vazio_nome'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?id=aluno");        
    }else  
    
    if (empty($sobrenome)){
        $_SESSION['vazio_sobrenome'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?id=aluno");
    
    } 

    else  
    
   

    if (empty($email)){
        $_SESSION['vazio_email'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?id=aluno");
    }else

    if (empty($senha)){
        $_SESSION['vazio_senha'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?id=aluno");
    }else{
 
        $query1 = mysqli_query($conn, "SELECT usuario FROM ALUNO WHERE usuario = '$user'");
        $query2 = mysqli_query($conn, "SELECT email FROM ALUNO WHERE email = '$email'");
        
        if(mysqli_num_rows($query1) > 0){
            
            $_SESSION['user_exist'] = "<p class='alertlog'>Usuário já existe.<p>";
            header("Location: ../cadastro.php?id=aluno");
           
            
        }else if (mysqli_num_rows($query2) > 0){
            
            
            $_SESSION['error_autmail'] = "<p class='alertlog'>E-mail já cadastrado, <strong><a href='login.php'>fazer login</a></strong></p>";
            header("Location: ../cadastro.php?id=aluno");
            
            
        }else{

            $aluno = new Aluno();
            $aluno->cadastrar($nome, $sobrenome, $email, $senha, $user);


            $_SESSION['user_session'] = $user;
            $_SESSION['passwd_session'] = $senha;
            $_SESSION['user_type'] = 1;
            
            header("Location: ../app/");
            
            
        }
    } 

?>