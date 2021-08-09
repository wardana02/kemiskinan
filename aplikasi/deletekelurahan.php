<?php
include('../config.php');
if(isset($_POST['tombol'])){
$idkelurahan=$_POST['id'];

$query_delete="delete from kelurahan where idkelurahan='".$idkelurahan."'";	
$update=mysql_query($query_delete);
if($update){
header("location:../user.php?menu=kelurahan");}
else{
header("location:../user.php?menu=kelurahan");}}
?>