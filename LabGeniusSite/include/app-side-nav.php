<div class="side-dash-menu">
		<div class="profile-cont">
			<div class="profile-cont-left">
				<div class="rounded-image-moldure">
					<img src="../img/profile/<?php echo $aluno->getPicture($_SESSION['user_session']);?>"/>
				</div>
			</div>
			<div class="profile-cont-right">
				<div class="profile-text">
					<p id="p1"><?php echo $aluno->getNome($_SESSION['user_session']).' '.$aluno->getSobrenome($_SESSION['user_session']);?></p>
					<p id="p2">Aluno</p>
				</div>
			</div>
		</div>
		<ul class="dash-menu-list">
			<a href="index.php"><li><div class="icon-list"><img src="../img/icons/explore.png"/></div><div class="text-list">Home</div></li></a>
			<a href="myclassrooms.php"><li><div class="icon-list"><img src="../img/icons/users.png"/></div><div class="text-list">Minhas Salas</div></li></a>
			<a href="mycourses.php"><li><div class="icon-list"><img src="../img/icons/cap.png"/></div><div class="text-list">Meus Cursos</div></li></a>
			<a href="myaccount.php"><li><div class="icon-list"><img src="../img/icons/user.png"/></div><div class="text-list">Minha Conta</div></li></a>
			<!-- <a href=""><li><div class="icon-list"><img src="../img/icons/gear.png"/></div><div class="text-list">Ajustes</div></li></a> -->

		</ul>
		<hr class="menu-separate">
		<ul class="dash-menu-list">
			<a href="../php/sair.php"><li><div class="icon-list"><img src="../img/icons/sign-out.png"/></div><div id="sair" class="text-list">Sair</div></li></a>
		</ul>
	</div>