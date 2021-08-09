<?php
include('../config.php');
if(isset($_POST['tombol'])){
$idkelurahan=$_POST['idkelurahan'];
$kelurahan=$_POST['kelurahan'];
$ref_tempat=$_POST['ref_tempat'];
$alamat=$_POST['alamat'];
$telp=$_POST['telp'];
$fax=$_POST['fax'];



$query_update="UPDATE kelurahan SET kelurahan= '".$kelurahan."',ref_tempat= '".$ref_tempat."',alamat= '".$alamat."',telp= '".$telp."',fax= '".$fax."'
 WHERE idkelurahan='".$idkelurahan."'";	
$update=mysql_query($query_update);
if($update){
header("location:../user.php?menu=kelurahan&stt= Update Berhasil");}
else{
header("location:../user.php?menu=kelurahan&stt= Update gagal");}}
?>