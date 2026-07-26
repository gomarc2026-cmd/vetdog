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
           
            
            $nomas = $_POST['nomas'];
            $sexo = $_POST['sexo'];
            $edad = $_POST['edad'];
            $id_due = $_POST['id_due'];
            $tamano = $_POST['tamano'];
            $peso = $_POST['peso'];
            $obser = $_POST['obser'];
            
$sql = "UPDATE pet SET nomas = '$nomas',sexo = '$sexo',edad = '$edad',id_due = '$id_due',tamano = '$tamano',peso = '$peso',obser = '$obser' WHERE  id_pet  = '$id'";
            //if-else statement in executing our query
            $_SESSION['message'] = ( $db->exec($sql) ) ? 'Mascota actualizado correctamente' : 'No se puso actualizar ñla mascota';

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

    header('location: ../../folder/mascotas');

?>