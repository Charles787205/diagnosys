<?php
require ('../fpdf186/fpdf.php');
require '../Models/RequestModel.php';

$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);

// Create a PDF object
$pdf = new FPDF('P', 'mm', 'Letter');

$query = "SELECT * FROM request_form";


$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title


// Invoice details
$pdf->Image('../assets/img/logo01.png', 1,10,28,28,'PNG' );
$pdf->Image('../assets/img/logo02.png', 180,10,33,33,'PNG' );

$pdf->SetFont('Arial', 'B', 25);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(193, 10, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(190, 10, 'PARTNERSHIP, COMMITMENT, DEVOTION, AND CARE', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(190, 10, 'Statement of Account', 0, 1, 'C', $pdf->SetTextColor(0, 0, 0));

$pdf->Ln(5);

// Table header

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Name:', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(48, 10, $request->patient->getFullName() , 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Billing Date:', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10,  date("m/d/Y"), 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Age:', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, $request->patient->age, 1);
$pdf->Ln(10);

// Table rows
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Address:', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(78, 10, $request->patient->city, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Patient No.', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(20, 10, $request->id, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'Gender.', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(20, 10, $request->patient->gender, 1);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12,);
$pdf->Cell(128  , 10, 'Laboratory Examination', 1);
$pdf->Cell(70, 10, 'Amount', 1);
$pdf->Ln(10);
$services = '';
foreach($request->services as $service) {
  $services .= $service->name . ', ';
  $pdf->Cell(128  , 10, $service->name, 1);
  $pdf->Cell(70, 10, $service->price, 1);
  $pdf->Ln(10);
}

$pdf->Cell(128  , 10, '', 1);
$pdf->Cell(70, 10, '', 1);
$pdf->Ln(10);
$pdf->Cell(128  , 10, '', 1);
$pdf->Cell(70, 10, '', 1);
$pdf->Ln(10);
$pdf->Cell(128  , 10, 'Total Amount', 1);
$pdf->Cell(70, 10,  $request->total, 1);
// Total


// Output the PDF
$pdf->Output('invoice.pdf', 'I');
?>

