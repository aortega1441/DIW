<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $seleccion=$_POST["seleccion"];
        
        $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexion");

    

    foreach ($seleccion as $id) {
        
        mysqli_query($conexion, "UPDATE `usuarios` SET Usuario_bloqueado= '0' WHERE Usuario_id='$id'" )
    or die("Problemas en el select " . mysqli_error($conexion));


    }


    mysqli_close($conexion);
    $url = "./";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$url);


    }else {
        $url = "./";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$url);
    }

?>