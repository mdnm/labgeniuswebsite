<?php
session_start();
require_once "../php/conn.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Games - LabGenius</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<link rel="stylesheet" href="../plugins/fontawesome/css/all.css">
	<link rel="shortcut icon" href="../img/icons/atom-small.png" type="image/x-icon"/> 
</head>
<body>


<nav class="nav-bar">
    <a href="../app/">
    	<img src="../img/icons/back.png" class="back-nav-btn">
    </a>
</nav>

<h1 class="page-title animate fadeIn">Jogos</h1>

<div class="containers">
	<a href="../games/pcbuilder">
		<div class="item">
			<div class="course-box">
				<div class="img-cont" style="background-image:url(../img/games/thumb/pcbuilder.png)">
				</div>
				<div class="info-cont">
					<h4>PC Builder (Alpha)</h4>
					<p>LabGenius</p>
					<div class="star-ratings-sprite"><span style="width:90%" class="star-ratings-sprite-rating"></span></div>
				</div>
			</div>
		</div>
	</a>
	<a href="../games/descobrir_fake">
		<div class="item">
			<div class="course-box">
				<div class="img-cont" style="background-image:url(../img/games/thumb/unknown.jpg)">
				</div>
				<div class="info-cont">
					<h4>Descobrir Fake (Alpha)</h4>
					<p>LabGenius</p>
					<div class="star-ratings-sprite"><span style="width:60%" class="star-ratings-sprite-rating"></span></div>
				</div>
			</div>
		</div>
	</a>
	<div class="gap"></div>
	<div class="gap"></div>
</div>


</body>
</html>


<?php

?>