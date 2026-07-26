<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../venta/adminDAO.php';

$impr = new adminDAO();

if(strlen($_POST['desde'])>0 and strlen($_POST['hasta'])>0){
	$desde = $_POST['desde'];
	$hasta = $_POST['hasta'];

	$verDesde = date('d/m/Y', strtotime($desde));
	$verHasta = date('d/m/Y', strtotime($hasta));
}else{
	$desde = '1111-01-01';
	$hasta = '9999-12-30';

	$verDesde = '__/__/____';
	$verHasta = '__/__/____';
}
require_once('../../assets/tcpdf/tcpdf.php');


	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Jordan Roque');
	$pdf->SetTitle($_POST['reporte_name']);

	$pdf->setPrintHeader(false); 
	$pdf->setPrintFooter(TRUE);
	$pdf->SetMargins(20, 10, 20, 20); 
	$pdf->SetAutoPageBreak(true, 20); 
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->addPage();



$datos = $impr->buscarAllBitacoraFecha($desde,$hasta);

$content = '';

	$content .= '
		<div class="row">
		
        	<div class="col-md-12">
				
				<h1 style="text-align:center;">Reporte: Datos de la Venta</h1>
            	<h3 style="text-align:center;">Desde '.$verDesde.' hasta: '.$verHasta.'</h3>

      <table border="1" cellpadding="5" >
        <thead>
          <tr bgcolor="#E5E5E5">
            <th width="20%">Comprobante</th>
            <th width="20%">Fecha</th>
            <th width="20%">Cliente</th>
            <th width="20%">Tipo pago</th>
            <th width="20%">Total</th>

          </tr>
        </thead>
	';

	for($x=0; $x<count($datos); $x++){
		$x; $l = $x+1;
	$tipoc = $datos[$x]['tipoc'];
	$fecha = fechaNormal($datos[$x]['fecha']);
	$nom_due = $datos[$x]['nom_due'];
	$tipopa = $datos[$x]['tipopa'];
	$total = $datos[$x]['total'];
		
	$content .= '
		<tr nobr="true" bgcolor="#f5f5f5">
            <td width="20%">'.$tipoc.'</td>
            <td width="20%">'.$fecha.'</td>
            <td width="20%">'.$nom_due.'</td>
            <td width="20%">'.$tipopa.'</td>
            <td width="20%">'.$total.'</td>
        </tr>
	';
	}

	$content .= '</table>';

	
//CONSULTA

$pdf->writeHTML($content, true, 0, true, 0);

$pdf->lastPage();

$pdf->output('../venta/reporte.pdf', 'F');
?>