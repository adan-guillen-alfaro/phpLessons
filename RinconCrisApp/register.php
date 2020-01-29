<?php
  session_start();

  $regStatus = "";
  $name = "";

  if (isset($_SESSION["new_name"]))
  {
    if (strlen($_SESSION["new_name"]) > 0 && strlen($_SESSION["new_lastname"]) > 0 && strlen($_SESSION["new_email"]) > 0 && strlen($_SESSION["new_pwd"]) > 0)
    {
      $regStatus = registerUser($_SESSION["new_name"], $_SESSION["new_lastname"], $_SESSION["new_email"], $_SESSION["new_pwd"], $_SESSION["new_direction"], $_SESSION["new_cp"], $_SESSION["new_city"], $_SESSION["new_country"], $_SESSION["new_tlf"]);
      echo($regStatus.'<br>');
      if ($regStatus === "OK")
      {
        $name = $_SESSION["new_name"];
      }
    }
    else
      $regStatus = "No se ha podido completar el registro.";
  }
  session_destroy();

  function registerUser($name, $lastname, $mail, $pwd, $direction, $cp, $city, $country, $tlf)
  {
    //TODO: Registrar
    return "OK";
  }
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
          echo ('<p class="headers">Registro completado satisfactoriamente.<br>Bienvenida/o a nuestro centro, '.htmlentities($name).'.</p>');
        }
      }
      else {
        echo ('<p class="error">'.$regStatus.'</p>');
      }
     ?>
    <p class="headers"><a href="main.php">Volver al inicio.</a></p>
  </body>
</html>
