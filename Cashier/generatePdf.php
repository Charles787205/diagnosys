<?php
require('../fpdf186/fpdf.php');
require '../Models/RequestModel.php';

$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);

// Create a PDF object
$pdf = new FPDF('P', 'mm', 'A4');

$query = "SELECT * FROM request_form";


$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title


// Invoice details
$pdf->Image('../assets/img/logo01.png', 1, 10, 28, 28, 'PNG');
$pdf->Image('../assets/img/logo02.png', 180, 10, 33, 33, 'PNG');

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

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 8, 'Name:', 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(58, 8, $request->patient->getFullName(), 1, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 8, 'Billing Date:', 1);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(33, 8,  date("F/d/Y"), 1, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 8, 'Age/Gender:', 1);
$age = $request->patient->age;
$gender = $request->patient->gender;
$pdf->Cell(30, 8, "$age/$gender", 1);
$pdf->SetFont('Arial', '', 11);

$pdf->Ln(8);

// Table rows
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 8, 'Address:', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(58, 8, $request->patient->city, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 8, 'Plan/Acct Number', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(33, 8, $request->account_number, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 8, 'Patient No.:', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 8, $request->id, 1);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(78, 8, 'PARTICULAR', 1, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 8, 'Company', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(33, 8, $request->company, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 8, 'Insurance', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 8, $request->insurance, 1);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 8, 'Quantity', 1);
$pdf->SetFont('Arial', '', 10,);
$pdf->Cell(121, 8, 'Laboratory Examination/s', 1, 0, 'C');
$pdf->Cell(55, 8, 'Amount', 1);
$pdf->Ln(8);

$services = '';
foreach ($request->services as $service) {
  $services .= $service->name . ', ';
  $pdf->SetFont('Arial', '', 11);
  $pdf->Cell(20, 8, '', 1);
  $pdf->Cell(121, 8, $service->name, 1);
  $pdf->Cell(55, 8, $service->price, 1);
  $pdf->Ln(8);
}

$pdf->Cell(20, 10, '', 1);
$pdf->Cell(121, 10, '', 1);
$pdf->Cell(55, 10, '', 1);
$pdf->Ln(10);


$pdf->SetFont('Arial', '', 12);
$pdf->Cell(141, 10, 'Total Amount', 1);
$pdf->Cell(55, 10,  $request->total . '.00', 1);
$pdf->Ln(10);

// Total

$pdf->Ln(5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(310, 5, 'I hereby acknowledge that the services that has', 0, 1, 'C');
$pdf->Cell(310, 5, 'mentioned were actually received and rendered', 0, 1, 'C');

$pdf->Ln(12);
$pdf->Cell(120, 2, 'Prepared by: ___________________', 0, 0);
$pdf->Cell(170, 2, '______________________________________', 0, 1);
$pdf->Cell(310, 6, 'Signature over Printed name of Patient/Member', 0, 1, 'C');
$pdf->Cell(310, 3, 'Address/Contact Number:__________________', 0, 1, 'C');
$pdf->Cell(120, 3, 'Checked by: Evelyn A. Nuyad', 0, 0);
$pdf->Cell(310, 4, '_______________________________________', 0, 1);
$pdf->Cell(310, -5, '________________________', 0, 1, 'L');

// Output the PDF
$pdf->Output('invoice.pdf', 'I');
