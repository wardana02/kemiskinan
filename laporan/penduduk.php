<?php
session_start();
include('../config.php');
?>
<style>
#pilih_laporan {
	background-color: #666; height: 30px; width: 100%;
	font-weight: bold; color: #FFF;
	text-transform: capitalize;}
#tampil_laporan{
	height: auto;width: 100%; overflow: auto;
	text-transform: capitalize;}
.judul_laporan{
	font-size: 14pt; font-weight: bold;
	color: #000; text-align: center;}
.header_footer{
	background-color: #999;
	text-align: center; font-weight: bold;}
.isi_laporan{
	font-size: 12pt; color: #000;
	background-color: #FFF;}
.resume_laporan{
	background-color: #333;
	font-weight: bold; color: #FFF;}
@media print {  
#pilih_laporan{display: none;} } 
</style>
<?php
if(isset($_POST['button_filter'])){
$semester=$_POST['semester'];
$tahun=$_POST['tahun'];
$kecamatan=$_POST['kecamatan'];
$tombol=true;
}
else{
$tombol=false;
$semester='';
$tahun='';
$kecamatan='';
//$kd_toko=$_SESSION['kd_toko'];
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Penduduk</title>
<link href="../css/laporan.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="pilih_laporan"><table width="95%" border="0" align="center">
  <tr>
    <td align="center"><form id="form_filter" name="form_filter" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
   
   
    <font color='white'>   Kecamatan </font>
   	  <select name='kecamatan' required='required' >
             <option selected="selected"  value="">.:: Silahkan Pilih Tempat::.</option>
			<?php	$s = mysql_query("SELECT * FROM tempat order by tempat asc");
				if(mysql_num_rows($s) > 0){
			 while($datas = mysql_fetch_array($s)){
				$id=$datas['id'];
				$tempat=$datas['tempat'];?>
			 <option value="<?php echo $id; ?>"> <?php echo $tempat; ?>
			 </option>
			 
			 <?php }}?>
			
   
                                      </select>
									  
									  
 <font color='white'>   Semester </font>

    <select name="semester" size="1" id="semester"  required='required'>
<?php
for($i=1;$i<=2;$i++){
if($i<2){ $i=$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
	 <font color='white'>   Tahun </font>
    <select name="tahun" size="1" id="tahun"  required='required'>
		<option value=<?php echo date('Y');?>><?php echo date('Y');?></option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
   
    <input type="submit" name="button_filter" id="button_filter" value="Filter" />
    <input type="submit" name="button_print" id="button_print" value="Print" onclick="print()" />
    </form></td>
  </tr>
</table>
</div>
<div id="tampil_laporan"><table width="95%" border="1" align="center">
  <tr>
    <td colspan="4" align="center" class="judul_laporan"><p> DAFTAR PENDUDUK </p>

      <p>Kecamatan : <?php 
	  $kecamatannnn='';
	  $t = mysql_query("SELECT tempat from tempat where id='$kecamatan'");
				while($datat = mysql_fetch_array($t)){
				$kecamatannnn=$datat['tempat'];
				}
	  
	  echo $kecamatannnn; ?>   Semester : <?php echo $semester; ?>  Tahun : <?php echo $tahun; ?>  </p>

	  </td>
    
	</tr>
<tr>

</tr>
  <tr class="header_footer">
  
    <td width=10%>No</td>
	<td width=20%>Kecamatan</td>
	
    <td width=30%>Nama </td>
	<td width=40%>Alamat</td>

  </tr>
<?php
$no=1;
if($kecamatan==''){
$sl=mysql_query("select * from mentah where semester='$semester' and tahun='$tahun'  ");
}else{
$sl=mysql_query("select * from mentah where semester='$semester' and tahun='$tahun' and idtempat='$kecamatan'  ");
}
while($datarinci = mysql_fetch_array($sl)){
$idtempat=$datarinci['idtempat'];
$nama=$datarinci['nama'];
$alamat=$datarinci['alamat'];

$t = mysql_query("SELECT tempat from tempat where id='$idtempat'");
				while($datat = mysql_fetch_array($t)){
				$kecamatannn=$datat['tempat'];
				}



 ?>


<tr class="isi_laporan">
	<td><?php echo $no++; ?>&nbsp;</td>
    <td><?php echo $kecamatannn; ?>&nbsp;</td>
	<td><?php echo $nama; ?>&nbsp;</td>
	<td><?php echo $alamat; ?>&nbsp;</td>


  </tr>


 

<?php }?>

</table>
</div>
</body>
</html>