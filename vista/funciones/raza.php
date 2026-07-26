<?php

echo '<select name="id_raza" class="form-control show-tick">';
	$conexion = mysqli_connect("localhost","root","","vetdog");
$query = $conexion->query("SELECT * FROM raza");
echo '<option value="0">--Seleccione una raza--</option>';

while ($row = $query->fetch_assoc())
{
	if($row['id_tiM'] == $_GET['c']){
			echo "<option value='".$row['id_raza']."'>".$row['nomraza']."</option>";;
		}

}
echo '</select>';

?>
