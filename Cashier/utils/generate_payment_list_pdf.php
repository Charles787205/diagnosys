<?php
require('../../fpdf186/fpdf.php');
require '../../Models/RequestModel.php';
require_once '../../Models/EmployeeModel.php';


$employeeModel = new EmployeeModel();
$employee = $employeeModel->getEmployeeById($_GET['user_id']);
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
$pdf->Image('../../assets/img/logo01.png', 3, 3, 33, 33, 'PNG');
$pdf->Image('../../assets/img/logo02.png', 173, 3, 38, 38, 'PNG');

$pdf->SetFont('Arial', 'B', 22);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(193, 6, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 13);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(190, 10, 'PARTNERSHIP, COMMITMENT, DEVOTION, AND CARE', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(190, 10, 'Collection Fee Report', 0, 1, 'C', $pdf->SetTextColor(0, 0, 0));

$pdf->Ln(5);

// Table header


$services = '';



$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, "ID", 1, 0, 'C');
$pdf->Cell(35, 10, "Last Name", 1, 0, "C");
$pdf->Cell(35, 10, "First Name", 1, 0, "C");
$pdf->Cell(50, 10, "Service Availed", 1, 0, "C");
$pdf->Cell(30, 10, "Total Amount", 1, 0, "C");
$pdf->Cell(30, 10, "Status", 1, 0, "C");
$pdf->Ln(10);
$pdf->SetFont("Arial", '', 10);

foreach ($requests as $request) {

  $no_of_lines = count($request->services);
  $pdf->Cell(20, 8 * $no_of_lines, $request->id, 1, 0, 'C');
  $pdf->Cell(35, 8 * $no_of_lines, strtoupper($request->patient->last_name), 1, 0, "C");
  $pdf->Cell(35, 8 * $no_of_lines, strtoupper($request->patient->first_name), 1, 0, "C");
  $services = '';
  foreach ($request->services as $service) {
    $services .= $service->name . ",\n";
  }
  $pdf->MultiCell(50, 8, $services, 1, "C");
  $pdf->SetXY(150, $pdf->GetY() - 8 * $no_of_lines);

  $pdf->Cell(30, 8 * $no_of_lines, $request->total, 1, 0, "C");
  $pdf->Cell(30, 8 * $no_of_lines, strtoupper($request->status), 1, 0, "C");
  $pdf->Ln(8 * $no_of_lines);
}




// Total
$noOfChar = strlen($employee->getFullName());

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 3, '', 0, 0);
$pdf->Cell(135 - $noOfChar, 3, 'Evelyn Nuyad', 0, 0);
$pdf->Cell(190, 3, $employee->getFullName(), 0, 1);
$pdf->Cell(135, -2, '____________________________________', 0, 0);
$pdf->Cell(55, -2, '__________________________', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 10, '', 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetTextColor(135, 206, 235);
$pdf->Cell(5, 10, '', 0, 0);
$pdf->Cell(130, 10, 'PCDC Owner', 0, 0);
$pdf->Cell(150, 10, 'Cashier', 0, 0);

// Output the PDF
$pdf->Output('invoice.pdf', 'I');
