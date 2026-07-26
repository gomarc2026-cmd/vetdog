<?php
class Modelo{

  private $owner;
  private $db;

  public function __construct(){
      $this->owner=array();
      $this->db = new PDO('mysql:host=mysql-2f8d2d20-gomarc-7589.b.aivencloud.com;port=16189;dbname=defaultdb;charset=utf8mb4', "avnadmin", "AVNS_4MBCc7IoLnFTUGHDU_R");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT * FROM owner";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->owner[]=$tabla;
      }
      return $this->owner;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO owner (dni_due,  nom_due )VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->dni_due, $data->nom_due));

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
