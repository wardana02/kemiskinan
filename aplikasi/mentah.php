
<?php
$sqlcari="SELECT * FROM mentah where id='62362362362362362366'";
if(isset($_POST['tombol'])){	
$idtempatcari=$_POST['idtempatcari'];
$tahuncari=$_POST['tahuncari'];
$semestercari=$_POST['semestercari'];
$idkelurahancari=$_POST['idkelurahancari'];
if($semestercari==''){
if($idkelurahancari==''){
$sqlcari="SELECT * FROM mentah where idtempat='$idtempatcari' and tahun='$tahuncari'   ";
}else{
$sqlcari="SELECT * FROM mentah where idtempat='$idtempatcari' and tahun='$tahuncari' and ref_kelurahan='$idkelurahancari'  ";
}
}

if($semestercari<>''){
if($idkelurahancari==''){
$sqlcari="SELECT * FROM mentah where idtempat='$idtempatcari' and tahun='$tahuncari'  ";
}else{
$sqlcari="SELECT * FROM mentah where idtempat='$idtempatcari' and tahun='$tahuncari' and ref_kelurahan='$idkelurahancari' ";
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	<script type="text/javascript" src="jquery.js"></script>
	
	<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>

  $("#kec").change(function(){
    var kec = $("#kec").val();
    $.ajax({
        url: "aplikasi/ambilkelurahan.php",
        data: "kec="+kec,
        cache: false,
        success: function(msg){
            $("#kel").html(msg);
        }
    });
  });
  
  
    $("#kecamatan").change(function(){
    var kec = $("#kecamatan").val();
    $.ajax({
        url: "aplikasi/ambilkelurahan.php",
        data: "kec="+kec,
        cache: false,
        success: function(msg){
            $("#kelurahan").html(msg);
        }
    });
  });
  
  
      $("#idtempat").change(function(){
    var kec = $("#idtempat").val();
    $.ajax({
        url: "aplikasi/ambilkelurahan.php",
        data: "kec="+kec,
        cache: false,
        success: function(msg){
            $("#ref_kelurahan").html(msg);
        }
    });
  });

});

</script>
	<style>
		#loading {
			width: 50px;
			height: 50px;
			border-radius: 100%;
			border: 5px solid #ccc;
			border-top-color: #ff6a00;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			margin: auto;
			z-index: 99;
			animation: putar 2s ease infinite;
		}

		@keyframes putar {
			from {
				transform: rotate(0deg);
			} to {
				transform: rotate(360deg);
			}
		}
	</style>
</head>
<body>
	<div id="loading"></div>
	<script>
		var load = document.getElementById("loading");

		window.addEventListener('load', function(){
			load.style.display = "none";
		});
	</script>
</body>
</html>
<?php include('config.php');?>  
<script language="javascript">
function createRequestObject() {
var ajax;
if (navigator.appName == 'Microsoft Internet Explorer') {
ajax= new ActiveXObject('Msxml2.XMLHTTP');} 
else {
ajax = new XMLHttpRequest();}
return ajax;}

var http = createRequestObject();
function sendRequest(idsupp){
if(idsupp==""){
alert("Anda belum memilih kode Data !");}
else{   
http.open('GET', 'aplikasi/filtermentah.php?id_user=' + encodeURIComponent(idsupp) , true);
http.onreadystatechange = handleResponse;
http.send(null);}}

function handleResponse(){
if(http.readyState == 4){
var string = http.responseText.split('&&&');
document.getElementById('id').value = string[0];
document.getElementById('idtempat').value = string[1];  
document.getElementById('nik').value = string[2];
document.getElementById('nama').value = string[3]; 
document.getElementById('alamat').value = string[4];
document.getElementById('n1').value = string[5];
document.getElementById('n2').value = string[6];
document.getElementById('n3').value = string[7];
document.getElementById('th').value = string[8];
document.getElementById('smt').value = string[9];
document.getElementById('idkelurahan').value = string[10];
                                        


}}



</script>
<?php 
function kdauto($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}?>

            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">

						  <?php if(isset($_GET['stt'])){
$stt=$_GET['stt'];
echo "".$stt."";?> <i class="icon-ok icon-2x"></i><?php }
?> 



                    </div>
                </div>

                <hr />


                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       --> <button class="btn btn-danger btn-line" data-toggle="modal"  data-target="#newReg">
                                + 
                            </button> Data Kuisioner 
							<br>
							<br>
							<form action="" method="post"  enctype="multipart/form-data" name="postform2">
							  <select name='idtempatcari' id='kec' required='required'>
             <option selected="selected"  value="">.:: Silahkan Pilih Kecamatan ::.</option>
			<?php	
			if($akses_tempat=='all'){
			$s = mysql_query("SELECT * FROM tempat order by tempat asc");
			}else{
			$s = mysql_query("SELECT * FROM tempat where id='$akses_tempat' order by tempat asc");
			}
				if(mysql_num_rows($s) > 0){
			 while($datas = mysql_fetch_array($s)){
				$id=$datas['id'];
				$tempat=$datas['tempat'];?>
			 <option value="<?php echo $id; ?>"> <?php echo $tempat; ?>
			 </option>
			 
			 <?php }}?>
			
   
                                      </select>
									  
									  
									                                         <select name="idkelurahancari" id="kel" >
<option value="">.:: Pilih Dulu Kecamatan :..</option>
<?php
//mengambil nama-nama kecamatan yang ada di database
$kelurahan = mysql_query("SELECT idkelurahan,kelurahan FROM kelurahan ORDER BY kelurahan");
while($p=mysql_fetch_array($kelurahan)){
echo "<option value=\"$p[idkelurahan]\">$p[kelurahan]</option>\n";
}
?>

</select>


									  
									                    <select name="tahuncari" size="1" required='required' >
											     <option selected="selected"  value="">.:: Tahun  ::.</option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
	
	 <select name="semestercari" size="1" >
											     <option selected="selected"  value="">.:: Semester  ::.</option>
												  <option  value="1"> Semester I </option>
												  <option  value="2"> Semester II </option>
  
    </select>
	
	
	  <button type="Submit" class="btn btn-danger btn-line" name='tombol'>Cari</button>
	</form>
	<br>
							 <a href="user.php?menu=importmentah" class="btn btn-primary btn-line" >Import Excel</a>
							 <a href="aplikasi/exportmentah.php" target='blank' class="btn btn-warning btn-line" >Export Excel</a>

                           

					   </div>
                        <div class="panel-body" >
                            <div class="table-responsive" style="overflow:scroll" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                  <th>Kecamatan</th>
								  <th>Kelurahan</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
											<th>Alamat</th>
											<th>Rumah</th>
                                            <th>Pemasukan</th>
											<th>Pengeluaran</th>
											<th>Golongan</th>
											<th>Tahun</th>
											<th>Semester</th>
											
										
		
											<th>Edit</th>
											<th>Hapus</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   
									   $sql = mysql_query($sqlcari);
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				$id=$data['id'];
				$idtempat=$data['idtempat'];
				$nik=$data['nik'];
				$nama=$data['nama'];
				$alamat=$data['alamat'];
				$n1=$data['n1'];
				$n2=$data['n2'];
				$n3=$data['n3'];
				$ref_kelurahan=$data['ref_kelurahan'];
				
				$gol=$data['gol'];
				$tahun=$data['tahun'];
				$semester=$data['semester'];
			
				$kelurahan='';
				
				$b = mysql_query("SELECT tempat FROM tempat where id='$idtempat' ");	
				while($datab = mysql_fetch_array($b)){
		$kec=$datab['tempat'];
		}
		
				$bb = mysql_query("SELECT kelurahan FROM kelurahan where idkelurahan='$ref_kelurahan' ");	
				while($databb = mysql_fetch_array($bb)){
		$kelurahan=$databb['kelurahan'];
		}
				?>
				
                                        <tr class="gradeC">
                                            <td><?php echo $no++ ?></td>
                                      
                                            <td><?php echo $kec ?></td>
											<td><?php echo $kelurahan ?></td>
											<td><?php echo $nik ?></td>
                                            <td><?php echo $nama ?></td>
											<td><?php echo $alamat ?></td>
											<td><?php echo $n1 ?></td>
                                            <td><?php echo $n2 ?></td>
											<td><?php echo $n3 ?></td>
											<td><?php echo $gol ?></td>
											<td><?php echo $tahun ?></td>
											<td><?php echo $semester ?></td>
									
									
											 <td>
											
											
										
											 <button type="submit" class="btn btn-primary btn-line" value='<?php echo $id; ?>' data-toggle="modal"  data-target="#newReggg" name='tomboledit'  onclick="new sendRequest(this.value)">
                                Edit
                            </button>
												
											</td>
											  <td class="center"><form action="aplikasi/deletementah.php" method="post" >
											<input type="hidden" name="id" value=<?php echo $id; ?> />
										
											<button  name="tombol" class="btn btn-danger btn-line" type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">X</button>
											</form> </td>
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
  
  <div class="col-lg-12">
                        <div class="modal fade" id="newReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H4"> Tambah Mentah</h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="aplikasi/simpanmentah.php" method="post"  enctype="multipart/form-data" name="postform2">
                                     
								<div class="form-group">
                                      
                                            <input placeholder="No NIK" class="form-control" type="text" name="nik" required='required' >
                                    
                                        </div>	
										
											<div class="form-group">
                                      
                                            <select class="form-control" name='idtempat'  id='kecamatan'  required='required'>
             <option selected="selected"  value="">.:: Silahkan Pilih Kecamatan::.</option>
			<?php		if($akses_tempat=='all'){
			$s = mysql_query("SELECT * FROM tempat order by tempat asc");
			}else{
			$s = mysql_query("SELECT * FROM tempat where id='$akses_tempat' order by tempat asc");
			}
				if(mysql_num_rows($s) > 0){
			 while($datas = mysql_fetch_array($s)){
				$id=$datas['id'];
				$tempat=$datas['tempat'];?>
			 <option value="<?php echo $id; ?>"> <?php echo $tempat; ?>
			 </option>
			 
			 <?php }}?>
			
   
                                      </select>
                                        </div>
										<div class="form-group">
										  <select class="form-control" name="idkelurahan" id="kelurahan" >
<option value="">.:: Pilih Dulu Kecamatan :..</option>
<?php
//mengambil nama-nama kecamatan yang ada di database
$kelurahan = mysql_query("SELECT idkelurahan,kelurahan FROM kelurahan ORDER BY kelurahan");
while($p=mysql_fetch_array($s)){
echo "<option value=\"$p[idkelurahan]\">$p[kelurahan]</option>\n";
}
?>

</select>
										
										   </div>
										<div class="form-group">
                                      
                                            <input placeholder="Nama Lengkap" class="form-control" type="text" name="nama" required='required' >
                                    
                                        </div>	
										<div class="form-group">
                                      
                                            <input placeholder="Alamat" class="form-control" type="text" name="alamat" required='required' >
                                    
                                        </div>
	
<div class="form-group">
                                  
                                <select class="form-control" name='n1' required='required' >
             <option selected="selected"  value="">.:: Kondiri Rumah ::.</option>
		
			 <option  value="10">Tidak Memiliki</option>
			 <option  value="20">Kecil</option>
			  <option  value="30">Sedang</option>
			 <option  value="40">Besar</option>
			
			
    
        </select>
                                       
                                
                                        </div>
										<div class="form-group">
                                  
                                <select class="form-control" name='n2' required='required' >
             <option selected="selected"  value="">.:: Pemasukan ::.</option>
		
			 <option  value="10">Kecil</option>
			 <option  value="20">Sedang</option>
			  <option  value="30">Besar</option>
			 
			
			
    
        </select>
                                       
                                
                                        </div>
										
										
										<div class="form-group">
                                  
                                <select class="form-control" name='n3' required='required' >
             <option selected="selected"  value="">.:: Pengeluaran ::.</option>
		
			 <option  value="30">Kecil</option>
			 <option  value="20">Sedang</option>
			  <option  value="10">Besar</option>
			 
			
			
    
        </select>
                                       
                                
                                        </div>
										
											<div class="form-group">
                                      
                                               <select name="tahun" size="1" class="form-control">
											     <option selected="selected"  value="">.:: Tahun  ::.</option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
                                        </div>	
											<div class="form-group">
                                      
                                               <select name="semester"  size="1" class="form-control">
											     <option selected="selected"  value="">.:: Semester  ::.</option>
												  <option  value="1">Semester I</option>
												  <option  value="2">Semester II</option>

    </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success btn-line" data-dismiss="modal">Close</button>
                                            <button type="Submit" class="btn btn-danger btn-line" name='tombol'>Simpan</button>
                                        </div>
										    </form>
                                    </div>
                                </div>
                            </div>
                    </div>


  
                       
					                                <div class="col-lg-12">
                        <div class="modal fade" id="newReggg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

						
								<div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H4">Edit Kuisioner </h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="aplikasi/updatementah.php" method="post"  enctype="multipart/form-data" name="postform2">
                                         <div class="form-group">
                                         
                                            <input class="form-control" type="hidden" name="id" id="id"  readonly>
                                    
                                        </div>
									<div class="form-group">
                                      
                                            <input placeholder="No NIK" class="form-control" type="text" name="nik" id="nik" required='required' >
                                    
                                        </div>	
										
										<div class="form-group">
                                      
                                            <select class="form-control" name='idtempat' id='idtempat' required='required'>
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
                                        </div>
										
									
													<div class="form-group">
										  <select class="form-control" name="idkelurahan" id="ref_kelurahan" >
<option value="">.:: Pilih Dulu Kecamatan :..</option>
<?php
//mengambil nama-nama kecamatan yang ada di database
$kelurahan = mysql_query("SELECT idkelurahan,kelurahan FROM kelurahan ORDER BY kelurahan");
while($p=mysql_fetch_array($kelurahan)){
echo "<option value=\"$p[idkelurahan]\">$p[kelurahan]</option>\n";
}
?>

</select>
										
										   </div>
									
										   
										
										<div class="form-group">
                                      
                                            <input placeholder="Nama Lengkap" class="form-control" type="text" name="nama" id="nama" required='required' >
                                    
                                        </div>	
										<div class="form-group">
                                      
                                            <input placeholder="Alamat" class="form-control" type="text" name="alamat" id="alamat" required='required' >
                                    
                                        </div>
	
<div class="form-group">
                                  
                                <select class="form-control" name='n1' id='n1' required='required' >
             <option selected="selected"  value="">.:: Kondiri Rumah ::.</option>
		
			 <option  value="10">Tidak Memiliki</option>
			 <option  value="20">Kecil</option>
			  <option  value="30">Sedang</option>
			 <option  value="40">Besar</option>
			
			
    
        </select>
                                       
                                
                                        </div>
										<div class="form-group">
                                  
                                <select class="form-control" name='n2' id='n2' required='required' >
             <option selected="selected"  value="">.:: Pemasukan ::.</option>
		
			 <option  value="10">Kecil</option>
			 <option  value="20">Sedang</option>
			  <option  value="30">Besar</option>
			 
			
			
    
        </select>
                                       
                                
                                        </div>
										
										
										<div class="form-group">
                                  
                                <select class="form-control" name='n3'  id='n3' required='required' >
             <option selected="selected"  value="">.:: Pengeluaran ::.</option>
		
			 <option  value="30">Kecil</option>
			 <option  value="20">Sedang</option>
			  <option  value="10">Besar</option>
			 
			
			
    
        </select>
                                       
                                
                                        </div>
										
											<div class="form-group">
                                      
                                               <select name="tahun" id="th" size="1" class="form-control">
											     <option selected="selected"  value="">.:: Tahun  ::.</option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
                                        </div>
										
											<div class="form-group">
                                      
                                               <select name="semester" id="smt" size="1" class="form-control">
											     <option selected="selected"  value="">.:: Semester  ::.</option>
												  <option  value="1">Semester I</option>
												  <option  value="2">Semester II</option>

    </select>
                                        </div>
										
									
									
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success btn-line" data-dismiss="modal">Close</button>
                                            <button type="Submit" class="btn btn-danger btn-line" name='tombol'>Update</button>
                                        </div>
										    </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                        
              				