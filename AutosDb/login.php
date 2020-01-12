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
        $usererror = 'Invalid e-mail'
    }

    if ($pwd === '')
      $pwderror = 'Incorrect password';
  }

  if (strlen($user) > 0 && strlen($pwd) > 0 && $pwderror === '*')
  {
    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // hash for a pwd = 'php123'

    $md5 = hash('md5', $salt.$pwd);

    //echo "<BR>stored_hash: ".$stored_hash." md5: ".$md5;
    if ($md5 === $stored_hash)
    {
      header("Location: autos.php");
    }
    else
      $pwderror = "Wrong password";
  }

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adan test db</title>
        <style>
          .error { color:red; }

    </head>
    <body>
        <form name="login" method="POST">
          <p>
          <label for="who">e-mail: </label>
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
