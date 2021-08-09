<?php
include('../config.php');
$id=$_GET['id_user'];
$query="SELECT * from  kemiskinan WHERE id='".$id."' ";
$get_data=mysql_query($query);
$hasil=mysql_fetch_array($get_data);
$id=$hasil['id'];
$idtempat=$hasil['idtempat'];
$jumlah=$hasil['jumlah'];
$th=$hasil['th'];


$data=$id."&&&".$idtempat."&&&".$jumlah."&&&".$th;
echo $data; ?>