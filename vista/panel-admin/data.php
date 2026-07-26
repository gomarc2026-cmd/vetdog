<?php
	$db_host="localhost";//Nombre del host
	$db_user="root";//Usuario de la base de datos
	$db_pass="";//Contraseña de usuario de base de datos
	$db_name="vetdog";//Nombre de la base de datos
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
 
	if ($conn->connect_error) {
	    die("Conexión falló: " . $conn->connect_error);
	}

	//set timezone
	date_default_timezone_set('America/El_Salvador');
	$year = date('Y');
	$total=array();
	for ($month = 1; $month <= 12; $month ++){
		$sql="select *, sum(total) as total from venta where month(fecha)='$month' and year(fecha)='$year'";
		$query=$conn->query($sql);
		$row=$query->fetch_array();

		$total[]=$row['total'];
	}

	$tjan = $total[0];
	$tfeb = $total[1];
	$tmar = $total[2];
	$tapr = $total[3];
	$tmay = $total[4];
	$tjun = $total[5];
	$tjul = $total[6];
	$taug = $total[7];
	$tsep = $total[8];
	$toct = $total[9];
	$tnov = $total[10];
	$tdec = $total[11];

	$pyear = $year - 1;
	$pnum=array();

	for ($pmonth = 1; $pmonth <= 12; $pmonth ++){
		$sql="select *, sum(total) as ptotal from compra where month(fecha)='$pmonth' and year(fecha)='$year'";
		$pquery=$conn->query($sql);
		$prow=$pquery->fetch_array();

		$ptotal[]=$prow['ptotal'];
	}
	
	$pjan = $ptotal[0];
	$pfeb = $ptotal[1];
	$pmar = $ptotal[2];
	$papr = $ptotal[3];
	$pmay = $ptotal[4];
	$pjun = $ptotal[5];
	$pjul = $ptotal[6];
	$paug = $ptotal[7];
	$psep = $ptotal[8];
	$poct = $ptotal[9];
	$pnov = $ptotal[10];
	$pdec = $ptotal[11];
?>