<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id=$_POST['id'];

$query_delete="delete from mentah where id='".$id."'";	
$update=mysql_query($query_delete);
if($update){
header("location:../user.php?menu=mentah");}
else{
header("location:../user.php?menu=mentah");}}
?>