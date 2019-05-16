<?php
    require_once "php/conn.php";
    session_start();


    if (!isset($_SESSION['user_session']) && !isset($_SESSION['passwd_session'])){


?>
<!DOCTYPE html>
<html>
<head>
	<title>LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script type="text/javascript" src="js/jquery.mask.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800,900" rel="stylesheet">
	<link rel="shortcut icon" href="img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>

<div class="screencad">

<?php include "include/white-nav.php";

if(@$_GET['form'] == 'instrutor'){
?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#optionform").css("display", "none");
		$("#formcad").css("display", "none");
		$("#formcad-prof").css("display", "block");
	});
</script>
<?php
}else if(@$_GET['form'] == 'aluno'){
?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#optionform").css("display", "none");
		$("#formcad-prof").css("display", "none");
		$("#formcad").css("display", "block");
	});
</script>
<?php
}else{
?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#formcad-prof").css("display", "none");
		$("#formcad").css("display", "none");
		$("#optionform").css("display", "block");
	});
</script>
<?php
}
?>

<div id="optionform" class="login-cont-form animate-fast fadeInUpCenter">
    <div class="flat-form-header">
        <h2 class="form-title">Crie sua nova conta</h2>
    </div>
    <div class="flat-popup-menu">
	<a href="#" class="nonstyle-link">
		<div class="flat-form-left">
			<div id="aluno" class="flat-square-btn">
				<img src="img/icons/boy.png"/>
				<h3>Sou Aluno</h3>
			</div>
		</div>
		</a>
		<a href="#" class="nonstyle-link">
			<div class="flat-form-right">
				<div id="instrutor" class="flat-square-btn">
					<img src="img/icons/boss.png"/>
					<h3>Sou Instrutor</h3>
				</div>
			</div>
		</a>
    </div>
</div>

<div id="formcad" class="login-cont-form animate-fast fadeInUpCenter">
    <div class="flat-form-header">
		<div class="header-btns">
			<img id="back" src="img/icons/left-arrow.png"/>
			<h2>Crie sua nova conta</h2>
		</div>
    </div>
    <div class="flat-form-body">
        <form class="flat-form animate-delay2 fadeIn" method="post" action="php/validacad.php">
            <input class="flat-form-input" id="user" type="text" name="user" placeholder="USUÁRIO"/>
            <input class="flat-form-input" id="nome" type="text" name="nome" placeholder="NOME"/>
            <input class="flat-form-input" id="sobrenome" type="text" name="sobrenome" placeholder="SOBRENOME"/>
            <input class="flat-form-input" id="email" type="email" name="email" placeholder="E-MAIL"/>
            <input class="flat-form-input" id="passwd" type="password" name="passwd" placeholder="SENHA"/>
            <input class="flat-form-button" type="submit" value="ENTRAR"/>
            <?php
				if(!empty($_SESSION['vazio_user'])){
					echo $_SESSION['vazio_user'];
					unset($_SESSION['vazio_user']);
				}else
					
				if(!empty($_SESSION['vazio_nome'])){
					echo $_SESSION['vazio_nome'];
					unset($_SESSION['vazio_nome']);
				}else 

				if(!empty($_SESSION['vazio_sobrenome'])){
					echo $_SESSION['vazio_sobrenome'];
					unset($_SESSION['vazio_sobrenome']);
				}else 

				if(!empty($_SESSION['vazio_email'])){
					echo $_SESSION['vazio_email'];
					unset($_SESSION['vazio_email']);
				}else 
										
				if(!empty($_SESSION['vazio_senha'])){
					echo $_SESSION['vazio_senha'];
					unset($_SESSION['vazio_senha']);
				}else 
				
				if(!empty($_SESSION['user_exist'])){
					echo $_SESSION['user_exist'];
					unset($_SESSION['user_exist']);
				}else 
					
				if(!empty($_SESSION['error_autmail'])){
					echo $_SESSION['error_autmail'];
					unset($_SESSION['error_autmail']);
				}
			?>
            <p class="flat-form-message">Você já tem uma conta? <a href="#">Entre agora.</a></p>
        </form>
    </div>
</div>


<div id="formcad-prof" class="login-cont-form animate-fast fadeInUpCenter">
    <div class="flat-form-header">
		<div class="header-btns">
			<img id="back2" src="img/icons/left-arrow.png"/>
			<h2>Crie sua nova conta instrutor</h2>
		</div>
    </div>
    <div class="flat-form-body">
        <form class="flat-form animate-delay2 fadeIn" method="post" action="php/validacad-prof.php">
            <input class="flat-form-input" id="user" type="text" name="user-instrutor" placeholder="USUÁRIO"/>
            <input class="flat-form-input" id="nome" type="text" name="nome-instrutor" placeholder="NOME"/>
            <input class="flat-form-input" id="sobrenome" type="text" name="sobrenome-instrutor" placeholder="SOBRENOME"/>
            <input class="flat-form-input" id="email" type="email" name="email-instrutor" placeholder="E-MAIL"/>
            <input class="flat-form-input" id="passwd" type="password" name="passwd-instrutor" placeholder="SENHA"/>
            <input class="flat-form-button" type="submit" value="ENTRAR"/>
            <?php
				if(!empty($_SESSION['vazio_user2'])){
					echo $_SESSION['vazio_user2'];
					unset($_SESSION['vazio_user2']);
				}else
					
				if(!empty($_SESSION['vazio_nome2'])){
					echo $_SESSION['vazio_nome2'];
					unset($_SESSION['vazio_nome2']);
				}else 

				if(!empty($_SESSION['vazio_sobrenome2'])){
					echo $_SESSION['vazio_sobrenome2'];
					unset($_SESSION['vazio_sobrenome2']);
				}else 

				if(!empty($_SESSION['vazio_email2'])){
					echo $_SESSION['vazio_email2'];
					unset($_SESSION['vazio_email2']);
				}else 
										
				if(!empty($_SESSION['vazio_senha2'])){
					echo $_SESSION['vazio_senha2'];
					unset($_SESSION['vazio_senha2']);
				}else 
				
				if(!empty($_SESSION['user_exist2'])){
					echo $_SESSION['user_exist2'];
					unset($_SESSION['user_exist2']);
				}else 
					
				if(!empty($_SESSION['error_autmail2'])){
					echo $_SESSION['error_autmail2'];
					unset($_SESSION['error_autmail2']);
				}
			?>
            <p class="flat-form-message">Você já tem uma conta? <a href="#">Entre agora.</a></p>
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
			
			
			$("#aluno").click(function(){
				$("#optionform").css("display", "none");
				$("#formcad").css("display", "block");
			});
			
			$("#back").click(function(){
				$("#formcad").css("display", "none");
				$("#optionform").css("display", "block");
			});
			
			$("#back2").click(function(){
				$("#formcad-prof").css("display", "none");
				$("#optionform").css("display", "block");
			});
			
			$("#instrutor").click(function(){
				$("#optionform").css("display", "none");
				$("#formcad-prof").css("display", "block");
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
    header("Location: index.php");

}
?>