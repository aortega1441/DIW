<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/js/bootstrap.min.js">
    <<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="javaScript.js"></script>

    <title>MI PAGINA</title>
    <script>
        function comprobarClave() {
            let comprobado = true;
            clave1 = document.formularioRegist.contrasena.value;
            clave2 = document.formularioRegist.contrasenaRep.value;

            if (clave1 != clave2) {
                document.getElementById("error").classList.add("mostrar");
                comprobado = false;

            }

            return comprobado;
        }

        function foco() {
            document.getElementById("map").focus;
        }
    </script>

</head>

<body>


    <?php

    if (isset($_SESSION["correo"])) {

        if ($_SESSION["variableBandera"] == 1) {
            $url = "login/";
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $url);
            exit();
        }

    ?>

        <div class="login-wrap">
            <div id="error" class="alert alert-danger ocultar" role="alert">
                Las Contraseñas no coinciden
            </div>

            <?php

            if ($_SESSION["Usuario_bloqueado"] == 1) {

            ?>
                <div class="modal1" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header" style="text-align: center;">
                                <h4 class="modal-title">USUARIO BLOQUEADO</h4>
                            </div>


                            <div class="modal-body" style="text-align: center;">
                                Demasiados intentos fallidos, su cuenta está bloqueada. Contacte con el administrador
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('myModal').style.display='none'">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            } else if ($_SESSION["correo_valido"] == 1) {
                $_SESSION["correo_valido"] == 0;
            ?>

                <div class="modal1" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header" style="text-align: center;">
                                <h4 class="modal-title">ERROR</h4>
                            </div>


                            <div class="modal-body" style="text-align: center;">
                                Email incorrecto
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('myModal').style.display='none'">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            <?php
            } else
        if ($_SESSION["password_error"] == 1) {
                $_SESSION["password_error"] == 0;
            ?>

                <div class="modal1" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header" style="text-align: center;">
                                <h4 class="modal-title">ERROR</h4>

                            </div>


                            <div class="modal-body" style="text-align: center;">
                                Contrasña incorrecta
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('myModal').style.display='none'">Close</button>
                            </div>

                        </div>
                    </div>
                </div>


            <?php
            } else
        if ($_SESSION["correoRegistrado"] == 1) {
                $_SESSION["correoRegistrado"] == 0;
            ?>
                <div class="modal1" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header" style="text-align: center;">
                                <h4 class="modal-title">ERROR</h4>
                            </div>


                            <div class="modal-body" style="text-align: center;">
                                EL CORREO INTRODUCIDO YA EXISTE
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('myModal').style.display='none'">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            
            <div class="login-html">

                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrarse</label>



                <div class="login-form">

                    <div class="sign-in-htm">
                        <form action="comprobarUsuario.php" method="POST" name="formulario">
                            <div class="group">
                                <label for="user" class="label">E-mail</label>
                                <input id="user" name="correo" type="text" class="input" value="<?php echo $_SESSION["correo"] ?>" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Contraseña</label>
                                <input id="pass" name="contrasena" type="password" class="input" data-type="password" required>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Entrar">
                            </div>

                        </form>
                    </div>



                    <div class="sign-up-htm">
                        <form action="altaClientes/" method="POST" name="formularioRegist" onsubmit="return comprobarClave()">
                            <div class="group">
                                <label for="pass" class="label">E-mail</label>
                                <input id="pass" name="correo" type="email" class="input" value="<?php echo $_SESSION['correo'] ?>" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Contraseña</label>
                                <input id="pass" name="contrasena" type="password" class="input" data-type="password" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Repetir Contraseña</label>
                                <input id="pass" name="contrasenaRep" type="password" class="input" data-type="password" required>
                            </div>
                            <?php if (isset($_SESSION["fecha_nacimiento"])) {

                            ?>
                                <div class="group">
                                    <label for="fechaNacimiento" class="label">Fecha Nacimiento</label>
                                    <input id="pass" name="fechaNacimiento" type="date" class="input" value="<?php echo $_SESSION['fecha_nacimiento'] ?>" required>
                                </div>

                            <?php
                            } else {
                            ?>

                                <div class="group">
                                    <label for="fechaNacimiento" class="label">Fecha Nacimiento</label>
                                    <input id="pass" name="fechaNacimiento" type="date" class="input" required>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="group">
                                <input type="submit" class="button" value="Registrarse">
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>



    <?php


    } else {

    ?>

        <?php

        if (isset($_SESSION["correoRegistrado"])) {

            if ($_SESSION["correoRegistrado"] == 0) {


        ?>

                <div class="modal1" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header" style="text-align: center;">
                                <h4 class="modal-title">CORREO REGISTRADO</h4>
                            </div>


                            <div class="modal-body" style="text-align: center;">
                                SE HA REGISTRADO CORRECTAMENTE, GRACIAS
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('myModal').style.display='none'">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

        <?php
            }
        }

        ?>


        <div class="login-wrap">
            <div id="error" class="alert alert-danger ocultar" role="alert">
                Las Contraseñas no coinciden, vuelve a intentarlo
            </div>

            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrarse</label>


                <div class="login-form">

                    <div class="sign-in-htm">
                        <form action="comprobarUsuario.php" method="POST" name="formulario">
                            <div class="group">
                                <label for="user" class="label">Correo Electronico</label>
                                <input id="user" name="correo" type="email" class="input" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Contraseña</label>
                                <input id="pass" name="contrasena" type="password" class="input" data-type="password" required>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Entrar">
                            </div>

                        </form>
                    </div>



                    <div class="sign-up-htm">
                        <form action="altaClientes/" method="POST" name="formularioRegist" onsubmit="return comprobarClave()">
                            <div class="group">
                                <label for="pass" class="label">Correo Electronico</label>
                                <input id="pass" name="correo" type="email" class="input" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Contraseña</label>
                                <input id="pass" name="contrasena" type="password" class="input" data-type="password" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Repetir Contraseña</label>
                                <input id="pass" name="contrasenaRep" type="password" class="input" data-type="password" required>
                            </div>

                            <div class="group">
                                <label for="fechaNacimiento" class="label">Fecha Nacimiento</label>
                                <input id="pass" name="fechaNacimiento" type="date" class="input" required>
                            </div>

                            <div class="group">
                                <input type="submit" class="button" value="Registrarse">
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    <?php

    }

    ?>



    <footer class="alert p-3 m-3 mx-auto text-center" style="width: 800px;">

        <a class="btn btn-danger" onclick="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Ubicación
        </a>

        <div class="container text-center">
            <div class="collapse" id="collapseExample">

                <div id="map" class="border border-primary mt-3">
                </div>

                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaKdY_hkr3T1gjgR4weiIZrlJJ4a7kqr0&callback=initMap&v=weekly" async></script>

            </div>

        </div>

    </footer>

</body>

</html>