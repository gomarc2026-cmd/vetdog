<?php
require_once '../controlador/veterinariancontrolador.php';
$objvete=new veterinariancontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objvete->mostrar();
    elseif ($op=="nuevo")
        $objvete->nuevo();
    elseif ($op=="guardar")
        $objvete->guardar();
    elseif ($op=="editar")
        $objvete->editar();
    elseif($op=="update")
        $objvete->update();
        elseif($op=="insertar")
            $objvete->insertar();
        elseif($op=="recibir")
            $objvete->recibir();
            elseif($op=="eliminar")
                $objvete->eliminar();
?>
