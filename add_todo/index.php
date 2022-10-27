<?php
  session_start();
   require_once "../db_connected/index.php";
   $error=[];
  if(isset($_POST['submit'])){
     extract($_POST);
     if(empty($titel) && empty($description) && empty($date)){
        $error[0]="all fied must be fill";
        goto show;
     }else if(empty($titel)){
        $error[0]="titel required";
        goto show;
     }else if(empty($description)){
        $error[0]="description required";
        goto show;
     }else if(empty($date)){
        $error[0]="date required";
        goto show;
     }else {
        $sql=$pdo->prepare("INSERT INTO `todos`(`titel`, `due_date`, `description`, `complete`, `id_user`) VALUES (:titel,:date,:desc,:complete,:iduser) ");
        $sql->execute([
            'titel'=>$titel,
            'date'=>$date,
            'desc'=>$description,
            'complete'=>0,
            'iduser'=>$_SESSION['iduser']
        ]);
        header("location:../profiluser");
     }
  }
  show:
  $show=null;
  $page_titel="add todo";
  $template="add_todo";
  include "../layout.phtml";

?>