<?php

//Nos conectamos con la base de datos.
include('database.php');

$Correo = $_POST["email"];
$Contraseña = $_POST["contraseña"];
$Nombre = $_POST["nombre"];
$Ap1 = $_POST["apellido1"];
$Ap2 = $_POST["apellido2"];
$Nick = $_POST["nick"];
$FA = date('Y-m-d');

$hash = md5($Contraseña);  //    <--------  Hasheo??
//echo $hash;

//Insertamos datos.
$query = "INSERT INTO usuarios(Usuario_email, Usuario_clave, Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_nick, Usuario_fecha_alta)
VALUES ('$Correo', '$Contraseña','$Nombre','$Ap1','$Ap2','$Nick','$FA')";

$registro = mysqli_query($conn, $query) or die("Problemas al registrar usuario: " . mysqli_error($conn));

header("Location: login.html");