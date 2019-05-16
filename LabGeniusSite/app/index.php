<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){
	$aluno = new Aluno();
	$curso = new Curso();
	$lgcurso = new LabgeniusCurso();

?>
<!DOCTYPE html>
<html>
<head>
	<title>LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.theme.default.min.css">
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
		<div class="owl-faixa">
			<h3 class="page-title2 animate fadeIn">Oficiais do LabGenius</h3>
			<div class="owl-wrapper">
				<div class="owl-carousel animate fadeIn">
				
					<a href="games.php">
						<div class="cat-block" id="software" style="background-color:rgb(245, 210, 10);box-shadow: 0px 9px 0px 0px rgba(0,0,0,0.10), 0px 9px 0px 0px rgb(245, 210, 10)">
							<div class="cat-img-cont">
								<img src="../img/labcourses/icons/ce46d4d43a9acb6301ba02205b60106b.png">
							</div>
							<div class="cat-title-cont">
								<p>Jogos</p>
							</div>
						</div>
					</a>
					<?php
						foreach ($lgcurso->buscarCursos() as $key => $value) {
					?>
							<a href="level-page.php?id=<?php echo $value->id;?>">
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
		</div>
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Cursos mais pesquisados</h3>
			<form class="inactive-form" action="" method="">
				<div class="flat-form-search-cont">
					<input type="text" class="flat-form-search" name="search" placeholder="Procure cursos...">
					<button class="search-btn"><i class="fas fa-search"></i></button>
				</div>
			</form>
		</div>
		<!-- <nav class="rounded-menu">
			<ul>
				<a href=""><li>TODOS</li></a>
				<a href=""><li>PYTHON</li></a>
				<a href=""><li>LÓGICA</li></a>
				<a href=""><li>PROGRAMAÇÃO</li></a>
				<a href=""><li>JAVASCRIPT</li></a>
				<a href=""><li>HTML</li></a>
			</ul>
		</nav> -->
		
		<div class="containers ">
			<?php 
				if(isset($_GET['search'])){
					foreach ($curso->searchCurso($_GET['search']) as $key => $curso_value) {
			?>
						<a title="<?php echo $curso_value->titulo;?>" href="course.php?id=<?php echo $curso_value->id;?>">
							<div class="item">
								<div class="course-box">
									<div class="img-cont" style="background-image:url(../img/courses/thumb/<?php echo $curso_value->thumbnail;?>)">
									</div>
									<div class="info-cont">
										<h4><?php echo $curso_value->titulo?></h4>
										<p><?php echo $curso->getInstructorName($curso_value->id);?></p>
										<div class="star-ratings-sprite"><span style="width:<?php echo $curso->getRating($curso_value->id);?>%" class="star-ratings-sprite-rating"></span></div>
									</div>
								</div>
							</div>
						</a>
			<?php
					}
				}else{
					foreach ($curso->buscarCursosAleatorio() as $key => $curso_value) {
			?>
						<a title="<?php echo $curso_value->titulo;?>" href="course.php?id=<?php echo $curso_value->id;?>">
							<div class="item animate-delay2 fadeIn">
								<div class="course-box">
									<div class="img-cont" style="background-image:url(../img/courses/thumb/<?php echo $curso_value->thumbnail;?>)">
									</div>
									<div class="info-cont">
										<h4><?php echo $curso_value->titulo?></h4>
										<p><?php echo $curso->getInstructorName($curso_value->id);?></p>
										<div class="star-ratings-sprite"><span style="width:<?php echo $curso->getRating($curso_value->id);?>%" class="star-ratings-sprite-rating"></span></div>
									</div>
								</div>
							</div>
						</a>
			<?php 
						
					}
				}
			?>
			<div class="gap"></div>
			<div class="gap"></div>
		</div>

	</div>
<script>

function myFunction(x) { document.getElementById("mySidenav").classList.toggle("open");
    x.classList.toggle("change");
}

</script>


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


	  $(".flat-form-search").focus(function(){
		  $(".flat-form-search-cont").css({"border": "2px solid rgb(65, 124, 219)", "box-shadow": "0px 0px 10px 0px rgba(65, 124, 219, 0.842)"});
	  });

	  $(".flat-form-search").focusout(function(){
		  $(".flat-form-search-cont").css({"border": "2px solid rgb(223, 223, 223)", "box-shadow": "none"});
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
