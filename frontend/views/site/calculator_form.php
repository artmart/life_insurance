
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Plans;
use backend\models\Pirsndoirs;
use backend\models\Mortprmtbls;
use backend\models\Ultqxtbls;


$tbl_rates_select_options = '';
$tbl_plans_options = '';
$select_pir_options = '';
$select_oir_options = '';
$plans_data = [];
$pirs_data = [];
$oirs_data = [];
$mort_prm_tbls = [];
$ult_qx_tbls = [];
$tbl_rates = [100, 125, 150, 175, 200, 225, 250, 275, 300, 325, 350, 375, 400, 450, 500, 1000];
foreach($tbl_rates as $tr){$tbl_rates_select_options .='<option value="'.$tr.'">'.$tr.'%</option>';}

$plans = Plans::find()->all();
foreach($plans as $p){
    if($p['id']==6){$selected = 'selected';}else{$selected = '';}
    $tbl_plans_options .='<option value="'.$p['id'].'" '.$selected.'>'.$p['plan'].'</option>';
    $plans_data[$p['id']] = ['plan'=>$p['plan'], 'qx_tbl'=>$p['qx_tbl'], 'p_load'=>$p['p_load'], 'p_fee'=>$p['p_fee'], 'c_fee'=>$p['c_fee'], 'gdn_int'=>$p['gdn_int'], 
                             'maturity'=>$p['maturity'], 'type'=>$p['type'], 'gl_trmmnt'=>$p['gl_trmmnt'], '7p_trmnt'=>$p['7p_trmnt'], 'jls_ind'=>$p['jls_ind'], 'life_ins_type'=>$p['life_ins_type']];
}


$pirsndoirs = Pirsndoirs::find()->all();
foreach($pirsndoirs as $p){
    if($p['pir_or_oir']=='pir'){ //$selected = 'selected';}else{$selected = '';}
    $select_pir_options .='<option value="'.$p['id'].'">'.$p['plan'].'</option>';
    $pirs_data[$p['id']] = ['plan'=>$p['plan'], 'qx_tbl'=>$p['qx_tbl'], 'maturity'=>$p['maturity'], 'type'=>$p['type'], 'gl_trmmnt'=>$p['gl_trmmnt'], '7p_trmnt'=>$p['7p_trmnt']];
    }else{
        $select_oir_options .='<option value="'.$p['id'].'">'.$p['plan'].'</option>';
        $oirs_data[$p['id']] = ['plan'=>$p['plan'], 'qx_tbl'=>$p['qx_tbl'], 'maturity'=>$p['maturity'], 'type'=>$p['type'], 'gl_trmmnt'=>$p['gl_trmmnt'], '7p_trmnt'=>$p['7p_trmnt']];
    }
}

$mortprmtbls = Mortprmtbls::find()->all();
foreach($mortprmtbls as $m){
    $mort_prm_tbls[$m['id']] = ['MN'=>$m['MN'], 'MS'=>$m['MS'], 'FN'=>$m['FN'], 'FS'=>$m['FS'], 'UN'=>$m['UN'], 'US'=>$m['US']];
}

$ultqxtbls = Ultqxtbls::find()->all();
foreach($ultqxtbls as $u){
    $ult_qx_tbls[$u['name']] = ['name'=>$u['name'], 'type'=>$u['type'], 'period'=>$u['period'], 'u_tbl'=>$u['u_tbl'], 'end_age'=>$u['end_age']];
}
?>

<?php // var_dump($pirs_data);?>
<div class="calculator_form">
<form id="form_id" class="form-horizontal">
<div class="row mb-1">
<div class="col-md-12">

<div class="card border-success">
  <!--<div class="card-header">Details</div>-->
  <div class="card-body text-success">
    <div class="form-group">


<div class="row">
<div class="col-md-2">
<label for="plan_code" class="form-label">Plan Code</label>
<select class="form-select form-select-sm calc1" name="plan_code" id="plan_code">
  <option value="">-Select-</option>
<?=$tbl_plans_options;?> 
</select>
</div>
<div class="col-md-2">  
 <label for="issue_date" class="form-label">Issue Date</label>
 <input type="date" id="issue_date" name="issue_date" value="2010-01-01" class="form-control form-control-sm calc1">
</div>
<div class="col-md-2">  
 <label for="illustration_date" class="form-label">Illustration Date</label>
 <input type="date" id="illustration_date" name="illustration_date" value="2010-01-01" class="form-control form-control-sm calc1">
</div>
<div class="col-md-2">
<label for="death_benefit_option" class="form-label">Dth Ben Opt</label>
<select class="form-select form-select-sm calc1" name="death_benefit_option" id="death_benefit_option">
  <!--<option value="">-Select-</option>-->
  <option value="1" selected="selected">Lavel</option>
  <option value="2">Variable</option>
</select>
</div>
<div class="col-md-2">  
 <label for="current_cash_value" class="form-label">CURR CV/1035</label>
 <input type="number" id="current_cash_value" name="current_cash_value" value="0" class="form-control form-control-sm calc1">
</div>

<div class="col-md-2">  
    <div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary w-100" style="margin-top: 30px;" onclick="showValues()">Calculate</button>
        <?php // Html::submitButton('Submit', ['class' => 'btn btn-primary', 'onClick'=>'showValues()']) ?>
    </div>
</div>
</div>
  </div>
  </div>
</div>
</div>
</div>

<div class="row">

<div class="col-md-6">
<div class="card border-success">
  <!--<div class="card-header">Details</div>-->
  <div class="card-body text-success">
    <div class="form-group">
    <table class="table table-sm" id="form_table">
    <tr>
    	<td></td>
    	<td><strong>1st Insured</strong></td>
    	<td><strong>2nd Insured</strong></td>
    	<td><strong>Select OIR</strong></td>
    </tr>
    <tr>
    	<td><strong>Issue Date</strong></td>
        <td><input type="date" id="issue_date_1st" name="issue_date_1st" value="2010-01-01" class="form-control form-control-sm calc1"></td>
    	<td><input type="date" id="issue_date_2nd" name="issue_date_2nd" value="2010-01-01" class="form-control form-control-sm calc1"></td>
    	<td><input type="date" id="issue_date_oir" name="issue_date_oir" value="" class="form-control form-control-sm calc1"></td>
    </tr>
    <tr>
    	<td><strong>Face Amount</strong></td>
    	<td><input type="number" id="face_amount_1st" name="face_amount_1st" value="100000" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="face_amount_2nd" name="face_amount_2nd" value="" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="face_amount_oir" name="face_amount_oir" value="" class="form-control form-control-sm calc1"></td>
    </tr>
    <tr>
    	<td><strong>Issue Age</strong></td>
    	<td><input type="number" id="issue_age_1st" name="issue_age_1st" value="35" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="issue_age_2nd" name="issue_age_2nd" value="30" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="issue_age_oir" name="issue_age_oir" value="" class="form-control form-control-sm calc1"></td>
    </tr>
    <tr>
    	<td><strong>Sex</strong></td>
    	<td>
        <select class="form-select form-select-sm calc1" name="gender_1st" id="gender_1st">
          <option value="Male" selected="selected">Male</option>
          <option value="Female">Female</option>
          <option value="Unisex">Unisex</option>
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="gender_2nd" id="gender_2nd">
          <option value="Male">Male</option>
          <option value="Female" selected="selected">Female</option>
          <option value="Unisex">Unisex</option>
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="gender_oir" id="gender_oir">
          <option value="">-Select-</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Unisex">Unisex</option>
        </select>
        </td>
    </tr>
    <tr>
    	<td><strong>PREM Class</strong></td>
    	<td>
        <select class="form-select form-select-sm calc1" name="prem_class_1st" id="prem_class_1st">
          <option value="Smoker">Smoker</option>
          <option value="NonSmoker" selected="selected">NonSmoker</option>
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="prem_class_2nd" id="prem_class_2nd">
          <option value="Smoker">Smoker</option>
          <option value="NonSmoker" selected="selected">NonSmoker</option>
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="prem_class_oir" id="prem_class_oir">
          <option value="">-Select-</option>
          <option value="Smoker">Smoker</option>
          <option value="NonSmoker">NonSmoker</option>
        </select>
        </td>
    </tr>       
    <tr>  
    	<td><strong>TBL Rated</strong></td>
    	<td><select class="form-select form-select-sm calc1" name="tbl_rated_1st" id="tbl_rated_1st"><?=$tbl_rates_select_options;?></select></td>
    	<td><select class="form-select form-select-sm calc1" name="tbl_rated_2nd" id="tbl_rated_2nd"><?=$tbl_rates_select_options;?></select></td>
    	<td><select class="form-select form-select-sm calc1" name="tbl_rated_oir" id="tbl_rated_oir"><?=$tbl_rates_select_options;?></select></td>
    </tr>
    <tr>
    	<td><strong>Rated Yrs</strong></td>
    	<td><input type="number" id="rated_yrs_1st" name="rated_yrs_1st" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="rated_yrs_2nd" name="rated_yrs_2nd" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="rated_yrs_oir" name="rated_yrs_oir" class="form-control form-control-sm calc1"></td>
    </tr>
    <tr>
    	<td><strong>Flat Extra</strong></td>
    	<td><input type="number" id="flat_extra_1st" name="flat_extra_1st" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="flat_extra_2nd" name="flat_extra_2nd" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="flat_extra_oir" name="flat_extra_oir" class="form-control form-control-sm calc1"></td>
    </tr>  
    <tr>
    	<td><strong>FLEX Yrs</strong></td>
    	<td><input type="number" id="flex_yrs_1st" name="flex_yrs_1st" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="flex_yrs_2nd" name="flex_yrs_2nd" class="form-control form-control-sm calc1"></td>
    	<td><input type="number" id="flex_yrs_oir" name="flex_yrs_oir" class="form-control form-control-sm calc1"></td>
    </tr>
    <tr>
    	<td><strong>Waiver</strong></td>
    	<td>
        <select class="form-select form-select-sm calc1" name="waiver_1st" id="waiver_1st">
          <option value="No">No</option><option value="Yes">Yes</option>
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="waiver_2nd" id="waiver_2nd">
          <option value="No">No</option><option value="Yes">Yes</option>
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="waiver_oir" id="waiver_oir">
          <option value="No">No</option><option value="Yes">Yes</option>
        </select>
        </td>
    </tr>
    </table>








<!-- Second table -->

<table class="table table-sm table2">
    <tr>
    	<td></td>
    	<td><strong>1st Insured</strong></td>
    	<td>
        <select class="form-select form-select-sm calc1" name="select_pir" id="select_pir">
          <option value="">Select PIR</option>
            <?=$select_pir_options;?> 
        </select>
        </td>
    	<td>
        <select class="form-select form-select-sm calc1" name="select_oir" id="select_oir">
          <option value="">Select OIR</option>
            <?=$select_oir_options;?> 
        </select>
        </td>
    </tr>
<tr>
	<td><strong>Benefit Duration</strong></td>
	<td id="benefit_duration_1st"></td>
	<td id="benefit_duration_2nd"></td>
	<td id="benefit_duration_oir"></td>
</tr>
<tr>
	<td><strong>Attained Age</strong></td>
	<td id="attained_age_1st"></td>
	<td id="attained_age_2nd"></td>
	<td id="attained_age_oir"></td>
</tr>
<tr>
	<td><strong>EXPIRY YR</strong></td>
	<td id="expiry_yr_1st"></td>
	<td id="expiry_yr_2nd"></td>
	<td id="expiry_yr_oir"></td>
</tr>
<tr>
	<td><strong>Total Base</strong></td>
	<td id="total_base_1st"></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>Total 7 Pay Base</strong></td>
	<td id="total_7_pay_base_1st"></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>PRM Class</strong></td>
	<td id="prm_class_1st"></td>
	<td id="prm_class_2nd"></td>
	<td id="prm_class_oir"></td>
</tr>
<tr>
	<td><strong>MORT/PRM TBL</strong></td>
	<td id="mort_prm_tbl_1st"></td>
	<td id="mort_prm_tbl_2nd"></td>
	<td id="mort_prm_tbl_oir"></td>
</tr>
<tr>
	<td><strong>MORT Type</strong></td>
	<td id="mort_type_1st"></td>
	<td id="mort_type_2nd"></td>
	<td id="mort_type_oir"></td>
</tr>
<tr>
	<td><strong>Select Period</strong></td>
	<td id="select_period_1st"></td>
	<td id="select_period_2nd"></td>
	<td id="select_period_oir"></td>
</tr>
<tr>
	<td><strong>Ult QX_TBL</strong></td>
	<td id="ult_qx_tbl_1st"></td>
	<td id="ult_qx_tbl_2nd"></td>
	<td id="ult_qx_tbl_oir"></td>
</tr>
<tr>
	<td><strong>Maturity</strong></td>
	<td id="maturity_1st"></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>PRM Load TBL</strong></td>
	<td id="prm_load_tbl_1st"></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>PRM FEE TBL</strong></td>
	<td id="prm_fee_tbl_1st"></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>CNTRCT FEE TBL</strong></td>
	<td id="cntrct_fee_tbl_1st"></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>GL TREATMENT</strong></td>
	<td id="gl_treatment_1st"></td>
	<td id="gl_treatment_2nd"></td>
	<td id="gl_treatment_oir"></td>
</tr>
<tr>
	<td><strong>7P TREATMENT</strong></td>
	<td id="_7p_treatment_1st"></td>
	<td id="_7p_treatment_2nd"></td>
	<td id="_7p_treatment_oir"></td>
</tr>
<tr>
	<td><strong>GTD INT</strong></td>
	<td id="gtd_int_1st"></td>
	<td id="gtd_int_2nd"></td>
	<td id="gtd_int_oir"></td>
</tr>
<tr>
	<td><strong>RSK_DVSR</strong></td>
	<td id="rsk_dvsr_1st"></td>
	<td id="rsk_dvsr_2nd"></td>
	<td id="rsk_dvsr_oir"></td>
</tr>
</table>
    
    
    
    
    

    </div>
  </div>
  </div>
</div>


<div class="col-md-6">
<div class="card border-success">
  <!--<div class="card-header">Details</div>-->
  <div class="card-body text-success">
<table class="table table-sm table2">
<tr>
	<td></td>
	<td><strong>COMM_CURT</strong></td>
	<td><strong>COMM_CONT</strong></td>
	<td><strong>ILLUSTRATIVE</strong></td>
	<td><strong>PROJECTION</strong></td>
</tr>
<tr>
	<td><strong>GSP</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>GLP</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>NSP</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>7 Pay</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td><strong>CVAT DTH BEN</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>  
 
 
<h5 style="text-align: center;">Illustrate a policy change</h5>

<table class="table table-sm table2">
<tr>
	<td>Current GSP</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>Current GLP</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>Current 7 Pay </td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>7 Pay Start Date</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>7 Pay Cash Value</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>7 Pay Material Change</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>GSP Att Age old Benefits</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>GLP Att Age Old Benefits</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>GSP Att Age New Benefits</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>GLP Att Age New Benefits</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>New Adjusted GSP</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>New Adjusted GLP</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>New Adj 7 Pay Premium</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>CVAT</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>



 
  
  </div>
</div>



</div>




</div>


</form>

</div><!-- calculator_form -->
<div id="results-table"></div>


<script>




$(document).ready(function() {  
 calculate_first();
})

$('.calc1').on('change','',function(){calculate_first();}) 

function  calculate_first(){
    
var plan_code = $('#plan_code').val();
var issue_date = $('#issue_date').val();
var illustration_date = $('#illustration_date').val();
var death_benefit_option = $('#death_benefit_option').val();
var current_cash_value = $('#current_cash_value').val();
  
                    
var issue_date_1st = $('#issue_date_1st').val();
var face_amount_1st = $('#face_amount_1st').val();
var issue_age_1st = $('#issue_age_1st').val()*1;
var gender_1st = $('#gender_1st').val(); 
var prem_class_1st = $('#prem_class_1st').val();
var tbl_rated_1st = $('#tbl_rated_1st').val();
var rated_yrs_1st = $('#rated_yrs_1st').val();
var flat_extra_1st = $('#flat_extra_1st').val();
var flex_yrs_1st = $('#flex_yrs_1st').val();
var waiver_1st = $('#waiver_1st').val();
            
var issue_date_2nd = $('#issue_date_2nd').val();
var face_amount_2nd = $('#face_amount_2nd').val();
var issue_age_2nd = $('#issue_age_2nd').val()*1;
var gender_2nd = $('#gender_2nd').val();
var prem_class_2nd = $('#prem_class_2nd').val();
var tbl_rated_2nd = $('#tbl_rated_2nd').val();
var rated_yrs_2nd = $('#rated_yrs_2nd').val();
var flat_extra_2nd = $('#flat_extra_2nd').val();
var waiver_2nd = $('#waiver_2nd').val();
            
var issue_date_oir = $('#issue_date_oir').val();
var face_amount_oir = $('#face_amount_oir').val();
var issue_age_oir = $('#issue_age_oir').val()*1;
var gender_oir = $('#gender_oir').val();
var prem_class_oir = $('#prem_class_oir').val();
var tbl_rated_oir = $('#tbl_rated_oir').val();
var rated_yrs_oir = $('#rated_yrs_oir').val();
var flat_extra_oir = $('#flat_extra_oir').val();
var flex_yrs_oir = $('#flex_yrs_oir').val();
var waiver_oir = $('#waiver_oir').val();



//second table inputs//
var select_pir = $('#select_pir').val();
var select_oir = $('#select_oir').val();
    
//Calculations//    
var benefit_duration_1st = Calc_DUR(issue_date_1st,illustration_date);
var benefit_duration_2nd = Calc_DUR(issue_date_2nd,illustration_date);
var benefit_duration_oir = Calc_DUR(issue_date_oir,illustration_date);

var attained_age_1st = issue_age_1st+benefit_duration_1st-1;
var attained_age_2nd = issue_age_2nd+benefit_duration_2nd-1;
var attained_age_oir = issue_age_oir+benefit_duration_oir-1;

//getting the selected Plan, PIR and OIR data//
let plans = <?=json_encode($plans_data);?>;
let pirs = <?=json_encode($pirs_data);?>;
let oirs = <?=json_encode($oirs_data);?>;
let mort_prm_tbls = <?=json_encode($mort_prm_tbls);?>;
let ult_qx_tbls = <?=json_encode($ult_qx_tbls);?>;


      //  console.log(pirs);


var maturity = plans[plan_code].maturity*1;
var type = plans[plan_code].type;
var jls_ind = plans[plan_code].jls_ind;

if(select_pir>0){
var pir_maturity = pirs[select_pir].maturity*1;
var pir_type = pirs[select_pir].type;
//var pir_jls_ind = pirs[select_pir].jls_ind;
}

if(select_oir>0){
var oir_maturity = oirs[select_oir].maturity*1;
var oir_type = oirs[select_oir].type;
//let oir_jls_ind = oirs[select_oir].jls_ind;
}
/////////////////////////////////////////////////////////




var expiry_yr_1st=(type=="A")?maturity-issue_age_1st:maturity;
var expiry_yr_2nd=(jls_ind!='SL')?maturity-Math.min(issue_age_1st, issue_age_2nd):((select_pir>0)?(( pir_type=="A" )?( pir_maturity - issue_age_2nd ): pir_maturity ):0);
var expiry_yr_oir=(select_oir>0)?(( oir_type=="A" )?( oir_maturity - issue_age_oir ): oir_maturity ):0;


var gl_treatment_1st = plans[plan_code].gl_trmmnt;
var gl_treatment_2nd = ( jls_ind!='SL' )? plans[plan_code].gl_trmmnt: pirs[select_pir].gl_trmmnt;
if(select_oir>0){
var gl_treatment_oir = oirs[select_oir].gl_trmmnt;
}

var _7p_treatment_1st = gl_treatment_1st; 
var _7p_treatment_2nd = ( expiry_yr_2nd>7 )? "B" : gl_treatment_2nd;
var _7p_treatment_oir = gl_treatment_oir;


var total_base_1st = ( gl_treatment_1st=="B" )? face_amount_1st*1+face_amount_2nd*1 : face_amount_1st*1; 
var total_7_pay_base_1st_1  = ( _7p_treatment_2nd =="B" && expiry_yr_2nd>6 ) ? face_amount_1st*1 + face_amount_2nd*1 : face_amount_1st*1;
var total_7_pay_base_1st=( jls_ind!='SL' )? face_amount_1st*1 : (total_7_pay_base_1st_1 >= 0) ? total_7_pay_base_1st_1 : total_base_1st; 

var prm_class_1st = gender_1st.substring(0, 1)+prem_class_1st.substring(0, 1);
var prm_class_2nd = gender_2nd.substring(0, 1)+prem_class_2nd.substring(0, 1);
var prm_class_oir = gender_oir.substring(0, 1)+prem_class_oir.substring(0, 1);

var mort_prm_tbl_1st = mort_prm_tbls[plans[plan_code].qx_tbl][prm_class_1st];
var mort_prm_tbl_2nd = mort_prm_tbls[( jls_ind!='SL' )? plans[plan_code].qx_tbl: pirs[select_pir].qx_tbl][prm_class_2nd]; 
var mort_prm_tbl_oir = (prm_class_oir)?mort_prm_tbls[oirs[select_oir].qx_tbl][prm_class_oir]:"N/A";



var mort_type_1st = type;
var mort_type_2nd=(jls_ind!='SL')? type : pir_type;
var mort_type_oir = oir_type;

var select_period_1st = (mort_type_1st=="S")? "25" : "N/A";
var select_period_2nd = (mort_type_2nd=="S")? "25" : "N/A";
var select_period_oir = (mort_type_oir=="S")? "25" : "N/A";

var ult_qx_tbl_1st = (mort_type_1st =="S")? ult_qx_tbls[mort_prm_tbl_1st].u_tbl : "N/A";  
var ult_qx_tbl_2nd = (mort_type_2nd =="S")? ult_qx_tbls[mort_prm_tbl_2nd].u_tbl : "N/A"; ;
var ult_qx_tbl_oir = (mort_type_oir =="S")? ult_qx_tbls[mort_prm_tbl_oir].u_tbl : "N/A"; ;

var maturity_1st = maturity;
var prm_load_tbl_1st = "PLOAD_"+plans[plan_code].p_load;
var prm_fee_tbl_1st = "PFEE_"+plans[plan_code].p_fee;
var cntrct_fee_tbl_1st = "CFEE_"+plans[plan_code].c_fee;



var gtd_int_1st = plans[plan_code].gdn_int;
var gtd_int_2nd;
var gtd_int_oir;

var rsk_dvsr_1st = Math.pow(1+gtd_int_1st, 1/12).toFixed(8);
var rsk_dvsr_2nd;
var rsk_dvsr_oir;



$('#benefit_duration_1st').html(benefit_duration_1st);
$('#benefit_duration_2nd').html(benefit_duration_2nd);
$('#benefit_duration_oir').html(benefit_duration_oir);    

$('#attained_age_1st').html(attained_age_1st);
$('#attained_age_2nd').html(attained_age_2nd);    
$('#attained_age_oir').html(attained_age_oir);

$('#expiry_yr_1st').html(expiry_yr_1st);
$('#expiry_yr_2nd').html(expiry_yr_2nd);    
$('#expiry_yr_oir').html(expiry_yr_oir);

$('#total_base_1st').html(total_base_1st);
$('#total_7_pay_base_1st').html(total_7_pay_base_1st);    

$('#prm_class_1st').html(prm_class_1st);
$('#prm_class_2nd').html(prm_class_2nd);    
$('#prm_class_oir').html(prm_class_oir);

$('#mort_prm_tbl_1st').html(mort_prm_tbl_1st);
$('#mort_prm_tbl_2nd').html(mort_prm_tbl_2nd);    
$('#mort_prm_tbl_oir').html(mort_prm_tbl_oir);

$('#mort_type_1st').html(mort_type_1st);
$('#mort_type_2nd').html(mort_type_2nd);    
$('#mort_type_oir').html(mort_type_oir);

$('#select_period_1st').html(select_period_1st);
$('#select_period_2nd').html(select_period_2nd);    
$('#select_period_oir').html(select_period_oir);

$('#ult_qx_tbl_1st').html(ult_qx_tbl_1st);
$('#ult_qx_tbl_2nd').html(ult_qx_tbl_2nd);    
$('#ult_qx_tbl_oir').html(ult_qx_tbl_oir);

$('#maturity_1st').html(maturity_1st);
$('#prm_load_tbl_1st').html(prm_load_tbl_1st);    
$('#prm_fee_tbl_1st').html(prm_fee_tbl_1st);
$('#cntrct_fee_tbl_1st').html(cntrct_fee_tbl_1st);

$('#gl_treatment_1st').html(gl_treatment_1st);
$('#gl_treatment_2nd').html(gl_treatment_2nd);    
$('#gl_treatment_oir').html(gl_treatment_oir);

$('#_7p_treatment_1st').html(_7p_treatment_1st);
$('#_7p_treatment_2nd').html(_7p_treatment_2nd);    
$('#_7p_treatment_oir').html(_7p_treatment_oir);

$('#gtd_int_1st').html(gtd_int_1st);
$('#gtd_int_2nd').html(gtd_int_2nd);    
$('#gtd_int_oir').html(gtd_int_oir);

$('#rsk_dvsr_1st').html(rsk_dvsr_1st);
$('#rsk_dvsr_2nd').html(rsk_dvsr_2nd);    
$('#rsk_dvsr_oir').html(rsk_dvsr_oir);
}
</script>





<script>

$(document).ready(function () {
    $('#form_id').submit(false);
   $("#form_id").submit(function(){return false;});
   
});


  function showValues(){       
     var form=$("#form_id").serialize(); 
             
    $.ajax({
			type: 'post',
			url: '/site/show',
			data: form,
            //data: arr,
            beforeSend: function(){$("#wait").css("display", "block");},
			success: function (dat) {
			     $("#wait").css("display", "none");
			     $( '#results-table' ).html(dat); 
           	}
        });
    }
</script>
