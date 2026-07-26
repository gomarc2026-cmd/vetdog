<?php
require_once '../controlador/categorycontrolador.php';
$objcate=new categorycontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objcate->mostrar();
    elseif ($op=="nuevo")
        $objcate->nuevo();
    elseif ($op=="guardar")
        $objcate->guardar();
    elseif ($op=="editar")
        $objcate->editar();
    elseif($op=="update")
        $objcate->update();
        elseif($op=="insertar")
            $objcate->insertar();
        elseif($op=="recibir")
            $objcate->recibir();
            elseif($op=="eliminar")
                $objcate->eliminar();
?>
