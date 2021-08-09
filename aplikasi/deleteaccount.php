<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id_user=$_POST['id'];

$query_delete="delete from tuser where id_user='".$id_user."'";	
$update=mysql_query($query_delete);
if($update){
header("location:../user.php?menu=account");}
else{
header("location:../user.php?menu=account");}}
?>