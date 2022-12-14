<?php 
 require_once '../db_connected/index.php';
 include "../checkdata.php";
 $error=[];
 if(isset($_POST['signup'])){
    extract($_POST);
    if($name==""){
        $error['name']="name required ";
        goto showhere;
    }
    else if($prenom==""){
        $error['prenom']="prenom required ";
        goto showhere;
    }
    else if($email==""){
        $error['email']="email required ";
        goto showhere;
    }
    else if($password==""){
        $error['password']="password required ";
        goto showhere;
    }
    else if($_FILES['avatar']['name']==""){
        $error['file']="file required ";
        goto showhere;
    }
    else if(strlen($name)<4){
        $error['name']="name long than 4";
        goto showhere;
    }
    else if(strlen($prenom)<4){
        $error['prenom']="prenom long than 4";
        goto showhere;
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error['email']="email invalid";
        goto showhere;
    }
    else if(strlen($password)<6){
        $error['password']="password at least 6 caractere";
        goto showhere;
    }
    $name_file=$_FILES['avatar']['name'];
    $type_extention=pathinfo($name_file,PATHINFO_EXTENSION);
    $type_dsiponible=['png','jpg','jpeg','gif'];
    if(!in_array($type_extention,$type_dsiponible)){
        $error['file']="path info incorect";
        goto showhere;
    }
    $size_file=$_FILES['avatar']['size'];
    if($size_file>9999999){
        $error['file']="size image to large";
        goto showhere;
    }
    $name_file=md5(rand()).$type_dsiponible;
    if(!move_uploaded_file($_FILES['avatar']['tmp_name'],'../storage/'.$name_file)){
        $error['file']="upload failed";
        goto showhere;
    }
   
    else{
        $avatar='../storage/'.$name_file;
        $verifeid_existant=$pdo->prepare("SELECT * from users where email=:email");
        $verifeid_existant->execute(['email'=>$email]);
       if($verifeid_existant->rowCount()>0){
            header("location:index.php?msg=email already exist&type=danger");
        }else{
         $sql=$pdo->prepare("INSERT INTO `users`( `nom`, `prenom`, `email`, `password`, `avatar`) VALUES (:nom,:prenom,:email,:password,:avatar)");
         $sql->execute([
            'nom'=>$name,
            'prenom'=>$prenom,
            'email'=>$email,
            'password'=>password_hash($password,PASSWORD_DEFAULT),
            'avatar'=>$avatar
         ]);
         header("location:../congrat.php?name=".$name."&avatar=".$name_file);
        }
    }
 }
 
 showhere:
 $show=true;
 $page_titel="Sign Up";
 $template="signup";
 include "../layout.phtml";
?>