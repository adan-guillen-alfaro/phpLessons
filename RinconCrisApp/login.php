<?php
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

  function checkUser($user, $pwd)
  {
    $salt = 'XyZzy12*_';
    $pwdhash =  hash('md5', $salt.$pwd);

    //TODO: Comprobar si el usuario existe y el pass es correcto

    $_SESSION["activeUser"] = $user;
    return true;
  }

 ?>
 <html>
   <head>
       <meta charset="utf-8" />
       <title>El rincón de Cris</title>
       <link rel="stylesheet" href="styles_erc.css">
   </head>
   <body>
    <p class="headers">Bienvenida/o a El rincón de Cris.<br>Por favor introduce tus datos para continuar.</p>
    <!-- <p class="headers">Por favor introduce tus datos para continuar.</p> -->
    <?php
      if (isset($_SESSION["error"]))
      {
        echo('<p class="error">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }
    ?>
    <div class="login_table">
        <form method="POST">
         <table id="login_table">
           <tr>
             <td><p>Usuario:</p></td>
             <td><input type="text" name="user" id="user" value="<?= isset($_SESSION["lastuser"]) ? htmlentities($_SESSION["lastuser"]) : ''; ?>" /></td>
           </tr>
           <tr>
             <td><p>Password:</p></td>
             <td><input type="password" name="pwd" id="pwd" /></td>
           </tr>
           <tr>
             <td></td>
             <td align="right"><input type="submit" value="LogIn" /><input type="submit" value="Register" name="register" /></td>
           </tr>
         </table>
        </form>
    </div>
   </body>
</html>
