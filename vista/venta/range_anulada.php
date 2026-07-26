<?php
	$conn=mysqli_connect("localhost", "root", "", "vetdog");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
	if(ISSET($_POST['search'])){
		
		
		$date3 = date("Y-m-d", strtotime($_POST['date3']));
		$date4 = date("Y-m-d", strtotime($_POST['date4']));
		$query=mysqli_query($conn, "SELECT  venta.fecha, venta.id_venta,venta.estado, venta.total,venta.tipoc, venta.tipopa, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.movil, owner.fijo, owner.correo, owner.direc,venta.numtarj, venta.typetarj, venta.nomtarj, venta.expmon, venta.expyear, venta.cvc, venta.recibir , venta.cambio,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.precV, '..', productos_vendidos.canti SEPARATOR '__') AS products FROM venta INNER JOIN productos_vendidos ON productos_vendidos.id_venta = venta.id_venta INNER JOIN products ON products.id_prod = productos_vendidos.id_prod INNER JOIN owner ON venta.id_due =owner.id_due WHERE venta.fecha  BETWEEN '$date3' AND '$date4' GROUP BY venta.id_venta DESC") 


		or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['tipoc']?></td>
		
		<td><?php echo $fetch['fecha']?></td>
		<td><?php echo $fetch['nom_due']?> &nbsp;<?php echo $fetch['ape_due']?></td>
		<td><?php echo $fetch['tipopa']?></td>
		<td>S/.<?php echo $fetch['total']?></td>

		<td>
                <?php    

                if($fetch['estado']==1)  { ?> 
                <form  method="get" action="javascript:activo('<?php echo $fetch['id_venta']; ?>')">
                   
                    <span class="label label-success">Aceptado</span>
                </form>
                <?php  }   else {?> 

                    <form  method="get" action="javascript:inactivo('<?php echo $fetch['id_venta']; ?>')"> 
                        <button type="submit" class="btn btn-danger btn-xs">Anuladas</button>
                     </form>
                        <?php  } ?>                         
        </td>

        <td>
              

                <a type="button" href="../venta/detalles?id=<?php echo $fetch['id_venta']; ?>"  class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
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
		$query=mysqli_query($conn, "SELECT  venta.fecha, venta.id_venta,venta.estado, venta.total,venta.tipoc, venta.tipopa, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.movil, owner.fijo, owner.correo, owner.direc,venta.numtarj, venta.typetarj, venta.nomtarj, venta.expmon, venta.expyear, venta.cvc, venta.recibir , venta.cambio,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.precV, '..', productos_vendidos.canti SEPARATOR '__') AS products FROM venta INNER JOIN productos_vendidos ON productos_vendidos.id_venta = venta.id_venta INNER JOIN products ON products.id_prod = productos_vendidos.id_prod INNER JOIN owner ON venta.id_due =owner.id_due WHERE venta.estado = '0' GROUP BY venta.id_venta DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['tipoc']?></td>
		
		<td><?php echo $fetch['fecha']?></td>
		<td><?php echo $fetch['nom_due']?> &nbsp;<?php echo $fetch['ape_due']?></td>
		<td><?php echo $fetch['tipopa']?></td>
		<td>S/.<?php echo $fetch['total']?></td>

		<td>
                <?php    

                if($fetch['estado']==1)  { ?> 
                <form  method="get" action="javascript:activo('<?php echo $fetch['id_venta']; ?>')">
                   
                    <span class="label label-success">Aceptado</span>
                </form>
                <?php  }   else {?> 

                    <form  method="get" action="javascript:inactivo('<?php echo $fetch['id_venta']; ?>')"> 
                        <button type="submit" class="btn btn-danger btn-xs">Anuladas</button>
                     </form>
                        <?php  } ?>                         
        </td>

        <td>
             
                <a type="button" href="../venta/detalles?id=<?php echo $fetch['id_venta']; ?>"  class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">remove_red_eye</i>

                </a>


            </td>

	</tr>
<?php
		}
	}
?>
