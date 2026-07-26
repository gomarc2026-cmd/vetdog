<?php
require_once '../modelo/modelopet.php';
class petcontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $pet=new Modelo();

        $dato=$pet->mostrar("pet", "1");
        require_once '../vista/mascotas/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/clientes/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->nomas=$_POST['txtnomas'];
                $alm->id_tiM=$_POST['txtid_tiM'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: mascotas.php");

          }


    }
