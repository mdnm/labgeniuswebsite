<div class="side-dash-menu">
	<div class="profile-cont">
		<div class="profile-cont-left">
			<div class="rounded-image-moldure">
				<img src="../img/defaultprofile/admin.png">
			</div>
		</div>
		<div class="profile-cont-right">
			<div class="profile-text">			
				<p id="p1"><?php echo $admin->getNome($_SESSION['user_session']).' '.$admin->getSobrenome($_SESSION['user_session']);?></p>
				<p id="p2">Admin</p>
			</div>
		</div>
	</div>
	<ul class="dash-menu-list">
		<a href="index.php"><li><div class="icon-list"><img src="../img/icons/explore.png"/></div><div class="text-list">Home</div></li></a>
		<a href="classrooms.php"><li><div class="icon-list"><img src="../img/icons/users.png"/></div><div class="text-list">Salas</div></li></a>
		<a href="courses.php"><li><div class="icon-list"><img src="../img/icons/cap.png"/></div><div class="text-list">Cursos</div></li></a>
		<a href="myaccount.php"><li><div class="icon-list"><img src="../img/icons/user.png"/></div><div class="text-list">Conta</div></li></a>
		<!-- <a href=""><li><div class="icon-list"><img src="../img/icons/gear.png"/></div><div class="text-list">Ajustes</div></li></a> -->

	</ul>
	<hr class="menu-separate">
	<ul class="dash-menu-list">
		<a href="../php/sair.php"><li><div class="icon-list"><img src="../img/icons/sign-out.png"/></div><div id="sair" class="text-list">Sair</div></li></a>
	</ul>
</div>