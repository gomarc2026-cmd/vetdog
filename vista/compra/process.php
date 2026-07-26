<?php 
session_start();
$con  = new mysqli("localhost","root","","vetdog");
if(!empty($_POST)){
$q1 = $con->query("insert into compra(fecha,estado,id_prove,total,tipoc,tipopa) value(NOW(), \"$_POST[estado]\", \"$_POST[id_prove]\", \"$_POST[total]\", \"$_POST[tipoc]\", \"$_POST[tipopa]\")");
if($q1){
$id_compra = $con->insert_id;
foreach($_SESSION["cart"] as $c){
$q1 = $con->query("insert into productos_comprados(id_prod,canti,id_compra) value($c[id_prod],$c[canti],$id_compra)");
$q1 = $con->query
			("update products SET stock = '$c[stock]' + $c[canti] WHERE id_prod = $c[id_prod];");

			
}
unset($_SESSION["cart"]);
}
}
print "<script>alert('Compra procesada exitosamente');window.location='../../folder/compra';</script>";
?>