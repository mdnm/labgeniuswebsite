 <?php

require_once "conn.php";
session_start();
    
    $user = $_POST['user'];
    $user = trim($user);

    $senha = $_POST['passwd'];

if (empty($user)){
        $_SESSION['vazio_user'] = "<p class='alertlog'>*Preencha todos os campos.</p>";
        header("Location: ../admin/index.php");

    }else if (empty($senha)){
        $_SESSION['vazio_senha'] = "<p class='alertlog'>*Preencha todos os campos.</p>";
        header("Location: ../admin/index.php");

    }else{
 
        $query1 = mysqli_num_rows(mysqli_query($conn, "SELECT usuario FROM admin WHERE usuario = '$user' AND senha = '$senha'"));
        
        
        if($query1 == 1){
            $_SESSION ['user_session'] = $user;
            $_SESSION ['passwd_session'] = $senha;
            $_SESSION['user_type'] = 3;
            header("Location: ../admin/dashboard.php");
           
        }else{
            
            $_SESSION['aut_error'] = "<p class='alertlog'>Usuário e senha incorretos.</p>";
            header("Location: ../admin/index.php");
             
            
            
            
            
        }
    }

?>