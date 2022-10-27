<?php 
    session_start();
    if(!isset($_SESSION['nameuser'])){
        header("location:../login") ;
        exit;
     }
     require_once "../db_connected/index.php";
     $sql=$pdo->prepare("SELECT * from todos where id_user=:id");
     $sql->execute(['id'=>$_SESSION['iduser']]);
     $alltodos=$sql->fetchall();
    $show=null;
    $template="profiluser";
    $page_titel=$_SESSION['nameuser'];
    include "../layout.phtml";
?>