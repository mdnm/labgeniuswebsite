<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 3){

	$admin = new Admin();
	$class_type = $_GET['type'];
	$id_curso = $_GET['id'];

	if(isset($_POST['']))

?>
<!DOCTYPE html>
<html>
<head>
	<title>Criar Aula</title>
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
		<h1 class="page-title2">Criar Aula</h1>
		<?php
			if($class_type == '1'){
		?>
				<div class="card-none">
					<form method="post" class="cardform2" id="type1" enctype="multipart/form-data">
						<input class="flat-form-input-fullsize" type="text" placeholder="Título da Aula" id="titulo" name="titulo">
						<textarea class="flat-form-textarea" name="fala1" id="fala1" placeholder="Primeira Fala"></textarea>
						
						<div id="file-upload-form" class="uploader">
							<input id="file-upload" type="file" name="fileUpload" accept="image/*" />
							<label for="file-upload" id="file-drag">
								<img id="file-image" src="#" alt="Preview" class="hidden">
								<div id="start">
									<i class="fa fa-file-upload" aria-hidden="true"></i>
									<div>Selecione uma imagem ou arraste aqui.</div>
									<div id="notimage" class="hidden">Please select an image</div>
									<span id="file-upload-btn" class="btn btn-primary">Select a file</span>
								</div>
								<div id="response" class="hidden">
									<div id="messages"></div>
									<progress class="progress" id="file-progress" value="0">
									<span>0</span>%
									</progress>
								</div>
							</label>
						</div>
						<div class="recebe"></div>
						<input class="flat-form-button" name="criarcurso" type="submit" value="Criar Aula">
					</form>
				</div>
		<?php
			}else{
		?>
				<div class="card-none">
					<form method="post" class="cardform2" id="type2" enctype="multipart/form-data">
						<input class="flat-form-input-fullsize" type="text" placeholder="Título da Aula" id="titulo" name="titulo">
						<textarea class="flat-form-textarea" name="fala1" id="fala1" placeholder="Primeira Fala"></textarea>
						<textarea class="flat-form-textarea" name="fala2" id="fala2" placeholder="Segunda Fala"></textarea>			
						<div class="recebe"></div>
						<input class="flat-form-button" name="criarcurso" type="submit" value="Criar Aula">
					</form>
				</div>
		<?php
			}
		?>
        
	</div>
	<script src="../js/file-upload.js"></script>
	<script>
		$('#type2').submit(function(){
			var form = $('#type2')[0];
			var formdata = new FormData(form);
			var error_msg = '<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>';

			titulo = $('#titulo').val();
			fala1 = $('#fala1').val();
			fala2 = $('#fala2').val();

			if(titulo == ""){
				$('.recebe').html(error_msg);
			}else if(fala1 == ""){
				$('.recebe').html(error_msg);
			}else if(fala2 == ""){
				$('.recebe').html(error_msg);
			}else{
				$.ajax({
					url: '../php/ajax/insert_labclass2.php?id=<?php echo $id_curso;?>',
					type: 'POST',
					data: formdata,
					contentType: false,
					processData: false,	
				}).done(function(data){
					$('.recebe').html(data);
					$('.cardform2').trigger("reset");
				});
			}
			return false;
		});

		$('#type1').submit(function(){
			var form = $('#type1')[0];
			var formdata = new FormData(form);
			var error_msg = '<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>';

			titulo = $('#titulo').val();
			fala1 = $('#fala1').val();
			if(titulo == ""){
				$('.recebe').html(error_msg);
			}else if(fala1 == ""){
				$('.recebe').html(error_msg);
			}else{
				$.ajax({
					url: '../php/ajax/insert_labclass.php?id=<?php echo $id_curso;?>',
					type: 'POST',
					data: formdata,
					contentType: false,
					processData: false,	
				}).done(function(data){
					$('.recebe').html(data);
					$('.cardform2').trigger("reset");
					// reseta o file input estilizado
					$('#start').removeClass('hidden');
					$('#response').addClass('hidden');
					$('#file-image').attr("src", "#");
					$('#file-image').addClass('hidden');
					$('#response #messages strong').remove();
					$('#response progreess').attr("value", "0");
					$('#response progreess').removeAttr("style");
					});
			}
			return false;
		});
	</script>
</body>
</html>

<?php

}else{
	header("Location: ../index.php");
}

?>
