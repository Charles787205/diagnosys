<?php
require('../../fpdf186/fpdf.php');
require '../../Models/RequestModel.php';


$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);

$services = [];
$results = [];
foreach ($request->services as $service) {
  $name = $service->name;
  if ($service->name == "Hemoglobin Determination") {
    $services[] = $service;
  }
}
$request->services = $services;

foreach ($request->services[0]->results as $result) {
  $results[$result["name"]] =  $result["result"];
}
if (count($results)  == 0) {
}
$pdf = new FPDF('P', 'mm', 'Letter');

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
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6,  $request->patient->first_name, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Family Name', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 6,  $request->patient->last_name, 1, 0, 'R');
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
$pdf->SetFont('Arial', "", 12);


$pdf->Cell(50, 6, $request->patient->gender, 1, 0, 'R');
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
$pdf->Cell(50, 6, 'MD', 1, 0, 'R');
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Mode of Test', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, '', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Time', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, $request->getResultTime(), 1, 0, 'R');
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(75, 6, 'Hemoglobin determination', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(50, 6, 'Whole Blood', 1, 0, 'R');

$pdf->Ln(10);
// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, 'Test', 1, 0, 'C');
$pdf->Cell(35, 5, 'Result', 1, 0, 'C');
$pdf->Cell(60, 5, 'Normal Value', 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Hemoglobin Count", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6,  $results["hemoglobin_count"], 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "120-160g/dL", 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(75, 6, "Urinalysis", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(50, 6, 'Urine', 1, 0, 'R');
$pdf->Ln(8);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 5, 'Macroscopic', 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Color', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, $results["color"], 1, 0, 'C');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Sugar:', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 6, $results["sugar"], 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Appearance', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, $results["appearance"], 1, 0, 'C');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Albumin', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 6, $results["albumin"], 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Specific gravity', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, $results["specific_gravity"], 1, 0, 'C');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Reaction:', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 6, $results["reaction"], 1, 0, 'C');
$pdf->Ln(8);

$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 5, 'Microscopic', 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Sq. Epithelial Cells', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["sq_epithelial_cells"], 1, 0, 'R');
$pdf->Cell(30, 6, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Pus Cells', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["puss_cells"], 1, 0, 'R');
$pdf->Cell(25, 6, '/hpf', 1, 0, 'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Mucous threads', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["mucous threads"], 1, 0, 'R');
$pdf->Cell(30, 6, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'RBC', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["rbc"], 1, 0, 'R');
$pdf->Cell(25, 6, '/hpf', 1, 0, 'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Granular cast', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["granular_cast"], 1, 0, 'R');
$pdf->Cell(30, 6, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Bacteria', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["bacteria"], 1, 0, 'R');
$pdf->Cell(25, 6, '/hpf', 1, 0, 'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Hyaline cast', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["hyaline_cast"], 1, 0, 'R');
$pdf->Cell(30, 6, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Calcium oxalate', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["calcium_oxalate"], 1, 0, 'R');
$pdf->Cell(25, 6, '/hpf', 1, 0, 'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Amorphous urates', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["amorphous_urates"], 1, 0, 'R');
$pdf->Cell(30, 6, '/hpf', 1, 0, 'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Amor phosphates', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, $results["amor_phosphates"], 1, 0, 'R');
$pdf->Cell(25, 6, '/hpf', 1, 0, 'R');

$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(75, 6, "Blood Typing", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(50, 6, 'Whole Blood', 1, 0, 'R');
$pdf->Ln(10);
// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, 'Test', 1, 0, 'C');
$pdf->Cell(95, 5, 'Result', 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Blood type", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(95, 6, $results["blood_type"], 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Rhesus (Rh) type", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 6, 'Positve', 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(25, 6, '+', 1, 0, 'C');

$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Mode of Test', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(155, 6, "Qualitative  ", 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(75, 6, "HBsAg", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(50, 6, 'Serum', 1, 0, 'R');
$pdf->Ln(8);

$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, 'Test', 1, 0, 'C');
$pdf->Cell(95, 5, 'Result', 1, 0, 'C');
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Hepatitis B surface Antigen", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, 6, $results["hepatitis_b_surface_antigen"], 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(25, 6, '+', 1, 0, 'C');


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
