<?php

session_start();

include '../../php/autoload.php';

// print_r($_POST);
$modulo = new Modulo();
$modulo->createModulo($_POST['id_curso'], $_POST['name']);

?>