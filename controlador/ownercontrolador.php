<?php
require_once '../modelo/modeloowner.php';
class ownercontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $owner=new Modelo();

        $dato=$owner->mostrar("owner", "1");
        require_once '../vista/clientes/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/clientes/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->dni_due=$_POST['txtdni_due'];
                $alm->nom_due=$_POST['txtnom_due'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: clientes.php");

          }


    }
