<?php
session_start();


include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){

    $aluno = new Aluno();
    $curso = new Curso();
    $modulo = new Modulo();
	$aula = new Aula();	
	$id_curso = $_GET['id'];

	if(isset($_GET['go'])&& isset($_GET['ida']) && isset($_GET['id'])){
		if($_GET['go'] == 'join'){
			//echo "<script>alert('Ingressado em curso');</script>";
			 $curso->ingressarCurso($aluno->getID($_SESSION['user_session']), $id_curso);
			// Limpa a url para que não exclua de novo
			echo "<script>window.location = 'course.php?id=".$id_curso."';</script>";
		}
	}
	
	if(isset($_GET['go'])){
		if($_GET['go'] == 'leave'){
			 $curso->sairCurso($aluno->getID($_SESSION['user_session']), $id_curso);
			// Limpa a url para que não exclua de novo
			echo "<script>window.location = 'course.php?id=".$id_curso."';</script>";
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
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
	<link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>


<div class="popup-screen" id="pop1">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja mesmo sair do curso?</p>
		<div class="pop-buttons">
			<a id="negative" class="option1">Não</a>
			<a id="afirmative" href="?go=leave&id=<?php echo $id_curso;?>" class="option2">Sim</a>
		</div>
	</div>
</div>

<div class="popup-screen" id="pop2">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja ingressar neste curso?</p>
		<div class="pop-buttons">
			<a id="negative" class="option1">Não</a>
			<a id="afirmative" href="?go=join&ida=<?php echo $aluno->getId($_SESSION['user_session']);?>&id=<?php echo $id_curso;?>" class="option2">Sim</a>
		</div>
	</div>
</div>


<div class="screens">
	<!--inclui o menu lateral-->
	<?php include "../include/app-side-nav.php";?>
	<div class="content-wrapper">

		
				
		<h1 class="page-title2"><?php echo $curso->getTitulo($id_curso);?></h1>

		<?php
			// verifica se aluno esta ingressado
			if($curso->verificarEntrada($aluno->getID($_SESSION['user_session']), $id_curso) > 0){
		?>
				<div class="blocks-wrapper animate fadeIn">
				<div class="blocks-container" style="width:65%;box-sizing:border-box; padding:0px 20px 0px 50px;height:173px;">
					<div class="block-cont" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1); height:100%; padding:0px 20px 0px 20px;">
						<div class="table-nav-btns ">
							<h3 class="table-nav-title">Sobre este Curso</h3>
							<div class="right-element"><div class="star-ratings-sprite"><span style="width:<?php echo $curso->getRating($id_curso);?>%" class="star-ratings-sprite-rating"></span></div></div>
						</div>
						<p class="page-text align-left" style="padding:20px 0px 0px 0px"><?php echo $curso->getDescricao($id_curso);?></p>
						<div class="block-container" style="margin-top:10px;max-height:50px; overflow:hidden;">
							<?php
								foreach ($curso->getTags($id_curso) as $key => $value) {
							?>
									<div class="tag" style="">
										<i class="fas fa-tag"></i>&nbsp;&nbsp;<?php echo $value->tag_word;?>
									</div>
									<div style="display:inline;">&nbsp;&nbsp;</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
				<div class="blocks-container" style="width:35%;box-sizing:border-box; padding:0px 50px 0px 0px;">
					<div class="block-cont" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
					<table class="order-table">						
						<tbody>
							<tr>
								<td><i class="fas fa-graduation-cap"></i>&emsp;Aulas</td>
								<td style="color:gray;"><?php echo $curso->getTotalAulas($id_curso);?> Aulas</td>
							</tr>
							<tr>
								<td><i class="fas fa-user-tie"></i>&emsp;Criador</td>
								<td style="color:gray;"><?php echo $curso->getInstructorName($id_curso);?></td>
							</tr>
							<tr>
								<td><i class="fas fa-tag"></i>&emsp;Preço</td>
								<td style="color:gray;">Grátis</td>
							</tr>
						</tbody>		  
					</table>	
					</div>
				</div>
			</div>
				</br>
				<div class="table-nav-btns position-center width90 animate-delay2 fadeIn">
					<h3 class="table-nav-title">Aulas</h3>
					<a class="disabled-btn" href="#0">Ingressado&ensp;<i class="fas fa-calendar-check"></i></a>
					<a id="btn" class="negative-button">Sair</i></a>
				</div>

		<div class="tables-container">
		
			<?php
				foreach ($modulo->getModulos($id_curso) as $key => $modulo_value) { ?>

					<div class="block-cont position-center width90 animate-delay2 fadeIn" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);" id="<?php echo $modulo_value->id;?>">

						<table class="order-table">

							<thead>
								<tr class="indice">
									<th><?php echo $modulo_value->name;?></th>
								</tr>
							</thead>
							<tbody>
								<?php //verifica se existem aulas
								$aulas = count($aula->buscarAula($id_curso, $modulo_value->id));
								if($aulas > 0){
									foreach ($aula->buscarAula($id_curso, $modulo_value->id) as $key => $aula_value) {
										if($aula_value->type == 1){
                                            // 1 é video
											echo '<tr headers="'.$aula_value->id_aula.'"><td id="info"><i class="fab fa-youtube fa-lg"></i>&emsp;'.$aula_value->titulo.'</td></tr>';
                                        }else{
											// 2 é outros
											echo '<tr headers="'.$aula_value->id_aula.'"><td id="info"><i class="fas fa-clipboard-list fa-lg"></i>&emsp;'.$aula_value->titulo.'</td></tr>';
										}
										
									}
								}else{
								}
								
								?>
								
							</tbody>		  
						</table>
					</div>
				<?php } ?>
		</div>
				
		<?php
			}else{
		?>
			<div class="blocks-wrapper animate fadeIn">
				<div class="blocks-container" style="width:65%;box-sizing:border-box; padding:0px 20px 0px 50px;height:173px;">
					<div class="block-cont" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1); height:100%; padding:0px 20px 0px 20px;">
						<div class="table-nav-btns">
							<h3 class="table-nav-title">Sobre este Curso</h3>
							<div class="right-element"><div class="star-ratings-sprite"><span style="width:<?php echo $curso->getRating($id_curso);?>%" class="star-ratings-sprite-rating"></span></div></div>
						</div>
						<p class="page-text align-left" style="padding:20px 0px 0px 0px"><?php echo $curso->getDescricao($id_curso);?></p>
						<div class="block-container" style="margin-top:10px;max-height:50px; overflow:hidden;">
							<?php
								foreach ($curso->getTags($id_curso) as $key => $value) {
							?>
									<div class="tag" style="">
										<i class="fas fa-tag"></i>&nbsp;&nbsp;<?php echo $value->tag_word;?>
									</div>
									<div style="display:inline;">&nbsp;&nbsp;</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
				<div class="blocks-container" style="width:35%;box-sizing:border-box; padding:0px 50px 0px 0px;">
					<div class="block-cont" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
					<table class="order-table">						
						<tbody>
							<tr>
								<td><i class="fas fa-graduation-cap"></i>&emsp;Aulas</td>
								<td style="color:gray;"><?php echo $curso->getTotalAulas($id_curso);?> Aulas</td>
							</tr>
							<tr>
								<td><i class="fas fa-user-tie"></i>&emsp;Criador</td>
								<td style="color:gray;"><?php echo $curso->getInstructorName($id_curso);?></td>
							</tr>
							<tr>
								<td><i class="fas fa-tag"></i>&emsp;Preço</td>
								<td style="color:gray;">Grátis</td>
							</tr>
						</tbody>		  
					</table>	
					</div>
				</div>
			</div>

				
				
				
				<div class="table-nav-btns position-center width90 animate-delay2 fadeIn" style="margin-top:30px;">
					<h3 class="table-nav-title">Aulas</h3>
					<a id="join" class="simple-button">Ingressar em Curso</a>
				</div>
				

			<div class="tables-container position-center width90 animate-delay2 fadeIn">
				<?php
					foreach ($modulo->getModulos($id_curso) as $key => $modulo_value) { 
				?>
					<div class="block-cont" id="<?php echo $modulo_value->id;?>" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);">
						<table class="order-table">
							<thead>
								<tr class="indice">
									<th><?php echo $modulo_value->name;?></th>
								</tr>
							</thead>
							<tbody>
								<?php //verifica se existem aulas
								$aulas = count($aula->buscarAula($id_curso, $modulo_value->id));
								if($aulas > 0){
									foreach ($aula->buscarAula($id_curso, $modulo_value->id) as $key => $aula_value) {
										if($aula_value->type == 1){
											// 1 é video
											echo '<tr headers=""><td><i class="fab fa-youtube fa-lg"></i>&emsp;'.$aula_value->titulo.'</td></tr>';
										}else{
											// 2 é outros
											echo '<tr headers=""><td><i class="fas fa-clipboard-list fa-lg"></i>&emsp;'.$aula_value->titulo.'</td></tr>';
										}
									}
								}else{
								}
								?>
							</tbody>		  
						</table>
					</div>
				<?php 
					} 
				?>
			</div>

		<?php
			}
		?>
					
		<br></br>
		<br></br>
		
	</div>



<script>
    $(document).ready(function(){
        $(".order-table #info").click(function(){
            var id = $(this).parent().attr("headers");
            window.location = "class.php?id="+id+"&idc="+<?php echo $id_curso;?>;
        });


		//popup
        $('.close').click(function(){
        	$('.popup-screen').css("display", "none");
        });

        $('#btn').click(function(){
        	$('#pop1').css("display", "block");
        });

		$('#join').click(function(){
        	$('#pop2').css("display", "block");
        });
        $('.option1').click(function(){
        	$('.popup-screen').css("display", "none");
		});
		///////
    });
</script>




</body>
</html>

<?php

}else{	
	header("Location: index.php");
}

?>
