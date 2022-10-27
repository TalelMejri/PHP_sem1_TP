<?php 
 
 session_start();
 if(!isset($_SESSION['nameuser'])){
    header("location:./login") ;
    exit;
 }
 session_destroy();
 unset($_SESSION['username']);
 header("location:./login") ;
?>