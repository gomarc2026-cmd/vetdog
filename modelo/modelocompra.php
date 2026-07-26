<?php
class Modelo{

  private $compra;
  private $db;

  public function __construct(){
      $this->compra=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT compra.id_compra, compra.fecha, compra.estado, supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.corre, supplier.tele FROM compra INNER JOIN supplier ON compra.id_prove = supplier.id_prove";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->compra[]=$tabla;
      }
      return $this->compra;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO compra (fecha, estado)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->fecha, $data->estado));

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
