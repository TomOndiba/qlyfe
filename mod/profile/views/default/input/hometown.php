<?php 

$arr = json_decode($vars['value'],true);

$homecity = $arr['homecity'];
$homestate = $arr['homestate'];
$otherhomestate = $arr['otherhomestate'];
$homecountry = $arr['homecountry'];


print "<label>".elgg_echo("homecity");
echo elgg_view("input/text",array(	'internalname' => "homecity",'value' => $homecity,)); 
print "</label><br>";

print "<label>".elgg_echo("homecountry")."<br>";
echo elgg_view("input/pulldown", array('internalname' => 'homecountry','internalid'=>'homecountry', 'value' => $homecountry, 'options_values' => getCountryList(), "js"=>"onChange=\"changeCountry('homecountry','otherhomestate','homestate');\"" ));
print "</label><br>";


if($homecountry == "" || $homecountry == "US"){
	$homestate_visible = "" ; 
	$otherhomestate_visible = "display:none" ; 	
}else{
 	$homestate_visible = "display:none";
	$otherhomestate_visible = "" ; 		
} 
print "<label>".elgg_echo("homestate")."<br>";
echo "<div id='homestate_chooser' style='$homestate_visible'>";
echo elgg_view("input/pulldown", array('internalname' => 'homestate','internalid'=>'homestate', 'value' => $homestate, 'options_values' => getStateList()));
print "</div>";
echo "<div id='otherhomestate_chooser' style='$otherhomestate_visible'>";
echo elgg_view("input/text",array(	'internalname' => "otherhomestate",'value' => $otherhomestate,)); 
print "</div></label><br>";


?>