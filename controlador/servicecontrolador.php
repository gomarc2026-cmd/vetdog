<?php
require_once '../modelo/modeloservice.php';
class servicecontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $service=new Modelo();

        $dato=$service->mostrar("service", "1");
        require_once '../vista/servicio/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/servicio/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->nomser=$_POST['txtnomser'];
                $alm->estado=$_POST['txtestado'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: service.php");

          }


    }
