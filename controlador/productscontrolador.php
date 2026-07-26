<?php
require_once '../modelo/modeloproducts.php';
class productscontrolador{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $products=new Modelo();

        $dato=$products->mostrar("products", "1");
        require_once '../vista/productos/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../vista/productos/nuevo';
    }
    //aca ando haciendo
    public function recibir(){
                $alm = new Modelo();
                $alm->codigo=$_POST['txtcodigo'];
                $alm->id_cate=$_POST['txtid_cate'];
                
                
     $this->model->insertar($alm);
     //-------------
header("Location: products.php");

          }


    }
