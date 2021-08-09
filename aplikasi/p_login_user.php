<?php
session_start();
include('../config.php');
//$kd_toko=$_SESSION['kd_toko'];
if(isset($_POST['button_login'])){
$user=$_POST['user'];
$pass=$_POST['password'];

$query_cek_user="SELECT * FROM tuser WHERE user='".$user."' and password='".$pass."'";
$cek_user=mysql_query($query_cek_user);
$count=mysql_num_rows($cek_user);

if($count>0){
$data=mysql_fetch_array($cek_user);
$pemakai=$data['user'];
$password=$data['password'];
$akses=$data['akses'];
$aksestempat=$data['idtempat'];

if($akses=='admin'){	
header('location:../user.php?menu=homeadmin');
$_SESSION['user']=$pemakai;
$_SESSION['akses']=$akses;
$_SESSION['aksestempat']=$aksestempat;

}
else if($akses=='user'){	
header('location:../user.php?menu=homeadmin');
//if($pass==($password)){

$_SESSION['user']=$pemakai;
$_SESSION['akses']=$akses;
$_SESSION['aksestempat']=$aksestempat;

}
else if($akses=='DKB'){	
header('location:../dkb.php?menu=home');
//if($pass==($password)){

$_SESSION['user']=$pemakai;
$_SESSION['akses']=$akses;
}
//header('location:../admin.php?menu=home');}

else{ header('location:../index.php?stt= Mohon Maaf User / Password Keliru ');}}
else{ header('location:../index.php?stt= Mohon Maaf User / Password Keliru');}}
 
?>