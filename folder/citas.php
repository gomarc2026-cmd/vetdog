<?php
require_once '../controlador/quotescontrolador.php';
$objquotes=new quotescontrolador();
$op="mostrar";
if(isset($_REQUEST['op']))
    $op=$_REQUEST['op'];
    if($op=="mostrar")
    $objquotes->mostrar();
    elseif ($op=="nuevo")
        $objquotes->nuevo();
    elseif ($op=="guardar")
        $objquotes->guardar();
    elseif ($op=="editar")
        $objquotes->editar();
    elseif($op=="update")
        $objquotes->update();
        elseif($op=="insertar")
            $objquotes->insertar();
        elseif($op=="recibir")
            $objquotes->recibir();
            elseif($op=="eliminar")
                $objquotes->eliminar();
?>
