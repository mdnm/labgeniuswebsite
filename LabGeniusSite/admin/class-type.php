<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 3){

	$admin = new Admin();
	$id_curso = $_GET['id'];

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

<div class="screens" >
	<!--inclui o menu lateral-->
	<?php 		
	include "../include/admin-side-nav.php";
	?>
	<div class="content-wrapper" style="background-color:#f6f6f6">
	<h1 style="padding-top:80px;" class="page-title2">Escolha o tipo da Aula</h1>
        <div class="contains">
			<div class="left">
				<a href="addclass.php?type=1&id=<?php echo $id_curso;?>" id="option1">
					<div class="block">
						<img style="margin-top:10px;width:80%;position:relative;left:50%;transform:translateX(-50%);" src="../img/icons/dialog-icon.png">
						<img style="width:40%;opacity:0.2;position:relative;left:50%;transform:translateX(-50%);" src="../img/icons/image-icon.png">
						<h4 style="text-align:center;color:black;font-size:20px; font-weight:800;opacity:0.7;margin-top:15px">DIÁLOGO E FOTO</h4>
					</div>
				</a>
			</div>
			
			
			<div class="right">
				<a href="addclass.php?type=2&id=<?php echo $id_curso;?>" id="option2">
					<div class="block">
						<img style="width:80%;position:relative;left:50%;transform:translateX(-50%);" src="../img/icons/dialog-icon.png">
						<img style="width:80%;position:relative;left:50%;transform:translateX(-50%);" src="../img/icons/dialog2-icon.png">
						<h4 style="text-align:center;color:black;font-size:20px; font-weight:800;opacity:0.7;margin-top:15px">DIÁLOGO E TÓPICO</h4>
					</div>
				</a>
			</div>
						
        </div>
	</div>
</body>
</html>

<?php

}else{
	header("Location: ../index.php");
}

?>
