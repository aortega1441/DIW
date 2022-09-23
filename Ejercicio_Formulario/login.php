<?php
 
include("database.php");

$sql = "SELECT * FROM usuarios WHERE Usuario_email = '{$_POST['loginCorreo']}' AND Usuario_clave = '{$_POST['loginContraseña']}'";

  $resultado = mysqli_query($conn, $sql) or die();

  if( $resultado->num_rows > 0 ) {  

    session_start(); 

    $_SESSION['Usuario_nombre'] = $_POST['loginCorreo'];
    $_SESSION['Usuario_clave'] = $_POST['loginContraseña'];

    header("Location: bienvenido.html");

  } else {    
    echo "Usuario o contraseña incorrectos";
  
}