<?php

$servername = "localhost";
$database = "id19609229_diw";
$username = "id19609229_root";
$password = "Toor1234toor.";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>