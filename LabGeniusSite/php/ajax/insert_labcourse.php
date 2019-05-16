<?php

session_start();

include '../../php/autoload.php';

if(isset($_POST)){
    if(empty($_POST['titulo'])){
        echo "sem titulo";
    }else if(empty($_POST['descricao'])){
        echo "sem descricao";
    }elseif(empty($_FILES['fileUpload']['name'])){
        echo '<div class="error-msg"><p>Escolha uma foto!</p><i class="fa fa-times"></div>';
    }else{

        // print_r($_POST);
        // echo "<br></br>";
        // print_r($_FILES['fileUpload']);
        // echo "<br></br>";

        //file upload
        $extension = strtolower(substr($_FILES['fileUpload']['name'], -4));
        $new_name = md5(time()).$extension;
        $directory = "../../img/labcourses/icons/";

        move_uploaded_file($_FILES['fileUpload']['tmp_name'], $directory.$new_name);
  

	    $lgcurso = new LabgeniusCurso();
        $lgcurso->Cadastrar($_POST['titulo'], $_POST['descricao'], $_POST['color'], $new_name);

        echo '<div class="success-msg">O curso foi criado!</div>';

        
    } 
}


    
    



?>