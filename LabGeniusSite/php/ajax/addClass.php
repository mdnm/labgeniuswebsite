<?php

session_start();

include '../../php/autoload.php';

if(isset($_POST)){
    if(empty($_POST['titulo'])){
        echo "sem titulo";
    }else if(empty($_POST['descricao'])){
        echo "sem descricao";
    }else if(empty($_POST['video_url'])){
        echo "sem video";
    }else{

        // print_r($_POST);
        $aula = new Aula();
        $aula->createVideoAula($_POST['id_curso'], $_POST['id_modulo'], $_POST['titulo'], $_POST['descricao'], '1', $_POST['video_url']);
            
    } 
}


    
    
