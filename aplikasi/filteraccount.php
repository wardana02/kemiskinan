<?php
include('../config.php');
$id_user=$_GET['id_user'];
$query="SELECT * from  tuser WHERE id_user='".$id_user."' ";
$get_data=mysql_query($query);
$hasil=mysql_fetch_array($get_data);
$id_user=$hasil['id_user'];
$user=$hasil['user'];
$password=$hasil['password'];
$akses=$hasil['akses'];
$idtempat=$hasil['idtempat'];


$data=$id_user."&&&".$user."&&&".$password."&&&".$akses."&&&".$idtempat;
echo $data; ?>