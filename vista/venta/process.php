<?php 
session_start();
$con  = new mysqli("localhost","root","","vetdog");
if(!empty($_POST)){
$q1 = $con->query("insert into venta(fecha,numfact,estado,id_due,total,tipoc,tipopa,numtarj,typetarj,nomtarj,expmon,expyear,cvc,recibir,cambio) 
	value(NOW(), \"$_POST[numfact]\",\"$_POST[estado]\", \"$_POST[id_due]\", \"$_POST[total]\", \"$_POST[tipoc]\", \"$_POST[tipopa]\", \"$_POST[numtarj]\", \"$_POST[typetarj]\" ,\"$_POST[nomtarj]\", \"$_POST[expmon]\" , \"$_POST[expyear]\",\"$_POST[cvc]\" ,\"$_POST[recibir]\", \"$_POST[cambio]\")");
if($q1){
$id_venta = $con->insert_id;
foreach($_SESSION["carts"] as $c){
$q1 = $con->query("insert into productos_vendidos(id_prod,canti,id_venta) value($c[id_prod],$c[canti],$id_venta)");
$q1 = $con->query
			("update products SET stock = '$c[stock]' - $c[canti] WHERE id_prod = $c[id_prod];");

			
}
unset($_SESSION["carts"]);
}
}
print "<script>alert('Venta procesada exitosamente');window.location='../../folder/venta';</script>";
?>