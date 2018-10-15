<?php require('fpdf/fpdf.php');
 	$page = $_GET['page'];
 	$id = $_GET['id'];
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,$page);
	$tittle="C:/employees/santhosh surana/Documents/reports/".$id.".pdf";
	$content = $pdf->Output($tittle,'F');
echo $tittle."/n".$page;
?>