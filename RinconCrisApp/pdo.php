<?php
  $pdo = null;
  try
  {
    //$pdo = new PDO('mysql:host=localhost;port=8889;dbname=studioApp', 'morgan', 'cris');
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=studioApp', 'morgan', 'cris');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (Exception $e)
  {

  }

?>
