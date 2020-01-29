<?php
  session_start();

  if (!isset($_SESSION["activeUser"]))
  {
    header("Location: login.php");
    return;
  }
  else
  {
    echo('<p>Welcome '.htmlentities($_SESSION["activeUser"]).'.</p>');
  }
 ?>
 <html>
   <head>
       <meta charset="utf-8" />
       <title>El rincón de Cris</title>
       <link rel="stylesheet" href="styles_erc.css">
   </head>
   <body>
     <p class="headers"><a href="logout.php">Log Out</a></p>
   </body>
</html>
