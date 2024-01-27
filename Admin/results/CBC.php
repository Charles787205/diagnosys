<?php
require ('../fpdf186/fpdf.php');
require '../Models/RequestModel.php';

$requestModel = new RequestModel();

$pdf = new FPDF('P', 'mm', 'Letter');

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
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(40, 6, 'Firstname', 1 );
$pdf->SetTextColor(0,0,0); 
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6,  "", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Family Name', 1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50, 6, "" , 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Address', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, "", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Age/Gender', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);


$pdf->Cell(50, 6, "", 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Date Performed', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, "", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Physician', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, 'MD', 1,0,'R');
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Mode of Test', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, '', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Time', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, '', 1);
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(75, 6, 'Complete Blood Count', 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 6, 'Whole Blood', 1,0,'R');

$pdf->Ln(8);
// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, 'Test', 1,0,'C');
$pdf->Cell(35, 5, 'Result', 1,0,'C');
$pdf->Cell(60, 5, 'Reference Value', 1,0,'C');
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Hemoglobin Count", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "120-160g/dL", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Hematocrit Count", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "38-47%", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "White Blood Cells", 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "4.5-11.0x10^3/µL", 1,0,'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'Differential count White Blood Cells', 1,0,'C');
$pdf->Ln(6);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(100, 5, 'Test', 1,0,'C');
$pdf->Cell(35, 5, 'Result', 1,0,'C');
$pdf->Cell(60, 5, 'Reference Value', 1,0,'C');
$pdf->Ln(5);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Segmenters", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "56.00", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Lymphocytes", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "34.00", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Eosinophils", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "02.70", 1,0,'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Monocytes", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "4.00", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Basophils", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "03.00", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Bands", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 6, "", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "03.00", 1,0,'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Ln(6);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 6, "Total", 1,0,'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(35, 6, "100%", 1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, "100", 1,0,'C');
$pdf->SetFont('Arial', '', 14);

$pdf->Ln(8);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, 'Examination Taken', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(75, 6, "Urinalysis", 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, 'Specimen', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(50, 6, 'Urine', 1,0,'R');
$pdf->Ln(8);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 5, 'Macroscopic', 1,0,'C');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Color', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, '', 1);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40,6, 'Sugar:', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 6, '', 1);
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Appearance', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, '', 1);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Albumin', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 6, '', 1);
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Specific gravity', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 6, '', 1);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Reaction:', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 6, '', 1);
$pdf->Ln(8);

$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 5, 'Microscopic', 1,0,'C');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Sq. Epithelial Cells', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(30, 6, '/hpf', 1,0,'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Pus Cells', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(25, 6, '/hpf', 1,0,'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Mucous threads', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(30, 6, '/hpf', 1,0,'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'RBC', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(25, 6, '/hpf', 1,0,'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Granular cast', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(30, 6, '/hpf', 1,0,'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Bacteria', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(25, 6, '/hpf', 1,0,'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Hyaline cast', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(30, 6, '/hpf', 1,0,'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Calcium oxalate', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(25, 6, '/hpf', 1,0,'R');
$pdf->Ln(6);
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Amorphous urates', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(30, 6, '/hpf', 1,0,'R');
$pdf->SetTextColor(244, 188, 28);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 6, 'Amor phosphates', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 6, '', 1);
$pdf->Cell(25, 6, '/hpf', 1,0,'R');


$pdf->Ln(15);
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

