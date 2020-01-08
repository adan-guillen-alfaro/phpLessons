<!DOCTYPE html>
<?php
  if (isset($_POST['cancel']))
  {
    header("Location: index.php");
    return;
  }

  $user = isset($_POST['who']) ? $_POST['who'] : '';
  $pwd = isset($_POST['pass']) ? $_POST['pass'] : '';

  $usererror = '*';
  $pwderror = '*';
  if (isset($_POST['who']))
  {
    if ($user === '')
      $usererror = 'Invalid username';

    if ($pwd === '')
      $pwderror = 'Invalid password';

      echo 'USER: '.$user.' PWD: '.$pwd;
  }

  if (strlen($user) > 0 && strlen($pwd) > 0)
  {
    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // hash for a pwd = 'php123'

    $md5 = hash('md5', $salt.$pwd);

    echo "stored_hash: ".$stored_hash." md5: ".$md5;
    if ($md5 === $stored_hash)
    {
      header("Location: game.php?name=".urlencode($user));
    }
    else
      $pwderror = "Wrong password";
  }

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Rock Paper Scissors LogIn Page</title>
        <style>
          .error { color:red; }
        </style>

<!--        <script>
          function ValidateUser()
          {
            var user = document.getElementById("who").value;
            var pwd = document.getElementById("pwd").value;

            document.getElementById("userError").innerHTML = '*';
            document.getElementById("pwdError").innerHTML = '*';

            var res = true;
            if (user == "")
            {
              document.getElementById("userError").innerHTML = 'Invalid username';
              res = false;
            }

            if (pwd == "")
            {
              document.getElementById("pwdError").innerHTML = 'Invalid password';
              res = false;
            }

            return res;
          }
        </script>
--->
    </head>
    <body>
        <form name="login" method="POST"> <!---onsubmit="return ValidateUser()"--->
          <p>
          <label for="who">Username: </label>
          <input type="text" name="who" id="who" value = "<?= htmlentities($user) ?>"/>
          <span class="error" id="userError" /><?= htmlentities($usererror) ?></span>
          </p>
          <p>
          <label for="pwd">Password: </label>
          <input type="password" name="pass" id="pwd"/>
          <span class="error" id="pwdError" /><?= htmlentities($pwderror) ?></span>
          </p>
          <p>
          <input type="submit" value="Log In"/>
          <input type="submit" name="cancel" value="Cancel"/>
          </p>
        </form>
    </body>
</html>
