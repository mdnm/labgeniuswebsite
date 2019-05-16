<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$instrutor = new Instrutor();
	$id_instrutor = $instrutor->getId($_SESSION['user_session']);

	// Cria um objeto da classe sala.
	$sala = new Sala();
	// Verifica se o formulário que envia as informações da sala foi submitado
	if(isset($_POST['nome']) && !empty($_POST['nome'])){
		// Seta os metodos da classe Sala()
		$sala->setInstrutor($id_instrutor);
		$sala->setNome($_POST['nome']);
		$sala->setSenha($_POST['senha']);
		$sala->insertSala();
		header('Location: myclassrooms.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>

<div class="screens">
	<?php include "../include/instructor-side-nav.php";?>
	<div class="content-wrapper">
	
	<h1 class="page-title2">Criar Sala de Aula</h1>

	<div class="card">
		<form method="post" action="addclassroom.php" class="cardform">
			<input class="flat-form-input" type="text" placeholder="Nome da sala" name="nome">
			<input class="flat-form-input" type="password" placeholder="Senha" name="senha">
			<input class="flat-form-button" type="submit" value="Criar">
		</form>	
	</div>

	</div>
</body>
</html>

<?php

}else{
	header("Location: index.php");
}

?>
