<?php

echo '<label class="control-label">Telefono del proveedor</label><select name="tele" class="form-control form-control-line" id="tele">';





	$conexion = mysqli_connect("localhost","root","","vetdog");
$query = $conexion->query("SELECT * FROM supplier");


while ($row = $query->fetch_assoc())
{
	if($row['id_prove'] == $_GET['c']){
			echo "<option value='".$row['id_prove']."'>".$row['tele']."</option>";
		}

}
echo '</select>';

?>
