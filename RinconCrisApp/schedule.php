<?php
function getWeekDays()
{
  $curDay = date('N') - 1;

  $daySecs = 60 * 60 * 24;

  $schedule = array();
  for ($i = 0 ; $i < 7 ; $i++)
    array_push($schedule, date('Y-m-d', time() + $daySecs * ($i - $curDay)));

  return $schedule;
}

function getDaySchedule($pdo, $date, $userId)
{
  $schedule = array();

  $sql = "SELECT * FROM classes WHERE day = :date";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':date' => $date));

  while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

      $classId = $row["class_id"];
      $assistance = getAssistance($pdo, $classId);
      $count = count($assistance);

      $userAssist = false;
      if (in_array($userId, $assistance))
        $userAssist = true;

      $class = array("title" => $row["tittle"]
                        , "hour" => $row["hour"]
                        , "apuntadas" => $count
                        , "maximo" => $row["capacity"]
                        , "classId" => $classId
                        , "assistance" => $userAssist);

      array_push($schedule, $class);
  }
/*
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
  */
  return $schedule;
}
?>
