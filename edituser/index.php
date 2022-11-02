<?php 
 session_start();
 if(!isset($_SESSION['nameuser'])){
    header("location:../login");
    exit;
 }
 require_once "../db_connected/index.php";

 if(isset($_POST['edit'])){
    extract($_POST);
    $avatarupload=false;
    $avatar="";

    if(strlen($_FILES['avatar']['name'])){
        $array=['jpg','png','jpeg'];
        $type=pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
        $name_file=md5(mt_rand()).$type;
        if($_FILES['avatar']['size']>99999999){
            header("location:index.php?msg=image should be smaller");
            exit;
        }else if(!in_array($type,$array)){
            header("location:index.php?msg=upload image failed type");
            exit;
        }else if(!move_uploaded_file($_FILES['avatar']['tmp_name'],'../storage/'.$name_file)){
            header("location:index.php?msg=upload image failed");
            exit;
        }
        $avatar="../storage/".$name_file;
        $avatarupload=true;
    }

     if($avatarupload){
        $sql=$pdo->prepare("UPDATE users SET nom=:name,prenom=:prenom,avatar=:avatar,email=:email,password=:password");
        $sql->execute([
            'name'=>$name,
            'prenom'=>$prenom,
            'avatar'=>$avatar,
            'email'=>$email,
            'password'=>$password
        ]);
        $_SESSION['nameuser']=$name;
        $_SESSION['prenomuser']=$prenom;
        $_SESSION['passworduser']= $password;
        $_SESSION['emailuser']=$email;
        $_SESSION['avataruser']=$avatar;
        header("location:../profiluser?msg=edit profil user with success");
        exit;
     }else{
        $sql=$pdo->prepare("UPDATE users SET nom=:name,prenom=:prenom,email=:email,password=:password");
        $sql->execute([
            'name'=>$name,
            'prenom'=>$prenom,
            'email'=>$email,
            'password'=>$password
        ]);
        $_SESSION['nameuser']=$name;
        $_SESSION['prenomuser']=$prenom;
        $_SESSION['passworduser']=$password;
        $_SESSION['emailuser']=$email;
        header("location:../profiluser?msg=edit  profil user with success");
        exit;
     }
 }

 $show=null;
 $page_titel="edit user";
 $template="edituser";
 include "../layout.phtml"
?>