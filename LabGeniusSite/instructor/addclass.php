<?php
session_start();


include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$instrutor = new Instrutor();
	$id = $instrutor->getId($_SESSION['user_session']);

	$id_curso = $_GET['idc'];
	$id_modulo = $_GET['idm'];

	$aula = new Aula();

	
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
	
	<h1 class="page-title2">Criar Aula</h1>

		<div class="card-none">
			<form method="post" class="cardform2" enctype="multipart/form-data">
				<input class="flat-form-input-fullsize" type="text" placeholder="Título da Aula" id="titulo" name="titulo">
				<textarea class="flat-form-textarea" name="descricao" placeholder="Descrição"></textarea>
				<input class="flat-form-input-fullsize" type="text" placeholder="Link do Video" id="video_url" name="video_url">
				<div id="player"></div>
				<div class="msg"></div>
				<input class="flat-form-button" name="criarcurso" type="submit" value="Adicionar Aula">
			</form>
			
		</div>
		
<script>
	$(document).ready(function(){
		$('#video_url').on('paste', function () {
			setTimeout(function(){ 
				var text = $('#video_url').val();	
				var words = new String(text);

				var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = words.match(regExp);
				if (match && match[2].length == 11) {
					var id_video = match[2];
				} else {
				//error
				}

				var src = 'https://www.youtube.com/embed/'+id_video;
				var iframe = '<iframe id="video" width="560" height="280" src="'+src+'?rel=0&modestbranding=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				$('#player').html(iframe);
			}, 500);
		});

		$('.cardform2').submit(function(){
			var titulo = $('#titulo').val();

			var text = $('#video_url').val();	
			var words = new String(text);
			var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
			var match = words.match(regExp);
			if (match && match[2].length == 11) {
				var id_video = match[2];
			} else {
			//error
			}
			var src = 'https://www.youtube.com/embed/'+id_video;
		
			var error_msg = '<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>';
			if(titulo == ""){
				$('.msg').html(error_msg);
			}else if(video_url == ""){
				$('.msg').html(error_msg);
			}else{
				var form = $('.cardform2')[0];
				var formdata = new FormData(form);
				formdata.append("video_url", src);
				formdata.append("id_curso", <?php echo $id_curso;?>);
				formdata.append("id_modulo", <?php echo $id_modulo;?>);

				$.ajax({
				url: '../php/ajax/addClass.php',
				type: 'POST',
				data: formdata,
				contentType: false,
				processData: false,	
				}).done(function(data){
					//$('.msg').html(data);
					history.back();
					
					
				});
			}
			return false;
		});

		
	});

</script>


	</div>
</body>
</html>

<?php
}else{
	header("Location: index.php");
}

?>
