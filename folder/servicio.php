<?php
require_once '../controlador/servicecontrolador.php';
$objservice=new servicecontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objservice->mostrar();
    elseif ($op=="nuevo")
        $objservice->nuevo();
    elseif ($op=="guardar")
        $objservice->guardar();
    elseif ($op=="editar")
        $objservice->editar();
    elseif($op=="update")
        $objservice->update();
        elseif($op=="insertar")
            $objservice->insertar();
        elseif($op=="recibir")
            $objservice->recibir();
            elseif($op=="eliminar")
                $objservice->eliminar();
?>
