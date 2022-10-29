<?php
session_start();
require_once '../db_connected/index.php';
 if(isset($_POST['submit'])){
    extract($_POST);
    if(empty($email) && empty($password)){
        header("location:index.php?msg=all field required&type=danger");
    }else if(empty($email)){
        header("location:index.php?msg=email is required&type=danger");
    }
    else if(empty($password)){
        header("location:index.php?msg=password is required&type=danger");
    }else{
        $query=$pdo->prepare("SELECT * from users where email=:email");
        $query->execute(['email'=>$email]);
        $user=$query->fetch();
        //$password_hash=password_hash($password,PASSWORD_DEFAULT);
       // $verify = ( password_verify($password_hash,$user['password']) );
        if($user==false || $password!=$user['password']){
            header("location:index.php?msg=password or email is incorrect&type=danger");
        }else{
            $_SESSION['iduser']=$user['id'];
            $_SESSION['nameuser']=$user['nom'];
            $_SESSION['prenomuser']=$user['prenom'];
            $_SESSION['passworduser']=$user['password'];
            $_SESSION['emailuser']=$user['email'];
            $_SESSION['avataruser']=$user['avatar'];
            header("location:../profiluser");/** :) */
            exit;
        }
    }
 }
 $show=true;
 $template="login";
 $page_titel="login";
 include "../layout.phtml";
?>