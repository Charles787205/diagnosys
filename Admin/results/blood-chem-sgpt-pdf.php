<?php
require ('../fpdf186/fpdf.php');
require '../Models/RequestModel.php';

$requestModel = new RequestModel();

$pdf = new FPDF('P', 'mm', 'Legal');

$pdf->AddPage();



// Set font
$pdf->SetFont('Arial', 'B', 25);

$pdf->SetTextColor(255, 0, 0);

// Title
$pdf->Image('../assets/img/logo01.png', 1,10,28,28,'PNG' );
$pdf->Image('../assets/img/logo02.png', 180,10,33,33,'PNG' );

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

$pdf->Cell(40, 10, 'Firstname', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(75, 10,'', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Family Name', 1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 10, '', 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Address', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, '', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Age/Gender', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, "", 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Date Performed', 1);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10,'' , 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Physician', 1);
$pdf->SetTextColor(0, 0, 0);
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
$pdf->Cell(40, 10, 'Examination Taken', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(75, 10, 'FBS,Cholesterol, SUA, Creatinine', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Specimen', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, 'Serum', 1,0,'R');


$pdf->Ln(15);


// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 5, 'Service', 1, 0, 'C');

$pdf->Cell(35, 5, 'Result', 1, 0, 'C');
$pdf->Cell(60, 5, 'Normal Value', 1, 0, 'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);

  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(100, 8, 'Glucose (Fasting Blood Sugar)', 1, 0, 'C');

  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(35, 8, '', 1, 0, 'C');

  $pdf->SetFont('Arial', '', 14);
  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(60, 8, '3.85-5.78 mmol/L', 1, 0, 'C');
  $pdf->SetFont('Arial', '', 14);
  $pdf->Ln(8);
$pdf->SetTextColor(0, 0, 0);

  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(100, 8, 'Cholesterol total', 1, 0, 'C');

  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(35, 8, '', 1, 0, 'C');

  $pdf->SetFont('Arial', '', 14);
  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(60, 8, '2.60-4.90 mmol/L', 1, 0, 'C');
  $pdf->SetFont('Arial', '', 14);
  $pdf->Ln(8);
$pdf->SetTextColor(0, 0, 0);

  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(100, 8, 'Serum Uric Acid (SUA)', 1, 0, 'C');

  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(35, 8, '', 1, 0, 'C');

  $pdf->SetFont('Arial', '', 14);
  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(60, 8, '149-404 mmol/L', 1, 0, 'C');
  $pdf->SetFont('Arial', '', 14);
  $pdf->Ln(8);
$pdf->SetTextColor(0, 0, 0);

  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(100, 8, 'Serum Creatine', 1, 0, 'C');

  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(35, 8, '', 1, 0, 'C');

  $pdf->SetFont('Arial', '', 14);
  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(60, 8, '53-97 mmol/L', 1, 0, 'C');
  $pdf->SetFont('Arial', '', 14);
  
  $pdf->Ln(20);
  $pdf->SetTextColor(135, 206, 235);
  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(40, 7, 'Examination Taken', 1);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial', 'I', 13);
  $pdf->Cell(75, 7, 'SGPT', 1);
  $pdf->SetTextColor(135, 206, 235);
  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(30, 7, 'Specimen', 1);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial', 'I', 14);
  $pdf->Cell(50, 7, 'Serum', 1,0,'R');
  $pdf->Ln(13);


  // Total
  $pdf->SetTextColor(135, 206, 235);
  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(100, 5, 'Service', 1, 0, 'C');
  $pdf->Cell(35, 5, 'Result', 1, 0, 'C');
  $pdf->Cell(60, 5, 'Normal Value', 1, 0, 'C');
  $pdf->Ln(6);
  $pdf->SetTextColor(0, 0, 0);
  
    $pdf->SetTextColor(50, 200, 50);
    $pdf->Cell(100, 8, 'SGPT(Serum Glutamate Pyruvate Transaminase)', 1, 0, 'C');
  
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(35, 8, '', 1, 0, 'C');
  
    $pdf->SetFont('Arial', '', 14);
    $pdf->SetTextColor(50, 200, 50);
    $pdf->Cell(60, 8, '3.85-5.78 mmol/L', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 14);




$pdf->Ln(8);
$pdf->SetTextColor(0, 0, 0);



$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(143, 3, 'Alejandro L Domingo Jr., MD, FPSP, APCP', 0, 0);

$pdf->Cell(190, 3, 'Elpidio Carcallas-Nuyad, RMT', 0, 1);
$pdf->Cell(143, -2, '____________________________________', 0, 0);

$pdf->Cell(55, -2, '__________________________', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 10, '', 0, 0);
$pdf->Cell(135, 10, 'P.R.C Number:0066658', 0, 0);

$pdf->Cell(150, 10, 'P.R.C Number:0030677', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetTextColor(135, 206, 235);
$pdf->Cell(25, 10, '', 0, 0);
$pdf->Cell(125, -2, 'Pathologist', 0, 0);

$pdf->Cell(150, -2, 'Medical Technologist', 0, 0);
// Output the PDF
$pdf->Output('invoice.pdf', 'I');
?>

