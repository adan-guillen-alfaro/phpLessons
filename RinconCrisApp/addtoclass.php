<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';

  session_start();

  if (!isset($_GET['classId']) && !isset($_SESSION['activeUser']))
  {
    $_SESSION['error'] = 'No se ha podido realizar la petición. Por favor vuelva a intentarlo.';
  }
  else
  {
    unset($_SESSION['error']);
    header("Location: underConstruction.php");
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
    <div class="login_table">
    <?php
      if (isset($_SESSION["error"]))
      {
        echo('<p class="headers">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }
      else
      {
        echo('<p class="headers">Se ha apuntado satisfactoriamente a la clase.</p>');
      }
    ?>
    <p class="headers"><a href="main.php">Volver a la página principal</a></p>
    </div>
  </body>
</html>
