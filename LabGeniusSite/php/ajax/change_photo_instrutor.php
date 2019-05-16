<?php

session_start();

include '../../php/autoload.php';

if(isset($_POST)){
    if(empty($_FILES['fileUpload'])){
        echo "Escolha uma foto";
    }else{

        //print_r($_FILES['fileUpload']);

        $username =  $_GET['user'];
        $new_photo = $_FILES['fileUpload']['tmp_name'];
        
        $instrutor = new Instrutor();
        $instrutor->changeProfilePhoto($username, $new_photo);

        //echo '<div class="success-msg">Imagem alterada!</div>';

        
    } 
}


    
    



?>