<?php 
 session_start();
 session_destroy();
 unset($_SESSION['username']);
 include "./index.php";
?>