<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die("Connection Failed :"). mysqli_connect_error();
} 