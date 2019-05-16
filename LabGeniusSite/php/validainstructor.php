<?php

require_once "conn.php";
session_start();
    
    $user = $_POST['user'];
    $user = trim($user);

    $senha = $_POST['passwd'];

if (empty($user)){
        $_SESSION['vazio_user2'] = "<p class='alertlog'>*Preencha todos os campos.</p>";
        //echo "<meta http-equiv='refresh' content='0, url=../login.php'>";
        header("Location: ../login.php?form=instrutor");
        #echo "<script>alert('Preencha todos os campos!'); history.back();</script>";

    }else if (empty($senha)){
        $_SESSION['vazio_senha2'] = "<p class='alertlog'>*Preencha todos os campos.</p>";
        //echo "<meta http-equiv='refresh' content='0, url=../login.php'>";
        header("Location: ../login.php?form=instrutor");
        #echo "<script>alert('Preencha todos os campos!'); history.back();</script>";
    
    }else{
 
        $query1 = mysqli_num_rows(mysqli_query($conn, "SELECT usuario FROM INSTRUTOR WHERE usuario = '$user' AND senha = '$senha'"));
        
        
        if($query1 == 1){
            $_SESSION ['user_session'] = $user;
            $_SESSION ['passwd_session'] = $senha;
            $_SESSION['user_type'] = 2;
            
            
            header("Location: ../instructor/index.php");
           
        }else{
            
            $_SESSION['aut_error2'] = "<p class='alertlog'>Usuário e senha incorretos.</p>";
            header("Location: ../login.php?form=instrutor");
             
            
            
            
            
        }
    }

?>