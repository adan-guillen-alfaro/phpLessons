<?php
  start_session();
  session_destroy();
  header("Location: view.php");
 ?>
