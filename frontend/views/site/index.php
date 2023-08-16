<style>
/* 
#form_table>tr>td>input,select {
  margin-top: -7px;
  margin-bottom: -7px;
  }
 
#form_table>tr>td>select {
  margin-top: -7px;
  margin-bottom: -7px;
  }
*/

.card-body{
  padding-top: 1px;  
}

.table2 td{
    border: 1px solid grey;
    text-align: left;
}

.table2 td:not(:first-child) {
    text-align: center;
}
</style>


<script>

//VBA created user function Calculates Policy Duration
function Calc_DUR(date1,date2){
 
    date1 = new Date(date1);
    date2 = new Date(date2);
    
    let D1 = date1.getDate();
    let D2 = date2.getDate();
    let M1 = date1.getMonth() + 1;
    let M2 = date2.getMonth() + 1;
    let Y1 = date1.getFullYear();
    let Y2 = date2.getFullYear();
    let tmp;

    if(date1 == date2){
    //tmp = DateDiff("yyyy", date1, Date2)
        tmp = 1;
        }else if(date2 < date1){
        tmp = -1;
        }else {
        
        if (M2 < M1){
            tmp = Y2 - Y1;
            }else if (M2 > M1){
                tmp = Y2 - Y1 + 1;
                }else{
            if(D2 > D1){
                tmp = Y2 - Y1;}
                else {tmp = Y2 - Y1 + 1;}
            }
        }
   

/*
    If date1 = Date2 Then

        tmp = 1
    ElseIf Date2 < date1 Then
        tmp = -1
    Else
        If M2 < M1 Then
            tmp = Y2 - Y1
        ElseIf M2 > M1 Then
            tmp = Y2 - Y1 + 1
        Else
            If D2 > D1 Then
                tmp = Y2 - Y1
            Else
                tmp = Y2 - Y1 + 1
            End If
        End If
    End If
  */ 

    return tmp;
}

</script>

<?php $this->title = 'Life Insurance'; ?>
<div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px; z-index: 2000;"><img src='/img/ajaxloader.gif'/>Loading...</div> 

<?php /*
<h1><?=$this->title;?></h1>  
<hr />
*/ ?>
<?= $this->render('calculator_form', ['model' => $model]) ?>




<script>
/*
    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        formattedamount = x1 + x2
        return formattedamount;
    }
$(document).on('keyup, change, input','.decimal',function() {    
    var numcheck = $(this).val();
        numcheck = numcheck.replace(/[^0-9\.]/g, '');
        numcheck = addCommas(numcheck);
        $(this).val(numcheck);
});


$(document).ready(function () {
    
   
});
*/

</script>
 

