<?php
  require_once 'isMobile.php';
  session_start();

  if (isset($_POST['cancel']))
  {
    session_destroy();
    header("Location: main.php");
    return;
  }
  else if (isset($_SESSION["activeUserId"]))
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
        $salt = 'HwerqrT*_';
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
    <div class="register_form">
      <p class="headers">Por favor introduce tus datos para registrarte</p>
      <?php
        if (isset($_SESSION["error"]))
        {
          echo('<p class="error">'.$_SESSION["error"].'</p>');
          unset($_SESSION["error"]);
        }
      ?>

      <form method="post">
        <div class="form_item">
          <label for="new_email">e-mail</label><span class="mandatory"> *</span>
          <input align="left" type="text" name="new_email" id="email" value="<?= isset($_SESSION["new_email"]) ? htmlentities($_SESSION["new_email"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_name">Nombre</label><span class="mandatory"> *</span>
          <input type="text" name="new_name" id="name" value="<?= isset($_SESSION["new_name"]) ? htmlentities($_SESSION["new_name"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_lastname">Apellidos</label><span class="mandatory"> *</span>
          <input type="text" name="new_lastname" id="lastname" value="<?= isset($_SESSION["new_lastname"]) ? htmlentities($_SESSION["new_lastname"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_direction">Dirección</label>
          <input type="text" name="new_direction" id="direction" value="<?= isset($_SESSION["new_direction"]) ? htmlentities($_SESSION["new_direction"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_cp">C.P.</label>
          <input type="text" name="new_cp" id="cp" value="<?= isset($_SESSION["new_cp"]) ? htmlentities($_SESSION["new_cp"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_city">Ciudad</label>
          <input type="text" name="new_city" id="city" value="<?= isset($_SESSION["new_city"]) ? htmlentities($_SESSION["new_city"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_country">País</label>
          <input type="text" name="new_country" id="country" value="<?= isset($_SESSION["new_country"]) ? htmlentities($_SESSION["new_country"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_tlf">Teléfono</label>
          <input type="text" name="new_tlf" id="tlf" value="<?= isset($_SESSION["new_tlf"]) ? htmlentities($_SESSION["new_tlf"]) : ''; ?>" />
        </div>
        <div class="form_item">
          <label for="new_tlf">Password</label><span class="mandatory"> *</span>
          <input type="password" name="new_pwd" id="pwd" />
        </div>
        <div class="form_item">
          <label for="new_tlf">Repetir Password</label><span class="mandatory"> *</span>
          <input type="password" name="new_pwd2" id="pwd2" />
        </div>
        <input type="submit" value="Registarse" name="register" /><input type="submit" value="Cancelar" name="cancel" />
      </form>
    </div>

  </body>
</html>
