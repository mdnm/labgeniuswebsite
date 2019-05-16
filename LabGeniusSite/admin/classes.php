<?php
session_start();
require_once "../php/conn.php";

if ($_SESSION['user_session'] == "admin" && $_SESSION['passwd_session'] == "admin"){

$id_disciplina = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
	<link rel="stylesheet" href="../owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="../owlcarousel/assets/owl.theme.default.min.css">

</head>
<body>

<div class="screens">
	<div class="side-dash-menu">
		<div class="profile-cont">
			<img src="../img/profile/userprofile.png">
			<div class="profile-text">
				<?php
				$read_aluno = mysqli_query($conn, "SELECT * FROM alunos WHERE usuario = '".$_SESSION['user_session']."'");
				if(mysqli_num_rows($read_aluno) > 0){
					foreach ($read_aluno as $read_aluno_view) {
						echo '<p id="p1">'.$read_aluno_view['nome'].' '.$read_aluno_view['sobrenome'].'</p>';
					}
				}
				?>
				
				<p id="p2">Administrador</p>
			</div>
		</div>
		<ul class="dash-menu-list">
			<a href="index.php"><li><div class="icon-list"><img src="../img/icons/explore.png"/></div><div class="text-list">Home</div></li></a>
			<a href=""><li><div class="icon-list"><img src="../img/icons/cap.png"/></div><div class="text-list">Cursos</div></li></a>
			<a href="minhaconta.php"><li><div class="icon-list"><img src="../img/icons/user.png"/></div><div class="text-list">Minha Conta</div></li></a>
			<a href=""><li><div class="icon-list"><img src="../img/icons/gear.png"/></div><div class="text-list">Ajustes</div></li></a>

		</ul>
		<hr class="menu-separate">
		<ul class="dash-menu-list">
			<a href="php/sair.php"><li><div class="icon-list"><img src="../img/icons/sign-out.png"/></div><div id="sair" class="text-list">Sair</div></li></a>
		</ul>
	</div>
	<div class="content-wrapper">
		<h1 class="page-title2">Cursos</h1>
		<div class="block-cont">
			<table class="order-table">
			<thead>
				<tr class="indice">
					<th>ID</th>
					<th>Aula</th> 
				</tr>
			</thead>
				
			<tbody>
				<?php
					$read_aulas = mysqli_query($conn, "SELECT * FROM aulas WHERE id_disciplina = '$id_disciplina'");
					if(mysqli_num_rows($read_aulas) > 0){
						foreach ($read_aulas as $read_aulas_view) {
							echo '<tr headers="'.$read_aulas_view['id_aula'].'">
									<td id="info">'.$read_aulas_view['id_aula'].'</td>
									<td id="info">'.$read_aulas_view['nome_aula'].'</td>
								</tr>';
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


<script type="text/javascript">
	$(".order-table #info").click(function(){
		var id = $(this).parent().attr("headers");
		window.location = "info-pedido.php?id="+id;
	});
</script>




</body>
</html>

<?php
}else{
	header("Location: index.php");
}

?>
