<?php
	class AccesoDB{
	private static $cnPDO = null;
	
	public static function getConnectionPDO(){
		if( self::$cnPDO == null){
			try{
				$url = 'mysql:host=localhost;dbname=vetdog';
				$user = 'root';
				$pass = '';
				self::$cnPDO = new PDO($url,$user,$pass);
				self::$cnPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$cnPDO->SetAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
				self::$cnPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				} catch (Exception $exc){
						throw $exc;
					}
			}
			return self::$cnPDO;
		}
	}

	date_default_timezone_set("America/Lima");
	
	function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
	}
	
	class adminDAO{
		
		public function allBitacora(){
			try{
				$pdo = AccesoDB::getConnectionPDO();
				
				$sql = "SELECT id_venta, fecha, venta.estado, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.correo, owner.movil, owner.fijo, owner.direc, venta.total, venta.tipoc, venta.tipopa, venta.numtarj, venta.typetarj, venta.nomtarj, venta.expmon, venta.expyear, venta.cvc, venta.recibir, venta.cambio FROM venta INNER JOIN owner ON venta.id_due = owner.id_due WHERE venta.estado='1'  ORDER BY id_venta DESC";
				
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				
				$return = $stmt->fetchAll();
				return $return;
				
			} catch (Exception $e){
				throw $e;
			}	
		}
		
		public function buscarAllBitacoraFecha($desde,$hasta){
			try{
				$pdo = AccesoDB::getConnectionPDO();
				
				$sql = 'SELECT venta.id_venta, venta.fecha, venta.estado, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.correo, owner.movil, owner.fijo, owner.direc, venta.total, venta.tipoc, venta.tipopa, venta.numtarj, venta.typetarj, venta.nomtarj, venta.expmon, venta.expyear, venta.cvc, venta.recibir, venta.cambio FROM venta INNER JOIN owner ON venta.id_due = owner.id_due WHERE  venta.fecha BETWEEN "'.$desde.'" AND "'.$hasta.'" ORDER BY id_venta DESC';
				
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				
				$return = $stmt->fetchAll();
				return $return;
				
			} catch (Exception $e){
				throw $e;
			}	
		}


		public function buscarAllBitacoraFechaA($desde,$hasta){
			try{
				$pdo = AccesoDB::getConnectionPDO();
				
				$sql = 'SELECT id_venta, fecha, venta.estado, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.fecnaci, owner.correo, owner.movil, owner.fijo, owner.direc, venta.total, venta.tipoc, venta.tipopa, venta.numtarj, venta.typetarj, venta.nomtarj, venta.expmon, venta.expyear, venta.cvc, venta.recibir, venta.cambio FROM venta INNER JOIN owner ON venta.id_due = owner.id_due ORDER BY id_venta DESC';
				
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				
				$return = $stmt->fetchAll();
				return $return;
				
			} catch (Exception $e){
				throw $e;
			}	
		}
		
		
		
		
		
		
	}
	
?>