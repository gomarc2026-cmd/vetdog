<?php
class Modelo{

  private $veterinarian;
  private $db;

  public function __construct(){
      $this->veterinarian=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT * FROM veterinarian";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->veterinarian[]=$tabla;
      }
      return $this->veterinarian;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO veterinarian (dnivet,  nomvet)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->dnivet, $data->nomvet));

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
