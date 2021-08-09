<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id=$_POST['id'];

$query_delete="delete from kemiskinan where id='".$id."'";	
$update=mysql_query($query_delete);
if($update){
header("location:../user.php?menu=kemiskinan");}
else{
header("location:../user.php?menu=kemiskinan");}}
?>