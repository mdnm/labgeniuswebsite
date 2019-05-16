<?php

session_start();

include '../../php/autoload.php';

if(isset($_POST)){
    if(empty($_POST['titulo'])){
        echo "Está sem título!";
    }else if(empty($_POST['fala1'])){
        echo "O campo de fala está vazio!";
    }else if(empty($_FILES['fileUpload']['name'])){
        echo '<div class="error-msg"><p>Escolha uma foto!</p><i class="fa fa-times"></div>';
    }else{

        $id_curso = $_GET['id'];

        //file upload
        $extension = strtolower(substr($_FILES['fileUpload']['name'], -4));
        $new_name = md5(time()).$extension;
        $directory = "../../img/labcourses/classes/img/";

        move_uploaded_file($_FILES['fileUpload']['tmp_name'], $directory.$new_name);
	    $lgaula = new LabgeniusAula();
        $lgaula->cadastrarAula1($id_curso, $_POST['titulo'], $_POST['fala1'], $new_name, 1);

        echo '<div class="success-msg">O curso foi criado!</div>';

        
    } 
}


    
    



?>