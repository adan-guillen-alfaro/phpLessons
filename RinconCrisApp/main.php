<?php
  require_once 'isMobile.php';

  session_start();

  if (!isset($_SESSION["activeUser"]))
  {
    header("Location: login.php");
    return;
  }
  else
  {
    echo('<p>Welcome '.htmlentities($_SESSION["activeUser"]).'.</p>');
  }

  function getSchedule($date)
  {
    //TODO: Select classes in database

    $schedule = array();

    $class = array("title" => "Pilates Studio"
                      , "hour" => date("9:00")
                      , "apuntadas" => 2
                      , "maximo" => 3
                      , "assistance" => false);
    array_push($schedule, $class);

    $class = array("title" => "Pilates Studio"
                      , "hour" => date("10:00")
                      , "apuntadas" => 3
                      , "maximo" => 3
                      , "assistance" => false);
    array_push($schedule, $class);

    $class = array("title" => "MAT"
                      , "hour" => date("11:00")
                      , "apuntadas" => 3
                      , "maximo" => 10
                      , "assistance" => true);
    array_push($schedule, $class);

    $class = array("title" => "Pilates Studio"
                      , "hour" => date("12:00")
                      , "apuntadas" => 2
                      , "maximo" => 3
                      , "assistance" => false);
    array_push($schedule, $class);
    return $schedule;
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
     <?php
        $schedule = getSchedule(date("d/m/Y"));

        echo('<div class="schedule"><table width="100%" id="schedule">');
        echo('<tr><th>Clase</th><th>Hora</th><th>Aforo</th><th></th>');
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
          if ($assistance)
            echo('<td><a class="schedule_button" href="addtoclass.php">Borrarse</a></td>');
          else if ($apuntadas < $maximo)
            echo('<td><a class="schedule_button" href="addtoclass.php">Unirse</a></td>');
          echo('</tr>');
        }
        echo('</table></div>');
      ?>
     <p class="headers"><a href="logout.php">Log Out</a></p>
   </body>
</html>
