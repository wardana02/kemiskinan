<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id_user=$_POST['id_user'];
$user=$_POST['user'];
$password=$_POST['password'];
$akses=$_POST['akses'];
$idtempat=$_POST['idtempat'];



$query_update="UPDATE tuser SET user= '".$user."',idtempat= '".$idtempat."',password= '".$password."',akses= '".$akses."' WHERE id_user='".$id_user."'";	
$update=mysql_query($query_update);
if($update){
header("location:../user.php?menu=account&stt= Update Berhasil");}
else{
header("location:../user.php?menu=account&stt= Update gagal");}}
?>