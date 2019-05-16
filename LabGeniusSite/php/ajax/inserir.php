<?php

session_start();

include '../../php/autoload.php';

if(isset($_POST)){
    if(empty($_POST['titulo'])){
        echo "sem titulo";
    }else if(empty($_POST['descricao'])){
        echo "sem descricao";
    }else if(empty($_POST['visibilidade'])){
        echo "sem visibilidade";
    }else if(empty($_POST['tag'])){
        echo "sem tag";
    }else{

        // print_r($_POST);
        // echo "<br></br>";
        // print_r($_FILES['fileUpload']);
        // echo "<br></br>";

        //file upload
        $extension = strtolower(substr($_FILES['fileUpload']['name'], -4));
        $new_name = md5(time()).$extension;
        $directory = "../../img/courses/thumb/";

        move_uploaded_file($_FILES['fileUpload']['tmp_name'], $directory.$new_name);
  
	    $instrutor = new Instrutor();
		$id = $instrutor->getId($_SESSION['user_session']);

	    $curso = new Curso();
        $curso->Cadastrar($id, $_POST['titulo'], $_POST['descricao'], $_POST['tag'], $_POST['visibilidade'], $new_name, $_POST['sala']);

        echo '<div class="success-msg">O curso foi criado!</div>';

        
    } 
}


    
    



?>