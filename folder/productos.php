<?php
require_once '../controlador/productscontrolador.php';
$objprodu=new productscontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objprodu->mostrar();
    elseif ($op=="nuevo")
        $objprodu->nuevo();
    elseif ($op=="guardar")
        $objprodu->guardar();
    elseif ($op=="editar")
        $objprodu->editar();
    elseif($op=="update")
        $objprodu->update();
        elseif($op=="insertar")
            $objprodu->insertar();
        elseif($op=="recibir")
            $objprodu->recibir();
            elseif($op=="eliminar")
                $objprodu->eliminar();
?>
