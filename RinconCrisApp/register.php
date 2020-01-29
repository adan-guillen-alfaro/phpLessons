<?php
  session_start();

  $regStatus = "";
  $name = "";

  if (isset($_SESSION["new_name"]))
  {
    if (strlen($_SESSION["new_name"]) > 0 && strlen($_SESSION["new_lastname"]) > 0 && strlen($_SESSION["new_email"]) > 0 && strlen($_SESSION["new_pwd"]) > 0)
    {
      //TODO: Registrar
      $regStatus = "OK";
      $name = $_SESSION["new_name"];
    }
    else
      $regStatus = "No se ha podido completar el registro.";
  }
  session_destroy();
?>
<html>
  <head>
      <meta charset="utf-8" />
      <title>El rincón de Cris</title>
      <link rel="stylesheet" href="styles_erc.css">
  </head>
  <body>
    <?php
      if (strlen($regStatus) > 0) {
        if ($regStatus === "OK") {
          echo ('<p class="headers">Registro completado satisfactoriamente. Bienvenida/o a nuestro centro, '.htmlentities($name).'.</p>');
        }
      }
      else {
        echo ('<p class="error">'.$regStatus.'</p>');
      }
     ?>
    <p class="headers"><a href="main.php">Volver al inicio.</a></p>
  </body>
</html>
