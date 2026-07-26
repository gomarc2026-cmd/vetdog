<?php
require_once '../modelo/modelocompra.php';
class compracontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $compra=new Modelo();

        $dato=$compra->mostrar("compra", "1");
        require_once '../vista/compra/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/compra/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->fecha=$_POST['txtfecha'];
                $alm->estado=$_POST['txtestado'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: compra.php");

          }


    }
