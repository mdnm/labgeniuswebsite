<?php
session_start();


include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$instrutor = new Instrutor();
	$id = $instrutor->getId($_SESSION['user_session']);
	$curso = new Curso();	
	@$id_curso = $_GET['id'];

	$modulo = new Modulo();
	$aula = new Aula();

	if(isset($_GET['ac'])){
		if($_GET['ac'] == 'excluir'){
			$modulo->excluirModulo($_GET['idc'], $_GET['idm']);
			echo "<script>window.history.back();</script>";
		}
	}

	if(isset($_GET['go'])){
		if($_GET['go'] == 'excluir'){
			$aula->excluirAula($_GET['id'], $_GET['ida']);
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
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
	<link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>

<div class="popup-screen" id="pop1">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja mesmo excluir esse módulo?</p>
		<div class="pop-buttons">
			<a id="negative" class="option1">Não</a>
			<a id="afirmative" href="" class="option2">Sim</a>
		</div>
	</div>
</div>

<div class="popup-screen" id="pop2">
	<div class="popup">
		<a class="close"><i class="fas fa-times"></i></a>
		<p>Deseja mesmo excluir essa aula?</p>
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
		
		<h1 class="page-title2"><?php echo $curso->getTitulo($id_curso);?></h1>
					
		<br></br>
		<div class="table-nav-btns position-center width90">
			<h3 class="table-nav-title">Aulas</h3>
			<a class="simple-button" id="addmodule">+ Criar Modulo</a>
			<a href="editcourse.php?id=<?php echo $id_curso;?>" class="simple-button" style="margin-right:10px;">Editar</a>
		</div>
		<div class="tables-container">
		
			<?php
				foreach ($modulo->getModulos($id_curso) as $key => $modulo_value) { ?>

					<div class="block-cont position-center width90" style="box-shadow:0 4px 10px 0 rgba(0, 0, 0, 0.1);" id="<?php echo $modulo_value->id;?>">
					

						<table class="order-table">

							<thead>
								<tr class="indice">
									<th><?php echo $modulo_value->name;?></th>
								 	<th headers="<?php echo $modulo_value->id;?>"><a class="excluirmodulo"><i class="fa fa-times"></a></th>
								</tr>
							</thead>
							<tbody>
								<?php //verifica se existem aulas
								$aulas = count($aula->buscarAula($id_curso, $modulo_value->id));
								if($aulas > 0){
									foreach ($aula->buscarAula($id_curso, $modulo_value->id) as $key => $aula_value) {
										if($aula_value->type == 1){
											// 1 é video
											echo '<tr headers="'.$aula_value->id_aula.'">
												<td id="info"><i class="fab fa-youtube fa-lg"></i>&emsp;'.$aula_value->titulo.'</td>
												<td>
													<div headers="'.$aula_value->id_aula.'" style="float:right;width:100px;">
														<a href="editclass.php?id='.$aula_value->id_aula.'">
															<span class="status" style="background-color:lightgray">Editar</span>
														</a>
														<a class="excluiraula">
															<span class="status negative">
																<i class="fa fa-times"></i>
															</span>
														</a>
													</div>
												</td>
												
													
												
											</tr>';
											
										}else{
											// 2 é outros
											echo '<tr><td><i class="fas fa-clipboard-list fa-lg"></i>&emsp;'.$aula_value->titulo.'</td><td headers="'.$aula_value->id_aula.'" style="text-align:right"><a class="excluiraula"><i class="fa fa-times"></a></td></tr>';
										}
									}
								}else{
								}

								echo '<tr><td><a href="addclass.php?idm='.$modulo_value->id.'&idc='.$id_curso.'">+ Adicionar Aula</a></td></tr>';
								
								?>
								
							</tbody>		  
						</table>
					</div>

				<?php } ?>

			<div class="block-cont" id="new-section">
				<table class="order-table">
					<thead>
						<tr class="indice">
							<th>
								<form id="module">
									<input type="text" class="flat-form-input" placeholder="Nome do Módulo" name="modulename">
									<input id="criar" class="flat-form-button" type="submit" value="Criar">
								</form>
							</th> 
						</tr>
					</thead>
						  
				</table>
			</div>
			<br></br>
			<br></br>
			<br></br>
			
		</div>
	</div>



<script>
	$(document).ready(function(){

		$(".order-table #info").click(function(){
            var id = $(this).parent().attr("headers");
            window.location = "class.php?id="+id+"&idc="+<?php echo $id_curso;?>;
        });
		
		$('#addmodule').click(function(){
			$('#new-section').css('display', 'block');
		});

		$('#module').submit(function(){
			var url = window.location.href;
			var words = new String(url);

			var id_curso = words.split("id=");
			var module_name = $('input[name=modulename]').val();
			//alert(id_curso[1]);
			$.ajax({
				url: '../php/ajax/insertModule.php',
				type: 'POST',
				data: {id_curso:id_curso[1], name: module_name},
			}).done(function(data){
				$('.response').html(data);
				location.reload();				
			});
			return false;
		});

		//popup
		$('.close').click(function(){
			$('.popup-screen').css("display", "none");
		});
		$('.option1').click(function(){
			$('.popup-screen').css("display", "none");
		});

		$('.excluirmodulo').click(function(){
			var id = $(this).parent().attr("headers");
			$('#pop1').css("display", "block");
			$('#pop1 #afirmative').attr("href","?id=<?php echo $id_curso;?>&ac=excluir&idc=<?php echo $id_curso;?>&idm="+ id +"")
		});

		$('.excluiraula').click(function(){
			var id = $(this).parent().attr("headers");
			$('#pop2').css("display", "block");
			$('#pop2 #afirmative').attr("href","?go=excluir&id=<?php echo $id_curso;?>&ida="+ id +"");
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
