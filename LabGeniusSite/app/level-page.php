<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){
	
	$labaulas = new LabgeniusAula();
	$id_curso = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
	<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="../plugins/owlcarousel/assets/owl.theme.default.min.css">
    <link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body id="level-body">


	<nav class="nav-bar">
		<a href="index.php">
			<img src="../img/icons/back.png" class="back-nav-btn">
		</a>
	</nav>

	<h1 class="page-title animate fadeIn">ESCOLHA O NÍVEL</h1>
	<div class="level-content">
		<?php
			$i = 1;
			foreach ($labaulas->buscarAulas($id_curso) as $key => $value) {
		?>
				<a href="aula.php?id=<?php echo $value->id;?>&idc=<?php echo $value->id_curso;?>">
					<div class="level-box">
						<p><?php echo $i++;?></p>
					</div>
				</a>	
		<?php
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