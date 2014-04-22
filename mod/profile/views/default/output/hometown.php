<?php 

$arr = json_decode($vars['value'],true);

$homecity = $arr['homecity'];
$homestate = $arr['homestate'];
$otherhomestate = $arr['otherhomestate'];
$homecountry = $arr['homecountry'];
if($homecountry  == "")
	$homecountry = "US";

if($homecountry != "" || $homecountry != "US"){
 	$homestate = $otherhomestate;
}else{
	$statearr = getStateList();
	$homestate = $statearr[$homestate];
}

echo $homecity;

if($homestate != "" && $homecity != "") 
	echo " ,";

echo $homestate;

if($homestate != "" || $homecity != "") 
	echo " ,";

$countryarr = getCountryList();
echo $countryarr[$homecountry]; 



?>