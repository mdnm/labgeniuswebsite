<?php
    require_once "../php/conn.php";
    session_start();

    if (!isset($_SESSION['user_session']) && !isset($_SESSION['passwd_session'])){


?>
<!DOCTYPE html>
<html>
<head>
    <title>LabGenius</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
    <link rel="shortcut icon" href="img/icons/atom-small.png" type="image/x-icon"/>
</head>
<body id="loginpage">

<?php include "../include/white-admnav.php";

if(@$_GET['form'] == 'instrutor'){
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#aluno").css("display", "none");
        $("#instructor").css("display", "block");
        $(".flat-form-body").css({"background-color": "#1f1f1f", "-webkit-box-shadow": "0px 10px 0px 0px #1a1a1a", "-moz-box-shadow": "0px 10px 0px 0px #1a1a1a", "box-shadow": "0px 10px 0px 0px #1a1a1a"});
        $(".flat-form .flat-form-input").css({"background-color": "rgb(65, 65, 65)", "color": "lightgray"});
        $(".flat-form .flat-form-message a").css("color", "white");
    });
</script>
<?php
}else if(@$_GET['form'] == 'aluno'){
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#instructor").css("display", "none");
        $("#aluno").css("display", "block");
        $(".flat-form-body").css({"background-color": "#e4e4e4", "-webkit-box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)", "-moz-box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)", "box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)"});
        $(".flat-form .flat-form-input").css({"background-color": "lightgray", "color": "gray"});
        $(".flat-form .flat-form-message a").css("color", "black");
    });
</script>
<?php
}else{
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#instructor").css("display", "none");
        $("#aluno").css("display", "block");
        $(".flat-form-body").css({"background-color": "#e4e4e4", "-webkit-box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)", "-moz-box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)", "box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)"});
        $(".flat-form .flat-form-input").css({"background-color": "lightgray", "color": "gray"});
        $(".flat-form .flat-form-message a").css("color", "black");
    });
</script>
<?php
}
?>

<div class="login-cont-form animate-fast fadeInUpCenter">
    <div class="flat-form-header">
        <h2 class="form-title">Acesso Restrito</h2>
    </div>
    <div id="aluno" class="flat-form-body">
        <form class="flat-form animate-fast fadeIn" method="post" action="../php/admlog_process.php">
            <input class="flat-form-input" id="user" type="text" name="user" placeholder="USUÁRIO"/>
            <input class="flat-form-input" id="passwd" type="password" name="passwd" placeholder="SENHA"/>
            <?php
                if(!empty($_SESSION['vazio_user'])){
                    echo $_SESSION['vazio_user'];
                    unset($_SESSION['vazio_user']);
                }else
                                        
                if(!empty($_SESSION['vazio_senha'])){
                    echo $_SESSION['vazio_senha'];
                    unset($_SESSION['vazio_senha']);
                }else 
                
                if(!empty($_SESSION['aut_error'])){
                    echo $_SESSION['aut_error'];
                    unset($_SESSION['aut_error']);
                }
            ?>
            <input class="flat-form-button" type="submit" value="ENTRAR"/>
            <p class="flat-form-message">Como assim você não tem conta? <a href="cadastro.php">Crie uma.</a></p>
        </form>
    </div>
   
</div>

<script type="text/javascript">

        $(document).ready(function () {


            $("#user").focus(function(){
                $("#user").attr("placeholder", "");
            });

            $("#user").focusout(function(){
                $("#user").attr("placeholder", "Username");
            });

            $("#passwd").focus(function(){
                $("#passwd").attr("placeholder", "");
            });

            $("#passwd").focusout(function(){
                $("#passwd").attr("placeholder", "Senha");
            });

            $("#email").focus(function(){
                $("#email").attr("placeholder", "");
            });

            $("#email").focusout(function(){
                $("#email").attr("placeholder", "E-mail");
            });

            $("#nome").focus(function(){
                $("#nome").attr("placeholder", "");
            });

            $("#nome").focusout(function(){
                $("#nome").attr("placeholder", "Nome");
            });
            

            $("#sobrenome").focus(function(){
                $("#sobrenome").attr("placeholder", "");
            });

            $("#sobrenome").focusout(function(){
                $("#sobrenome").attr("placeholder", "Sobrenome");
            });

            $(".form-header-btn-left").click(function(){
                $(".form-header-btn-right").removeClass("active-btns");
                $(".form-header-btn-left").addClass("active-btns");
                $("#instructor").css("display", "none");
				$("#aluno").css("display", "block");
                $(".flat-form-body").css({"background-color": "#e4e4e4", "-webkit-box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)", "-moz-box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)", "box-shadow": "0px 10px 0px 0px rgba(204,204,204,1)"});
                $(".flat-form .flat-form-input").css({"background-color": "lightgray", "color": "gray"});
                $(".flat-form .flat-form-message a").css("color", "black");
            });

            $(".form-header-btn-right").click(function(){
                $(".form-header-btn-left").removeClass("active-btns");
                $(".form-header-btn-right").addClass("active-btns");
                $("#aluno").css("display", "none");
				$("#instructor").css("display", "block");
                $(".flat-form-body").css({"background-color": "#1f1f1f", "-webkit-box-shadow": "0px 10px 0px 0px #1a1a1a", "-moz-box-shadow": "0px 10px 0px 0px #1a1a1a", "box-shadow": "0px 10px 0px 0px #1a1a1a"});
                $(".flat-form .flat-form-input").css({"background-color": "rgb(65, 65, 65)", "color": "lightgray"});
                $(".flat-form .flat-form-message a").css("color", "white");
            });


            
        });
    </script>


<script>

function myFunction(x) { 
    document.getElementById("mySidenav").classList.toggle("open");
    x.classList.toggle("change");
}
</script>

</body>
</html>

<?php

}else{
    header("Location: dashboard.php");

}
?>