<?php
require_once '../modelo/modeloventa.php';
class ventacontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $venta=new Modelo();

        $dato=$venta->mostrar("venta", "1");
        require_once '../vista/venta/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/venta/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->fecha=$_POST['txtfecha'];
                $alm->estado=$_POST['txtestado'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: venta.php");

          }


    }
