<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$instrutor = new Instrutor();
	$curso = new Curso();
	$aluno = new Aluno();
	$aula = new Aula();
	$id = $instrutor->getId($_SESSION['user_session']);
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
	<!--inclui o menu lateral-->
	<?php include "../include/instructor-side-nav.php";?>
	<div class="content-wrapper">

		<div class="blocks-container" style="width:75%;">
			<div class="blocks-wrapper" style="padding:0px 30px 0px 20px; box-sizing:border-box;">
				<div class="container-3-divide">
					<div class="info-card" style="height: 100px;">
						<div class="img-wrapper" style="background: #0296f2;width:40%;">
							<i class="fas fa-users fa-2x"></i>
						</div>
						<div class="info-content" style="width:60%;box-sizing:none !important;padding:0 !important;">
							<h1><?php echo $aluno->getTotalAlunos($id);?></h1>
							<h4 class="align-center">Alunos</h4>
						</div>
					</div>
					
				</div>
				<div class="container-3-divide">
					<div class="info-card" style="height: 100px;">
						<div class="img-wrapper" style="background: #60d600;width:40%;">
							<i class="fas fa-chart-bar fa-2x"></i>
						</div>
						<div class="info-content" style="width:60%;box-sizing:none !important;padding:0 !important;">
							<h1><?php echo $aula->getViews($id);?></h1>
							<h4 class="align-center">Visualizações</h4>
						</div>
					</div>
				</div>
				<div class="container-3-divide">
					<div class="info-card" style="height: 100px;">
						<div class="img-wrapper" style="background: #ffdb11;width:40%;">
							<i class="fas fa-graduation-cap fa-2x"></i>
						</div>
						<div class="info-content" style="width:60%;box-sizing:none !important;padding:0 !important;">
							<h1><?php echo $curso->getTotalCursos($id);?></h1>
							<h4 class="align-center">Cursos</h4>
						</div>
					</div>
				</div>
			</div>

			<div class="blocks-wrapper" style="box-sizing:border-box;padding:0px 20px 0px 20px;">
				<div class="block-cont" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
					<table class="order-table">
						<thead>
							<tr class="indice">
								<th>#</th>
								<th>Título</th>
								<th>Descrição</th> 
								<th>Visibilidade</th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							foreach ($curso->buscarCursos($id) as $key => $value) {
						?>
								<tr headers="<?php echo $value->id;?>">
									<td id="info" class="thumbnail"><div class="thumb-frame-rounded"><img class="thumbnail-image" src="../img/courses/thumb/<?php echo $value->thumbnail;?>"/></div></td>
									<td id="info" class="bold-text"><?php echo $value->titulo;?></td>
									<td id="info" style="color:gray;" class="regular-text"><?php echo $value->descricao;?></td>
									<?php
										if($value->visibilidade == 1){
											echo '<td id="info" class="privacy-status"><span class="status positive">Público</span></td>';
										}else{
											echo '<td id="info" class="privacy-status"><span class="status negative">Privado</span></td>';
										}
									?>

						</a></td>
								</tr>
						<?php
							}
						?>
						</tbody>		  
					</table>
				</div>
			</div>
		</div>

		<div class="blocks-container-right" style="width:25%;height:100%;float:right;box-sizing:border-box;padding:15px 20px 0px 0px;">
				<div class="block-cont" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
					<table class="order-table">
						<thead>
							<tr class="indice">
								<th>Sala</th>
								<th>Status</th>  
							</tr>
						</thead>
							
						<tbody>

						<?php
							$sala = new Sala();
							foreach ($sala->buscaSalas($id) as $key => $value) {
						?>
								<tr headers="<?php echo $value->id_sala;?>">
									<td id="info"><?php echo $value->nome;?></td>
									<?php
									if($value->senha == ""){
										echo '<td id="info"><span class="status positive">Aberta</span></td>';
									}else{
										echo '<td id="info"><span class="status negative">Fechada</span></td>';
									}

									?>
								</tr>
						<?php
							}

							if(isset($_GET['go'])&& isset($_GET['id'])){
								if($_GET['go'] == 'excluir'){
									$sala->excluirSala($_GET['id'],$id);
									echo "<script>window.location = 'myclassrooms.php';</script>";
								}
							}
							
						?>
				
						</tbody>		  
					</table>
				</div>
				
		</div>
		<div class="blocks-container">
							
		</div>

	
		
		
	</div>

</body>
</html>

<?php

}else{
	header("Location: index.php");
}

?>
