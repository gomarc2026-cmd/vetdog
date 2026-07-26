<?php

$conexion = mysqli_connect("localhost","root","","vetdog");

$query = $conexion->query("SELECT * FROM veterinarian");

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['id_vet']. '">' . $row['nomvet'] . '</option>' . "\n";
}
