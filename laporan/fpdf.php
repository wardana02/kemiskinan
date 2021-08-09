
<?php
//require "../mysql_mysqli.inc.php";
include('../config.php');
require('FPDF/fpdf.php');


if(isset($_POST['kecamatan'])){
	
$fkecamatan=$_POST['kecamatan'];
$fsemester=$_POST['semester'];
$ftahun=$_POST['tahun'];

}

$s = mysql_query("SELECT * FROM kelurahan where ref_tempat='$fkecamatan' order by kelurahan asc limit 1");
			 while($datas = mysql_fetch_array($s)){
				$idkelurahan=$datas['idkelurahan'];
				$kelurahan=strtoupper($datas['kelurahan']);
				$ref_tempat=$datas['ref_tempat'];
				$alamat=$datas['alamat'];
				$telp=$datas['telp'];
				$fax=$datas['fax'];
			
					$bb = mysql_query("SELECT tempat FROM tempat where id='$ref_tempat'");
			 while($databb = mysql_fetch_array($bb)){
				$kecamatankop=strtoupper($databb['tempat']);
				}
				}
				
$GLOBALS["kecamatan"] = $kecamatankop;
$GLOBALS["kelurahan"] = $kelurahan;
$GLOBALS["alamat"] = $alamat;
$GLOBALS["telp"] = $telp;
$GLOBALS["fax"] = $fax;

// kita akan membuat class baru yang mewarisi sifat dari class FPDF
// tujuannya agar lebih memudahkan editing
class PDF extends FPDF{
// function Header dan Footer akan otomatis dipanggil untuk membuat header dan footer
function garis(){
$this->SetLineWidth(1);
$this->Line(10,39,200,39);
$this->SetLineWidth(0);
$this->Line(10,40,200,40);
}
  function Header()
  {
      // logo atau gambar, 
      // 'logo.php' di bawah berarti path atau alamat gambar
      // dengan panjang posisi X = 10, Y = 6, dan panjang 30 
      $this->Image('logo.png',20,6,20);
      // arial bold 15
      $this->SetFont('Arial','B',15);
      // membuat cell kosong dengan panjang 80
      $this->Cell(80);
      // judul
      $this->Cell(30,10,'PEMERINTAH KOTA SURAKARTA',0,0,'C');
	  $this->Ln(5);
	  $this->Cell(200,10,'KECAMATAN '.$GLOBALS["kecamatan"],0,0,'C');
$this->Ln(5);
$this->Cell(200,10,'K E L U R A H A N '.$GLOBALS["kelurahan"],0,0,'C');
	  $this->Ln(5);
	  $this->SetFont('Arial','',12);
	   $this->Cell(200,10,'Alamat   '.$GLOBALS["alamat"],0,0,'C');
	    $this->Ln(5);
	$this->Cell(200,10,'Telp '.$GLOBALS["telp"].'            Fax  '.$GLOBALS["fax"]  ,0,0,'C');

	$this->garis();
      // line break dengan tinggi 20
      $this->Ln(20);
	  
	
  }


	
  function Footer()
  {
      // mengatur posisi 1,5 cm ke bawah
      $this->SetY(-15);
      // arial italic 8
      $this->SetFont('Arial','I',8);
      // penomoran halaman
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

$pdf = new PDF();
$pdf->AliasNbPages(); // fungsi untuk mengitung jumlah total halaman
$pdf->AddPage(); // membuat halaman

$u=1;

$s = mysql_query("SELECT * FROM kelurahan where ref_tempat='$fkecamatan' order by kelurahan asc");
			 while($datas = mysql_fetch_array($s)){
				$idkelurahan=$datas['idkelurahan'];
				$kelurahan=strtoupper($datas['kelurahan']);
				$ref_tempat=$datas['ref_tempat'];
				$alamat=$datas['alamat'];
				$telp=$datas['telp'];
				$fax=$datas['fax'];
			
					$bb = mysql_query("SELECT tempat FROM tempat where id='$ref_tempat'");
			 while($databb = mysql_fetch_array($bb)){
				$kecamatan=strtoupper($databb['tempat']);
				}
				

$pdf->SetFont('Times','',12); // Times 12	  

 $pdf->Cell(200,10,'DAFTAR PENDUDUK '.$kelurahan,0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(25,6,'Kecamatan',1,0);
$pdf->Cell(30,6,'Nama',1,0);
$pdf->Cell(100,6,'Alamat',1,0);
$pdf->Cell(10,6,'SMT',1,0);
$pdf->Cell(15,6,'Tahun',1,1);
$noo=1;

$bg = mysql_query("SELECT * FROM mentah where idtempat='$ref_tempat' and semester='$fsemester' and tahun='$ftahun' and ref_kelurahan='$idkelurahan' order by nama ");
			 while($databg = mysql_fetch_array($bg)){
				$idtempat=$databg['idtempat'];
				$nama=$databg['nama'];
				$alamatdata=$databg['alamat'];
				$semester=$databg['semester'];
				$tahun=$databg['tahun'];
				$cc = mysql_query("SELECT tempat FROM tempat where id='$idtempat'");
			 while($datacc = mysql_fetch_array($cc)){
				$kecamatandata=$datacc['tempat'];
				}
				
				
				$pdf->Cell(10,6,$noo++,1,0);
    $pdf->Cell(25,6,$kecamatandata,1,0);
    $pdf->Cell(30,6,$nama,1,0);
    $pdf->Cell(100,6,$alamatdata,1,0); 
	$pdf->Cell(10,6,$semester,1,0,'C'); 
	$pdf->Cell(15,6,$tahun,1,1); 
	
				}
				
				
$tanggal=date('d-m-Y');
  $pdf->Cell(300,10,'Surakarta,'.$tanggal,0,1,'C');
  $pdf->Ln(5);
  $pdf->Cell(300,10,'(                                       )',0,1,'C');
 }
// pengulangan agar dokumen ada isinya dan kelihatan penomorannya


$pdf->Output(); // menampilkan hasil...
?>