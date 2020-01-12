<?php
  if (!isset($_GET['name']))
    die("Name parameter missing.");
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adan test db</title>
    </head>
    <body>
      <h1>AutosDB test</h1>
      <br/>
      <form method="post">
        <table>
          <tr>
        <td><label for="make">Make</label></td>
        <td><input type="text" name="make" /></td>
      </tr><tr>
        <td><label for="mileage">Mileage</label></td>
        <td><input type="text" name="mileage" /></td>
      </tr><tr>
        <td><label for="year">Year</label></td>
        <td><input type="text" name="year" /></td>
      </tr><tr>
        <td><input type="submit" value="Add" /></td>
      </tr></table>
      </form>
    </body>
</html>
