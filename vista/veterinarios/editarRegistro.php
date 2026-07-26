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
           
            
            $dnivet  = $_POST['dnivet'];
            $nomvet =htmlspecialchars($_POST['nomvet']);
            $apevet =htmlspecialchars($_POST['apevet']);
            $direcc=$_POST['direcc'];
            $sexo=$_POST['sexo'];
            $correo=$_POST['correo'];
            $fijo=$_POST['fijo'];
            $movil=$_POST['movil'];
            $usuario=$_POST['usuario'];

           
            
$sql = "UPDATE veterinarian SET dnivet = '$dnivet', nomvet = '$nomvet', apevet = '$apevet', direcc = '$direcc', sexo = '$sexo', correo = '$correo',fijo = '$fijo',movil = '$movil',usuario = '$usuario' WHERE  id_vet  = '$id'";
            //if-else statement in executing our query
            $_SESSION['message'] = ( $db->exec($sql) ) ? 'Veterinario actualizado correctamente' : 'No se puso actualizar el veterinario';

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

    header('location: ../../folder/veterinarios');

?>