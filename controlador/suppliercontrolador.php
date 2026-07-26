<?php
require_once '../modelo/modelosupplier.php';
class suppliercontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $supplier=new Modelo();

        $dato=$supplier->mostrar("supplier", "1");
        require_once '../vista/proveedores/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/proveedores/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->nomprove=$_POST['txtnomprove'];
                $alm->ruc=$_POST['txtruc'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: proveedores.php");

          }


    }
