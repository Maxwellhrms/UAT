<?php
ob_start();
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// $obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// $obj_pdf->SetDefaultMonospacedFont('helvetica','', 9);
$obj_pdf->SetDefaultMonospacedFont('times','', 8);
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
?>
<style>
table {text-align: justify;}
p {text-align: justify!important;}
</style>



<?php
$card = $_SERVER['DOCUMENT_ROOT'].'maxwellhrms/assets/img/relocations.jpg';
// echo $card;exit;
//$pdf->Image($card, 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
//$pdf->SetXY(110, 200);
// $pdf->Image($card, '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
// $pdf->Image('images/image_demo.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
$this->Image($card, 0, 0, 100, 0, 'jpg', '', '', false, 300, '', false, false, 0);
// $pdf->Output('example_009.pdf', 'I');
// $content = ob_get_contents();
// ob_end_clean();
// $obj_pdf->writeHTML($content, true, false, true, false, 'R');
// $obj_pdf->Output('offer.pdf', 'I');
?>
