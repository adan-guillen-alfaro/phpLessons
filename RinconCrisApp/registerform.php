<?php
  require_once 'isMobile.php';
  session_start();

  if (isset($_POST['cancel']))
  {
    session_destroy();
    header("Location: main.php");
    return;
  }
  else if (isset($_SESSION["activeUser"]))
  {
    session_destroy();
    session_start();
  }

  if (isset($_POST['register']))
  {
    if (isset($_POST["new_name"])) {
      $_SESSION["new_name"] = $_POST["new_name"];
    }
    if (isset($_POST["new_lastname"])) {
      $_SESSION["new_lastname"] = $_POST["new_lastname"];
    }
    if (isset($_POST["new_direction"])) {
      $_SESSION["new_direction"] = $_POST["new_direction"];
    }
    if (isset($_POST["new_cp"])) {
      $_SESSION["new_cp"] = $_POST["new_cp"];
    }
    if (isset($_POST["new_city"])) {
      $_SESSION["new_city"] = $_POST["new_city"];
    }
    if (isset($_POST["new_country"])) {
      $_SESSION["new_country"] = $_POST["new_country"];
    }
    if (isset($_POST["new_tlf"])) {
      $_SESSION["new_tlf"] = $_POST["new_tlf"];
    }
    if (isset($_POST["new_email"])) {
      $_SESSION["new_email"] = $_POST["new_email"];
    }

    if (strlen($_POST["new_name"]) > 0 && strlen($_POST["new_lastname"]) > 0 && strlen($_POST["new_email"]) > 0 && strlen($_POST["new_pwd"]) > 0 && strlen($_POST["new_pwd2"]) > 0)
    {
      if (!filter_var($_POST["new_email"], FILTER_VALIDATE_EMAIL))
      {
        $_SESSION["error"] = "Error: Dirección de correo errónea.";
        header("Location: registerform.php");
        return;
      }
      else if ($_POST["new_pwd2"] !== $_POST["new_pwd"])
      {
        $_SESSION["error"] = "Error: El password de verificación no coincide.";
        header("Location: registerform.php");
        return;
      }
      else
      {
        $salt = 'XyZzy12*_';
        $_SESSION["new_pwd"] = hash('md5', $salt.$_POST["new_pwd"]);

        unset($_SESSION["error"]);
        header("Location: register.php");
        return;
      }
    }
    else
    {
      $_SESSION["error"] = "Error: Debe rellenar todos los campos marcados con un asterisco.";
      header("Location: registerform.php");
      return;
    }
  }
?>
<html>
  <head>
      <meta charset="utf-8" />
      <title>El rincón de Cris - Registro</title>
      <?php
       if (isMobile())
         echo('<link rel="stylesheet" href="styles_mobile.css">');
       else
         echo('<link rel="stylesheet" href="styles_pc.css">');
      ?>
  </head>
  <body>
    <p class="headers">Por favor introduce tus datos para registrarte</p>
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
             <td><p>Nombre:</p></td>
             <td><input type="text" name="new_name" id="name" value="<?= isset($_SESSION["new_name"]) ? htmlentities($_SESSION["new_name"]) : ''; ?>" /></td>
             <td><p class="mandatory">*</p></td>
           </tr>
           <tr>
             <td><p>Apellidos:</p></td>
             <td><input type="text" name="new_lastname" id="lastname" value="<?= isset($_SESSION["new_lastname"]) ? htmlentities($_SESSION["new_lastname"]) : ''; ?>" /></td>
             <td><p class="mandatory">*</p></td>
           </tr>
           <tr>
             <td><p>Dirección:</p></td>
             <td><input type="text" name="new_direction" id="direction" value="<?= isset($_SESSION["new_direction"]) ? htmlentities($_SESSION["new_direction"]) : ''; ?>" /></td>
           </tr>
           <tr>
             <td><p>CP:</p></td>
             <td><input type="text" name="new_cp" id="cp" value="<?= isset($_SESSION["new_cp"]) ? htmlentities($_SESSION["new_cp"]) : ''; ?>" /></td>
           </tr>
           <tr>
             <td><p>Ciudad:</p></td>
             <td><input type="text" name="new_city" id="city" value="<?= isset($_SESSION["new_city"]) ? htmlentities($_SESSION["new_city"]) : ''; ?>" /></td>
           </tr>
           <tr>
             <td><p>País:</p></td>
             <td><input type="text" name="new_country" id="country" value="<?= isset($_SESSION["new_country"]) ? htmlentities($_SESSION["new_country"]) : ''; ?>" /></td>
           </tr>
           <tr>
             <td><p>Teléfono:</p></td>
             <td><input type="text" name="new_tlf" id="tlf" value="<?= isset($_SESSION["new_tlf"]) ? htmlentities($_SESSION["new_tlf"]) : ''; ?>" /></td>
           </tr>
           <tr>
             <td><p>e-mail:</p></td>
             <td><input type="text" name="new_email" id="email" value="<?= isset($_SESSION["new_email"]) ? htmlentities($_SESSION["new_email"]) : ''; ?>" /></td>
             <td><p class="mandatory">*</p></td>
           </tr>
           <tr>
             <td><p>Password:</p></td>
             <td><input type="password" name="new_pwd" id="pwd" /></td>
             <td><p class="mandatory">*</p></td>
           </tr>
           <tr>
             <td><p>Verifique el password:</p></td>
             <td><input type="password" name="new_pwd2" id="pwd2" /></td>
             <td><p class="mandatory">*</p></td>
           </tr>
           <tr>
             <td></td>
             <td align="right"><input type="submit" value="Registarse" name="register" /><input type="submit" value="Cancelar" name="cancel" /></td>
           </tr>
         </table>
        </form>
    </div>

  </body>
</html>
