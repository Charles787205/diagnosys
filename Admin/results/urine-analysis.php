<?php
require('../../fpdf186/fpdf.php');
require '../../Models/RequestModel.php';

$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);

$services = [];
$results = [];
foreach ($request->services as $service) {
  $name = $service->name;
  if ($name == "Urine Analysis") {
    $services[] = $service;
  }
}
$request->services = $services;

foreach ($request->services[0]->results as $result) {
  $results[$result["name"]] =  $result["result"];
}
$pdf = new FPDF('P', 'mm', 'Legal');

$pdf->AddPage();



// Set font
$pdf->SetFont('Arial', 'B', 16);

$pdf->SetTextColor(255, 0, 0);

// Title
$pdf->Image('../../assets/img/logo01.png',3, 3, 33, 33, 'PNG');
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
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(40, 10, 'Firstname', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(75, 10,  $request->patient->first_name, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Family Name', 1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 10, $request->patient->last_name, 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Address', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(90, 10, $request->patient->barangay . ', ' . $request->patient->city, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Age/Gender', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);


$pdf->Cell(35, 10, $request->patient->gender, 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Date Performed', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);

$pdf->Cell(75, 10, $request->getResultDate(), 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Physician', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, 'MD', 1);

$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, "Urine Analysis", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(50, 10, '', 1);

$pdf->Ln(11);

$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 6, 'Macroscopic', 1, 0, 'C');
$pdf->Ln(7);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Color', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(60, 10, $results["color"], 1);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Sugar:', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(55, 10, $results["sugar"], 1);
$pdf->Ln(10);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Appearance', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(60, 10, $results["appearance"], 1);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Albumin', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(55, 10, $results["albumin"], 1);
$pdf->Ln(10);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Specific gravity', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(60, 10, $results["specific_gravity"], 1);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Reaction:', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(55, 10, $results["reaction"], 1);
$pdf->Ln(11);

$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 6, 'Microscopic', 1, 0, 'C');
$pdf->Ln(7);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Sq. Epithelial Cells', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["sq_epithelial_cells"], 1);
$pdf->Cell(30, 10, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Pus Cells', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["puss_cells"], 1);
$pdf->Cell(25, 10, '/hpf', 1, 0, 'R');
$pdf->Ln(10);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Mucous threads', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results['mucous threads'], 1);
$pdf->Cell(30, 10, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'RBC', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["rbc"], 1);
$pdf->Cell(25, 10, '/hpf', 1, 0, 'R');
$pdf->Ln(10);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Granular cast', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["granular_cast"], 1);
$pdf->Cell(30, 10, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Bacteria', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["bacteria"], 1);
$pdf->Cell(25, 10, '/hpf', 1, 0, 'R');
$pdf->Ln(10);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Hyaline cast', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results['hyaline_cast'], 1);
$pdf->Cell(30, 10, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Calcium oxalate', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["calcium_oxalate"], 1);
$pdf->Cell(25, 10, '/hpf', 1, 0, 'R');
$pdf->Ln(10);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Amorphous urates', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["amorphous_urates"], 1);
$pdf->Cell(30, 10, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Amor phosphates', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(30, 10, $results["amor_phosphates"], 1);
$pdf->Cell(25, 10, '/hpf', 1, 0, 'R');


$pdf->Ln(8);
$pdf->SetTextColor(0, 0, 0);



$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 3, 'Alejandro L Domingo Jr., MD, FPSP, APCP', 0, 0);
$pdf->Cell(55, 3, 'Marie Mhar M. Turado', 0, 0);
$pdf->Cell(190, 3, 'Elpidio Carcallas-Nuyad, RMT', 0, 1);
$pdf->Cell(90, -2, '____________________________________', 0, 0);
$pdf->Cell(55, -2, '___________________', 0, 0);
$pdf->Cell(55, -2, '__________________________', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 10, '', 0, 0);
$pdf->Cell(80, 10, 'P.R.C Number:0066658', 0, 0);
$pdf->Cell(55, 10, 'PCDC Staff', 0, 0);
$pdf->Cell(150, 10, 'P.R.C Number:0030677', 0, 1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetTextColor(135, 206, 235);
$pdf->Cell(25, 10, '', 0, 0);
$pdf->Cell(71, -2, 'Pathologist', 0, 0);
$pdf->Cell(55, -2, 'Checked by:', 0, 0);
$pdf->Cell(150, -2, 'Medical Technologist', 0, 0);
// Output the PDF
$pdf->Output('invoice.pdf', 'I');
