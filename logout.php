<?php
session_start();
unset($_SESSION['ROLE']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
session_destroy();
header("location:login.php");
die();
?>