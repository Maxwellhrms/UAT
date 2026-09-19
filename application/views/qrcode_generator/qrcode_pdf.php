<?php

$company = trim($response['cp'][0]->mxcp_name);
$divsion = trim($response['dv'][0]->mxd_name);
$state = trim($response['st'][0]->mxst_state);
$branch = trim($response['br'][0]->mxb_name);
$address = trim($response['br'][0]->mxb_address);

$company_id = trim($response['cp'][0]->mxcp_id);
$division_id = trim($response['dv'][0]->mxd_id);
$state_id = trim($response['st'][0]->mxst_id);
$branch_id = trim($response['br'][0]->mxb_id);
$link = base64_encode('{"companyid": "'.$company_id.'","divisionid": "'.$division_id.'","stateid": "'.$state_id.'","branchid": "'.$branch_id.'","entrytype": "QRCODE-APP"}');
$style = array(
    'border' => false,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
tcpdf();
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$html='<div class="container">
<img src="https://maxwellhrms.in/assets/img/logo.png" style="text-align:center;width:200rem" alt="Drag or click to upload logo" title="Drag or click to upload logo" class="logo_display">
  </div>
  <hr>
';
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($branch);
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

$title_data = $divsion.' - '.$state.' - '.$branch;
$cleanaddress = preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $address);
$pdf->writeHTML($html, true, false, true, false);
$pdf->Text(50, 55, $title_data);
$html2='<hr>
<div class="container-fluid" style="white-space: nowrap">'.$cleanaddress.'</div>';
$pdf->write2DBarcode($link, 'QRCODE,H', 45, 70, 120, 90, $style, 'N');
$pdf->writeHTML($html2, true, false, true, false);
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
// $pdf->MultiCell(155, 20, $cleanaddress, 1, 'L', 0, 1, 70, 170, true, 0, false, false, 0, 'T', false);
ob_end_clean();
$pdf->Output($branch.'.pdf', 'I');
?>