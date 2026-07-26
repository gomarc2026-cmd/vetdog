<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../compra/adminDAO.php';
$impr = new adminDAO();
$datos = $impr->allBitacora();
?>

<?php 
	if(count($datos)>0){ 
	for($x=0; $x<count($datos); $x++){	 
?>
	<tr>
		<td><?php echo $datos[$x]['tipoc']; ?></td>

		<td><?php echo fechaNormal($datos[$x]['fecha']); ?></td>

		<td><?php echo $datos[$x]['nomprove']; ?></td>

		<td><?php echo $datos[$x]['tipopa']; ?></td>
		<td>S/.<?php echo $datos[$x]['total']; ?></td>

		<td>
                <?php    

                if($datos[$x]['estado']==1)  { ?> 
                <form  method="get" action="javascript:activo('<?php echo $datos[$x]['id_compra']; ?>')">
                   
                    <span class="label label-success">Aceptado</span>
                </form>
                <?php  }   else {?> 

                    <form  method="get" action="javascript:inactivo('<?php echo $datos[$x]['id_compra']; ?>')"> 
                        <button type="submit" class="btn btn-danger btn-xs">Anuladas</button>
                     </form>
                        <?php  } ?>                         
        </td>

        <td>
                <a type="button" data-toggle="modal" href="#delete_<?php echo $datos[$x]['id_compra']; ?>"  class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">close</i>

                </a>
                <?php include('../compra/modal.php'); ?>

                <a type="button" href="../compra/detalles?id=<?php echo $datos[$x]['id_compra']; ?>"  class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">remove_red_eye</i>

                </a>
            </td>

	</tr>

<?php
	}
	}else{
?>
	<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No hay datos disponibles en la tabla</td></tr>
<?php
	}
			
?>

