<?php

echo '<label class="control-label">RUC del proveedor</label><select readonly="" name="id_prove" class="form-control form-control-line" id="id_prove">';





	$conexion = mysqli_connect("localhost","root","","vetdog");
$query = $conexion->query("SELECT * FROM supplier");


while ($row = $query->fetch_assoc())
{
	if($row['id_prove'] == $_GET['c']){
			echo " <option  value='".$row['id_prove']."'>".$row['id_prove']."</option>";
		}

}
echo '</select>';

?>
