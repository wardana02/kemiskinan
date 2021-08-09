
<?php
//require "../mysql_mysqli.inc.php";
include('../config.php');
require('FPDF/fpdf.php');



// kita akan membuat class baru yang mewarisi sifat dari class FPDF
// tujuannya agar lebih memudahkan editing
class PDF extends FPDF{
// function Header dan Footer akan otomatis dipanggil untuk membuat header dan footer
function garis(){
$this->SetLineWidth(1);
$this->Line(10,36,200,36);
$this->SetLineWidth(0);
$this->Line(10,37,200,37);
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
	  $this->Cell(200,10,'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL ',0,0,'C');
	  $this->Ln(5);
	  $this->SetFont('Arial','',12);
	   $this->Cell(200,10,'JL JEND SUDIRMAN NO 2 SURAKARTA KODE POS 57111 ',0,0,'C');
	    $this->Ln(5);
	$this->Cell(200,10,'TELP 0271 639554      FAX 0271 731093 ',0,0,'C');
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
$pdf->SetFont('Times','',12); // Times 12
$u=1;

  $pdf->Cell(200,10,'Hasil Pengelompokan',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(25,6,'Id',1,0);
$pdf->Cell(25,6,'C1',1,0);
$pdf->Cell(25,6,'C2',1,0);
$pdf->Cell(25,6,'C3',1,0);
$pdf->Cell(55,6,'Hasil',1,0);
$pdf->Cell(25,6,'Nilai',1,1);
  $no=1;
									   $sql = mysql_query("SELECT * FROM tempat group by id order by id asc");
			
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
		
				
				
				$pdf->Cell(10,6,$no++,1,0);
$pdf->Cell(25,6,$tempat,1,0);
$pdf->Cell(25,6,$jumlah,1,0);
$pdf->Cell(25,6,$jumlah2,1,0);
$pdf->Cell(25,6,$jumlah3,1,0);
$pdf->Cell(55,6,$ket.'    '.$keterangan,1,0);
$pdf->Cell(25,6,$nilai,1,1);
	
				}
				
  $pdf->Cell(200,10,'Hasil Presentase',0,1,'C');
$pdf->SetFont('Arial','',10);

$pdf->Cell(25,6,'Id',1,0);
$pdf->Cell(30,6,'Presentase',1,0);
$pdf->Cell(135,6,'Keterangan',1,1);

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
				
				
				$pdf->Cell(25,6,$tempat,1,0);
$pdf->Cell(30,6,$persen.' % ',1,0);
$pdf->Cell(135,6,'Kecamatan '.$persen.' % kemiskinan '.$tempat.' '.$sumjumlah.' Dengan Total  Surakarta '.$totjumlah,1,1);

// pengulangan agar dokumen ada isinya dan kelihatan penomorannya

}
$pdf->Output(); // menampilkan hasil...
?>