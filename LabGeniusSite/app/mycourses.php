<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){
	$aluno = new Aluno();
	$curso = new Curso();
	$instrutor = new Instrutor();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Meus Cursos - LabGenius</title>
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
		include "../include/app-side-nav.php";
		?>
		<div class="content-wrapper" id="gray">
			<h1 class="page-title2 animate fadeIn">Meus Cursos</h1>
			<?php
			if($curso->mostrarCursosIngressados($aluno->getId($_SESSION['user_session']))){

			
				foreach ($curso->mostrarCursosIngressados($aluno->getId($_SESSION['user_session'])) as $key => $curso_view) {
			?>
				<a href="course.php?id=<?php echo $curso_view->id;?>">
					<div class="info-card animate-delay2 fadeIn" style="height: 150px;">
						<div class="img-wrapper" style="width:20%;">
							<div class="img" style="background-image:url(../img/courses/thumb/<?php echo $curso_view->thumbnail;?>)"></div>
						</div>
						<div class="info-content" style="width:80%;">
							<h3><?php echo $curso_view->titulo;?></h3>
							<h4><?php echo $instrutor->getFullnameById($curso_view->id_owner);?></h4>
							<p><?php echo $curso_view->descricao;?></p>
							<div class="progress-cont">
								<div class="progress-bar">
									<span class="progress" style="width:<?php echo $curso->getPercent($curso_view->id, $aluno->getId($_SESSION['user_session']))."%";?>"></span>
								</div>
								<b><?php echo round($curso->getPercent($curso_view->id, $aluno->getId($_SESSION['user_session'])))."%";?></b>
							</div>
						</div>
					</div>
				</a>
			<?php
			}
				}else{
			?>
					<div class="blocks-container" style="width:100%">
						<img src="../img/icons/graduation-cap.png" class="position-center" style="width:20%;margin-top:70px;opacity:0.2;">
						<h4 class="align-center" style="margin-top:30px;color:lightgray">Você não está ingressado em nenhum curso ainda.</h4>
					</div>

			<?php
				}  
			?>
		
		</div>
	</div>
	<script></script>
</body>
</html>

<?php

}else{
	header("Location: ../index.php");
}

?>
