<?php
class Modelo{

  private $raza;
  private $db;

  public function __construct(){
      $this->raza=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT raza.nomraza, raza.id_raza, pet_type.id_tiM, pet_type.noTiM, raza.estado FROM raza INNER JOIN pet_type ON raza.id_tiM = pet_type.id_tiM";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->raza[]=$tabla;
      }
      return $this->raza;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO raza (nomraza, id_tiM)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->nomraza, $data->id_tiM));

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
