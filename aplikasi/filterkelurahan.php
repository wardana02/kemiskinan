<?php
include('../config.php');
$id_user=$_GET['id_user'];
$query="SELECT * from  kelurahan WHERE idkelurahan='".$id_user."' ";
$get_data=mysql_query($query);
$hasil=mysql_fetch_array($get_data);
$idkelurahan=$hasil['idkelurahan'];
$kelurahan=$hasil['kelurahan'];
$ref_tempat=$hasil['ref_tempat'];
$alamat=$hasil['alamat'];
$telp=$hasil['telp'];
$fax=$hasil['fax'];



$data=$idkelurahan."&&&".$kelurahan."&&&".$ref_tempat."&&&".$alamat."&&&".$telp."&&&".$fax;
echo $data; ?>