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
$cmpoffdt = 'MAXWELL/PER&HR/OFFER/01/2021';
$date= date('d.m.Y');
$subdate = date('d.m.Y');
$bfdate ='07.05.2021';
$address="Mr.S.Shashi Kant,Flat no.301 Devi Apartment,Triumala Nagar.A.P.H.B colony,Moula Ali Hyderbad-500040.";
$add = explode(',',$address);
$addcount = count($add);
$name= 'Mr.S.Shashi Kant,';
$position ='"Sr.Executive -Operations"';
$gmname= 'MR.Ranjan Kumar Ray,';
$designation ='General Manager,';
$ofadd = 'Secunderabad(Regd.& Corporate) Office ';
$fulladd ='Surya Towers 7th Floor 105,S.P.Road Secunderabad-500 003';
$fadd = explode(',',$fulladd);
$faddcount = count($fadd);
$rlett= '"Relieving Letter"';
$besignna='SANDEEP GORRE';
$besignnarole ='AGM_HR & ADMIN';
?>
<style>
table {text-align: justify;}
p {text-align: justify!important;}
</style>
<html>
      <div style = "text-align:justify" class="cleardiv">
      <span style = "text-align:justify">
         <table align="center" colspan="4" border="0" cellpadding="2">
        <thead>
            <tr><th colspan="4" align="center"><img src="<?php echo base_url() .'assets/img/logopdf.png' ?>" width='10%' height='10%' alt=''></th> </tr>
            <tr><th colspan="4" align="center"><h1>MAXWELL LOGISTICS PRIVATE LIMITED</h1></th> </tr>
            <tr><th colspan="4" align="center">(An ISO 9001 : 2015 Certtified Company)</th> </tr>
            <tr><th colspan="4" align="center">Regd . & Corporate Office : Surya Towers, 7th Floor,105,S>P>Road,Secunderbad -500003.<br> Telangana Ph:040-27846133,27846135 Fax : 040-27817735,<br>E-mail:std@maxwell.net.in,Web:WWW.maxwelllogistics.net</th> </tr>
            <tr><th colspan="4" align="center">CIN : U63030TG2007PTC056069</th> </tr><br>
        </thead>    
        <tbody>
            <tr>
                <td colspan="3" align="left"><?php echo $cmpoffdt ?></td>
                <td colspan="3" align="right"><?php echo $date ?></td>
            </tr>
            <?php if($addcount >0){
                for($i=0; $i<=$addcount; $i++){ ?>
            <tr><td colspan="2" align="left" ><b><?php echo $add[$i] ?></b></td></tr>
            <?php } } ?>
            <tr><td colspan="2" align="left" ><b>Dear <?php echo $name ?></b></td></tr>
            <tr><td colspan="4" align="center" >Sub: Your application and subsequent interview held on <?php echo $subdate ?> for <br>the position of <b><?php echo $position ?>.</b></td></tr>
            <tr><td colspan="4" align="center" ><p>With reference to the above, we are pleased to inform you that we have considered your candidature for the post of <b><?php echo $position ?> </b>on the terms and conditions discussed and agreed by you at the time of interview.</p></td></tr>
            <tr><td colspan="4" align="left" ><p>You will report to <b><?php echo  $gmname . $designation ?></b> join the services on or before <?php $bfdate ?> Secunderabad (Regd. & Corporate) Office and address as below:</p></td></tr>
            <tr><td colspan="4" align="center" > <?php if($faddcount >0 ){ 
                for($i=0; $i<$faddcount; $i++){ ?>
                 <b> <?php  echo $fadd[$i]; ?></b><?php if($i != $faddcount-1){ ?><br>  <?php } } } ?>     </td></tr>
            <tr><td colspan="4" align="left" ><p> Along with <b><?php echo $rlett; ?></b> from your Present Employer</p></td></tr>
            <tr><td colspan="4" align="left" ><p>If you fail to join the duty on the aforesaid date, this offer will stand automatically cancelled. After joining the duty, you will be given a detailed Appointment Letter containing your Duties and Responsibilities with the terms and conditions of your appointment.</p></td></tr>
            <tr><td colspan="4" align="left" ><p>Please retum the duplicate copy of this letter as acknowledgment of acceptancc. We take this opportunity to extend a warm welcome to you in this organization and look forward to a long and fruitful association.</p></td></tr>
            <tr><td colspan="4" align="left" >Thanking You, </td></tr>
            <tr>
                <td colspan="2" align="left" ></td>
                <td colspan="2" align="center" > Yours sincerely, </td>
            </tr>
            <tr>
                <td colspan="2" align="left" ></td>
                <td colspan="2" align="center" ><b><?php echo 'For MAXWELL LOGISTICS PVT.LTD' ?></b></td>
            </tr>
            <tr><td colspan="2" align="left" ></td>
                <td colspan="2" align="center" ><b><?php echo $besignna; ?></b></td>
            </tr>
            <tr><td colspan="2" align="left" ></td>
                <td colspan="2" align="center" ><b><?php echo $besignnarole; ?></b></td>
            </tr>
            <tr><td  colspan="4" align="left" ><b>I accept and confirm the above</b></td></tr>
            <tr><td colspan="4" align="left"><b>_________________________</b></td></tr>
            <tr><td colspan="4" align="left" ><b>Signature & Date </b></td></tr>
        </tbody>       
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
