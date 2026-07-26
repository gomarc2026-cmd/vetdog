<?php
	session_start();
	Class Connection{
 
	private $server = "mysql:host=localhost;dbname=vetdog";
	private $username = "root";
	private $password = "";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "Hubo un problema con la conexión: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

	if(isset($_POST['update'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$noemp = $_POST['noemp'];
			$ruc = $_POST['ruc'];
			$direcc = $_POST['direcc'];
			$correo = $_POST['correo'];
			$telef = $_POST['telef'];
			$descp = $_POST['descp'];

			$foto = $_FILES['foto']['name'];
			

			$sql = "UPDATE business SET noemp = '$noemp', ruc = '$ruc',direcc = '$direcc',correo = '$correo',telef = '$telef',descp = '$descp',foto = '$foto'  WHERE id_buss = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Actualizada correctamente' : 'No se puso actualizar';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar la conexión
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}


	header('Location: ../panel-admin/administrador'); 

?>

<?php
   $db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "vetdog";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}
   $foto = $_FILES['foto'];

 
  

// Cargando el fichero en la carpeta "subidas"
move_uploaded_file($foto['tmp_name'], "../../assets/img/subidas/".$foto['name']);



		?>