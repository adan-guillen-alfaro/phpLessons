<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';

  session_start();

  if (!isset($_SESSION["activeUserId"]))
  {
    header("Location: login.php");
    return;
  }

  $isAdminUser = false;
  if (isset($_SESSION["activeUserId"]))
    $isAdminUser = hasAdminRights($pdo, $_SESSION["activeUserId"]);

  function getWeekDays()
  {
    $curDay = date('N') - 1;

    $daySecs = 60 * 60 * 24;

    $schedule = array();
    for ($i = 0 ; $i < 7 ; $i++)
      array_push($schedule, date('d/m/Y', time() + $daySecs * ($i - $curDay)));

    return $schedule;
  }

  function getDaySchedule($date, $userId)
  {
    //TODO: Select classes in database

    $schedule = array();

    $class = array("title" => "Pilates Studio"
                      , "hour" => date("9:00")
                      , "apuntadas" => 2
                      , "maximo" => 3
                      , "classId" => 1
                      , "assistance" => false);

    array_push($schedule, $class);

    $class = array("title" => "Pilates Studio"
                      , "hour" => date("10:00")
                      , "apuntadas" => 3
                      , "maximo" => 3
                      , "classId" => 2
                      , "assistance" => false);
    array_push($schedule, $class);

    $class = array("title" => "MAT"
                      , "hour" => date("11:00")
                      , "apuntadas" => 3
                      , "maximo" => 10
                      , "classId" => 3
                      , "assistance" => true);
    array_push($schedule, $class);

    $class = array("title" => "Pilates Studio"
                      , "hour" => date("12:00")
                      , "apuntadas" => 2
                      , "maximo" => 3
                      , "classId" => 4
                      , "assistance" => false);
    array_push($schedule, $class);
    return $schedule;
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
        $week = getWeekDays();
        $firstItem = true;

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
              echo('<a class="schedule_button" href="removefromclass.php?classId='.$class['classId'].'&userId='.$_SESSION["activeUserId"].'">Borrarse</a>');
            else if ($apuntadas < $maximo)
              echo('<a class="schedule_button" href="addtoclass.php?classId='.$class['classId'].'&userId='.$_SESSION["activeUserId"].'">Unirse</a>');

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
