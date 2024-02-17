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
$pdf->Image('../assets/img/logo01.png', 3, 3, 33, 33, 'PNG');
$pdf->Image('../assets/img/logo02.png', 173, 3, 38, 38, 'PNG');

$pdf->SetFont('Arial', 'B', 22);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(193, 6, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 13);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(190, 10, 'PARTNERSHIP, COMMITMENT, DEVOTION, AND CARE', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(190, 3, 'Statement of Account', 0, 1, 'C', $pdf->SetTextColor(0, 0, 0));

$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 4, 'Invoice # :', 0,0);
$pdf->Cell(5, 4,'2024-'.$request->id, 0);
// Table header
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10); 
$pdf->Cell(20, 6, 'Name:', 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(58, 6, $request->patient->getFullName(), 1, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Billing Date:', 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(33, 6,  date("F/d/Y"), 1, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, 'Age/Gender:', 1);
$pdf->SetFont('Arial', 'B', 10);
$age = $request->patient->age;
$gender = $request->patient->gender;
$pdf->Cell(30, 6, "$age/$gender", 1);
$pdf->SetFont('Arial', '', 11);

$pdf->Ln(6);

// Table rows
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 6, 'Address:', 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(58, 6, $request->patient->city, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Plan/Acct Number', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(33, 6, $request->account_number, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, 'Patient No.:', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, $request->id, 1);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(78, 6, 'PARTICULAR', 1, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Company', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(33, 6, $request->company, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, 'Insurance', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, $request->insurance, 1);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 6, 'Quantity', 1);
$pdf->SetFont('Arial', '', 10,);
$pdf->Cell(121, 6, 'Laboratory Examination/s', 1, 0, 'C');
$pdf->Cell(55, 6, 'Amount', 1);
$pdf->Ln(6);

$services = '';
foreach ($request->services as $service) {
  $services .= $service->name . ', ';
  $pdf->SetFont('Arial', '', 11);
  $pdf->Cell(20, 6, '', 1);
  $pdf->Cell(121, 6, $service->name, 1);
  $pdf->Cell(55, 6, $service->price.'.00', 1);
  $pdf->Ln(6);
}

$pdf->Cell(20, 6, '', 1);
$pdf->Cell(121, 6, '', 1);
$pdf->Cell(55, 6, '', 1);
$pdf->Ln(6);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(141, 6, 'Total Amount                                                                                      
Php', 1);
$pdf->Cell(55, 6,  $request->total . '.00', 1);
$pdf->Ln(6);

// Total

$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(310, 5, 'I hereby acknowledge that the services that has', 0, 1, 'C');
$pdf->Cell(310, 5, 'mentioned were actually received and rendered', 0, 1, 'C');

$pdf->Ln(5);
$pdf->Cell(20, 2, 'Prepared by: ', 0, 0);
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(120, 2, 'Cashier Name ', 0, 0);
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(170, 2, $request->patient->getFullName(), 0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(310, 6, 'Signature over Printed name of Patient/Member', 0, 1, 'C');
$pdf->Cell(310, 3, 'Address/Contact Number:__________________', 0, 1, 'C');
$pdf->Cell(120, 3, 'Checked by: Evelyn A. Nuyad', 0, 0);
$pdf->Cell(310, 4, '_______________________________________', 0, 1);
$pdf->Cell(310, -5, '________________________', 0, 1, 'L');

// Output the PDF
$pdf->Output('invoice.pdf', 'I');
