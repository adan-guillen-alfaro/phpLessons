<?php
$pdo = null;

try
{
  $pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc', 'adan', 'morgan');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e)
{

}
?>
