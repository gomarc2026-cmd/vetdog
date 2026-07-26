<?php



$conexion = mysqli_connect("localhost","root","","vetdog");

$query = $conexion->query("SELECT * FROM pet_type");

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['id_tiM']. '">' . $row['noTiM'] . '</option>' . "\n";

}



?>
