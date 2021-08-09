<?php
//require "../mysql_mysqli.inc.php";
mysql_connect("localhost","root","");
mysql_select_db("kemiskinan");
$kec = $_GET['kec'];
$kel = mysql_query("SELECT * FROM kelurahan WHERE ref_tempat='$kec' order by kelurahan");
echo "<option></option>";
while($k = mysql_fetch_array($kel)){
     echo "<option value=\"".$k['idkelurahan']."\">".$k['kelurahan']."</option>\n";
}
?>
