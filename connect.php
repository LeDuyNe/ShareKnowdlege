<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = "shareknowledge";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
mysqli_set_charset($conn, 'UTF8');
?>