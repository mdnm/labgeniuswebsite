<?php
session_start();
include '../php/autoload.php';
if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){

	if(isset($_GET['id'])){
		$id_aula = $_GET['id'];
	}

	if(isset($_GET['idc'])){
		$id_curso = $_GET['idc'];
	}
$labaula = new LabgeniusAula();



?>
<!DOCTYPE html>
<html>
<head>	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.theme.default.min.css">
    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
</head>
<body id="class-body">

<div class="screen">
<nav class="nav-bar">
	<div class="left-nav-content">
		<a onclick="history.back()" id="back-btn">
      	<img src="../img/icons/back.png" class="back-nav-btn">
      </a>
	</div>
	<div class="middle-nav-content">
		<h5>
		<?php 
			if(isset($_GET['final']) && $_GET['final'] == '1'){
				echo 'Curso concluído';
			}else{
				echo $labaula->getTitulo($id_aula);
			}
		?>
		</h5>
	</div>
	<div class="right-nav-content">
	</div>
</nav>

<!-- [DIALOG | IMAGE | BUTTON] -->
	
<?php

if(isset($_GET['final']) && $_GET['final'] == '1'){
	echo "Você chegou ao fim!<a href='index.php'>voltar para página inicial</a>";
}else{
	$type = $labaula->getType($id_aula);
	if($type == "1"){
		foreach ($labaula->buscarConteudoAula($id_aula, $id_curso, $type) as $key => $value) {
			$prox_aula_ordem =  $labaula->getOrdem($id_aula)+1;
			$prox_aula = $labaula->getIdByOrdem($prox_aula_ordem, $id_curso);
?>
				<div class="dialog-cont">
				<div class="dialog-teach-cont">
					<img class="img-teacher animate2 fadeIn" src="../img/defaultprofile/monster_teacher.png"/>
				</div>
				<div class="dialog-message-cont">
					<div class="dialog-box animate fadeInUp">
						<h4><?php echo $value->dialog;?></h4>
					</div>
				</div>
				</div>

				<div class="cont-aula">
				<img src="../img/labcourses/classes/img/<?php echo $value->img;?>" class="conteudo-img animate-delay fadeInGrow"/>
				</div>

				<?php
					if($prox_aula == '0'){
				?>
					<div class="bottom-bar">
						<a class="next-btn" href="aula.php?final=1">AVANÇAR <i class="fas fa-arrow-right"></i></a>
					</div>
				<?php		
					}else{
				?>
					<div class="bottom-bar">
						<a class="next-btn" href="aula.php?id=<?php echo $prox_aula;?>&idc=<?php echo $id_curso;?>">AVANÇAR <i class="fas fa-arrow-right"></i></a>
					</div>
				<?php
					}
				?>
				
<?php
		}
	}else if($type == "2"){
		foreach ($labaula->buscarConteudoAula($id_aula, $id_curso, $type) as $key => $value) {
			$prox_aula_ordem = $labaula->getOrdem($id_aula)+1;
			$prox_aula = $labaula->getIdByOrdem($prox_aula_ordem, $id_curso);
?>
				<div class="dialog-cont">
				<div class="dialog-teach-cont">
					<img class="img-teacher animate2 fadeIn" src="../img/defaultprofile/monster_teacher.png"/>
				</div>
				<div class="dialog-message-cont">
					<div class="dialog-box animate fadeInUp">
						<h4><?php echo $value->dialog1;?></h4>
					</div>
				</div>
				</div>
				<div class="cont-aula">
					<div class="dialog-teach-cont">
				</div>
				<div class="dialog-message-cont">
					<div class="second-dialog-box animate-delay fadeInUp2">
						<h4><?php echo $value->dialog2;?></h4>
					</div>
				</div>
				</div>
				<?php
					if($prox_aula == '0'){
				?>
					<div class="bottom-bar">
						<a class="next-btn" href="aula.php?final=1">AVANÇAR <i class="fas fa-arrow-right"></i></a>
					</div>
				<?php		
					}else{
				?>
					<div class="bottom-bar">
						<a class="next-btn" href="aula.php?id=<?php echo $prox_aula;?>&idc=<?php echo $id_curso;?>">AVANÇAR <i class="fas fa-arrow-right"></i></a>
					</div>
				<?php
					}
				?>
<?php
		}
	}
}

?>
		

</div>


</body>
</html>

<?php
}else{
	header("Location: ../login.php");
}

?>
