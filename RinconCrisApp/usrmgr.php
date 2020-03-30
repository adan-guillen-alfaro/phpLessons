<?php

function hasAdminRights($pdo, $email)
{
  if ($pdo === null)
    return false;

  $sql = "SELECT admin FROM users WHERE eMail = :em";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':em' => $email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row === false)
    return false;

  try {
      return ($row["admin"] === 1);
  } catch (PDOException $e) {
    return false;
  }

  return false;
}

function checkUser($pdo, $email, $pwd_plain)
{
  $salt = 'HwerqrT*_';
  $pwdhash =  hash('md5', $salt.$pwd_plain);

  //TODO: Comprobar si el usuario existe y el pass es correcto
  $sql = "SELECT pwd FROM users WHERE eMail = :em";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':em' => $email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row === false)
    return false;

  try {
      if ($row["pwd"] === $pwdhash){
        $_SESSION["activeUser"] = $email;
        return true;
      }
  } catch (PDOException $e) {
    return false;
  }

  return false;
}

function existsUser($pdo, $email)
{
  if ($pdo === null)
    return false;

    try {
      $sql = "SELECT eMail FROM users WHERE eMail=:eMail";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':eMail' => $email)) ;

      $row = $stmt->fetch();

      if ($row === false)
        return false;

      return (count($row) > 0);

    } catch (PDOException $e) {
      return false;
    }

    return false;
}

function registerUser($pdo, $name, $lastname, $mail, $pwd_hash, $direction, $cp, $city, $country, $tlf)
{
  if ($pdo === null)
    return false;

  $defaultTariff = 1;


  try {
    $sql = "INSERT INTO users (name, lastName, eMail, pwd, direction, cp, city, country, tlf, tariff_id) VALUES (:name, :lastName, :eMail, :pwd, :direction, :cp, :city, :country, :tlf, :tariff_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':name' => $name,
                          ':lastName' => $lastname,
                          ':eMail' => $mail,
                          ':pwd' => $pwd_hash,
                          ':direction' => $direction,
                          ':cp' => $cp,
                          ':city' => $city,
                          ':country' => $country,
                          ':tlf' => $tlf,
                          ':tariff_id' => $defaultTariff ));
    }
    catch(PDOException $e) {
      return "FALSE";
    }
    return "OK";
}

?>
