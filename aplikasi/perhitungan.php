<?php
include('../config.php');
//data-data yang harus dihapus untuk di refresh 

$Dpc= mysql_query("delete from pc");
$Dpcbaru= mysql_query("delete from pcbaru");
$Dpo= mysql_query("delete from object");
$Dpobaru= mysql_query("delete from objectbaru");
$Dsum= mysql_query("delete from sum");
$Dakhir= mysql_query("delete from akhir");

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
}

$idpc=kdauto("pc",'');
//load data tempat untuk perhitungan  
$at=mysql_query("select * from tempat order by id");
while($dataat = mysql_fetch_array($at)){
	$idat=$dataat['id'];
	$tempatat=$dataat['tempat'];
	$mC1at=pow($dataat['C1'],2);
	$mC2at=pow($dataat['C2'],2);
	$mC3at=pow($dataat['C3'],2);
	
$upat= mysql_query("update tempat set MC1=$mC1at , MC2=$mC2at, MC3=$mC3at where id=$idat");	
	
	
}

//membuat penilaian pusat cluster 1 
//load data tempat untuk perhitungan  
$at2=mysql_query("select * from tempat order by id");
while($dataat2 = mysql_fetch_array($at2)){
	$idat2=$dataat2['id'];
	$MC1at2=$dataat2['MC1'];
	
$jum=mysql_query("select jumlah,th from kemiskinan where idtempat='$idat2' order by th asc");
while($datajum = mysql_fetch_array($jum)){
	$jumlahjum=$datajum['jumlah'];
	$thjum=$datajum['th'];
	$pcjum=$jumlahjum*$MC1at2;
	

	
	$inpc= mysql_query("insert into pc (id,idtempat,jumlah,M,C,PC,th) values ('".$idpc."','".$idat2."','".$jumlahjum."','".$MC1at2."','1','".$pcjum."','".$thjum."')");
}
}



//membuat penilaian pusat cluster 2 
//load data tempat untuk perhitungan  
$at2=mysql_query("select * from tempat order by id");
while($dataat2 = mysql_fetch_array($at2)){
	$idat2=$dataat2['id'];
	$MC2at2=$dataat2['MC2'];
	
$jum=mysql_query("select jumlah,th from kemiskinan where idtempat='$idat2' order by th asc");
while($datajum = mysql_fetch_array($jum)){
	$jumlahjum=$datajum['jumlah'];
	$thjum=$datajum['th'];
	$pcjum=$jumlahjum*$MC2at2;
	

	
	$inpc= mysql_query("insert into pc (id,idtempat,jumlah,M,C,PC,th) values ('".$idpc."','".$idat2."','".$jumlahjum."','".$MC2at2."','2','".$pcjum."','".$thjum."')");
}
}


//membuat penilaian pusat cluster 3 
//load data tempat untuk perhitungan  
$at2=mysql_query("select * from tempat order by id");
while($dataat2 = mysql_fetch_array($at2)){
	$idat2=$dataat2['id'];
	$MC3at2=$dataat2['MC3'];
	
$jum=mysql_query("select jumlah,th from kemiskinan where idtempat='$idat2' order by th asc");
while($datajum = mysql_fetch_array($jum)){
	$jumlahjum=$datajum['jumlah'];
	$thjum=$datajum['th'];
	$pcjum=$jumlahjum*$MC3at2;
	
	//echo $pcjum.'-----'.$thjum.'-----'.$idat2.'-----'.$jumlahjum.'-----'.$MC1at2.'<br>';
	
	$inpc= mysql_query("insert into pc (id,idtempat,jumlah,M,C,PC,th) values ('".$idpc."','".$idat2."','".$jumlahjum."','".$MC3at2."','3','".$pcjum."','".$thjum."')");

	}
}

//membentuk Pusat Cluster Baru  dan load cluster lama
$ni=0;
$mb=mysql_query("select M from pc where C='1'  group by idtempat ");
while($datamb = mysql_fetch_array($mb)){
	$ni=$datamb['M']+$ni;

	}
	
$thb=mysql_query("select th from pc where C='1'  group by th ");
while($datathb = mysql_fetch_array($thb)){
	$ththb=$datathb['th'];
	
	$jb=mysql_query("select sum(PC) as jumpc from pc where  C='1' and th='$ththb' ");
while($datajb = mysql_fetch_array($jb)){
	$PCB=$datajb['jumpc']/$ni;
	
	//echo $PCB.'-------'.$ththb.'<br>';
$inpcb= mysql_query("insert into pcbaru (c,v,th) values ('C1','".$PCB."','".$ththb."')");

	
	}
	
	
	}
	
	
//membentuk Pusat Cluster Baru  dan load cluster lama
$ni=0;
$mb=mysql_query("select M from pc where C='2'  group by idtempat ");
while($datamb = mysql_fetch_array($mb)){
	$ni=$datamb['M']+$ni;

	}
	
$thb=mysql_query("select th from pc where C='2'  group by th ");
while($datathb = mysql_fetch_array($thb)){
	$ththb=$datathb['th'];
	
	$jb=mysql_query("select sum(PC) as jumpc from pc where  C='2' and th='$ththb' ");
while($datajb = mysql_fetch_array($jb)){
	$PCB=$datajb['jumpc']/$ni;
	
	//echo $PCB.'-------'.$ththb.'<br>';
$inpcb= mysql_query("insert into pcbaru (c,v,th) values ('C2','".$PCB."','".$ththb."')");

	
	}
	
	
	}
	
	
	
	//membentuk Pusat Cluster Baru  dan load cluster lama
$ni=0;
$mb=mysql_query("select M from pc where C='3'  group by idtempat ");
while($datamb = mysql_fetch_array($mb)){
	$ni=$datamb['M']+$ni;

	}
	
$thb=mysql_query("select th from pc where C='3'  group by th ");
while($datathb = mysql_fetch_array($thb)){
	$ththb=$datathb['th'];
	
	$jb=mysql_query("select sum(PC) as jumpc from pc where  C='3' and th='$ththb' ");
while($datajb = mysql_fetch_array($jb)){
	$PCB=$datajb['jumpc']/$ni;
	
	//echo $PCB.'-------'.$ththb.'<br>';
$inpcb= mysql_query("insert into pcbaru (c,v,th) values ('C3','".$PCB."','".$ththb."')");

	
	}
	
	
	}
	
	
	
	
	
	
	
	//membuat fungsi objectif 1 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select jumlah,th from kemiskinan where idtempat='$idbat2' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bjumlahjum=$databjum['jumlah'];
	$bthjum=$databjum['th'];
	
	$dd=mysql_query("select v from pcbaru where c='C1'and th='$bthjum' order by th asc");
while($datadd= mysql_fetch_array($dd)){
	$vdd=$datadd['v'];
	$dev=pow(($bjumlahjum-$vdd),2);

	
	
	$inpo= mysql_query("insert into object (idtempat,jumlah,v,c,dev,th) values ('".$idbat2."','".$bjumlahjum."','".$vdd."','1','".$dev."','".$bthjum."')");

	}
	}
}


	
	//membuat fungsi objectif 2 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select jumlah,th from kemiskinan where idtempat='$idbat2' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bjumlahjum=$databjum['jumlah'];
	$bthjum=$databjum['th'];
	
	$dd=mysql_query("select v from pcbaru where c='C2'and th='$bthjum' order by th asc");
while($datadd= mysql_fetch_array($dd)){
	$vdd=$datadd['v'];
	$dev=pow(($bjumlahjum-$vdd),2);

	

	
	$inpo= mysql_query("insert into object (idtempat,jumlah,v,c,dev,th) values ('".$idbat2."','".$bjumlahjum."','".$vdd."','2','".$dev."','".$bthjum."')");

	}
	}
}


	//membuat fungsi objectif 3 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select jumlah,th from kemiskinan where idtempat='$idbat2' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bjumlahjum=$databjum['jumlah'];
	$bthjum=$databjum['th'];
	
	$dd=mysql_query("select v from pcbaru where c='C3'and th='$bthjum' order by th asc");
while($datadd= mysql_fetch_array($dd)){
	$vdd=$datadd['v'];
	$dev=pow(($bjumlahjum-$vdd),2);

	//echo $vdd.'---'.$bjumlahjum.'---'.$dev.'<br>';

	
	$inpo= mysql_query("insert into object (idtempat,jumlah,v,c,dev,th) values ('".$idbat2."','".$bjumlahjum."','".$vdd."','3','".$dev."','".$bthjum."')");

	}
	}
}






	//perkalian dengan normalisasi acak  
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select dev,th from object where idtempat='$idbat2' and c='1' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bdevjum=$databjum['dev'];
	$bthjum=$databjum['th'];
	
	$dd=mysql_query("select MC1 from tempat where id='$idbat2' ");
while($datadd= mysql_fetch_array($dd)){
	$MC1=$datadd['MC1'];
	$xx=$MC1*$bdevjum;


	//echo $MC1.'---'.$bdevjum.'---'.$xx.'<br>';

	
	$inpobaru= mysql_query("insert into objectbaru (idtempat,c,dev,th) values ('".$idbat2."','1','".$xx."','".$bthjum."')");

	}
	}
}


//perkalian dengan normalisasi acak  
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select dev,th from object where idtempat='$idbat2' and c='2' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bdevjum=$databjum['dev'];
	$bthjum=$databjum['th'];
	
	$dd=mysql_query("select MC2 from tempat where id='$idbat2' ");
while($datadd= mysql_fetch_array($dd)){
	$MC1=$datadd['MC2'];
	$xx=$MC1*$bdevjum;


	//echo $MC1.'---'.$bdevjum.'---'.$xx.'<br>';

	
	$inpobaru= mysql_query("insert into objectbaru (idtempat,c,dev,th) values ('".$idbat2."','2','".$xx."','".$bthjum."')");

	}
	}
}





//perkalian dengan normalisasi acak  
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select dev,th from object where idtempat='$idbat2' and c='3' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bdevjum=$databjum['dev'];
	$bthjum=$databjum['th'];
	
	$dd=mysql_query("select MC3 from tempat where id='$idbat2' ");
while($datadd= mysql_fetch_array($dd)){
	$MC1=$datadd['MC3'];
	$xx=$MC1*$bdevjum;


	//echo $MC1.'---'.$bdevjum.'---'.$xx.'<br>';

	
	$inpobaru= mysql_query("insert into objectbaru (idtempat,c,dev,th) values ('".$idbat2."','3','".$xx."','".$bthjum."')");

	}
	}
}





//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	$bb=0;
$bjum=mysql_query("select dev,th from object where idtempat='$idbat2' and c='1' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bdevjum=$databjum['dev'];
	$bthjum=$databjum['th'];
	

	$bb=$bdevjum+$bb;
	$jumseper=1/$bb;


	
	}

	$insum= mysql_query("insert into sum (idtempat,c,jumlah,jumseper) values ('".$idbat2."','1','".$bb."','".$jumseper."')");
}




//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	$bb=0;
$bjum=mysql_query("select dev,th from object where idtempat='$idbat2' and c='2' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bdevjum=$databjum['dev'];
	$bthjum=$databjum['th'];
	

	$bb=$bdevjum+$bb;
	$jumseper=1/$bb;


	
	}

	$insum= mysql_query("insert into sum (idtempat,c,jumlah,jumseper) values ('".$idbat2."','2','".$bb."','".$jumseper."')");
}



//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	$bb=0;
$bjum=mysql_query("select dev,th from object where idtempat='$idbat2' and c='3' order by th asc");
while($databjum = mysql_fetch_array($bjum)){
	$bdevjum=$databjum['dev'];
	$bthjum=$databjum['th'];
	

	$bb=$bdevjum+$bb;
	$jumseper=1/$bb;


	
	}

	$insum= mysql_query("insert into sum (idtempat,c,jumlah,jumseper) values ('".$idbat2."','3','".$bb."','".$jumseper."')");
}







//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	
$bjum=mysql_query("select sum(jumseper) as jumm from sum where idtempat='$idbat2'  ");
while($databjum = mysql_fetch_array($bjum)){
	$ljumseper=$databjum['jumm'];
	

$uptempat= mysql_query("update tempat set total ='".$ljumseper."' where id='".$idbat2."' ");

	
	}

	
}







//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	$bb=0;
$bjum=mysql_query("select jumseper from sum where idtempat='$idbat2' and c='1' ");
while($databjum = mysql_fetch_array($bjum)){
	$bdjumseper=$databjum['jumseper'];
	
	$total=mysql_query("select total from tempat where id='$idbat2'  ");
while($datatotal = mysql_fetch_array($total)){
	$bdtotal=$datatotal['total'];
	}
	$nakhir=$bdjumseper/$bdtotal;
	
	
//echo $bdjumseper.'--------'.$bdtotal.'<br>';

$inakhir= mysql_query("insert into akhir(idtempat,c,nakhir) values ('".$idbat2."','1','".$nakhir."')");
	
	}

	
}





//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	$bb=0;
$bjum=mysql_query("select jumseper from sum where idtempat='$idbat2' and c='2' ");
while($databjum = mysql_fetch_array($bjum)){
	$bdjumseper=$databjum['jumseper'];
	
	$total=mysql_query("select total from tempat where id='$idbat2'  ");
while($datatotal = mysql_fetch_array($total)){
	$bdtotal=$datatotal['total'];
	}
	$nakhir=$bdjumseper/$bdtotal;
	
	
//echo $bdjumseper.'--------'.$bdtotal.'<br>';

$inakhir= mysql_query("insert into akhir(idtempat,c,nakhir) values ('".$idbat2."','2','".$nakhir."')");
	
	}

	
}





//sum akhir 
//load data tempat untuk perhitungan  
$bat2=mysql_query("select id from tempat order by id");
while($databat2 = mysql_fetch_array($bat2)){
	$idbat2=$databat2['id'];

	$bb=0;
$bjum=mysql_query("select jumseper from sum where idtempat='$idbat2' and c='3' ");
while($databjum = mysql_fetch_array($bjum)){
	$bdjumseper=$databjum['jumseper'];
	
	$total=mysql_query("select total from tempat where id='$idbat2'  ");
while($datatotal = mysql_fetch_array($total)){
	$bdtotal=$datatotal['total'];
	}
	$nakhir=$bdjumseper/$bdtotal;
	
	
//echo $bdjumseper.'--------'.$bdtotal.'<br>';

$inakhir= mysql_query("insert into akhir(idtempat,c,nakhir) values ('".$idbat2."','3','".$nakhir."')");
	
	}

	
}
header("location:../user.php?menu=hnilai&stt= Simpan Berhasil");
?>