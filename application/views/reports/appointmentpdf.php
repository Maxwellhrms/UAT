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
$obj_pdf->SetDefaultMonospacedFont('helvetica','', 9);
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$obj_pdf->SetFont('helvetica', '', 10);
$obj_pdf->SetDefaultMonospacedFont('times','', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
$cmpoffdt = 'MAXWELL/SBD/PER&HR/M0921/2021';
$date= date('d.M.Y');
$subdate = date('d.m.Y');
$bfdate ='07.05.2021';
$address="Mr.Amarjeet Singh,H.No.277 V.P.O-Jatai, Dist Tech-Bhiwani, Haryana - 127041.";
$add = explode(',',$address);
$addcount = count($add);
$desgna = 'Asst.Branch Manager';
$place ='Delhi Office';
$sal = 390000;
$basal= 16380;
$hrasal = 22620;
$besignna='SANDEEP GORRE';
$besignnarole ='AGM_HR & ADMIN';
?>
<style>
table {text-align: justify;}
p {
    text-align: justify!important;
  }
</style>
<html>
      <div style = "text-align:justify" class="cleardiv">
      <span style = "text-align:justify">
         <table align="center" colspan="4" border="0" cellpadding="2">
        <thead>
            <tr><th colspan="4" align="left"><img src="<?php echo base_url() .'assets/img/logopdf.png' ?>" width='10%' height='10%' alt=''></th> </tr>
            <tr><td></td></tr>
        </thead>    
        <tbody>
        <tr>
                <td colspan="3" align="left"><?php echo $cmpoffdt ?></td>
                <td colspan="3" align="right"><?php echo $date ?></td>
        </tr>
        <tr><td></td></tr>
        <?php if($addcount >0){
            for($i=0; $i<=$addcount; $i++){ ?>
            <tr><td colspan="2" align="left" ><?php if($i==0 ){ ?><b><?php } ?><?php echo $add[$i] ?><?php if($i==0 ){ ?></b><?php } ?></td></tr>
            <?php } } ?>
        <tr><td colspan="2" align="left" >Dear<b> <?php echo $add[0] ?></b></td></tr> 
        <tr><td colspan="4" align="center" ><b>Sub:APPOINTMENT</b></td></tr> <br>
        <tr><td colspan="4" align="left" ><p>With reference to your application and the subsequent interview you had With us, we have pleasure in Offering you an employment With us on the following terms and conditions With effect from <b><?php echo $date ?></b></p></td></tr> 
        <tr><td colspan="4" align="left" ><b>1. DESIGNATION</b></td></tr> 
        <tr><td colspan="4" align="left" ><p>You will be designated as <b><?php echo $desgna; ?></b></p></td></tr>
        <tr><td colspan="4" align="left" ><b>2.PLACE OF POSTING</b></td></tr> 
        <tr><td colspan="4" align="left" ><p>You Will be initially posted at <b><?php echo $place; ?></b>. However, during employment With the Company, you are liable to be transferred to any place in India to any Of the existing or future Branch or subsidiary or associated company, at the sole discretion Of the Managernent. The Company shall pay at their discretion, reasonable conveyance of train fare for such purpose.</p></td></tr> 
        <tr><td colspan="4" align="left" ><b>3. SALARY</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>You will be paid total emoluments of  Rs.<?php echo $sal .'/-'.'('. $salrupee .')' ?> per month, comprising of the following; -</p></td></tr> 
        <tr>
            <td colspan="1" align="left" ></td>
            <td colspan="1" align="left" > (a) Basic   </td>
            <td colspan="1" align="left" > : Rs.<?php echo $basal; ?>/- </td>
            <td colspan="1" align="left" > </td>
        </tr>
        <tr>
            <td colspan="1" align="left" > </td>
            <td colspan="1" align="left" > (b) HRA   </td>
            <td colspan="1" align="left" > : Rs.<?php echo $hrasal; ?>/- </td>
            <td colspan="1" align="left" > </td>
        </tr>
        <tr><td> </td></tr>
        <tr><td colspan="4" align="left" ><b>4. OTHER BENEFITS & STATUTORY BENEFITS</b></td></tr>    
        <tr>
            <td colspan="2" align="left" >(a) Contributory Provident Fund</td>
            <td colspan="2" align="left" ><p>In accordance with the Employees Provident Fund & Miscellaneous Provisions Act 1952 and schemes there under. However, contribution by the employee as well as employer will be 12% of the basic salary.</p></td>
        </tr>    
        <tr>
            <td colspan="2" align="left" >(b) Gratuity</td>
            <td colspan="2" align="left" ><p>In accordance with the "Payment of Gratuity Act".</p></td>
        </tr>   
        <tr>
            <td colspan="2" align="left" >(c) i) Earned Leave</td>
            <td colspan="2" align="left" >Maximum of 18 days per annum according to No. of days worked. </td>
        </tr>
        <tr>
            <td colspan="2" align="left" >ii) Casual Leave</td>
            <td colspan="2" align="left" >6 days per annum,</td>
        </tr>
        <tr>
            <td colspan="2" align="left" >iii) Sick Leave</td>
            <td colspan="2" align="left" >6 days per annum</td>
        </tr> 
        <tr><td colspan="4" align="left" ><b>5. PROBATION / CONFIRMATION</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>You will be initially on probation for a period of six months. which may be extended by the  Management, if deemed necessary. Thereafter, if your performance, conduct etc, is found satisfactory
                                                of Which the Company Will be the sole judge, your services will confirmed in writing. Till such
                                                confirmation in writing your services will be deemed to be on probation. During the period of
                                                probation, the appointment is terminable either by the Company or by yourself with 7 days prior notice period.
                                                Your services on being confirmed, are liable to be terminated by thirty days notice in writing
                                                from either side or salary in lieu of notice. However, your services are liable to terminated without
                                                notice or compensation for any act of misconduct or breach Of any rules and regulations Of the
                                                Company or if your overall performance is not satisfactory. You will automatically retire from
                                                of the Company on attaining the age of 58 years.</p></td></tr> <br>
        <tr><td colspan="4" align="left" ><b>6. DUTIES & RBPONSIBIUTIES</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>(Seperate detailed sheet is enclosed)</p></td></tr> <br>
        <tr><td colspan="4" align="left" ><b>7. INCREMENTS/ PROMOTIONS</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>The quantum and timing of future increments or promotions shall based,
                                             among other things on merit and performance, exigencies of the business and shall be at the absolute discretion of the Management.</p></td></tr> <br>
        <tr><td colspan="4" align="left" ><b>8. OTHER EMPLOYMENT OR ASSIGNMENT ELSEWHERE NOT PERMISSIBLE</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>During the course of employment, you will devote your entire time to the work of the company
                                                and will not undertake any direct / indirect business or work, either honorary or remuneratory. If found
                                                contrary to the above, Company will not hesitate to take the course of action as deemed fit.</p></td></tr> <br>
        <tr><td colspan="4" align="left" ><b>9. MEDICALFITNESS& VERIFICATION OF PARTICULARS</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>The Management has the right to get you medically examined by any certified medical practitioner
                                            during the period of your service. In case you are found medically unfit to continue with the job,
                                            you will lose your lien on the job. In case, on verification any of the particulars mentioned in your
                                            application are found false or unsatisfactory, your services would be liable for termination without
                                            any or notice thereof at any time.</p></td></tr> <br>
        
        <tr><td colspan="4" align="left" ><b>10. POSMLADDRESS</b></td></tr>    
        <tr><td colspan="4" align="left" ><p>You shall inform any change in your address, as given by you to the Comsuny, as your
                                                address for all communication. Any communication or intimation sent to the address
                                                furnished by you shall be deemed to have been delivered and received by you for all
                                                purposes of such communication or intimation.</p></td></tr> <br>
        <tr><td colspan="4" align="left" ><p> You will be bound by rules, regulations and orders promulgated by the Company from time to time in
                                        relation to conduct, discipline, retirement and any other matter. You should not divulge any official
                                        information or documents of confidential nature to any person while in service or even thereafter.<br>                               
                                        If the above terms and conditions are acceptable to you, please sign copy of this letter of appointment
                                        in token of your acceptance and return the same to us.<br>
                                        We take this opportunity to extend a warn welcome to you to this organisation and look forward to a
                                        long and fruitful association.</p></td></tr>    
        <tr><td colspan="4" align="left" >Thanking You, </td></tr>
            <tr>
                <td colspan="2" align="left" ></td>
                <td colspan="2" align="center" > Yours sincerely, </td>
            </tr>
            <tr>
                <td colspan="2" align="left" ></td>
                <td colspan="2" align="center" >For<b><?php echo ' MAXWELL RELOCATIONS' ?></b></td>
            </tr>
            <tr><td></td></tr><br>
            <tr><td colspan="2" align="left" ></td>
                <td colspan="2" align="center" ><?php echo $besignna; ?></td>
            </tr>
            <tr><td colspan="2" align="left" ></td>
                <td colspan="2" align="center" ><b><?php echo $besignnarole; ?></b></td>
            </tr>
            <tr><td></td></tr>
             <tr><td></td></tr>
             <tr><td colspan="4" align="center"><b><u>ACCEPTANCE</u></b></td></tr>
            <tr><td  colspan="4" align="left" >I have read the above terms and conditions and they are acceptable to me.</td></tr>
            <tr><td></td></tr>
            <tr><td colspan="2" align="left">Signature:</td>            </tr>
             <tr><td colspan="3" align="left">Date :</td>
             <td colspan="1" align="left"> Place :</td></tr>
    </tbody>      
    <tfooter>
    <tr><td></td></tr><br><br> 
    <tr><td></td></tr><br><br> 
    <tr><td></td></tr><br><br> 
         <tr>
         <?php if($addcount >0){ ?>
             <td colspan="1" align="left">
             <?php 
            for($i=0; $i<=$addcount; $i++){ ?>
           <?php echo $add[$i]; ?><br>
            <?php } } ?>
         </td>
         <td colspan="2" align="left">CIN: U63030TG2007PTC056069</td>
         <td colspan="1" align="right"><p>
         <img src="<?php echo base_url() .'assets/img/favicon.gif' ?>" width='10%' height='10%' alt=''>
         <img src="<?php echo base_url() .'assets/img/favicon.gif' ?>" width='10%' height='10%' alt=''>
         <img src="<?php echo base_url() .'assets/img/favicon.gif' ?>" width='10%' height='10%' alt=''>       
         </p></td></tr>
    </tfooter> 
           </table>
           </span>
           </div>
             </html>
<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, 'R');
$obj_pdf->Output('offer.pdf', 'I');
?>
