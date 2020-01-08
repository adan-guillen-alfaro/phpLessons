<!DOCTYPE html>
<?php
  function check($machine, $human)
  {
    if ($human !== $machine)
    {
      if ($human === 'rock')
      {
        if ($machine === 'paper')
          return "You lose";
        else
          return "You win";
      }
      else if ($human === 'paper')
      {
        if ($machine === 'scissors')
          return "You lose";
        else
          return "You win";
      }
      else if ($human === 'scissors')
      {
        if ($machine === 'rock')
          return "You lose";
        else
          return "You win";
      }
    }
    else
      return "Tie";
  }

  if (isset($_POST['logout']))
  {
    header("Location: index.php");
    return;
  }

  $user = isset($_GET['name']) ? $_GET['name'] : '';

  if (strlen($user) < 1)
    die("Name parameter missing");

  $names = array('rock', 'paper', 'scissors');
  $resultMessage = 'Please select a strategy and press Play';
  if (isset($_POST['choose']))
  {
    $human = $_POST['choose'];
    if (strlen($human) > 0)
    {
      if ($human !== 'test')
      {
        $machine = $names[array_rand($names)];
        $resultMessage = '<table><tr><td>Human='.$human.'</td><td>Computer='.$machine.'</td><td>Result='.check($machine, $human).'</td></tr></table>';
      }
      else {
        $resultMessage = '<table>';
        for($c=0;$c<3;$c++)
        {
          $csel = $names[$c];
          for($h=0;$h<3;$h++)
          {
            $hsel = $names[$h];
            $result = '<tr><td>Human='.$hsel.'</td><td>Computer='.$csel.'</td><td>Result='.check($csel, $hsel).'</td>';
            $resultMessage = $resultMessage.$result;
          }
        }
        $resultMessage = $resultMessage.'</table>';
      }
    }
  }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Rock Paper Scissors</title>
    </head>
    <style>
      p.info = { padding: 10; background: grey; }
      td { padding-right: 10px; }
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
            <option value="test" selected>Test</option>
          </select>
          <input type="submit" value="Play"/>
          <input type="submit" name="logout" value= "Log Out"/>
        </p>
        <p class="info"><?= $resultMessage ?></p>
      </form>
    </body>
</html>
