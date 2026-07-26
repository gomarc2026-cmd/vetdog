<?php
require_once '../controlador/petcontrolador.php';
$objpet=new petcontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objpet->mostrar();
    elseif ($op=="nuevo")
        $objpet->nuevo();
    elseif ($op=="guardar")
        $objpet->guardar();
    elseif ($op=="editar")
        $objpet->editar();
    elseif($op=="update")
        $objpet->update();
        elseif($op=="insertar")
            $objpet->insertar();
        elseif($op=="recibir")
            $objpet->recibir();
            elseif($op=="eliminar")
                $objpet->eliminar();
?>
