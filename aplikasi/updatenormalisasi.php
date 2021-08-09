<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id=$_POST['id'];
$tempat=$_POST['tempat'];
$C1=$_POST['C1'];
$C2=$_POST['C2'];
$C3=$_POST['C3'];

$query_update="UPDATE tempat SET C1= '".$C1."',C2= '".$C2."',C3= '".$C3."' WHERE id='".$id."'";	
$update=mysql_query($query_update);
if($update){
header("location:../user.php?menu=normalisasi&stt= Update Berhasil");}
else{
header("location:../user.php?menu=normalisasi&stt= Update gagal");}}
?>