<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id=$_POST['id'];
$tempat=$_POST['tempat'];
$alamat=$_POST['alamat'];
$telp=$_POST['telp'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];

$query_update="UPDATE tempat SET tempat= '".$tempat."',lat= '".$lat."',alamat= '".$alamat."',telp= '".$telp."',lng= '".$lng."' WHERE id='".$id."'";	
$update=mysql_query($query_update);
if($update){
header("location:../user.php?menu=tempat&stt= Update Berhasil");}
else{
header("location:../user.php?menu=tempat&stt= Update gagal");}}
?>