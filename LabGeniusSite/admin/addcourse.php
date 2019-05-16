<?php
session_start();

include '../php/autoload.php';

if (isset($_SESSION['user_session']) && isset($_SESSION['passwd_session']) && $_SESSION['user_type'] == 3){

	$admin = new Admin();

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

<div class="screens">
	<!--inclui o menu lateral-->
	<?php 		
	include "../include/admin-side-nav.php";
	?>
	<div class="content-wrapper">
	<h1 class="page-title2">Criar Curso</h1>
	<div class="card-none">
			<form method="post" class="cardform2" enctype="multipart/form-data">
				<input class="flat-form-input-fullsize" type="text" placeholder="Título do Curso" id="titulo" name="titulo">
				<textarea class="flat-form-textarea" name="descricao" id="descricao" placeholder="Descrição do Curso"></textarea>

				<div id="file-upload-form" class="uploader">
					<input id="file-upload" type="file" name="fileUpload" accept="image/*"/>
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

				<div class="cor"></div>

				<div class="color-picker-container">
				   <div class="color-picker-header">
				      <h2>Preview</h2>
				   </div>
				   <div id="hsl-selected-color-back">
						<div class="cat-block" id="hsl-selected-color" style="background: rgb(66, 134, 244);">
							<div class="cat-img-cont">
								<img id="file-image2" src="#" alt="Preview" class="hidden">
							</div>
							<div class="cat-title-cont">
								<p id="preview-name">NOME DO CURSO</p>
							</div>
						</div>
				   </div>
				   <div class="slider-group">
				      <div class="slider-container">
				         <label>hue</label>
				         <input type="number" id="number-h" min="0" max="360" step="1"/>
				         <input type="range" id="slider-h" min="0" max="360" step="1"/>
				      </div>
				      <div class="slider-container">
				         <label>saturation</label>
				         <input type="number" id="number-s" min="0" max="100" step="1"/>
				         <input type="range" id="slider-s" min="0" max="100" step="1"/>
				      </div>
				      <div class="slider-container">
				         <label>lightness</label>
				         <input type="number" id="number-l" min="0" max="100" step="1"/>
				         <input type="range" id="slider-l" min="0" max="100" step="1"/>
				      </div>
				      <div class="slider-container">
				         <label>alpha</label>
				         <input type="number" id="number-a" min="0" max="1" step="0.05"/>
				         <input type="range" id="slider-a" min="0" max="1" step="0.05"/>
				      </div>
				   </div>
				</div>
				<div class="recebe"></div>
				<input class="flat-form-button" name="criarcurso" type="submit" value="Criar Curso">
				
			</form>
		</div>
		
	</div>

	<script type="text/javascript">

	$('#titulo').focusout(function(){
		var value = $('#titulo').val();
		$('#preview-name').text(value);
	});


	///////////// Color picker
		// setup
		const currentHSL = document.getElementById('hsl-selected-color');
		const sliders = [];
		const hsla = [200, 100, 50, 1];
		const letters = ['h','s','l','a'];

		//		get Colors
		// --------------------
		function getCol(value) {
			let gradient = [];
			if (value === 'h')
				for (let h = 0; h <= 360; h += 20) {
					gradient.push('hsla(' + h + ',' + hsla[1] + '%,' + hsla[2] + '%,' + hsla[3] + ')');
				}
			else if (value === 's')
				for (let s = 0; s <= 100; s += 50) {
					gradient.push('hsla(' + hsla[0] + ',' + s + '%,' + hsla[2] + '%,' + hsla[3] + ')');
				}
			else if (value === 'l')
				for (let l = 0; l <= 100; l += 10) {
					gradient.push('hsla(' + hsla[0] + ',' + hsla[1] + '%,' + l + '%,' + hsla[3] + ')');
				}
			else if (value === 'a')
				for (let a = 0; a < 2; a++) {
					gradient.push('hsla(' + hsla[0] + ',' + hsla[1] + '%,' + hsla[2] + '%,' + a + ')');
				}
			return gradient;
		}

		//		Update
		// --------------------
		function update() {
			// update sliders
			for (let i = 0; i < 4; i++) {
				hsla[i] = sliders[i].value;
				let fill = '-webkit-linear-gradient(left, ' + getCol(letters[i]) + ')';
				sliders[i].style.background = fill;
			}	
			// set box color
			let color = 'hsla(' + hsla[0] + ',' + hsla[1] + '%,' + hsla[2] + '%,' + hsla[3] + ')';
			currentHSL.style.background = color;
			currentHSL.style.boxShadow = "0px 9px 0px 0px rgba(0,0,0,0.10), 0px 9px 0px 0px "+ color;
		}

		//		Setup Events
		// --------------------
		for (let i = 0; i < 4; i++) {
			
			// get slider + number input
			let slider = document.getElementById('slider-' + letters[i]);
			let number = document.getElementById('number-' + letters[i]);
			
			// slider events
			slider.addEventListener('input', function() {
				window.requestAnimationFrame(update);
				number.value = slider.value;
			}, false);
			
			// number events
			number.addEventListener('input', function() {
				window.requestAnimationFrame(update);
				slider.value = number.value;
			}, false);
			
			// set value
			number.value = hsla[i];
			slider.value = hsla[i];
			
			// push objects
			sliders.push(slider);
		}

		update();

///////// File Upload
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
				document.getElementById('file-image2').classList.remove("hidden");
				document.getElementById('file-image2').src = URL.createObjectURL(file);
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

		$('.cardform2').submit(function(){

			var color = $('#hsl-selected-color').css('background-color');
			//alert(color);

			var form = $('.cardform2')[0];
			var formdata = new FormData(form);
			formdata.append("color", color);

			titulo = $("#titulo").val();
			descricao = $("#descricao").val();

			if(titulo == ""){
				$('.recebe').html('<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>');
			}else if(descricao == ""){
				$('.recebe').html('<div class="error-msg"><p>Preencha todos os campos!</p><i class="fa fa-times"></div>');
			}else{
				$.ajax({
					url: '../php/ajax/insert_labcourse.php',
					type: 'POST',
					data: formdata,
					contentType: false,
					processData: false,	
				}).done(function(data){
					$('.recebe').html(data);

				});
			}
			
			return false;

		});
	</script>


</body>
</html>

<script>

</script>

<?php

}else{
	header("Location: ../index.php");
}

?>
