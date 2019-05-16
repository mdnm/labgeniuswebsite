<?php
session_start();
include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){

	$sala = new Sala();
	$curso = new Curso();
	$instrutor = new Instrutor();
    $id = $instrutor->getId($_SESSION['user_session']);
    $id_curso = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Meus Cursos - LabGenius</title>
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
	
	<h1 class="page-title2">Editar Curso</h1>

	
		<div class="card-none">
			<form method="post" class="cardform2" enctype="multipart/form-data">
				<input class="flat-form-input-fullsize" value="<?php echo $curso->getTitulo($id_curso);?>" type="text" placeholder="Título do Curso" id="titulo" name="titulo">
				<textarea class="flat-form-textarea" name="descricao" id="descricao" placeholder="Descrição do Curso"><?php echo $curso->getDescricao($id_curso);?></textarea>
				
				<div id="wrapper">
				  <ul class="tags-input">
						<?php
							foreach ($curso->getTags($id_curso) as $key => $value) {
						?>
							<li class="tags"><span><?php echo $value->tag_word;?></span><i class="fa fa-times"></i></li>
						<?php
							}
						?>
				    <li class="tags-new">
	      				<input class="flat-form-input-fullsize" type="text" placeholder="Palavras-chave" name="tagis">
				    </li>
				  </ul>  
				</div>

				
				<?php
						if($curso->getVisibilidade($id_curso) < 2){
				?>
							<div class="flat-form-radio">
								<div class="flat-form-radio-container">
									<div class="left">
										<input type="radio" checked id="publico" class="visibilidade" name="visibilidade" value="1"><label class="radio" for="publico"></label>
									</div>
									<label class="radio-label" id="public" for="publico">Visível para todos</label>
								</div>
								
								<div class="flat-form-radio-container">
									<div class="left">
										<input type="radio" id="privado" class="visibilidade" name="visibilidade" value="2"><label class="radio" for="privado"></label>
									</div>
									<label class="radio-label" id="private" for="privado">Privado para Sala</label>
								</div>
							</div>

							<select name="sala" class="flat-form-input-fullsize" id="classrooms">
								<option id="none" value="0" selected>Escolha a sala...</option>
								<?php
									foreach ($sala->buscaSalas($id) as $key => $value) {
										echo '<option value="'.$value->id_sala.'">'.$value->nome.'</option>';
									}
								?>
							</select>
							
					<?php	
						}else{
					?>
					<div class="flat-form-radio">
						<div class="flat-form-radio-container">
							<div class="left">
								<input type="radio" id="publico" class="visibilidade" name="visibilidade" value="1"><label class="radio" for="publico"></label>
							</div>
							<label class="radio-label" id="public" for="publico">Visível para todos</label>
						</div>
						
						<div class="flat-form-radio-container">
							<div class="left">
								<input type="radio" checked id="privado" class="visibilidade" name="visibilidade" value="2"><label class="radio" for="privado"></label>
							</div>
							<label class="radio-label" id="private" for="privado">Privado para Sala</label>
						</div>
					</div>
					
					<select name="sala" style="display:block;margin-top:15px;" class="flat-form-input-fullsize" id="classrooms">
							
								<option checked value="<?php echo $curso->getIdSala($id_curso);?>"><?php echo $sala->getNome($curso->getIdSala($id_curso))?></option>
							
						
						<?php
							foreach ($sala->buscaSalas($id) as $key => $value) {
								echo '<option value="'.$value->id_sala.'">'.$value->nome.'</option>';
							}
						?>
					</select>

				<?php
					}
				?>

					<div id="file-upload-form" class="uploader">
						<input id="file-upload" type="file" name="fileUpload" accept="image/*" />
						<label for="file-upload" id="file-drag">
							<img id="file-image" src="#" alt="Preview" class="hidden">
							<div id="start">
								<i class="fa fa-file-upload" aria-hidden="true"></i>
								<div>Selecione uma miniatura ou arraste aqui.</div>
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
				
	
				<div class="recebe">
				</div>

				<input class="flat-form-button" name="criarcurso" type="submit" value="Editar Curso">
			</form>
			
		</div>

		

	</div>


<script>
	$(document).ready(function(){

	$('.cardform2').submit(function(){
		
		var titulo = $('#titulo').val();
		var descricao = $('#descricao').val();
		var visibilidade = $('.visibilidade:checked').val();
		var sala = $('#classrooms option:selected').val();
		var error_msg = '<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>';

			
		var tags = [];
		$('.tags').each(function(index){
			tags.push($(this).text());
		});

		id_curso = <?php echo $id_curso;?>

		//alert(tags);
		var form = $('.cardform2')[0];
		var formdata = new FormData(form);
		formdata.append("id_curso", id_curso);
		formdata.append("tag", tags);

		if(titulo == ""){
			$('.recebe').html(error_msg);
		}else if(descricao == ""){
			$('.recebe').html(error_msg);
		}else if(visibilidade == ""){
			$('.recebe').html(error_msg);
		}else if(tags == ""){
			$('.recebe').html(error_msg);
		}else if(sala == ""){
			$('.recebe').html(error_msg);
		}else{

			$.ajax({
				url: '../php/ajax/editCourse.php',
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
	
	


	$(".order-table #info").click(function(){
		var id = $(this).parent().attr("headers");
		window.location = "classes.php?id="+id;
	});

	$("#public").click(function(){
		$("#classrooms").css("display", "none");
	});

	$("#private").click(function(){
		$("#classrooms").css("display", "block");
		$("#classrooms").css("margin-top", "15px");
	});


	function existingTag(text){
		var existing = false,
			text = text.toLowerCase();

		$(".tags").each(function(){
			if ($(this).text().toLowerCase() == text) 
			{
				existing = true;
				return "";
			}
		});

		return existing;
	}


		$(".tags-new input").focus();
		
		$(".tags-new input").keyup(function(){

			var tag = $(this).val(),
			length = tag.length;

			if((tag.charAt(length - 1) == ' ') && (tag != " ") || (tag.charAt(length - 1) == ',') && (tag != ","))
			{
				tag = tag.substring(0, length - 1);

				if(!existingTag(tag))
				{
					$('<li class="tags"><span>' + tag + '</span><i class="fa fa-times"></i></i></li>').insertBefore($(".tags-new"));
					$(this).val("");	
				}
				else
				{
					$(this).val(tag);
				}
			}
		});
		
		//exclui tags
		$(document).on("click", ".tags i", function(){
			$(this).parent("li").remove();
		});

		//exclui error
		$(document).on("click", ".error-msg i", function(){
			$(this).parent("div").remove();
		});
	});
</script>

<script>
	
	// File Upload
// 
function ekUpload(){
  function Init() {

    console.log("Upload Initialised");

    var fileSelect    = document.getElementById('file-upload'),
        fileDrag      = document.getElementById('file-drag'),
        submitButton  = document.getElementById('submit-button');

    fileSelect.addEventListener('change', fileSelectHandler, false);

    // Is XHR2 available?
    var xhr = new XMLHttpRequest();
    if (xhr.upload) {
      // File Drop
      fileDrag.addEventListener('dragover', fileDragHover, false);
      fileDrag.addEventListener('dragleave', fileDragHover, false);
      fileDrag.addEventListener('drop', fileSelectHandler, false);
    }
  }

  function fileDragHover(e) {
    var fileDrag = document.getElementById('file-drag');

    e.stopPropagation();
    e.preventDefault();

    fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
  }

  function fileSelectHandler(e) {
    // Fetch FileList object
    var files = e.target.files || e.dataTransfer.files;

    // Cancel event and hover styling
    fileDragHover(e);

    // Process all File objects
    for (var i = 0, f; f = files[i]; i++) {
      parseFile(f);
      uploadFile(f);
    }
  }

  // Output
  function output(msg) {
    // Response
    var m = document.getElementById('messages');
    m.innerHTML = msg;
  }

		function parseFile(file) {

			console.log(file.name);
			output(
				'<strong>' + encodeURI(file.name) + '</strong>'
			);
			
			// var fileType = file.type;
			// console.log(fileType);
			var imageName = file.name;

			var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
			if (isGood) {
				document.getElementById('start').classList.add("hidden");
				document.getElementById('response').classList.remove("hidden");
				document.getElementById('notimage').classList.add("hidden");
				// Thumbnail Preview
				document.getElementById('file-image').classList.remove("hidden");
				document.getElementById('file-image').src = URL.createObjectURL(file);
			}
			else {
				document.getElementById('file-image').classList.add("hidden");
				document.getElementById('notimage').classList.remove("hidden");
				document.getElementById('start').classList.remove("hidden");
				document.getElementById('response').classList.add("hidden");
				document.getElementById("file-upload-form").reset();
			}
		}

  function setProgressMaxValue(e) {
    var pBar = document.getElementById('file-progress');

    if (e.lengthComputable) {
      pBar.max = e.total;
    }
  }

  function updateFileProgress(e) {
    var pBar = document.getElementById('file-progress');

    if (e.lengthComputable) {
      pBar.value = e.loaded;
    }
  }

  function uploadFile(file) {

    var xhr = new XMLHttpRequest(),
      fileInput = document.getElementById('class-roster-file'),
      pBar = document.getElementById('file-progress'),
      fileSizeLimit = 1024; // In MB
    if (xhr.upload) {
      // Check if file is less than x MB
      if (file.size <= fileSizeLimit * 1024 * 1024) {
        // Progress bar
        pBar.style.display = 'inline';
        xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
        xhr.upload.addEventListener('progress', updateFileProgress, false);

        // File received / failed
        xhr.onreadystatechange = function(e) {
          if (xhr.readyState == 4) {
            // Everything is good!

            // progress.className = (xhr.status == 200 ? "success" : "failure");
            // document.location.reload(true);
          }
        };

        // Start upload
        xhr.open('POST', document.getElementById('file-upload-form').action, true);
        xhr.setRequestHeader('X-File-Name', file.name);
        xhr.setRequestHeader('X-File-Size', file.size);
        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.send(file);
      } else {
        output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
      }
    }
  }

  // Check for the various File API support.
  if (window.File && window.FileList && window.FileReader) {
    Init();
  } else {
    document.getElementById('file-drag').style.display = 'none';
  }
}
ekUpload();

</script>

</body>
</html>

<?php
}else{
	header("Location: index.php");
}

?>
