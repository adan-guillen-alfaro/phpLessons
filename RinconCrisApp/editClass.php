<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';

  session_start();

  if (!isset($_GET['classId']) && !isset($_SESSION['activeUser']))
  {
    $_SESSION['error'] = 'No tiene credenciales para realizar esta operación.';
    header("Location: main.php");
    return;
  }
  else
  {
    if (!hasAdminRights($_SESSION['activeUser']))
    {
      $_SESSION['error'] = 'No tiene credenciales para realizar esta operación.';
      header("Location: main.php");
      return;
    }

    $classId = $_GET['classId'];

    unset($_SESSION['error']);
  }

  function getClassInfo($classId)
  {
    $class = array("title" => "Pilates Studio"
                  , "day" => date("17/03/2020")
                  , "hour" => date("9:00")
                  , "assistance" => 2
                  , "maximo" => 3);

    return $class;
  }

  function getClassAssistance($classId)
  {
    $assistance = array();

    $assistant = array("firstname" => "Fulanito"
                      , "lastname" => "Menganito"
                      , "e-mail" => "fulanito.menganito@rrr.com"
                      , "userId" => 6);

    array_push($assistance, $assistant);

    $assistant = array("firstname" => "Pijus"
                        , "lastname" => "Magnificus"
                        , "e-mail" => "pijus.magnificus@spqr.com"
                        , "userId" => 1);

    array_push($assistance, $assistant);

    return $assistance;

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
    <?php
      echo('<div class="schedule">');
      if (isset($_SESSION["error"]))
      {
        echo('<p class="headers">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }

      $classInfo = getClassInfo($classId);

      echo('<table width="100%" id="schedule"><tr><th>Nombre</th><th>Dia</th><th>Hora</th><th>Apuntados</th><th>Aforo</th></tr>');
      echo('<tr class="no_assisting_row">');
      echo('<td>'.$classInfo['title'].'</td>');
      echo('<td>'.$classInfo['day'].'</td>');
      echo('<td>'.$classInfo['hour'].'</td>');
      echo('<td>'.$classInfo['assistance'].'</td>');
      echo('<td>'.$classInfo['maximo'].'</td>');
      echo('</tr></table></br></br>');

      $classAssistance = getClassAssistance($classId);

      echo('<table width="100%" id="schedule"><tr><th>Nombre</th><th>Apellidos</th><th>e-mail</th><th></th></th></tr>');
      foreach ($classAssistance as $user)
      {
        echo('<tr class="no_assisting_row">');
        echo('<td>'.$user['firstname'].'</td>');
        echo('<td>'.$user['lastname'].'</td>');
        echo('<td>'.$user['e-mail'].'</td>');
        echo('<td><a class="schedule_button" href="viewUser.php?userId='.$user['userId'].'">Examinar</a>');
        echo(' <a class="schedule_button" href="removefromclass.php?userId='.$user['userId'].'&classId='.$classId.'">Desapuntar</a>');
        echo('</tr>');
      }
      echo('</table>');
    ?>
    <p class="headers"><a href="main.php">Volver a la página principal</a></p>
    </div>
  </body>
</html>