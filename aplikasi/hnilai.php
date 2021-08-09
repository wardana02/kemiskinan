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
http.open('GET', 'aplikasi/filterkemiskinan.php?id_user=' + encodeURIComponent(idsupp) , true);
http.onreadystatechange = handleResponse;
http.send(null);
var res = idsupp;
<?php $new = idsupp.value ;?> 
document.getElementById("isi").innerHTML = res;
}}

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
                       -->  Data Hasil Kemiskinan Per Kecamatan  

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tempat</th>
											
											<?php $a = mysql_query("SELECT th FROM kemiskinan group by th order by th asc");
				while($dataa = mysql_fetch_array($a)){
				$tha=$dataa['th'];
				
				?>
											<th><?php echo $tha; ?></th>
				<?php }?>					      
										
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat FROM kemiskinan group by idtempat order by idtempat asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				
				$dd = mysql_query("SELECT tempat FROM tempat where id='$idtempat'");
				while($datad = mysql_fetch_array($dd)){
				$tempat=$datad['tempat'];
				}
				?>
				
                                        <tr class="gradeC">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $tempat?></td>
                                            
										<?php	$b = mysql_query("SELECT th FROM kemiskinan where idtempat='$idtempat'");
				while($datab = mysql_fetch_array($b)){
				$thb=$datab['th'];
				
				$c = mysql_query("SELECT jumlah FROM kemiskinan where idtempat='$idtempat' and th='$thb' ");
				while($datac = mysql_fetch_array($c)){
				$jumlahc =$datac['jumlah'];
				}
				
				?>
											<td><?php echo $jumlahc?></td>
				<?php } ?>    
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Normalisasi

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>C1</th>
                                            <th>C2</th>
											<th>C3</th>
											
											<?php $a = mysql_query("SELECT th FROM kemiskinan group by th order by th asc");
				while($dataa = mysql_fetch_array($a)){
				$tha=$dataa['th'];
				
				?>
											<th><?php echo $tha; ?></th>
				<?php }?>					      
										
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT * FROM kemiskinan group by idtempat order by idtempat asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				
				
				$dd = mysql_query("SELECT * FROM tempat where id='$idtempat'");
				while($datad = mysql_fetch_array($dd)){
				$tempat=$datad['tempat'];
				$C1=$datad['C1'];
				$C2=$datad['C2'];
				$C3=$datad['C3'];
				}
				?>
				
                                        <tr class="gradeC">
                                            <td><?php echo $C1 ?></td>
                                            <td><?php echo $C2?></td>
											<td><?php echo $C3?></td>
                                            
										<?php	$b = mysql_query("SELECT th FROM kemiskinan where idtempat='$idtempat'");
				while($datab = mysql_fetch_array($b)){
				$thb=$datab['th'];
				
				$c = mysql_query("SELECT jumlah FROM kemiskinan where idtempat='$idtempat' and th='$thb' ");
				while($datac = mysql_fetch_array($c)){
				$jumlahc =$datac['jumlah'];
				}
				
				?>
											<td><?php echo $jumlahc?></td>
				<?php } ?>    
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
  
  
  
  
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Pusat Cluster I 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>ID </th>
                                            <th>Mil2</th>
                                            <th>XijTh1</th>
											<th>XijTh2</th>
											<th>Mil2*Xil</th>
											<th>Mil2*Xil</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat,M FROM pc where C='1' group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				$M=$data['M'];
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                            <td><?php echo $M ?></td>
							<?php $a = mysql_query("SELECT th FROM pc where C='1' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT jumlah FROM pc where C='1' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$jumlah=$datab['jumlah'];
			
				}
				?>
                                            <td><?php echo $jumlah ;?></td>
											
											<?php } ?>
										
                               

<?php $ab = mysql_query("SELECT th FROM pc where C='1' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT PC FROM pc where C='1' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$PC=$databb['PC'];
				}
				?>
                                            <td><?php echo $PC ;?></td>
											
											<?php } ?>							   
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			
			  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Pusat Cluster 2 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>ID </th>
                                            <th>Mil2</th>
                                            <th>XijTh1</th>
											<th>XijTh2</th>
											<th>Mil2*Xil</th>
											<th>Mil2*Xil</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat,M FROM pc where C='2' group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				$M=$data['M'];
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                            <td><?php echo $M ?></td>
							<?php $a = mysql_query("SELECT th FROM pc where C='2' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT jumlah FROM pc where C='2' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$jumlah=$datab['jumlah'];
			
				}
				?>
                                            <td><?php echo $jumlah ;?></td>
											
											<?php } ?>
										
                               

<?php $ab = mysql_query("SELECT th FROM pc where C='2' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT PC FROM pc where C='2' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$PC=$databb['PC'];
				}
				?>
                                            <td><?php echo $PC ;?></td>
											
											<?php } ?>							   
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Pusat Cluster 3 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>ID </th>
                                            <th>Mil2</th>
                                            <th>XijTh1</th>
											<th>XijTh2</th>
											<th>Mil2*Xil</th>
											<th>Mil2*Xil</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat,M FROM pc where C='3' group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				$M=$data['M'];
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                            <td><?php echo $M ?></td>
							<?php $a = mysql_query("SELECT th FROM pc where C='3' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT jumlah FROM pc where C='3' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$jumlah=$datab['jumlah'];
			
				}
				?>
                                            <td><?php echo $jumlah ;?></td>
											
											<?php } ?>
										
                               

<?php $ab = mysql_query("SELECT th FROM pc where C='3' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT PC FROM pc where C='3' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$PC=$databb['PC'];
				}
				?>
                                            <td><?php echo $PC ;?></td>
											
											<?php } ?>							   
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Perhitungan Pusat Cluster

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>Cluster</th>
                                            <?php $a = mysql_query("SELECT th FROM kemiskinan group by th order by th asc");
				while($dataa = mysql_fetch_array($a)){
				$tha=$dataa['th'];
				
				?>
											<th>Vkj</th>
				<?php }?>					      
										
										

                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT c FROM pcbaru group by c order by c");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
		
				$c=$data['c'];
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $c ?></td>
                                      
							 <?php $a = mysql_query("SELECT th FROM kemiskinan group by th order by th asc");
				while($dataa = mysql_fetch_array($a)){
				$tha=$dataa['th'];
				
					$b = mysql_query("SELECT v,c FROM pcbaru where th=$tha and c='$c' ");
				
				while($datab = mysql_fetch_array($b)){
				
				$v=$datab['v'];
			
				}
				
				?>
											<td><?php echo $v ?></td>
				<?php }?>					      				   
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
  
  
  
  
  
  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Objectif Cluster 1 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>ID </th>
                                            <th>Xi1</th>
											<th>Xi2</th>
											 <th>Vk11</th>
											 <th>Vk12</th>
											<th>Dev C1 x1</th>
											<th>Dev C1 x1</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat FROM object where C='1' group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
			
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                          
							<?php $a = mysql_query("SELECT th FROM object where C='1' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT jumlah FROM object where C='1' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$jumlah=$datab['jumlah'];
			
				}
				?>
                                            <td><?php echo $jumlah ;?></td>
											
											<?php } ?>
										
                               

<?php $ab = mysql_query("SELECT th FROM object where C='1' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT v FROM object where C='1' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$v=$databb['v'];
				}
				?>
                                            <td><?php echo $v ;?></td>
											
											<?php } ?>	



<?php $ab = mysql_query("SELECT th FROM object where C='1' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT dev FROM object where C='1' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$dev=$databb['dev'];
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>											
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Objectif Cluster 2 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>ID </th>
                                            <th>Xi1</th>
											<th>Xi2</th>
											 <th>Vk11</th>
											 <th>Vk12</th>
											<th>Dev C1 x1</th>
											<th>Dev C1 x1</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat FROM object where C='2' group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
			
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                          
							<?php $a = mysql_query("SELECT th FROM object where C='2' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT jumlah FROM object where C='2' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$jumlah=$datab['jumlah'];
			
				}
				?>
                                            <td><?php echo $jumlah ;?></td>
											
											<?php } ?>
										
                               

<?php $ab = mysql_query("SELECT th FROM object where C='2' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT v FROM object where C='2' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$v=$databb['v'];
				}
				?>
                                            <td><?php echo $v ;?></td>
											
											<?php } ?>	



<?php $ab = mysql_query("SELECT th FROM object where C='2' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT dev FROM object where C='2' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$dev=$databb['dev'];
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>											
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Objectif Cluster 3 

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>ID </th>
                                            <th>Xi1</th>
											<th>Xi2</th>
											 <th>Vk11</th>
											 <th>Vk12</th>
											<th>Dev C1 x1</th>
											<th>Dev C1 x1</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat FROM object where C='3' group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
			
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                          
							<?php $a = mysql_query("SELECT th FROM object where C='3' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT jumlah FROM object where C='3' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$jumlah=$datab['jumlah'];
			
				}
				?>
                                            <td><?php echo $jumlah ;?></td>
											
											<?php } ?>
										
                               

<?php $ab = mysql_query("SELECT th FROM object where C='3' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT v FROM object where C='3' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$v=$databb['v'];
				}
				?>
                                            <td><?php echo $v ;?></td>
											
											<?php } ?>	



<?php $ab = mysql_query("SELECT th FROM object where C='3' group by th");
				
				while($dataab = mysql_fetch_array($ab)){
				
				$thb=$dataab['th'];
				
				$bb = mysql_query("SELECT dev FROM object where C='3' and th=$thb and idtempat=$idtempat ");
				
				while($databb = mysql_fetch_array($bb)){
				
				
				$dev=$databb['dev'];
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>											
										
									
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
				
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Hasil Fungsi Objectif

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										 <th>Id </th>
                                            <th>Dev C1 x1</th>
											<th>Dev C1 x2</th>
											 <th>Dev C2 x1</th>
											<th>Dev C2 x2</th>
											<th>Dev C3 x1</th>
											<th>Dev C3 x2</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat FROM object group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
			
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                          
										               
							<?php $a = mysql_query("SELECT th FROM object where C='1' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT dev FROM object where C='1' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$dev=$datab['dev'];
			
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>
											
											
											<?php $a = mysql_query("SELECT th FROM object where C='2' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT dev FROM object where C='2' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$dev=$datab['dev'];
			
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>
											
											
												<?php $a = mysql_query("SELECT th FROM object where C='3' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT dev FROM object where C='3' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$dev=$datab['dev'];
			
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Normalisasi

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>Id </th>
                                            <th>C1</th>
                                            <th>C2</th>
											<th>C3</th>

											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT * FROM kemiskinan group by idtempat order by idtempat asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				
				
				$dd = mysql_query("SELECT * FROM tempat where id='$idtempat'");
				while($datad = mysql_fetch_array($dd)){
				$tempat=$datad['tempat'];
				$MC1=$datad['MC1'];
				$MC2=$datad['MC2'];
				$MC3=$datad['MC3'];
				}
				?>
				
                                        <tr class="gradeC">
										 <td><?php echo $idtempat ?></td>
                                            <td><?php echo $MC1 ?></td>
                                            <td><?php echo $MC2?></td>
											<td><?php echo $MC3?></td>
                                            

                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
  
  
  
  
  
  			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Hasil Fungsi Objectif Baru

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										 <th>Id </th>
                                            <th>Dev C1 x1</th>
											<th>Dev C1 x2</th>
											 <th>Dev C2 x1</th>
											<th>Dev C2 x2</th>
											<th>Dev C3 x1</th>
											<th>Dev C3 x2</th>
											
											
		
										
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat FROM objectbaru group by idtempat");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
			
			
				?>
				
                                        <tr class="gradeC">
										<td><?php echo $idtempat ?></td>
                                          
										               
							<?php $a = mysql_query("SELECT th FROM objectbaru where C='1' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT dev FROM objectbaru where C='1' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$dev=$datab['dev'];
			
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>
											
											
											<?php $a = mysql_query("SELECT th FROM objectbaru where C='2' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT dev FROM objectbaru where C='2' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$dev=$datab['dev'];
			
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>
											
											
												<?php $a = mysql_query("SELECT th FROM objectbaru where C='3' group by th");
				
				while($dataa = mysql_fetch_array($a)){
				
				$th=$dataa['th'];
				
				$b = mysql_query("SELECT dev FROM objectbaru where C='3' and th=$th and idtempat=$idtempat ");
				
				while($datab = mysql_fetch_array($b)){
				
				$dev=$datab['dev'];
			
				}
				?>
                                            <td><?php echo $dev ;?></td>
											
											<?php } ?>
											
                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  SUM

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>Id </th>
                                            <th>C1</th>
                                            <th>C2</th>
											<th>C3</th>

											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT * FROM tempat group by id order by id asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['id'];
				
				
				$dd = mysql_query("SELECT jumlah FROM sum where idtempat='$idtempat' and c='1'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah=$datad['jumlah'];
				}
				
				$dd = mysql_query("SELECT jumlah FROM sum where idtempat='$idtempat' and c='2'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah2=$datad['jumlah'];
				}
					$dd = mysql_query("SELECT jumlah FROM sum where idtempat='$idtempat' and c='3'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah3=$datad['jumlah'];
				}
				?>
				
                                        <tr class="gradeC">
										 <td><?php echo $idtempat ?></td>
                                            <td><?php echo $jumlah ?></td>
                                            <td><?php echo $jumlah2?></td>
											<td><?php echo $jumlah3?></td>
                                            

                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
  
  
  
  
  
   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  SUM 1/C

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>Id </th>
                                            <th>C1</th>
                                            <th>C2</th>
											<th>C3</th>

											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT * FROM tempat group by id order by id asc");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['id'];
				
				
				$dd = mysql_query("SELECT jumseper FROM sum where idtempat='$idtempat' and c='1'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah=$datad['jumseper'];
				}
				
				$dd = mysql_query("SELECT jumseper FROM sum where idtempat='$idtempat' and c='2'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah2=$datad['jumseper'];
				}
					$dd = mysql_query("SELECT jumseper FROM sum where idtempat='$idtempat' and c='3'");
				while($datad = mysql_fetch_array($dd)){
				$jumlah3=$datad['jumseper'];
				}
				?>
				
                                        <tr class="gradeC">
										 <td><?php echo $idtempat ?></td>
                                            <td><?php echo $jumlah ?></td>
                                            <td><?php echo $jumlah2?></td>
											<td><?php echo $jumlah3?></td>
                                            

                                            
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                       <!--<a href="user.php?menu=tasupplier"><button  name="tombol" class="btn text-muted text-center btn-primary" type="submit">Tambah Supplier</button></a>
                       -->  Hasil Akhir

                           

					   </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>Id </th>
                                            <th>C1</th>
                                            <th>C2</th>
											<th>C3</th>
											<th>Hasil</th>
											<th>Nilai</th>

											
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
						
						
						
						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>Kecamatan </th>
                                            <th>Presentase</th>
											<th>Keterangan</th>
										
                                      

											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
								$bb = mysql_query("SELECT count(gol='miskin') jumlah FROM mentah ");
		
				while($databb = mysql_fetch_array($bb)){
				
				$totjumlah=$databb['jumlah'];
			
				
				}
				
									   $sql = mysql_query("SELECT * FROM tempat order by id asc");
		
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
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
						
						
						
					

	<div class="panel-body">
                            <div class="table-responsive" style="overflow:scroll">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th>No  </th>
										<th>Kecamatan</th>
                                            <th>Kelurahan</th>
											<th>Jumlah</th>
											<th>Cek</th>
											
                                      

											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $nol=1;
								$bb = mysql_query("SELECT count(gol='miskin') jumlah FROM mentah ");
		
				while($databb = mysql_fetch_array($bb)){
				
				$totjumlah=$databb['jumlah'];
			
				
				}
				
									   $sql = mysql_query("SELECT * FROM tempat order by id asc");
		
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
				
				$kl = mysql_query("SELECT * FROM kelurahan where ref_tempat='$idtempat' ");
		
				while($datakl = mysql_fetch_array($kl)){
				$idkelurahan=$datakl['idkelurahan'];
				$kelurahan=$datakl['kelurahan'];
				
					$jumkl = mysql_query("SELECT count(id) jumkl FROM mentah where ref_kelurahan='$idkelurahan' and idtempat='$idtempat' ");
		
				while($datajumkl = mysql_fetch_array($jumkl)){
				$jumklt=$datajumkl['jumkl'];
				}
				$pas=$nol++ ;
				?>
				
                                        <tr class="gradeC">
										 <td><?php echo $pas ?></td>
										  <td><?php echo $tempat ?></td>
                                            <td><?php echo $kelurahan ?></td>
											<td><?php echo $jumklt ?></td>
											<td>
											
									
										
										 <a data-toggle="modal"  data-target="#myModal<?php echo $pas ?>"> Detail </a>
                                
                            </button>
							
											</td>
                                        </tr>
										
										
																			
										   <div class="modal fade" id="myModal<?php echo $pas ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Daftar Data Penduduk </h4>
</div>
<div class="modal-body">
<form role="form" action="editmhs.php" method="get">

<?php
$no=1;
$query_edit = mysql_query("select * from mentah where idtempat='$idtempat' and ref_kelurahan='$idkelurahan' ");
//$result = mysqli_query($conn, $query);
while ($row = mysql_fetch_array($query_edit)) {  
?>

<div class="form-group">
<p><?php echo $no++; ?> &nbsp &nbsp &nbsp &nbsp &nbsp  
<?php echo $row['nama']; ?> &nbsp &nbsp &nbsp &nbsp &nbsp  
<?php echo $row['alamat']; ?> </p>     
</div>



<?php 
}
//mysql_close($host);
?>        
</form>
</div>
</div>

</div>
</div>




                <?php }
				
				}?>                      
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>



						
						
						
                    </div>
                </div>
            </div>
			
			
						   