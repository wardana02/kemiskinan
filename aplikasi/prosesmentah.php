<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";

// koneksi ke mysql
mysql_connect("localhost", "root", "");
mysql_select_db("kemiskinan");

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
  // membaca data nim (kolom ke-1)
  $no = $data->val($i, 1);
  $idtempat = $data->val($i, 2);

  // membaca data nama (kolom ke-2)
  $nik = $data->val($i, 3);
  // membaca data alamat (kolom ke-3)
  $nama = $data->val($i, 4);
  $alamat = $data->val($i, 5);
  $n1 = $data->val($i, 6);
  $n2 = $data->val($i, 7);
  $n3 = $data->val($i, 8);
  $gol = $data->val($i, 9);
  $tahun = $data->val($i, 10);
  $semester = $data->val($i, 11);
  $ref_kelurahan = $data->val($i, 12);

  //cek tahun 
  
  // setelah data dibaca, sisipkan ke dalam tabel mhs
  $query = "INSERT INTO mentah(idtempat,nik,nama,alamat,n1,n2,n3,gol,tahun,semester,ref_kelurahan) 
  VALUES ('$idtempat','$nik', '$nama', '$alamat', '$n1','$n2', '$n3', '$gol', '$tahun', '$semester', '$ref_kelurahan')";
  $hasil = mysql_query($query);

  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah
  if ($hasil) $sukses++;
  else $gagal++;
}

// tampilan status sukses dan gagal
//echo "<h3>Proses import data selesai.</h3>";
//echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
//echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
echo"<meta http-equiv='refresh' content='1 URL=../user.php?menu=importmentah'>";

?>