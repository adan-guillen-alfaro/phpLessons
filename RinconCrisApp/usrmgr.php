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

function existsUser($pdo, $email)
{
  if ($pdo === null)
    return false;

    $sql = "SELECT eMail WHERE eMail=:eMail";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':eMail' => $email)) ;
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return (count($s->fetchAll()) > 0);
}

function registerUser($pdo, $name, $lastname, $mail, $pwd_plain, $direction, $cp, $city, $country, $tlf)
{
  if ($pdo === null)
    return false;

  $defaultTariff = 1;
  $salt = 'XzyYx14*_';
  $pwd =  hash('md5', $salt.$pwd_plain);

  print_r($pwd);

  $sql = "INSERT INTO users (name, lastName, eMail, pwd, direction, cp, city, country, tlf, admin, tariff_id) VALUES (:name, :lastName, :eMail, :pwd, :direction, :cp, :city, :country, :tlf, :tariff_id)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':name' => $name,
                        ':lastName' => $lastname,
                        ':eMail' => $mail,
                        ':pwd' => $pwd,
                        ':direction' => $direction,
                        ':cp' => $cp,
                        ':city' => $city,
                        ':country' => $country,
                        ':tlf' => $tlf,
                        ':tariff_id' => $defaultTariff ));
}

?>
