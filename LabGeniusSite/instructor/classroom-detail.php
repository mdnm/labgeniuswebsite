<?php
session_start();

include '../php/autoload.php';
if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$instrutor = new Instrutor();
	$id_instrutor = $instrutor->getId($_SESSION['user_session']);
	$aluno = new Aluno();
	$id_sala = $_GET['id'];
	$sala = new Sala();
	$curso = new Curso();


	if(isset($_GET['go']) && isset($_GET['id'])){
		if($_GET['go'] == 'remover'){
			$sala->removerAlunoSala($id_sala, $_GET['id_aluno'], $id_instrutor);
			// Limpa a url para que não exclua de novo
			echo "<script>window.location = 'classroom-detail.php?id=".$id_sala."';</script>";
		}
	}

	foreach ($sala->buscaSala($id_sala) as $key => $sala1) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $sala1->nome;?> - LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>

<div class="screens">
	<!--inclui o menu lateral-->
	<?php include "../include/instructor-side-nav.php";?>

	<div class="content-wrapper">
	
	<h1 class="page-title2"><?php echo $sala1->nome;?></h1>

		
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Alunos</h3>
		</div>
		<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
			<table class="order-table">
			<thead>
				<tr class="indice">
					<th>#</th>
					<th>ID</th>
					<th>Nome</th> 
					<th>Username</th>
					<th>E-mail</th>
					<th>#</th>
				</tr>
			</thead>
				
			<tbody>
				<?php 
					foreach ($sala->buscaAlunosSala($id_sala) as $key => $value) { ?>
						<tr headers="">
							<td id="info">
								<div class="rounded-image-moldure-small">
									<img src="../img/profile/<?php echo $aluno->getPicture($value->usuario);?>"/>
								</div>
							</td>
							<td id="info"><?php echo $value->id_aluno;?></td>
							<td id="info"><?php echo $value->nome;?></td>
							<td id="info"><?php echo $value->usuario;?></td>
							<td id="info"><?php echo $value->email;?></td>
							<td id="info"><a href="?go=remover&id=<?php echo $id_sala;?>&id_aluno=<?php echo $value->id_aluno;?>">Remover Aluno</a></td>
						</tr>
				<?php 
					} 				
				?>
			</tbody>		  
		</table>
		</div>

		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Cursos</h3>
		</div>
		<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
			<table class="order-table">
			<thead>
				<tr class="indice">
					<th>#</th>
					<th>Título</th> 
					<th>Descrição</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($curso->buscarCursoPrivado($id_sala) as $key => $value) { ?>
						<tr headers="<?php echo $value->id;?>">
							<td id="info" class="thumbnail"><div class="thumb-frame-rounded"><img class="thumbnail-image" src="../img/courses/thumb/<?php echo $value->thumbnail;?>"/></div></td>
							<td id="info"><?php echo $value->titulo;?></td>
							<td id="info"><?php echo $value->descricao;?></td>
							<td headers="<?php echo $value->id;?>"><a class="excluircurso"><i class="fa fa-times"></i>
						</tr>
				<?php 
					} 				
				?>	
			</tbody>	  
		</table>
		</div>
	</div>
<script>
	$(document).ready(function(){
		$(".order-table #info").click(function(){
			var id = $(this).parent().attr("headers");
			window.location = "course.php?id="+id;
		});
	});
</script>

</body>
</html>

<?php

}
}else{
	header("Location: index.php");
}

?>
