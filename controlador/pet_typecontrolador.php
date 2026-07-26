<?php
require_once '../modelo/modelopet_type.php';
class pet_typecontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $pet_type=new Modelo();

        $dato=$pet_type->mostrar("pet_type", "1");
        require_once '../vista/tipo/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/tipo/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->noTiM=$_POST['txtnoTiM'];
                $alm->estado=$_POST['txtestado'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: pet_type.php");

          }


    }
