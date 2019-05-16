<?php

session_start();

include '../../php/autoload.php';

// // print_r($_POST);
$curso = new Curso();
$curso->insertRating($_POST['id_aluno'], $_POST['id_curso'], $_POST['nota']);

?>