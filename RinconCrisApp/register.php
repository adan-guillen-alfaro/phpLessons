<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';

  session_start();

  $regStatus = "";
  $name = "";

  if (isset($_SESSION["new_name"]))
  {
    if (strlen($_SESSION["new_name"]) > 0 && strlen($_SESSION["new_lastname"]) > 0 && strlen($_SESSION["new_email"]) > 0 && strlen($_SESSION["new_pwd"]) > 0)
    {
      if (!existsUserEmail($pdo, $_SESSION["new_email"]))
      {
        $regStatus = registerUser($pdo, $_SESSION["new_name"], $_SESSION["new_lastname"], $_SESSION["new_email"], $_SESSION["new_pwd"], $_SESSION["new_direction"], $_SESSION["new_cp"], $_SESSION["new_city"], $_SESSION["new_country"], $_SESSION["new_tlf"]);
        if ($regStatus === "OK")
        {
          $name = $_SESSION["new_name"];

          unset($_SESSION["new_name"]);
          unset($_SESSION["new_lastname"]);
          unset($_SESSION["new_email"]);
          unset($_SESSION["new_pwd"]);
          unset($_SESSION["new_direction"]);
          unset($_SESSION["new_cp"]);
          unset($_SESSION["new_city"]);
          unset($_SESSION["new_country"]);
          unset($_SESSION["new_tlf"]);
        }
        else
          $_SESSION["error"] = "No se ha podido registrar el nuevo usuario.";
      }
      else
        $_SESSION["error"] = "Ya existe un usuario con la dirección de correo indicada.";
    }
    else
      $_SESSION["error"] = "No se ha podido completar el registro.";
  }
  session_destroy();
?>
<html>
  <head>
      <meta charset="utf-8" />
      <title>El rincón de Cris</title>
      <?php
       if (isMobile())
         echo('<link rel="stylesheet" href="styles_mobile.css">');
       else
         echo('<link rel="stylesheet" href="styles_pc.css">');
      ?>
  </head>
  <body>
    <?php
      if (strlen($regStatus) > 0) {
        if ($regStatus === "OK") {
          echo ('<p class="headers">Registro completado satisfactoriamente.<br>Bienvenida/o a nuestro centro, '.htmlentities($name).'.</p>');
        }
        else {
          echo ('<p class="error">'.$_SESSION["error"].'</p>');
          unset($_SESSION["error"]);
        }
      }
      else {
        echo ('<p class="error">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }
     ?>
    <p class="headers"><a href="main.php">Volver al inicio.</a></p>
  </body>
</html>
