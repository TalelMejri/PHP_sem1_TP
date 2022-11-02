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
     


     if(isset($_GET['check_search']) && !empty($_GET['search'])){

        extract($_GET);
        $name_search="%".$search."%";
        $sql=$pdo->prepare("SELECT * from todos where titel like :name AND id_user=:id ");
        $sql->execute(['id'=>$_SESSION['iduser'],'name'=>$name_search]);
        $alltodos=$sql->fetchall();
            if(!$alltodos){
                $alltodos="vide";
            }

     }else{
      
        $sql=$pdo->prepare("SELECT * from todos where id_user=:id");
        $sql->execute(['id'=>$_SESSION['iduser']]);
        $alltodos=$sql->fetchall();
        
     }



     $show=null;
     $template="profiluser";
     $page_titel=$_SESSION['nameuser'];
     include "../layout.phtml";
?>