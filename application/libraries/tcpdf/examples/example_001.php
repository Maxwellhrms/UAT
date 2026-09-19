<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<!Doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Stores Receipt Cum Inspection Report</title>
   
        <style>
            
            .table {
    width: 87% !important;
}
            b {
    font-size: 14px;
}
            
            body {
    font-family: sans-serif;
    border: 3px solid;
    padding: 12px 10px 13px 10px;
}
            td {
    text-align: -webkit-left;
    line-height: 1.8;
    
    padding: 9px 23px 8px 9px !important;
}
    
        
        font.ctr {
    line-height: 1.8;
}
tr {
    line-height: 1.8;
}
        
        
        b.su_name {
    font-weight: 100;
    font-size: 12px;
    font-family: sans-serif;
}
        
        
        b.su_right {
    /* float: right; */
    padding: 0px 16px 49px 138px;
    margin: 0 0 0 73px;
    font-weight: 100;
}

    th {
    padding: 10px 10px 4px 13px !important;
}
   
   p.net-ab {
    FLOAT: RIGHT;
    PADDING: 18px 463px 0 0;
}     
  
p.net-abD {
    FLOAT: right;
        padding:20px 414px 0 0;
            
               
}

p.rupe_sts {
    padding:56px 0px 11px 1000px;
}
   p.other_charg {
    margin: 8px 377px 2px 5px;
} 

p.nrm {
    font-weight: 100;
}



b.su_rightd {
    margin: 0 11px 10px 233px;
    font-weight: 100;
}


td.su_name {
    border-bottom: 2px solid;
}


.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: middle !important;
    border-top: 1px solid #ddd;
}
 </style>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
 
    </head>
    <body>
        <!-- bootstrap adding  -->
        
        <div class="container-fluid">
        

        <center><b><font size="6" class=" ctr">USHA KIRON MOVIES LTD</font><br />(<font size="">RFC - HYDERABAD</font>)<br /></center>
            <center><br/><u style="font-size: 16px;">STORES RECEIPT CUM INSPECTION REPORT</u></b> </center><center><table width="75%" class="table" border="2px" cellpadding="0" cellspacing="0" ><tr><td align="left" width="50%" rowspan="2" style="font-size: 12px;"><b class="su_name">SUPPLIER NAME :&nbsp;</b> <b>TARA HARDWARE MART</b><br><b class="su_name">DC.NO :</b>&nbsp;<b>7885</b>  <b class="su_right">DC DATE :</b><b>30/06/2017</b><br><b class="su_name">INV.NO :</b>&nbsp;<b></b>  <b class="su_rightd">INV DATE :</b><b>01/01/1970</b><br><b class="su_name">RECEIPT DATE :</b>&nbsp;<b> 30/06/2017</b> &nbsp;&nbsp;&nbsp;<br><b class="su_name">VEHICLE NO :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> </b> &nbsp;&nbsp;&nbsp;<br><td colspan="2" style="font-size: 12px;"     border: 2px solid; <b class="su_name">GRN NO:&nbsp; <b> 1317010901000097</b> &nbsp;&nbsp;&nbsp;<br><b class="su_name">GRN DATE :</b>&nbsp;<b>30/06/2017</b><br><b class="su_name">SPOT :</b>&nbsp;<b></b> &nbsp;&nbsp;&nbsp;&nbsp;<br><b class="su_name">PURPOSE :  </b><b></b><br><b class="su_name">INDENTOR NO :</b>&nbsp; <b> 1017100901000359  </b>&nbsp;&nbsp;&nbsp;<br><b class="su_name">INDENTOR NAME :</b> &nbsp; <b>PHANI </b>&nbsp;&nbsp;&nbsp;</td><br></tr></table></center><div style="width: 100%;" align="c"><br></div><center><table width="65%"  class="table" border="2px solid" cellpadding="0" cellspacing="0" ><tr><th style="font-size: 12px;"> SNO </th><th style="font-size: 12px;"> DESCRIPTION </th><th style="font-size: 12px;"> UOM </th><th>PACK</th><th>MAKE</th><th style="font-size: 12px;"> PO NO. </th><th>Spl Dis</th><th style="font-size: 12px; text-align:center" colspan="2">Ex.Duty</th><th style="font-size: 12px; text-align:center" colspan="2">CST</th><th style="font-size: 12px; text-align:center" colspan="2">VAT</th><th></th><th></th><th></th><td align="right" colspan="6" style="font-size:12px"></td></tr><tr><th style="font-size: 12px;">Challan Qty </th><th style="font-size: 12px;">Received Qty </th><th style="font-size: 12px;">Accepted </th><th style="font-size: 12px;">Rejected </th><th style="font-size: 12px;"> Rate </th><th style="font-size: 12px;"> Basic Amt </th><th style="font-size: 12px;"> Discount </th><th style="font-size: 12px;"> % </th><th style="font-size: 12px;"> Amount </th><th style="font-size: 12px;"> % </th><th style="font-size: 12px;"> Amount </th><th style="font-size: 12px;"> % </th><th style="font-size: 12px;"> Amount </th><th style="font-size: 12px;"> FRT </th><th style="font-size: 12px;"> INS </th><th style="font-size: 12px;"> Other </th><th style="font-size: 12px; " colspan="6" > Total Amount </th></tr><tr><td align="right" style="font-size: 12px;"> 1 </td><td align="left" style="font-size: 12px;"> H.S.S.DRILL BIT 3MM </td><td align="right" style="font-size: 12px;"> NOS </td><td align="center" style="font-size: 12px;">----</td><td align="center" style="font-size: 12px;">----</td><td align="right" style="font-size: 12px;"> UKML/300/2017-18 </td><td align="center" style="font-size: 12px;">0</td><td align="right" style="font-size: 12px;"> 0 </td><td align="right" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;"> 5 </td><td align="center" style="font-size: 12px;">77 </td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;"> 0</td><td align="center" colspan="6"  style="font-size: 12px;"></td></tr><tr><td align="right" style="font-size: 12px;">100.00 </td><td align="right" style="font-size: 12px;">100.00 </td><td align="right" style="font-size: 12px;">100.00 </td><td align="right" style="font-size: 12px;">0.00 </td><td align="right" style="font-size: 12px;"> 44.00 </td><td align="right" style="font-size: 12px;">4,400.00 </td><td align="right" style="font-size: 12px;">2,860.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">5.00</td><td align="right" style="font-size: 12px;">77.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" colspan="6" style="font-size: 12px;">1,617.00</td></tr><tr><td align="right" style="font-size: 12px;"> 2 </td><td align="left" style="font-size: 12px;"> MARBLE CUTTING BLADE 4" </td><td align="right" style="font-size: 12px;"> NOS </td><td align="center" style="font-size: 12px;">----</td><td align="center" style="font-size: 12px;">----</td><td align="right" style="font-size: 12px;"> UKML/300/2017-18 </td><td align="center" style="font-size: 12px;">0</td><td align="right" style="font-size: 12px;"> 0 </td><td align="right" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;"> 5 </td><td align="center" style="font-size: 12px;">175 </td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;">0</td><td align="center" style="font-size: 12px;"> 0</td><td align="center" colspan="6"  style="font-size: 12px;">4400</td></tr><tr><td align="right" style="font-size: 12px;">50.00 </td><td align="right" style="font-size: 12px;">50.00 </td><td align="right" style="font-size: 12px;">50.00 </td><td align="right" style="font-size: 12px;">0.00 </td><td align="right" style="font-size: 12px;"> 70.00 </td><td align="right" style="font-size: 12px;">3,500.00 </td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">5.00</td><td align="right" style="font-size: 12px;">175.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" style="font-size: 12px;">0.00</td><td align="right" colspan="6" style="font-size: 12px;">3,675.00</td></tr><tr><td align="center"  colspan = "3" style="font-size: 12px; text-align:center"><b>Total Basic Value: </b></td><td align = "right" style="font-size: 12px;"></td><td></td><td align = "right" style="font-size: 12px;"><b>₹&nbsp;</b><b>7,900.00</b></td><td></td><td align="right"  colspan = "3" style="font-size: 12px;"><td align="right" colspan = "5" style="font-size: 12px; text-align:right"><b>TOTAL:</b></td><td align="right" colspan="7" style="font-size:12px; "><b style="margin: 0px 0px 3px 50px; ">&nbsp;₹&nbsp;</b><b>5,292.00</b> </td></tr></table></center>
     
     <div class="row">
          
                    
<div class="col-md-12">
                <center><table width="60%" class="table table-bordered"><p class="net-abD" align='center' style="font-size: 14px;font-size: 14px;"><b> NET AMOUNT: ₹ 3,675.00</b></td><p align='center'class="rupe_sts" height='20' style="font-size: 13px;"> <b> ( ₹ Rupees Three Thousand Six Hundred  And Seventy Five  Only)</p></table></center> </div>
         
         
      </div>
            <div class="container-fluid" style="text-align: -webkit-center;">
            <div class="row">
                
                <div class="col-md-3"> <b>ENTERED BY :</b>
                    <br/><p class="nrm"> CH.CHALAPATHI RAO </p><p class="nrm">17-07-2017, 17:16:00</p></div>
                  
                  <div class="col-md-3"><b>STORES IN-CHARGE :</b></div>
                  <div class="col-md-3"><b> PURCHASE DEPT :</b></div>
                  <div class="col-md-3"><b>ACCOUNTS DEPT :</b></div>
                  
            
            
            </div>  <!--Row ends here -->
      
            </div>
       
      
        <center><button id="printpagebutton" type ="button" name="print" onclick="printpage();">PRINT</button></center>        
        </div><!--  main container ends here -->
    </body>
</html>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
