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

$htmldec = $userinfo['desc'];

$obj_pdf->writeHTML($htmldec, true, false, true, false, '');

$obj_pdf->AddPage();

// $reporterdetails = getemployeebyusingid($list['ticketdetails'][0]->work_reporting);
// $historylog = getcommonquerydata('work_company_wise_dashboard',array('dash_processid','dash_shortname','dash_color','createdtime','createdby','modifiedtime','modifyby'),
// 			array('dash_project_id' => $this->session->userdata('user_selected_project'),'dash_company_id' => $this->session->userdata('user_company')));
// $ticketloginfo = array();

// foreach ($historylog as $hkey => $hval) {
// 	$ticketloginfo[$hval->dash_processid] = $hval->dash_color.'~'.$hval->dash_shortname;
// }

// if(array_key_exists($list['ticketdetails'][0]->work_current_status, $ticketloginfo)){
// 	$x1 = explode('~',$ticketloginfo[$list['ticketdetails'][0]->work_current_status]);
// 	$currentstatuscolor = $x1[0];
// 	$currentstatus = $x1[1];
// }else{
// 	$currentstatuscolor = '';
// 	$currentstatus = '';
// }	

// if($list['ticketdetails'][0]->work_start_date != '0000-00-00'){ $requeststart = date('d M Y', strtotime($list['ticketdetails'][0]->work_start_date));}else{ $requeststart = '';}
// if($list['ticketdetails'][0]->work_end_date != '0000-00-00'){ $eta = date('d M Y', strtotime($list['ticketdetails'][0]->work_end_date));}else{ $eta = ''; }
// $createdby = getemployeebyusingid($list['ticketdetails'][0]->createdempid);

// if($list['ticketdetails'][0]->work_priority == 1){
// $priority = 'Highest';
// }elseif($list['ticketdetails'][0]->work_priority == 2){
// $priority = 'Normal';
// }elseif($list['ticketdetails'][0]->work_priority == 3){
// $priority = 'Lowest';
// }else{
// $priority = '';
// }

// $html = '<h2 align="center">'.$list['ticketdetails'][0]->Ticketid.'</h2>';

// $html .='
// <table>
//  <tr><td width="30%"><b>Client : </b></td><td width="40%"><b>'.$controller->cms_company_options('work_company',$list['ticketdetails'][0]->work_company_id,'2').'</b></td></tr>
//  <tr><td width="30%"><b>Project : </b></td><td width="40%"><b>'.$controller->cms_project_options('work_projects',$list['ticketdetails'][0]->work_projects,'2').'</b></td></tr>
//  <tr><td width="30%"><b>Module : </b></td><td width="40%"><b>'.$controller->cms_category_options('cat_name',$list['ticketdetails'][0]->work_category,'2').'</b></td></tr>
//  <tr><td width="30%"><b>Work Type : </b></td><td width="40%"><b>'.$controller->cms_display_options('work_type',$list['ticketdetails'][0]->work_type,'2').'</b></td></tr>
//  <tr><td width="30%"><b>Requested To Start : </b></td><td width="40%"><b>'.$requeststart.'</b></td></tr>
//  <tr><td width="30%"><b>ETA : </b></td><td width="40%"><b>'.$eta.'</b></td></tr>
//  <tr><td width="30%"><b>Priority : </b></td><td width="40%"><b>'.$priority.'</b></td></tr>
//  <tr><td width="30%"><b>Created : </b></td><td width="40%"><b>'.date('d M Y H:i:s', strtotime($list['ticketdetails'][0]->createdtime)).'</b></td></tr>
//  <tr><td width="30%"><b>Created by : </b></td><td width="40%"><b>'.$createdby[0]->employee_name.'</b></td></tr>
//  <tr><td width="30%"><b>Status : </b></td><td width="40%"><b>'.$currentstatus.'</b></td></tr>
//  <tr><td width="30%"><b>Cost : </b></td><td width="70%" style="color:red"><b>'.number_format($list['ticketdetails'][0]->work_price, 2, ".", ",").' ( '.getIndianCurrency($list['ticketdetails'][0]->work_price).')</b></td></tr>
// </table>';

// $html .= '<h3>'.$list['ticketdetails'][0]->work_title.'</h3>';
// $html .= $list['ticketdetails'][0]->work_description;

// $html .='
// <table border="1" cellpadding="2" cellspacing="2" align="center">
//  <tr nobr="true">
//   <th colspan="2"><b>Worked By</b></th>
//  </tr>
//  <tr><td><b>Assigned To</b></td><td><b>Reporting To</b></td></tr>
//  <tr nobr="true">
//   <td>'.$list['ticketdetails'][0]->employee_name.'<br />'.$list['ticketdetails'][0]->employee_email.'<br />'.$list['ticketdetails'][0]->employee_mobile.'</td>
//   <td>'.$reporterdetails[0]->employee_name.'<br />'.$reporterdetails[0]->employee_email.'<br />'.$reporterdetails[0]->employee_mobile.'</td>
//  </tr>
// </table>';

// if(count($list['checklist']) > 0){
// $html.='<br><br><br>';
// $html .= '
// <table border="1" nobr="true" cellpadding="2" cellspacing="2">
//  <tr><th colspan="3" align="center"><b>Check List / Things To Do</b></th></tr>';
//  	$ckno =1; foreach ($list['checklist'] as $ckkey => $ckvalue) {if($ckvalue->ck_work_status == 1){ $ck_status = 'DONE'; }else{ $ck_status = 'PENDING'; }
//  	$html .= '<tr><td>'.$ckno.'</td><td>'.$ckvalue->ck_desc.'</td><td>'.$ck_status.'</td></tr>';
// 	$ckno++; }
// $html .="</table>";
// }

// if(count($list['worklogdetails']) > 0){
// $html.='<br><br><br>';
// 	$html .= '
// 	<table border="1" nobr="true" cellpadding="2" cellspacing="2">
// 	 <tr><th colspan="5" align="center"><b>Worklog</b></th></tr>
// 	 <tr><td><b>Sno</b></td><td><b>Logged By</b></td><td><b>Start Date</b></td><td><b>End Date</b></td><td><b>Time Spent</b></td></tr>
// 	 ';
// 	 	$wlgno = 1; foreach ($list['worklogdetails'] as $wkey => $wvalue) {
// 	 	$html .= '<tr><td>'.$wlgno.'</td><td>'.$wvalue->worklog_user_name.'</td><td>'.date('d M Y', strtotime($wvalue->worklog_startdate)).'</td><td>'.date('d M Y', strtotime($wvalue->worklog_enddate)).'</td><td>'.$wvalue->worklog_time .' Hours/Minutes</td></tr><tr><td colspan="5">'.strip_tags($wvalue->worklog_comment).'</td></tr>';
// 		$wlgno++; }
// 	$html .="</table>";
// }

// if(count($list['progresslog']) > 0){
// $html.='<br><br><br>';
// 	$html .= '
// 	<table border="1" nobr="true" cellpadding="2" cellspacing="2">
// 	 <tr><th colspan="5" align="center"><b>Ticket History</b></th></tr>
// 	 <tr><td><b>Sno</b></td><td><b>From</b></td><td><b>To</b></td><td><b>Moved By</b></td><td><b>Moved Time</b></td></tr>
// 	 ';
// 	 	$tkno = 1; foreach ($list['progresslog'] as $pkey => $pvalue) {
// 		if(array_key_exists($pvalue->came_from, $ticketloginfo)){
// 			$x = explode('~',$ticketloginfo[$pvalue->came_from]);
// 			$camestatus = $x[0];
// 			$camefrom = $x[1];
// 		}else{
// 			$camestatus = '';
// 			$camefrom = '';
// 		}
// 		if(array_key_exists($pvalue->dropped_to, $ticketloginfo)){
// 			$x1 = explode('~',$ticketloginfo[$pvalue->dropped_to]);
// 			$droppedstatus = $x1[0];
// 			$droppedto = $x1[1];
// 		}else{
// 			$droppedstatus = '';
// 			$droppedto = '';
// 		}
// 	 	$html .= '<tr><td>'.$tkno.'</td><td>'.$camefrom.'</td><td>'.$droppedto.'</td><td>'.$pvalue->createdby.'</td><td>'.date('d M Y H:i:s A', strtotime($pvalue->createdtime)).'</td></tr>';
// 		$tkno++; }
// 	$html .="</table>";
// }

// if(count($list['comments']) > 0){
// $html.='<br><br><br>';
// $html .='<h4>Discussion</h4>';
// $html .='<hr>';
// 	foreach ($list['comments'] as $cmkey => $cmval) { 
// if(!empty($cmval->modifiedtime) && $cmval->modifiedtime != '0000-00-00 00:00:00'){ $comments_date = 'Edited  '.date('d-m-Y H:i A', strtotime($cmval->modifiedtime));}else{$comments_date = date('d-m-Y H:i A', strtotime($cmval->createdtime));}

// 		$html.='<h4>'.$cmval->ticket_commentar_name.'</h4>';
// 		$html .=$cmval->ticket_commentar_comment;
// 		$html .='<span align="right">'.$comments_date.'</span>';
// 		$html .='<hr>';
// 	}
// }

$obj_pdf->writeHTML($html, true, false, true, false, '');


$content = ob_get_contents();

// $obj_pdf->writeHTML($content, true, false, true, false, 'R');
ob_end_clean();
$obj_pdf->Output($ave, 'F');
?>
