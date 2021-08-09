<?php
session_start();
include('config.php');
if(!isset($_SESSION['user'])&&!isset($_SESSION['akses'])){
header('location:index.php');}
else{
$status_user=$_SESSION['user'];
$akses_user=$_SESSION['akses'];
$akses_tempat=$_SESSION['aksestempat'];}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surakarta</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >CMEANS</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: left ;
font-size: 16px;">Pengelompokan Penduduk Kota Surakarta Berdasarkan Status Kemiskinan menggunakan Algoritma Fuzzy C-Means
&nbsp &nbsp 
<a href="aplikasi/login_out.php" onclick="return confirm('Terima Kasih telah menggunakan manual guide ini, Yakin Mau Keluar ?')" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                   
					</li>
				
					
                    <li>
                        <a  href="user.php?menu=homeadmin"><i class="fa  fa-home fa-3x"></i> Beranda </a>
                    </li>
             	
					     
 <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Master Data<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
	<?php if(($akses_user=="admin")) { ?>	                       
					   <li>
                                <a href="user.php?menu=account">Account</a>
                            </li>
						        <li>
                                <a href="user.php?menu=kelurahan">Kelurahan</a>
                            </li>
                            <li>
                                <a href="user.php?menu=tempat">Kecamatan</a>
                            </li>
								<?php } ?>
							<li>
                                <a href="user.php?menu=mentah">Data Kuisioner</a>
                            </li>
							  <li>
                                <a href="user.php?menu=kemiskinan">Data Kemiskinan</a>
                            </li>
							<?php if(($akses_user=="admin")) { ?>
								  <li>
                                <a href="user.php?menu=normalisasi">Normalisasi</a>
                            </li>
                            <?php } ?>
                        </ul>
                      </li> 
					    <li>
                        <a  href="aplikasi/perhitungan.php"><i class="fa fa-refresh fa-3x"></i> Perhitungan</a>
                    </li>
					
					 <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Laporan <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						
							 <li>
                              <a data-toggle="modal"  data-target="#newRegUser"> Penduduk </a>
                            </li>
							<!--
                           <li>
                                <a href="laporan/penduduk.php" target="_blank"> Penduduk </a>
                            </li>
							  <li>
                              <a href="laporan/hasil.php" target="_blank"> Hasil Perhitungan </a>
                            </li>
							-->
                          
							   <li>
                              <a href="laporan/hasilpdf.php" target="_blank"> Hasil Akhir </a>
                            </li>
							<!--
							 <li>
                              <a href="laporan/fpdf.php" target="_blank"> Test FPDF </a>
                            </li>
							-->
							
							
                            
                        </ul>
                      </li> 
					  
					 
					<!--
					  <li>
                        <a  href="user.php?menu=peta"><i class="fa fa-list fa-3x"></i>Pemetaan</a>
                    </li>
					 --> 
                   
                  <li  >
                       <a href="aplikasi/login_out.php" onclick="return confirm('Terima Kasih telah menggunakan manual guide ini, Yakin Mau Keluar ?')"><i class="fa fa-user fa-3x"></i> Log Out</a>
                    </li>	
                </ul>
               
            </div>
            
        </nav>  
		
				    <div class="modal fade" id="newRegUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H4"> Filter  </h4>
                                        </div>
                                        <div class="modal-body">
                                       <form action="laporan/fpdf.php" target="_blank" method="post"  enctype="multipart/form-data" name="postform2">
                                     
									  
										<div class="form-group">
                                      
                                            	  <select name='kecamatan' class="form-control" required='required' >
             <option selected="selected"  value="">.:: Silahkan Pilih Tempat::.</option>
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
                                        </div>
										
										<div class="form-group">
                                      
                                      Semester     
    <select name="semester" size="1" id="semester" class="form-control"  required='required'>
<?php
for($i=1;$i<=2;$i++){
if($i<2){ $i=$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
                                        </div>
										
										<div class="form-group">
                                      Tahun
                                                <select name="tahun" size="1" id="tahun"  class="form-control" required='required'>
		<option value=<?php echo date('Y');?>><?php echo date('Y');?></option>
<?php
for($i=2015;$i<=date('Y');$i++){
if($i<10){ $i="0".$i; }
echo"<option value=".$i.">".$i."</option>";}
?>    
    </select>
                                        </div>
										
										
     
	
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success btn-line" data-dismiss="modal"> Tutup </button>
                                            <button type="Submit" class="btn btn-danger btn-line" name='tombol'> Cetak </button>
                                        </div>
										    </form>
                                    </div>
                                </div>
                            </div>
                    </div>
		
		
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
     <?php
if(isset($_GET['menu'])){
$menu=$_GET['menu'];
switch($menu){
case('tempat');include('aplikasi/tempat.php');break;
case('kelurahan');include('aplikasi/kelurahan.php');break;
case('hnilai');include('aplikasi/hnilai.php');break;
case('peta');include('aplikasi/peta3.php');break;
case('mentah');include('aplikasi/mentah.php');break;
case('importmentah');include('aplikasi/importmentah.php');break;
case('account');include('aplikasi/account.php');break;
case('normalisasi');include('aplikasi/normalisasi.php');break;
case('kemiskinan');include('aplikasi/kemiskinan.php');break;
case('homeadmin');include('aplikasi/homeadmin.php');break;


} }else{include('aplikasi/homeadmin.php');
}
?>   
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
