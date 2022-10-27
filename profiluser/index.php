<?php 
    session_start();
    if(!isset($_SESSION['nameuser'])){
        header("location:../login") ;
        exit;
     }
    $show=null;
    $template="profiluser";
    $page_titel=$_SESSION['nameuser'];
    include "../layout.phtml";
?>