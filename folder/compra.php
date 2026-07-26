<?php
require_once '../controlador/compracontrolador.php';
$objcompra=new compracontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objcompra->mostrar();
    elseif ($op=="nuevo")
        $objcompra->nuevo();
    elseif ($op=="guardar")
        $objcompra->guardar();
    elseif ($op=="editar")
        $objcompra->editar();
    elseif($op=="update")
        $objcompra->update();
        elseif($op=="insertar")
            $objcompra->insertar();
        elseif($op=="recibir")
            $objcompra->recibir();
            elseif($op=="eliminar")
                $objcompra->eliminar();
?>
