<?php
  session_start();
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
       <?php
         if (!isset($_SESSION['name']))
         {
           echo('<p>Please <a href="login.php">Log In</a></p>');
         }
        ?>
     </body>
 </html>
