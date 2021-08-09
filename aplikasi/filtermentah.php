<?php
include('../config.php');
$id_user=$_GET['id_user'];
$query="SELECT * from  mentah WHERE id='".$id_user."' ";
$get_data=mysql_query($query);
$hasil=mysql_fetch_array($get_data);
$id=$hasil['id'];
$idtempat=$hasil['idtempat'];
$nik=$hasil['nik'];
$nama=$hasil['nama'];
$alamat=$hasil['alamat'];
$n1=$hasil['n1'];
$n2=$hasil['n2'];
$n3=$hasil['n3'];
$gol=$hasil['gol'];
$tahun=$hasil['tahun'];
$semester=$hasil['semester'];
$ref_kelurahan=$hasil['ref_kelurahan'];

$data=$id."&&&".$idtempat."&&&".$nik."&&&".$nama."&&&".$alamat."&&&".$n1."&&&".$n2."&&&".$n3."&&&".$tahun."&&&".$semester."&&&".$ref_kelurahan;
echo $data; ?>