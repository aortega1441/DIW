<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilosEditar.css">
  <link rel="stylesheet" href="../../../bootstrap-4.5.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../bootstrap-4.5.3-dist/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>BUSQUEDA DE USUARIO</title>

</head>

<body style="background-color: #154c79; color: white; background-image: url(../../../fondo3.png);">


<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #610027; border-bottom: 2px solid black;">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>

<?php

if ($_SESSION["Usuario_perfil"] == "ADMINISTRADOR") {
?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <a class="navbar-brand" href="../../administrador/"><img src="../../../imagenes/inicio.png" alt="imagen" width="30px" height="40px">&nbsp;&nbsp;Inicio</a>

    <a class="btn" href="../agregar/" style="color: black;background-color: #fff888;"><img src="../../../imagenes/agregar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Agregar Usuario</a>&nbsp;
    <a class="btn" href="../borrar/" style="color: black;background-color: #fff888;"><img src="../../../imagenes/borrar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Borrar Usuario</a>&nbsp;
    <a class="btn" href="../buscar/" style="color: black;background-color: #fff888;"><img src="../../../imagenes/buscar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Buscar Usuario</a>
  </div>
<?php
} else {
?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <a class="navbar-brand" href="../../cliente/"><img src="../../../imagenes/inicio.png" alt="imagen" width="30px" height="40px">&nbsp;&nbsp;Inicio</a>
  </div>
<?php
}

?>

<a class="btn" style="color: black;background-color: #fff888;" href="../../modificarPerfil/buscarDetalles.php"><img src="../../../imagenes/editar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Editar Perfil</a>&nbsp;
<a class="btn" style="color: black;background-color: #fff888;" href="../../borrado.php"><img src="../../../imagenes/salir.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Login Out</a>
</div>
</nav>

  <div class="jumbotron text-center" style="color: white; background: transparent;">
    <h1>BUSQUEDA DE USUARIOS</h1>
  </div>


  <div class="container" style="width: 50%; margin-top: 5%;">

    <h2>BUSCAR USUARIOS</h2>

    <hr size=10 noshade="noshade" color="white">

    <br>
    <form action="./mostrarTabla/" method="POST">
      <label for="seleccion" class="form-label">Seleccion: </label>
      <select name="seleccion">
        <option value="desbloquear">DESBLOQUEAR USUARIOS</option>
        <option value="borrarUsuarios">BORRAR USUARIOS</option>
        <option value="editarUsuarios">EDITAR USUARIOS</option>
      </select>
      <br>
      <label for="dni" class="form-label" hidden>DNI USUARIOS</label>
      <input name="dni" type="text" class="form-control" value="" hidden></input>
      <label for="provincia" class="form-label" hidden>PROVINCIA</label>
      <input name="provincia" type="text" class="form-control" value="" hidden></input>
      <label for="email" class="form-label" hidden>E-MAIL</label>
      <input name="email" type="text" class="form-control" value="" hidden></input>
      <input class="btn btn-success" style=" display: block; margin: auto;margin-top: 15px;" type="submit" value="BUSCAR USUARIOS">
    </form>

  </div>

</body>

</html>