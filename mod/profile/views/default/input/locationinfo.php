<?php 

$arr = json_decode($vars['value'],true);

$street1 = $arr['street1'];
$street2 = $arr['street2'];
$city = $arr['city'];
$state = $arr['state'];
$otherstate = $arr['otherstate'];
$zip = $arr['zip'];
$country = $arr['country'];

print "<label>".elgg_echo("street1")."<br>";
echo elgg_view("input/text",array('internalname' => "street1",'value' => $street1,)); 
print "</label><br>";

print "<label>".elgg_echo("street2")."<br>";
echo elgg_view("input/text",array('internalname' => "street2",'value' => $street2,)); 
print "</label><br>";

print "<label>".elgg_echo("city")."<br>";
echo elgg_view("input/text",array(	'internalname' => "city",'value' => $city,)); 
print "</label><br>";

print "<label>".elgg_echo("zip")."<br>";
echo elgg_view("input/text",array(	'internalname' => "zip",'value' => $zip,)); 
print "</label><br>";

print "<label>".elgg_echo("country")."<br>";
echo elgg_view("input/pulldown", array('internalname' => 'country','internalid'=>'country', 'value' => $country, 'options_values' => getCountryList(), "js"=>"onChange=\"changeCountry('country','otherstate','state');\"" ));
print "</label><br>";

if($country == "" || $country == "US"){
	$state_visible = "" ; 
	$otherstate_visible = "display:none" ; 	
}else{
 	$state_visible = "display:none";
	$otherstate_visible = "" ; 		
} 
print "<label>".elgg_echo("state")."<br>";
echo "<div id='state_chooser' style='$state_visible'>";
echo elgg_view("input/pulldown", array('internalname' => 'state','internalid'=>'state', 'value' => $state, 'options_values' => getStateList()));
print "</div>";
echo "<div id='otherstate_chooser' style='$otherstate_visible'>";
echo elgg_view("input/text",array(	'internalname' => "otherstate",'value' => $otherstate,)); 
print "</div></label><br>";


?>