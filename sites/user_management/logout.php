<?php
//by Zoe Abeln
//generic logout script

   session_start();
   
   if(session_destroy()) {
      header("Location: /cocktailGit/index.php");
   }
?>