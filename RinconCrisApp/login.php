<?php
  session_start();

  if (isset($_POST['register']))
  {
    header("Location: register.php");
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
    //TODO
    $_SESSION["activeUser"] = $user;
  }

 ?>
 <html>
   <head>
       <meta charset="utf-8" />
       <title>El rincón de Cris</title>
       <link rel="stylesheet" href="styles_erc.css">
   </head>
   <body style="font-family: sans-serif;">
    <p class="headers">Bienvenida/o a El rincón de Cris.</p>
    <p class="headers">Por favor introduce tus datos para continuar.</p>
    <?php
      if (isset($_SESSION["error"]))
      {
        echo('<p class="error">'.$_SESSION["error"].'</p>');
        unset($_SESSION["error"]);
      }
    ?>
    <div class="table">
        <form method="POST">
         <table>
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
