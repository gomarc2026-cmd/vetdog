<?php
require_once '../modelo/modelocategory.php';
class categorycontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $category=new Modelo();

        $dato=$category->mostrar("category", "1");
        require_once '../vista/categorias/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/categorias/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->nomcate=$_POST['txtnomcate'];
                $alm->estado=$_POST['txtestado'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: category.php");

          }


    }
