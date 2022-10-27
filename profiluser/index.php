<?php 
    session_start();
    require_once "../db_connected/index.php";
    if(!isset($_SESSION['nameuser'])){
        header("location:../login") ;
        exit;
     }
     if(isset($_GET['check'])){
        extract($_GET);
        $sql=$pdo->prepare("SELECT * from todos where id=:id order by complete");
        $sql->execute(['id'=>$idtdodo]);
        $todo_check=$sql->fetch();
        $sql1=$pdo->prepare("UPDATE todos SET complete=:comp where id=:id");
        $sql1->execute(['id'=>$idtdodo,'comp'=>$todo_check['complete'] ? 0 : 1]);
     }
     
     $sql=$pdo->prepare("SELECT * from todos where id_user=:id");
     $sql->execute(['id'=>$_SESSION['iduser']]);
     $alltodos=$sql->fetchall();
    $show=null;
    $template="profiluser";
    $page_titel=$_SESSION['nameuser'];
    include "../layout.phtml";
?>