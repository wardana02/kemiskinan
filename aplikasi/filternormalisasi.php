<?php
include('../config.php');
$id=$_GET['id_user'];
$query="SELECT * from  tempat WHERE id='".$id."' ";
$get_data=mysql_query($query);
$hasil=mysql_fetch_array($get_data);
$id=$hasil['id'];
$tempat=$hasil['tempat'];
$C1=$hasil['C1'];
$C2=$hasil['C2'];
$C3=$hasil['C3'];


$data=$id."&&&".$tempat."&&&".$C1."&&&".$C2."&&&".$C3;
echo $data; ?>