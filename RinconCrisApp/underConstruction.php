<?php
  require_once 'isMobile.php';

  session_start();

  if (!isset($_SESSION["activeUser"]))
  {
    header("Location: login.php");
    return;
  }
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
    <p class="headers">Estamos trabajando en esta página.</p>
    <p class="headers"><a href="main.php">Volver a la página principal</a></p>
  </body>
</html>
