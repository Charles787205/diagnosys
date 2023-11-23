<?php
require ('./fpdf186/fpdf.php');

// Create a PDF object
$pdf = new FPDF('P', 'mm', 'Letter');

$pdf->AddPage();



// Set font
$pdf->SetFont('Arial', 'B', 25);
$pdf->SetTextColor(255, 0, 0);

// Title
$pdf->Image('assets/img/logo01.png', 1,10,28,28,'PNG' );
$pdf->Image('assets/img/logo02.png', 180,10,33,33,'PNG' );

$pdf->Cell(193, 10, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(190, 3, 'PARTNERSHIP, COMMITMENT, DEVOTION, AND CARE', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 5, 'panabo.diagnostic@yahoo/gmail.com', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 5, 'PLDT Landline:(084) 217-3824', 0, 1, 'C');
$pdf->Cell(190, 5, '_____________________________________________________', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(190, 8, 'MEDICAL LABORATORY', 0, 1, 'C', $pdf->SetTextColor(135, 206, 235));

// Line break


// Invoice details

$pdf->Ln(0);

// Table header


// Table rows
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(40, 10, 'Firstname', 1 );
$pdf->SetTextColor(0,0,0); 
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(75, 10, 'Bernie', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Family Name', 1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50, 10, 'Lofranco', 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Address', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, 'Panabo Cityl, Davao del Norte', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Age/Gender', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, '33 Years Old/Male', 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Date Performed', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, 'September 29,2023', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Physician', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, 'MD', 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Mode of Test', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, 'Quantitative', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Time', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, '07:30 am', 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Examination Test', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, 'FBS, Cholesterol, SUA, Creatinine', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Specimen', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, 'Serum', 1);

$pdf->Ln(13);


// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 5, 'Test', 1,0,'C');
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 5, 'Result', 1,0,'C');
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 5, 'Normal Value', 1,0,'C');
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(80, 8, 'Glucose(Fasting Blood Sugar)', 1,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(35, 8, '4.95', 1,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(80, 8, '3.85-5.78 mmol/L', 1,0,'C');
// Output the PDF
$pdf->Output('invoice.pdf', 'I');
?>

