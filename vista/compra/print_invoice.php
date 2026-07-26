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
/* COMIENZA */
$id = $_GET['id'];

$archivo="factura-$id.pdf";

require('../compra/fpdf.php');
$archivo_de_salida=$archivo;


$db = new dbConexion();
$connString = $db->getConexion();
$display_heading = array('codigo'=>'Cod', 'nompro'=> 'Productos comprados', 'canti'=> 'Cantidad','preciC'=> 'Precio','total'=> 'Total');

$result = mysqli_query($connString, "SELECT  compra.fecha, compra.id_compra,compra.estado, compra.total, compra.tipoc, compra.tipopa,supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.pais, supplier.tele, supplier.corre,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.preciC, '..', productos_comprados.canti SEPARATOR '__') AS products FROM compra INNER JOIN productos_comprados ON productos_comprados.id_compra = compra.id_compra INNER JOIN products ON products.id_prod = productos_comprados.id_prod INNER JOIN supplier ON compra.id_prove =supplier.id_prove  WHERE compra.id_compra= '$id' GROUP BY compra.id_compra ORDER BY compra.id_compra") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM compra");

$pdf=new FPDF();  //crea el objeto
$pdf->AddPage();  //añadimos una página. Origen coordenadas, esquina superior izquierda, posición por defeto a 1 cm de los bordes.

$pdf->Image('../../assets/img/lll.png' , 0 ,0, 40 , 40,'PNG');

// Encabezado de la factura
foreach($result as $row)
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190, 10, $row['tipoc'], 0, 2, "C");
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(190,5, $row['tipopa']."\n".$row['fecha'], 0, "C", false);
$pdf->Ln(2);


// Datos de la empresa

$pdf->SetFont('Arial','B',12);
$top_datos=45;
$pdf->SetXY(40, $top_datos);
$pdf->Cell(190, 10, "Datos de la empresa:", 0, 2, "J");
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(190, //posición X
5, //posición Y
"VETERINARIA VETDOG S.A.C \n".
"10099876565 \n".
"Castilla el Indio Mz c5\n".
"PIURA",0, "J", 
false);

// Datos del PROVEEDOR

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(125, $top_datos);
$pdf->Cell(190, 10, "Datos del proveedor:", 0, 2, "J");
$pdf->SetFont('Arial','',9);

$pdf->MultiCell(
190, 
5,
"RUC: ".$row['ruc'] ."\n".
"NOMBRE: ".$row['nomprove'] ."\n".
"DIRECCION: ".$row['direcc'] ."\n".
"PAIS: ".$row['pais'] ."\n",

0, // bordes 0 = no | 1 = si
"J", // texto justificado
false);
}
//Salto de línea
$pdf->SetMargins(20,20,20);
$pdf->Ln(2);

//Creación de la tabla de los detalles de los productos productos

//Declaramos el encabezado de la tabla

 $results = mysqli_query($connString, "SELECT productos_comprados.id_pcomp, products.id_prod, products.codigo, products.nompro, products.peso, products.descp, products.preciC, products.precV, products.stock, productos_comprados.canti, compra.id_compra, compra.fecha, compra.total, compra.tipoc, compra.tipopa FROM productos_comprados INNER JOIN products ON productos_comprados.id_prod  = products.id_prod INNER JOIN compra ON productos_comprados.id_compra  =compra.id_compra WHERE compra.id_compra= '$id' GROUP BY productos_comprados.id_pcomp ORDER BY productos_comprados.id_pcomp") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM productos_comprados");

$pdf->SetFont('Arial','B',12, 'UTF-8');

$w = array(30, 120, 35);
$pdf->Cell(30,12,'UNIDADES',1);
$pdf->Cell(120,12,'PRODUCTOS',1);
$pdf->Cell(35,12,'PRECIO UNIT',1);
foreach($results as $rowq)
{


$pdf->Cell(0,2,utf8_decode($rowq['canti']),0,0);
}

ob_end_clean();
$pdf->Output($archivo_de_salida);//cierra el objeto pdf

//Creacion de las cabeceras que generarán el archivo pdf
header ("Content-Type: application/download");
header ("Content-Disposition: attachment; filename=$archivo");
header("Content-Length: " . filesize("$archivo"));
$fp = fopen($archivo, "r");
fpassthru($fp);
fclose($fp);

//Eliminación del archivo en el servidor
unlink($archivo);
?>   
   