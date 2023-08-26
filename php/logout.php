<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
      echo "<script>location.replace('../index.php')</script>";
    }
?>