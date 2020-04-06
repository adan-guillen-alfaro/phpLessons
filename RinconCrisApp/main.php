<?php
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
        $week = getWeekDays();
        $firstItem = true;

        if (isset($_SESSION["error"]))
        {
          echo('<p class="error">'.$_SESSION["error"].'</p>');
          unset($_SESSION["error"]);
        }

        foreach ($week as $day)
        {
          $schedule = getDaySchedule($pdo, $day, $_SESSION["activeUserId"]);

          echo('<div class="schedule">');
          if ($firstItem)
          {
            echo('<p id="welcome" class="headers">Bienvenida/o '.htmlentities($_SESSION["activeUserName"]).'.</p>');
            $firstItem = false;
          }

          echo('<table width="100%" id="schedule"><tr><th>'.$day.'</th><th>Hora</th><th>Aforo</th><th></th>');
          foreach ($schedule as $class)
          {
            $apuntadas = $class['apuntadas'];
            $maximo = $class['maximo'];
            $assistance = $class['assistance'];

            if ($assistance) echo('<tr class="assisting_row">');
            else echo('<tr class="no_assisting_row">');
            echo('<td>'.$class['title'].'</td>');
            echo('<td>'.$class['hour'].'</td>');
            echo('<td>'.$apuntadas.'/'.$maximo.'</td>');
            echo('<td>');
            if ($assistance)
              echo('<a class="schedule_button" href="removefromclass.php?classId='.$class['classId'].'">Borrarse</a>');
            else if ($apuntadas < $maximo)
              echo('<a class="schedule_button" href="addtoclass.php?classId='.$class['classId'].'">Unirse</a>');

            if ($isAdminUser)
            {
              echo(' <a class="schedule_button" href="editclass.php?classId='.$class['classId'].'">Editar</a>');
            }
            echo('</td></tr>');
          }
          echo('</table></div>');
        }
      ?>
     <p class="headers"><a href="logout.php">Log Out</a></p>
   </body>
</html>
