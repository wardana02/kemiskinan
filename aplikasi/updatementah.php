<?php
include('../config.php');
if(isset($_POST['tombol'])){
$id=$_POST['id'];
$idtempat=$_POST['idtempat'];
$nik=$_POST['nik'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$n1=$_POST['n1'];
$n2=$_POST['n2'];
$n3=$_POST['n3'];
$tahun=$_POST['tahun'];
$semester=$_POST['semester'];
$idkelurahan=$_POST['idkelurahan'];


$nilai=$n1+$n2+$n3;

if($nilai <= 60){
$gol='miskin';
}

if($nilai > 60){
$gol='kaya';
}


$query_update="UPDATE mentah SET idtempat= '".$idtempat."',ref_kelurahan= '".$idkelurahan."',nik= '".$nik."',nama= '".$nama."',alamat= '".$alamat."',n1= '".$n1."',n2= '".$n2."',n3= '".$n3."',gol= '".$gol."',tahun= '".$tahun."',semester= '".$semester."' WHERE id='".$id."'";	
$update=mysql_query($query_update);
if($update){
header("location:../user.php?menu=mentah&stt= Update Berhasil");}
else{
header("location:../user.php?menu=mentah&stt= Update gagal");}}
?>