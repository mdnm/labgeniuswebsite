<?php
session_start();


include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){

    $aluno = new Aluno();
    $curso = new Curso();
	$modulo = new Modulo();
	$instrutor = new Instrutor();
	$aula = new Aula();
	$id_aluno = $aluno->getId($_SESSION['user_session']);	
    $id_aula = $_GET['id'];
	$id_curso = $_GET['idc'];
	
	$aula->verAula($aluno->getId($_SESSION['user_session']), $id_aula, $id_curso);
	
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
	<?php
		 if($id_aula == $aula->getUltimaAula($id_curso)){
			 if($curso->verificaRating($id_aluno, $id_curso) == 0){
				 
	?>
		<div class="popup-screen" id="pop1">
			<div class="popup">
				<i id="close" class="fas fa-times"></i>
				<p>Que tal classificar o curso?</p>
				<div class="position-center" style="margin-top:10px;width:120px; height:30px;">
					<div class="stars" data-stars="1">
						<svg height="25" width="23" class="star rating" data-rating="1">
							<polygon points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;"/>
						</svg>
						<svg height="25" width="23" class="star rating" data-rating="2">
							<polygon points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;"/>
						</svg>
						<svg height="25" width="23" class="star rating" data-rating="3">
							<polygon points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;"/>
						</svg>
						<svg height="25" width="23" class="star rating" data-rating="4">
							<polygon points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;"/>
						</svg>
						<svg height="25" width="23" class="star rating" data-rating="5">
							<polygon points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;"/>
						</svg>
					</div>
				</div>
				
				<div class="pop-buttons">
					<a id="negative" class="cancel">Cancelar</a>
				</div>
			</div>
		</div>
	<?php
			}
		 }
	?>

	<!--inclui o menu lateral-->
	<nav class="nav-bar" id="classnav">
		<div class="left-nav-content">
			<a href="course.php?id=<?php echo $id_curso;?>" id="back">
				<img src="../img/icons/back.png" class="back-nav-btn">
			</a>
		</div>
		<div class="middle-nav-content">
			<h4 class="class-title"><img src="../img/icons/logo.png"></h4>
		</div>
		<div class="right-nav-content">
		</div>
	</nav>

	

	<div class="screens" id="nav-screen">
		<?php include "../include/classes-list.php";?>

		<div class="content-wrapper">
			
			
			<div class="video-class-cont"></div>
			<h2 class="video-title"><?php echo $aula->getTitulo($id_aula, $id_curso);?></h2>
			<p class="video-date">Publicado em <?php echo $aula->getDate($id_aula, $id_curso);?></p>
			<p class="video-description"><?php echo $aula->getDescricao($id_aula, $id_curso);?></p>
			<div class="perfil-informations">
				<div class="left">
					<div class="rounded-image-moldure" style="">
						<img src="../img/profile/<?php echo $instrutor->getPictureById($curso->getIdOwner($id_curso));?>">
					</div>
				</div>
				<div class="right">
					<h4><?php echo $instrutor->getFullNameById($curso->getIdOwner($id_curso));?></h4>
					<p>Instrutor</p>
				</div>
				
				<div class="recebe"></div>
				
			</div>
			</br>
			</br>
			</br>
		</div>
	</div>
	  
	<script>
		$(document).ready(function(){
			
			var iframe = '<iframe width="560" height="280" src="<?php echo $aula->getVideo($id_aula);?>?rel=0&modestbranding=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
			$('.video-class-cont').html(iframe);

			$(".order-table #info").click(function(){
				var id = $(this).parent().attr("headers");
				window.location = "class.php?id="+id+"&idc="+<?php echo $id_curso;?>;
			});
			
			$("#pop1").css("display", "block");

			$('#close').click(function(){
				$('.popup-screen').css("display", "none");
			});
			
			$('#negative').click(function(){
        		$('.popup-screen').css("display", "none");
			});

			$('.star.rating').click(function(){
				console.log( $(this).parent().data('stars') + ", " + $(this).data('rating'));
				$(this).parent().attr('data-stars', $(this).data('rating'));

				id_curso = <?php echo $_GET['idc'];?>;
				id_aluno = <?php echo $id_aluno;?>;
				nota = $(this).data('rating');

				$.ajax({
					url: '../php/ajax/insert_rating.php',
					type: 'POST',
					data: {id_aluno:id_aluno, id_curso:id_curso, nota: nota},
				}).done(function(data){
					location.reload();				
				});
				
				

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
