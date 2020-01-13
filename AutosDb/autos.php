<?php
  require_once 'pdo.php';

  $errormessage = '';

  if (!isset($_GET['name']))
  {
    die("Name parameter missing.");
    return;
  }

  if (isset($_POST['LogOut']))
  {
    header("location:index.php");
  }
  else if (isset($_POST['make']) && isset($_POST['mileage']) && isset($_POST['year']))
  {
    if (strlen($_POST['make']) > 0 && strlen($_POST['mileage']) > 0 && strlen($_POST['year']) > 0)
    {
      if (!is_numeric($_POST['mileage']))
        $errormessage = 'Incorrect mileage value';
      else
      {
        if (!is_numeric($_POST['year']))
          $errormessage = 'Incorrect year value';
        else
        {
          if (!is_null($pdo))
          {
            try
            {
              $pdo->prepare("INSERT INTO autosdb (make, year, mileage) VALUES (:make, :year, :mileage)");
              $pdo->execute(array(
                ':make' => $_POST['make'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'],
              ));
            }
            catch (Exception $e)
            {
            }
          }
        }
      }
    }
    else
      $errormessage = 'All parameters must be set.';
  }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Adan test db</title>
        <style>
          .error { color: red; }
        </style>
    </head>
    <body>
      <h1>AutosDB test</h1>
      <br/>
      <form method="post">
        <table>
          <tr>
        <td><label for="make">Make</label></td>
        <td><input type="text" name="make" value="<?php isset($_POST['make']) ? htmlentities($_POST['make']) : "";?>"/></td>
      </tr><tr>
        <td><label for="mileage">Mileage</label></td>
        <td><input type="text" name="mileage" value="<?php isset($_POST['mileage']) ? htmlentities($_POST['mileage']) : "";?>"/></td>
      </tr><tr>
        <td><label for="year">Year</label></td>
        <td><input type="text" name="year" value="<?php isset($_POST['year']) ? htmlentities($_POST['year']) : "";?>"/></td>
      </tr><tr>
        <td><input type="submit" value="Add" /></td>
        <td><input type="submit" name="LogOut" value="Log Out" /></td>
      </tr></table>
      </form>
      <p class="error"><?= htmlentities($errormessage) ?></p>
      <br/>
      <?php
        if (!is_null($pdo))
        {
          try
          {
            echo '<table><tr><th>Make</th><th>Mileage</th><th>Year</th></tr>';
              $res = $pdo->query("SELECT * FROM autosdb");
              while ($row = $res->fetch(PDO::FETCH_ASSOC))
              {
                  echo '<tr>';
                  echo '<td>'.$row['make'].'</td><td>'.$row['mileage'].'</td><td>'.$row['year'].'</td>';
                  echo '</tr>';
              }
            echo '</table>';
          } catch (Exception $exc)
          {

          }
        }
      ?>
    </body>
</html>
