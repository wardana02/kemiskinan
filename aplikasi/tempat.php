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
http.open('GET', 'aplikasi/filtertempat.php?id_user=' + encodeURIComponent(idsupp) , true);
http.onreadystatechange = handleResponse;
http.send(null);}}

function handleResponse(){
if(http.readyState == 4){
var string = http.responseText.split('&&&');
document.getElementById('id').value = string[0];  
document.getElementById('tempat').value = string[1];
document.getElementById('lat').value = string[2];
document.getElementById('lng').value = string[3];
document.getElementById('alamat').value = string[4];
document.getElementById('telp').value = string[5];




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
                            </button> Tempat

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                 <th>ID</th>
                                            <th>Tempat</th>
											<th>Alamat</th>
											<th>Telp</th>
											 <th>Lat</th>
											  <th>Lng</th>
                                           
										
		
											<th>Edit</th>
											<th>Hapus</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT * FROM tempat order by tempat asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				$id=$data['id'];
				$tempat=$data['tempat'];
				$lat=$data['lat'];
				$lng=$data['lng'];
				$alamat=$data['alamat'];
				$telp=$data['telp'];
			
				?>
				
                                        <tr class="gradeC">
                                            <td><?php echo $no++ ?></td>
                                      <td><?php echo $id ?></td>
                                            <td><?php echo $tempat ?></td>
											 <td><?php echo $alamat ?></td>
											  <td><?php echo $telp ?></td>
											<td><?php echo $lat ?></td>
											<td><?php echo $lng ?></td>
                                          
									
											 <td>
											
											
										
											 <button type="submit" class="btn btn-primary btn-line" value='<?php echo $id; ?>' data-toggle="modal"  data-target="#newReggg" name='tomboledit'  onclick="new sendRequest(this.value)">
                                Edit
                            </button>
												
											</td>
											  <td class="center"><form action="aplikasi/deletetempat.php" method="post" >
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
                                            <h4 class="modal-title" id="H4"> Tambah Tempat</h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="aplikasi/simpantempat.php" method="post"  enctype="multipart/form-data" name="postform2">
                                     
								
										<div class="form-group">
                                      
                                            <input placeholder="Nama Tempat" class="form-control" type="text" name="tempat" required='required' >
                                    
                                        </div>
<div class="form-group">
                                      
                                            <input placeholder="Alamat" class="form-control" type="text" name="alamat" required='required' >
                                    
                                        </div>
<div class="form-group">
                                      
                                            <input placeholder="Telp" class="form-control" type="text" name="telp" required='required' >
                                    
                                        </div>										
										<div class="form-group">
                                      
                                            <input placeholder="Lokasi Latitute" class="form-control" type="text" name="lat" required='required' >
                                    
                                        </div>	
										<div class="form-group">
                                      
                                            <input placeholder="Lokasi Longitute" class="form-control" type="text" name="lng" required='required' >
                                    
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
                                            <h4 class="modal-title" id="H4">Edit Tempat </h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="aplikasi/updatetempat.php" method="post"  enctype="multipart/form-data" name="postform2">
                                         <div class="form-group">
                                         
                                            <input class="form-control" type="hidden" name="id" id="id"  readonly>
                                    
                                        </div>
										
										<div class="form-group">
                                      Nama Tempat
                                            <input placeholder="Nama User" class="form-control" type="text" name="tempat" id="tempat" required='required' >
                                    
                                        </div>
										<div class="form-group">
                                      
                                            <input placeholder="Alamat" class="form-control" type="text" name="alamat" id="alamat" required='required' >
                                    
                                        </div>
<div class="form-group">
                                      
                                            <input placeholder="Telp" class="form-control" type="text" name="telp"  id="telp" required='required' >
                                    
                                        </div>

<div class="form-group">
                                      
                                            <input placeholder="Lokasi Latitute" class="form-control" type="text" name="lat" id="lat" required='required' >
                                    
                                        </div>	
										<div class="form-group">
                                      
                                            <input placeholder="Lokasi Longitute" class="form-control" type="text" name="lng" id="lng" required='required' >
                                    
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
                        
              				