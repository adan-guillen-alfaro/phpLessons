<?php

function addToclass($pdo, $classId, $userId)
{
  $sql = "INSERT INTO userClassHistory (user_id, class_id) VALUES (:user, :class)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':user' => $userId,
                        ':class' => $classId ));
}

function removefromclass($pdo, $classId, $userId)
{
  $sql = "DELETE FROM userClassHistory WHERE class_id = $classId AND user_id = $userId";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
}

function getAssistance($pdo, $classId)
{
  $assistance = array();

  $sql = "SELECT user_id FROM userClassHistory WHERE class_id = $classId";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    array_push($assistance, $row['user_id']);
  }

  return $assistance;
}

function UserAssists($pdo, $userId, $classId)
{
  $assistant = getAssistance($pdo, $classId);

  if (in_array($userId, $assistance)) {
    return true;
  }
  else {
    return false;
  }
}

 ?>
