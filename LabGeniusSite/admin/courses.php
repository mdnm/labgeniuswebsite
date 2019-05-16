<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 3){

	$admin = new Admin();
	$curso = new Curso();
	$lgcurso = new LabgeniusCurso();


?>
<!DOCTYPE html>
<html>
	<head>
		<title>LabGenius</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
		<script src="../js/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
		<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.theme.default.min.css">
	    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
	</head>
<body>

<div class="screens">
	<!--inclui o menu lateral-->
	<?php 		
	include "../include/admin-side-nav.php";
	?>
	<div class="content-wrapper">
		<br></br>
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Oficiais do LabGenius</h3>
			<a href="addcourse.php" class="simple-button">+ Criar Curso</a>
		</div>
		<br></br>
		<div class="owl-wrapper">
			<div class="owl-carousel">
				<?php
					foreach ($lgcurso->buscarCursos() as $key => $value) {
				?>
						<a href="course.php?id=<?php echo $value->id;?>">
							<div class="cat-block" id="software" style="background-color:<?php echo $value->color;?>;box-shadow: 0px 9px 0px 0px rgba(0,0,0,0.10), 0px 9px 0px 0px <?php echo $value->color;?>">
								<div class="cat-img-cont">
									<img src="../img/labcourses/icons/<?php echo $value->img;?>"/>
								</div>
								<div class="cat-title-cont">
									<p><?php echo $value->titulo;?></p>
								</div>
							</div>
						</a>
				<?php
					}
				?>
			</div>
		</div>
			<br></br>
			<div class="table-nav-btns position-center width90">
				<h3 class="table-nav-title">Outros Cursos</h3>
				<a href="addcourse.php" class="simple-button">+ Criar Curso</a>
			</div>
			<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
				<table class="order-table">
					<thead>
						<tr class="indice">
							<th>#</th>
							<th>Título</th>
							<th>Descrição</th>
							<th>Autor</th> 
							<th>Visibilidade</th>
							<th>#</th>
						</tr>
					</thead>
					
					<tbody>
					<?php
						foreach ($curso->buscarTodosCursos() as $key => $value) {
					?>
							<tr headers="<?php echo $value->id;?>">
								<td id="info" class="thumbnail"><div class="thumb-frame-rounded"><img class="thumbnail-image" src="../img/courses/thumb/<?php echo $value->thumbnail;?>"/></div></td>
								<td id="info" class="bold-text"><?php echo $value->titulo;?></td>
								<td id="info" class="regular-text"><?php echo $value->descricao;?></td>
								<td id="info" class="regular-text"><?php echo $curso->getInstructorName($value->id);?></td>
								<?php
									if($value->visibilidade == 1){
										echo '<td id="info" class="privacy-status">Público</td>';
									}else{
										echo '<td id="info" class="privacy-status">Privado</td>';
									}
								?>
								<td id="info" class="icon-options"><a href="?go=excluir&id=<?php echo $value->id;?>"><i class="far fa-trash-alt fa-lg"></i>

					</a></td>
							</tr>
					<?php
						}

						if(isset($_GET['go'])&& isset($_GET['id'])){
							if($_GET['go'] == 'excluir'){
								echo "<script>alert('Exlcuido com sucesso!');</script>";
								echo $curso->excluirCurso($id, $_GET['id']);
								// Limpa a url para que não exclua de novo
								echo "<script>window.location = 'mycourses.php';</script>";
							}
						}
					?>
					</tbody>		  
				</table>
			</div>

	<br></br>
	</div>


	<script src="../plugins/owlcarousel/owl.carousel.min.js"></script>
	<script>
		$(document).ready(function(){
		$(".owl-carousel").owlCarousel({
			margin: 10,
			nav: true,
			center: true,
			loop: true,
			navText: [
				"<i></i>",
				"<i></i>"
			],
			responsive: {
				900: {
				items: 3,
				},
				1100: {
				items: 4,
				},
				1300: {
				items: 4
				},
				1400: {
				items: 5
				}
				
			}
		});
		});
	</script>

</body>
</html>

<?php

}else{
	header("Location: ../index.php");
}

?>
