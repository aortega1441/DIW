<?php
$servername = "localhost";
$database = "diw";
$username = "root";
$password = "";

$Correo=$_POST["email"];
$Contraseña=$_POST["contraseña"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_query($conn, "INSERT INTO usuarios(Usuario_email, Usuario_clave)
VALUES ('$Correo', '$Contraseña')") ;



mysqli_close($conn);
?>