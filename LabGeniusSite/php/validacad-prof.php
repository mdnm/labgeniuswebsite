<?php

require_once "conn.php";
session_start();

include 'autoload.php';

    $user = $_POST['user-instrutor'];
    $email = $_POST['email-instrutor'];
    $senha = $_POST['passwd-instrutor'];
    $nome = $_POST['nome-instrutor'];
    $nome = preg_replace('/\d/', '', $nome);
    $nome = preg_replace('/[\n\t\r]/', ' ', $nome);
    $nome = preg_replace('/\s(?=\s)/', '', $nome);
    $nome = trim($nome);

    $sobrenome = $_POST['sobrenome-instrutor'];
    $sobrenome = preg_replace('/\d/', '', $sobrenome);
    $sobrenome = preg_replace('/[\n\t\r]/', ' ', $sobrenome);
    $sobrenome = preg_replace('/\s(?=\s)/', '', $sobrenome);
    $sobrenome = trim($sobrenome);


    if (empty($user)){
        $_SESSION['vazio_user2'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?form=instrutor");
    }else  
        
    if (empty($nome)){
        $_SESSION['vazio_nome2'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?form=instrutor");        
    }else  
    
    if (empty($sobrenome)){
        $_SESSION['vazio_sobrenome2'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?form=instrutor");
    
    } 

    else  
    
   

    if (empty($email)){
        $_SESSION['vazio_email2'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?form=instrutor");
    }else

    if (empty($senha)){
        $_SESSION['vazio_senha2'] = "<p class='alertlog'>Preencha todos os campos.<p>";
        header("Location: ../cadastro.php?form=instrutor");
    }else{
 
        $query1 = mysqli_query($conn, "SELECT usuario FROM INSTRUTOR WHERE usuario = '$user'");
        $query2 = mysqli_query($conn, "SELECT email FROM INSTRUTOR WHERE email = '$email'");
        
        if(mysqli_num_rows($query1) > 0){
            
            $_SESSION['user_exist2'] = "<p class='alertlog'>Usuário já existe.<p>";
            header("Location: ../cadastro.php?form=instrutor");
           
            
        }else if (mysqli_num_rows($query2) > 0){
            
            
            $_SESSION['error_autmail2'] = "<p class='alertlog'>E-mail já cadastrado, <strong><a href='login.php'>fazer login</a></strong></p>";
            header("Location: ../cadastro.php?form=instrutor");
            
            
        }else{
            
            $instrutor = new Instrutor();
            $instrutor->Cadastrar($nome, $sobrenome, $email, $senha, $user);

            $_SESSION['user_session'] = $user;
            $_SESSION['passwd_session'] = $senha;
            $_SESSION['user_type'] = 2;
            header("Location: ../instructor/index.php");
            
            
        }
    } 

?>