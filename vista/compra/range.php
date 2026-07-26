<?php
	$conn=mysqli_connect("localhost", "root", "", "vetdog");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
	if(ISSET($_POST['search'])){
		
		
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT compra.fecha, compra.id_compra,compra.estado, compra.total,compra.tipoc, compra.tipopa, supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.pais, supplier.tele, supplier.corre,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.preciC, '..', productos_comprados.canti SEPARATOR '__') AS products FROM compra INNER JOIN productos_comprados ON productos_comprados.id_compra = compra.id_compra INNER JOIN products ON products.id_prod = productos_comprados.id_prod INNER JOIN supplier ON compra.id_prove =supplier.id_prove WHERE compra.fecha  BETWEEN '$date1' AND '$date2' GROUP BY compra.id_compra") 


		or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['tipoc']?></td>
		
		<td><?php echo $fetch['fecha']?></td>
		<td><?php echo $fetch['nomprove']?></td>
		<td><?php echo $fetch['tipopa']?></td>
		<td>S/.<?php echo $fetch['total']?></td>

		<td>
                <?php    

                if($fetch['estado']==1)  { ?> 
                <form  method="get" action="javascript:activo('<?php echo $fetch['id_compra']; ?>')">
                   
                    <span class="label label-success">Aceptado</span>
                </form>
                <?php  }   else {?> 

                    <form  method="get" action="javascript:inactivo('<?php echo $fetch['id_compra']; ?>')"> 
                        <button type="submit" class="btn btn-danger btn-xs">Anuladas</button>
                     </form>
                        <?php  } ?>                         
        </td>

        <td>
                <a type="button" data-toggle="modal" href="#delete_<?php echo $fetch['id_compra']; ?>"  class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">close</i>

                </a>
                <?php include('../compra/modal.php'); ?>

                <a type="button" href="../compra/detalles?id=<?php echo $fetch['id_compra']; ?>"  class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">remove_red_eye</i>

                </a>
            </td>

	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "4"><center>No hay asistencias en el rango de fechas</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conn, "SELECT compra.fecha, compra.id_compra,compra.estado, compra.total,compra.tipoc, compra.tipopa, supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.pais, supplier.tele, supplier.corre,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.preciC, '..', productos_comprados.canti SEPARATOR '__') AS products FROM compra INNER JOIN productos_comprados ON productos_comprados.id_compra = compra.id_compra INNER JOIN products ON products.id_prod = productos_comprados.id_prod INNER JOIN supplier ON compra.id_prove =supplier.id_prove WHERE compra.estado = '1' GROUP BY compra.id_compra") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['tipoc']?></td>
		
		<td><?php echo $fetch['fecha']?></td>
		<td><?php echo $fetch['nomprove']?></td>
		<td><?php echo $fetch['tipopa']?></td>
		<td>S/.<?php echo $fetch['total']?></td>

		<td>
                <?php    

                if($fetch['estado']==1)  { ?> 
                <form  method="get" action="javascript:activo('<?php echo $fetch['id_compra']; ?>')">
                   
                    <span class="label label-success">Aceptado</span>
                </form>
                <?php  }   else {?> 

                    <form  method="get" action="javascript:inactivo('<?php echo $fetch['id_compra']; ?>')"> 
                        <button type="submit" class="btn btn-danger btn-xs">Anuladas</button>
                     </form>
                        <?php  } ?>                         
        </td>

        <td>
                <a type="button" data-toggle="modal" href="#delete_<?php echo $fetch['id_compra']; ?>"  class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">close</i>

                </a>
<?php include('../compra/modal.php'); ?>
               
                 <a type="button" href="../compra/detalles?id=<?php echo $fetch['id_compra']; ?>"  class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">remove_red_eye</i>

                </a>
            </td>

	</tr>
<?php
		}
	}
?>
