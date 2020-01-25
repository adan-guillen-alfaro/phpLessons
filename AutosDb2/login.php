<?php
  start_session();
  $user='';
  if (isset($_POST['email']))
  {
    $_SESSION['name'] = $_POST['email'];
    $user = $_SESSION['name'];
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
      <h1>Please Log In</h1>
      <?php
        if (isset($_SESSION['error']))
        {
          echo('<p class="error">'.$_SESSION['error'].'</p>');
          unset($_SESSION['error']);
        }
       ?>
        <form name="login" method="POST">
          <table>
            <tr>
          <td><label for="email">e-mail: </label></td>
          <td><input type="text" name="e-mail" id="email" value = "<?= htmlentities($user) ?>"/></td>
        </tr><tr>
          <td><label for="pwd">Password: </label>
          <td><input type="password" name="pass" id="pwd"/>
        </tr><tr>
          <td><input type="submit" value="Log In"/></td>
          <td><input type="submit" name="cancel" value="Cancel"/></td>
        </tr>
        </table>
        </form>
    </body>
</html>
