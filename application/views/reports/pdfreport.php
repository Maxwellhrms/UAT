<?php
ob_start();
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(True);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// $obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//$obj_pdf->SetDefaultMonospacedFont('helvetica','', 9);
$obj_pdf->SetDefaultMonospacedFont('times','', 9);
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 10);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
?>
<style>
table {text-align: justify;}
p {text-align: justify!important;}
</style>
<html>
      <div style = "text-align:justify" class="cleardiv">
      <span style = "text-align:justify">
         <table align="center" colspan="4" border="0" cellpadding="2"> <thead>
         <tr>
            <th  colspan="1" align="left"><img src="<?php echo base_url() .'assets/img/logopdf.png' ?>" width='10%' height='10%' alt=''></th> 
            <td  colspan="2" align="center"><h2>MAXWELL LOGISTICS PRIVATE LIMITED</h2></td></tr>
        <tr></tr><br> <br>
        <tr><td></td></tr>
        <tr><td></td></tr>
         </thead>    
         <tbody >
        <tr> 
            <td colspan="2" align="left">MAXWELL/SBO/PER & HR </td>
            <td colspan="2" align="left">   Date: </td>
         </tr>
         <tr><td colspan="4" align="left" >Dear</td></tr>
         <tr><td></td></tr>
         <tr><td></td></tr>
         <tr><td colspan="4" align="center" ><h3><u>Sub:APPOINTMENT</u></h3></td></tr>
         <tr><td colspan="4" align="left">With reference to your application dated  __________________________ and the subsequent Interview you had with us, we have pleasure in offering you an employment with us on the following  terms and conditions with effect from _________________</td></tr>
        <tr></tr>
        <tr><td colspan="4" align="left"><b>1.  <u>DESIGNATION :</u></b></td></tr>
        <tr><td colspan="4" align="left" ><p>  You will be designated as</p></td></tr>
        <tr><td colspan="4" align="left"><b>2.  <u>PLACE OF POSTING :</u></b></td></tr>
        <tr><td colspan="4" align="left" ><p>  You will be initially posted at</p></td></tr>
        <tr><td colspan="4" align="left" ><p>   However, during employment with the Corrpany, you are liable to be transferred to any place in India to any of the existing or future branch or subsidiary or associated Company, at the sole discretion of the Management .The Company shall pay at their discretion, reasonable conveyance or train fare for such purpose.</p></td></tr>
        <tr></tr>
        <tr><td colspan="4" align="left"><b>3.  <u>SALARY AND OTHER ALLOWANCE :</u></b></td></tr>
        <tr><td colspan="4" align="left" ><p>        You will be paid a total emoluments of Rs.______________(Rupees__________________________)per month,comprising of the following.</p><br>
        (a)     Basic                            : Rs.<br>
        (b)     Fixed D.A                        : Rs.<br>
        (c)     House Rent & O.A.                : Rs.</td></tr><br>
        <tr><td colspan="4" align="left"><b>4.  <u>PROBATION/CONFIRMATION :</u></b></td></tr>
        <tr><td colspan="4" align="left" ><p>You be Initially on probation for  of six months, Which may be extended by the Management, if deemed necessary. Thereafter, your performance, conduct etc., Is found satisfactory of which the Cornpany will be tho sole judge, your services will be confirmed In writing. Till such confirmation in writing. your services Will be deemed to be on probation. During the period of probation, the appointment is terminable either by the Company or by yourself with 7 days prior notice period. Your services on being confirmed, are liable to be terminated by 30 days notice in writing from either side or salary In lieu Of notice. The company, however reserves their right to accept your resignation with immediate effect and you shall not be entitled to any salary or any other benefits after the effective date from which the resignation is accepted. Your services are liable to be terminated without notice or compensation for any act of misconduct or breach of any rules regulations of the Company or it your performance is not satisfactory. You will automaticalty retire from the services of the Company on attaining the age of 58 years. </p></td></tr>
        <tr><td colspan="4" align="left"><b>5.  <u>DUTIES & responsibilities :</u></b></td></tr>
        <tr><td colspan="4" align="left"><p>
        (a)     During the periad of your service with the Company, you shall carry out your duties and responsibilities dilligently, loyally and to the best of your capabilites.<br>
        (b)     As mobillity of personnel is of paramount importance to a Transport Organisation, you will be roquired to attend to any work or any department, as may be assigned to you from time to time by the Management depending upon the exigencies of work.<br>
        (c)     You should not divulge any official Information or documents of confidential nature to any person while in service or even thereafter.</p></td></tr><br>
        <tr><td colspan="4" align="left"><b>6.  <u>OTHER EMPLOYMENT OF ASSIGNMENT ELSEWHERE NOT PERMISSIBLE :</u></b></td></tr>
        <tr><td colspan="4" align="left"> <p>During the course of employment, you will devote your entire time to the work of the Company and will not Undertake any direct / Indirect business or work, either honorary or remuneratory. If found contrary to the above, Company will not hesitate to take the course of action as deemed fit.</p></td></tr>
        <tr><td colspan="4" align="left"><b>7.  <u>INCREMENTS / PROMOTIONS :</u></b></td></tr>
        <tr><td colspan="4" align="left"><p>The quantum and timing of future increments or promotions shall be based, among other things on merit and Performance, exigencies of the business and shall be at the absolute discretion of the Management.</p></td></tr>
        <tr><td colspan="4" align="left"><b>8.  <u>STATUTORY BENEFITS :</u></b></td></tr>
        <tr><td colspan="4" align="left"><p>The Companys governed by the provision of the Motor Transport Workers Act, 1961. You will also be enitied to the statutory benefits of Provident Fund, Bonus, Gratuity and Leave as per the rules in force from time to time</p></td></tr>
        <tr><td colspan="4" align="left"><b>9.  <u>POSTAL ADDRESS:</u></b></td></tr>
        <tr><td colspan="4" align="left"><p>You shall inform any changes in your address, as given by you to the Company, as your address for all communication. Any Communication or intimation sent to the address furnished by you shall be deemed to have been delivered and received by you for all purposes of such communication or intimation.</p></td></tr>
        <tr><td colspan="4" align="left"><b>10.  <u>MEDICAL FITNESS & VERIFICATION OF PARTICULARS :</u></b></td></tr>        
        <tr><td colspan="4" align="left"><p>The Management has the right to get you medically examined by any certified medical practitioner during tho period of your service. In case you are found medically unfit continue with the job, you wilose your lien on the job. In case, on verification any of the particulars mentioned in your application are found false or Unsatisfactory, your services would be liable for termination without any reason or notice thereof at any time <br>You will be bound by the rules, regulations and orders promulgated by the Company from time to time in relation to conduct, discipline, retirement and any other matter.<br>If the above terms and conditions are acceptable to you, please sign copy of this latter of appointment as token of your acceptance and returm the same to us.<br>We take this opportunity to extend a warm welcome to you to this Organisation and look forward to a long and fruitful association. </p></td></tr>
        <tr><td></td></tr>
        <tr><td colspan="4" align="left">Thanking you</td></tr>
        <tr><td colspan="1" align="left"></td>
            <td colspan="3" align="center">Yours Sincerely </td></tr>
        <tr><td colspan="1" align="left"></td>
            <td colspan="3" align="center">for MAXWELL LOGISTICS PRIVATE LIMITED</td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td colspan="4" align="center" >________________________________________________________________________________________</td></tr>
        <tr><td colspan="4" align="center"><h3><b>ACCEPTANCE</b></h3></td></tr>
        <tr><td colspan="4" align="left">I have read the above terms and conditions and they are acceptable to me. | shall be joining duty on ____________________________.</td></tr>
        <tr><td colspan="2" align="left">Signature Place :</td>
            <td colspan="2" align="left"> Place :</td></tr>
        <tr><td colspan="2" align="left">Date :</td></tr>
         </tbody>
         <fbody>
         <tr><td></td></tr><br><br>
         <tr><td colspan="4" align="center" ><b>_______________________________________________________________________________________</b></td></tr>
         <tr><td colspan="4" align="center">Reed. & Cognrate Office : Surya Towers. 7th Fioor, 105. Sardar Patel Foad, Secunderabad . 003. (AR)</td></tr>
         <tr><td colspan="4" align="center">Phone : 040-30162432, 30482432, 30622432, 27846133. Fax : 040-27817735,</td></tr>
         <tr><td colspan="4" align="center">e-mail ; muwen.hr@grnail.com, Website: ww.v.maxwellpackers.com</td></tr>
         <tr><td colspan="4" align="right">P.T.O</td></tr>
         </fbody>
           </table>
           </span>
           </div>
             </html>


<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, 'R');
$obj_pdf->Output('appointment.pdf', 'I');
?>
