<?php
  if (isset($_POST['cancel']))
  {
    header("Location: index.php");
    return;
  }

  session_start();

  if (isset($_POST["name"]) && isset($_POST["pwd"]))
  {
    //$user = $_POST["email"];
    //$pwd = $_POST["pwd"];

    if (strlen($_POST["name"]) > 0 && strlen($_POST["pwd"]) > 0)
    {
        $salt = 'XyZzy12*_';
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // hash for a pwd = 'php123'

        $md5 = hash('md5', $salt.$_POST["pwd"]);

        //echo "<BR>stored_hash: ".$stored_hash." md5: ".$md5;
        if ($md5 === $stored_hash)
        {
          $_SESSION["name"] = $_POST["name"];
          header('Location: view.php');
        }
        else
        {
          $_SESSION["error"] = "Wrong password. Please Log In.";
          header('Location: login.php');
        }
    }
    else
    {
      $_SESSION["error"] = "Please Log In.";
      header('Location: login.php');
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
    <body style="font-family: sans-serif;">
      <p>Please Log In</p>
      <?php
        if (isset($_SESSION["error"]))
        {
          echo('<p class="error">'.$_SESSION["error"]."</p>");
          unset($_SESSION["error"]);
        }
       ?>
        <form name="login" method="POST">
          <table>
          <tr>
            <td><label for="name">e-mail: </label></td>
            <td><input type="text" name="name" id="name"/></td>
          </tr>
          <tr>
            <td><label for="pwd">Password: </label></td>
            <td><input type="password" name="pwd" id="pwd"/></td>
          </tr>
          <tr>
            <td><input type="submit" value="Log In"/></td>
            <td><input type="submit" name="cancel" value="Cancel"/></td>
          </tr>
        </table>
        </form>
    </body>
</html>
