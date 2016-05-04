<?php
      session_start();
      session_destroy();
      if(isset($_GET["url"])){
      header("location: http://".$_GET["url"]); 
      }
      else
          header('Location: index.php');
        ?>
