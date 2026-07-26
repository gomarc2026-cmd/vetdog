
<?php
//Incluimos el fichero de conexion
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

class PDF extends FPDF
{
// Funcion encargado de realizar el encabezado
function Header()
{
// Logo



$this->SetFont('Arial','B',13);
// Move to the right
$this->Cell(80);
// Title

// Line break
$this->Ln(20);


}
// Funcion pie de pagina
function Footer()
{
// Position at 1.5 cm from bottom
$this->SetY(-15);
// Arial italic 8
$this->SetFont('Arial','I',8);
// Page number
$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
//-----------------------------------
}


$id = $_GET['id'];
$archivo="reporte-$id.pdf";
$archivo_de_salida=$archivo;
$db = new dbConexion();
$connString = $db->getConexion();
$display_heading = array('canti'=>'UNIDADES', 'nompro'=> 'PRODUCTOS', 'preciC'=> 'PRECIO UNIT');

$result = mysqli_query($connString, "SELECT  compra.fecha, compra.id_compra,compra.estado, compra.total, compra.tipoc, compra.tipopa,supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.pais, supplier.tele, supplier.corre,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.preciC, '..', productos_comprados.canti SEPARATOR '__') AS products FROM compra INNER JOIN productos_comprados ON productos_comprados.id_compra = compra.id_compra INNER JOIN products ON products.id_prod = productos_comprados.id_prod INNER JOIN supplier ON compra.id_prove =supplier.id_prove  WHERE compra.id_compra= '$id' GROUP BY compra.id_compra ORDER BY compra.id_compra") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM compra");

$pdf = new PDF('L','mm','A4');

//header
$pdf->AddPage();

foreach($result as $row)
{


$pdf->SetFont('Arial','B',10);
////$pdf->MultiCell(190,5, $row['tipopa']."\n".$row['fecha'], 0, "C", false);

$pdf->MultiCell(190,5,utf8_decode("Número de factura: ")."\n"."Fecha: ".$row['fecha'], 0, "C", false);


$pdf->Ln(2);


// Datos de la empresa

$pdf->SetFont('Arial','B',14);
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

$pdf->SetFont('Arial','B',14);
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
$pdf->Ln(2);
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);

// Declaramos el ancho de las columnas
$w = array(35, 210, 35);
//Declaramos el encabezado de la tabla
$pdf->Cell(35,12,'CANT',1);
$pdf->Cell(210,12,'PRODUCTOS',1);
$pdf->Cell(35,12,'PRECIO UNIT',1);
$pdf->Ln();

$results = mysqli_query($connString, "SELECT productos_comprados.id_pcomp, products.id_prod, products.codigo, products.nompro, products.peso, products.descp, products.preciC, products.precV, products.stock, productos_comprados.canti, compra.id_compra, compra.fecha, compra.total, compra.tipoc, compra.tipopa FROM productos_comprados INNER JOIN products ON productos_comprados.id_prod  = products.id_prod INNER JOIN compra ON productos_comprados.id_compra  =compra.id_compra WHERE compra.id_compra= '$id' GROUP BY productos_comprados.id_pcomp ORDER BY productos_comprados.id_pcomp") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM productos_comprados");

$pdf->SetFont('Arial','',12, 'UTF-8');
foreach($results as $rows)
{
$pdf->Cell($w[0],6,$rows['canti'],1);
$pdf->Cell($w[1],6,utf8_decode($rows['nompro']),1);
$pdf->Cell($w[2],6,$rows['preciC'],1);
$pdf->Ln();


}
$pdf->Ln(10);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(190, 5, "TOTAL: S./".$row['total']." ", 0, 1, "C");



$pdf->Output($archivo_de_salida, 'D');//cierra el objeto pdf
?>