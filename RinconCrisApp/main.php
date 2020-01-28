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
   </head>
   <body style="font-family: sans-serif;">
     <p><a href="logout.php">Log Out</a></p>
   </body>
</html>
