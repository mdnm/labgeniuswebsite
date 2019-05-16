<?php
session_start();
require_once "php/conn.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>LabGenius</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <script src="js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="plugins/fontawesome/css/all.css">
  <link rel="shortcut icon" href="img/icons/atom-small.png" type="image/x-icon"/> 	
</head>
<body>



<div class="screen1">
<div class="panel bottom">
<?php include "include/white-nav.php";?>

<div class="home-title">
  <h1 style="z-index:2;margin-top:50px;">Aprenda informática de um jeito mais fácil.</h1>
</div>


  <img class="home-img" style="z-index:2;" src="img/homepage.png">

  <div class="scroll"></div>


</div>  
</div>


<div class="screen2" style="background-attachment: fixed;">

<div class="textcontent">
<div class="game-title">
  <h1>Aprenda com jogos</h1>
  <h3>Saia do tédio e jogue jogos super divertidos e aprenda mais ainda! Nossos jogos buscam passar o aprendizado, fazendo com que o aprender seja natural e espontâneo.</h3>
</div>
<div class="buttonvm">
<input type="submit" value="VEJA MAIS" id="slide2btns" class="slide2btns">
</div>
</div>

<div class="game-img">
  <img src="img/game.png">
</div> 



</div>


<div class="screen4" style="background:url(img/backgrounds/patterntech.png);background-attachment: fixed;">
  <div class="apptitle" style="position:relative;top:47%; transform:translateY(-50%);">
    <h1>Cursos oficias do LabGenius</h1>
    <img style="margin-top:100px;" src="img/blocks.png"> 
  </div>
</div>


<div class="screen5" style="background:url(img/backgrounds/space.gif);background-size:cover;">

<div style="width:100%; position:relative;top:47%;transform:translateY(-50%);">
  <div class="final-title">
    <h1>Faça o download do app</h1>
    <h4 style="font-weight:400;margin-top:10px;opacity:0.8;">Baixa agora o app, diponível para:</h4>
    <h2 style='margin-top:30px;'><i class="fab fa-android fa-lg"></i> &nbsp;Android</h2>
  </div>

    <a style="margin-top:100px;" id="down" class="buttondown2">Baixar para Android</a>
</div>

</div>

<script>

function myFunction(x) { document.getElementById("mySidenav").classList.toggle("open");
    x.classList.toggle("change");
}

</script>

<script src="owlcarousel/owl.carousel.min.js"></script>


<script>
  
</script>

</body>
</html>