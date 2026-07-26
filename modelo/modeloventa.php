<?php
class Modelo{

  private $venta;
  private $db;

  public function __construct(){
      $this->venta=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT venta.id_venta,venta.fecha, venta.estado, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.movil, owner.fijo, owner.correo, owner.direc, venta.total, venta.tipoc, venta.tipopa, venta.numtarj, venta.nomtarj FROM venta INNER JOIN owner ON venta.id_due  =  owner.id_due";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->venta[]=$tabla;
      }
      return $this->venta;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO venta (fecha, estado)VALUES(?,?)";

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
