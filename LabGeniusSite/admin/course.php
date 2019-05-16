<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 3){

	$admin = new Admin();
	$curso = new LabgeniusCurso();
	$labaulas = new LabgeniusAula();

	$id_curso = $_GET['id'];

	if(isset($_GET['go'])&& isset($_GET['id'])){
		if($_GET['go'] == 'excluir'){
			echo $curso->excluirCurso($id_curso);
			echo "<script>window.location = 'courses.php';</script>";
		}
	}

	if(isset($_GET['go'])&& isset($_GET['type'])){
		if($_GET['go'] == 'delete'){
			echo $labaulas->excluirAula($_GET['id'], $_GET['ida'], $_GET['type']);
			echo "<script>window.history.back();</script>";
		}
	}

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

<div class="popup-screen" id="pop1">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja mesmo excluir essa aula?</p>
		<div class="pop-buttons">
			<a id="negative" class="option1">Não</a>
			<a id="afirmative" href="" class="option2">Sim</a>
		</div>
	</div>
</div>

<div class="popup-screen" id="pop2">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja mesmo excluir este curso?</p>
		<div class="pop-buttons">
			<a id="negative" class="option1">Não</a>
			<a id="afirmative" href="?go=excluir&id=<?php echo $id_curso;?>" class="option2">Sim</a>
		</div>
	</div>
</div>

<div class="screens">
	<!--inclui o menu lateral-->
	<?php 		
	include "../include/admin-side-nav.php";
	?>
	<div class="content-wrapper">
		<h1 class="page-title2"><?php echo $curso->getTitulo($id_curso)?></h1>
		<br></br>
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Aulas</h3>
			<a href="class-type.php?id=<?php echo $id_curso;?>" class="simple-button">+ Criar Aula</a>
			<a id="excluircurso" class="negative-button">Excluir Curso</a>
		</div>
		<br></br>
	
			<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);" id="">
				<table class="order-table">
					<thead>
						<tr class="indice">
							<th>ID</th>
							<th>Título</th>
						 	<th>Tipo</th>
						 	<th>#</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($labaulas->buscarAulas($id_curso) as $key => $value) {
					?>
							<tr>
								<td id="id" value="<?php echo $value->id?>"><?php echo $value->id?></td>
								<td><?php echo $value->titulo;?></td>
								<td id="type" value="<?php echo $value->type;?>">
								<?php
									if($value->type == "1"){
										echo "Dialogo e Foto";
									}else{
										echo "Dialogo e Tópicos";
									}
								?>
								</td>
								<td><a class="excluiraula"><i class="fa fa-times"></a></td>
							</tr>
					<?php
						}
					?>
					</tbody>		  
				</table>
			</div>	
	</div>
	<script>
		//popup
		$('.close').click(function(){
			$('.popup-screen').css("display", "none");
		});
		$('.option1').click(function(){
			$('.popup-screen').css("display", "none");
		});
		$('.excluiraula').click(function(){
			var ida = $('#id').attr("value");
			var tp = $('#type').attr("value");
			$('#pop1').css("display", "block");
			$('#pop1 #afirmative').attr("href","?go=delete&id=<?php echo $id_curso;?>&ida="+ ida +"&type="+ tp +"");
		});
		$('#excluircurso').click(function(){
			$('#pop2').css("display", "block");
		});
		///////
	</script>
</body>

</html>

<?php
}else{
	header("Location: ../index.php");
}
?>
