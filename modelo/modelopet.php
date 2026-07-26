<?php
class Modelo{

  private $pet;
  private $db;

  public function __construct(){
      $this->pet=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT pet.id_pet, pet.nomas, pet_type.id_tiM, pet_type.noTiM, raza.id_raza, raza.nomraza, pet.sexo, pet.edad, pet.tamano, pet.peso, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.movil, owner.fijo, owner.correo, owner.direc, pet.obser, pet.estado, pet.fere FROM pet INNER JOIN pet_type ON pet.id_tiM =  pet_type.id_tiM INNER JOIN raza ON pet.id_raza =raza.id_raza INNER JOIN owner ON pet.id_due = owner.id_due";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->pet[]=$tabla;
      }
      return $this->pet;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO pet (nomas, id_tiM)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->nomas, $data->id_tiM));

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
