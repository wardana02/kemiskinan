<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
<?php include('config.php');
$Dpc= mysql_query("delete from kemiskinan");
$load= mysql_query("select idtempat,tahun,count(gol='miskin') jumlah from mentah group by tahun,idtempat");
while($dataload = mysql_fetch_array($load)){
	$idtempatl=$dataload['idtempat'];
	$jumlahl=$dataload['jumlah'];
	$tahunl=$dataload['tahun'];
	
	$isikemiskinan= mysql_query("insert into kemiskinan(idtempat,jumlah,th) values ('$idtempatl','$jumlahl','$tahunl')");
}
?>  
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
http.open('GET', 'aplikasi/filterkemiskinan.php?id_user=' + encodeURIComponent(idsupp) , true);
http.onreadystatechange = handleResponse;
http.send(null);}}

function handleResponse(){
if(http.readyState == 4){
var string = http.responseText.split('&&&');
document.getElementById('id').value = string[0];  
document.getElementById('idtempat').value = string[1];
document.getElementById('jumlah').value = string[2]; 
document.getElementById('th').value = string[3]; 
                                      


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
                      <button class="btn btn-danger btn-line" data-toggle="modal"  data-target="#newReg">
                                + 
                            </button> 
							  -->
							Data Kemiskinan 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tempat</th>
											 <th>SMT I</th>
											  <th>SMT II</th>
											<th>Jumlah</th>
											<th>Th</th>
											      
										
		<!--
											<th>Edit</th>
											<th>Hapus</th>
											-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									 //  $sql = mysql_query("SELECT * FROM kemiskinan order by idtempat asc");
									   		if($akses_tempat=='all'){
			$sql = mysql_query("SELECT * FROM kemiskinan order by idtempat asc");
			}else{
			$sql = mysql_query("SELECT * FROM kemiskinan where idtempat='$akses_tempat' order by idtempat asc");
			}
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				$id=$data['id'];
				$idtempat=$data['idtempat'];
				$jumlah=$data['jumlah'];
				$th=$data['th'];
				
				$dd = mysql_query("SELECT tempat FROM tempat where id='$idtempat'");
				while($datad = mysql_fetch_array($dd)){
				$tempat=$datad['tempat'];
				}
				
					$smt1 = mysql_query("SELECT count(id) smt1 FROM mentah where idtempat='$idtempat' and tahun='$th' and semester='1' and gol='miskin' ");
				while($datasmt1 = mysql_fetch_array($smt1)){
				$jumsmt1=$datasmt1['smt1'];
				}
				
				$smt2 = mysql_query("SELECT count(id) smt2 FROM mentah where idtempat='$idtempat' and tahun='$th' and semester='2' and gol='miskin' ");
				while($datasmt2 = mysql_fetch_array($smt2)){
				$jumsmt2=$datasmt2['smt2'];
				}
				
				?>
				
                                        <tr class="gradeC">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $tempat?></td>
											<td><?php echo $jumsmt1?></td>
											<td><?php echo $jumsmt2?></td>
                                            <td><?php echo $jumlah?></td>
											<td><?php echo $th?></td>
                                         <!--
									
											 <td>
											
											
										
											 <button type="submit" class="btn btn-primary btn-line" value='<?php echo $id; ?>' data-toggle="modal"  data-target="#newReggg" name='tomboledit'  onclick="new sendRequest(this.value)">
                                Edit
                            </button>
												
											</td>
											  <td class="center"><form action="aplikasi/deletekemiskinan.php" method="post" >
											<input type="hidden" name="id" value=<?php echo $id; ?> />
										
											<button  name="tombol" class="btn btn-danger btn-line" type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">X</button>
											</td>-->
                                            </form> 
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
                                            <h4 class="modal-title" id="H4"> Tambah Kemiskinan</h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="aplikasi/simpankemiskinan.php" method="post"  enctype="multipart/form-data" name="postform2">
                                     		
										<div class="form-group">
                                      
                                            <select class="form-control" name='idtempat' required='required'>
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
                                         
                                            <input placeholder="Jumlah Pengungjung" class="form-control" type="text" name="jumlah" required='required' >
                                    
                                        </div>	
										<div class="form-group">
                                      
                                               <select name="th" size="1" class="form-control">
											     <option selected="selected"  value="">.:: Tahun  ::.</option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
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
                                            <h4 class="modal-title" id="H4">Edit Kemiskinan</h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="aplikasi/updatekemiskinan.php" method="post"  enctype="multipart/form-data" name="postform2">
                                       <div class="form-group">
                                      
                                            <input placeholder="Nilai" class="form-control" type="hidden" name="id" id="id" required='required' >
                                    
                                        </div>	
									  <div class="form-group">
                                      
                                            <select class="form-control" name='idtempat' id='idtempat' required='required'>
             <option selected="selected"  value="">.:: Silahkan Pilih Tempat::.</option>
			<?php	$s = mysql_query("SELECT * FROM tempat order by tempat asc");
				if(mysql_num_rows($s) > 0){
			 while($datass = mysql_fetch_array($s)){
				$idtempat=$datass['id'];
				$tempat=$datass['tempat'];?>
			 <option value="<?php echo $idtempat; ?>"> <?php echo $tempat; ?>
			 </option>
			 
			 <?php }}?>
			
   
                                      </select>
                                        </div>	
									  <div class="form-group">
                                         
                                            <input placeholder="Jumlah Pengungjung" class="form-control" type="text" name="jumlah" id="jumlah" required='required' >
                                    
                                        </div>	
										<div class="form-group">
                                      
                                               <select name="th" id="th" size="1" class="form-control">
											     <option selected="selected"  value="">.:: Tahun  ::.</option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
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
					 </div>
                        
              				