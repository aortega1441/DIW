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
  <title>BORRAR USUARIO</title>

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
        <a class="navbar-brand" href="../../administrador/">Inicio</a>

        <div class="dropdown">
          <button type="button" class="btn btn-primary dropdown-toggle" style="color: black;background-color: #fff888;" data-toggle="dropdown">
            Opciones de Administrador
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="../agregar/">Agregar Usuario</a>
            <a class="dropdown-item" href="../borrar/">Borrar Usuario</a>
            <a class="dropdown-item" href="../buscar/">Buscar Usuario</a>
          </div>
        </div>
      </div>
    <?php
    } else {
    ?>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <a class="navbar-brand" href="../../cliente/">Inicio</a>
      </div>
    <?php
    }

    ?>

    <div id="login" class="dropdown">
      <button type="button" class="btn btn-primary dropdown-toggle" style="color: black;background-color: #fff888;" data-toggle="dropdown">
        <?php echo $_SESSION["correo"] ?>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="../../modificarPerfil/buscarDetalles.php">Editar Perfil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../../borrado.php">Login Out</a>
      </div>
    </div>
    </div>
  </nav>

  <div class="jumbotron text-center" style="color: white; background: transparent;">
    <h1>BORRAR USUARIO</h1>
  </div>

  <?php

  if ($_SESSION["idRegistrado"] == 1) {
    $_SESSION["idRegistrado"] == 0;
  ?>
    <div class="modal1" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">ERROR</h4>
          </div>


          <div class="modal-body" style="text-align: center;">
            EL ID NO ESTA REGISTRADO, POR FAVOR INTENTALO DE NUEVO
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

  <?php

  if ($_SESSION["idBorrado"] == 1) {
    $_SESSION["idBorrado"] = 0;
  ?>
    <div class="modal1" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">BORRADO</h4>
          </div>


          <div class="modal-body" style="text-align: center;">
            USUARIO BORRADO CON EXITO
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

  <div class="container" style="width: 50%;">

    <form action="./borrar.php" method="POST">
      <label for="id" class="form-label">ID DEL USUARIO</label>
      <input name="id" type="number" class="form-control" required></input>
      <input class="btn btn-success" style=" display: block; margin: auto;margin-top: 15px;" type="submit" value="BORRAR USUARIO">
    </form>

  </div>
</body>

</html>