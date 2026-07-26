<?php
require_once '../controlador/ownercontrolador.php';
$objowner=new ownercontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objowner->mostrar();
    elseif ($op=="nuevo")
        $objowner->nuevo();
    elseif ($op=="guardar")
        $objowner->guardar();
    elseif ($op=="editar")
        $objowner->editar();
    elseif($op=="update")
        $objowner->update();
        elseif($op=="insertar")
            $objowner->insertar();
        elseif($op=="recibir")
            $objowner->recibir();
            elseif($op=="eliminar")
                $objowner->eliminar();
?>
