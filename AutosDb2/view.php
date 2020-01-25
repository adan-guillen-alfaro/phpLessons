<?php
  start_session();
 ?>
 <html>
     <head>
         <meta charset="utf-8" />
         <title>Adan test db</title>
         <style>
           .error { color:red; }
         </style>
     </head>
     <body>
       <?php
         if (!isset($_SESSION['name']))
         {
           echo('<p href="login.php">Please Log In</a>');
         }
        ?>
     </body>
 </html>
