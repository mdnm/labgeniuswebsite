<?php

session_start();

include '../../php/autoload.php';

if(isset($_POST)){
    if(empty($_POST['titulo'])){
        echo "sem titulo";
    }else if(empty($_POST['fala1'])){
        echo "sem fala1";
    }else if(empty($_POST['fala2'])){
        echo "sem fala2";
    }else{
        $id_curso = $_GET['id'];
        $lgaula = new LabgeniusAula();
        $lgaula->cadastrarAula2($id_curso, $_POST['titulo'], $_POST['fala1'], $_POST['fala2'], 2);
        echo '<div class="success-msg">O curso foi criado!</div>';
    } 
}


    
    



?>