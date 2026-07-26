<?php
class Modelo{

  private $pet;
  private $db;

  public function __construct(){
      $this->quotes=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT quotes.id, veterinarian.id_vet, veterinarian.dnivet, veterinarian.nomvet, veterinarian.apevet, pet_type.id_tiM, pet_type.noTiM, service.id_servi, service.nomser, quotes.title, quotes.nommas, quotes.dueno, quotes.color, quotes.start, quotes.end, quotes.estado FROM quotes INNER JOIN veterinarian ON quotes.id_vet = veterinarian.id_vet INNER JOIN pet_type ON quotes.id_tiM = pet_type.id_tiM INNER JOIN service ON quotes.id_servi = service.id_servi";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->quotes[]=$tabla;
      }
      return $this->quotes;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO quotes (id_vet, id_tiM)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->id_vet, $data->id_tiM));

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
