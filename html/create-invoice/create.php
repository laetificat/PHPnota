<?php
	require '../database_config.php';

	require('fpdf.php');

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,''.$_POST['address1'].'');
	$pdf->Ln();
	$pdf->Cell(40,10,''.$_POST['address2'].'');
	$pdf->Ln();
	$pdf->Cell(40,10,''.$_POST['address3'].'');
	$pdf->Output();

?>