<?php
//require "mysql_mysqli.inc.php";
$user_database="root";
$password_database="";
$server_database="localhost";
$nama_database="kemiskinan";
$koneksi=mysql_connect($server_database,$user_database,$password_database);
if(!$koneksi){
die("Tidak bisa terhubung ke server".mysql_error());}
$pilih_database=mysql_select_db($nama_database,$koneksi);
if(!$pilih_database){
die("Database tidak bisa digunakan".mysql_error());}
?>