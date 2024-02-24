<?php
require('../../fpdf186/fpdf.php');
require '../../Models/RequestModel.php';

$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);

$services = [];
$results = [];
$hasSgpt = false;
$sgpt_service;
foreach ($request->services as $service) {
  $name = $service->name;
  if (($name == "FBS" || str_contains($name, "Cholesterol") || str_contains(strtolower($name), "glucose") || str_contains($name, "Serum Uric Acid") || str_contains(strtolower($name), "sgpt") ||  str_contains($name, "Creatinine"))) {


    if (str_contains(strtolower($name), "sgpt")) {
      $sgpt_service = $service;
      $hasSgpt = true;
    } else {
      $services[] = $service;
    }
  }
}

$request->services = $services;


$pdf = new FPDF('P', 'mm', 'Legal');

$pdf->AddPage();



// Set font
$pdf->SetFont('Arial', 'B', 16);

$pdf->SetTextColor(255, 0, 0);

// Title
$pdf->Image('../../assets/img/logo01.png', 3, 3, 33, 33, 'PNG');
$pdf->Image('../../assets/img/logo02.png', 173, 3, 38, 38, 'PNG');
$pdf->SetFont('Arial', 'B', 22);
$pdf->SetTextColor(255, 0, 0);

$pdf->Cell(193, 10, 'PANABO CITY DIAGNOSTIC CENTER', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 13);
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
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(40, 6, 'Firstname', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(75, 6, $request->patient->first_name, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Family Name', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 6, $request->patient->last_name, 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Address', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, $request->patient->barangay . ', ' . $request->patient->city, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Age/Gender', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, $request->patient->gender, 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Date Performed', 1);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, $request->getResultDate(), 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Physician', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, 'MD', 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Mode of Test', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, 'Quantitative', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Time', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, $request->getResultTime(), 1);

$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, 'FBS,Cholesterol, SUA, Creatinine', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, 'Serum', 1, 0, 'R');


$pdf->Ln(12);


// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 5, 'Service', 1, 0, 'C');

$pdf->Cell(35, 5, 'Result', 1, 0, 'C');
$pdf->Cell(60, 5, 'Normal Value', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);

foreach ($services as $service) {


  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(100, 6, $service->name, 1, 0, 'C');
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(35, 6, $service->results[0]["result"], 1, 0, 'C');
  $pdf->SetFont('Arial', '', 12);
  $pdf->SetTextColor(50, 200, 50);
  $pdf->Cell(60, 6, $service->normal_value, 1, 0, 'C');

  $pdf->Ln(6);
}

$pdf->Ln(15);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 7, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 13);
$pdf->Cell(75, 7, 'SGPT', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 7, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 14);
$pdf->Cell(50, 7, 'Serum', 1, 0, 'R');
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
$pdf->Cell(100, 6, 'SGPT(Serum Glutamate Pyruvate Transaminase)', 1, 0, 'C');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(35, 6, $sgpt_service->results[0]["result"], 1, 0, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(50, 200, 50);
$pdf->Cell(60, 6, '3.85-5.78 mmol/L', 1, 0, 'C');
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
