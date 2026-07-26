
<?php
Class dbConexion{
/* Variables de conexion */
var $dbhost = "localhost";
var $username = "root";
var $password = "";
var $dbname = "vetdog";
var $conn;
//Funcion de conexion MySQL
function getConexion() {
$con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

/* Revisamos la conexion */
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
} else {
$this->conn = $con;
}
return $this->conn;
}
}
//Incluimos la libreria PDF
include_once('../../assets/fpdf/fpdf.php');
$id = $_GET['id'];
$db = new dbConexion();
$connString = $db->getConexion();
$display_heading = array('codigo'=>'Cod', 'nompro'=> 'Productos comprados', 'canti'=> 'Cantidad','preciC'=> 'Precio','total'=> 'Total');

$result = mysqli_query($connString, "SELECT  compra.fecha, compra.id_compra,compra.estado, compra.total, compra.tipoc, compra.tipopa,supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.pais, supplier.tele, supplier.corre,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.preciC, '..', productos_comprados.canti SEPARATOR '__') AS products FROM compra INNER JOIN productos_comprados ON productos_comprados.id_compra = compra.id_compra INNER JOIN products ON products.id_prod = productos_comprados.id_prod INNER JOIN supplier ON compra.id_prove =supplier.id_prove  WHERE compra.id_compra= '$id' GROUP BY compra.id_compra ORDER BY compra.id_compra") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM compra");


$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);
// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"VETERINARIA VETDOG S.A.C");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);

///-------------------------------------ACA COMENZAMOS A PONER-----------

foreach($result as $row)
{

$pdf->Cell(5,$textypos,"VETERINARIA VETDOG S.A.C");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Piura");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"9998484888");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"vetdog@gmail.com");
// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(75);
$pdf->Cell(5,$textypos,"PARA:");

$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(75);
$pdf->Cell(5,$textypos,$row['ruc']);

$pdf->setY(40);$pdf->setX(75);
$pdf->Cell(5,$textypos,$row['nomprove']);
$pdf->setY(45);$pdf->setX(75);



$pdf->Cell(5,$textypos,$row['direcc']);
$pdf->setY(50);$pdf->setX(75);
$pdf->Cell(5,$textypos,$row['corre']);

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos, $row['tipoc']);
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,$row['fecha'] );


$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

///------------------------------------- Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
}

$results = mysqli_query($connString, "SELECT productos_comprados.id_pcomp, products.id_prod, products.codigo, products.nompro, products.peso, products.descp, products.preciC, products.precV, products.stock, productos_comprados.canti, compra.id_compra, compra.fecha, compra.total, compra.tipoc, compra.tipopa FROM productos_comprados INNER JOIN products ON productos_comprados.id_prod  = products.id_prod INNER JOIN compra ON productos_comprados.id_compra  =compra.id_compra WHERE compra.id_compra= '$id' GROUP BY productos_comprados.id_pcomp ORDER BY productos_comprados.id_pcomp") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM productos_comprados");



$pdf->SetFont('Arial','B',12, 'UTF-8');

$w = array(98, 20, 30);
//Declaramos el encabezado de la tabla

$pdf->Cell(98,12,'DESCRIPCION',1);
$pdf->Cell(20,12,'CANT',1);
$pdf->Cell(30,12,'PRECIO UNI.',1);
 
$pdf->Ln();
$pdf->SetFont('Arial','',12, 'UTF-8');

foreach($results as $rowq)
{
    
    
}

foreach(explode('__', $row['products']) as $articulosConcatenados){ 
    $products = explode("..", $articulosConcatenados)

    $pdf->Cell($w[0],6,$products['0'],1);

}



$pdf->Ln();
$pdf->setX(10);
$pdf->Cell(5,$textypos,"GRACIAS POR SU COMPRA");
$pdf->SetFont('Arial','',10);    

 


   

ob_end_clean();
$pdf->Output('reportes.pdf', 'D');
?>