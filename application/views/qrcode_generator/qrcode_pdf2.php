<?php
$paramdata = explode('~',html_entity_decode(base64_decode($_GET['param'])));
// $paramdata = explode('|~|',base64_decode($_GET['param']));
$company = $paramdata[0];
$divsion = $paramdata[1];
$state = $paramdata[2];
$branch = $paramdata[3];
$address = $paramdata[4];
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
tcpdf();
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('Branch Wise QR-COde');
$pdf->SetPrintHeader(false);


$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->AddPage();
// echo html_entity_decode(utf8_encode($branch));
// QRCODE,H : QR-CODE Best error correction
// $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 45, 70, 120, 90, $style, 'N');

$title_data = $divsion.' - '.$state.' - '.$branch;
$cleanaddress = preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $address);
$pdf->Text(50, 55, $title_data);
// $pdf->Text(10, 215, $cleanaddress);
// ob_end_clean();
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 45, 70, 120, 90, $style, 'N');
$pdf->MultiCell(80, 50, trim($cleanaddress), 0, 'J', false, 45, 70, 170, true, 0, false, true, 0, 'T', false);
$pdf->Output('example_001.pdf', 'I');
?>