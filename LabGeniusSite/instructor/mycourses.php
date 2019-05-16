<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$curso = new Curso();
	$instrutor = new Instrutor();
	$id = $instrutor->getId($_SESSION['user_session']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Meus Cursos - LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>

<div class="popup-screen" id="pop1">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja mesmo excluir esse curso?</p>
		<div class="pop-buttons">
			<a id="negative" class="option1">Não</a>
			<a id="afirmative" href="" class="option2">Sim</a>
		</div>
	</div>
</div>

<div class="screens">
	<!--inclui o menu lateral-->
	<?php include "../include/instructor-side-nav.php";?>
	<div class="content-wrapper">
	
	<h1 class="page-title2">Meus Cursos</h1>

		
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Cursos</h3>
			<a href="addcourse.php" class="simple-button">+ Criar Curso</a>
		</div>
		<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
			<table class="order-table">
				<thead>
					<tr class="indice">
						<th>#</th>
						<th>Título</th>
						<th>Descrição</th> 
						<th>Visibilidade</th>
						<th>#</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					foreach ($curso->buscarCursos($id) as $key => $value) {
				?>
						<tr headers="<?php echo $value->id;?>">
							<td id="info" class="thumbnail"><div class="thumb-frame-rounded"><img class="thumbnail-image" src="../img/courses/thumb/<?php echo $value->thumbnail;?>"/></div></td>
							<td id="info" class="bold-text"><?php echo $value->titulo;?></td>
							<td id="info" class="regular-text"><?php echo $value->descricao;?></td>
							<?php
								if($value->visibilidade == 1){
									echo '<td id="info" class="privacy-status"><span class="status positive">Público</span></td>';
								}else{
									echo '<td id="info" class="privacy-status"><span class="status negative">Privado</span></td>';
								}
							?>
							<td headers="<?php echo $value->id;?>"><a class="excluircurso"><i class="fa fa-times"></i>

				</a></td>
						</tr>
				<?php
					}

					if(isset($_GET['go'])&& isset($_GET['id'])){
						if($_GET['go'] == 'excluir'){
							echo $curso->excluirCurso($id, $_GET['id']);
							// Limpa a url para que não exclua de novo
							echo "<script>window.location = 'mycourses.php';</script>";
						}
					}
				?>
				</tbody>		  
			</table>
		</div>
	</div>
<script>

function myFunction(x) { document.getElementById("mySidenav").classList.toggle("open");
    x.classList.toggle("change");
}

</script>


<script src="owlcarousel/owl.carousel.min.js"></script>


<script>
	$(document).ready(function(){
	
		$(".order-table #info").click(function(){
			var id = $(this).parent().attr("headers");
			window.location = "course.php?id="+id;
		});

	//popup
		$('.close').click(function(){
			$('.popup-screen').css("display", "none");
		});
		$('.option1').click(function(){
			$('.popup-screen').css("display", "none");
		});

		$('.excluircurso').click(function(){
			var id = $(this).parent().attr("headers");
			$('#pop1').css("display", "block");
			$('#pop1 #afirmative').attr("href","?go=excluir&id="+ id +"")
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
