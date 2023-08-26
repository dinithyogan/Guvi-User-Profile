<?php
    session_start();
    
    if(!isset($_SESSION["userid"])) {
        echo "<script>location.replace('../index.php')</script>";
        exit();
    }
?>