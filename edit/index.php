<?php

  session_start();
  if(!isset($_SESSION['nameuser'])){
    header("location:./login");
    exit;
  }

  require_once "../db_connected/index.php";
  if(isset($_POST['edit'])){
    extract($_POST);
    $sql=$pdo->prepare("UPDATE `todos` SET `titel`=:titel,`due_date`=:date,`description`=:desc WHERE id=:id ");
    $sql->execute([
        'titel'=>$titel,
        'date'=>$date,
        'desc'=>$description,
        'id'=>$id
    ]);
    header("location:../profiluser?msg=Update with success&type=success");
    exit;
  }
  $sql=$pdo->prepare("SELECT * FROM todos where id=:id_todo");
  $sql->execute(['id_todo'=>$_GET['id']]);
  $todo=$sql->fetch();

  $show=null;
  $page_titel="Update todo";
  $template="edit";
  include "../layout.phtml";
  

?>