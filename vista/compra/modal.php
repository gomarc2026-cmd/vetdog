
    <!-- ELIMINAR -->
    <div class="modal fade" id="delete_<?php echo $datos[$x]['id_compra']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               
            </div>

    <div class="sa-icon sa-warning pulseWarning" style="display: block;">
      <svg class="svg-icon" viewBox="0 0 17 16" style="margin-left:95px;" width="100"
                height="100">
             <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>                
        </svg>
    </div>

            <div class="modal-body">    
                <p class="text-center"><strong>¿Está seguro que desea anular la transacción?</strong></p>
                <h3 style="color:black" class="text-center">Este proceso es irreversible!</h3>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secundary" data-dismiss="modal">No, volver atras</button>
                
                <a href="../compra/anular?id=<?php echo $datos[$x]['id_compra']; ?>" class="btn btn-danger">Sí, anular</a>
            </div>

        </div>
    </div>
</div>

    <!-- NUEVO  -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               
            </div>

    
            <div class="modal-body">
                <div class="container-fluid">
            
            <form method="POST"  autocomplete="off" enctype="multipart/form-data">

                <div class="col-sm-8">
                    <label class="control-label">RUC del proveedor<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="documento"  name="ruc"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="14" class="form-control" placeholder="RUC del proveedor..." />
                                        </div>
                                    </div>

                                     <button type="button" class="btn btn-default" id="buscar"><i class="material-icons">search</i></button>   
                </div>

                 <div class="col-sm-12">
                    <label class="control-label">Nombre del proveedor<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nomprove" id="nombre" readonly  class="form-control" placeholder="Nombre del proveedor..." />
                                        </div>
                                    </div>
                </div>


                <div class="col-sm-12">
                    <label class="control-label">Direccion del proveedor<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="direccion" name="direcc" readonly  class="form-control" placeholder="Direccion del proveedor..." />
                                        </div>
                                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="control-label">Provincia del proveedor<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="provincia" name="pais" readonly  class="form-control" placeholder="Provincia del proveedor..." />
                                        </div>
                                    </div>
                </div>


                <div class="row form-group" style="display:none;">
                    <div class="col-sm-2">
                        <label class="control-label" style="position:relative; top:7px;">Estado:</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" value="1" class="form-control" name="estado">
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secundary" data-dismiss="modal">No, cancelar</button>
                
                 <button class="btn bg-red" name="agregar" style="margin-top:10px;">Sí, agregar</button>
            </div>
            
     </form> 
                </div>
            


        </div>

            

        </div>
    </div>
</div>