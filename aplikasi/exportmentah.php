<?php
include('../config.php'); 
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataKuisioner.xls");
?>
   <table class="table table-striped table-bordered table-hover" id="dataTables-example"  border='1'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                  <th>Kecamatan</th>
                                            <th>Jumlah</th>
                                            <th>Tahun</th>
											
										
		
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
									   $no=1;
									   $sql = mysql_query("SELECT idtempat,tahun,count(id) as jumlah FROM mentah where gol='miskin' group by idtempat,tahun");
				if(mysql_num_rows($sql) > 0){
				while($data = mysql_fetch_array($sql)){
				
				$idtempat=$data['idtempat'];
				$jumlah=$data['jumlah'];
				$tahun=$data['tahun'];
			
				$b = mysql_query("SELECT tempat FROM tempat where id='$idtempat' ");	
				while($datab = mysql_fetch_array($b)){
		$kec=$datab['tempat'];
		}
				?>
				
                                        <tr class="gradeC">
                                            <td><?php echo $no++ ?></td>
                                      
                                            <td><?php echo $kec ?></td>
											
											<td><?php echo $jumlah ?></td>
											<td><?php echo $tahun ?></td>
									
										
                                        </tr>
                <?php }}?>                      
                                    </tbody>
                                </table>