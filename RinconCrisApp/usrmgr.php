<?php

function hasAdminRights($userId)
{
  //TODO
  return true;
}

function checkUser($user, $pwd)
{
  $salt = 'XyZzy12*_';
  $pwdhash =  hash('md5', $salt.$pwd);

  //TODO: Comprobar si el usuario existe y el pass es correcto

  $_SESSION["activeUser"] = $user;
  return true;
}

function registerUser($name, $lastname, $mail, $pwd, $direction, $cp, $city, $country, $tlf)
{
  //TODO: Registrar
  return true;
}

?>
