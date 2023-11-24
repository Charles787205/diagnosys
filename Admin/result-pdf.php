<?php
require ('../fpdf186/fpdf.php');
require '../Models/RequestModel.php';

$requestModel = new RequestModel();
$request = $requestModel->getRequestById($_GET['request_id']);
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
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(40, 10, 'Firstname', 1 );
$pdf->SetTextColor(0,0,0); 
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(75, 10, $request->patient->first_name , 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Family Name', 1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50, 10, $request->patient->last_name , 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Address', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, $request->patient->city, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Age/Gender', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$age = $request->patient->age;
$gender = $request->patient->gender;
$pdf->Cell(50, 10, "$age/$gender", 1);
$pdf->Ln(10);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Date Performed', 1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(75, 10, $request->request_date, 1);
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 10, 'Physician', 1);
$pdf->SetTextColor(0,0,0);
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

$pdf->Ln(10);


// Total
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 5, 'Test', 1,0,'C');
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(35, 5, 'Result', 1,0,'C');
$pdf->SetTextColor(135, 206, 235);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 5, 'Normal Value', 1,0,'C');


foreach($request->services as $service){
  
  $pdf->Cell(80, 8, $service->name, 1,0,'C');
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(35, 8, $service->result, 1,0,'C');
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial', '', 14);
  $pdf->Cell(80, 8, $service->normal_value, 1,0,'C');
  $pdf->SetFont('Arial', '', 14);
  $pdf->Ln(10);
  $pdf->SetTextColor(0, 0, 0);

}
// Output the PDF
$pdf->Output('invoice.pdf', 'I');
?>

