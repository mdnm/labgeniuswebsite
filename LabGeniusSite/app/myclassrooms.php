<?php
session_start();
require_once "../php/conn.php";

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){

$aluno = new Aluno();
$sala = new Sala();
$id_aluno = $aluno->getId($_SESSION['user_session']);

if(isset($_GET['go'])&& isset($_GET['id'])){
	if($_GET['go'] == 'sair'){
		$sala->sairSala($_GET['id'], $id_aluno);
		// Limpa a url para que não exclua de novo
		echo "<script>window.location = 'myclassrooms.php';</script>";
		echo "<script>alert('Você saiu da sala');</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Minhas Salas - LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>

<div class="screens">
	<!--inclui o menu lateral-->
	<?php 
		include "../include/app-side-nav.php";
		
	?>
	<div class="content-wrapper">
	
	<h1 class="page-title2">Minhas Salas</h1>

		
		<div class="table-nav-btns position-center width90 animate fadeIn">
			<h3 class="table-nav-title">Salas</h3>
			<a href="ingressarsala.php" class="simple-button">Entrar em sala de aula</a>
		</div>
		
		<div class="block-cont position-center width90 animate-delay2 fadeIn" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
			<table class="order-table">
				<thead>
					<tr class="indice">
						<th>Status</th>
						<th>Código</th> 
						<th>Nome</th>
						<th>#</th>
					</tr>
				</thead>

				
					
				<tbody>
					<?php
						foreach ($sala->buscaSalasAluno($aluno->getId($_SESSION['user_session'])) as $key => $sala_view) {
							echo '<tr headers="'.$sala_view->id_sala.'">';
							if($sala_view->senha == ""){
								echo '<td id="info"><span class="status positive">Aberta</span></td>';
							}else{
								echo '<td id="info"><span class="status negative">Fechada</span></td>';
							}
							echo '
									<td id="info">'.$sala_view->id_sala.'</td>
									<td id="info">'.$sala_view->nome.'</td>';
									
		
									echo '
									<td id="info"><a href="?go=sair&id='.$sala_view->id_sala.'">Sair</a></td>
								</tr>';
						}
					?>
				</tbody>
						  
			</table>
			
		</div>
		<?php
			if($sala->buscaSalasAluno($aluno->getId($_SESSION['user_session']))){
			}else{
		?>
				<div class="blocks-container" style="width:100%">
					<img src="../img/icons/discussion.png" class="position-center" style="width:20%;margin-top:70px;opacity:0.2;">
					<h4 class="align-center" style="margin-top:30px;color:lightgray">Você não entrou em nenhuma sala ainda.</h4>
				</div>
		<?php
			}
		?>
		

	</div>

<script>
	$(document).ready(function(){
		$(".order-table #info").click(function(){
			var id = $(this).parent().attr("headers");
			window.location = "classroom-detail.php?id="+id;
		});
	});
</script>

</body>
</html>

<?php

}else{
	header("Location: index.php");
}

?>
