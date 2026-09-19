<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Common.php';
require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel.php';
require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel/Worksheet/Drawing.php';


class Export_paysheet extends Common
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Adminmodel');  
        $this->load->model('Salaries_model');
        
    }
    public function export()
    {
        $exportType = 'ss';
        // Load the PHPExcel library manually
        // require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
        
        // require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel/Writer/PDF/tcPDF.php';


        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();

        // Sample data
        $data = [
            ['ID', 'Name', 'Email'],
            [1, 'John Doe', 'john@example.com'],
            [2, 'Jane Doe', 'jane@example.com'],
            [3, 'Jim Doe', 'jim@example.com'],
        ];
        $colIndex = 0;
        $rowIndex = 1;
        
        #FIRST ROW
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, 'DIVISION');
        $sheet->mergeCells('C1:F1');
        $sheet->setCellValueByColumnAndRow($colIndex+2, $rowIndex, 'LOGISTICS / RELOCATION');
        $sheet->mergeCells('G1:V1');
        $sheet->setCellValueByColumnAndRow($colIndex+6, $rowIndex, 'PAY SHEET FOR ON ROLL EMPLOYEES');
        $sheet->mergeCells('W1:AG1');
        $sheet->setCellValueByColumnAndRow($colIndex+22, $rowIndex, 'MAXWELL-F03/HRD/PAYS/00');
        
        #SECOND ROW
        $sheet->mergeCells('A2:B2');
        $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex+1, 'PAYSHEET FOR:\nTOTAL WORKING DAYS:\nCompany PF Code:');
        // Enable text wrapping for the cell
        $sheet->getStyleByColumnAndRow($colIndex, $rowIndex + 1)->getAlignment()->setWrapText(true);
        $sheet->mergeCells('C2:F2');
        $sheet->setCellValueByColumnAndRow($colIndex+1, $rowIndex+1, 'June-2024 30.00 AP/HYD/59887');
        $sheet->mergeCells('G2:V2');
        $sheet->setCellValueByColumnAndRow($colIndex+2, $rowIndex+1, 'MAXWELL LOGISTICS PRIVATE LIMITED');
        $sheet->mergeCells('W2:AB2');
        $sheet->setCellValueByColumnAndRow($colIndex+2, $rowIndex+1, 'BRANCH CODE:\n BRANCH NAME:\n CBS DATE:');
        $sheet->mergeCells('AC2:AG2');
        $sheet->setCellValueByColumnAndRow($colIndex+2, $rowIndex+1, '');
        
        #THIRD ROW
        // Merge cells from A3 to A5
        $sheet->mergeCells('A3:A5');
        $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex + 2, 'EMP CODE/ UAN NO');
        $sheet->mergeCells('B3:C3');
        $sheet->mergeCells('B3:B5');
        $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 2, 'EMP NAME');
        $sheet->mergeCells('D3:D5');
        $sheet->setCellValueByColumnAndRow($colIndex + 2, $rowIndex + 2, 'NO. OF DAYS WOR KED');
        $sheet->mergeCells('E3:E5');
        $sheet->setCellValueByColumnAndRow($colIndex + 3, $rowIndex + 2, 'SUNDAYS');
        $sheet->mergeCells('F3:F5');
        $sheet->setCellValueByColumnAndRow($colIndex + 4, $rowIndex + 2, 'PUBLIC/ OH HOLIDAYS');
        
        $sheet->mergeCells('G3:I3');
        $sheet->setCellValueByColumnAndRow($colIndex + 7, $rowIndex + 3, 'LEAVE WITH PAY');
        $sheet->mergeCells('G4:G5');
        $sheet->setCellValueByColumnAndRow($colIndex + 7, $rowIndex + 4, 'EL');
        $sheet->mergeCells('H4:H5');
        $sheet->setCellValueByColumnAndRow($colIndex + 8, $rowIndex + 4, 'CL');
        $sheet->mergeCells('I4:I5');
        $sheet->setCellValueByColumnAndRow($colIndex + 9, $rowIndex + 4, 'SL');
        
        $sheet->mergeCells('J3:J3');
        $sheet->setCellValueByColumnAndRow($colIndex + 10, $rowIndex + 3, '');
        $sheet->mergeCells('J4:J5');
        $sheet->setCellValueByColumnAndRow($colIndex + 10, $rowIndex + 4, '');
        $sheet->mergeCells('k3:k5');
        $sheet->setCellValueByColumnAndRow($colIndex + 11, $rowIndex + 3, 'WITH OUT PAY');
        $sheet->mergeCells('L3:L5');
        $sheet->setCellValueByColumnAndRow($colIndex + 12, $rowIndex + 3, 'TOT AL PAY DAYS');
        
        $sheet->mergeCells('M3:O3');
        $sheet->setCellValueByColumnAndRow($colIndex + 12, $rowIndex + 3, 'RATE OF');
        $sheet->mergeCells('M4:M5');
        $sheet->setCellValueByColumnAndRow($colIndex + 12, $rowIndex + 4, 'BASIC');
        $sheet->mergeCells('N4:N5');
        $sheet->setCellValueByColumnAndRow($colIndex + 13, $rowIndex + 4, 'HRA');
        $sheet->mergeCells('O4:O5');
        $sheet->setCellValueByColumnAndRow($colIndex + 14, $rowIndex + 4, 'OTH ER');
        
        $sheet->mergeCells('P3:R3');
        $sheet->setCellValueByColumnAndRow($colIndex + 15, $rowIndex + 3, 'EARNINGS');
        $sheet->mergeCells('P4:P5');
        $sheet->setCellValueByColumnAndRow($colIndex + 15, $rowIndex + 4, 'BASIC');
        $sheet->mergeCells('Q4:Q5');
        $sheet->setCellValueByColumnAndRow($colIndex + 16, $rowIndex + 4, 'HRA');
        $sheet->mergeCells('R4:R5');
        $sheet->setCellValueByColumnAndRow($colIndex + 17, $rowIndex + 4, 'MISC. INCOME');
        
        $sheet->mergeCells('S4:S5');
        $sheet->setCellValueByColumnAndRow($colIndex + 18, $rowIndex + 3, 'TOTAL EARN INGS');
        
        $sheet->mergeCells('T3:AA3');
        $sheet->setCellValueByColumnAndRow($colIndex + 19, $rowIndex + 3, 'DEDUCTIONS');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 20, $rowIndex + 4, 'PF');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 21, $rowIndex + 4, 'ESI');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 22, $rowIndex + 4, 'PR. TAX');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 23, $rowIndex + 4, 'TDS');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 24, $rowIndex + 4, 'M TW');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 25, $rowIndex + 4, 'MISC DEDUCTIONS');
        $sheet->mergeCells('T4:T5');
        $sheet->setCellValueByColumnAndRow($colIndex + 26, $rowIndex + 4, 'ST.AD V');
        
        $sheet->mergeCells('AB3:AB5');
        $sheet->setCellValueByColumnAndRow($colIndex + 27, $rowIndex + 3, 'TOTAL DEDUCTIONS');
        $sheet->mergeCells('AC3:AC5');
        $sheet->setCellValueByColumnAndRow($colIndex + 28, $rowIndex + 3, 'NET AMT PAID');
        
         $sheet->mergeCells('AD3:AG3');
        $sheet->setCellValueByColumnAndRow($colIndex + 29, $rowIndex + 3, 'BALANCE');
        $sheet->mergeCells('AD4:AD5');
        $sheet->setCellValueByColumnAndRow($colIndex + 20, $rowIndex + 4, 'Staff Adv');
        $sheet->mergeCells('AE4:AE5');
        $sheet->setCellValueByColumnAndRow($colIndex + 21, $rowIndex + 4, 'EL');
        $sheet->mergeCells('AF4:AF5');
        $sheet->setCellValueByColumnAndRow($colIndex + 22, $rowIndex + 4, 'CL');
        $sheet->mergeCells('AG4:AG5');
        $sheet->setCellValueByColumnAndRow($colIndex + 23, $rowIndex + 4, 'SL');
        
        
         // Set column widths
        $sheet->getColumnDimension('A')->setWidth(25); // Set width of column A
        $sheet->getColumnDimension('B')->setWidth(30); // Set width of column B
        $sheet->getColumnDimension('C')->setWidth(12); // Set width of column C
        $sheet->getColumnDimension('E')->setWidth(12); // Set width of column C
        $sheet->getColumnDimension('E')->setWidth(12); // Set width of column C
        
        
        // Define the style array for borders
        $borderStyle = [
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN, // Border style (thin, medium, dashed, etc.)
                    'color' => ['rgb' => '000000'], // Border color (black in this case)
                ],
            ],
        ];
        
        // Apply the border style to a specific cell or range of cells
        $sheet->getStyle('A1:AG1')->applyFromArray($borderStyle); // Applies borders to the range A1 to V1
        
        // Example: Apply borders to a single cell
        $sheet->getStyleByColumnAndRow($colIndex + 23, $rowIndex + 1)->applyFromArray($borderStyle);

        // // Merge cells A1:C1
        // $sheet->mergeCells('A1:C1');

        // // Set value in the merged cell
        // $sheet->setCellValue('A1', 'Merged Header');

        // // Loop through the data and write it to the sheet
        // foreach ($data as $rowIndex => $row) {
        //     foreach ($row as $colIndex => $value) {
        //         $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 2, $value);
        //     }
        // }
        if($exportType == 'pdf'){
            // Configure the PDF renderer
            PHPExcel_Settings::setPdfRenderer(
                PHPExcel_Settings::PDF_RENDERER_TCPDF,
                APPPATH . 'libraries/tcpdf/'
            );
            // Set the filename
            $filename = 'exported_data.pdf';
    
            // Set the paper size and orientation (optional)
            $objPHPExcel->getActiveSheet()->getPageSetup()
                        ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                        ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

            // Create PDF Writer
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
            // Output to browser
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
        }else{
            // Set the filename
            $filename = 'exported_data.xlsx';
    
            // Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
           
        }
        $objWriter->save('php://output');
        exit;
        
    }
  
   


    public function checkDataExist(){
        $userdata = $this->input->post();
        
        
        $date = $userdata['date'];
        $company = $userdata['company'];
        $divison = $userdata['divison'];
        $state = $userdata['state'];
        $branch = $userdata['branch'];
        $emptype = $userdata['emptype'];
     
        
        $paysheet_array = $this->Salaries_model->getPaysheet($date,$company,$divison,$state,$branch,$emptype,'','');
        if(count($paysheet_array) > 0){
            $message = "data found";
            getjsondata(1,$message);
        }else{
            $message = "No data found try other";
            getjsondata(0,$message);
        }
    }
    public function generate_paysheet_sha() {
        
        $date = '10-2024';
        $company = '1';
        $divison = '1';
        $state = '2';
        $branch = '23';
        $emptype = '4';
        $exportType = 'pdf';
        // $userdata = $this->input->post();
        
        
        // $date = $userdata['date'];
        $ex = explode("-",$date);
        $month = $ex[0];
        $year = $ex[1];
        // $company = $userdata['company'];
        // $divison = $userdata['divison'];
        // $state = $userdata['state'];
        // $branch = $userdata['branch'];
        // $emptype = $userdata['emptype'];
        // $exportType = $userdata['export_type'];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        $paysheet_array = $this->Salaries_model->getPaysheet($date,$company,$divison,$state,$branch,$emptype,'','');
        // print_r($paysheet_array);exit;
        if(count($paysheet_array) > 0){
            $divisionName = $paysheet_array[0]->mxd_name;
            $branchCode = $paysheet_array[0]->mxb_short_code;
            $branchName = $paysheet_array[0]->mxb_name;
            $monthYearName = date('F - Y',strtotime('01-'.$date));
            
            // Create a new PHPExcel object
            $objPHPExcel = new PHPExcel();
            $sheet = $objPHPExcel->getActiveSheet();
    
            // Sample data
            $data = [
                ['ID', 'Name', 'Email'],
                [1, 'John Doe', 'john@example.com'],
                [2, 'Jane Doe', 'jane@example.com'],
                [3, 'Jim Doe', 'jim@example.com'],
            ];
    
            $colIndex = 1;
            $rowIndex = 1;
    
            // FIRST ROW
            $sheet->mergeCells('A'.$rowIndex.':B'.$rowIndex);
            $sheet->setCellValue('A'.$rowIndex, 'DIVISION');
            $sheet->mergeCells('C1:F1');
            $sheet->setCellValue('C'.$rowIndex, $divisionName);
            $sheet->mergeCells('G1:V'.$rowIndex);
            $sheet->setCellValue('G'.$rowIndex, 'PAY SHEET FOR ON ROLL EMPLOYEES');
            $sheet->mergeCells('W1:AG'.$rowIndex);
            $sheet->setCellValue('W'.$rowIndex, 'MAXWELL-F03/HRD/PAYS/00');
    
            $rowIndex = $rowIndex + 1;
            // SECOND ROW
            $sheet->mergeCells('A2:B'.$rowIndex);
            $sheet->setCellValue('A'.$rowIndex, "PAYSHEET FOR:\nTOTAL WORKING DAYS:\nCompany PF Code:");
            $sheet->getStyle('A'.$rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('A'.$rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
            $sheet->mergeCells('C2:F'.$rowIndex);
            $sheet->setCellValue('C'.$rowIndex, $monthYearName.'\n'.$daysInMonth.'\n AP/HYD/59887');
            $sheet->getStyle('C'.$rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('C'.$rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
            $sheet->mergeCells('G2:V'.$rowIndex);
            $sheet->setCellValue('G'.$rowIndex, 'MAXWELL LOGISTICS PRIVATE LIMITED');
            $sheet->mergeCells('W2:AB'.$rowIndex);
            $sheet->setCellValue('W'.$rowIndex, "BRANCH CODE:\nBRANCH NAME:\nCBS DATE:");
             $sheet->getStyle('W'.$rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('W'.$rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
            
            $sheet->mergeCells('AC2:AG'.$rowIndex);
            $sheet->setCellValue('AC'.$rowIndex, $branchCode.' '.$branchName.' ');
            $sheet->getRowDimension($rowIndex)->setRowHeight(50);
    
            $rowIndex = $rowIndex + 1;
            // THIRD ROW
            $sheet->mergeCells('A3:A5');
            $sheet->setCellValue('A'.$rowIndex, 'EMP CODE/ UAN NO');
            $sheet->mergeCells('B3:B5');
            $sheet->setCellValue('B'.$rowIndex, 'EMP NAME');
            
            $sheet->mergeCells('C3:D5');
            $sheet->setCellValue('C'.$rowIndex, 'NO. OF DAYS WORKED');
            $sheet->mergeCells('E3:E5');
            $sheet->setCellValue('E'.$rowIndex, 'SUNDAYS');
            $sheet->mergeCells('F3:F5');
            $sheet->setCellValue('F'.$rowIndex, 'PUBLIC/ OH HOLIDAYS');
    
            $sheet->mergeCells('G3:I'.$rowIndex);
            $sheet->setCellValue('G'.$rowIndex, 'LEAVE WITH PAY');
            $sheet->mergeCells('G4:G5');
            $sheet->setCellValue('G4', 'EL');
            $sheet->mergeCells('H4:H5');
            $sheet->setCellValue('H4', 'CL');
            $sheet->mergeCells('I4:I5');
            $sheet->setCellValue('I4', 'SL');
            $sheet->mergeCells('J4:J5');
            $sheet->setCellValue('J4', 'ML');
    
            $sheet->mergeCells('K3:K5');
            $sheet->setCellValue('K3', 'WITH OUT PAY');
            $sheet->mergeCells('L3:L5');
            $sheet->setCellValue('L3', 'TOTAL PAY DAYS');
    
            $sheet->mergeCells('M3:O3');
            $sheet->setCellValue('M3', 'RATE OF');
            $sheet->mergeCells('M4:M5');
            $sheet->setCellValue('M4', 'BASIC');
            $sheet->mergeCells('N4:N5');
            $sheet->setCellValue('N4', 'HRA');
            $sheet->mergeCells('O4:O5');
            $sheet->setCellValue('O4', 'OTHER');
    
            $sheet->mergeCells('P3:R3');
            $sheet->setCellValue('P3', 'EARNINGS');
            $sheet->mergeCells('P4:P5');
            $sheet->setCellValue('P4', 'BASIC');
            $sheet->mergeCells('Q4:Q5');
            $sheet->setCellValue('Q4', 'HRA');
            $sheet->mergeCells('R4:R5');
            $sheet->setCellValue('R4', 'MISC. INCOME');
    
            $sheet->mergeCells('S3:S5');
            $sheet->setCellValue('S3', 'TOTAL EARNINGS');
    
            $sheet->mergeCells('T3:Z3');
            $sheet->setCellValue('T3', 'DEDUCTIONS');
            $sheet->mergeCells('T4:T5');
            $sheet->setCellValue('T4', 'PF');
            $sheet->mergeCells('U4:U5');
            $sheet->setCellValue('U4', 'ESI');
            $sheet->mergeCells('V4:V5');
            $sheet->setCellValue('V4', 'PR. TAX');
            $sheet->mergeCells('W4:W5');
            $sheet->setCellValue('W4', 'TDS');
            $sheet->mergeCells('X4:X5');
            $sheet->setCellValue('X4', 'M TW');
            $sheet->mergeCells('Y4:Y5');
            $sheet->setCellValue('Y4', 'MISC DEDUCTIONS');
            $sheet->mergeCells('Z4:Z5');
            $sheet->setCellValue('Z4', 'ST.AD V');
    
            $sheet->mergeCells('AA3:AB5');
            $sheet->setCellValue('AA3', 'TOTAL DEDUCTIONS');
            $sheet->mergeCells('AC3:AC5');
            $sheet->setCellValue('AC3', 'NET AMT PAID');
    
            $sheet->mergeCells('AD3:AG3');
            $sheet->setCellValue('AD3', 'BALANCE');
            $sheet->mergeCells('AD4:AD5');
            $sheet->setCellValue('AD4', 'Staff Adv');
            $sheet->mergeCells('AE4:AE5');
            $sheet->setCellValue('AE4', 'EL');
            $sheet->mergeCells('AF4:AF5');
            $sheet->setCellValue('AF4', 'CL');
            $sheet->mergeCells('AG4:AG5');
            $sheet->setCellValue('AG4', 'SL');
            
            $rowIndex = 6;
            // DATA 
            foreach($paysheet_array as $paysheetData){
                
                $leaves_data =  $this->Salaries_model->get_leaves_count_data($paysheetData->mxsal_emp_code,$year."_".$month);
               
                $html_data .= "<td>$paysheet_data->mxsal_emp_days_in_month</td>";
                $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
                
              
                $wo = $leaves_data[0]->Week_Off;
                $html_data .= "<td>".$wo."</td>";

                $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave; 
                $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave; 
                $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave; 
                //----------NEW BY SHABABU(12-06-2022)
                $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave; 
                //----------NEW BY SHABABU(12-06-2022)
                $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent; 
                $public_holiday = $PH + $OH;
                $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL;
                
                $sheet->setCellValue('A'.$rowIndex, $paysheetData->mxsal_emp_code);//emp code
                $sheet->setCellValue('A'.($rowIndex + 1), $paysheetData->mxemp_emp_uan_number);// emp uan number
                
                $sheet->setCellValue('B'.$rowIndex, $paysheetData->mxemp_emp_fname.' '.$paysheetData->mxemp_emp_lname);
                $sheet->setCellValue('B'.($rowIndex + 1), 'SIGN OF EMP');
                //present days
                $sheet->mergeCells('C'.$rowIndex.':D'.($rowIndex + 1));
                $sheet->setCellValue('C'.$rowIndex, $present_days);
                
                //sundays
                $sheet->mergeCells('E'.$rowIndex.':E'.($rowIndex + 1));
                $sheet->setCellValue('E'.$rowIndex, $wo);
                
                //PH + OH
                $sheet->mergeCells('F'.$rowIndex.':F'.($rowIndex + 1));
                $sheet->setCellValue('F'.$rowIndex, $public_holiday);
                
                //EL
                $sheet->mergeCells('G'.$rowIndex.':G'.($rowIndex + 1));
                $sheet->setCellValue('G'.$rowIndex, $EL);
                //CL
                $sheet->mergeCells('H'.$rowIndex.':H'.($rowIndex + 1));
                $sheet->setCellValue('H'.$rowIndex, $CL);
                //SL
                $sheet->mergeCells('I'.$rowIndex.':I'.($rowIndex + 1));
                $sheet->setCellValue('I'.$rowIndex, $SL);
                //ML
                $sheet->mergeCells('J'.$rowIndex.':J'.($rowIndex + 1));
                $sheet->setCellValue('J'.$rowIndex, $ML);
                //Without pay(LOP)
                $sheet->mergeCells('K'.$rowIndex.':K'.($rowIndex + 1));
                $sheet->setCellValue('K'.$rowIndex, $LOP);
                
                //TOTAL PAY DAYS
                $sheet->mergeCells('L'.$rowIndex.':L'.($rowIndex + 1));
                $sheet->setCellValue('L'.$rowIndex, $total_days);
                
                //RATE OF BASIC
                $sheet->mergeCells('M'.$rowIndex.':M'.($rowIndex + 1));
                $sheet->setCellValue('M'.$rowIndex, $paysheetData->mxsal_basic);
                //RATE OF HRA
                $sheet->mergeCells('N'.$rowIndex.':N'.($rowIndex + 1));
                $sheet->setCellValue('N'.$rowIndex, $paysheetData->mxsal_hra);
                //RATE OF OTHER
                $sheet->mergeCells('O'.$rowIndex.':O'.($rowIndex + 1));
                $sheet->setCellValue('O'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                
                //EARNINGS BASIC
                $sheet->mergeCells('P'.$rowIndex.':P'.($rowIndex + 1));
                $sheet->setCellValue('P'.$rowIndex, $paysheetData->mxsal_actual_basic);
                //EARNINGS HRA
                $sheet->mergeCells('Q'.$rowIndex.':Q'.($rowIndex + 1));
                $sheet->setCellValue('Q'.$rowIndex, $paysheetData->mxsal_actual_hra);
                //EARNINGS MISC. INCOME
                $sheet->mergeCells('R'.$rowIndex.':R'.($rowIndex + 1));
                $sheet->setCellValue('R'.$rowIndex, $paysheetData->mxsal_incentive_amount);
                
                //TOTAL EARNINGS(GROSS)
                $sheet->mergeCells('S'.$rowIndex.':S'.($rowIndex + 1));
                $sheet->setCellValue('S'.$rowIndex, $paysheetData->mxsal_actual_gross);
                
                //DEDUCTIONS PF
                $sheet->mergeCells('T'.$rowIndex.':T'.($rowIndex + 1));
                $sheet->setCellValue('T'.$rowIndex, $paysheetData->mxsal_pf_emp_cont);
                //DEDUCTIONS ESI
                $sheet->mergeCells('U'.$rowIndex.':U'.($rowIndex + 1));
                $sheet->setCellValue('U'.$rowIndex, $paysheetData->mxsal_esi_emp_cont);
                //DEDUCTIONS PR.TAX
                $sheet->mergeCells('V'.$rowIndex.':V'.($rowIndex + 1));
                $sheet->setCellValue('V'.$rowIndex, $paysheetData->mxsal_pt);
                //DEDUCTIONS TDS
                $sheet->mergeCells('W'.$rowIndex.':W'.($rowIndex + 1));
                $sheet->setCellValue('W'.$rowIndex, $paysheetData->mxsal_tds_amount);
                //DEDUCTIONS LWF
                $sheet->mergeCells('X'.$rowIndex.':X'.($rowIndex + 1));
                $sheet->setCellValue('X'.$rowIndex, $paysheetData->mxsal_lwf_emp_cont);
                //DEDUCTIONS MISC DEDUCTIONS
                $sheet->mergeCells('Y'.$rowIndex.':Y'.($rowIndex + 1));
                $sheet->setCellValue('Y'.$rowIndex, $paysheetData->mxsal_miscelleneous_amount);
                //DEDUCTIONS ST.ADV
                $sheet->mergeCells('Z'.$rowIndex.':Z'.($rowIndex + 1));
                $sheet->setCellValue('Z'.$rowIndex, $paysheetData->mxsal_loan_amount);
                
                //TOTAL DEDUCTIONS
                $sheet->mergeCells('AA'.$rowIndex.':AB'.($rowIndex + 1));
                $sheet->setCellValue('AA'.$rowIndex, $paysheetData->mxsal_total_ded);
                
                //NET AMT PAID
                $sheet->mergeCells('AC'.$rowIndex.':AC'.($rowIndex + 1));
                $sheet->setCellValue('AC'.$rowIndex, $paysheetData->mxsal_net_sal);
                
                //BALANCE STAFF ADV
                $sheet->mergeCells('AD'.$rowIndex.':AD'.($rowIndex + 1));
                $sheet->setCellValue('AD'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //BALANCE EL
                $sheet->mergeCells('AE'.$rowIndex.':AE'.($rowIndex + 1));
                $sheet->setCellValue('AE'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //BALANCE CL
                $sheet->mergeCells('AF'.$rowIndex.':AF'.($rowIndex + 1));
                $sheet->setCellValue('AF'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //BALANCE SL
                $sheet->mergeCells('AG'.$rowIndex.':AG'.($rowIndex + 1));
                $sheet->setCellValue('AG'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                // INCREASE INDEX
                $rowIndex += 2;
            }
            
            
            
    
            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(25);
            $sheet->getColumnDimension('B')->setWidth(30);
            $sheet->getColumnDimension('C')->setWidth(12);
            $sheet->getColumnDimension('D')->setWidth(15);
            $sheet->getColumnDimension('E')->setWidth(12);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(10);
            $sheet->getColumnDimension('H')->setWidth(10);
            $sheet->getColumnDimension('I')->setWidth(10);
            $sheet->getColumnDimension('J')->setWidth(15);
            $sheet->getColumnDimension('K')->setWidth(15);
            $sheet->getColumnDimension('L')->setWidth(15);
            $sheet->getColumnDimension('M')->setWidth(10);
            $sheet->getColumnDimension('N')->setWidth(10);
            $sheet->getColumnDimension('O')->setWidth(10);
            $sheet->getColumnDimension('P')->setWidth(10);
            $sheet->getColumnDimension('Q')->setWidth(10);
            $sheet->getColumnDimension('R')->setWidth(15);
            $sheet->getColumnDimension('S')->setWidth(15);
            $sheet->getColumnDimension('T')->setWidth(10);
            $sheet->getColumnDimension('U')->setWidth(10);
            $sheet->getColumnDimension('V')->setWidth(10);
            $sheet->getColumnDimension('W')->setWidth(10);
            $sheet->getColumnDimension('X')->setWidth(10);
            $sheet->getColumnDimension('Y')->setWidth(15);
            $sheet->getColumnDimension('Z')->setWidth(10);
            $sheet->getColumnDimension('AA')->setWidth(10);
            $sheet->getColumnDimension('AB')->setWidth(15);
            $sheet->getColumnDimension('AC')->setWidth(15);
            $sheet->getColumnDimension('AD')->setWidth(10);
            $sheet->getColumnDimension('AE')->setWidth(10);
            $sheet->getColumnDimension('AF')->setWidth(10);
            $sheet->getColumnDimension('AG')->setWidth(10);
    
            // Define the style array for borders
            $borderStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
    
            // Apply borders to the entire table structure
            $sheet->getStyle('A1:AG5')->applyFromArray($borderStyle);
    
            // Export as Excel or PDF
            if ($exportType == 'pdf') {
                PHPExcel_Settings::setPdfRenderer(
                    PHPExcel_Settings::PDF_RENDERER_TCPDF,
                    APPPATH . 'libraries/tcpdf/'
                );
                $filename = 'exported_data.pdf';
                $objPHPExcel->getActiveSheet()->getPageSetup()
                    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
                header('Content-Type: application/pdf');
            } else {
                $filename = 'exported_data.xlsx';
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            }
    
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit;
        }else{
            $message = "No data found try other";
            getjsondata(0,$message);
        }
        
    }
    
    public function generate_paysheetPDF() {
        
        // Increase limits at the start
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 300);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        // Clean any existing output
        if (ob_get_length()) ob_end_clean();
       
         $date = '10-2024';
        $company = '1';
        $divison = '1';
        $state = '2';
        $branch = '23';
        $emptype = '4';
        $exportType = 'pdf';
        // $userdata = $this->input->post();
    
        // $date = $userdata['date'];
        $ex = explode("-", $date);
        $month = $ex[0];
        $year = $ex[1];
        // $company = $userdata['company'];
        // $divison = $userdata['divison'];
        // $state = $userdata['state'];
        // $branch = $userdata['branch'];
        // $emptype = $userdata['emptype'];
        // $exportType = $userdata['export_type'];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        $paysheet_array = $this->Salaries_model->getPaysheet($date, $company, $divison, $state, $branch, $emptype, '', '');
        
        if (count($paysheet_array) > 0) {
            $divisionName = $paysheet_array[0]->mxd_name;
            $branchCode = $paysheet_array[0]->mxb_short_code;
            $branchName = $paysheet_array[0]->mxb_name;
            $monthYearName = date('F - Y', strtotime('01-' . $date));
    
            // Create a new PHPExcel object
            $objPHPExcel = new PHPExcel();
            $sheet = $objPHPExcel->getActiveSheet();
    
            // Define the style array for borders
            $borderStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
    
            // Initialize row index
            $rowIndex = 1;
    
            // FIRST ROW
            $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
            $sheet->setCellValue('A' . $rowIndex, 'DIVISION');
            $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
            $sheet->setCellValue('C' . $rowIndex, $divisionName);
            $sheet->mergeCells('G' . $rowIndex . ':V' . $rowIndex);
            $sheet->setCellValue('G' . $rowIndex, 'PAY SHEET FOR ON ROLL EMPLOYEES');
            $sheet->mergeCells('W' . $rowIndex . ':AG' . $rowIndex);
            $sheet->setCellValue('W' . $rowIndex, 'MAXWELL-F03/HRD/PAYS/00');
    
            // Apply borders to the first row
            $sheet->getStyle('A' . $rowIndex . ':AG' . $rowIndex)->applyFromArray($borderStyle);
    
            $rowIndex++;
    
            // SECOND ROW
            $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
            $sheet->setCellValue('A' . $rowIndex, "PAYSHEET FOR:\nTOTAL WORKING DAYS:\nCompany PF Code:");
            $sheet->getStyle('A' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('A' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
    
            $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
            $sheet->setCellValue('C' . $rowIndex, $monthYearName . '\n' . $daysInMonth . '\n AP/HYD/59887');
            $sheet->getStyle('C' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('C' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
    
            $sheet->mergeCells('G' . $rowIndex . ':V' . $rowIndex);
            $sheet->setCellValue('G' . $rowIndex, 'MAXWELL LOGISTICS PRIVATE LIMITED');
    
            $sheet->mergeCells('W' . $rowIndex . ':AB' . $rowIndex);
            $sheet->setCellValue('W' . $rowIndex, "BRANCH CODE:\nBRANCH NAME:\nCBS DATE:");
            $sheet->getStyle('W' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('W' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
    
            $sheet->mergeCells('AC' . $rowIndex . ':AG' . $rowIndex);
            $sheet->setCellValue('AC' . $rowIndex, $branchCode . ' ' . $branchName . ' ');
            $sheet->getRowDimension($rowIndex)->setRowHeight(50);
    
            // Apply borders to the second row
            $sheet->getStyle('A' . $rowIndex . ':AG' . $rowIndex)->applyFromArray($borderStyle);
    
            $rowIndex++;
    
            // THIRD ROW (HEADER)
            $sheet->mergeCells('A' . $rowIndex . ':A' . ($rowIndex + 2));
            $sheet->setCellValue('A' . $rowIndex, 'EMP CODE/ UAN NO');
            $sheet->mergeCells('B' . $rowIndex . ':B' . ($rowIndex + 2));
            $sheet->setCellValue('B' . $rowIndex, 'EMP NAME');
    
            $sheet->mergeCells('C' . $rowIndex . ':D' . ($rowIndex + 2));
            $sheet->setCellValue('C' . $rowIndex, 'NO. OF DAYS WORKED');
    
            $sheet->mergeCells('E' . $rowIndex . ':E' . ($rowIndex + 2));
            $sheet->setCellValue('E' . $rowIndex, 'SUNDAYS');
    
            $sheet->mergeCells('F' . $rowIndex . ':F' . ($rowIndex + 2));
            $sheet->setCellValue('F' . $rowIndex, 'PUBLIC/ OH HOLIDAYS');
    
            $sheet->mergeCells('G' . $rowIndex . ':I' . $rowIndex);
            $sheet->setCellValue('G' . $rowIndex, 'LEAVE WITH PAY');
            $sheet->mergeCells('G' . ($rowIndex + 1) . ':G' . ($rowIndex + 2));
            $sheet->setCellValue('G' . ($rowIndex + 1), 'EL');
            $sheet->mergeCells('H' . ($rowIndex + 1) . ':H' . ($rowIndex + 2));
            $sheet->setCellValue('H' . ($rowIndex + 1), 'CL');
            $sheet->mergeCells('I' . ($rowIndex + 1) . ':I' . ($rowIndex + 2));
            $sheet->setCellValue('I' . ($rowIndex + 1), 'SL');
    
            $sheet->mergeCells('J' . ($rowIndex + 1) . ':J' . ($rowIndex + 2));
            $sheet->setCellValue('J' . ($rowIndex + 1), 'ML');
    
            $sheet->mergeCells('K' . $rowIndex . ':K' . ($rowIndex + 2));
            $sheet->setCellValue('K' . $rowIndex, 'WITH OUT PAY');
    
            $sheet->mergeCells('L' . $rowIndex . ':L' . ($rowIndex + 2));
            $sheet->setCellValue('L' . $rowIndex, 'TOTAL PAY DAYS');
    
            $sheet->mergeCells('M' . $rowIndex . ':O' . $rowIndex);
            $sheet->setCellValue('M' . $rowIndex, 'RATE OF');
            $sheet->mergeCells('M' . ($rowIndex + 1) . ':M' . ($rowIndex + 2));
            $sheet->setCellValue('M' . ($rowIndex + 1), 'BASIC');
            $sheet->mergeCells('N' . ($rowIndex + 1) . ':N' . ($rowIndex + 2));
            $sheet->setCellValue('N' . ($rowIndex + 1), 'HRA');
            $sheet->mergeCells('O' . ($rowIndex + 1) . ':O' . ($rowIndex + 2));
            $sheet->setCellValue('O' . ($rowIndex + 1), 'OTHER');
    
            $sheet->mergeCells('P' . $rowIndex . ':R' . $rowIndex);
            $sheet->setCellValue('P' . $rowIndex, 'EARNINGS');
            $sheet->mergeCells('P' . ($rowIndex + 1) . ':P' . ($rowIndex + 2));
            $sheet->setCellValue('P' . ($rowIndex + 1), 'BASIC');
            $sheet->mergeCells('Q' . ($rowIndex + 1) . ':Q' . ($rowIndex + 2));
            $sheet->setCellValue('Q' . ($rowIndex + 1), 'HRA');
            $sheet->mergeCells('R' . ($rowIndex + 1) . ':R' . ($rowIndex + 2));
            $sheet->setCellValue('R' . ($rowIndex + 1), 'MISC. INCOME');
    
            $sheet->mergeCells('S' . $rowIndex . ':S' . ($rowIndex + 2));
            $sheet->setCellValue('S' . $rowIndex, 'TOTAL EARNINGS');
    
            $sheet->mergeCells('T' . $rowIndex . ':Z' . $rowIndex);
            $sheet->setCellValue('T' . $rowIndex, 'DEDUCTIONS');
            $sheet->mergeCells('T' . ($rowIndex + 1) . ':T' . ($rowIndex + 2));
            $sheet->setCellValue('T' . ($rowIndex + 1), 'PF');
            $sheet->mergeCells('U' . ($rowIndex + 1) . ':U' . ($rowIndex + 2));
            $sheet->setCellValue('U' . ($rowIndex + 1), 'ESI');
            $sheet->mergeCells('V' . ($rowIndex + 1) . ':V' . ($rowIndex + 2));
            $sheet->setCellValue('V' . ($rowIndex + 1), 'PR. TAX');
            $sheet->mergeCells('W' . ($rowIndex + 1) . ':W' . ($rowIndex + 2));
            $sheet->setCellValue('W' . ($rowIndex + 1), 'TDS');
            $sheet->mergeCells('X' . ($rowIndex + 1) . ':X' . ($rowIndex + 2));
            $sheet->setCellValue('X' . ($rowIndex + 1), 'M TW');
            $sheet->mergeCells('Y' . ($rowIndex + 1) . ':Y' . ($rowIndex + 2));
            $sheet->setCellValue('Y' . ($rowIndex + 1), 'MISC DEDUCTIONS');
            $sheet->mergeCells('Z' . ($rowIndex + 1) . ':Z' . ($rowIndex + 2));
            $sheet->setCellValue('Z' . ($rowIndex + 1), 'ST.AD V');
    
            $sheet->mergeCells('AA' . $rowIndex . ':AB' . ($rowIndex + 2));
            $sheet->setCellValue('AA' . $rowIndex, 'TOTAL DEDUCTIONS');
    
            $sheet->mergeCells('AC' . $rowIndex . ':AC' . ($rowIndex + 2));
            $sheet->setCellValue('AC' . $rowIndex, 'NET AMT PAID');
    
            $sheet->mergeCells('AD' . $rowIndex . ':AG' . $rowIndex);
            $sheet->setCellValue('AD' . $rowIndex, 'BALANCE');
            $sheet->mergeCells('AD' . ($rowIndex + 1) . ':AD' . ($rowIndex + 2));
            $sheet->setCellValue('AD' . ($rowIndex + 1), 'Staff Adv');
            $sheet->mergeCells('AE' . ($rowIndex + 1) . ':AE' . ($rowIndex + 2));
            $sheet->setCellValue('AE' . ($rowIndex + 1), 'EL');
            $sheet->mergeCells('AF' . ($rowIndex + 1) . ':AF' . ($rowIndex + 2));
            $sheet->setCellValue('AF' . ($rowIndex + 1), 'CL');
            $sheet->mergeCells('AG' . ($rowIndex + 1) . ':AG' . ($rowIndex + 2));
            $sheet->setCellValue('AG' . ($rowIndex + 1), 'SL');
    
            // Apply borders to the third row (header)
            $sheet->getStyle('A' . $rowIndex . ':AG' . ($rowIndex + 2))->applyFromArray($borderStyle);
    
            $rowIndex += 3;
            
            $totalRateOfBasic = $totalRateOfHra = $totalRateOfOther = $totalEarningsBasic = $totalEarningsHra = $totalEarningsMicInc = $totalEarningsGross = $totalDeductionPf = $totalDeductionEsi = $totalDeductionPt = $totalDeductionTds = $totalDeductionLwf = $totalDeductionMiscDed = $totalDeductionStfAdv = $totalNetSal = $totalDeductions =0;
            $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
            // DATA ROWS
            foreach ($paysheet_array as $paysheetData) {
                $leaves_data = $this->Salaries_model->get_leaves_count_data($paysheetData->mxsal_emp_code, $year . "_" . $month);
    
                $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present + $leaves_data[0]->First_Half_Present_Cl_Applied + $leaves_data[0]->Second_Half_Present_Cl_Applied + $leaves_data[0]->First_Half_Present_Sl_Applied + $leaves_data[0]->Second_Half_Present_Sl_Applied + $leaves_data[0]->First_Half_Present_El_Applied + $leaves_data[0]->Second_Half_Present_El_Applied;
    
                $wo = $leaves_data[0]->Week_Off;
                $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
                $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
                $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
                $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave;
                $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
                $public_holiday = $PH + $OH;
                $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL;
    
                // Write data for the current employee
                $sheet->setCellValue('A' . $rowIndex, $paysheetData->mxsal_emp_code); // Emp code
                $sheet->setCellValue('A' . ($rowIndex + 1), $paysheetData->mxemp_emp_uan_number); // Emp UAN number
    
                $sheet->setCellValue('B' . $rowIndex, $paysheetData->mxemp_emp_fname . ' ' . $paysheetData->mxemp_emp_lname); // Employee name
                $sheet->setCellValue('B' . ($rowIndex + 1), 'SIGN OF EMP'); // Signature placeholder
    
                // Present days
                $sheet->mergeCells('C' . $rowIndex . ':D' . ($rowIndex + 1));
                $sheet->setCellValue('C' . $rowIndex, $present_days);
    
                // Sundays
                $sheet->mergeCells('E' . $rowIndex . ':E' . ($rowIndex + 1));
                $sheet->setCellValue('E' . $rowIndex, $wo);
    
                // PH + OH
                $sheet->mergeCells('F' . $rowIndex . ':F' . ($rowIndex + 1));
                $sheet->setCellValue('F' . $rowIndex, $public_holiday);
    
                // EL
                $sheet->mergeCells('G' . $rowIndex . ':G' . ($rowIndex + 1));
                $sheet->setCellValue('G' . $rowIndex, $EL);
    
                // CL
                $sheet->mergeCells('H' . $rowIndex . ':H' . ($rowIndex + 1));
                $sheet->setCellValue('H' . $rowIndex, $CL);
    
                // SL
                $sheet->mergeCells('I' . $rowIndex . ':I' . ($rowIndex + 1));
                $sheet->setCellValue('I' . $rowIndex, $SL);
    
                //ML
                $sheet->mergeCells('J'.$rowIndex.':J'.($rowIndex + 1));
                $sheet->setCellValue('J'.$rowIndex, $ML);
                //Without pay(LOP)
                $sheet->mergeCells('K'.$rowIndex.':K'.($rowIndex + 1));
                $sheet->setCellValue('K'.$rowIndex, $LOP);
                
                //TOTAL PAY DAYS
                $sheet->mergeCells('L'.$rowIndex.':L'.($rowIndex + 1));
                $sheet->setCellValue('L'.$rowIndex, $total_days);
                
                //RATE OF BASIC
                $totalRateOfBasic += $paysheetData->mxsal_basic;
                $sheet->mergeCells('M'.$rowIndex.':M'.($rowIndex + 1));
                $sheet->setCellValue('M'.$rowIndex, $paysheetData->mxsal_basic);
                //RATE OF HRA
                $totalRateOfHra += $paysheetData->mxsal_hra;
                $sheet->mergeCells('N'.$rowIndex.':N'.($rowIndex + 1));
                $sheet->setCellValue('N'.$rowIndex, $paysheetData->mxsal_hra);
                //RATE OF OTHER
                $totalRateOfOther += $paysheetData->mxsal_variable_pay_sha;
                $sheet->mergeCells('O'.$rowIndex.':O'.($rowIndex + 1));
                $sheet->setCellValue('O'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                
                //EARNINGS BASIC
                $totalEarningsBasic += $paysheetData->mxsal_actual_basic;
                $sheet->mergeCells('P'.$rowIndex.':P'.($rowIndex + 1));
                $sheet->setCellValue('P'.$rowIndex, $paysheetData->mxsal_actual_basic);
                //EARNINGS HRA
                $totalEarningsHra += $paysheetData->mxsal_actual_hra;
                $sheet->mergeCells('Q'.$rowIndex.':Q'.($rowIndex + 1));
                $sheet->setCellValue('Q'.$rowIndex, $paysheetData->mxsal_actual_hra);
                //EARNINGS MISC. INCOME
                $totalEarningsMicInc += $paysheetData->mxsal_incentive_amount;
                $sheet->mergeCells('R'.$rowIndex.':R'.($rowIndex + 1));
                $sheet->setCellValue('R'.$rowIndex, $paysheetData->mxsal_incentive_amount);
                
                //TOTAL EARNINGS(GROSS)
                $totalEarningsGross += $paysheetData->mxsal_actual_gross;
                $sheet->mergeCells('S'.$rowIndex.':S'.($rowIndex + 1));
                $sheet->setCellValue('S'.$rowIndex, $paysheetData->mxsal_actual_gross);
                
                //DEDUCTIONS PF
                $totalDeductionPf += $paysheetData->mxsal_pf_emp_cont;
                $sheet->mergeCells('T'.$rowIndex.':T'.($rowIndex + 1));
                $sheet->setCellValue('T'.$rowIndex, $paysheetData->mxsal_pf_emp_cont);
                //DEDUCTIONS ESI
                $totalDeductionEsi += $paysheetData->mxsal_esi_emp_cont;
                $sheet->mergeCells('U'.$rowIndex.':U'.($rowIndex + 1));
                $sheet->setCellValue('U'.$rowIndex, $paysheetData->mxsal_esi_emp_cont);
                //DEDUCTIONS PR.TAX
                $totalDeductionPt += $paysheetData->mxsal_pt;
                $sheet->mergeCells('V'.$rowIndex.':V'.($rowIndex + 1));
                $sheet->setCellValue('V'.$rowIndex, $paysheetData->mxsal_pt);
                //DEDUCTIONS TDS
                $totalDeductionTds += $paysheetData->mxsal_tds_amount;
                $sheet->mergeCells('W'.$rowIndex.':W'.($rowIndex + 1));
                $sheet->setCellValue('W'.$rowIndex, $paysheetData->mxsal_tds_amount);
                //DEDUCTIONS LWF
                $totalDeductionLwf += $paysheetData->mxsal_lwf_emp_cont;
                $sheet->mergeCells('X'.$rowIndex.':X'.($rowIndex + 1));
                $sheet->setCellValue('X'.$rowIndex, $paysheetData->mxsal_lwf_emp_cont);
                //DEDUCTIONS MISC DEDUCTIONS
                $totalDeductionMiscDed += $paysheetData->mxsal_miscelleneous_amount;
                $sheet->mergeCells('Y'.$rowIndex.':Y'.($rowIndex + 1));
                $sheet->setCellValue('Y'.$rowIndex, $paysheetData->mxsal_miscelleneous_amount);
                //DEDUCTIONS ST.ADV
                $totalDeductionStfAdv += $paysheetData->mxsal_loan_amount;
                $sheet->mergeCells('Z'.$rowIndex.':Z'.($rowIndex + 1));
                $sheet->setCellValue('Z'.$rowIndex, $paysheetData->mxsal_loan_amount);
                
                //TOTAL DEDUCTIONS
                $totalDeductions += $paysheetData->mxsal_total_ded;
                $sheet->mergeCells('AA'.$rowIndex.':AB'.($rowIndex + 1));
                $sheet->setCellValue('AA'.$rowIndex, $paysheetData->mxsal_total_ded);
                
                //NET AMT PAID
                $totalNetSal += $paysheetData->mxsal_net_sal;
                $sheet->mergeCells('AC'.$rowIndex.':AC'.($rowIndex + 1));
                $sheet->setCellValue('AC'.$rowIndex, $paysheetData->mxsal_net_sal);
                
                //BALANCE STAFF ADV
                $sheet->mergeCells('AD'.$rowIndex.':AD'.($rowIndex + 1));
                $sheet->setCellValue('AD'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //BALANCE EL
                $sheet->mergeCells('AE'.$rowIndex.':AE'.($rowIndex + 1));
                $sheet->setCellValue('AE'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //BALANCE CL
                $sheet->mergeCells('AF'.$rowIndex.':AF'.($rowIndex + 1));
                $sheet->setCellValue('AF'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //BALANCE SL
                $sheet->mergeCells('AG'.$rowIndex.':AG'.($rowIndex + 1));
                $sheet->setCellValue('AG'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                // INCREASE INDEX
                $rowIndex += 2;
            }
            $rowIndex += 1;
            // TOTAL
            $sheet->setCellValue('A'.$rowIndex, 'TOTAL'); // Total
            
            
            //RATE OF BASIC
            $sheet->setCellValue('M'.$rowIndex, $totalRateOfBasic);
            
            //RATE OF HRA
            $sheet->setCellValue('N'.$rowIndex, $totalRateOfHra);
            
            //RATE OF OTHER
            $sheet->setCellValue('O'.$rowIndex, $totalRateOfOther);
            
            //EARNINGS BASIC
            $sheet->setCellValue('P'.$rowIndex, $totalEarningsBasic);
            
            //EARNINGS HRA
            $sheet->setCellValue('Q'.$rowIndex, $totalEarningsHra);
            
            //EARNINGS MISC. INCOME
            $sheet->setCellValue('R'.$rowIndex, $totalEarningsMicInc);
            
            //TOTAL EARNINGS(GROSS)
            $sheet->setCellValue('S'.$rowIndex, $totalEarningsGross);
            
            //DEDUCTIONS PF
            $sheet->setCellValue('T'.$rowIndex, $totalDeductionPf);
            
            //DEDUCTIONS ESI
            $sheet->setCellValue('U'.$rowIndex, $totalDeductionEsi);
            
            //DEDUCTIONS PR.TAX
            $sheet->setCellValue('V'.$rowIndex, $totalDeductionPt);
            
            //DEDUCTIONS TDS
            $sheet->setCellValue('W'.$rowIndex, $totalDeductionTds);
            
            //DEDUCTIONS LWF
            $sheet->setCellValue('X'.$rowIndex, $totalDeductionLwf);
            
            //DEDUCTIONS MISC DEDUCTIONS
            $sheet->setCellValue('Y'.$rowIndex, $totalDeductionMiscDed);
            
            //DEDUCTIONS ST.ADV
            $sheet->setCellValue('Z'.$rowIndex, $totalDeductionStfAdv);
            
            //TOTAL DEDUCTIONS
            $sheet->setCellValue('AA'.$rowIndex, $totalDeductions);
            
            //NET AMT PAID
            $sheet->setCellValue('AC'.$rowIndex, $totalNetSal);
            
            // END TOTAL 
            
            
            
    
            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(25);
            $sheet->getColumnDimension('B')->setWidth(30);
            $sheet->getColumnDimension('C')->setWidth(12);
            $sheet->getColumnDimension('D')->setWidth(15);
            $sheet->getColumnDimension('E')->setWidth(12);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(10);
            $sheet->getColumnDimension('H')->setWidth(10);
            $sheet->getColumnDimension('I')->setWidth(10);
            $sheet->getColumnDimension('J')->setWidth(15);
            $sheet->getColumnDimension('K')->setWidth(15);
            $sheet->getColumnDimension('L')->setWidth(15);
            $sheet->getColumnDimension('M')->setWidth(10);
            $sheet->getColumnDimension('N')->setWidth(10);
            $sheet->getColumnDimension('O')->setWidth(10);
            $sheet->getColumnDimension('P')->setWidth(10);
            $sheet->getColumnDimension('Q')->setWidth(10);
            $sheet->getColumnDimension('R')->setWidth(15);
            $sheet->getColumnDimension('S')->setWidth(15);
            $sheet->getColumnDimension('T')->setWidth(10);
            $sheet->getColumnDimension('U')->setWidth(10);
            $sheet->getColumnDimension('V')->setWidth(10);
            $sheet->getColumnDimension('W')->setWidth(10);
            $sheet->getColumnDimension('X')->setWidth(10);
            $sheet->getColumnDimension('Y')->setWidth(15);
            $sheet->getColumnDimension('Z')->setWidth(10);
            $sheet->getColumnDimension('AA')->setWidth(10);
            $sheet->getColumnDimension('AB')->setWidth(15);
            $sheet->getColumnDimension('AC')->setWidth(15);
            $sheet->getColumnDimension('AD')->setWidth(10);
            $sheet->getColumnDimension('AE')->setWidth(10);
            $sheet->getColumnDimension('AF')->setWidth(10);
            $sheet->getColumnDimension('AG')->setWidth(10);
    
            // Define the style array for borders
            $borderStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
    
            // Apply borders to the entire table structure
            $sheet->getStyle('A1:AG'.$rowIndex)->applyFromArray($borderStyle);
            ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
            // Export as Excel or PDF
            // PDF Export Section - UPDATED
            if ($exportType == 'pdf') {
                try {
                    // Verify TCPDF is available
                    $tcpdf_path = APPPATH . 'libraries/tcpdf/';
                    if (!file_exists($tcpdf_path.'tcpdf.php')) {
                        throw new Exception("TCPDF library not found at: ".$tcpdf_path);
                    }
        
                    // Set PDF renderer
                    PHPExcel_Settings::setPdfRenderer(
                        PHPExcel_Settings::PDF_RENDERER_TCPDF,
                        $tcpdf_path
                    );
        
                    // Configure page settings
                    $objPHPExcel->getActiveSheet()->getPageSetup()
                        ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                        ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        
                    // Generate PDF
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
                    $filename = 'paysheet_'.$date.'.pdf';
        
                    // Clear all output buffers
                    while (ob_get_level()) {
                        ob_end_clean();
                    }
        
                    // Send proper headers
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="'.$filename.'"');
                    header('Cache-Control: max-age=0');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Pragma: public');
        
                    // Output PDF
                    $objWriter->save('php://output');
                    exit;
        
                } catch (Exception $e) {
                    // Log the error
                    error_log('PDF Generation Error: '.$e->getMessage());
                    
                    // Show user-friendly error
                    die('Failed to generate PDF. Please try again or contact support.');
                }
            } 
            // Excel Export Section
            else {
                $filename = 'paysheet_'.$date.'.xlsx';
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                
                // Clear output buffers
                while (ob_get_level()) {
                    ob_end_clean();
                }
        
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="'.$filename.'"');
                header('Cache-Control: max-age=0');
                echo "hi";exit;
                $objWriter->save('php://output');
                exit;
            }
            
            
        }else{
            header('Content-Type: application/json');
            $message = "No data found try other";
            getjsondata(0,$message);
        }
            
            
       
    }

    public function generate_paysheet_bkp() {
       
        $userdata = $this->input->post();
        $date = $userdata['date'];
        $ex = explode("-", $date);
        $month = $ex[0];
        $year = $ex[1];
        $company = $userdata['company'];
        $divison = $userdata['divison'];
        $state = $userdata['state'];
        $branch = $userdata['branch'];
        $emptype = $userdata['emptype'];
        
        $exportType = $userdata['export_type'];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		//https://localhost/maxwellhrms/Export_paysheet/generate_paysheet?date=02-2025&company=1&divison=1&state=2&branch=26&emptype=4&export_type=excell
		
    
        $paysheet_array = $this->Salaries_model->getPaysheet($date, $company, $divison, $state, $branch, $emptype, '', '');
        
        if (count($paysheet_array) > 0) {
            $divisionName = $paysheet_array[0]->mxd_name;
            $branchCode = $paysheet_array[0]->mxb_short_code;
            $branchName = $paysheet_array[0]->mxb_name;
            $monthYearName = date('F - Y', strtotime('01-' . $date));
    
            // Create a new PHPExcel object
            $objPHPExcel = new PHPExcel();
            $sheet = $objPHPExcel->getActiveSheet();
    
            // Define the style array for borders
            $borderStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
    
            // Initialize row index
            $rowIndex = 1;
    
            // FIRST ROW
            $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
            $sheet->setCellValue('A' . $rowIndex, 'DIVISION');
            $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
            $sheet->setCellValue($r='C' . $rowIndex, $divisionName);
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
            $sheet->mergeCells('G' . $rowIndex . ':V' . $rowIndex);
            $sheet->setCellValue('G' . $rowIndex, 'PAY SHEET FOR ON ROLL EMPLOYEES');
            $sheet->mergeCells('W' . $rowIndex . ':AG' . $rowIndex);
            $sheet->setCellValue('W' . $rowIndex, 'MAXWELL-F03/HRD/PAYS/00');
    
            // Apply borders to the first row
            $sheet->getStyle('A' . $rowIndex . ':AG' . $rowIndex)->applyFromArray($borderStyle);
    
            $rowIndex++;
    
            // SECOND ROW
            $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
            $sheet->setCellValue('A' . $rowIndex, "PAYSHEET FOR:\nTOTAL WORKING DAYS:\nCompany PF Code:");
            $sheet->getStyle('A' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('A' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
    
            $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
            $sheet->setCellValue($r='C' . $rowIndex, $monthYearName . "\n" . $daysInMonth . "  \n AP/HYD/59887");
            $sheet->getStyle('C' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping			
            $sheet->getStyle('C' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
	
	
	
$sheet->mergeCells('G' . $rowIndex . ':V' . $rowIndex);

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Company Logo');
$objDrawing->setPath('assets/img/logo.png'); // Make sure path is correct
$objDrawing->setHeight(40);
$objDrawing->setWidth(100); // Try matching to width of merged cells
$objDrawing->setOffsetX(1070);
$objDrawing->setCoordinates('M' . $rowIndex);
$objDrawing->setWorksheet($sheet);





            			
            $sheet->setCellValue('G' . $rowIndex, 'MAXWELL LOGISTICS PRIVATE LIMITED');
			$sheet->getStyle('G' . ($rowIndex))->getFont()->setBold(true)->setSize(14);
			$sheet->getStyle('G' . $rowIndex . ':V' . $rowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//$sheet->getStyle('G' . $rowIndex . ':V' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
            $sheet->mergeCells('W' . $rowIndex . ':AB' . $rowIndex);
            $sheet->setCellValue('W' . $rowIndex, "BRANCH CODE:\nBRANCH NAME:\nCBS DATE:");
            $sheet->getStyle('W' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
            $sheet->getStyle('W' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Align text to the top
    
            $sheet->mergeCells('AC' . $rowIndex . ':AG' . $rowIndex);
            $sheet->setCellValue('AC' . $rowIndex, $branchCode . "\n" . $branchName . "\n");
			$sheet->getStyle('AC' . $rowIndex)->getAlignment()->setWrapText(true); // Enable text wrapping
			$sheet->getStyle('AC' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $sheet->getRowDimension($rowIndex)->setRowHeight(50);
    
            // Apply borders to the second row
            $sheet->getStyle('A' . $rowIndex . ':AG' . $rowIndex)->applyFromArray($borderStyle);
    
            $rowIndex++;
    
            // THIRD ROW (HEADER)
       $sheet->mergeCells($cellRange = 'A' . $rowIndex . ':A' . ($rowIndex + 2));
            $sheet->setCellValue('A' . $rowIndex, 'EMP CODE/ UAN NO');
			$sheet->getStyle($cellRange)->getAlignment()->setWrapText(true);
			
            $sheet->mergeCells('B' . $rowIndex . ':B' . ($rowIndex + 2));
            $sheet->setCellValue('B' . $rowIndex, 'EMP NAME');
    
            $sheet->mergeCells($r = 'C' . $rowIndex . ':D' . ($rowIndex + 2));
            $sheet->setCellValue('C' . $rowIndex, 'NO. OF DAYS WORKED');		
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);

    
            $sheet->mergeCells('E' . $rowIndex . ':E' . ($rowIndex + 2));
            $sheet->setCellValue($r= 'E' . $rowIndex, 'SUNDAYS');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
    
            $sheet->mergeCells('F' . $rowIndex . ':F' . ($rowIndex + 2));
            $sheet->setCellValue($r= 'F' . $rowIndex, 'PH/OH');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
    
            $sheet->mergeCells('G' . $rowIndex . ':J' . $rowIndex);
            $sheet->setCellValue('G' . $rowIndex, 'LEAVE WITH PAY');
            $sheet->mergeCells('G' . ($rowIndex + 1) . ':G' . ($rowIndex + 2));
            $sheet->setCellValue('G' . ($rowIndex + 1), 'EL');
            $sheet->mergeCells('H' . ($rowIndex + 1) . ':H' . ($rowIndex + 2));
            $sheet->setCellValue('H' . ($rowIndex + 1), 'CL');
            $sheet->mergeCells('I' . ($rowIndex + 1) . ':I' . ($rowIndex + 2));
            $sheet->setCellValue('I' . ($rowIndex + 1), 'SL');
    
            $sheet->mergeCells('J' . ($rowIndex + 1) . ':J' . ($rowIndex + 2));
            $sheet->setCellValue('J' . ($rowIndex + 1), 'ML');
    
            $sheet->mergeCells($r='K' . $rowIndex . ':K' . ($rowIndex + 2));
            $sheet->setCellValue('K' . $rowIndex, 'LOP');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
    
            $sheet->mergeCells($r='L' . $rowIndex . ':L' . ($rowIndex + 2));
            $sheet->setCellValue('L' . $rowIndex, 'PAY DAYS');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
    
            $sheet->mergeCells('M' . $rowIndex . ':O' . $rowIndex);
            $sheet->setCellValue('M' . $rowIndex, 'RATE OF');
            $sheet->mergeCells('M' . ($rowIndex + 1) . ':M' . ($rowIndex + 2));
            $sheet->setCellValue('M' . ($rowIndex + 1), 'BASIC');
            $sheet->mergeCells('N' . ($rowIndex + 1) . ':N' . ($rowIndex + 2));
            $sheet->setCellValue('N' . ($rowIndex + 1), 'HRA');
            $sheet->mergeCells('O' . ($rowIndex + 1) . ':O' . ($rowIndex + 2));
            $sheet->setCellValue('O' . ($rowIndex + 1), 'OTHER');
			
    
            $sheet->mergeCells('P' . $rowIndex . ':R' . $rowIndex);
            $sheet->setCellValue('P' . $rowIndex, 'EARNINGS');
            $sheet->mergeCells('P' . ($rowIndex + 1) . ':P' . ($rowIndex + 2));
            $sheet->setCellValue('P' . ($rowIndex + 1), 'BASIC');
            $sheet->mergeCells('Q' . ($rowIndex + 1) . ':Q' . ($rowIndex + 2));
            $sheet->setCellValue('Q' . ($rowIndex + 1), 'HRA');
            $sheet->mergeCells('R' . ($rowIndex + 1) . ':R' . ($rowIndex + 2));
            $sheet->setCellValue('R' . ($rowIndex + 1), 'MISC. INCOME');
    
            $sheet->mergeCells($r='S' . $rowIndex . ':S' . ($rowIndex + 2));
            $sheet->setCellValue('S' . $rowIndex, 'TOTAL EARNINGS');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
    
            $sheet->mergeCells('T' . $rowIndex . ':Z' . $rowIndex);
            $sheet->setCellValue('T' . $rowIndex, 'DEDUCTIONS');
            $sheet->mergeCells('T' . ($rowIndex + 1) . ':T' . ($rowIndex + 2));
            $sheet->setCellValue('T' . ($rowIndex + 1), 'PF');
            $sheet->mergeCells('U' . ($rowIndex + 1) . ':U' . ($rowIndex + 2));
            $sheet->setCellValue('U' . ($rowIndex + 1), 'ESI');
            $sheet->mergeCells('V' . ($rowIndex + 1) . ':V' . ($rowIndex + 2));
            $sheet->setCellValue($r='V' . ($rowIndex + 1), 'PR. TAX');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
			
            $sheet->mergeCells('W' . ($rowIndex + 1) . ':W' . ($rowIndex + 2));
            $sheet->setCellValue('W' . ($rowIndex + 1), 'TDS');
			$sheet->getColumnDimension('W')->setAutoSize(true);
            $sheet->mergeCells('X' . ($rowIndex + 1) . ':X' . ($rowIndex + 2));
            $sheet->setCellValue('X' . ($rowIndex + 1), 'LWF');
            $sheet->mergeCells('Y' . ($rowIndex + 1) . ':Y' . ($rowIndex + 2));
            $sheet->setCellValue($r='Y' . ($rowIndex + 1), 'MISC DEDUCTIONS');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
            $sheet->mergeCells('Z' . ($rowIndex + 1) . ':Z' . ($rowIndex + 2));
            $sheet->setCellValue('Z' . ($rowIndex + 1), 'STF AD');
    
            $sheet->mergeCells('AA' . $rowIndex . ':AB' . ($rowIndex + 2));
            $sheet->setCellValue($r='AA' . $rowIndex, 'TOTAL DEDUCTIONS');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
    
            $sheet->mergeCells('AC' . $rowIndex . ':AC' . ($rowIndex + 2));
            $sheet->setCellValue($r='AC' . $rowIndex, 'NET AMT PAID');
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
			
            $sheet->mergeCells('AD' . $rowIndex . ':AG' . $rowIndex);
            $sheet->setCellValue('AD' . $rowIndex, 'BALANCE');
            $sheet->mergeCells('AD' . ($rowIndex + 1) . ':AD' . ($rowIndex + 2));
            $sheet->setCellValue($r='AD' . ($rowIndex + 1), 'Staff Adv');			
			//$sheet->getColumnDimension($r)->setAutoSize(true);
			//$sheet->getColumnDimension('AD')->setWidth(15);
			//$sheet->getColumnDimension('AD')->setWidth(20);
			//$sheet->getStyle('AD' . ($rowIndex + 1))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
			//$sheet->getStyle('AD' . ($rowIndex + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
			$sheet->getStyle($r)->getAlignment()->setWrapText(true);
			
            $sheet->mergeCells('AE' . ($rowIndex + 1) . ':AE' . ($rowIndex + 2));
            $sheet->setCellValue('AE' . ($rowIndex + 1), 'EL');
            $sheet->mergeCells('AF' . ($rowIndex + 1) . ':AF' . ($rowIndex + 2));
            $sheet->setCellValue('AF' . ($rowIndex + 1), 'CL');
            $sheet->mergeCells('AG' . ($rowIndex + 1) . ':AG' . ($rowIndex + 2));
            $sheet->setCellValue('AG' . ($rowIndex + 1), 'SL');
    
            // Apply borders to the third row (header)
            $sheet->getStyle('A' . $rowIndex . ':AG' . ($rowIndex + 2))->applyFromArray($borderStyle);
    
            $rowIndex += 3;
            
            $totalRateOfBasic = $totalRateOfHra = $totalRateOfOther = $totalEarningsBasic = $totalEarningsHra = $totalEarningsMicInc = $totalEarningsGross = $totalDeductionPf = $totalDeductionEsi = $totalDeductionPt = $totalDeductionTds = $totalDeductionLwf = $totalDeductionMiscDed = $totalDeductionStfAdv = $totalNetSal = $totalDeductions =0;
			$sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
            // DATA ROWS
            foreach ($paysheet_array as $paysheetData) {
                $leaves_data = $this->Salaries_model->get_leaves_count_data($paysheetData->mxsal_emp_code, $year . "_" . $month);
    
                $present_days = $leaves_data[0]->Present + $leaves_data[0]->First_Half_Present + $leaves_data[0]->Second_Half_Present +  $leaves_data[0]->regulation_full_day + $leaves_data[0]->First_Half_regulation + $leaves_data[0]->Second_Half_regulation + $leaves_data[0]->First_Half_Shortleave + $leaves_data[0]->Second_Half_Shortleave +  $leaves_data[0]->ot_full_day + $leaves_data[0]->First_Half_ot + $leaves_data[0]->Second_Half_ot;
    
                $wo = $leaves_data[0]->Week_Off;
                $PH = $leaves_data[0]->Public_Holiday + $leaves_data[0]->First_Half_Public_Holiday + $leaves_data[0]->Second_Half_Public_Holiday;
                $OH = $leaves_data[0]->Optional_Holiday + $leaves_data[0]->First_Half_Optional_Holiday + $leaves_data[0]->Second_Half_Optional_Holiday;
                $CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
                $SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
                $EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
                $ML = $leaves_data[0]->Meternityleave + $leaves_data[0]->First_Half_Meternityleave + $leaves_data[0]->Second_Half_Meternityleave;
                $LOP = $leaves_data[0]->Absent + $leaves_data[0]->First_Half_Absent + $leaves_data[0]->Second_Half_Absent;
                $public_holiday = $PH + $OH;
                $total_days = $present_days + $wo + $public_holiday + $CL + $SL + $EL;
    
                // Write data for the current employee
                //$sheet->setCellValue('A' . $rowIndex, $paysheetData->mxsal_emp_code); // Emp code
                //$sheet->setCellValue('A' . ($rowIndex + 1), $paysheetData->mxemp_emp_uan_number); // Emp UAN number
				
				
$sheet->setCellValueExplicit('A' . $rowIndex, $paysheetData->mxsal_emp_code, PHPExcel_Cell_DataType::TYPE_STRING);


$sheet->setCellValueExplicit('A' . ($rowIndex + 1), $paysheetData->mxemp_emp_uan_number, PHPExcel_Cell_DataType::TYPE_STRING);


    
                $sheet->setCellValue('B' . $rowIndex, $paysheetData->mxemp_emp_fname . ' ' . $paysheetData->mxemp_emp_lname); // Employee name
                $sheet->setCellValue('B' . ($rowIndex + 1), 'SIGN OF EMP'); // Signature placeholder
				$sheet->getRowDimension($rowIndex + 1)->setRowHeight(30);
    
                // Present days
                $sheet->mergeCells('C' . $rowIndex . ':D' . ($rowIndex + 1));
                $sheet->setCellValue('C' . $rowIndex, $present_days);
    
                // Sundays
                $sheet->mergeCells('E' . $rowIndex . ':E' . ($rowIndex + 1));
                $sheet->setCellValue('E' . $rowIndex, $wo);
    
                // PH + OH
                $sheet->mergeCells('F' . $rowIndex . ':F' . ($rowIndex + 1));
                $sheet->setCellValue('F' . $rowIndex, $public_holiday);
    
                // EL
                $sheet->mergeCells('G' . $rowIndex . ':G' . ($rowIndex + 1));
                $sheet->setCellValue('G' . $rowIndex, $EL);
    
                // CL
                $sheet->mergeCells('H' . $rowIndex . ':H' . ($rowIndex + 1));
                $sheet->setCellValue('H' . $rowIndex, $CL);
    
                // SL
                $sheet->mergeCells('I' . $rowIndex . ':I' . ($rowIndex + 1));
                $sheet->setCellValue('I' . $rowIndex, $SL);
    
                //ML
                $sheet->mergeCells('J'.$rowIndex.':J'.($rowIndex + 1));
                $sheet->setCellValue('J'.$rowIndex, $ML);
                //Without pay(LOP)
                $sheet->mergeCells('K'.$rowIndex.':K'.($rowIndex + 1));
                $sheet->setCellValue('K'.$rowIndex, $LOP);
                
                //TOTAL PAY DAYS
                $sheet->mergeCells('L'.$rowIndex.':L'.($rowIndex + 1));
                $sheet->setCellValue('L'.$rowIndex, $total_days);
                
                //RATE OF BASIC
                $totalRateOfBasic += $paysheetData->mxsal_basic;
                $sheet->mergeCells('M'.$rowIndex.':M'.($rowIndex + 1));
                $sheet->setCellValue('M'.$rowIndex, $paysheetData->mxsal_basic);
                //RATE OF HRA
                $totalRateOfHra += $paysheetData->mxsal_hra;
                $sheet->mergeCells('N'.$rowIndex.':N'.($rowIndex + 1));
                $sheet->setCellValue('N'.$rowIndex, $paysheetData->mxsal_hra);
                //RATE OF OTHER
                $totalRateOfOther += $paysheetData->mxsal_variable_pay_sha;
                $sheet->mergeCells('O'.$rowIndex.':O'.($rowIndex + 1));
                $sheet->setCellValue('O'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                
                //EARNINGS BASIC
                $totalEarningsBasic += $paysheetData->mxsal_actual_basic;
                $sheet->mergeCells('P'.$rowIndex.':P'.($rowIndex + 1));
                $sheet->setCellValue('P'.$rowIndex, $paysheetData->mxsal_actual_basic);
                //EARNINGS HRA
                $totalEarningsHra += $paysheetData->mxsal_actual_hra;
                $sheet->mergeCells('Q'.$rowIndex.':Q'.($rowIndex + 1));
                $sheet->setCellValue('Q'.$rowIndex, $paysheetData->mxsal_actual_hra);
                //EARNINGS MISC. INCOME
                $totalEarningsMicInc += $paysheetData->mxsal_incentive_amount;
                $sheet->mergeCells('R'.$rowIndex.':R'.($rowIndex + 1));
                $sheet->setCellValue('R'.$rowIndex, $paysheetData->mxsal_incentive_amount);
                
                //TOTAL EARNINGS(GROSS)
                $totalEarningsGross += $paysheetData->mxsal_actual_gross;
                $sheet->mergeCells('S'.$rowIndex.':S'.($rowIndex + 1));
                $sheet->setCellValue('S'.$rowIndex, $paysheetData->mxsal_actual_gross);
                
                //DEDUCTIONS PF
                $totalDeductionPf += $paysheetData->mxsal_pf_emp_cont;
                $sheet->mergeCells('T'.$rowIndex.':T'.($rowIndex + 1));
                $sheet->setCellValue('T'.$rowIndex, $paysheetData->mxsal_pf_emp_cont);
                //DEDUCTIONS ESI
                $totalDeductionEsi += $paysheetData->mxsal_esi_emp_cont;
                $sheet->mergeCells('U'.$rowIndex.':U'.($rowIndex + 1));
                $sheet->setCellValue('U'.$rowIndex, $paysheetData->mxsal_esi_emp_cont);
                //DEDUCTIONS PR.TAX
                $totalDeductionPt += $paysheetData->mxsal_pt;
                $sheet->mergeCells('V'.$rowIndex.':V'.($rowIndex + 1));
                $sheet->setCellValue('V'.$rowIndex, $paysheetData->mxsal_pt);
                //DEDUCTIONS TDS
                $totalDeductionTds += $paysheetData->mxsal_tds_amount;
                $sheet->mergeCells('W'.$rowIndex.':W'.($rowIndex + 1));
                $sheet->setCellValue('W'.$rowIndex, $paysheetData->mxsal_tds_amount);
                //DEDUCTIONS LWF
                $totalDeductionLwf += $paysheetData->mxsal_lwf_emp_cont;
                $sheet->mergeCells('X'.$rowIndex.':X'.($rowIndex + 1));
                $sheet->setCellValue('X'.$rowIndex, $paysheetData->mxsal_lwf_emp_cont);
                //DEDUCTIONS MISC DEDUCTIONS
                $totalDeductionMiscDed += $paysheetData->mxsal_miscelleneous_amount;
                $sheet->mergeCells('Y'.$rowIndex.':Y'.($rowIndex + 1));
                $sheet->setCellValue('Y'.$rowIndex, $paysheetData->mxsal_miscelleneous_amount);
                //DEDUCTIONS ST.ADV
                $totalDeductionStfAdv += $paysheetData->mxsal_loan_amount;
                $sheet->mergeCells('Z'.$rowIndex.':Z'.($rowIndex + 1));
                $sheet->setCellValue('Z'.$rowIndex, $paysheetData->mxsal_loan_amount);
                
                //TOTAL DEDUCTIONS
                $totalDeductions += $paysheetData->mxsal_total_ded;
                $sheet->mergeCells('AA'.$rowIndex.':AB'.($rowIndex + 1));
                $sheet->setCellValue('AA'.$rowIndex, $paysheetData->mxsal_total_ded);
                
                //NET AMT PAID
                $totalNetSal += $paysheetData->mxsal_net_sal;
                $sheet->mergeCells('AC'.$rowIndex.':AC'.($rowIndex + 1));
                $sheet->setCellValue('AC'.$rowIndex, $paysheetData->mxsal_net_sal);
                
				$EL = $leaves_data[0]->Earnedleave + $leaves_data[0]->First_Half_Earnedleave + $leaves_data[0]->Second_Half_Earnedleave;
				$CL = $leaves_data[0]->Casualleave + $leaves_data[0]->First_Half_Casualleave + $leaves_data[0]->Second_Half_Casualleave;
				$SL = $leaves_data[0]->Sickleave + $leaves_data[0]->First_Half_Sickleave + $leaves_data[0]->Second_Half_Sickleave;
				
				$CurrentEL=$leaves_data[0]->CurrentEL;
				$CurrentCL=$leaves_data[0]->CurrentCL;
				$CurrentSL=$leaves_data[0]->CurrentSL;
				$CurrentOH=$leaves_data[0]->CurrentOH;
				$loan_details=$this->Loan_model->getloandetails_payslip($paysheetData->mxsal_emp_code);
				$sum_loan_amt=$loan_details[0]->mxemploan_emp_loan_outstanding_amt;
				$clean_value = str_replace(["\r", "\n"], '', trim($sum_loan_amt));
				
                //BALANCE STAFF ADV
                $sheet->mergeCells('AD'.$rowIndex.':AD'.($rowIndex + 1));
                //$sheet->setCellValue('AD'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                //$sheet->setCellValue('AD'.$rowIndex, $sum_loan_amt);
				//$sheet->getColumnDimension('AD')->setAutoSize(true);
				
				//$sheet->getStyle('AD' . $rowIndex)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
				$sheet->setCellValueExplicit('AD'.$rowIndex, $clean_value, PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet->getColumnDimension('AD')->setWidth(30);
	  
                //BALANCE EL
                $sheet->mergeCells('AE'.$rowIndex.':AE'.($rowIndex + 1));
                //$sheet->setCellValue('AE'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                $sheet->setCellValue('AE'.$rowIndex, $CurrentEL);
                //BALANCE CL
                $sheet->mergeCells('AF'.$rowIndex.':AF'.($rowIndex + 1));
                //$sheet->setCellValue('AF'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                $sheet->setCellValue('AF'.$rowIndex, $CurrentCL);
                //BALANCE SL
                $sheet->mergeCells('AG'.$rowIndex.':AG'.($rowIndex + 1));
                //$sheet->setCellValue('AG'.$rowIndex, $paysheetData->mxsal_variable_pay_sha);
                $sheet->setCellValue('AG'.$rowIndex, $CurrentSL);
                // INCREASE INDEX
                $rowIndex += 2;
            }
            $rowIndex += 1;
            // TOTAL
            $sheet->setCellValue('A'.$rowIndex, 'TOTAL'); // Total
            
            
            //RATE OF BASIC
            $sheet->setCellValue('M'.$rowIndex, $totalRateOfBasic);
            
            //RATE OF HRA
            $sheet->setCellValue('N'.$rowIndex, $totalRateOfHra);
            
            //RATE OF OTHER
            $sheet->setCellValue('O'.$rowIndex, $totalRateOfOther);
            
            //EARNINGS BASIC
            $sheet->setCellValue('P'.$rowIndex, $totalEarningsBasic);
            
            //EARNINGS HRA
            $sheet->setCellValue('Q'.$rowIndex, $totalEarningsHra);
            
            //EARNINGS MISC. INCOME
            $sheet->setCellValue('R'.$rowIndex, $totalEarningsMicInc);
            
            //TOTAL EARNINGS(GROSS)
            $sheet->setCellValue('S'.$rowIndex, $totalEarningsGross);
            
            //DEDUCTIONS PF
            $sheet->setCellValue('T'.$rowIndex, $totalDeductionPf);
            
            //DEDUCTIONS ESI
            $sheet->setCellValue('U'.$rowIndex, $totalDeductionEsi);
            
            //DEDUCTIONS PR.TAX
            $sheet->setCellValue('V'.$rowIndex, $totalDeductionPt);
            
            //DEDUCTIONS TDS
            $sheet->setCellValue('W'.$rowIndex, $totalDeductionTds);
            
            //DEDUCTIONS LWF
            $sheet->setCellValue('X'.$rowIndex, $totalDeductionLwf);
            
            //DEDUCTIONS MISC DEDUCTIONS
            $sheet->setCellValue('Y'.$rowIndex, $totalDeductionMiscDed);
            
            //DEDUCTIONS ST.ADV
            $sheet->setCellValue('Z'.$rowIndex, $totalDeductionStfAdv);
            
            //TOTAL DEDUCTIONS
            $sheet->setCellValue('AA'.$rowIndex, $totalDeductions);
            
            //NET AMT PAID
            $sheet->setCellValue('AC'.$rowIndex, $totalNetSal);
            
            // END TOTAL 
            
            

            
    
            // Set column widths
            $sheet->getColumnDimension('A')->setWidth(15);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(5);
            $sheet->getColumnDimension('D')->setWidth(5);
            $sheet->getColumnDimension('E')->setWidth(5);
            $sheet->getColumnDimension('F')->setWidth(5);
            $sheet->getColumnDimension('G')->setWidth(5);
            $sheet->getColumnDimension('H')->setWidth(5);
            $sheet->getColumnDimension('I')->setWidth(5);
            $sheet->getColumnDimension('J')->setWidth(5);
            $sheet->getColumnDimension('K')->setWidth(5);
            $sheet->getColumnDimension('L')->setWidth(5);
            $sheet->getColumnDimension('M')->setWidth(8);
            $sheet->getColumnDimension('N')->setWidth(7);
            $sheet->getColumnDimension('O')->setWidth(5);
            $sheet->getColumnDimension('P')->setWidth(7);
            $sheet->getColumnDimension('Q')->setWidth(7);
            $sheet->getColumnDimension('R')->setWidth(5);
            $sheet->getColumnDimension('S')->setWidth(7);
            $sheet->getColumnDimension('T')->setWidth(5);
            $sheet->getColumnDimension('U')->setWidth(5);
            $sheet->getColumnDimension('V')->setWidth(5);
            $sheet->getColumnDimension('W')->setWidth(5);
            $sheet->getColumnDimension('X')->setWidth(5);
            $sheet->getColumnDimension('Y')->setWidth(5);
            $sheet->getColumnDimension('Z')->setWidth(7);
            $sheet->getColumnDimension('AA')->setWidth(5);
            $sheet->getColumnDimension('AB')->setWidth(5);
            $sheet->getColumnDimension('AC')->setWidth(7);
            $sheet->getColumnDimension('AD')->setWidth(5);
            $sheet->getColumnDimension('AE')->setWidth(5);
            $sheet->getColumnDimension('AF')->setWidth(5);
            $sheet->getColumnDimension('AG')->setWidth(5);
    
            // Define the style array for borders
            $borderStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
    
            // Apply borders to the entire table structure
            $sheet->getStyle('A1:AG'.$rowIndex)->applyFromArray($borderStyle);
			
			
			$styleArray = array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
        'vertical' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
        'horizontal' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
    )
);

//$sheet->getStyle('A12:AG12')->applyFromArray($styleArray);
//$sheet->getStyle('A13:AG13')->applyFromArray($styleArray);

$sheet->getStyle('A'.($rowIndex-1).':AG'.($rowIndex - 1))->applyFromArray($styleArray);
$sheet->getStyle('A'.$rowIndex.':AG'.$rowIndex)->applyFromArray($styleArray);

            ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
            // Export as Excel or PDF
            if ($exportType == 'pdf') {
                PHPExcel_Settings::setPdfRenderer(
                    PHPExcel_Settings::PDF_RENDERER_TCPDF,
                    APPPATH . 'libraries/tcpdf/'
                );
                $filename = 'paysheet_'.$date.'.pdf';
                $objPHPExcel->getActiveSheet()->getPageSetup()
                    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
                header('Content-Type: application/pdf');
            } else {
                $filename = 'paysheet_'.$date.'.xlsx';
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            }
    
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit;
            
            
        }else{
            header('Content-Type: application/json');
            $message = "No data found try other";
            getjsondata(0,$message);
        }
    }

    /*
     * Developer : Varaprasad
     * Updated on: 08/03/2026
     * */
    public function generate_paysheet() {
        $userdata = $this->input->post();
        $date = $userdata['date'];
        $ex = explode("-", $date);
        $month = $ex[0];
        $year = $ex[1];
        $company = $userdata['company'];
        $divison = $userdata['divison'];
        $state = $userdata['state'];
        $branch = $userdata['branch'];
        $emptype = $userdata['emptype'];
        $paysheetCat = $userdata['paysheet'];
        $exportType = $userdata['export_type'];

        // Fetch Data
        if($paysheetCat == 'paysheet') {
            $paysheet_array = $this->Salaries_model->getPaysheet($date, $company, $divison, $state, $branch, $emptype, '', '');
        } else if($paysheetCat == 'supplementary_paysheet') {
            $paysheet_array = $this->Salaries_model->get_Supplementary_Paysheet($date, $company, $divison, $state, $branch, $emptype, '');
        }

        if (count($paysheet_array) > 0) {
            // Route to specific sheet generator based on Employee Type
            switch ($emptype) {
                case 5:
                    // Trainee Flow
                    $this->_generate_trainee_paysheet($paysheet_array, $userdata, $month, $year);
                    break;
                case 6:
                    // Professional Flow
                    $this->_generate_professional_paysheet($paysheet_array, $userdata, $month, $year);
                    break;
                case 4:
                default:
                    // Existing Standard Flow (On-Roll Employee)
                    $this->_generate_standard_paysheet($paysheet_array, $userdata, $month, $year);
                    break;
            }
        } else {
            header('Content-Type: application/json');
            getjsondata(0, "No data found try other");
        }
    }

    /**
     * EXCEL report for Standard On-Roll Employees (Type 4)
     * Developer : Varaprasad
     * DEveloped on: 08/03/2026
     */
    private function _generate_standard_paysheet($paysheet_array, $userdata, $month, $year) {
        $date = $userdata['date'];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];
        $paysheetCat = $userdata['paysheet'];
        $exportType = $userdata['export_type'];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $divisionName = ($divison != 0 && $divison != null) ? $paysheet_array[0]->mxd_name : "ALL OVER INDIA";
        $branchCode = ($branch != 0 && $branch != null) ? $paysheet_array[0]->mxb_short_code : "";
        $branchName = ($branch != 0 && $branch != null) ? $paysheet_array[0]->mxb_name : "All BRANCHES";
        $monthYearName = date('F - Y', strtotime('01-' . $date));

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();

        $borderStyle = [
            'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
        ];

        $rowIndex = 1;

        // --- Row 1: Header Logic ---
        $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
        $sheet->setCellValue('A' . $rowIndex, 'DIVISION');
        $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
        $sheet->setCellValue('C' . $rowIndex, $divisionName);
        $sheet->getStyle('C' . $rowIndex)->getAlignment()->setWrapText(true);
        $sheet->mergeCells('G' . $rowIndex . ':V' . $rowIndex);
        $sheet->setCellValue('G' . $rowIndex, 'PAY SHEET FOR ON ROLL EMPLOYEES');
        $sheet->mergeCells('W' . $rowIndex . ':AH' . $rowIndex);
        $sheet->setCellValue('W' . $rowIndex, 'MAXWELL-F03/HRD/PAYS/00');

        // Make Row 1 Bold
        $sheet->getStyle('A' . $rowIndex . ':AH' . $rowIndex)->getFont()->setBold(true);
        $sheet->getStyle('A' . $rowIndex . ':AH' . $rowIndex)->applyFromArray($borderStyle);
        $rowIndex++;

        // --- Row 2: Branding ---
        $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
        $sheet->setCellValue('A' . $rowIndex, "PAYSHEET FOR:\nTOTAL WORKING DAYS:\nCompany PF Code:");
        $sheet->getStyle('A' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
        $sheet->setCellValue('C' . $rowIndex, $monthYearName . "\n" . $daysInMonth . "  \n AP/HYD/59887");
        $sheet->getStyle('C' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->mergeCells('G' . $rowIndex . ':V' . $rowIndex);

        // Logo Placement
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setPath('assets/img/logo.png');
        $objDrawing->setHeight(40);
        $objDrawing->setCoordinates('O' . $rowIndex);
        $objDrawing->setWorksheet($sheet);

        $sheet->setCellValue('G' . $rowIndex, 'MAXWELL LOGISTICS PRIVATE LIMITED');
        $sheet->getStyle('G' . $rowIndex)->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('G' . $rowIndex . ':V' . $rowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G' . $rowIndex . ':V' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);

        $sheet->mergeCells('W' . $rowIndex . ':AB' . $rowIndex);
        $sheet->setCellValue('W' . $rowIndex, "BRANCH CODE:\nBRANCH NAME:\nPaysheet Generated Dt:");
        $sheet->getStyle('W' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->mergeCells('AC' . $rowIndex . ':AH' . $rowIndex);
        $sheet->setCellValue('AC' . $rowIndex, $branchCode . "\n" . $branchName . "\n" . date('d-m-Y H:i:s'));
        $sheet->getStyle('AC' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->getRowDimension($rowIndex)->setRowHeight(65);
        // Make Row 2 labels bold where applicable
        $sheet->getStyle('A' . $rowIndex . ':AH' . $rowIndex)->getFont()->setBold(true);
        $sheet->getStyle('A' . $rowIndex . ':AH' . $rowIndex)->applyFromArray($borderStyle);
        $rowIndex++;

        // --- Row 3-5: Column Headers ---
        $sheet->mergeCells('A' . $rowIndex . ':A' . ($rowIndex + 2));
        $sheet->setCellValue('A' . $rowIndex, 'EMP CODE/ UAN NO');
        $sheet->mergeCells('B' . $rowIndex . ':B' . ($rowIndex + 2));
        $sheet->setCellValue('B' . $rowIndex, 'EMP NAME');
        $sheet->mergeCells('C' . $rowIndex . ':D' . ($rowIndex + 2));
        $sheet->setCellValue('C' . $rowIndex, 'NO. OF DAYS WORKED');
        $sheet->mergeCells('E' . $rowIndex . ':E' . ($rowIndex + 2));
        $sheet->setCellValue('E' . $rowIndex, 'SUNDAYS');
        $sheet->mergeCells('F' . $rowIndex . ':F' . ($rowIndex + 2));
        $sheet->setCellValue('F' . $rowIndex, 'PH/OH');
        $sheet->mergeCells('G' . $rowIndex . ':J' . $rowIndex);
        $sheet->setCellValue('G' . $rowIndex, 'LEAVE WITH PAY');
        $sheet->setCellValue('G' . ($rowIndex + 1), 'EL'); $sheet->setCellValue('H' . ($rowIndex + 1), 'CL'); $sheet->setCellValue('I' . ($rowIndex + 1), 'SL'); $sheet->setCellValue('J' . ($rowIndex + 1), 'ML');
        $sheet->mergeCells('K' . $rowIndex . ':K' . ($rowIndex + 2));
        $sheet->setCellValue('K' . $rowIndex, 'LOP');
        $sheet->mergeCells('L' . $rowIndex . ':L' . ($rowIndex + 2));
        $sheet->setCellValue('L' . $rowIndex, 'PAY DAYS');
        $sheet->mergeCells('M' . $rowIndex . ':O' . $rowIndex);
        $sheet->setCellValue('M' . $rowIndex, 'RATE OF');
        $sheet->setCellValue('M' . ($rowIndex + 1), 'BASIC'); $sheet->setCellValue('N' . ($rowIndex + 1), 'HRA'); $sheet->setCellValue('O' . ($rowIndex + 1), 'OTHER');
        $sheet->mergeCells('P' . $rowIndex . ':R' . $rowIndex);
        $sheet->setCellValue('P' . $rowIndex, 'EARNINGS');
        $sheet->setCellValue('P' . ($rowIndex + 1), 'BASIC'); $sheet->setCellValue('Q' . ($rowIndex + 1), 'HRA'); $sheet->setCellValue('R' . ($rowIndex + 1), 'MISC. INCOME');
        $sheet->mergeCells('S' . $rowIndex . ':S' . ($rowIndex + 2));
        $sheet->setCellValue('S' . $rowIndex, 'TOTAL EARNINGS');
        $sheet->mergeCells('T' . $rowIndex . ':Z' . $rowIndex);
        $sheet->setCellValue('T' . $rowIndex, 'DEDUCTIONS');
        $sheet->setCellValue('T' . ($rowIndex + 1), 'PF'); $sheet->setCellValue('U' . ($rowIndex + 1), 'ESI'); $sheet->setCellValue('V' . ($rowIndex + 1), 'PR. TAX'); $sheet->setCellValue('W' . ($rowIndex + 1), 'TDS'); $sheet->setCellValue('X' . ($rowIndex + 1), 'LWF'); $sheet->setCellValue('Y' . ($rowIndex + 1), 'MISC DEDUCTIONS'); $sheet->setCellValue('Z' . ($rowIndex + 1), 'STF AD');
        $sheet->mergeCells('AA' . $rowIndex . ':AB' . ($rowIndex + 2));
        $sheet->setCellValue('AA' . $rowIndex, 'TOTAL DEDUCTIONS');
        $sheet->mergeCells('AC' . $rowIndex . ':AC' . ($rowIndex + 2));
        $sheet->setCellValue('AC' . $rowIndex, 'NET AMT PAID');
        $sheet->mergeCells('AD' . $rowIndex . ':AD' . ($rowIndex + 2));
        $sheet->setCellValue('AD' . $rowIndex, 'PAYMENT STATUS');
        $sheet->mergeCells('AE' . $rowIndex . ':AH' . $rowIndex);
        $sheet->setCellValue('AE' . $rowIndex, 'BALANCE');
        $sheet->setCellValue('AE' . ($rowIndex + 1), 'Staff Adv'); $sheet->setCellValue('AF' . ($rowIndex + 1), 'EL'); $sheet->setCellValue('AG' . ($rowIndex + 1), 'CL'); $sheet->setCellValue('AH' . ($rowIndex + 1), 'SL');

        // Make All Header Rows Bold
        $sheet->getStyle('A' . $rowIndex . ':AH' . ($rowIndex + 2))->getFont()->setBold(true);
        $sheet->getStyle('A' . $rowIndex . ':AH' . ($rowIndex + 2))->applyFromArray($borderStyle);
        $sheet->getStyle('A' . $rowIndex . ':AH' . ($rowIndex + 2))->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rowIndex += 3;

        $totals = array_fill_keys(['rb','rh','ro','eb','eh','emi','eg','dpf','desi','dpt','dtds','dlwf','dmisc','dstf','tded','net'], 0);
        $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);

        foreach ($paysheet_array as $pData) {
            $leaves = $this->Salaries_model->get_leaves_count_data($pData->mxsal_emp_code, $year . "_" . $month);
            $present = $leaves[0]->Present + $leaves[0]->First_Half_Present + $leaves[0]->Second_Half_Present + $leaves[0]->regulation_full_day + $leaves[0]->First_Half_regulation + $leaves[0]->Second_Half_regulation + $leaves[0]->First_Half_Shortleave + $leaves[0]->Second_Half_Shortleave + $leaves[0]->ot_full_day + $leaves[0]->First_Half_ot + $leaves[0]->Second_Half_ot;
            $wo = $leaves[0]->Week_Off;
            $ph_oh = $leaves[0]->Public_Holiday + $leaves[0]->First_Half_Public_Holiday + $leaves[0]->Second_Half_Public_Holiday + $leaves[0]->Optional_Holiday + $leaves[0]->First_Half_Optional_Holiday + $leaves[0]->Second_Half_Optional_Holiday;
            $cl = $leaves[0]->Casualleave + $leaves[0]->First_Half_Casualleave + $leaves[0]->Second_Half_Casualleave;
            $sl = $leaves[0]->Sickleave + $leaves[0]->First_Half_Sickleave + $leaves[0]->Second_Half_Sickleave;
            $el = $leaves[0]->Earnedleave + $leaves[0]->First_Half_Earnedleave + $leaves[0]->Second_Half_Earnedleave;
            $ml = $leaves[0]->Meternityleave + $leaves[0]->First_Half_Meternityleave + $leaves[0]->Second_Half_Meternityleave;
            $total_days = $present + $wo + $ph_oh + $cl + $sl + $el;
            $lop = $daysInMonth - $total_days;

            $mxsal_actual_gross=$pData->mxsal_actual_gross;
            $mxsal_total_ded=round($pData->mxsal_total_ded);
            $mxsal_net_sal=$mxsal_actual_gross-$mxsal_total_ded;
            $mxsal_net_sal=round($mxsal_net_sal);

            $sheet->setCellValueExplicit('A' . $rowIndex, $pData->mxsal_emp_code, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('A' . ($rowIndex + 1), $pData->mxemp_emp_uan_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValue('B' . $rowIndex, $pData->mxemp_emp_fname . ' ' . $pData->mxemp_emp_lname);
            $sheet->setCellValue('B' . ($rowIndex + 1), 'SIGN OF EMP');
            $sheet->getRowDimension($rowIndex + 1)->setRowHeight(30);

            // Map data to cells
            $sheet->mergeCells('C'.$rowIndex.':D'.($rowIndex+1)); $sheet->setCellValue('C'.$rowIndex, $present);
            $sheet->mergeCells('E'.$rowIndex.':E'.($rowIndex+1)); $sheet->setCellValue('E'.$rowIndex, $wo);
            $sheet->mergeCells('F'.$rowIndex.':F'.($rowIndex+1)); $sheet->setCellValue('F'.$rowIndex, $ph_oh);
            $sheet->mergeCells('G'.$rowIndex.':G'.($rowIndex+1)); $sheet->setCellValue('G'.$rowIndex, $el);
            $sheet->mergeCells('H'.$rowIndex.':H'.($rowIndex+1)); $sheet->setCellValue('H'.$rowIndex, $cl);
            $sheet->mergeCells('I'.$rowIndex.':I'.($rowIndex+1)); $sheet->setCellValue('I'.$rowIndex, $sl);
            $sheet->mergeCells('J'.$rowIndex.':J'.($rowIndex+1)); $sheet->setCellValue('J'.$rowIndex, $ml);
            $sheet->mergeCells('K'.$rowIndex.':K'.($rowIndex+1)); $sheet->setCellValue('K'.$rowIndex, $lop);
            $sheet->mergeCells('L'.$rowIndex.':L'.($rowIndex+1)); $sheet->setCellValue('L'.$rowIndex, $total_days);

            $sheet->mergeCells('M'.$rowIndex.':M'.($rowIndex+1)); $sheet->setCellValue('M'.$rowIndex, $pData->mxsal_basic);
            $sheet->mergeCells('N'.$rowIndex.':N'.($rowIndex+1)); $sheet->setCellValue('N'.$rowIndex, $pData->mxsal_hra);
            $sheet->mergeCells('O'.$rowIndex.':O'.($rowIndex+1)); $sheet->setCellValue('O'.$rowIndex, $pData->mxsal_variable_pay_sha);
            $sheet->mergeCells('P'.$rowIndex.':P'.($rowIndex+1)); $sheet->setCellValue('P'.$rowIndex, $pData->mxsal_actual_basic);
            $sheet->mergeCells('Q'.$rowIndex.':Q'.($rowIndex+1)); $sheet->setCellValue('Q'.$rowIndex, $pData->mxsal_actual_hra);
            $sheet->mergeCells('R'.$rowIndex.':R'.($rowIndex+1)); $sheet->setCellValue('R'.$rowIndex, $pData->mxsal_incentive_amount);
            $sheet->mergeCells('S'.$rowIndex.':S'.($rowIndex+1)); $sheet->setCellValue('S'.$rowIndex, $pData->mxsal_actual_gross);
            $sheet->mergeCells('T'.$rowIndex.':T'.($rowIndex+1)); $sheet->setCellValue('T'.$rowIndex, $pData->mxsal_pf_emp_cont);
            $sheet->mergeCells('U'.$rowIndex.':U'.($rowIndex+1)); $sheet->setCellValue('U'.$rowIndex, $pData->mxsal_esi_emp_cont);
            $sheet->mergeCells('V'.$rowIndex.':V'.($rowIndex+1)); $sheet->setCellValue('V'.$rowIndex, $pData->mxsal_pt);
            $sheet->mergeCells('W'.$rowIndex.':W'.($rowIndex+1)); $sheet->setCellValue('W'.$rowIndex, $pData->mxsal_tds_amount);
            $sheet->mergeCells('X'.$rowIndex.':X'.($rowIndex+1)); $sheet->setCellValue('X'.$rowIndex, $pData->mxsal_lwf_emp_cont);
            $sheet->mergeCells('Y'.$rowIndex.':Y'.($rowIndex+1)); $sheet->setCellValue('Y'.$rowIndex, $pData->mxsal_miscelleneous_amount);
            $sheet->mergeCells('Z'.$rowIndex.':Z'.($rowIndex+1)); $sheet->setCellValue('Z'.$rowIndex, $pData->mxsal_loan_amount);
            $sheet->mergeCells('AA'.$rowIndex.':AB'.($rowIndex+1)); $sheet->setCellValue('AA'.$rowIndex, $mxsal_total_ded);
            $sheet->mergeCells('AC'.$rowIndex.':AC'.($rowIndex+1)); $sheet->setCellValue('AC'.$rowIndex, $mxsal_net_sal);
            $sheet->mergeCells('AD'.$rowIndex.':AD'.($rowIndex+1)); $sheet->setCellValue('AD'.$rowIndex, ($pData->mxsal_paid_status_flag == 1 ? "PAID" : "UNPAID"));

            // Balances
            /*$loan_details = $this->Loan_model->getloandetails_payslip($pData->mxsal_emp_code);
            $loan_bal = isset($loan_details[0]) ? str_replace(["\r", "\n"], '', trim($loan_details[0]->mxemploan_emp_loan_outstanding_amt)) : 0;*/


            /*  Updated BY  Varaprasad
             * ON : 22 JUl 2026
             * Purpose : Loan Outstanding should reflect the month-wise outstanding balance as of the generated report month instead of the current outstanding balance
             */

            $loan = $this->Loan_model->getEmployeeLoanOutstandingAfterDeduction($pData->mxsal_emp_code, $year.$month);
            $loan_bal = isset($loan) ? (float)$loan: 0;

            $sheet->mergeCells('AE'.$rowIndex.':AE'.($rowIndex+1)); $sheet->setCellValueExplicit('AE'.$rowIndex, $loan_bal, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->mergeCells('AF'.$rowIndex.':AF'.($rowIndex+1)); $sheet->setCellValue('AF'.$rowIndex, $leaves[0]->CurrentEL);
            $sheet->mergeCells('AG'.$rowIndex.':AG'.($rowIndex+1)); $sheet->setCellValue('AG'.$rowIndex, $leaves[0]->CurrentCL);
            $sheet->mergeCells('AH'.$rowIndex.':AH'.($rowIndex+1)); $sheet->setCellValue('AH'.$rowIndex, $leaves[0]->CurrentSL);

            // Sum Totals
            $totals['rb'] += $pData->mxsal_basic; $totals['rh'] += $pData->mxsal_hra; $totals['ro'] += $pData->mxsal_variable_pay_sha;
            $totals['eb'] += $pData->mxsal_actual_basic; $totals['eh'] += $pData->mxsal_actual_hra; $totals['emi'] += $pData->mxsal_incentive_amount;
            $totals['eg'] += $pData->mxsal_actual_gross; $totals['dpf'] += $pData->mxsal_pf_emp_cont; $totals['desi'] += $pData->mxsal_esi_emp_cont;
            $totals['dpt'] += $pData->mxsal_pt; $totals['dtds'] += $pData->mxsal_tds_amount; $totals['dlwf'] += $pData->mxsal_lwf_emp_cont;
            $totals['dmisc'] += $pData->mxsal_miscelleneous_amount; $totals['dstf'] += $pData->mxsal_loan_amount; $totals['tded'] += $mxsal_total_ded;
            $totals['net'] += $mxsal_net_sal;

            $rowIndex += 2;
        }

        $rowIndex++;
        $sheet->setCellValue('A'.$rowIndex, 'TOTAL');
        // Make Totals Row Bold
        $sheet->getStyle('A' . $rowIndex . ':AC' . $rowIndex)->getFont()->setBold(true);

        $sheet->setCellValue('M'.$rowIndex, $totals['rb']); $sheet->setCellValue('N'.$rowIndex, $totals['rh']); $sheet->setCellValue('O'.$rowIndex, $totals['ro']);
        $sheet->setCellValue('P'.$rowIndex, $totals['eb']); $sheet->setCellValue('Q'.$rowIndex, $totals['eh']); $sheet->setCellValue('R'.$rowIndex, $totals['emi']);
        $sheet->setCellValue('S'.$rowIndex, $totals['eg']); $sheet->setCellValue('T'.$rowIndex, $totals['dpf']); $sheet->setCellValue('U'.$rowIndex, $totals['desi']);
        $sheet->setCellValue('V'.$rowIndex, $totals['dpt']); $sheet->setCellValue('W'.$rowIndex, $totals['dtds']); $sheet->setCellValue('X'.$rowIndex, $totals['dlwf']);
        $sheet->setCellValue('Y'.$rowIndex, $totals['dmisc']); $sheet->setCellValue('Z'.$rowIndex, $totals['dstf']); $sheet->setCellValue('AA'.$rowIndex, $totals['tded']);
        $sheet->setCellValue('AC'.$rowIndex, $totals['net']);

        $this->_apply_excel_formatting($objPHPExcel, $rowIndex, $date, $paysheetCat, $exportType);
    }

    /**
     * Shared Formatting and Output Logic
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */
    private function _apply_excel_formatting($objPHPExcel, $rowIndex, $date, $paysheetCat, $exportType) {
        $sheet = $objPHPExcel->getActiveSheet();
        $minWidths = [
            'A' => 16, 'B' => 28, 'S' => 16, 'AA' => 16, 'AC' => 16
        ];

        foreach (array_merge(range('A', 'Z'), ['AA','AB','AC','AD','AE','AF','AG','AH']) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->calculateColumnWidths();
            $currentWidth = $sheet->getColumnDimension($columnID)->getWidth();
            $min = isset($minWidths[$columnID]) ? $minWidths[$columnID] : 10;
            $sheet->getColumnDimension($columnID)->setAutoSize(false)->setWidth(($currentWidth < $min) ? $min : $currentWidth + 2);
        }

        $borderStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']]]];
        $sheet->getStyle('A1:AH'.$rowIndex)->applyFromArray($borderStyle);
        $noneStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE]]];
        $sheet->getStyle('A'.($rowIndex-1).':AH'.$rowIndex)->applyFromArray($noneStyle);

        ini_set('max_execution_time', 300);
        $filename = ($paysheetCat == 'supplementary_paysheet' ? 'supplementary_' : '') . 'paysheet_' . $date;

        if ($exportType == 'pdf') {
            PHPExcel_Settings::setPdfRenderer(PHPExcel_Settings::PDF_RENDERER_TCPDF, APPPATH . 'libraries/tcpdf/');
            $sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
            header('Content-Type: application/pdf');
            $filename .= '.pdf';
        } else {
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $filename .= '.xlsx';
        }

        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * EXCEL report for Trainee Paysheet (Type 5)
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */
    private function _generate_trainee_paysheet($paysheet_array, $userdata, $month, $year) {
        $date = $userdata['date'];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $divisionName = ($divison != 0 && $divison != null) ? $paysheet_array[0]->mxd_name : "ALL OVER INDIA";
        $branchCode = ($branch != 0 && $branch != null) ? $paysheet_array[0]->mxb_short_code : "";
        $branchName = ($branch != 0 && $branch != null) ? $paysheet_array[0]->mxb_name : "All BRANCHES";
        $monthYearName = strtoupper(date('F - Y', strtotime('01-' . $date)));

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();
        $borderStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']]]];

        $rowIndex = 1;

        // --- ROW 1: TOP HEADER BOXES ---
        $sheet->mergeCells('A' . $rowIndex . ':C' . $rowIndex);
        $sheet->setCellValue('A' . $rowIndex, 'DIVISION: ' . $divisionName);

        $sheet->mergeCells('D' . $rowIndex . ':L' . $rowIndex);
        $sheet->setCellValue('D' . $rowIndex, 'PAY SHEET FOR TRAINEE EMPLOYEES');

        $sheet->mergeCells('M' . $rowIndex . ':Q' . $rowIndex);
        $sheet->setCellValue('M' . $rowIndex, 'MAXWELL-F03/HRD/PAYS/00');

        $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->getFont()->setBold(true);
        $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->applyFromArray($borderStyle);
        $rowIndex++;

        // --- ROW 2: LOGO BOX & INFO BOXES ---
        // Left Box
        $sheet->mergeCells('A' . $rowIndex . ':C' . $rowIndex);
        $sheet->setCellValue('A' . $rowIndex, "PAYSHEET FOR: $monthYearName\nTOTAL WORKING DAYS: $daysInMonth\nCompany PF Code: AP/HYD/59887");
        $sheet->getStyle('A' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        // Center Box (Logo)
        $sheet->mergeCells('D' . $rowIndex . ':L' . $rowIndex);
        if (file_exists('assets/img/logo.png')) {
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setPath('assets/img/logo.png')->setHeight(40)->setCoordinates('G' . $rowIndex)->setWorksheet($sheet);
        }
        $sheet->setCellValue('D' . $rowIndex, "\n\nMAXWELL LOGISTICS PRIVATE LIMITED");
        $sheet->getStyle('D' . $rowIndex)->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('D' . $rowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);

        // Right Box
        $sheet->mergeCells('M' . $rowIndex . ':Q' . $rowIndex);
        $sheet->setCellValue('M' . $rowIndex, "BRANCH CODE: $branchCode\nBRANCH NAME: $branchName\nGenerated Date: " . date('d-m-Y H:i:s'));
        $sheet->getStyle('M' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->getRowDimension($rowIndex)->setRowHeight(65);
        $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->getFont()->setBold(true);
        $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->applyFromArray($borderStyle);
        $rowIndex++;

        // --- ROW 3: TRAINEE COLUMN HEADERS ---
        $headers = [
            'A' => 'S.No', 'B' => "EMP CODE/\nUAN NO", 'C' => 'EMP NAME', 'D' => 'STATUS',
            'E' => 'DAYS', 'F' => 'SUN', 'G' => 'PH', 'H' => 'LOP', 'I' => 'PAY DAYS',
            'J' => "STIPEND PER\nMONTH", 'K' => "STIPEND\nPAYABLE", 'L' => "OTHER\nDED.",
            'M' => "ESI\nDED.", 'N' => "TOTAL\nDEDUCTIONS", 'O' => "NET AMT\nPAID",
            'P' => "PAYMENT\nSTATUS", 'Q' => "SL\nBAL"
        ];

        foreach ($headers as $col => $text) {
            $sheet->setCellValue($col . $rowIndex, $text);
            $sheet->getStyle($col . $rowIndex)->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getStyle($col . $rowIndex)->getFont()->setBold(true)->setSize(8);
            $sheet->getStyle($col . $rowIndex)->applyFromArray($borderStyle);
        }
        $rowIndex++;

        // --- DATA ROWS ---
        $i = 1;
        $totals = ['sp' => 0, 'sa' => 0, 'od' => 0, 'esi' => 0, 'td' => 0, 'np' => 0];

        foreach ($paysheet_array as $pData) {
            $lv = $this->Salaries_model->get_leaves_count_data($pData->mxsal_emp_code, $year . "_" . $month)[0];
            $present = $lv->Present + $lv->First_Half_Present + $lv->Second_Half_Present + $lv->regulation_full_day + $lv->ot_full_day;
            $ph_oh = $lv->Public_Holiday + $lv->Optional_Holiday;
            $pay_days = $present + $lv->Week_Off + $ph_oh + $lv->Casualleave + $lv->Sickleave + $lv->Earnedleave;
            $lop_days = $daysInMonth - $pay_days;

            $stipend_earned = (float)$pData->mxsal_net_sal;
            $recovery = (float)$pData->mxsal_loan_amount;
            $esi_val = (float)$pData->mxsal_esi_emp_cont;
            $total_ded = $recovery + $esi_val;
            $net_paid = (float)$pData->mxsal_net_sal;

            $sheet->setCellValue('A' . $rowIndex, $i++);
            $sheet->setCellValue('B' . $rowIndex, $pData->mxsal_emp_code . "\n" . $pData->mxemp_emp_uan_number);
            $sheet->setCellValue('C' . $rowIndex, $pData->mxemp_emp_fname . ' ' . $pData->mxemp_emp_lname . "\nSIGN: __________");
            $sheet->setCellValue('D' . $rowIndex, 'TRAINEE');
            $sheet->setCellValue('E' . $rowIndex, $present);
            $sheet->setCellValue('F' . $rowIndex, $lv->Week_Off);
            $sheet->setCellValue('G' . $rowIndex, $ph_oh);
            $sheet->setCellValue('H' . $rowIndex, $lop_days);
            $sheet->setCellValue('I' . $rowIndex, $pay_days);
            $sheet->setCellValue('J' . $rowIndex, $pData->mxsal_gross_sal);
            $sheet->setCellValue('K' . $rowIndex, $stipend_earned);
            $sheet->setCellValue('L' . $rowIndex, $recovery);
            $sheet->setCellValue('M' . $rowIndex, $esi_val);
            $sheet->setCellValue('N' . $rowIndex, $total_ded);
            $sheet->setCellValue('O' . $rowIndex, $net_paid);
            $sheet->setCellValue('P' . $rowIndex, ($pData->mxsal_paid_status_flag == 1 ? "PAID" : "UNPAID"));
            $sheet->setCellValue('Q' . $rowIndex, $lv->CurrentSL);

            $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->applyFromArray($borderStyle);
            $sheet->getRowDimension($rowIndex)->setRowHeight(35);

            $totals['sp'] += $pData->mxsal_gross_sal; $totals['sa'] += $stipend_earned;
            $totals['od'] += $recovery; $totals['esi'] += $esi_val;
            $totals['td'] += $total_ded; $totals['np'] += $net_paid;
            $rowIndex++;
        }

        // --- GRAND TOTAL ---
        $sheet->setCellValue('A' . $rowIndex, 'GRAND TOTAL');
        $sheet->mergeCells('A' . $rowIndex . ':I' . $rowIndex);
        $sheet->setCellValue('J' . $rowIndex, $totals['sp']);
        $sheet->setCellValue('K' . $rowIndex, $totals['sa']);
        $sheet->setCellValue('L' . $rowIndex, $totals['od']);
        $sheet->setCellValue('M' . $rowIndex, $totals['esi']);
        $sheet->setCellValue('N' . $rowIndex, $totals['td']);
        $sheet->setCellValue('O' . $rowIndex, $totals['np']);

        $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->getFont()->setBold(true);
        $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->applyFromArray($borderStyle);

        // Auto-size columns A-C, others set fixed width
        foreach (range('A', 'C') as $col) { $sheet->getColumnDimension($col)->setAutoSize(true); }
        foreach (range('D', 'Q') as $col) { $sheet->getColumnDimension($col)->setWidth(11); }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Trainee_Paysheet_' . $date . '.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * Placeholder for Professional Paysheet (Type 6)
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */

    private function _generate_professional_paysheet($paysheet_array, $userdata, $month, $year) {
        while (ob_get_level()) { ob_end_clean(); }
        ini_set('memory_limit', '1024M');

        $date = $userdata['date'];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];
        $monthYearName = strtoupper(date('F - Y', strtotime('01-' . $date)));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $divisionName = ($divison != 0 && $divison != null) ? $paysheet_array[0]->mxd_name : "ALL OVER INDIA";
        $branchName = ($branch != 0 && $branch != null) ? $paysheet_array[0]->mxb_name : "All BRANCHES";
        $branchCode = ($branch != 0 && $branch != null) ? $paysheet_array[0]->mxb_short_code : "";

        usort($paysheet_array, function($a, $b) {
            return strcmp($a->mxsal_emp_code, $b->mxsal_emp_code);
        });

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setTitle('Professional Paysheet');

        $borderStyle = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']]]];

        $rowIndex = 1;

        // --- ROW 1: HEADER ---
        $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
        $sheet->setCellValue('A' . $rowIndex, 'DIVISION');
        $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
        $sheet->setCellValue('C' . $rowIndex, $divisionName);

        $sheet->mergeCells('G' . $rowIndex . ':L' . $rowIndex);
        $sheet->setCellValue('G' . $rowIndex, 'PAY SHEET FOR PROFESSIONAL');

        $sheet->mergeCells('M' . $rowIndex . ':P' . $rowIndex);
        $sheet->setCellValue('M' . $rowIndex, 'MAXWELL-F03/HRD/PAYS/00');
        $sheet->getStyle('A' . $rowIndex . ':P' . $rowIndex)->applyFromArray($borderStyle);
        $sheet->getStyle('G' . $rowIndex)->getFont()->setBold(true);
        $rowIndex++;

        // --- ROW 2: BRANDING (Logo anchored to Column J) ---
        $sheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
        $sheet->setCellValue('A' . $rowIndex, "PAYSHEET FOR:\nTOTAL WORKING DAYS:\nCompany PF Code:");
        $sheet->getStyle('A' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->mergeCells('C' . $rowIndex . ':F' . $rowIndex);
        $sheet->setCellValue('C' . $rowIndex, $monthYearName . "\n" . $daysInMonth . "\nAP/HYD/59887");
        $sheet->getStyle('C' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->mergeCells('G' . $rowIndex . ':L' . $rowIndex);
        $sheet->setCellValue('G' . $rowIndex, 'MAXWELL LOGISTICS PRIVATE LIMITED');
        $sheet->getStyle('G' . $rowIndex)->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('G' . $rowIndex . ':L' . $rowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G' . $rowIndex . ':L' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);

        // LOGO FIX: Moving anchor to J
        if (file_exists('assets/img/logo.png')) {
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setPath('assets/img/logo.png');
            $objDrawing->setHeight(40);
            $objDrawing->setCoordinates('J' . $rowIndex);
            $objDrawing->setWorksheet($sheet);
        }

        $sheet->mergeCells('M' . $rowIndex . ':N' . $rowIndex);
        $sheet->setCellValue('M' . $rowIndex, "BRANCH CODE:\nBRANCH NAME:\nGenerated Date:");

        $sheet->mergeCells('O' . $rowIndex . ':P' . $rowIndex);
        $sheet->setCellValue('O' . $rowIndex, $branchCode . "\n" . $branchName . "\n" . date('d-m-Y H:i:s'));
        $sheet->getStyle('M' . $rowIndex . ':P' . $rowIndex)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $sheet->getRowDimension($rowIndex)->setRowHeight(65);
        $sheet->getStyle('A' . $rowIndex . ':P' . $rowIndex)->applyFromArray($borderStyle);
        $rowIndex++;

        // --- ROW 3: HEADERS ---
        $headers = [
            'A'=>'S.No', 'B'=>'EMP CODE / UAN', 'C'=>'EMP NAME', 'D'=>'STATUS', 'E'=>'DAYS', 'F'=>'SUN',
            'G'=>'PH', 'H'=>'LOP', 'I'=>'PAY DAYS', 'J'=>'RATE OF CONSULTANCY', 'K'=>'EARNED CHARGES',
            'L'=>'RECOVERY', 'M'=>'TDS', 'N'=>'NET PAID', 'O'=>'PAY STATUS', 'P'=>'SL BAL'
        ];
        foreach ($headers as $col => $val) {
            $sheet->setCellValue($col . $rowIndex, $val);
            $sheet->getStyle($col . $rowIndex)->getFont()->setBold(true);
            $sheet->getStyle($col . $rowIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($col . $rowIndex)->applyFromArray($borderStyle);
        }
        $rowIndex++;

        // --- DATA LOOP ---
        $i = 1;
        $t = ['rate' => 0, 'earn' => 0, 'rec' => 0, 'tds' => 0, 'net' => 0];

        foreach ($paysheet_array as $pData) {
            $lv = $this->Salaries_model->get_leaves_count_data($pData->mxsal_emp_code, $year . "_" . $month)[0];
            $present = $lv->Present + $lv->First_Half_Present + $lv->Second_Half_Present + $lv->regulation_full_day + $lv->ot_full_day;
            $ph_oh = $lv->Public_Holiday + $lv->Optional_Holiday;
            $pay_days = $present + $lv->Week_Off + $ph_oh + $lv->Casualleave + $lv->Sickleave + $lv->Earnedleave;

            $sheet->setCellValue('A' . $rowIndex, $i++);
            $sheet->setCellValueExplicit('B' . $rowIndex, $pData->mxsal_emp_code, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('B' . ($rowIndex + 1), $pData->mxemp_emp_uan_number, PHPExcel_Cell_DataType::TYPE_STRING);

            $sheet->setCellValue('C' . $rowIndex, $pData->mxemp_emp_fname . ' ' . $pData->mxemp_emp_lname);
            $sheet->setCellValue('C' . ($rowIndex + 1), 'SIGN: ________________');
            $sheet->getStyle('C' . ($rowIndex + 1))->getFont()->setSize(7);

            $sheet->setCellValue('D' . $rowIndex, 'PROFESSIONAL');
            $sheet->setCellValue('E' . $rowIndex, $present);
            $sheet->setCellValue('F' . $rowIndex, $lv->Week_Off);
            $sheet->setCellValue('G' . $rowIndex, $ph_oh);
            $sheet->setCellValue('H' . $rowIndex, ($daysInMonth - $pay_days));
            $sheet->setCellValue('I' . $rowIndex, $pay_days);
            $sheet->setCellValue('J' . $rowIndex, $pData->mxsal_gross_sal);
            $sheet->setCellValue('K' . $rowIndex, $pData->mxsal_actual_gross);
            $sheet->setCellValue('L' . $rowIndex, $pData->mxsal_loan_amount);
            $sheet->setCellValue('M' . $rowIndex, $pData->mxsal_tds_amount);
            $sheet->setCellValue('N' . $rowIndex, $pData->mxsal_net_sal);
            $sheet->setCellValue('O' . $rowIndex, ($pData->mxsal_paid_status_flag == 1 ? "PAID" : "UNPAID"));
            $sheet->setCellValue('P' . $rowIndex, $lv->CurrentSL);

            $sheet->getStyle('A' . $rowIndex . ':P' . ($rowIndex + 1))->applyFromArray($borderStyle);
            $sheet->getStyle('A' . $rowIndex . ':P' . $rowIndex)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('J' . $rowIndex . ':N' . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');

            $t['rate'] += $pData->mxsal_gross_sal; $t['earn'] += $pData->mxsal_actual_gross;
            $t['rec'] += $pData->mxsal_loan_amount; $t['tds'] += $pData->mxsal_tds_amount;
            $t['net'] += $pData->mxsal_net_sal;

            $rowIndex += 2;
        }

        // --- GRAND TOTAL ---
        $sheet->setCellValue('A' . $rowIndex, 'GRAND TOTAL');
        $sheet->mergeCells('A' . $rowIndex . ':I' . $rowIndex);
        $sheet->setCellValue('J' . $rowIndex, $t['rate']);
        $sheet->setCellValue('K' . $rowIndex, $t['earn']);
        $sheet->setCellValue('L' . $rowIndex, $t['rec']);
        $sheet->setCellValue('M' . $rowIndex, $t['tds']);
        $sheet->setCellValue('N' . $rowIndex, $t['net']);

        $sheet->getStyle('A' . $rowIndex . ':P' . $rowIndex)->applyFromArray($borderStyle);
        $sheet->getStyle('A' . $rowIndex . ':P' . $rowIndex)->getFont()->setBold(true);
        $sheet->getStyle('J' . $rowIndex . ':N' . $rowIndex)->getNumberFormat()->setFormatCode('#,##0.00');

        foreach (range('A', 'P') as $col) { $sheet->getColumnDimension($col)->setAutoSize(true); }
        $sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(30);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Professional_Paysheet_' . $date . '.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * FOR EXPORTING PAYSHEET REPORT TO PDF
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */

    public function generate_paysheet_pdf_pure() {
        while (ob_get_level()) { ob_end_clean(); }
        ini_set('memory_limit', '1024M');

        $userdata = $this->input->post();
        $date = $userdata['date'];
        $ex = explode("-", $date);
        $month = $ex[0]; $year = $ex[1];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];
        $emptype = $userdata['emptype'];
        $company = $userdata['company'];
        $state = $userdata['state'];
        $paysheetCat = $userdata['paysheet'];

        if($paysheetCat == 'paysheet') {
            $paysheet_array = $this->Salaries_model->getPaysheet($date, $company, $divison, $state, $branch, $emptype, '', '');
        } else if($paysheetCat == 'supplementary_paysheet') {
            $paysheet_array = $this->Salaries_model->get_Supplementary_Paysheet($date, $company, $divison, $state, $branch, $emptype, '');
        }
        if (empty($paysheet_array)) { die("No data found."); }

        // Route to separated generation methods
        if ($emptype == 6) {
            // Sorting by Emp Code
            usort($paysheet_array, function($a, $b) {
                return strcmp($a->mxsal_emp_code, $b->mxsal_emp_code);
            });
            $this->_generate_professional_pdf_logic($paysheet_array, $userdata, $month, $year);
        } else if ($emptype == 5) {
            $this->_generate_trainee_pdf_logic($paysheet_array, $userdata, $month, $year);
        } else {
            $this->_generate_standard_pdf_logic($paysheet_array, $userdata, $month, $year);
        }
    }

    /**
     * FOR EXPORTING EMPLOYEE PAYSHEET REPORT TO PDF
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */

    private function _generate_standard_pdf_logic($paysheet_array, $userdata, $month, $year) {
        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        $date = $userdata['date'];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];
        $paysheetCat = $userdata['paysheet'];

        $divisionName = ($divison != 0 && $divison != null) ? $paysheet_array[0]->mxd_name : "ALL OVER INDIA";
        $branchCodeLabel = "";
        $branchName = "All BRANCHES";
        if($branch != 0 && $branch != null && !empty($paysheet_array[0]->mxb_short_code)) {
            $branchCodeLabel = '<b>BRANCH CODE:</b> ' . $paysheet_array[0]->mxb_short_code . '<br>';
            $branchName = $paysheet_array[0]->mxb_name;
        }

        $monthYearName = date('F - Y', strtotime('01-' . $date));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $generatedDate = date('d-m-Y H:i:s');

        $pdf = new TCPDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);
        $pdf->setPrintHeader(false); $pdf->setPrintFooter(false);
        $pdf->SetMargins(5, 5, 5); $pdf->SetAutoPageBreak(TRUE, 10);

        $w = [
            'sno'=>22, 'code'=>50, 'name'=>80, 'days'=>20, 'sun'=>12, 'ph'=>12, 'lv'=>17, 'lop'=>19, 'pday'=>20,
            'rate'=>35, 'earn'=>35, 'tot_e'=>52, 'pf_tds'=>38, 'esi_pt'=>28, 'lwf'=>12, 'lwf_mi'=>32, 'stf_ad'=>38,
            'tot_d'=>40, 'net'=>40, 'status'=>30, 'bal_sa'=>38, 'bal_lv'=>18
        ];

        $t = ['r_bs'=>0,'r_hr'=>0,'r_ot'=>0,'e_bs'=>0,'e_hr'=>0,'e_mi'=>0,'e_gr'=>0,'d_pf'=>0,'d_es'=>0,'d_pt'=>0,'d_td'=>0,'d_lw'=>0,'d_mi'=>0,'d_st'=>0,'t_de'=>0,'t_ne'=>0,'b_st'=>0];
        $i = 1;
        $pages = array_chunk($paysheet_array, 8);
        $total_pages = count($pages);

        foreach ($pages as $page_index => $current_page_data) {
            $pdf->AddPage();
            if (file_exists('assets/img/logo.png')) {
                $pdf->Image('assets/img/logo.png', 160, 5, 40, '', 'PNG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
            }
            $pdf->Ln(18);
            $pdf->SetFont('helvetica', '', 6);

            $html = '<table border="0.5" cellpadding="3" style="width: 100%;">
<thead>
    <tr bgcolor="#eeeeee">
        <td colspan="5" width="'.($w['sno'] + $w['code'] + $w['name'] + $w['days'] + $w['sun']).'">
           <b>DIVISION:</b> '.$divisionName.'<br><b>Company PF Code:</b> AP/HYD/59887
        </td>
        <td colspan="26" width="'.($w['ph'] + ($w['lv']*4) + $w['lop'] + $w['pday'] + ($w['rate']*3) + ($w['earn']*3) + $w['tot_e'] + ($w['esi_pt']*2) + ($w['pf_tds']*2) + $w['lwf'] + $w['lwf_mi'] + $w['stf_ad'] + $w['tot_d'] + $w['net']).'" align="center">
            <span style="font-size:12px;"><b>MAXWELL LOGISTICS PRIVATE LIMITED</b></span><br>
            <span style="font-size:10px;"><b>PAY SHEET ('.$monthYearName.')</b></span><br>
            <b>No. of days in Month:</b> '.$daysInMonth.'
        </td>
        <td colspan="4" align="right" width="'.($w['status'] + $w['bal_sa'] + ($w['bal_lv']*3) + 5).'">
            <b>MAXWELL-F03/HRD/PAYS/00</b><br>'.$branchCodeLabel.'<b>BRANCH NAME:</b> '.$branchName.'<br><b>Generated:</b> '.$generatedDate.'
        </td>
    </tr>
    <tr style="background-color:#dfdfdf; font-weight:bold; text-align:center;">
        <th rowspan="2" width="'.$w['sno'].'">S.No</th>
        <th rowspan="2" width="'.$w['code'].'">EMP CODE/<br>UAN NO</th>
        <th rowspan="2" width="'.$w['name'].'">EMP NAME</th>
        <th rowspan="2" width="'.$w['days'].'">NO. OF DAYS<br>WORKED</th>
        <th rowspan="2" width="'.$w['sun'].'">SUNDAYS</th>
        <th rowspan="2" width="'.$w['ph'].'">PH/OH</th>
        <th colspan="4" width="'.($w['lv']*4).'">LEAVE WITH PAY</th>
        <th rowspan="2" width="'.$w['lop'].'">LOP</th>
        <th rowspan="2" width="'.$w['pday'].'">PAY DAYS</th>
        <th colspan="3" width="'.($w['rate']*3).'">RATE OF</th>
        <th colspan="3" width="'.($w['earn']*3).'">EARNINGS</th>
        <th rowspan="2" width="'.$w['tot_e'].'">TOTAL EARNINGS</th>
        <th colspan="8" width="'.(($w['esi_pt']*2) + ($w['pf_tds']*2) + $w['lwf'] + $w['lwf_mi'] + $w['stf_ad']).'">DEDUCTIONS</th>
        <th rowspan="2" width="'.$w['tot_d'].'">TOTAL DEDUCTIONS</th>
        <th rowspan="2" width="'.$w['net'].'">NET AMT<br>PAID</th>
        <th rowspan="2" width="'.$w['status'].'">PAYMENT STATUS</th>
        <th colspan="4" width="'.($w['bal_sa'] + ($w['bal_lv']*3) + 5).'">BALANCE</th>
    </tr>
    <tr style="background-color:#dfdfdf; font-weight:bold; text-align:center;">
        <th width="'.$w['lv'].'">EL</th><th width="'.$w['lv'].'">CL</th><th width="'.$w['lv'].'">SL</th><th width="'.$w['lv'].'">ML</th>
        <th width="'.$w['rate'].'">BASIC</th><th width="'.$w['rate'].'">HRA</th><th width="'.$w['rate'].'">OTHER</th>
        <th width="'.$w['earn'].'">BASIC</th><th width="'.$w['earn'].'">HRA</th><th width="'.$w['earn'].'">MISC. INCOME/INCENTIVE</th>
        <th width="'.$w['pf_tds'].'">PF</th><th width="'.$w['esi_pt'].'">ESI</th><th width="'.$w['esi_pt'].'">PR. TAX</th><th width="'.$w['pf_tds'].'">TDS</th>
        <th width="'.$w['lwf'].'">LWF</th><th width="'.$w['lwf_mi'].'">MISC DEDUCTIONS</th><th width="'.$w['stf_ad'].'">STF AD</th>
        <th width="'.$w['bal_sa'].'">Staff Adv</th><th width="'.($w['bal_lv']+5).'">EL</th><th width="'.$w['bal_lv'].'">CL</th><th width="'.$w['bal_lv'].'">SL</th>
    </tr>
</thead>
<tbody>';

            foreach ($current_page_data as $pData) {
                $lv_data = $this->Salaries_model->get_leaves_count_data($pData->mxsal_emp_code, $year . "_" . $month);
                $lv = $lv_data[0];
                $present = $lv->Present + $lv->First_Half_Present + $lv->Second_Half_Present + $lv->regulation_full_day + $lv->First_Half_regulation + $lv->Second_Half_regulation + $lv->First_Half_Shortleave + $lv->Second_Half_Shortleave + $lv->ot_full_day + $lv->First_Half_ot + $lv->Second_Half_ot;
                $ph_oh = $lv->Public_Holiday + $lv->First_Half_Public_Holiday + $lv->Second_Half_Public_Holiday + $lv->Optional_Holiday + $lv->First_Half_Optional_Holiday + $lv->Second_Half_Optional_Holiday;

                // $loan = $this->Loan_model->getloandetails_payslip($pData->mxsal_emp_code);
                // $loan_bal = isset($loan[0]) ? (float)$loan[0]->mxemploan_emp_loan_outstanding_amt : 0;

                /*  Updated BY  Varaprasad
                 * ON : 22 JUl 2026
                 * Purpose : Loan Outstanding should reflect the month-wise outstanding balance as of the generated report month instead of the current outstanding balance
                 */

                $loan = $this->Loan_model->getEmployeeLoanOutstandingAfterDeduction($pData->mxsal_emp_code, $year.$month);

                $loan_bal = isset($loan) ? (float)$loan: 0;

                $CL = $lv->Casualleave + $lv->First_Half_Casualleave + $lv->Second_Half_Casualleave;
                $SL = $lv->Sickleave + $lv->First_Half_Sickleave + $lv->Second_Half_Sickleave;
                $EL = $lv->Earnedleave + $lv->First_Half_Earnedleave + $lv->Second_Half_Earnedleave;
                $pay_days = $present + $lv->Week_Off + $ph_oh + $CL + $SL + $EL;
                $lop = $daysInMonth - $pay_days;

                $mxsal_actual_gross=$pData->mxsal_actual_gross;
                $mxsal_total_ded=round($pData->mxsal_total_ded);
                $mxsal_net_sal=$mxsal_actual_gross-$mxsal_total_ded;
                $mxsal_net_sal=round($mxsal_net_sal);

                $html .= '<tr nobr="true">
    <td width="'.$w['sno'].'" align="center">'.$i++.'</td>
    <td width="'.$w['code'].'">'.$pData->mxsal_emp_code.'<br>'.$pData->mxemp_emp_uan_number.'</td>
    <td height="45" width="'.$w['name'].'">'.$pData->mxemp_emp_fname.' '.$pData->mxemp_emp_lname.'<br><i>SIGN OF EMP:</i><br><br><br>________________</td>
    <td width="'.$w['days'].'" align="center">'.$present.'</td>
    <td width="'.$w['sun'].'" align="center">'.$lv->Week_Off.'</td>
    <td width="'.$w['ph'].'" align="center">'.$ph_oh.'</td>
    <td width="'.$w['lv'].'" align="center">'.$EL.'</td>
    <td width="'.$w['lv'].'" align="center">'.$CL.'</td>
    <td width="'.$w['lv'].'" align="center">'.$SL.'</td>
    <td width="'.$w['lv'].'" align="center">'.$lv->Meternityleave.'</td>
    <td width="'.$w['lop'].'" align="center">'.$lop.'</td>
    <td width="'.$w['pday'].'" align="center">'.$pay_days.'</td>
    <td width="'.$w['rate'].'" align="right">'.number_format($pData->mxsal_basic,0).'</td>
    <td width="'.$w['rate'].'" align="right">'.number_format($pData->mxsal_hra,0).'</td>
    <td width="'.$w['rate'].'" align="right">'.number_format($pData->mxsal_variable_pay_sha,0).'</td>
    <td width="'.$w['earn'].'" align="right">'.number_format($pData->mxsal_actual_basic,0).'</td>
    <td width="'.$w['earn'].'" align="right">'.number_format($pData->mxsal_actual_hra,0).'</td>
    <td width="'.$w['earn'].'" align="right">'.number_format($pData->mxsal_incentive_amount,0).'</td>
    <td width="'.$w['tot_e'].'" align="right"><b>'.number_format($pData->mxsal_actual_gross,0).'</b></td>
    <td width="'.$w['pf_tds'].'" align="right">'.number_format($pData->mxsal_pf_emp_cont,0).'</td>
    <td width="'.$w['esi_pt'].'" align="right">'.number_format($pData->mxsal_esi_emp_cont,0).'</td>
    <td width="'.$w['esi_pt'].'" align="right">'.number_format($pData->mxsal_pt,0).'</td>
    <td width="'.$w['pf_tds'].'" align="right">'.number_format($pData->mxsal_tds_amount,0).'</td>
    <td width="'.$w['lwf'].'" align="right">'.number_format($pData->mxsal_lwf_emp_cont,0).'</td>
    <td width="'.$w['lwf_mi'].'" align="right">'.number_format($pData->mxsal_miscelleneous_amount,0).'</td>
    <td width="'.$w['stf_ad'].'" align="right">'.number_format($pData->mxsal_loan_amount,0).'</td>
    <td width="'.$w['tot_d'].'" align="right">'.number_format($mxsal_total_ded,0).'</td>
    <td width="'.$w['net'].'" align="right"><b>'.number_format($mxsal_net_sal,0).'</b></td>
    <td width="'.$w['status'].'" align="center">'.($pData->mxsal_paid_status_flag == 1 ? "PAID" : "UNPAID").'</td>
    <td width="'.$w['bal_sa'].'" align="right">'.number_format($loan_bal,0).'</td>
    <td width="'.($w['bal_lv'] + 5).'" align="center">'.$lv->CurrentEL.'</td>
    <td width="'.$w['bal_lv'].'" align="center">'.$lv->CurrentCL.'</td>
    <td width="'.$w['bal_lv'].'" align="center">'.$lv->CurrentSL.'</td>
</tr>';

                $t['r_bs'] += $pData->mxsal_basic; $t['r_hr'] += $pData->mxsal_hra; $t['r_ot'] += $pData->mxsal_variable_pay_sha;
                $t['e_bs'] += $pData->mxsal_actual_basic; $t['e_hr'] += $pData->mxsal_actual_hra; $t['e_mi'] += $pData->mxsal_incentive_amount; $t['e_gr'] += $pData->mxsal_actual_gross;
                $t['d_pf'] += $pData->mxsal_pf_emp_cont; $t['d_es'] += $pData->mxsal_esi_emp_cont; $t['d_pt'] += $pData->mxsal_pt; $t['d_td'] += $pData->mxsal_tds_amount;
                $t['d_lw'] += $pData->mxsal_lwf_emp_cont; $t['d_mi'] += $pData->mxsal_miscelleneous_amount; $t['d_st'] += $pData->mxsal_loan_amount;
                $t['t_de'] += $mxsal_total_ded; $t['t_ne'] += $mxsal_net_sal; $t['b_st'] += $loan_bal;
            }

            if ($page_index == ($total_pages - 1)) {
                $html .= '<tfoot>
    <tr style="background-color:#eeeeee; font-weight:bold; text-align:right;">
        <td colspan="12" align="center">GRAND TOTAL</td>
        <td width="'.$w['rate'].'">'.number_format($t['r_bs'],0).'</td><td width="'.$w['rate'].'">'.number_format($t['r_hr'],0).'</td><td width="'.$w['rate'].'">'.number_format($t['r_ot'],0).'</td>
        <td width="'.$w['earn'].'">'.number_format($t['e_bs'],0).'</td><td width="'.$w['earn'].'">'.number_format($t['e_hr'],0).'</td><td width="'.$w['earn'].'">'.number_format($t['e_mi'],0).'</td>
        <td width="'.$w['tot_e'].'">'.number_format($t['e_gr'],0).'</td><td width="'.$w['pf_tds'].'">'.number_format($t['d_pf'],0).'</td><td width="'.$w['esi_pt'].'">'.number_format($t['d_es'],0).'</td>
        <td width="'.$w['esi_pt'].'">'.number_format($t['d_pt'],0).'</td><td width="'.$w['pf_tds'].'">'.number_format($t['d_td'],0).'</td><td width="'.$w['lwf'].'">'.number_format($t['d_lw'],0).'</td>
        <td width="'.$w['lwf_mi'].'">'.number_format($t['d_mi'],0).'</td><td width="'.$w['stf_ad'].'">'.number_format($t['d_st'],0).'</td><td width="'.$w['tot_d'].'">'.number_format($t['t_de'],0).'</td>
        <td width="'.$w['net'].'">'.number_format($t['t_ne'],0).'</td><td width="'.$w['status'].'"></td>
        <td width="'.$w['bal_sa'].'">'.number_format($t['b_st'],0).'</td><td colspan="2" width="'.(($w['bal_lv']*2)+5).'"></td><td width="'.$w['bal_lv'].'"></td>
    </tr>
</tfoot>';
            }

            $html .= '</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        ob_clean();
        $pdf->Output(($paysheetCat == 'paysheet' ? 'paysheet_' : 'supplementary_paysheet_') . $date . '.pdf', 'D');
        exit;
    }

    /**
     * FOR EXPORTING PROFESSIONAL PAYSHEET REPORT TO PDF
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */

    private function _generate_professional_pdf_logic($paysheet_array, $userdata, $month, $year) {
        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        $date = $userdata['date'];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];

        $divisionName = ($divison != 0 && $divison != null) ? $paysheet_array[0]->mxd_name : "ALL OVER INDIA";
        $branchName = ($branch != 0 && $branch != null && !empty($paysheet_array[0]->mxb_name)) ? $paysheet_array[0]->mxb_name : "All BRANCHES";
        $branchCodeLabel = ($branch != 0 && $branch != null && !empty($paysheet_array[0]->mxb_short_code)) ? '<b>BRANCH CODE:</b> ' . $paysheet_array[0]->mxb_short_code . '<br>' : '';

        $monthYearName = strtoupper(date('F - Y', strtotime('01-' . $date)));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $generatedDate = date('d-m-Y H:i:s');

        $pdf = new TCPDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);
        $pdf->setPrintHeader(false); $pdf->setPrintFooter(false);
        $pdf->SetMargins(5, 5, 5); $pdf->SetAutoPageBreak(TRUE, 10);

        $i = 1;
        foreach (array_chunk($paysheet_array, 8) as $page_index => $current_page_data) {
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 7);

            $html = '<table border="0.5" cellpadding="4" style="width: 100%;">
                        <thead>
                            <tr>
                                <td colspan="4" bgcolor="#eeeeee" style="font-size:8px;">
                                    DIVISION: '.$divisionName.'<br>Company PF Code: AP/HYD/59887
                                </td>
                                <td colspan="7" align="center">
                                    <img src="assets/img/logo.png" width="90"><br>
                                    <span style="font-size:12px;"><b>MAXWELL LOGISTICS PRIVATE LIMITED</b></span><br>
                                    <span style="font-size:10px;"><b>CONSULTANCY CHARGES FOR THE MONTH OF '.$monthYearName.'</b></span><br>
                                    <span style="font-size:8px;">No. of days in Month: '.$daysInMonth.'</span>
                                </td>
                                <td colspan="5" align="right" bgcolor="#eeeeee" style="font-size:8px;">
                                    <b>MAXWELL-F03/HRD/PAYS/00</b><br>'.$branchCodeLabel.'<b>BRANCH NAME:</b> '.$branchName.'<br><b>Generated:</b> '.$generatedDate.'
                                </td>
                            </tr>
                            <tr style="background-color:#dfdfdf; font-weight:bold; text-align:center; font-size:7px;">
                                <th rowspan="2" align="center">S.No</th>
                                <th rowspan="2" align="center">EMP CODE/<br>UAN NO</th>
                                <th rowspan="2">EMP NAME</th>
                                <th rowspan="2" align="center">STATUS</th>
                                <th rowspan="2" align="center">DAYS<br>WRK</th>
                                <th rowspan="2" align="center">SUN</th>
                                <th rowspan="2" align="center">PH</th>
                                <th rowspan="2" align="center" bgcolor="#f2dede">LOP</th>
                                <th rowspan="2" align="center">PAY<br>DAYS</th>
                                <th rowspan="2" align="right">RATE OF CONSULTANCY<br>CHARGES PER MONTH</th>
                                <th rowspan="2" align="right">CONSULTANCY<br>CHARGES PER MONTH</th>
                                <th colspan="2" align="center">DEDUCTIONS</th>
                                <th rowspan="2" align="right">NET AMT<br>PAID</th>
                                <th rowspan="2" align="center">PAYMENT<br>STATUS</th>
                                <th align="center">BALANCE</th>
                            </tr>
                            <tr style="background-color:#dfdfdf; font-weight:bold; text-align:center; font-size:7px;">
                                <th align="right">RECOVERY</th>
                                <th align="right">TDS</th>
                                <th align="center">SL</th>
                            </tr>
                        </thead>
                        <tbody>';

            foreach ($current_page_data as $pData) {
                $lv = $this->Salaries_model->get_leaves_count_data($pData->mxsal_emp_code, $year . "_" . $month)[0];
                $present = $lv->Present + $lv->First_Half_Present + $lv->Second_Half_Present + $lv->regulation_full_day + $lv->ot_full_day;
                $ph_oh = $lv->Public_Holiday + $lv->Optional_Holiday;

                // LOP Calculation (assuming LOP is total days minus pay days)
                $pay_days = $present + $lv->Week_Off + $ph_oh + $lv->Casualleave + $lv->Sickleave + $lv->Earnedleave;
                $lop_days = $daysInMonth - $pay_days;

                $consultancy_earned = (float)$pData->mxsal_net_sal;
                $recovery = (float)$pData->mxsal_loan_amount;
                $tds_val = $pData->mxsal_tds_amount;
                $final_net = $consultancy_earned - $recovery - $tds_val;

                $html .= '<tr nobr="true" style="font-size:7px;">
                <td align="center">'.$i++.'</td>
                <td align="center">'.$pData->mxsal_emp_code.'<br>'.$pData->mxemp_emp_uan_number.'</td>
                <td height="50">'.$pData->mxemp_emp_fname.' '.$pData->mxemp_emp_lname.'<br><i>SIGN:</i><br>__________</td>
                <td align="center">PROFESSIONAL CHARGES</td>
                <td align="center">'.$present.'</td>
                <td align="center">'.$lv->Week_Off.'</td>
                <td align="center">'.$ph_oh.'</td>
                <td align="center" bgcolor="#f2dede">'.$lop_days.'</td>
                <td align="center">'.$pay_days.'</td>
                <td align="right">'.number_format($pData->mxsal_gross_sal, 2).'</td>
                <td align="right">'.number_format($consultancy_earned, 2).'</td>
                <td align="right">'.number_format($recovery, 2).'</td>
                <td align="right">'.number_format($tds_val, 2).'</td>
                <td align="right"><b>'.number_format($final_net, 2).'</b></td>
                <td align="center">'.($pData->mxsal_paid_status_flag == 1 ? "PAID" : "UNPAID").'</td>
                <td align="center">'.$lv->CurrentSL.'</td>
            </tr>';
            }

            $html .= '</tbody></table>';
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        ob_clean();
        $pdf->Output('professional_paysheet_' . $date . '.pdf', 'D');
        exit;
    }

    /**
     * FOR EXPORTING TRAINEE PAYSHEET REPORT TO PDF
     * Developer : Varaprasad
     * Developed on: 08/03/2026
     */

    private function _generate_trainee_pdf_logic($paysheet_array, $userdata, $month, $year) {
        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        $date = $userdata['date'];
        $divison = $userdata['divison'];
        $branch = $userdata['branch'];

        $divisionName = ($divison != 0 && $divison != null) ? $paysheet_array[0]->mxd_name : "ALL OVER INDIA";
        $branchName = ($branch != 0 && $branch != null && !empty($paysheet_array[0]->mxb_name)) ? $paysheet_array[0]->mxb_name : "All BRANCHES";
        $branchCodeLabel = ($branch != 0 && $branch != null && !empty($paysheet_array[0]->mxb_short_code)) ? '<b>BRANCH CODE:</b> ' . $paysheet_array[0]->mxb_short_code . '<br>' : '';

        $monthYearName = strtoupper(date('F - Y', strtotime('01-' . $date)));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $generatedDate = date('d-m-Y H:i:s');

        $pdf = new TCPDF('L', 'mm', 'LEGAL', true, 'UTF-8', false);
        $pdf->setPrintHeader(false); $pdf->setPrintFooter(false);
        $pdf->SetMargins(5, 5, 5); $pdf->SetAutoPageBreak(TRUE, 10);

        $i = 1;
        foreach (array_chunk($paysheet_array, 8) as $page_index => $current_page_data) {
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 7);

            $html = '<table border="0.5" cellpadding="4" style="width: 100%;">
<thead>
    <tr>
        <td colspan="4" bgcolor="#eeeeee" style="font-size:8px;">
            <b>DIVISION:</b> '.$divisionName.'
        </td>
        <td colspan="7" align="center">
            <img src="assets/img/logo.png" width="90"><br>
            <span style="font-size:12px;"><b>MAXWELL LOGISTICS PRIVATE LIMITED</b></span><br>
            <span style="font-size:10px;"><b>PAY SHEET FOR TRAINEE EMPLOYEES ('.$monthYearName.')</b></span><br>
            <span style="font-size:8px;">No. of days in Month: '.$daysInMonth.'</span>
        </td>
        <td colspan="6" align="right" bgcolor="#eeeeee" style="font-size:8px;">
            <b>MAXWELL-F03/HRD/PAYS/00</b><br>'.$branchCodeLabel.'<b>BRANCH NAME:</b> '.$branchName.'<br><b>Generated:</b> '.$generatedDate.'
        </td>
    </tr>
    <tr style="background-color:#dfdfdf; font-weight:bold; text-align:center; font-size:6.5px;">
        <th rowspan="2" align="center">S.No</th>
        <th rowspan="2" align="center">EMP CODE/<br>UAN NO</th>
        <th rowspan="2">EMP NAME</th>
        <th rowspan="2" align="center">STATUS</th>
        <th rowspan="2" align="center">DAYS<br>WRK</th>
        <th rowspan="2" align="center">SUN</th>
        <th rowspan="2" align="center">PH</th>
        <th rowspan="2" align="center">LOP</th>
        <th rowspan="2" align="center">PAY<br>DAYS</th>
        <th rowspan="2" align="right">STIPEND PER MONTH</th>
        <th rowspan="2" align="right">STIPEND PAYABLE</th>
        <th colspan="2" align="center">DEDUCTIONS</th>
        <th rowspan="2" align="right">TOTAL<br>DEDUCTIONS</th>
        <th rowspan="2" align="right">NET AMT<br>PAID</th>
        <th rowspan="2" align="center">PAYMENT<br>STATUS</th>
        <th align="center">BALANCE</th>
    </tr>
    <tr style="background-color:#dfdfdf; font-weight:bold; text-align:center; font-size:6.5px;">
        <th align="right">OTHER</th>
        <th align="right">ESI</th>
        <th align="center">SL</th>
    </tr>
</thead>
<tbody>';

            foreach ($current_page_data as $pData) {
                $lv = $this->Salaries_model->get_leaves_count_data($pData->mxsal_emp_code, $year . "_" . $month)[0];
                $present = $lv->Present + $lv->First_Half_Present + $lv->Second_Half_Present + $lv->regulation_full_day + $lv->ot_full_day;
                $ph_oh = $lv->Public_Holiday + $lv->Optional_Holiday;
                $pay_days = $present + $lv->Week_Off + $ph_oh + $lv->Casualleave + $lv->Sickleave + $lv->Earnedleave;
                $lop_days = $daysInMonth - $pay_days;

                $stipend_earned = (float)$pData->mxsal_net_sal;
                $recovery = (float)$pData->mxsal_loan_amount;
                $esi_val = $pData->mxsal_esi_emp_cont;

                // Calculate Total Deductions
                $total_deductions = $recovery + $tds_val;
                $final_net = $stipend_earned - $total_deductions;

                $html .= '<tr nobr="true" style="font-size:7px;">
                <td align="center">'.$i++.'</td>
                <td align="center">'.$pData->mxsal_emp_code.'<br>'.$pData->mxemp_emp_uan_number.'</td>
                <td height="50">'.$pData->mxemp_emp_fname.' '.$pData->mxemp_emp_lname.'<br><i>SIGN:</i><br>__________</td>
                <td align="center">TRAINEE</td>
                <td align="center">'.$present.'</td>
                <td align="center">'.$lv->Week_Off.'</td>
                <td align="center">'.$ph_oh.'</td>
                <td align="center">'.$lop_days.'</td>
                <td align="center">'.$pay_days.'</td>
                <td align="right">'.number_format($pData->mxsal_gross_sal, 2).'</td>
                <td align="right">'.number_format($stipend_earned, 2).'</td>
                <td align="right">'.number_format($recovery, 2).'</td>
                <td align="right">'.number_format($esi_val, 2).'</td>
                <td align="right">'.number_format($total_deductions, 2).'</td>
                <td align="right"><b>'.number_format($final_net, 2).'</b></td>
                <td align="center">'.($pData->mxsal_paid_status_flag == 1 ? "PAID" : "UNPAID").'</td>
                <td align="center">'.$lv->CurrentSL.'</td>
            </tr>';
            }

            $html .= '</tbody></table>';
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        ob_clean();
        $pdf->Output('trainee_paysheet_' . $date . '.pdf', 'D');
        exit;
    }
}