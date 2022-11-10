<?php
session_start();
require_once '../db_connected/index.php';

include "../checkdata.php";

 if(isset($_POST['submit'])){
    //extract($_POST);
    $email=checkData($_POST['email']);
    $password=checkData($_POST['password']);
    if(empty($email) && empty($password)){
        header("location:index.php?msg=all field required&type=danger");
    }else if(empty($email)){
        header("location:index.php?msg=email is required&type=danger");
    }
    else if(empty($password)){
        header("location:index.php?msg=password is required&type=danger");
    }else{
        $password= md5($_POST['password']);
        $query=$pdo->prepare("SELECT * from users where email=:email");
        $query->execute(['email'=>$email]);
        $user=$query->fetch(PDO::FETCH_ASSOC);
        if($user){
            if($password!=$user['password']){
                header("location:index.php?msg=password or email is incorrect&type=danger");
            }else{
                    $_SESSION['iduser']=$user['id'];
                    $_SESSION['nameuser']=$user['nom'];
                    $_SESSION['prenomuser']=$user['prenom'];
                   // $_SESSION['passworduser']=$user['password'];
                    $_SESSION['emailuser']=$user['email'];
                    $_SESSION['avataruser']=$user['avatar'];
                    header("location:../profiluser");/** :) */
                    exit;
            }
        } else{
            header("location:index.php?msg=password or email is incorrect&type=danger");
        }   
       
    }
 }
 $show=true;
 $template="login";
 $page_titel="login";
 include "../layout.phtml";
?>