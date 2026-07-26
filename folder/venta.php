<?php
require_once '../controlador/ventacontrolador.php';
$objventa=new ventacontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objventa->mostrar();
    elseif ($op=="nuevo")
        $objventa->nuevo();
    elseif ($op=="guardar")
        $objventa->guardar();
    elseif ($op=="editar")
        $objventa->editar();
    elseif($op=="update")
        $objventa->update();
        elseif($op=="insertar")
            $objventa->insertar();
        elseif($op=="recibir")
            $objventa->recibir();
            elseif($op=="eliminar")
                $objventa->eliminar();
?>
