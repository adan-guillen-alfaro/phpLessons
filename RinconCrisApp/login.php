<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';

  session_start();

$_SESSION["error"] = "1";

  if (isset($_POST['register']))
  {
    header("Location: registerform.php");
    return;
  }

  $_SESSION["error"] = "2";

  if (isset($_POST["user"]) && isset($_POST["pwd"]))
  {
    unset($_SESSION["activeUser"]);

    $_SESSION["lastuser"] = $_POST["user"];

    $_SESSION["error"] = "3";

    if (!filter_var($_SESSION["lastuser"], FILTER_VALIDATE_EMAIL))
    {
      $_SESSION["error"] = "4";

      $_SESSION["error"] = "El usuario debe ser una dirección de correo válida.";
      header("Location: login.php");
      return;
    }
    else
    {
      $_SESSION["error"] = "5";

      if (checkUser($pdo, $_POST["user"], $_POST["pwd"]))
      {
        $_SESSION["error"] = "6";

        if (isset($_SESSION["activeUser"]))
        {
          $_SESSION["error"] = "7";

          header("Location: main.php");
          return;
        }
        else
        {
          $_SESSION["error"] = "8";

          header("Location: login.php");
          return;
        }
      }
      else
      {
        $_SESSION["error"] = "9";

        header("Location: login.php");
        return;
      }
    }
  }
  else {
    if (isset($_POST["user"]))
      $_SESSION["error"] = "10";
    else if (isset($_POST["pwd"]))
      $_SESSION["error"] = "11";
  }
 ?>
 <html>
   <head>
       <meta charset="utf-8" />
       <title>El rincón de Cris</title>
       <?php
        if (isMobile())
          echo('<link rel="stylesheet" href="styles_mobile.css">');
        else
          echo('<link rel="stylesheet" href="styles_pc.css">');
       ?>
   </head>
   <body>
     <div class="login_table">
    <p class="headers">Bienvenida/o a El rincón de Cris.<br>Por favor introduce tus datos para continuar.</p>
    <!-- <p class="headers">Por favor introduce tus datos para continuar.</p> -->
    <?php
      if (isset($_SESSION["error"]))
      {
        echo('<p class="error">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }
    ?>
        <form method="POST">
          <div class="form_item">
            <label for="user">e-mail</label><span class="mandatory"> *</span>
            <input type="text" name="user" id="user" value="<?= isset($_SESSION["lastuser"]) ? htmlentities($_SESSION["lastuser"]) : ''; ?>" />
          </div>
          <div class="form_item">
            <label for="pwd">Password</label><span class="mandatory"> *</span>
            <input type="password" name="pwd" id="pwd" />
          </div>
          <div class="form_item">
            <input type="submit" value="LogIn"/>
            <input type="submit" value="Register" name="register" />
          </div>
        </form>
   </body>
</html>
