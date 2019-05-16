<img src="img/icons/logo.png" class="logo">
    
<div id="mySidenav" class="sidenav">
    <div class="menu-list-cont">
        <a class="menu-btn" href="index.php">Home</a>
        <a class="menu-btn" href="index.php">Download</a>
  <?php

        if(isset($_SESSION['user_session'], $_SESSION['passwd_session']) && $_SESSION['user_type'] == 1){
            echo "<a class='menu-btn' href='app/'>Ir para app</a>;
                  <a class='menu-btn' href=''>Olá, ".$_SESSION['user_session']."</a>;
                  <a class='menu-btn' href=\"?go=sair\">Sair</a>";
        }else if(isset($_SESSION['user_session'], $_SESSION['passwd_session']) && $_SESSION['user_type'] == 2){
            echo "<a class='menu-btn' href='instructor/'>Ir para app</a>;
                  <a class='menu-btn' href=''>Olá, ".$_SESSION['user_session']."</a>;
                  <a class='menu-btn' href=\"?go=sair\">Sair</a>";
        }else{
            echo "<a class='menu-btn' href='login.php'>Entrar</a><a class='menu-btn' href='cadastro.php'>Cadastrar</a>";
            
        }

        if(@$_GET['go'] == 'sair'){
            unset($_SESSION['user_session']);
            unset($_SESSION['passwd_session']);
            header('Location: index.php');
            
        }

        ?>
    </div>
</div>
<div id="main">
    <span style="cursor:pointer">
        <div class="container" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </span>
</div>

<script>

function myFunction(x) { document.getElementById("mySidenav").classList.toggle("open");
    x.classList.toggle("change");
}

</script>