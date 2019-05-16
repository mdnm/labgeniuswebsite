<?php
session_start();


include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){
	$aula = new Aula();
	$instrutor = new Instrutor();
	$id = $instrutor->getId($_SESSION['user_session']);

	$id_aula = $_GET['id'];
	$id_curso = $aula->getIdCurso($id_aula);
	$id_modulo = $aula->getIdModulo($id_aula);

	
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
	
	<h1 class="page-title2">Editar Aula</h1>

		<div class="card-none">
			<form method="post" class="cardform2" enctype="multipart/form-data">
				<input class="flat-form-input-fullsize" type="text" value="<?php echo $aula->getTitulo($id_aula, $id_curso);?>" id="titulo" name="titulo">
				<textarea class="flat-form-textarea" name="descricao"><?php echo $aula->getDescricao($id_aula, $id_curso);?></textarea>
				<input class="flat-form-input-fullsize" type="text" value="<?php echo $aula->getVideo($id_aula);?>" placeholder="Link do Video" id="video_url" name="video_url">
				<div id="player"></div>
				<div class="msg"></div>
				<input class="flat-form-button" name="criarcurso" type="submit" value="Editar Aula">
			</form>
			
		</div>

		<div class="recebe"></div>
		
<script>
	$(document).ready(function(){
		$('#video_url').on('paste', function () {
			setTimeout(function(){ 
				var text = $('#video_url').val();	
				var words = new String(text);
				if(words.indexOf('&') > -1){
					var id_video = words.substring(words.lastIndexOf("?v=")+3,words.lastIndexOf("&"));
				}else{
					var id_video = words.split("?v=");
					var id_video = id_video[1];
				}
				var src = 'https://www.youtube.com/embed/'+id_video;
				var iframe = '<iframe id="video" width="560" height="280" src="'+src+'?rel=0&modestbranding=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				$('#player').html(iframe);
			}, 500);
		});

		$('.cardform2').submit(function(){
			var titulo = $('#titulo').val();
			var video_url = $('#video_url').val();
			var error_msg = '<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>';
			if(titulo == ""){
				$('.msg').html(error_msg);
			}else if(video_url == ""){
				$('.msg').html(error_msg);
			}else{
				var form = $('.cardform2')[0];
				var formdata = new FormData(form);
				formdata.append("video_url", video_url);
				formdata.append("id_aula", <?php echo $id_aula;?>);
				formdata.append("id_curso", <?php echo $id_curso;?>);
				formdata.append("id_modulo", <?php echo $id_modulo;?>);

				$.ajax({
				url: '../php/ajax/editClass.php',
				type: 'POST',
				data: formdata,
				contentType: false,
				processData: false,	
				}).done(function(data){
					//$('.recebe').html(data);
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
