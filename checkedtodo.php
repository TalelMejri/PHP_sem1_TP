<?php
session_start();
require_once "./db_connected/index.php";

$sql=$pdo->prepare("SELECT * from todos WHERE id=?");
$sql->execute([$_GET['id']]);   
$todo=$sql->fetch();

$query=$pdo->prepare("UPDATE todos SET complete=:com where id=:idtodo");
$query->execute(["com" => !$todo['complete'],"idtodo"=>$_GET['id']]);
header("location:./profiluser") ;

?>