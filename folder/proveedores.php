<?php
require_once '../controlador/suppliercontrolador.php';
$objsupplier=new suppliercontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objsupplier->mostrar();
    elseif ($op=="nuevo")
        $objsupplier->nuevo();
    elseif ($op=="guardar")
        $objsupplier->guardar();
    elseif ($op=="editar")
        $objsupplier->editar();
    elseif($op=="update")
        $objsupplier->update();
        elseif($op=="insertar")
            $objsupplier->insertar();
        elseif($op=="recibir")
            $objsupplier->recibir();
            elseif($op=="eliminar")
                $objsupplier->eliminar();
?>
