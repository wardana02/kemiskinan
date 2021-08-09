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

$id=kdauto("kemiskinan",'');

if(isset($_POST['tombol'])){
	
$idtempat=$_POST['idtempat'];
$jumlah=$_POST['jumlah'];
$th=$_POST['th'];




$query_insert="insert into kemiskinan (id,idtempat,jumlah,th) values ('".$id."','".$idtempat."','".$jumlah."','".$th."')";	
$update=mysql_query($query_insert);
if($update){
header("location:../user.php?menu=kemiskinan&stt= Simpan Berhasil");}
else{
header("location:../user.php?menu=kemiskinan&stt=Simpan Gagal ");}}
?>