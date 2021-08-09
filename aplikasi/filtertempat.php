<?php
include('../config.php');
$id=$_GET['id_user'];
$query="SELECT * from  tempat WHERE id='".$id."' ";
$get_data=mysql_query($query);
$hasil=mysql_fetch_array($get_data);
$id=$hasil['id'];
$tempat=$hasil['tempat'];
$alamat=$hasil['alamat'];
$telp=$hasil['telp'];
$lat=$hasil['lat'];
$lng=$hasil['lng'];


$data=$id."&&&".$tempat."&&&".$lat."&&&".$lng."&&&".$alamat."&&&".$telp;
echo $data; ?>