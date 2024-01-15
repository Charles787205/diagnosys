<?php
require('../../fpdf186/fpdf.php');
require '../../Models/RequestModel.php';


// Create a PDF object
$pdf = new FPDF('P', 'mm', 'Letter');


$requestModel = new RequestModel();
$requests = $requestModel->getRequestsByStatus(Request::PAID);
$pdf->AddPage();
//page width = 200
// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title


// Invoice details
$pdf->Image('../../assets/img/logo01.png', 1, 10, 28, 28, 'PNG');
$pdf->Image('../../assets/img/logo02.png', 180, 10, 33, 33, 'PNG');

$pdf->SetFont('Arial', 'B', 25);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(193, 10, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(190, 10, 'PARTNERSHIP, COMMITMENT, DEVOTION, AND CARE', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 10, 'Statement of Account', 0, 1, 'C', $pdf->SetTextColor(0, 0, 0));

$pdf->Ln(5);

// Table header


$services = '';
//foreach ($request->services as $service) {
//  $services .= $service->name . ', ';
//  $pdf->Cell(128, 10, $service->name, 1);
//  $pdf->Cell(70, 10, $service->price, 1);
//  $pdf->Ln(10);
//}


$pdf->Ln(10);
$pdf->Cell(20, 10, "ID", 1, 0, 'C');
$pdf->Cell(50, 10, "Last Name", 1, 0, "C");
$pdf->Cell(50, 10, "First Name", 1, 0, "C");
$pdf->Cell(50, 10, "Total Amount", 1, 0, "C");
$pdf->Cell(30, 10, "Status", 1, 0, "C");
$pdf->Ln(10);
$pdf->SetFont("Arial", '', 10);

foreach ($requests as $request) {
  $pdf->Cell(20, 10, $request->id, 1, 0, 'C');
  $pdf->Cell(50, 10, strtoupper($request->patient->last_name), 1, 0, "C");
  $pdf->Cell(50, 10, strtoupper($request->patient->first_name), 1, 0, "C");
  $pdf->Cell(50, 10, $request->total, 1, 0, "C");
  $pdf->Cell(30, 10, strtoupper($request->status), 1, 0, "C");
  $pdf->Ln(10);
}




// Total

$pdf->Ln(20);
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
