<?php
class Modelo{

  private $pet_type;
  private $db;

  public function __construct(){
      $this->pet_type=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT * FROM pet_type";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->pet_type[]=$tabla;
      }
      return $this->pet_type;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO pet_type (noTiM, estado)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->noTiM, $data->estado));

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
