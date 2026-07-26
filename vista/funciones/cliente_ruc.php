<?php

echo '<label class="control-label">DNI del cliente</label><select readonly="" name="id_due" class="form-control form-control-line" id="id_due">';





	$conexion = mysqli_connect("localhost","root","","vetdog");
$query = $conexion->query("SELECT * FROM owner");


while ($row = $query->fetch_assoc())
{
	if($row['id_due'] == $_GET['c']){
			echo " <option  value='".$row['id_due']."'>".$row['nom_due']." </option>";
		}

}
echo '</select>';

?>
