<?php

  session_start();
  if(!isset($_SESSION['nameuser'])){
    header("location:./login") ;
    exit;
  }
  require_once "./db_connected/index.php";

  $sql=$pdo->prepare("DELETE from todos where id=:id");
  $sql->execute(['id'=>$_GET['id']]);

  header("location:./profiluser?msg=delete with success&type=success");
  exit;

?>