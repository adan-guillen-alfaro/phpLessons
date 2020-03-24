<?php

function hasAdminRights($pdo, $userId)
{
  if ($pdo === null)
    return false;

  $sql = "SELECT admin FROM users WHERE eMail = :em";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':em' => $userId));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  //TODO
  print_r($row);

  return true;
}

function checkUser($pdo, $user, $pwd)
{
  $salt = 'XzyYx14*_';
  $pwdhash =  hash('md5', $salt.$pwd);

  //TODO: Comprobar si el usuario existe y el pass es correcto

  $_SESSION["activeUser"] = $user;
  return true;
}

function registerUser($pdo, $name, $lastname, $mail, $pwd, $direction, $cp, $city, $country, $tlf)
{
  if ($pdo === null)
    return false;

  $salt = 'XzyYx14*_';
  $pwdhash =  hash('md5', $salt.$pwd);

  print_r($pwdhash);

  $sql = "INSERT INTO users (name, lastName, eMail, pwdhash) VALUES (:name, :lastName, :eMail, :pwd)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':name' => $userId,
                        ':lastName' => $lastname,
                        ':eMail' => $mail,
                        ':pwd' => $pwdhash
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  print_r($row);
}

?>
