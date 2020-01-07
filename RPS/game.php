<!DOCTYPE html>
<?php
  $user = isset($_GET['name']) : $_GET['name'] : '';

  if ($user === '')
    die("Name parameter missing");
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Rock Paper Scissors</title>
    </head>
    <style>
      p.info = { padding: 10; background: grey; }
    </style>
    <body>
      <h1>Rock Paper Scissors</h1>
      <p>Welcome: <?= $user ?></p>
      <form name="game" method="post">
        <p>
          <select name="choose">
            <option value="rock">Rock</option>
            <option value="paper">Paper</option>
            <option value="scissors">Scissors</option>
          </select>
          <input type="submit" value="Play"/>
          <input type="submit" name="logout" value= "Log Out"/>
        </p>
        <p class="info">Please select a strategy and press Play</p>
      </form>
    </body>
</html>
