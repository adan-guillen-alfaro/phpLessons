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

function registerUser($pdo, $name, $lastname, $mail, $pwd_plain, $direction, $cp, $city, $country, $tlf)
{
  if ($pdo === null)
    return false;

  $salt = 'XzyYx14*_';
  $pwd =  hash('md5', $salt.$pwd_plain);

  print_r($pwd);

  $sql = "INSERT INTO users (name, lastName, eMail, pwd) VALUES (:name, :lastName, :eMail, :pwd)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':name' => $name,
                        ':lastName' => $lastname,
                        ':eMail' => $mail,
                        ':pwd' => $pwd
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  print_r($row);
}

?>
