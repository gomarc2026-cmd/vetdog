<?php
/*
* Eliminar un producto del carrito
*/
session_start();
if(!empty($_SESSION["carts"])){
	$carts  = $_SESSION["carts"];
	if(count($carts)==1){ unset($_SESSION["carts"]); }
	else{
		$newcart = array();
		foreach($carts as $c){
			if($c["id_prod"]!=$_GET["id"]){
				$newcart[] = $c;
			}
		}
		$_SESSION["carts"] = $newcart;
	}
}
print "<script>window.location='cart';</script>";

?>

