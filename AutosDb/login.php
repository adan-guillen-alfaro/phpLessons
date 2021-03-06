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
    if (strlen($user) == 0 || strlen($pwd) == 0)
      $usererror = 'E-mail and password are required';
    else {
      if (!filter_var($user, FILTER_VALIDATE_EMAIL))
        $usererror = 'Invalid e-mail';
    }

    if ($pwd === '')
      $pwderror = 'Incorrect password';
  }
  else {
    $user='';
    $pwd='';
  }

  if (strlen($user) > 0 && strlen($pwd) > 0 && $pwderror === '*')
  {
    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // hash for a pwd = 'php123'

    $md5 = hash('md5', $salt.$pwd);

    if ($md5 === $stored_hash)
    {
      error_log("Login success ".$_POST['who']);
      header("Location: autos.php?name=".urlencode($_POST['who']));
    }
    else
    {
      $pwderror = "Wrong password";
      error_log("Login fail ".$_POST['who']." $md5");
    }
  }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Adan test db</title>
        <style>
          .error { color:red; }
        </style>
    </head>
    <body>
        <form name="login" method="POST">
          <table>
            <tr>
          <td><label for="who">e-mail: </label></td>
          <td><input type="text" name="who" id="who" value = "<?= htmlentities($user) ?>"/></td>
          <td><span class="error" id="userError" /><?= htmlentities($usererror) ?></span></td>
        </tr><tr>
          <td><label for="pwd">Password: </label>
          <td><input type="password" name="pass" id="pwd"/>
          <td><span class="error" id="pwdError" /><?= htmlentities($pwderror) ?></span></td>
        </tr><tr>
          <td><input type="submit" value="Log In"/></td>
          <td><input type="submit" name="cancel" value="Cancel"/></td>
        </tr>
        </table>
        </form>
    </body>
</html>
