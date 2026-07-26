<?php
require_once '../controlador/razacontrolador.php';
$objraza=new razacontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objraza->mostrar();
    elseif ($op=="nuevo")
        $objraza->nuevo();
    elseif ($op=="guardar")
        $objraza->guardar();
    elseif ($op=="editar")
        $objraza->editar();
    elseif($op=="update")
        $objraza->update();
        elseif($op=="insertar")
            $objraza->insertar();
        elseif($op=="recibir")
            $objraza->recibir();
            elseif($op=="eliminar")
                $objraza->eliminar();
?>
