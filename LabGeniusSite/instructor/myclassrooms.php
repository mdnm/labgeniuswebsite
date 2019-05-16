 <?php
session_start();

include '../php/autoload.php';
if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$instrutor = new Instrutor();
	$id = $instrutor->getId($_SESSION['user_session']);
			
?>
<!DOCTYPE html>
<html>
<head>
	<title>Minhas Salas - LabGenius</title>
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
		<p>Deseja mesmo excluir essa sala?</p>
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
	
	<h1 class="page-title2">Minhas Salas</h1>

		
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Salas</h3>
			<a href="addclassroom.php" class="simple-button">Criar Sala de Aula</a>
		</div>
		<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
			<table class="order-table">
			<thead>
				<tr class="indice">
					<th>ID</th>
					<th>Sala</th>
					<th>Status</th>  
					<th>#</th>
				</tr>
			</thead>
				
			<tbody>
				<?php
					$sala = new Sala();
					foreach ($sala->buscaSalas($id) as $key => $value) {
				?>
						<tr headers="<?php echo $value->id_sala;?>">
							<td id="info"><?php echo $value->id_sala;?></td>
							<?php
							if($value->senha == ""){
								echo '<td id="info"><span class="status positive">Aberta</span></td>';
							}else{
								echo '<td id="info"><span class="status negative">Fechada</span></td>';
							}


							?>
							<td id="info"><?php echo $value->nome;?></td>
							
								<td headers="<?php echo $value->id_sala;?>"><a class="excluirsala"><i class="fa fa-times"></a></td>
						</tr>
				<?php
					}

					if(isset($_GET['go'])&& isset($_GET['id'])){
						if($_GET['go'] == 'excluir'){
							$sala->excluirSala($_GET['id'],$id);
							echo "<script>window.location = 'myclassrooms.php';</script>";
						}
					}
					
				?>
			</tbody>		  
		</table>
		</div>


	</div>


<script>
	$(document).ready(function(){
	
		$(".order-table #info").click(function(){
			var id = $(this).parent().attr("headers");
			window.location = "classroom-detail.php?id="+id;
		});

		//popup
		$('.close').click(function(){
			$('.popup-screen').css("display", "none");
		});
		$('.option1').click(function(){
			$('.popup-screen').css("display", "none");
		});

		$('.excluirsala').click(function(){
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
