<?php 

$arr = json_decode($vars['value'],true);

$street1 = $arr['street1'];
$street2 = $arr['street2'];
$city = $arr['city'];
$state = $arr['state'];
$otherstate = $arr['otherstate'];
$zip = $arr['zip'];
$country = $arr['country'];

if($country  == "")
	$country = "US";

if($country != "" || $country != "US"){
 	$state = $otherstate;
}else{
	$statearr = getStateList();
	$state = $statearr[$state];
} 

if($street1 != "" || $street2 != "")
	echo "<br>";
echo "$street1 $street2"; 
echo "<br>";

echo $city;

if($state != "" && $city != "") 
	echo " ,";

echo $state;

if($zip != "")
	echo " - $zip";

if($state != "" || $city != "") 
	echo " ,";

$countryarr = getCountryList();
echo $countryarr[$country]; 



?>