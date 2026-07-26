<?php
class Modelo{

  private $supplier;
  private $db;

  public function __construct(){
      $this->supplier=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT * FROM supplier";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->supplier[]=$tabla;
      }
      return $this->supplier;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO supplier (nomprove, ruc)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->nomprove, $data->ruc));

    }catch (Exception $e) {

      die($e->getMessage());
    }
    }
	
  public function actualizar($tabla,$data,$condicion){
      $consulta="UPDATE $tabla SET $data WHERE $condicion";
      $resultado=$this->db->query($consulta);
      if($resultado){
          return true;
      }else{
          return false;
      }
  }
  public function eliminar($tabla,$condicion){
      $consulta="DELETE FROM $tabla WHERE $condicion";
      $resultado=$this->db->query($consulta);
      if($resultado){
          return true;
      }else{
          return false;
      }
  }
}

 ?>
