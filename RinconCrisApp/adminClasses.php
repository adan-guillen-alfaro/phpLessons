<<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';
  require_once 'classmgr.php';
  require_once 'schedule.php';

  session_start();

  if (!isset($_SESSION["activeUserId"]))
  {
    header("Location: login.php");
    return;
  }

  $isAdminUser = hasAdminRights($pdo, $_SESSION["activeUserId"]);
  if (!$isAdminUser)
  {
    $_SESSION["activeUserId"] = "El usuario no tiene credenciales para administrar la base de datos.";
    header("Location: main.php");
    return;
  }
?>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

      <title>El rincón de Cris</title>
      <?php
       if (isMobile())
         echo('<link rel="stylesheet" href="styles_mobile.css">');
       else
         echo('<link rel="stylesheet" href="styles_pc.css">');
      ?>
  </head>
  <body>
    <<?php
      if (isset($_SESSION["error"]))
      {
        echo('<p class="error">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }

      echo('<a class="schedule_button" href="main.php">Atrás</a>');
    ?>
  </body>
</html>
