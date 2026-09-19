<style>
.month-apr{background:#4F46E5!important;}
.month-may{background:#059669!important;}
.month-jun{background:#0891B2!important;}
.month-jul{background:#D97706!important;}
.month-aug{background:#DC2626!important;}
.month-sep{background:#7C3AED!important;}
.month-oct{background:#2563EB!important;}
.month-nov{background:#16A34A!important;}
.month-dec{background:#EA580C!important;}
.month-jan{background:#DB2777!important;}
.month-feb{background:#0F766E!important;}
.month-mar{background:#475569!important;}

.card{
    border:none;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.card-header button{
    color:#fff!important;
    text-decoration:none!important;
    font-size:16px;
    font-weight:600;
}

.table th{
    background:#f8f9fa;
    font-weight:600;
}

.table td{
    vertical-align:middle;
}

.form-control{
    min-height:38px;
}
.weightage-total{
    font-size:14px;
    padding:8px 12px;
    font-weight:600;
}
</style>
<?php
$assignedarray = array();

if(!empty($assigneddata)){
    foreach($assigneddata as $vals){

        $questionid = $vals['mxap_assign_queid'];
        $yearmonth = str_replace('-', '_', $vals['mxap_assign_year_month']);

        $assignedarray[$questionid][$yearmonth] = $vals;
    }
}

$financial_year = explode('_', $userdata['financialyear']);

$startdate = $financial_year[0].'-01';
$enddate   = $financial_year[1].'-01';

$month = strtotime($startdate);
$end   = strtotime($enddate);

$monthClass = array(
    '04'=>'month-apr',
    '05'=>'month-may',
    '06'=>'month-jun',
    '07'=>'month-jul',
    '08'=>'month-aug',
    '09'=>'month-sep',
    '10'=>'month-oct',
    '11'=>'month-nov',
    '12'=>'month-dec',
    '01'=>'month-jan',
    '02'=>'month-feb',
    '03'=>'month-mar'
);

$output = '';

$output .= '
<div class="d-flex justify-content-between align-items-center mb-3">
    <button type="submit" class="btn btn-success">
        Save
    </button>

    <button type="button"
            class="btn btn-info"
            id="copyAprilToAll">
        <i class="fa fa-copy"></i>
        Copy April Data To All Months
    </button>
</div>';



$output .= '<div class="accordion" id="kraAccordion">';

$accordioncount = 1;

while($month <= $end){

    $yearmonth = date('Y_m',$month);
    $monthname = date('M Y',$month);

    $show = ($accordioncount == 1) ? 'show' : '';

    $headerClass = $monthClass[date('m',$month)];

    $output .= '

    <div class="card mb-3">

        <div class="card-header '.$headerClass.' p-0">

            <button class="btn btn-link btn-block text-left p-3"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapse_'.$yearmonth.'">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <span>
                        <i class="fa fa-calendar mr-2"></i>
                        KRA / '.$monthname.'
                    </span>

                    <span class="badge badge-light weightage-total"
                        data-month="'.$yearmonth.'">
                        Weightage : 0%
                    </span>
                </div>
            </button>

        </div>

        <div id="collapse_'.$yearmonth.'"
             class="collapse '.$show.'"
             data-parent="#kraAccordion">

            <div class="card-body p-0 month-body"
                 data-month="'.$yearmonth.'">

                <table class="table table-bordered table-hover mb-0">

                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="25%">Question</th>
                            <th width="20%">Objective</th>
                            <th width="10%">Assign</th>
                            <!-- <th width="15%">Unit Measure</th> -->
                            <th width="10%">Weightage %</th>
                            <th width="15%">Monthly Target</th>
                        </tr>
                    </thead>

                    <tbody>';

    $sno = 1;

    foreach($questions as $question){

        $questionid = $question['mxap_id'];

        $objective='';
        $unitmeasure='';
        $weightage='';
        $assign=0;
        $monthtarget='';

        if(isset($assignedarray[$questionid][$yearmonth])){

            $existing = $assignedarray[$questionid][$yearmonth];

            $objective   = $existing['mxap_assign_objective'];
            $unitmeasure = $existing['mxap_assign_unitmeasure'];
            $weightage   = $existing['mxap_assign_weightage'];
            $assign      = $existing['mxap_assign_que_show'];
            $monthtarget = $existing['mxap_assign_monthlytarget'];
        }

        $output .= '

        <tr data-question="'.$questionid.'">

            <td>

                '.$sno.'

                <input type="hidden"
                       name="question_id[]"
                       value="'.$questionid.'">

            </td>

            <td>
                '.$question['mxap_question'].'
            </td>

            <td>
                <input type="text"
                       class="form-control objective-field"
                       name="objective['.$questionid.']['.$yearmonth.']"
                       value="'.$objective.'">
            </td>

            <td>
                <select class="form-control assign-field"
                        name="assign['.$questionid.']['.$yearmonth.']">

                    <option value="0" '.($assign==0?'selected':'').'>NO</option>
                    <option value="1" '.($assign==1?'selected':'').'>YES</option>

                </select>
            </td>
            <!--
            <td>
                <input type="text"
                       class="form-control unit-field"
                       name="unit_measure['.$questionid.']['.$yearmonth.']"
                       value="'.$unitmeasure.'">
            </td>
            -->
            <td>
                <input type="text"
                       class="form-control weightage-field" min="0"
                        step="0.01"
                       name="weightage['.$questionid.']['.$yearmonth.']"
                       value="'.$weightage.'">
            </td>

            <td>
                <input type="text"
                       class="form-control target-field" min="0"
                        step="0.01"
                       name="monthly_target['.$questionid.']['.$yearmonth.']"
                       value="'.$monthtarget.'">
            </td>

        </tr>';

        $sno++;
    }

    $output .= '

                    </tbody>

                </table>

            </div>

        </div>

    </div>';

    $accordioncount++;

    $month = strtotime('+1 month',$month);
}

$output .= '</div>';

echo $output;
?>
<script>
    $(document).on(
    'keyup change',
    '.weightage-field, .assign-field',
    function(){
        calculateMonthWeightage();
    }
);

$(document).ready(function(){
    calculateMonthWeightage();
});

$(document).on('input', '.weightage-field, .target-field', function () {

    this.value = this.value.replace(/[^0-9.]/g, '');

});
</script>