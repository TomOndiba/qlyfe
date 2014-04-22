<script language='javascript' src='<?php echo $vars['url']; ?>vendors/autodate.js'></script>
<script language="javascript">
		function checkDate(month,day,year){
			var month2 = $("#" + month+" option:selected").val();
			var day2 = $("#" + day+" option:selected").val();			
			var year2 = $("#" + year+" option:selected").val();			
			var date2 = month2 + "/" + day2 + "/" + year2;

			if(checkinputdate(date2)){
				$("#birthdate").val(date2);
			}	
							
		}
</script>
<?php

$birthdate = $vars['value'];
$arr = split("/",$birthdate);
$birthmonth = $arr[0];
$birthday = $arr[1];
$birthyear = $arr[2];

$yeararr = array();
$year3 = date("Y");
for($i=1900;$i < $year3; $i++){
	$yeararr[$i] = $i;
}

$dayarr = array();
for($i=1;$i < 32; $i++){
	$dayarr[$i] = $i;
}

$montharr = array();
for($i=1;$i < 13; $i++){
	$montharr[$i] = date("M",mktime(0,0,0,$i,1,2010));
}


echo elgg_view("input/pulldown", array('internalname' => 'birthmonth','internalid'=>'birthmonth', 'value' => $birthmonth, 'options_values' => $montharr, "js"=>"onChange=\"checkDate('birthmonth','birthday','birthyear');\"" ));
echo "&nbsp; ";
echo elgg_view("input/pulldown", array('internalname' => 'birthday','internalid'=>'birthday', 'value' => $birthday, 'options_values' => $dayarr, "js"=>"onChange=\"checkDate('birthmonth','birthday','birthyear');\"" ));
echo "&nbsp; ";
echo elgg_view("input/pulldown", array('internalname' => 'birthyear','internalid'=>'birthyear', 'value' => $birthyear, 'options_values' => $yeararr, "js"=>"onChange=\"checkDate('birthmonth','birthday','birthyear');\"" ));
echo elgg_view("input/hidden", array('internalname' => 'birthdate','internalid'=>'birthdate', 'value' => $birthdate));
