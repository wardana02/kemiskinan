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
<div id="pilih_laporan">
<table width="95%" border="0" align="center">
  <tr>
    <td align="center">
    <input type="submit" name="button_print" id="button_print" value="Print" onclick="print()" />    </td>
  </tr>
</table>
</div>
<div id="tampil_laporan"><table width="95%" border="1" align="center">
  <tr>
    <td colspan="6" align="left" class="judul_laporan"><p> HASIL PENGELOMPOKAN</p>

	  </td>
    
	</tr>
<tr>

</tr>
      <tr>
										<th>Id </th>
                                            <th>C1</th>
                                            <th>C2</th>
											<th>C3</th>
											<th>Hasil</th>
											<th>Nilai</th>

											
                                        </tr>
                     <?php
									   $no=1;
									   $sql = mysql_query("SELECT * FROM tempat group by id order by id asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['id'];
					$tempat=$data['tempat'];
				
				
				$dd = mysql_query("SELECT nakhir FROM akhir where idtempat='$idtempat' and c='1'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah=$datad['nakhir'];
				}
				
				$dd = mysql_query("SELECT nakhir FROM akhir where idtempat='$idtempat' and c='2'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah2=$datad['nakhir'];
				}
					$dd = mysql_query("SELECT nakhir FROM akhir where idtempat='$idtempat' and c='3'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah3=$datad['nakhir'];
				}
				
				if($jumlah > $jumlah2 and $jumlah > $jumlah3) {
				$nilai=$jumlah;
				$ket='C1';
				$keterangan='Tingkat Kemiskinan Rendah';
				}
				if($jumlah2 > $jumlah and $jumlah2 > $jumlah3) {
				$ket='C2';
				$nilai=$jumlah2;
				$keterangan='Tingkat Kemiskinan Sedang';
				}
				if($jumlah3 > $jumlah and $jumlah3 > $jumlah2) {
				$ket='C3';
				$nilai=$jumlah3;
				$keterangan='Tingkat Kemiskinan Tinggi';
				}
				
				
				$update= mysql_query("update tempat set nilai='".$nilai."',posisi='".$ket."' where id='".$idtempat."' ");
				
				?>
				
                                        <tr class="gradeC">
										 <td><?php echo $tempat ?></td>
                                            <td><?php echo $jumlah ?></td>
                                            <td><?php echo $jumlah2?></td>
											<td><?php echo $jumlah3?></td>
											<td><?php echo $ket.'    '.$keterangan ?></td>
											<td><?php echo $nilai; ?></td>
                                            

                                            
                                        </tr>
                <?php }}?>       

</table>
</div>




<br>
<br>


<div id="tampil_laporan"><table width="95%" border="1" align="center">
  <tr>
    <td colspan="6" align="left" class="judul_laporan"><p> HASIL PRESENTASE</p>

	  </td>
    
	</tr>
<tr>

</tr>
    <tr>
										<th>Id </th>
                                            <th>Presentase</th>
											<th>Keterangan</th>
										
                                      

											
                                        </tr>
                    <?php
									   $no=1;
								$bb = mysql_query("SELECT count(gol='miskin') jumlah FROM mentah  ");
		
				while($databb = mysql_fetch_array($bb)){
				
				$totjumlah=$databb['jumlah'];
			
				
				}
				
									   $sql = mysql_query("SELECT * FROM tempat  order by id asc");
		
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['id'];
					$tempat=$data['tempat'];
						$nilai=$data['nilai'];
				$sumjumlah='';
				
				
				$b = mysql_query("SELECT idtempat,count(gol='miskin') jumlah FROM mentah where idtempat='$idtempat' group by idtempat ");
		
				while($datab = mysql_fetch_array($b)){
				
				$sumjumlah=$datab['jumlah'];
				}
				
				
				$persen=number_format(($sumjumlah/$totjumlah)*100,2);
				
				?>
				
                                        <tr class="gradeC">
										 <td><?php echo $tempat ?></td>
                                            <td><?php echo $persen.' % '; ?></td>
											<td>Kecamatan memiliki <?php echo $persen.' % '; ?> kemiskinan <br>
											dari Total Kemiskinan Warga Kecamatan <?php echo $tempat ?> , <?php echo $sumjumlah; ?><br>
											Dengan Total Kemiskinan Seluruh Warga Surakarta <?php echo $totjumlah; ?></td>
                                      
                                            

                                            
                                        </tr>
                <?php }?>                      

</table>
</div>


</body>
</html>