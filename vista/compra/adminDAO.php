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
				
				$sql = "SELECT id_compra, fecha, compra.estado,supplier.id_prove, supplier.nomprove, supplier.nomprove, supplier.direcc, total, tipoc, tipopa FROM compra INNER JOIN supplier ON compra.id_prove = supplier.id_prove WHERE compra.estado='1'  ORDER BY id_compra DESC";
				
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
				
				$sql = 'SELECT compra.id_compra, compra.fecha,compra.estado ,supplier.id_prove, supplier.nomprove, supplier.nomprove, supplier.direcc, compra.total, compra.tipoc, compra.tipopa FROM compra INNER JOIN supplier ON compra.id_prove = supplier.id_prove WHERE  compra.fecha BETWEEN "'.$desde.'" AND "'.$hasta.'" ORDER BY id_compra DESC';
				
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
				
				$sql = 'SELECT id_compra, fecha, supplier.id_prove, supplier.nomprove, supplier.nomprove, supplier.direcc, total, tipoc, tipopa FROM compra INNER JOIN supplier ON compra.id_prove = supplier.id_prove ORDER BY id_compra DESC';
				
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