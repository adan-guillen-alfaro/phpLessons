<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';

  session_start();

  if (!isset($_GET['classId']) && !isset($_SESSION['activeUserId']))
  {
    $_SESSION['error'] = 'No se ha podido realizar la petición. Por favor vuelva a intentarlo.';
  }
  else
  {
    addToclass($pdo, $_GET['classId'], $_SESSION['activeUserId']);
    header("Location: main.php");
    return;
  }

  function addToclass($pdo, $classId, $userId)
  {
    $sql = "INSERT INTO userClassHistory (user_id, class_id) VALUES (:user, :class)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':user' => $user_id,
                          ':class' => $classId ));
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
