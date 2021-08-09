<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id=$_POST['id'];
$idtempat=$_POST['idtempat'];
$jumlah=$_POST['jumlah'];
$th=$_POST['th'];



$query_update="UPDATE kemiskinan SET idtempat= '".$idtempat."',jumlah= '".$jumlah."',th= '".$th."' WHERE id='".$id."'";	
$update=mysql_query($query_update);
if($update){
header("location:../user.php?menu=kemiskinan&stt= Update Berhasil");}
else{
header("location:../user.php?menu=kemiskinan&stt= Update gagal");}}
?>