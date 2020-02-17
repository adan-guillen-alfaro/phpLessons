<?php
  require_once 'isMobile.php';
  require_once 'pdo.php';
  require_once 'usrmgr.php';

  session_start();

  if (isset($_POST['register']))
  {
    header("Location: registerform.php");
    return;
  }

  if (isset($_POST["user"]) && isset($_POST["pwd"]))
  {
    unset($_SESSION["activeUser"]);

    $_SESSION["lastuser"] = $_POST["user"];

    if (!filter_var($_SESSION["lastuser"], FILTER_VALIDATE_EMAIL))
    {
      $_SESSION["error"] = "El usuario debe ser una dirección de correo válida.";
      header("Location: login.php");
      return;
    }
    else
    {
      checkUser($_POST["user"], $_POST["pwd"]);

      if (isset($_SESSION["activeUser"]))
      {
        header("Location: main.php");
        return;
      }
      else
      {
        header("Location: login.php");
        return;
      }
    }
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
    <!--<div class="login_table">-->
        <form method="POST">
          <div class="form_item">
            <label for="user">e-mail</label><span class="mandatory"> *</span>
            <input type="text" name="user" id="user" value="<?= isset($_SESSION["lastuser"]) ? htmlentities($_SESSION["lastuser"]) : ''; ?>" />
          </div>
          <div class="form_item">
            <label for="pwd">Password</label><span class="mandatory"> *</span>
            <input type="password" name="pwd" id="pwd" />
          </div>
             <input type="submit" value="LogIn" />
             <input type="submit" value="Register" name="register" />
           </tr>
        </form>
    </div>
   </body>
</html>
