<?php
include('../config.php');
function kdauto($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

$id_user=kdauto("tuser",'');

if(isset($_POST['tombol'])){
	
$idtempat=$_POST['idtempat'];
$idkelurahan=$_POST['idkelurahan'];
$nik=$_POST['nik'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$n1=$_POST['n1'];
$n2=$_POST['n2'];
$n3=$_POST['n3'];
$tahun=$_POST['tahun'];
$semester=$_POST['semester'];

$nilai=$n1+$n2+$n3;

if($nilai <= 60){
$gol='miskin';
}

if($nilai > 60){
$gol='mampu';
}

$query_insert="insert into mentah (idtempat,nik,nama,alamat,n1,n2,n3,gol,tahun,ref_kelurahan,semester) values ('".$idtempat."','".$nik."','".$nama."','".$alamat."','".$n1."','".$n2."','".$n3."','".$gol."','".$tahun."','".$idkelurahan."','".$semester."')";	
$update=mysql_query($query_insert);
if($update){
header("location:../user.php?menu=mentah&stt= Simpan Berhasil");}
else{
header("location:../user.php?menu=mentah&stt=Simpan Gagal ");}}
?>