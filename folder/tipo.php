<?php
require_once '../controlador/pet_typecontrolador.php';
$objtipo=new pet_typecontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objtipo->mostrar();
    elseif ($op=="nuevo")
        $objtipo->nuevo();
    elseif ($op=="guardar")
        $objtipo->guardar();
    elseif ($op=="editar")
        $objtipo->editar();
    elseif($op=="update")
        $objtipo->update();
        elseif($op=="insertar")
            $objtipo->insertar();
        elseif($op=="recibir")
            $objtipo->recibir();
            elseif($op=="eliminar")
                $objtipo->eliminar();
?>
