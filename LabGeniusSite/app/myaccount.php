<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){

	$aluno = new Aluno();
	$username = $_SESSION['user_session'];	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Minha Conta - LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
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
		<h3 class="settings-title">MINHA CONTA</h3>
		
		<div class="info-block animate fadeIn" id="normal" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
			<div class="profile-img-cont">
				<form method="POST" class="profile-img" enctype="multipart/form-data" action="">
					<input type="file" name="fileUpload" id="file-upload">
				</form>
				<a href="">
					<label for="file-upload" class="profile-img-holder" style="background-image:url(../img/profile/<?php echo $aluno->getPicture($_SESSION['user_session']);?>)">
						<p>Mudar Foto</p>
						<div class="color-overlay">
						</div>
					</label>
				</a>
				
			</div>
			<div class="profile-info-cont">
				<a class="simple-button" id="editar">EDITAR</a>
				<div class="profile-info">
					<h4>NOME DE USUÁRIO</h4>
					<p><?php echo $_SESSION['user_session']?></p>
				</div>
				<div class="profile-info">
					<h4 id="label">NOME</h4>
					<p><?php echo $aluno->getNome($username).' '.$aluno->getSobrenome($username);?></p>
				</div>
				<div class="profile-info">
					<h4 id="label">E-MAIL</h4>
					<p><?php echo $aluno->getEmail($username);?></p>
				</div>
				<?php
					if(isset($_SESSION['error'])){
						echo $_SESSION['error'];
						unset($_SESSION['error']);
					}

					if(isset($_POST)){
						if(empty($_POST['username'])){
							//$_SESSION['error2'] = '<div class="error-msg"><p>Não deixe em branco!</p></div>';
						}else if(empty($_POST['nome'])){
							//$_SESSION['error2'] = '<div class="error-msg"><p>Não deixe em branco!</p></div>';
						}else if(empty($_POST['sobrenome'])){
							//$_SESSION['error2'] = '<div class="error-msg"><p>Não deixe em branco!</p></div>';
						}else if(empty($_POST['email'])){
							//$_SESSION['error2'] = '<div class="error-msg"><p>Não deixe em branco!</p></div>';
						}else{
							$aluno->mudarUsername($_POST['username'], $_SESSION['user_session']);
							$aluno->mudarNome($_POST['nome'], $_SESSION['user_session']);
							$aluno->mudarSobrenome($_POST['sobrenome'], $_SESSION['user_session']);
							$aluno->mudarEmail($_POST['email'], $_SESSION['user_session']);
							header("Location: myaccount.php");
						}
					}else{
					}

				?>
			</div>
		</div>
		

		<div class="info-block" id="edit">
			<div class="profile-img-cont">
				<img src="../img/profile/<?php echo $aluno->getPicture($_SESSION['user_session']);?>">
			</div>
			<div class="profile-info-cont">
				<form class="edit-profile-info" method="post" action="myaccount.php">
					<div class="profile-info">
						<h4>NOME DE USUÁRIO</h4>
						<input type="text" name="username" class="flat-form-input-fullsize" value="<?php echo $_SESSION['user_session']?>"/>
					</div>
					<div class="profile-info">
						<h4 id="label">NOME</h4>
						<input type="text" name="nome" class="flat-form-input-fullsize" value="<?php echo $aluno->getNome($username);?>"/>
					</div>
					<div class="profile-info">
						<h4 id="label">SOBRENOME</h4>
						<input type="text" name="sobrenome" class="flat-form-input-fullsize" value="<?php echo $aluno->getSobrenome($username);?>"/>
					</div>
					<div class="profile-info">
						<h4 id="label">E-MAIL</h4>
						<input type="text" name="email" class="flat-form-input-fullsize" value="<?php echo $aluno->getEmail($username);?>"/>
					</div>
					<div class="action-btns">
						<a class="simple-button-nodecoration" id="cancel">CANCELAR</a>
						<input type="submit" name="edit-info" class="simple-button" value="SALVAR"/>
					</div>
				</form>
			</div>
		</div>
		<p class="recebe"></p>

	</div>


</body>
<script>
	$(document).ready(function(){
		$("#editar").click(function(){
			$("#normal").css("display", "none");
			$("#edit").css("display", "inline-block");
		});

		$("#cancel").click(function(){
			$("#edit").css("display", "none");
			$("#normal").css("display", "inline-block");
		});

		$(".profile-img-holder").hover(function(){
			$(".color-overlay").css("display", "block");
			$(".profile-img-holder p").css("display", "block");
		}, function(){
			$(".color-overlay").css("display", "none");
			$(".profile-img-holder p").css("display", "none");
		});

		$('#file-upload').change(function() {
			var filepath = this.value;
			var m = filepath.match(/([^\/\\]+)$/);
			var filename = m[1];
			//$('#filename').html(filename);
			
			var form = $('.profile-img')[0];
			var formdata = new FormData(form);

			$.ajax({
				url: '../php/ajax/change_photo.php?user=<?php echo $username;?>',
				type: 'POST',
				data: formdata,
				contentType: false,
        		processData: false,
			}).done(function(data){
				$('.recebe').html(data);
				location.reload();				
			});

		});

		
	});
</script>
</html>

<?php

}else{
	header("Location: ../index.php");
}

?>
