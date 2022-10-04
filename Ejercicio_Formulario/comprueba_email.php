<?php

    //Nos conectamos con la bbdd
    require('database.php');

    //Si viene definido
    if(isset($_POST)){

        //Guardamos el teléfono en una variable
        $email = $_POST['email'];

        //Sacamos si existe
        $resultaoPre = $conn -> query(
            "SELECT * FROM usuarios WHERE Usuario_email = '$email'"
        );

        //Si existe
        if($resultaoPre->num_rows >= 1){

            //Mandamos mensaje de error
            echo '<div class="alert alert-danger"><img src="warning.png" width=20px length=20px alt="Warning"></img> Este email ya está registrado </div>';

        }
    }

    //Cerramos la conexión
    mysqli_close($conn)

?>