<?php
session_start();
unset($_SESSION['user_session']);
unset($_SESSION['passwd_session']);
unset($_SESSION['user_type']);

header("Location: ../index.php");

?>