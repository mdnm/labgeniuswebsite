<?php
session_start();
require_once "../php/conn.php";

//função que carrega as classes automaticamente.
include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){
	
	$aluno = new Aluno();
	$id_aluno = $aluno->getId($_SESSION['user_session']);
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
	<?php 
		include "../include/app-side-nav.php";
		
	?>
	<div class="content-wrapper">
	
	<h1 class="page-title2">Entrar em uma Sala</h1>

		<div class="card">
			<form method="post" action="" class="cardform">
				<input class="flat-form-input" type="text" placeholder="Código da sala" name="idsala">
				<input class="flat-form-input" type="password" placeholder="Senha" name="senha">
				<input class="flat-form-button" type="submit" value="Entrar">
			</form>	
			<?php 
				$sala = new Sala();
				// Verifica se o formulário que envia as informações da sala foi submitado
				if(isset($_POST['idsala']) && !empty($_POST['idsala'])){
					// Seta os metodos da classe Sala()
					$sala->setIdAluno($id_aluno);
					$sala->setIdSala($_POST['idsala']);
					$sala->setSenha($_POST['senha']);
					$sala->ingressaSala();
					header("Location: myclassrooms.php");
				}else if(isset($_POST['idsala']) && empty($_POST['idsala'])){
					echo '<div class="error-msg"><p>Os campos estão vazios! </p></div>';
				}
			?>
	</div>

	</div>

</body>
</html>

<?php
	
					
}else{
	header("Location: index.php");
}

?>
